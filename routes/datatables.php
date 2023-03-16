<?php


use App\Http\Controllers\PermissionsController;
use Illuminate\Support\Facades\Route;


Route::get('/permission-list', [PermissionsController::class, 'browse']);
