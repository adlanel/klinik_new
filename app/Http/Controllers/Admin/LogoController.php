<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Logo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LogoController extends Controller
{
    /**
     * Display the current logo.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $currentLogo = Logo::getCurrentLogo();
        
        return view('admin.logos.index', compact('currentLogo'));
    }
    
    /**
     * Show the form for creating a new logo.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.logos.create');
    }
    
    /**
     * Store a newly created logo in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);
        
        if ($request->hasFile('logo')) {
            try {
                // Get the existing logo, if any
                $existingLogo = Logo::first();
                
                // If there's an existing logo, delete the file
                if ($existingLogo) {
                    if (Storage::exists('public/logo/' . $existingLogo->path)) {
                        Storage::delete('public/logo/' . $existingLogo->path);
                    }
                }
                
                $logoFile = $request->file('logo');
                $filename = time() . '_' . $logoFile->getClientOriginalName();
                $fullPath = storage_path('app/public/logo/' . $filename);
                
                // BYPASS LARAVEL STORAGE AND USE DIRECT FILE OPERATIONS
                try {
                    // Ensure directory exists
                    $directory = storage_path('app/public/logo');
                    if (!file_exists($directory)) {
                        mkdir($directory, 0755, true);
                    }
                    
                    // Move the uploaded file directly to the target location
                    if (!$logoFile->move($directory, $filename)) {
                        return redirect()->back()->with('error', 'Gagal memindahkan file ke direktori storage.');
                    }
                    
                    // Verify file exists
                    if (!file_exists($fullPath)) {
                        return redirect()->back()->with('error', 'File tidak ditemukan setelah upload: ' . $fullPath);
                    }
                    
                    // Log success with absolute path for debugging
                    \Log::info('Logo file stored successfully at: ' . $fullPath);
                } catch (\Exception $e) {
                    \Log::error('Exception during file operations: ' . $e->getMessage());
                    return redirect()->back()->with('error', 'File operation error: ' . $e->getMessage());
                }
                
                if ($existingLogo) {
                    // Update the existing logo record
                    $existingLogo->path = $filename;
                    $existingLogo->save();
                } else {
                    // Create a new Logo record if none exists
                    Logo::create([
                        'path' => $filename,
                    ]);
                }
                
                return redirect()->route('admin.content.logos.index')
                    ->with('success', 'Logo berhasil diperbarui dan diaktifkan.');
            } catch (\Exception $e) {
                \Log::error('Exception while uploading logo: ' . $e->getMessage());
                return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
            }
        }
        
        return redirect()->back()->with('error', 'Gagal mengunggah logo.');
    }
    
    /**
     * Remove the specified logo from storage.
     * 
     * In this implementation, we only keep one logo at a time, 
     * so this method is simplified to just check if we're deleting the only logo.
     *
     * @param  \App\Models\Logo  $logo
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Logo $logo)
    {
        // Don't allow deleting the only logo
        if (Logo::count() <= 1) {
            return redirect()->route('admin.content.logos.index')
                ->with('error', 'Tidak dapat menghapus logo. Upload logo baru terlebih dahulu untuk mengganti.');
        }
        
        // Delete the file from storage
        if (Storage::exists('public/logo/' . $logo->path)) {
            Storage::delete('public/logo/' . $logo->path);
        }
        
        // Delete the logo record
        $logo->delete();
        
        return redirect()->route('admin.content.logos.index')
            ->with('success', 'Logo berhasil dihapus.');
    }
}