<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\AboutUs;
use App\Models\layanan;
use App\Models\news;
use App\Models\testimoni;
use App\Models\Logo;
use App\Models\Cabang;
use Illuminate\Support\Facades\Artisan;

class HomeController extends Controller
{
    /**
     * Show the application homepage.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Ensure storage is linked (you can remove this in production after setup)
        if (!file_exists(public_path('storage'))) {
            try {
                Artisan::call('storage:link');
            } catch (\Exception $e) {
                // Log the error but continue
                \Log::error('Unable to create storage symlink: ' . $e->getMessage());
            }
        }
        
        // Get slider images from database
        $sliders = Banner::getAllOrdered();
        
        // Get the current logo
        $currentLogo = Logo::getCurrentLogo();
        
        // Get about section data
        $aboutSection = AboutUs::getFirstOrDefault();
        
        // Get active services
        $services = layanan::getAllActive();
        
        // Get published news
        $news = news::where('status', 'published')
                    ->orderBy('published_at', 'desc')
                    ->take(6)
                    ->get();
                    
        // Get active testimonials
        $testimonials = testimoni::active()->ordered()->get();
        
        // Check if there are old input values or validation errors and scroll to form
        $scrollToConsultation = session()->has('errors') || session()->hasOldInput('patient_name');
        
        // Get all branches for the consultation form
        $branches = Cabang::getAllBranches();
        
        return view('beranda', compact('sliders', 'currentLogo', 'aboutSection', 'services', 'news', 'testimonials', 'scrollToConsultation', 'branches'));
    }
}