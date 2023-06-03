<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContuctMessage;
use Illuminate\Http\Request;

use function Pest\Laravel\delete;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $messageobj = new ContuctMessage();
        $messages = $messageobj
        ->join('users', 'users.id', '=', 'contuct_messages.user_id')
        ->select('contuct_messages.*', 'users.name as user_name', 'users.image as user_image', 'users.email as user_email')
        ->orderby('contuct_messages.id', 'desc')
        ->get();

        return view('admin.messages', compact('messages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        ContuctMessage::find($id)->delete();

        $notifacation = [
            'message' => 'Data Delete Successfully',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notifacation);

    }
}
