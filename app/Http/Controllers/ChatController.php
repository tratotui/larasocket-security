<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Message;

use App\Events\NewMessageAdded;

class ChatController extends Controller
{
   	public function getIndex()
   	{
   		$messages = Message::all();
   		return view('chat.index', compact('messages'));
   	}

   	public function postMessage(Request $request)
   	{
   		$message = Message::create($request->all());
   		event(
   			new NewMessageAdded($message)
   		);
   		return redirect()->back();
   	}
}
