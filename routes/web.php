<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json(["message"=>'Please use the correct endpoint'],400);
});
