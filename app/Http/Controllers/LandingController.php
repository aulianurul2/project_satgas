<?php

namespace App\Http\Controllers;

use App\Models\Media;

class LandingController extends Controller
{
    public function index()
    {
        $media = Media::latest()->take(6)->get();
        return view('landing.index', compact('media'));
    }
}
