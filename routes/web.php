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

use App\Livewire\Admin\Account\Details\Create as DetailsCreate;
use App\Livewire\Admin\Account\Details\Edit as DetailsEdit;
use App\Livewire\Admin\Account\Details\Index as DetailsIndex;

use App\Livewire\Admin\Auth\Signin as AdminSignin;

use App\Livewire\Pass\Login as PassLogin;
use App\Livewire\Pass\Dashboard as PassDashboard;
use App\Livewire\Pass\Reset;
use App\Livewire\Pass\Cv;
use App\Livewire\Pass\Index;
use App\Livewire\Pass\Profile;
use App\Livewire\Pass\Social;
use App\Livewire\Pass\Business;
use App\Livewire\Pass\Details;
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\UserAuth;

Route::get('/dashboard/signin', AdminSignin::class)->name('admin.signin');
Route::prefix('/dashboard')->middleware(Authenticate::class)->group(function () {
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
    Route::name('account.details.')->group(function () {
        Route::get('/account/details', DetailsIndex::class)->name('index');            
        Route::get('/account/details/new', DetailsCreate::class)->name('create');   
        Route::get('/account/details/{slug}', DetailsEdit::class)->name('edit');    
    });
    Route::name('account.')->group(function () {
        Route::get('/accounts', AccountIndex::class)->name('index');            
        Route::get('/account/new', AccountCreate::class)->name('create');   
        Route::get('/account/{slug}', AccountEdit::class)->name('edit');    
    });
    
    
});

 Route::get('/', Index::class)->name('pass.index');   
 Route::get('/login', PassLogin::class)->name('pass.login');  
 Route::prefix('/pass')->middleware(UserAuth::class)->group(function () {
    Route::get('/dashboard', PassDashboard::class)->name('pass.dashboard');   
    Route::get('/cv', Cv::class)->name('pass.cv');   
    Route::get('/password-reset', Reset::class)->name('pass.reset');   
    Route::get('/profile', Profile::class)->name('pass.profile');   
    Route::get('/social', Social::class)->name('pass.social');   
    Route::get('/business', Business::class)->name('pass.business');   
});
 Route::get('/pass/{slug}', Details::class)->name('pass.details');    