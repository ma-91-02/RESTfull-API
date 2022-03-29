<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\LessonController;
use App\Http\Controllers\API\RelationshipController;
use App\Http\Controllers\API\TagController;
use App\Http\Controllers\API\UserController;
use Illuminate\Support\Facades\Response;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => '/v1'], function () {

    Route::apiResource('lessons', LessonController::class);
    Route::apiResource('tags', TagController::class);
    Route::apiResource('users', UserController::class);
    Route::any('lesson', function () {
        $message = "please make sure to update your code to use the new version of our API";
        return Response::json(
            [
                'data' => $message,
                'link' => url('documentation/api'),
            ],
            404
        );
    });
    // Route::redirect('lesson','lessons');
    Route::get('users/{id}/lessons', [RelationshipController::class, 'userLessons']);
    Route::get('lessons/{id}/tags', [RelationshipController::class, 'lessonTags']);
    Route::get('tags/{id}/lessons', [RelationshipController::class, 'tagLessons']);
});


Route::domain('{account}.mypp.com')->group(function () {
    Route::get('user/{id}', function ($account, $id) {
        //
    });
});

Route::get('lessons/{lesson:slug}', function ($lesson) {
    return $lesson;
});

Route::fallback(function () {
    //
});
