<?php

use App\Livewire\Users\UserIndex;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::group(['middleware'=>'auth'],function(){

    Route::view('dashboard', 'dashboard')->name('dashboard');
    Route::view('profile', 'profile')->name('profile');

    Route::get('users',UserIndex::class)->name('users.index');


});


require __DIR__.'/auth.php';
