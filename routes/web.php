<?php

use App\Jobs\PostsEmailJob;
use App\Jobs\SendEmailJob;
use App\Mail\PostsEmail;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Faker\Factory as Faker;
use Illuminate\Support\Facades\Mail;

Route::get('/', function () {
    abort(404);
    return view('welcome');
});

// trial to send email
Route::get('test/send-email', function () {
    $faker = Faker::create('en_EN');

    for ($i = 0; $i < 100; $i++) {
        $sendMail = $faker->email;
        dispatch(new SendEmailJob($sendMail));
    }

    return [
        'status' => 1,
        'message' => 'success'
    ];
});
