<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\layanan;
use App\Models\Logo;

class ServiceController extends Controller
{
    /**
     * Display the service detail page.
     *
     * @param  string  $slug
     * @return \Illuminate\View\View
     */
    public function show($slug)
    {
        // Get the service by slug
        $service = layanan::getBySlug($slug);
        
        // If service not found, abort 404
        if (!$service) {
            abort(404);
        }
        
        // Get the current logo for the navbar
        $currentLogo = Logo::getCurrentLogo();
        
        // Get other services for "Other Services" section
        $otherServices = layanan::where('id', '!=', $service->id)
            ->where('status', 'active')
            ->limit(3)
            ->get();
        
        return view('pages.service-detail', compact('service', 'currentLogo', 'otherServices'));
    }
}