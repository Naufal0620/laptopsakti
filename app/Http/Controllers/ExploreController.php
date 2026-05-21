<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class ExploreController extends Controller
{
    /**
     * Display the video exploration feed.
     */
    public function index()
    {
        // Get ready videos with their associated products in random order
        $videos = Video::with('product')
            ->where('status', 'ready')
            ->inRandomOrder()
            ->get();

        return view('explore.index', compact('videos'));
    }
}
