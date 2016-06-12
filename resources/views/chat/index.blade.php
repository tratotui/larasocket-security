<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Socket io app</title>
</head>
<body>

    <ul class="chat">
        @foreach($messages as $message)
            <li>
                <b>{{ $message->author }}</b>
                <p>{{ $message->content }}</p>
            </li>
        @endforeach
    </ul>
    <hr> 
    <form action="/chat/message" method="POST">
        <input type="text" name="author">
        <br>
        <br>
        {{ csrf_field() }}
        <textarea name="content" style="width:100%;height:50px"></textarea>
        <input type="submit" value="Отправить">
    </form>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.js"></script>
    <script src="https://cdn.socket.io/socket.io-1.4.5.js"></script>
    <script>

        var socket = io(':6001'),
            channel = 'chat:message';

        socket.on('connect', function() {
            socket.emit('subscribe', channel)
        });

        socket.on('error', function(error) {
            console.warn('Error', error);
        });

        socket.on('message', function(message) {
            console.info(message);
        });



        function appendMessage(data) {
            $('.chat').append(
                $('<li/>').append(
                    $('<b/>').text(data.author),
                    $('<p/>').text(data.content)
                )
            );
        }

        // // $('form').on('submit', function() {
        // //     var text = $('textarea').val(),
        // //         msg = {message : text};

        // //     socket.send(msg);
        // //     appendMessage(msg);

        // //     $('textarea').val('');
        // //     return false;
        // // });

        socket.on(channel, function(data) {
            appendMessage(data);
        });


    </script>
    
</body>
</html>