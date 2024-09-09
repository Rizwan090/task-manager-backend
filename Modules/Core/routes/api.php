<?php

use Illuminate\Support\Facades\Route;

// Define your Core module routes here
Route::get('/core-test', function () {
    return response()->json(['message' => 'Core module route working']);
});
