var request = require('request'),
	io = require('socket.io')(6001, {
		origins : 'larasocket.local:*'
	}),
	Redis = require('ioredis'),
	redis = new Redis();

io.use(function(socket, next) {

	request.get({
		url : 'http://larasocket.local/ws/check-auth',
		headers : {cookie : socket.request.headers.cookie},
		json : true
	}, function(error, response, json) {
		console.log(json);
		return json.auth ? next() : next(new Error('Auth error'));
	});	

});


io.on('connection', function(socket) {

	socket.on('subscribe', function(channel) {
		console.log('I want to subscribe on:', channel);

		request.get({
			url : 'http://larasocket.local/ws/check-sub/' + channel,
			headers : {cookie : socket.request.headers.cookie},
			json : true
		}, function(error, response, json) {
			if(json.can) {
				socket.join(channel, function(error) {
					socket.send('Join to ' + channel);
				});
				return;
			}
		});	

	});

});



redis.psubscribe('*', function(error, count) {
	// ...
});

redis.on('pmessage', function(pattern, channel, message) {
	message = JSON.parse(message);
	io
		.to(channel + ':' + message.event)
		.emit(channel + ':' + message.event, message.data.message);
	// channel:message.event
});
/*
	1. Защита на уровне сервера - [x]
	2. Защита на уровне соединения - [x]
	3. Защита подписки на канал - [x]
*/