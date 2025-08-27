<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/teachers', function () {
    $teachers = \App\Models\Teacher::all()->map(function ($t) {
        $t->image_url = asset('storage/' . $t->image); // Example
        return $t;
    });
    return response()->json($teachers);
});
