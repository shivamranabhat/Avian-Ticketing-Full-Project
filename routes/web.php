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

use App\Livewire\Admin\Content\Create as ContentCreate;
use App\Livewire\Admin\Content\Edit as ContentEdit;
use App\Livewire\Admin\Content\Index as ContentIndex;


use App\Livewire\Event\Partner\Create as PartnerCreate;
use App\Livewire\Event\Partner\Edit as PartnerEdit;
use App\Livewire\Event\Partner\Index as PartnerIndex;

use App\Livewire\Event\Slider\Create as SliderCreate;
use App\Livewire\Event\Slider\Edit as SliderEdit;
use App\Livewire\Event\Slider\Index as SliderIndex;


use App\Livewire\Admin\Auth\Signin as AdminSignin;
use App\Livewire\Admin\Slug\Create as SlugCreate;
use App\Livewire\Admin\Slug\Edit as SlugEdit;
use App\Livewire\Admin\Slug\Index as SlugIndex;

use App\Livewire\Admin\Script\Create as ScriptCreate;
use App\Livewire\Admin\Script\Edit as ScriptEdit;
use App\Livewire\Admin\Script\Index as ScriptIndex;

use App\Livewire\Admin\Tag\Create as TagCreate;
use App\Livewire\Admin\Tag\Edit as TagEdit;
use App\Livewire\Admin\Tag\Index as TagIndex;

use App\Livewire\Admin\OpenGraph\Create as OpenGraphCreate;
use App\Livewire\Admin\OpenGraph\Edit as OpenGraphEdit;
use App\Livewire\Admin\OpenGraph\Index as OpenGraphIndex;

use App\Livewire\Admin\Twitter\Create as TwitterCreate;
use App\Livewire\Admin\Twitter\Edit as TwitterEdit;
use App\Livewire\Admin\Twitter\Index as TwitterIndex;


use App\Http\Controllers\PageController;
use App\Http\Middleware\Authenticate;

Route::get('/dashboard/signin', AdminSignin::class)->name('admin.signin');
Route::prefix('/dashboard')->middleware(Authenticate::class)->group(function () {
    Route::name('content.')->group(function () {
        Route::get('/contents', ContentIndex::class)->name('index');
        Route::get('/content/new', ContentCreate::class)->name('create');
        Route::get('/content/{slug}', ContentEdit::class)->name('edit');
    });
    
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


        Route::name('slug.')->group(function () {
        Route::get('/seo/slugs', SlugIndex::class)->name('index');            
        Route::get('/seo/slug/new', SlugCreate::class)->name('create');   
        Route::get('/seo/slug/{slug}', SlugEdit::class)->name('edit');    
    });
    Route::name('script.')->group(function () {
        Route::get('/seo/scripts', ScriptIndex::class)->name('index');            
        Route::get('/seo/script/new', ScriptCreate::class)->name('create');   
        Route::get('/seo/script/{slug}', ScriptEdit::class)->name('edit');    
    });
     Route::name('tag.')->group(function () {
        Route::get('/seo/tags', TagIndex::class)->name('index');            
        Route::get('/seo/tag/new', TagCreate::class)->name('create');   
        Route::get('/seo/tag/{slug}', TagEdit::class)->name('edit');    
    });
     Route::name('graph.')->group(function () {
        Route::get('/seo/open-graph', OpenGraphIndex::class)->name('index');            
        Route::get('/seo/open-graph/new', OpenGraphCreate::class)->name('create');   
        Route::get('/seo/open-graph/{slug}', OpenGraphEdit::class)->name('edit');    
    });

    Route::name('card.')->group(function () {
        Route::get('/seo/twitter-cards', TwitterIndex::class)->name('index');            
        Route::get('/seo/twitter-card/new', TwitterCreate::class)->name('create');   
        Route::get('/seo/twitter-card/{slug}', TwitterEdit::class)->name('edit');    
    });

    
    
});
Route::controller(PageController::class)->group(function(){
    Route::get('/','index')->name('ticket.index');   
    Route::get('/foryou','foryou')->name('ticket.foryou');   
    Route::get('/activities','activities')->name('ticket.activities');   
    Route::get('/event-confirmation/{slug}','confirmation')->name('event.confirmation');   
    Route::get('/activity-confirmation/{slug}','activityConfirmation')->name('activity.confirmation');   
    Route::get('/activity-ticket/{reference}','activityTicket')->name('activity.ticket');   
    Route::get('/event-ticket/{reference}','eventTicket')->name('event.ticket');   
    Route::get('/activity/{slug}', 'activity')->name('activity.details');
    Route::get('/event/{slug}', 'details')->name('ticket.details');
});  
   