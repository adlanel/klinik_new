<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\news;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Carbon\Carbon;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $news = news::orderBy('created_at', 'desc')->get();
        return view('admin.news.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.news.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'short_description' => 'nullable|string',
            'content' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'author' => 'nullable|string|max:100',
            'published_at' => 'nullable|date',
            'status' => 'required|in:draft,published,archived',
        ]);
        
        // Generate slug from title
        $slug = Str::slug($request->title);
        $baseSlug = $slug;
        $counter = 1;
        
        // Check if slug exists and generate a unique one
        while (news::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter++;
        }
        
        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            
            // Create directory if it doesn't exist
            $path = storage_path('app/public/homepage/news');
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            
            // Save the file directly
            $request->file('image')->move($path, $imageName);
            
            $validated['image'] = $imageName;
        }
        
        // Format published_at if provided
        $published_at = null;
        if (!empty($validated['published_at'])) {
            $published_at = Carbon::parse($validated['published_at']);
        }
        
        // Create a new news entry
        DB::table('news')->insert([
            'title' => $validated['title'],
            'slug' => $slug,
            'short_description' => $validated['short_description'] ?? null,
            'content' => $validated['content'] ?? null,
            'image' => $validated['image'] ?? null,
            'author' => $validated['author'] ?? null,
            'published_at' => $published_at,
            'status' => $validated['status'],
            'created_at' => now(),
            'updated_at' => now()
        ]);
        
        return redirect()->route('admin.content.news.index')
            ->with('success', 'Berita berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $news = news::findOrFail($id);
        return view('admin.news.edit', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $news = news::findOrFail($id);
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'short_description' => 'nullable|string',
            'content' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'author' => 'nullable|string|max:100',
            'published_at' => 'nullable|date',
            'status' => 'required|in:draft,published,archived',
        ]);
        
        // Generate slug from title if title has changed
        if ($news->title != $validated['title']) {
            $slug = Str::slug($validated['title']);
            $baseSlug = $slug;
            $counter = 1;
            
            // Check if slug exists and generate a unique one
            while (news::where('slug', $slug)->where('id', '!=', $id)->exists()) {
                $slug = $baseSlug . '-' . $counter++;
            }
            
            $news->slug = $slug;
        }
        
        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            
            // Create directory if it doesn't exist
            $path = storage_path('app/public/homepage/news');
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            
            // Delete old image if exists
            if ($news->image && File::exists($path . '/' . $news->image)) {
                File::delete($path . '/' . $news->image);
            }
            
            // Save the file
            $request->file('image')->move($path, $imageName);
            
            $news->image = $imageName;
        }
        
        // Update news
        $news->title = $validated['title'];
        $news->short_description = $validated['short_description'];
        $news->content = $validated['content'];
        $news->author = $validated['author'];
        $news->published_at = !empty($validated['published_at']) ? Carbon::parse($validated['published_at']) : null;
        $news->status = $validated['status'];
        $news->save();
        
        return redirect()->route('admin.content.news.index')
            ->with('success', 'Berita berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $news = news::findOrFail($id);
            
            // Delete image if exists
            if ($news->image) {
                $path = storage_path('app/public/homepage/news/' . $news->image);
                if (File::exists($path)) {
                    File::delete($path);
                }
            }
            
            // Delete the news entry
            $news->delete();
            
            return redirect()->route('admin.content.news.index')
                ->with('success', 'Berita berhasil dihapus!');
        } catch (\Exception $e) {
            Log::error('Error deleting news: ' . $e->getMessage());
            return redirect()->route('admin.content.news.index')
                ->with('error', 'Gagal menghapus berita. Error: ' . $e->getMessage());
        }
    }
}