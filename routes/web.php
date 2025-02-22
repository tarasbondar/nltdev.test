<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function() {echo 'index';});

require __DIR__.'/auth.php';
