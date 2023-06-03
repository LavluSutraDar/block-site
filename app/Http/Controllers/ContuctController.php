<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContuctStoreRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ContuctMessage;

class ContuctController extends Controller
{
    public function contuct(){
        return view('user.contuct');
    }

    public function contuct_message(ContuctStoreRequest $request){
        $data =[
            'user_id'=> auth()->user()->id,
            'subject'=>$request->subject,
            'message'=>$request->message,
        ];

        ContuctMessage::create($data);

        $notifacation = [
            'message' => 'Message Sent Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notifacation);

    }

    
}
