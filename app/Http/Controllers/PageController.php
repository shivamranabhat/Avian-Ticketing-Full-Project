<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        return view('pages.index');
    }
    public function foryou()
    {
        return view('pages.foryou');
    }
    public function details($slug)
    {
        return view('pages.details',compact('slug'));
    }
    public function confirmation($slug)
    {
        return view('pages.confirmation',compact('slug'));
    }
    public function ticket($reference)
    {
        return view('pages.ticket',compact('reference'));
    }
}
