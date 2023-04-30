@extends('admin.layouts.app')
@section('title')
    Edit Category Page
@endsection

@php
    $page = 'Edit Category';
@endphp

@section('content')
    <div class="card mt-5">
        <div class="card-body">
            <form action="{{route('category.update', $data->id)}}" method="POST">
                @csrf
                <input type="hidden" name="_method" value="PUT">

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Edit Name</label>
                    <input type="text" class="form-control" name="cat_name" value="{{ $data->name }}">
                </div>

                

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
