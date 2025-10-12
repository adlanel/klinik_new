<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\news;
use App\Models\Logo;

class NewsController extends Controller
{
    /**
     * Display a listing of the news.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = news::where('status', 'published')
                    ->orderBy('published_at', 'desc')
                    ->paginate(9);
        
        $currentLogo = Logo::getCurrentLogo();
        
        return view('pages.news-index', compact('news', 'currentLogo'));
    }

    /**
     * Display the specified news article.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $newsItem = news::where('slug', $slug)
                        ->where('status', 'published')
                        ->firstOrFail();
        
        $relatedNews = news::where('id', '!=', $newsItem->id)
                           ->where('status', 'published')
                           ->inRandomOrder()
                           ->take(6)
                           ->get();
        
        $currentLogo = Logo::getCurrentLogo();
        
        return view('pages.news-detail', compact('newsItem', 'relatedNews', 'currentLogo'));
    }
}