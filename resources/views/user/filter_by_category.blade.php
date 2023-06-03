a @extends('layouts.app')

 @section('mainsection')
     <section class="section-sm">
         <div class="container">
             <div class="row justify-content-center">
                 <div class="col-lg-8  mt-5 mb-lg-0">
                     <h2 class=""><mark>{{ $posts->first()->category_name }}</mark> </h2>

                     @foreach ($filter_posts as $post)
                         <article class="card mb-4">
                             <div class="post-slider">
                                 <img src="{{ asset('backend/post_thumbnail/' . $post->thumbnail) }}" class="card-img-top"
                                     alt="post-thumb">
                             </div>
                             <div class="card-body">
                                 <h3 class="mb-3"><a class="post-title" href="{{ route('single_post_view', $post->id) }}">
                                         {{ $post->title }} </a>
                                 </h3>
                                 <ul class="card-meta list-inline">
                                     <li class="list-inline-item">
                                         <i class="ti-calendar"></i>
                                         {{ date('d M Y', strtotime($post->created_at)) }}
                                     </li>
                                     <li class="list-inline-item">
                                         <ul class="card-meta-tag list-inline">
                                             Category : <b class="text-danger">{{ $post->category_name }}</b>
                                         </ul>
                                     </li>
                                 </ul>
                                 <p>{{ $post->description }}</p>
                                 <a href="{{ route('single_post_view', $post->id) }}" class="btn btn-outline-primary">Read
                                     More</a>
                             </div>
                         </article>
                     @endforeach
                     <div class="mt-5">
                         {{ $filter_posts->links('pagination::bootstrap-5') }}
                     </div>

                 </div>

                 <!---------------RIGHT BAR------------------>
                 @include('layouts.frontend.rightbar')

             </div>
         </div>
     </section>
 @endsection
