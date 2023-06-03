@extends('layouts.app')

@section('title')
    Answer Section
@endsection

@section('mainsection')
    <!-- Answer section -->
    <div class="py-4"></div>
    <section class="section">
        <div class="container">
            <div class="row justify-content-center">
                <div class=" col-lg-9   mb-5 mb-lg-0">
                    <article>

                        <h5 class="h2">{{ $questions->question }}...</h5>
                        <ul class="card-meta list-inline mt-4">
                            <li class="list-inline-item">
                                <a href="#" class="card-meta-author">
                                    @if ($questions->user_image)
                                        <img src="{{ asset('backend/user_image/' . $questions->user_image) }}">
                                    @else
                                        <img src="{{ asset('backend/user_image/user.jpg') }}">
                                    @endif
                                    <span>{{ $questions->user_name }}</span>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <i class="ti-calendar"></i>
                                {{ date('d M Y', strtotime($questions->created_at)) }}
                            </li>
                            <li class="list-inline-item text-primary">
                                <i class="ti-bookmark"></i>
                                {{ $questions->category_name }}
                            </li>
                        </ul>

                    </article>

                </div>

                <div class="col-lg-9 col-md-12">
                    <div class="mb-5 border-top mt-4 pt-5">
                        <h3 class="mb-4">Answers</h3>

                        @if ($answers->count() > 0)
                            @foreach ($answers as $answer)
                                <div class="card card-body mt-4">
                                    <div class="media d-block d-sm-flex">
                                        <a class="d-inline-block mr-2 mb-3 mb-md-0" href="#">
                                            @if ($answer->user_image)
                                                <img style="height: 50px"
                                                    src="{{ asset('backend/user_image/' . $answer->user_image) }}">
                                            @else
                                                <img src="{{ asset('backend/user_image/user.jpg') }}">
                                            @endif
                                        </a>
                                        <div class="media-body">
                                            <div class="d-flex justify-content-between align-items-center mb-4">
                                                <span>
                                                    <a href="#!"
                                                        class="h4 d-inline-block mb-3">{{ $answer->user_name }}</a>
                                                    <small class="text-black-800 ml-2 font-weight-600">
                                                        {{ date('d M Y', strtotime($answer->created_at)) }}
                                                    </small>
                                                </span>



                                                @if ($answer->user_id == auth()->user()->id)
                                                    <form action="{{ route('answers_distroy', $answer->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="delete text-danger border-0 bg-white">
                                                            <i class="fas fa-trash"> </i>
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>

                                            <p>
                                                @php
                                                    echo $answer->answer;
                                                @endphp
                                            </p>
                                            <hr class="my-3">
                                            <div class="">

                                                @php
                                                    $likes = DB::table('question_answer_likes')
                                                        ->where('answer_id', $answer->id)
                                                        ->get();
                                                    
                                                    $liker_user = DB::table('question_answer_likes')
                                                        ->where('answer_id', $answer->id)
                                                        ->where('user_id', auth()->user()->id)->first();
                                                @endphp

                                                @if ($liker_user)
                                                    <a href="{{ route('quation_answers_unlike', $answer->id) }}">

                                                        <i class="fa fa-heart text-danger"></i>
                                                    </a>
                                                @else
                                                    <a href="{{ route('quation_answers_like', $answer->id) }}">
                                                        <i class="far fa-heart"></i>
                                                    </a>
                                                @endif

                                                <span class="ml-1">{{ count($likes) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p>No Answer Found</p>
                        @endif

                    </div>

                    <div>
                        <h3 class="mb-4 pt-4">Leave an answer</h3>

                        <form action="{{ route('answer_store', $questions->id) }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <textarea class="summernote form-control shadow-none" name="answer" rows="7"></textarea>
                            </div>

                            <button class="btn btn-primary" type="submit">Submit Answer</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
