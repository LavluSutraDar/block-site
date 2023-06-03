<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\ContuctController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\Admin\MessageController;
use App\Models\ContuctMessage;
use Illuminate\Mail\Mailables\Content;
use Symfony\Component\Translation\MessageCatalogue;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [UserController::class, 'index']);

Route::get('/post/{id}', [UserController::class, 'single_post_view'])->name('single_post_view');

 Route::get('/post/category/{category_id}', [UserController::class, 'filter_by_category'])->name('filter_by_category');

  Route::group(['middleware' => 'auth'], function () {

    Route::post('/post/comment/{comment_id}', [UserController::class, 'post_comment'])->name('post_comment');

    //quation start
    Route::get('/quation', [UserController::class , 'quation_ans'])->name('quation_ans');
    Route::post('/quation/store', [UserController::class, 'quation_store'])->name('quation_store');
    Route::delete('/quation/distroy/{id}', [UserController::class, 'quation_distroy'])
    ->name('quation_distroy');

    //ANSWER SECTION 
    Route::get('questions/answers/{id}', [AnswerController::class, 'answer'])->name('answer');
    Route::post('answers/store/{id}', [AnswerController::class, 'answer_store'])->name('answer_store');

    Route::delete('/answers/distroy/{id}', [AnswerController::class, 'answers_distroy'])
    ->name('answers_distroy');

    Route::get('/quations/answers/like/{id}', [AnswerController::class, 'quation_answers_like'])
    ->name('quation_answers_like');

    Route::get('/quations/answers/unlike/{id}', [AnswerController::class, 'quation_answers_unlike'])
    ->name('quation_answers_unlike');

    //CONTUCT ECTION 
    Route::get('/contuct', [ContuctController::class, 'contuct'])->name('contuct');

    Route::post('/contuct/message', [ContuctController::class, 'contuct_message'])->name('contuct_message');

    //ABOUT SECTION

    Route::get('/about', [AboutController::class, 'about'])->name('about');

 });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

//ADMIN ROUTE
/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::get('/admin/login', [AuthenticatedSessionController::class, 'create'])
    ->name('admin.login')->middleware('guest:admin');

Route::post('/admin/login/store', [AuthenticatedSessionController::class, 'store'])
    ->name('admin.login.store');

Route::group(['middleware' => 'admin'], function () {

    Route::get('/admin', [HomeController::class, 'index'])
        ->name('admin.dashboard');

    Route::post('/admin/logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('admin.logout');

    // CATEGORY ROUTE
    Route::resource('/admin/category', CategoryController::class);

    // POST ROUTE
    Route::resource('/admin/post', PostController::class);

    Route::resource('/admin/contuct/messages', MessageController::class);
});



