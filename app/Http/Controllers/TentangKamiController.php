<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AboutUs;

class TentangKamiController extends Controller
{
    /**
     * Display the Tentang Kami page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aboutSection = AboutUs::getFirstOrDefault();
        
        return view('pages.tentang-kami', compact('aboutSection'));
    }
}