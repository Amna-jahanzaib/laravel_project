<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Message;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class MessagesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('message_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $messages = Message::all();

        return view('admin.messages.index', compact('messages'));
    }
    public function show(Message $message)
    {
        abort_if(Gate::denies('message_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.messages.show', compact('message'));
    }
    public function create()
    {
        abort_if(Gate::denies('message_create'), Response::HTTP_FORBIDDEN, '404 Not Found');

        return redirect()->route('home');
    
    }

    public function store(Request $request)
    {
        $contact_us = new Message();
        $contact_us->first_name = $request->input('first_name');
        $contact_us->last_name = $request->input('last_name');
        $contact_us->phone = $request->input('phone');
        $contact_us->email = $request->input('email');
        $contact_us->message = $request->input('message');

        $contact_us->save();
        return redirect()->back()->with('message', 'Your Message has been successfully submitted! Have a Good Day');   

    }

    public function destroy(Message $message)
    {
        abort_if(Gate::denies('message_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $message->delete();

        return back();
    }

}
