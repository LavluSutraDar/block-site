@extends('admin.layouts.app')

@section('title')
    Category
@endsection

@php
    $page = 'Categories';
@endphp

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tables</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">

        <div class="card-header py-3 d-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Categories</h6>
            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addcategoryModal">Add Category</button>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>I-D</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Delete</th>
                            <th>Edit</th>

                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($category as $key => $cat)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $cat->name }}</td>
                                <td>{{ $cat->description }}</td>
                                <td>
                                    <form action="{{ route('category.destroy', $cat->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="_method" value="Delete">
                                        <button type="submit" class="delete btn btn-danger">
                                            Delete
                                        </button>
                                    </form>
                                </td>

                                <td>
                                   
                                    <button type="submit" data-toggle="modal" data-target="{{'#edit'.$cat->id.'categoryModal'}}"
                                        class="btn btn-info">Edit</button>
                                </td>

                            </tr>

                            <div class="modal fade" id="{{'edit'.$cat->id.'categoryModal'}}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">{{ $cat->name }}</h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{route('category.update', $cat->id)}}" method="POST">
                                                @csrf
                                                  <input type="hidden" name="_method" value="PUT">

                                                <div class="mb-3">
                                                    <label for="exampleInputEmail1" class="form-label">Category Edit
                                                        Name</label>
                                                    <input type="text"
                                                        class="form-control 
                                                          @error('editname') is-invalid @enderror"
                                                        name="editname" value="{{ $cat->name }}">

                                                    @error('editname')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <div class="mb-3">
                                                    <label for="exampleInputPassword1" class="form-label"> Category Edit
                                                        Discription</label>

                                                    <textarea class="form-control @error('editdescription') is-invalid @enderror" name="editdescription" rows="5">
                                                        {{ $cat->description }}
                                                    </textarea>

                                                    @error('editdescription')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>


                                                <div class="modal-footer">
                                                    <button class="btn btn-warning" type="button"
                                                        data-dismiss="modal">Cancel</button>

                                                    <button type="submit" class="btn btn-danger" href="">Category
                                                        Edit Submit
                                                    </button>
                                                </div>

                                            </form>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Category Add Modal-->
    <div class="modal fade" id="addcategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Category Add</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('category.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Category Name</label>
                            <input type="text"
                                class="form-control 
                            @error('name') is-invalid @enderror"
                                name="name" value="{{ old('name') }}">

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label"> Category Discription</label>

                            <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="5"
                                value="{{ old('description') }}">
                            </textarea>
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Check me out</label>
                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-warning" type="button" data-dismiss="modal">Cancel</button>

                            <button type="submit" class="btn btn-danger" href="">Category Add</button>
                        </div>

                    </form>

                </div>

            </div>
        </div>
    </div>
@endsection
