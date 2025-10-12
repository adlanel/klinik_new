<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fasilitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class FasilitasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $facilities = Fasilitas::orderBy('created_at', 'desc')->get();
        return view('admin.fasilitas.index', compact('facilities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.fasilitas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'status' => 'required|in:active,inactive',
        ]);
        
        // Generate slug from title
        $slug = Str::slug($request->title);
        $baseSlug = $slug;
        $counter = 1;
        
        // Check if slug exists and generate a unique one
        while (Fasilitas::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter++;
        }
        
        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            
            // Create directory if it doesn't exist
            $path = storage_path('app/public/homepage/fasilitas');
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            
            // Save the file directly
            $request->file('image')->move($path, $imageName);
            
            $validated['image'] = $imageName;
        }
        
        // Create a new facility via direct SQL query to ensure proper ID handling
        DB::table('fasilitas')->insert([
            'title' => $validated['title'],
            'slug' => $slug,
            'short_description' => $validated['short_description'] ?? null,
            'description' => $validated['description'] ?? null,
            'image' => $validated['image'] ?? null,
            'status' => $validated['status'],
            'created_at' => now(),
            'updated_at' => now()
        ]);
        
        return redirect()->route('admin.content.fasilitas.index')
            ->with('success', 'Fasilitas berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $fasilitas = Fasilitas::findOrFail($id);
        return view('admin.fasilitas.edit', compact('fasilitas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $fasilitas = Fasilitas::findOrFail($id);
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'status' => 'required|in:active,inactive',
        ]);
        
        // Update slug only if title changed
        if ($fasilitas->title !== $validated['title']) {
            $slug = Str::slug($validated['title']);
            $baseSlug = $slug;
            $counter = 1;
            
            // Check if slug exists and generate a unique one
            while (Fasilitas::where('slug', $slug)->where('id', '!=', $id)->exists()) {
                $slug = $baseSlug . '-' . $counter++;
            }
            
            $fasilitas->slug = $slug;
        }
        
        // Handle image upload
        if ($request->hasFile('image')) {
            // Create directory if it doesn't exist
            $path = storage_path('app/public/homepage/fasilitas');
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            
            // Delete old image if exists
            if ($fasilitas->image && file_exists("$path/{$fasilitas->image}")) {
                unlink("$path/{$fasilitas->image}");
            }
            
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            
            // Save the file directly
            $request->file('image')->move($path, $imageName);
            
            $fasilitas->image = $imageName;
        }
        
        // Update fields
        $fasilitas->title = $validated['title'];
        $fasilitas->short_description = $validated['short_description'] ?? null;
        $fasilitas->description = $validated['description'] ?? null;
        $fasilitas->status = $validated['status'];
        $fasilitas->save();
        
        return redirect()->route('admin.content.fasilitas.index')
            ->with('success', 'Fasilitas berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $fasilitas = Fasilitas::findOrFail($id);
        
        // Delete image if exists
        if ($fasilitas->image) {
            $path = storage_path('app/public/homepage/fasilitas');
            if (file_exists("$path/{$fasilitas->image}")) {
                unlink("$path/{$fasilitas->image}");
            }
        }
        
        $fasilitas->delete();
        
        return redirect()->route('admin.content.fasilitas.index')
            ->with('success', 'Fasilitas berhasil dihapus!');
    }
}