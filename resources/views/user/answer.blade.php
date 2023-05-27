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

            <h1 class="h2">Your question here...</h1>
            <ul class="card-meta list-inline mt-4">
              <li class="list-inline-item">
                <a href="#" class="card-meta-author">
                  <img src="images/john-doe.jpg">
                  <span>Charls Xaviar</span>
                </a>
              </li>
              <li class="list-inline-item">
                <i class="ti-calendar"></i>14 jan, 2020
              </li>
              <li class="list-inline-item text-primary">
                <i class="ti-bookmark"></i>Programming
              </li>
            </ul>

          </article>

        </div>

        <div class="col-lg-9 col-md-12">
          <div class="mb-5 border-top mt-4 pt-5">
            <h3 class="mb-4">Answers</h3>

            <div class="card card-body mt-4">
              <div class="media d-block d-sm-flex">
                <a class="d-inline-block mr-2 mb-3 mb-md-0" href="#">
                  <img src="images/post/user-01.jpg" class="mr-3 avater" alt="">
                </a>
                <div class="media-body">
                  <div class="d-flex justify-content-between align-items-center mb-4">
                    <span>
                      <a href="#!" class="h4 d-inline-block mb-3">Alexender Grahambel</a>
                      <small class="text-black-800 ml-2 font-weight-600">April 18, 2020 at 6.25 pm</small>
                    </span>
                    <button class="text-danger border-0 bg-white"> <i class="fas fa-trash"></i> </button>
                  </div>

                  <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras
                    purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi
                    vulputate fringilla. Donec lacinia congue felis in faucibus.</p>
                  <hr class="my-3">
                  <div class="">
                    <i class="far fa-heart"></i>
                    <span class="ml-1">(10)</span>
                  </div>
                </div>
              </div>
            </div>

            <div class="card card-body mt-4">
              <div class="media d-block d-sm-flex">
                <a class="d-inline-block mr-2 mb-3 mb-md-0" href="#">
                  <img src="images/post/user-01.jpg" class="mr-3 avater" alt="">
                </a>
                <div class="media-body">
                  <a href="#!" class="h4 d-inline-block mb-3">Alexender Grahambel</a>
                  <small class="text-black-800 ml-2 font-weight-600">April 18, 2020 at 6.25 pm</small>

                  <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras
                    purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi
                    vulputate fringilla. Donec lacinia congue felis in faucibus.</p>
                  <hr class="my-3">
                  <div class="">
                    <i class="fas fa-heart text-danger"></i>
                    <span class="ml-1">(9)</span>
                  </div>
                </div>
              </div>
            </div>

          </div>

          <div>
            <h3 class="mb-4 pt-4">Leave an answer</h3>

            <form method="POST">

              <div class="form-group">
                <textarea class="form-control shadow-none" name="answer" rows="7" required></textarea>
              </div>

              <button class="btn btn-primary" type="submit">Submit Answer</button>
            </form>
          </div>
        </div>

      </div>
    </div>
  </section>
@endsection