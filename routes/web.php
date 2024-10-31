<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChecklistController;

Route::get('/', [ChecklistController::class, 'index']);



Route::resource('checklists', ChecklistController::class);


