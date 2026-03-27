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

use App\Livewire\Event\Activity\Category\Create as ActivityCategoryCreate;
use App\Livewire\Event\Activity\Category\Edit as ActivityCategoryEdit;
use App\Livewire\Event\Activity\Category\Index as ActivityCategoryIndex;

use App\Livewire\Event\Activity\Featured\Create as ActivityFeaturedCreate;
use App\Livewire\Event\Activity\Featured\Edit as ActivityFeaturedEdit;
use App\Livewire\Event\Activity\Featured\Index as ActivityFeaturedIndex;

use App\Livewire\Event\Activity\List\Create as ActivityListCreate;
use App\Livewire\Event\Activity\List\Edit as ActivityListEdit;
use App\Livewire\Event\Activity\List\Index as ActivityListIndex;


use App\Livewire\Admin\Account\Create as AccountCreate;
use App\Livewire\Admin\Account\Edit as AccountEdit;
use App\Livewire\Admin\Account\Index as AccountIndex;

use App\Livewire\Admin\Faq\Create as FaqCreate;
use App\Livewire\Admin\Faq\Edit as FaqEdit;
use App\Livewire\Admin\Faq\Index as FaqIndex;


use App\Livewire\Event\Partner\Create as PartnerCreate;
use App\Livewire\Event\Partner\Edit as PartnerEdit;
use App\Livewire\Event\Partner\Index as PartnerIndex;

use App\Livewire\Event\Slider\Create as SliderCreate;
use App\Livewire\Event\Slider\Edit as SliderEdit;
use App\Livewire\Event\Slider\Index as SliderIndex;

use App\Livewire\Admin\Account\Details\Create as DetailsCreate;
use App\Livewire\Admin\Account\Details\Edit as DetailsEdit;
use App\Livewire\Admin\Account\Details\Index as DetailsIndex;

use App\Livewire\Event\Admin\Account\Create as AdminAccountCreate;
use App\Livewire\Event\Admin\Account\Edit as AdminAccountEdit;
use App\Livewire\Event\Admin\Account\Index as AdminAccountIndex;

use App\Livewire\Admin\Testimonial\Create as TestimonialCreate;
use App\Livewire\Admin\Testimonial\Edit as TestimonialEdit;
use App\Livewire\Admin\Testimonial\Index as TestimonialIndex;

use App\Livewire\Admin\Auth\Signin as AdminSignin;

use App\Http\Controllers\PageController;
use App\Http\Middleware\Authenticate;

Route::get('/dashboard/signin', AdminSignin::class)->name('admin.signin');
Route::prefix('/dashboard')->middleware(Authenticate::class)->group(function () {
    Route::name('event.category.')->group(function () {
        Route::get('/event/categories', EventCategoryIndex::class)->name('index');            
        Route::get('/event/category/new', EventCategoryCreate::class)->name('create');   
        Route::get('/event/category/{slug}', EventCategoryEdit::class)->name('edit');    
    });
    

     Route::name('event.featured.')->group(function () {
        Route::get('/event/featured', EventFeaturedIndex::class)->name('index');            
        Route::get('/event/featured/new', EventFeaturedCreate::class)->name('create');   
        Route::get('/event/featured/{slug}', EventFeaturedEdit::class)->name('edit');    
    });
    Route::name('event.')->group(function () {
        Route::get('/events', EventIndex::class)->name('index');            
        Route::get('/event/new', EventCreate::class)->name('create');   
        Route::get('/event/{slug}', EventEdit::class)->name('edit');    
    });

    Route::name('activity.category.')->group(function () {
        Route::get('/activity/categories', ActivityCategoryIndex::class)->name('index');            
        Route::get('/activity/category/new', ActivityCategoryCreate::class)->name('create');   
        Route::get('/activity/category/{slug}', ActivityCategoryEdit::class)->name('edit');    
    });
    Route::name('activity.featured.')->group(function () {
        Route::get('/activity/features', ActivityFeaturedIndex::class)->name('index');            
        Route::get('/activity/featured/new', ActivityFeaturedCreate::class)->name('create');   
        Route::get('/activity/featured/{slug}', ActivityFeaturedEdit::class)->name('edit');    
    });


    Route::name('activity.list.')->group(function () {
        Route::get('/activities', ActivityListIndex::class)->name('index');            
        Route::get('/activity/new', ActivityListCreate::class)->name('create');   
        Route::get('/activity/{slug}', ActivityListEdit::class)->name('edit');    
    });

     Route::name('ticket.account.')->group(function () {
        Route::get('/ticket/accounts', AdminAccountIndex::class)->name('index');            
        Route::get('/ticket/account/new', AdminAccountCreate::class)->name('create');   
        Route::get('/ticket/account/{slug}', AdminAccountEdit::class)->name('edit');    
    });
     Route::name('account.')->group(function () {
        Route::get('/accounts', AccountIndex::class)->name('index');            
        Route::get('/account/new', AccountCreate::class)->name('create');   
        Route::get('/account/{slug}', AccountEdit::class)->name('edit');    
    });

    


    Route::name('account.details.')->group(function () {
        Route::get('/account/details', DetailsIndex::class)->name('index');            
        Route::get('/account/details/new', DetailsCreate::class)->name('create');   
        Route::get('/account/details/{slug}', DetailsEdit::class)->name('edit');    
    });
   
    Route::name('faq.')->group(function () {
        Route::get('/faqs', FaqIndex::class)->name('index');            
        Route::get('/faq/new', FaqCreate::class)->name('create');   
        Route::get('/faq/{slug}', FaqEdit::class)->name('edit');    
    });

    Route::name('partner.')->group(function () {
        Route::get('/partners', PartnerIndex::class)->name('index');            
        Route::get('/partner/new', PartnerCreate::class)->name('create');   
        Route::get('/partner/{slug}', PartnerEdit::class)->name('edit');    
    });

    Route::name('slider.')->group(function () {
        Route::get('/sliders', SliderIndex::class)->name('index');            
        Route::get('/slider/new', SliderCreate::class)->name('create');   
        Route::get('/slider/{slug}', sliderEdit::class)->name('edit');    
    });

    Route::name('testimonial.')->group(function () {
        Route::get('/testimonials', TestimonialIndex::class)->name('index');            
        Route::get('/testimonial/new', TestimonialCreate::class)->name('create');   
        Route::get('/testimonial/{slug}', TestimonialEdit::class)->name('edit');    
    });
    
    
});
Route::controller(PageController::class)->group(function(){
    Route::get('/','index')->name('ticket.index');   
    Route::get('/foryou','foryou')->name('ticket.foryou');   
    Route::get('/confirmation/{slug}','confirmation')->name('ticket.confirmation');   
    Route::get('/ticket/{reference}','ticket')->name('event.ticket');   
    Route::get('/{slug}', 'details')->name('ticket.details');
});  
   
