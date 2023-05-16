@extends('layouts.app')

@section('mainsection')
    @include('layouts.frontend.banner')
    <section class="section-sm">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8  mb-5 mb-lg-0">
                    <h2 class="h5 section-title">Recent Post</h2>

                    @foreach ($posts as $post)
                        <article class="card mb-4">
                            <div class="post-slider">
                                <img src="{{asset('backend/post_thumbnail/' . $post->thumbnail)}}" class="card-img-top" alt="post-thumb">
                            </div>
                            <div class="card-body">
                                <h3 class="mb-3">
                                    <a class="post-title" href="{{route('single_post_view', $post->id)}}">
                                        {{$post->title}}
                                    </a>
                                </h3>
                                <ul class="card-meta list-inline">
                                    <li class="list-inline-item">
                                        <i class="ti-calendar text-dark">
                                            {{date('d M Y', strtotime($post->created_at))}}
                                        </i>

                                    </li>
                                    <li class="list-inline-item">
                                        <ul class="card-meta-tag list-inline">
                                            Category : <b class="text-danger">{{$post->category_name}}</b>
                                        </ul>
                                    </li>
                                </ul>
                                <a href="{{route('single_post_view', $post->id)}}" class="btn btn-outline-primary">Read More</a>
                            </div>
                        </article>
                    @endforeach

                    <ul class="pagination justify-content-center">
                        <li class="page-item page-item active ">
                            <a href="#!" class="page-link">1</a>
                        </li>
                        <li class="page-item">
                            <a href="#!" class="page-link">2</a>
                        </li>
                        <li class="page-item">
                            <a href="#!" class="page-link">&raquo;</a>
                        </li>
                    </ul>
                </div>

                <!---------------RIGHT BAR------------------>
                @include('layouts.frontend.rightbar')

            </div>
        </div>
    </section>
@endsection
