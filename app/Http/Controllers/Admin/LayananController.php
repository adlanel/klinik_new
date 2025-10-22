<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Layanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class LayananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $layanan = Layanan::orderBy('created_at', 'desc')->paginate(5);
        return view('admin.layanan.index', compact('layanan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.layanan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'harga_reguler_weekday' => 'nullable|numeric|min:0',
            'harga_paket_weekday' => 'nullable|numeric|min:0',
            'harga_reguler_weekend' => 'nullable|numeric|min:0',
            'harga_paket_weekend' => 'nullable|numeric|min:0',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'status' => 'required|in:active,inactive',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.content.layanan.create')
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // Generate slug from title
            $slug = Str::slug($request->title);
            
            // Check if slug already exists
            $count = Layanan::where('slug', $slug)->count();
            if ($count > 0) {
                $slug = $slug . '-' . ($count + 1);
            }
            
            // Handle file upload
            $imageName = null;
            if ($request->hasFile('image')) {
                $imageName = time() . '.' . $request->image->extension();
                
                // Create directory if it doesn't exist
                $path = storage_path('app/public/homepage/layanan');
                if (!File::exists($path)) {
                    File::makeDirectory($path, 0777, true);
                }
                
                // Save the file directly
                $request->file('image')->move($path, $imageName);
            }

            // Create new layanan record
            Layanan::create([
                'title' => $request->title,
                'harga_reguler_weekday' => $request->harga_reguler_weekday ?? 0,
                'harga_paket_weekday' => $request->harga_paket_weekday ?? 0,
                'harga_reguler_weekend' => $request->harga_reguler_weekend ?? 0,
                'harga_paket_weekend' => $request->harga_paket_weekend ?? 0,
                'slug' => $slug,
                'short_description' => $request->short_description,
                'description' => $request->description,
                'image' => $imageName,
                'status' => $request->status,
            ]);

            return redirect()->route('admin.content.layanan.index')
                ->with('success', 'Layanan berhasil ditambahkan.');
        } catch (\Exception $e) {
            Log::error('Error adding layanan: ' . $e->getMessage());
            return redirect()->route('admin.content.layanan.create')
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Layanan $layanan)
    {
        return view('admin.layanan.edit', compact('layanan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Layanan $layanan)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'harga_reguler_weekday' => 'nullable|numeric|min:0',
            'harga_paket_weekday' => 'nullable|numeric|min:0',
            'harga_reguler_weekend' => 'nullable|numeric|min:0',
            'harga_paket_weekend' => 'nullable|numeric|min:0',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'status' => 'required|in:active,inactive',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.content.layanan.edit', $layanan->id)
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // Update basic info
            $layanan->title = $request->title;
            $layanan->harga_reguler_weekday = $request->harga_reguler_weekday ?? 0;
            $layanan->harga_paket_weekday = $request->harga_paket_weekday ?? 0;
            $layanan->harga_reguler_weekend = $request->harga_reguler_weekend ?? 0;
            $layanan->harga_paket_weekend = $request->harga_paket_weekend ?? 0;
            
            // Update slug if title changed
            if ($layanan->isDirty('title')) {
                $slug = Str::slug($request->title);
                
                // Check if slug already exists
                $count = Layanan::where('slug', $slug)
                    ->where('id', '!=', $layanan->id)
                    ->count();
                    
                if ($count > 0) {
                    $slug = $slug . '-' . ($count + 1);
                }
                
                $layanan->slug = $slug;
            }
            
            $layanan->short_description = $request->short_description;
            $layanan->description = $request->description;
            $layanan->status = $request->status;

            // Handle file upload if a new image is provided
            if ($request->hasFile('image')) {
                // Create directory if it doesn't exist
                $path = storage_path('app/public/homepage/layanan');
                if (!File::exists($path)) {
                    File::makeDirectory($path, 0777, true);
                }

                // Delete old image if it exists
                if ($layanan->image && File::exists("$path/{$layanan->image}")) {
                    File::delete("$path/{$layanan->image}");
                }

                // Save the new image
                $imageName = time() . '.' . $request->image->extension();
                $request->file('image')->move($path, $imageName);
                $layanan->image = $imageName;
            }

            $layanan->save();

            return redirect()->route('admin.content.layanan.index')
                ->with('success', 'Layanan berhasil diperbarui.');
        } catch (\Exception $e) {
            Log::error('Error updating layanan: ' . $e->getMessage());
            return redirect()->route('admin.content.layanan.edit', $layanan->id)
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Layanan $layanan)
    {
        try {
            // Delete image file if it exists
            $path = storage_path('app/public/homepage/layanan');
            if ($layanan->image && File::exists("$path/{$layanan->image}")) {
                File::delete("$path/{$layanan->image}");
            }

            // Delete record
            $layanan->delete();

            return redirect()->route('admin.content.layanan.index')
                ->with('success', 'Layanan berhasil dihapus.');
        } catch (\Exception $e) {
            Log::error('Error deleting layanan: ' . $e->getMessage());
            return redirect()->route('admin.content.layanan.index')
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}