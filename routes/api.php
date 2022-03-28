<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Lesson;

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

Route::get('lessons',function(){
    return Lesson::all();
});

Route::get('lessons/{id}',function($id){
    return Lesson::find($id);
});

Route::post('lessons',function(Request $request){
    return Lesson::create($request->all());
});

Route::put('lessons/{id}',function(Request $request, $id){
    $lesson = Lesson::findOrFail($id);
    $lesson->update($request->all());
    return $lesson;
});

Route::delete('lessons/{id}',function($id){
    Lesson::find($id)->delete();
    return 204;
});
