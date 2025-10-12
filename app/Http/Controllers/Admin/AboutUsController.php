<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AboutUsController extends Controller
{
    /**
     * Display the about us edit form with existing data.
     */
    public function index()
    {
        $aboutUs = AboutUs::first();
        if (!$aboutUs) {
            // Create a default about us record if none exists
            $aboutUs = AboutUs::create([
                'title' => 'Klinik Alfatih Center',
                'description' => 'Klinik Alfatih Center merupakan pusat layanan kesehatan dan tumbuh kembang anak.',
                'image' => 'default-clinic.jpg'
            ]);
        }
        return view('admin.aboutus.edit', compact('aboutUs'));
    }

    /**
     * Update the about us information.
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.content.aboutus.index')
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $aboutUs = AboutUs::first();
            if (!$aboutUs) {
                $aboutUs = new AboutUs();
            }
            
            // Update title and description
            $aboutUs->title = $request->title;
            $aboutUs->description = $request->description;

            // Handle file upload if a new image is provided
            if ($request->hasFile('image')) {
                // Create directory if it doesn't exist
                $path = storage_path('app/public/homepage/aboutus');
                if (!File::exists($path)) {
                    File::makeDirectory($path, 0777, true);
                }

                // Delete old image if it exists and is not a default image
                if ($aboutUs->image && File::exists("$path/{$aboutUs->image}") && $aboutUs->image != 'default-clinic.jpg') {
                    File::delete("$path/{$aboutUs->image}");
                }

                // Save the new image
                $imageName = time() . '.' . $request->image->extension();
                $request->file('image')->move($path, $imageName);
                $aboutUs->image = $imageName;
            }

            $aboutUs->save();

            return redirect()->route('admin.content.aboutus.index')
                ->with('success', 'Informasi Tentang Kami berhasil diperbarui.');
        } catch (\Exception $e) {
            Log::error('Error updating about us: ' . $e->getMessage());
            return redirect()->route('admin.content.aboutus.index')
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }
}