<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Event\Category\Create as EventCategoryCreate;
use App\Livewire\Event\Category\Edit as EventCategoryEdit;
use App\Livewire\Event\Category\Index as EventCategoryIndex;

use App\Livewire\Event\Featured\Create as EventFeaturedCreate;
use App\Livewire\Event\Featured\Edit as EventFeaturedEdit;
use App\Livewire\Event\Featured\Index as EventFeaturedIndex;
use App\Livewire\Event\Create as EventCreate;
use App\Livewire\Event\Edit as EventEdit;
use App\Livewire\Event\Index as EventIndex;
use App\Livewire\Admin\Account\Create as AccountCreate;
use App\Livewire\Admin\Account\Edit as AccountEdit;
use App\Livewire\Admin\Account\Index as AccountIndex;
use App\Livewire\Pass\Login as PassLogin;
use App\Livewire\Pass\Dashboard as PassDashboard;
use App\Livewire\Pass\Reset;
use App\Livewire\Pass\Cv;
use App\Livewire\Pass\Profile;


Route::prefix('/dashboard')->group(function () {
     Route::name('event.category.')->group(function () {
        Route::get('/event/categories', EventCategoryIndex::class)->name('index');            
        Route::get('/event/category/new', EventCategoryCreate::class)->name('create');   
        Route::get('/event/category/{slug}', EventCategoryEdit::class)->name('edit');    
    });
     Route::name('event.featured')->group(function () {
        Route::get('/event/featured', EventFeaturedIndex::class)->name('index');            
        Route::get('/event/featured/new', EventFeaturedCreate::class)->name('create');   
        Route::get('/event/featured/{slug}', EventFeaturedEdit::class)->name('edit');    
    });
    Route::name('event.')->group(function () {
        Route::get('/events', EventIndex::class)->name('index');            
        Route::get('/event/new', EventCreate::class)->name('create');   
        Route::get('/event/{slug}', EventEdit::class)->name('edit');    
    });
    Route::name('account.')->group(function () {
        Route::get('/accounts', AccountIndex::class)->name('index');            
        Route::get('/account/new', AccountCreate::class)->name('create');   
        Route::get('/account/{slug}', AccountEdit::class)->name('edit');    
    });
    
});

 Route::get('/login', PassLogin::class)->name('pass.login');   
 Route::get('/pass/dashboard', PassDashboard::class)->name('pass.dashboard');   
 Route::get('/pass/cv', Cv::class)->name('pass.cv');   
 Route::get('/pass/password-reset', Reset::class)->name('pass.reset');   
 Route::get('/pass/profile', Profile::class)->name('pass.profile');   