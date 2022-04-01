<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\WebsiteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware([
    'auth:api'
])->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'prefix' => '/v1',
    'middleware' => [],
    "namespace" => 'API',
], function () {
    Route::group([
        'prefix' => 'websites',
        "namespace" => 'Websites',
    ], function () {
        Route::post('/registration', [WebsiteController::class, 'registration']);
    });

    Route::group([
        'prefix' => 'posts',
        "namespace" => 'Posts',
    ], function () {
        Route::post('/store', [PostController::class, 'store']);
    });

    Route::group([
        'prefix' => '/subscribe',
        "namespace" => 'Subscribe',
    ], function () {
        Route::post('/store', [SubscriberController::class, 'store']);
        Route::post('/delete', [SubscriberController::class, 'delete']);
    });
});

Route::any('{any}', function () {
    return response()->json([
        'status' => false,
        'messasge' => 'Error 404'
    ], 404);
})->where('any', '.*');
