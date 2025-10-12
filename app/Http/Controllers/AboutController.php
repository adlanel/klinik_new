<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AboutUs;
use App\Models\AboutSection;

class AboutController extends Controller
{
    /**
     * Display the "About Us" page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Get about section data
        $aboutSection = AboutSection::first();
        
        // Get additional about us content
        $aboutUs = AboutUs::all();
        
        return view('about.index', compact('aboutSection', 'aboutUs'));
    }
}