@extends('admin.layouts.app');

@section('title')
    Post
@endsection

@php
    $page = 'post';
@endphp

@section('content')
    <div class="card shadow mb-4">

        <div class="card-header py-3 d-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Post</h6>
            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addpostModal">Add Post</button>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>I-D</th>
                            <th>Category-Id</th>
                            <th>Title</th>
                            <th>Subtitle</th>
                            <th>Description</th>
                            <th>Thumbnail</th>
                            <th>Status</th>
                            <th>Delete</th>
                            <th>Edit</th>

                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($post as $key => $postdata)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $postdata->category_name }}</td>
                                <td>{{ $postdata->title }}</td>
                                <td>{{ $postdata->subtitle }}</td>
                                <td>
                                    @php
                                        echo $postdata->description
                                    @endphp
                                </td>
                                <td>
                                    <img src="{{ asset('backend/post_thumbnail/' . $postdata->thumbnail) }}" alt=""
                                        style="width: 100px">
                                </td>
                                <td>
                                    @if ($postdata->status == 1)
                                        <span class="badge badge-success">Active</span>
                                    @else
                                        <span class="badge badge-danger">IN Active</span>
                                    @endif
                                </td>
                                <td>
                                    <form action="{{ route('post.destroy', $postdata->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="_method" value="Delete">
                                        <button type="submit" class="delete btn btn-danger">
                                            Delete
                                        </button>
                                    </form>
                                </td>

                                <td>

                                    <button type="submit" data-toggle="modal"
                                        data-target="{{ '#edit' . $postdata->id . 'postModal' }}"
                                        class="btn btn-info">Edit</button>
                                </td>
                            </tr>

                            <div class="modal fade" id="{{ 'edit' . $postdata->id . 'postModal' }}" tabindex="-1"
                                role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel"></h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('post.update', $postdata->id) }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="_method" value="PUT">

                                                <div>
                                                    <label class="form-label" for="">Category Id</label>
                                                    <select class="form-control" name="category_id" id="">
                                                        @foreach ($data as $value)
                                                            <option value="{{ $value->id }}"
                                                                @if ($value->id == $postdata->category_id) selected @endif>
                                                                {{ $value->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="exampleInputEmail1" class="form-label">Edit Post
                                                        title</label>
                                                    <input type="text"
                                                        class="form-control 
                                                          @error('edit_post_title') is-invalid @enderror"
                                                        name="edit_post_title" value="{{ $postdata->title }}">

                                                    @error('edit_post_title')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                          
                                                <div class="mb-3">
                                                    <label for="exampleInputPassword1" class="form-label"> Category Edit
                                                        Discription</label>

                                                    <textarea class="summernote form-control @error('edit_post_description') is-invalid @enderror" name="edit_post_description"
                                                        rows="5">
                                                        {{ $postdata->description }}
                                                       
                                                    </textarea>

                                                    @error('edit_post_description')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <div class="mb-3">
                                                    <label for="" class="form-label text-white">Post Thumbnail
                                                        :</label>
                                                    <input type="file" name="thumbnail" class="form-control-file">

                                                    <input type="hidden" name="old_thumbnail"
                                                        value="{{ $postdata->thumbnail }}">

                                                </div>



                                                <div class="mb-3 form-check">

                                                    <label class="form-check-label" for="status">

                                                        <input type="checkbox" class="form-check-input" id="status"
                                                            name="status" value="1"
                                                            @if ($postdata->status == 1) checked @endif>
                                                        Status
                                                    </label>


                                                </div>


                                                <div class="modal-footer">
                                                    <button class="btn btn-warning" type="button"
                                                        data-dismiss="modal">Cancel</button>

                                                    <button type="submit" class="btn btn-danger" href="">Post
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

    <!-- Post Add Modal-->
    <div class="modal fade" id="addpostModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Post</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div>
                            <label class="form-label" for="">Category Id</label>
                            <select class="form-control" name="category_id" id="">
                                <option value="" selected disabled> --Choose A Category-- </option>
                                @foreach ($data as $value)
                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Post Title</label>
                            <input type="text" name="posttitle"
                                class="form-control @error('posttitle') is-invalid @enderror"
                                value="{{ old('posttitle') }}">

                            @error('posttitle')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                         <div class="mb-3">
                            <label for="" class="form-label">SubTitle</label>
                            <input type="text" name="subtitle"
                                class="form-control @error('subtitle') is-invalid @enderror"
                                value="{{ old('subtitle') }}">

                            @error('subtitle')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label"> post Discription</label>

                            <textarea class="summernote form-control @error('postdescription') is-invalid @enderror" name="postdescription" rows="5"
                                value="{{ old('postdescription') }}">
                            </textarea>
                            @error('postdescription')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label text-white">Post Thumbnail :</label>
                            <input type="file" name="thumbnail"
                                class="form-control-file @error('thumbnail') is-invalid @enderror">

                            @error('thumbnail')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="status" name="status"
                                value="1">
                            <label class="form-check-label" for="status">Status</label>
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
