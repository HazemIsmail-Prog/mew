<?php

use App\Livewire\Contracts\ContractIndex;
use App\Livewire\Stakeholders\StakeholderIndex;
use App\Livewire\Users\UserIndex;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::group(['middleware'=>'auth'],function(){

    Route::view('dashboard', 'dashboard')->name('dashboard');
    Route::view('profile', 'profile')->name('profile');

    Route::get('users',UserIndex::class)->name('users.index');
    Route::get('contracts',ContractIndex::class)->name('contracts.index');
    Route::get('stakeholders',StakeholderIndex::class)->name('stakeholders.index');


});


require __DIR__.'/auth.php';
