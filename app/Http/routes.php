<?php

Route::get('/', function() {
	//return view('welcome');
	event(
		new \App\Events\TestEvent()
	);
});


Route::get('/test-auth', function() {
	\Auth::login(
		\App\User::find(2)
	);

	return redirect('/chat');

});

Route::group(['prefix' => 'ws'], function() {
	// ws/check-auth
	Route::get('check-auth', function() {
		return response()->json([
			'auth' => \Auth::check()
		]);
	});

	Route::get('check-sub/{channel}', function($channel) {
		// Gate or Service
		return response()->json([
			'can' => \Auth::check() && \Auth::user()->name == 'Oleg'
		]);
	});


});


Route::controller('chat', 'ChatController');