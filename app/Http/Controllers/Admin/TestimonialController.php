<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\testimoni;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $testimonials = testimoni::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.content.testimonials.index', compact('testimonials'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.content.testimonials.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'testimonial' => 'required|string',
            'rating' => 'required|numeric|min:1|max:5',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:active,inactive',
        ]);

        $testimonialData = $request->except('photo');
        
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('testimonials', 'public');
            $testimonialData['photo'] = $path;
        }

        testimoni::create($testimonialData);
        
        return redirect()->route('admin.content.testimonials.index')
            ->with('success', 'Testimonial berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $testimonial = testimoni::findOrFail($id);
        return view('admin.content.testimonials.edit', compact('testimonial'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'testimonial' => 'required|string',
            'rating' => 'required|numeric|min:1|max:5',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:active,inactive',
        ]);

        $testimonial = testimoni::findOrFail($id);
        $testimonialData = $request->except('photo');
        
        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($testimonial->photo) {
                Storage::disk('public')->delete($testimonial->photo);
            }
            
            $path = $request->file('photo')->store('testimonials', 'public');
            $testimonialData['photo'] = $path;
        }

        $testimonial->update($testimonialData);
        
        return redirect()->route('admin.content.testimonials.index')
            ->with('success', 'Testimonial berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $testimonial = testimoni::findOrFail($id);
        
        // Delete photo if exists
        if ($testimonial->photo) {
            Storage::disk('public')->delete($testimonial->photo);
        }
        
        $testimonial->delete();
        
        return redirect()->route('admin.content.testimonials.index')
            ->with('success', 'Testimonial berhasil dihapus.');
    }
}