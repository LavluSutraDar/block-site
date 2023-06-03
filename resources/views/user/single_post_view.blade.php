@extends('layouts.app')

@section('mainsection')
    <div class="py-4"></div>
    <section class="section">
        <div class="container">
            <div class="row justify-content-center">
                <div class=" col-lg-9   mb-5 mb-lg-0">
                    <article>
                        <div class="post-slider mb-4">
                            <img src="{{ asset('backend/post_thumbnail/' . $post->thumbnail) }}" class="card-img"
                                alt="post-thumb">
                        </div>

                        <h1 class="h2">{{ $post->title }}</h1>

                        <ul class="card-meta list-inline">
                            <li class="list-inline-item">
                                <i class="ti-calendar text-dark">
                                    {{ date('d M Y', strtotime($post->created_at)) }}
                                </i>
                            </li>
                            <li class="list-inline-item">
                                <ul class="card-meta-tag list-inline">
                                    Category : <b class="text-danger">{{ $post->category_name }}</b>
                                </ul>
                            </li>
                            <li class="list-inline-item">
                                <ul class="card-meta-tag list-inline">
                                    <p>
                                        @php
                                            echo $post->description;
                                        @endphp
                                    </p>
                                </ul>
                            </li>
                        </ul>
                        <div class="content">

                            @foreach ($comments as $comment)
                                <div class="media d-block d-sm-flex mb-4 pb-4">

                                    <a class="d-inline-block mr-2 mb-3 mb-md-0" href="#">
                                        @if ($comment->user_image)
                                            <img src="{{ asset('backend/user_image/' . $comment->user_image) }}"
                                                class="mr-3 rounded-circle" alt="" style="height:50px">
                                        @else
                                            <img src="{{ asset('backend/user_image/user.jpg') }}"
                                                class="mr-3 rounded-circle" alt="" style="height:50px">
                                        @endif
                                    </a>
                                    <div class="media-body">
                                        <a href="#!" class="h4 d-inline-block mb-3">{{ $comment->user_name }}</a>

                                        <p>
                                            {{-- {{$comment->comment}} --}}
                                            @php
                                                echo $comment->comment;
                                            @endphp
                                        </p>

                                        <span
                                            class="text-black-800 mr-3 font-weight-600">{{ date('d M Y', strtotime($comment->created_at)) }}</span>

                                    </div>
                                </div>
                            @endforeach


                            <div class="mt-5">
                                {{ $comments->links('pagination::bootstrap-5') }}
                            </div>

                        </div>

                        <div>
                            <h3 class="mb-4">Leave a Reply</h3>
                            <form action="{{ route('post_comment', $post->id) }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <textarea class="summernote form-control shadow-none" name="comment" rows="7" required></textarea>
                                    </div>

                                </div>
                                <button class="btn btn-primary" type="submit">Comment Now</button>
                            </form>
                        </div>
                </div>

            </div>
        </div>
    </section>
@endsection
