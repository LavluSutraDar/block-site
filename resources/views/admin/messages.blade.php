@extends('admin.layouts.app');

@section('title')
    Message
@endsection

@php
    $page = 'message';
@endphp

@section('content')
    <div class="card shadow mb-4">

        <div class="card-header py-3 d-flex align-items-center justify-content-between">
            <h4 class="m-0 font-weight-bold text-primary">All Message</h4>

        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>I-D</th>
                            <th>User Image</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>subject</th>
                            <th>Massage</th>
                            <th>Delete</th>
                            

                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($messages as $key => $message)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>
                                   @if ($message->user_image == null)
                                   <img src="{{ asset('backend/user_image/user.jpg') }}" alt=""
                                        style="height: 50px">
                                        
                                   @else
                                        <img src="{{ asset('backend/user_image/' . $message->user_image) }}" alt=""
                                        style="height: 50px">
                                   @endif

                                </td>

                                <td>{{ $message->user_name }}</td>
                                <td>{{ $message->user_email }}</td>
                                <td>{{ $message->subject }}</td>
                                <td>{{ $message->message }}</td>

                                <td>
                                    <form action="{{ route('messages.destroy', $message->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="_method" value="Delete">
                                        <button type="submit" class="delete btn btn-danger">
                                            Delete
                                        </button>
                                    </form>
                                </td>


                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
