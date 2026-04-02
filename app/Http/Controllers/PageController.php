<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Str;
use App\Models\Tag;
use App\Models\Script;
use App\Models\TwitterCard;
use App\Models\OpenGraph;
use App\Models\Page;
use App\Models\Details;
use App\Models\Slug;

class PageController extends Controller
{
    private function getSeo()
    {
        $slug = request()->segment(1);
        $page = Page::whereSlug($slug)->first();
        $page_id = $page->id;
        $meta_tags = Tag::where('page_id',$page_id)->orWhere('slug','all')->first();
        //script for header
        $scriptHeader = Script::where(function ($query) {
            $query->where('position', 'header')
                ->where('page_id', 1);
        })->orWhere(function ($query) use ($page_id) {
            $query->where('position', 'header')
                ->whereHas('page', function ($query) use ($page_id) {
                    $query->where('page_id', $page_id);
                });
        })->orderBy('created_at', 'asc')->get();
        //open graph 
        $openGraph = OpenGraph::where(function ($query) {
            $query->where('page_id', 1);
        })->orWhere(function ($query) use ($page_id) {
            $query->whereHas('page', function ($query) use ($page_id) {
                    $query->where('page_id', $page_id);
                });
        })->orderBy('created_at', 'asc')->get();

        //twitter card 
        $twitterCard = TwitterCard::where(function ($query) {
            $query->where('page_id', 1);
        })->orWhere(function ($query) use ($page_id) {
            $query->whereHas('page', function ($query) use ($page_id) {
                    $query->where('page_id', $page_id);
                });
        })->orderBy('created_at', 'asc')->get();

        //script for footer
        $scriptFooter = Script::where(function ($query) {
            $query->where('position', 'footer')
                ->where('page_id', 1);
        })->orWhere(function ($query) use ($page_id) {
            $query->where('position', 'footer')
                ->whereHas('page', function ($query) use ($page_id) {
                    $query->where('page_id', $page_id);
                });
        })->orderBy('created_at', 'asc')->get();
        return compact('scriptHeader','scriptFooter','openGraph','twitterCard','meta_tags');
    }

    private function getDetailsSeo()
    {
        $slug = request()->segment(2);
        $page = Page::whereSlug($slug)->first();
        if($page)
        {
            $page_id = $page->id;
        }
        else{
            $page = Slug::where('page_slug',$slug)->first();
            $page_id = $page ? $page->page_id : 1;
        }
        $meta_tags = Tag::where('page_id',$page_id)->orWhere('slug','all')->first();
        //script for header
        $scriptHeader = Script::where(function ($query) {
            $query->where('position', 'header')
                ->where('page_id', 1);
        })->orWhere(function ($query) use ($page_id) {
            $query->where('position', 'header')
                ->whereHas('page', function ($query) use ($page_id) {
                    $query->where('page_id', $page_id);
                });
        })->orderBy('created_at', 'asc')->get();
        //open graph
        $openGraph = OpenGraph::where(function ($query) {
            $query->where('page_id', 1);
        })->orWhere(function ($query) use ($page_id) {
            $query->whereHas('page', function ($query) use ($page_id) {
                    $query->where('page_id', $page_id);
                });
        })->orderBy('created_at', 'asc')->get();
        //twitter card
        $twitterCard = TwitterCard::where(function ($query) {
            $query->where('page_id', 1);
        })->orWhere(function ($query) use ($page_id) {
            $query->whereHas('page', function ($query) use ($page_id) {
                    $query->where('page_id', $page_id);
                });
        })->orderBy('created_at', 'asc')->get();


        //script for footer
        $scriptFooter = Script::where(function ($query) {
            $query->where('position', 'footer')
                ->where('page_id', 1);
        })->orWhere(function ($query) use ($page_id) {
            $query->where('position', 'footer')
                ->whereHas('page', function ($query) use ($page_id) {
                    $query->where('page_id', $page_id);
                });
        })->orderBy('created_at', 'asc')->get();
        
        
        return compact('scriptHeader','scriptFooter','openGraph','twitterCard','meta_tags');
    }

   public function index()
    {
        $meta_tags = Tag::where('page_id', 1)->orWhere('page_id',2)->first();
        //script for header
        $scriptHeader = Script::where(function ($query) {
            $query->where('position', 'header')
                ->where('page_id', 1);
        })->orWhere(function ($query) {
            $query->where('position', 'header')
                ->where('page_id', 2);
        })->orderBy('created_at', 'asc')->get();

        //open graph
        $openGraph = OpenGraph::where(function ($query) {
            $query->where('page_id', 1);
        })->orWhere(function ($query) {
            $query->where('page_id', 2);
        })->orderBy('created_at', 'asc')->get();

        //twitter card
        $twitterCard = TwitterCard::where(function ($query) {
            $query->where('page_id', 1);
        })->orWhere(function ($query) {
            $query->where('page_id', 2);
        })->orderBy('created_at', 'asc')->get();

        //script for footer
        $scriptFooter = Script::where(function ($query) {
            $query->where('position', 'footer')
                ->where('page_id', 1);
        })->orWhere(function ($query) {
            $query->where('position', 'footer')
                ->where('page_id', 2);
        })->orderBy('created_at', 'asc')->get();
      

        return view('pages.index',compact('meta_tags','scriptHeader','openGraph','twitterCard','scriptFooter'));
    }

    public function foryou()
    {
        return view('pages.foryou',$this->getSeo());
    }
    public function activities()
    {
        return view('pages.activities',$this->getSeo());
    }
    public function activity($slug)
    {
        return view('pages.activity',compact('slug'),$this->getDetailsSeo());
    }
    public function details($slug)
    {
        return view('pages.details',compact('slug'),$this->getDetailsSeo());
    }
    public function activityConfirmation($slug)
    {
        return view('pages.activity-confirmation',compact('slug'),$this->getDetailsSeo());
    }
    public function confirmation($slug)
    {
        return view('pages.confirmation',compact('slug'),$this->getDetailsSeo());
    }
    public function eventTicket($reference)
    {
        return view('pages.event-ticket',compact('reference'),$this->getDetailsSeo());
    }
    public function activityTicket($reference)
    {
        return view('pages.activity-ticket',compact('reference'),$this->getDetailsSeo());
    }
}
