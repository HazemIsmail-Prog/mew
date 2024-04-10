<?php

use App\Livewire\Contracts\ContractIndex;
use App\Livewire\Documents\DocumentIndex;
use App\Livewire\Stakeholders\StakeholderIndex;
use App\Livewire\Users\UserIndex;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('documents.index');
});

Route::group(['middleware' => 'auth'], function () {

    Route::view('profile', 'profile')->name('profile');

    Route::get('users', UserIndex::class)->name('users.index');
    Route::get('contracts', ContractIndex::class)->name('contracts.index');
    Route::get('stakeholders', StakeholderIndex::class)->name('stakeholders.index');
    Route::get('documents', DocumentIndex::class)->name('documents.index');
});


require __DIR__ . '/auth.php';
