<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    /**
     * Display a listing of the banners.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $banners = Banner::orderBy('order_number')->paginate(10);
        return view('admin.banners.index', compact('banners'));
    }
    
    /**
     * Show the form for creating a new banner.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Get the highest order number and add 1
        $nextOrderNumber = Banner::max('order_number') + 1;
        return view('admin.banners.create', compact('nextOrderNumber'));
    }
    
    /**
     * Store a newly created banner in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'desktop_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'mobile_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'link_url' => 'nullable|url|max:255',
            'order_number' => 'required|integer|min:1'
        ]);
        
        try {
            // Upload desktop image
            $desktopImage = $request->file('desktop_image');
            $desktopFilename = time() . '_desktop_' . $desktopImage->getClientOriginalName();
            $desktopPath = 'homepage/banner/' . $desktopFilename;
            
            // Upload mobile image
            $mobileImage = $request->file('mobile_image');
            $mobileFilename = time() . '_mobile_' . $mobileImage->getClientOriginalName();
            $mobilePath = 'homepage/banner/' . $mobileFilename;
            
            // Ensure the banner directory exists
            $directory = storage_path('app/public/homepage/banner');
            if (!file_exists($directory)) {
                mkdir($directory, 0755, true);
            }
            
            // Move the uploaded images directly to storage
            $desktopImage->move($directory, $desktopFilename);
            $mobileImage->move($directory, $mobileFilename);
            
            // Create the banner record
            Banner::create([
                'image_desktop' => $desktopFilename,
                'image_mobile' => $mobileFilename,
                'link_url' => $request->link_url,
                'order_number' => $request->order_number,
            ]);
            
            return redirect()->route('admin.content.banners.index')
                ->with('success', 'Banner berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error: ' . $e->getMessage())
                ->withInput();
        }
    }
    
    /**
     * Show the form for editing the specified banner.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\View\View
     */
    public function edit(Banner $banner)
    {
        return view('admin.banners.edit', compact('banner'));
    }
    
    /**
     * Update the specified banner in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Banner $banner)
    {
        $request->validate([
            'desktop_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'mobile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'link_url' => 'nullable|url|max:255',
            'order_number' => 'required|integer|min:1'
        ]);
        
        try {
            // Update desktop image if provided
            if ($request->hasFile('desktop_image')) {
                // Delete old image
                if (Storage::exists('public/homepage/banner/' . $banner->image_desktop)) {
                    Storage::delete('public/homepage/banner/' . $banner->image_desktop);
                }
                
                // Upload new desktop image
                $desktopImage = $request->file('desktop_image');
                $desktopFilename = time() . '_desktop_' . $desktopImage->getClientOriginalName();
                
                // Ensure directory exists
                $directory = storage_path('app/public/homepage/banner');
                if (!file_exists($directory)) {
                    mkdir($directory, 0755, true);
                }
                
                // Move the uploaded image directly to storage
                if ($desktopImage->move($directory, $desktopFilename)) {
                    \Log::info('Desktop image saved to disk: ' . $desktopFilename);
                    
                    // Update the banner's desktop image using direct DB update to ensure it works
                    $banner->image_desktop = $desktopFilename;
                    \Log::info('Set desktop_image to: ' . $desktopFilename);
                } else {
                    \Log::error('Failed to move desktop image to destination');
                }
            }
            
            // Update mobile image if provided
            if ($request->hasFile('mobile_image')) {
                // Delete old image
                if (Storage::exists('public/homepage/banner/' . $banner->image_mobile)) {
                    Storage::delete('public/homepage/banner/' . $banner->image_mobile);
                }
                
                // Upload new mobile image
                $mobileImage = $request->file('mobile_image');
                $mobileFilename = time() . '_mobile_' . $mobileImage->getClientOriginalName();
                
                // Ensure directory exists
                $directory = storage_path('app/public/homepage/banner');
                if (!file_exists($directory)) {
                    mkdir($directory, 0755, true);
                }
                
                // Move the uploaded image directly to storage
                if ($mobileImage->move($directory, $mobileFilename)) {
                    \Log::info('Mobile image saved to disk: ' . $mobileFilename);
                    
                    // Update the banner's mobile image using direct DB update to ensure it works
                    $banner->image_mobile = $mobileFilename;
                    \Log::info('Set mobile_image to: ' . $mobileFilename);
                } else {
                    \Log::error('Failed to move mobile image to destination');
                }
            }
            
            // Update link URL and order number
            $banner->link_url = $request->link_url;
            $banner->order_number = $request->order_number;
            
            // Debug - Let's log what we're about to save
            \Log::info('Updating banner ID: ' . $banner->id);
            \Log::info('Current banner data:', [
                'desktop_image' => $banner->image_desktop,
                'mobile_image' => $banner->image_mobile,
                'order_number' => $banner->order_number
            ]);
            
            // Use direct database update as primary method since we have no updated_at column
            try {
                $updateResult = \DB::table('banner')
                    ->where('id', $banner->id)
                    ->update([
                        'image_desktop' => $banner->image_desktop,
                        'image_mobile' => $banner->image_mobile,
                        'link_url' => $banner->link_url,
                        'order_number' => $banner->order_number
                    ]);
                
                if ($updateResult) {
                    \Log::info('Banner update successful via direct DB update');
                } else {
                    \Log::error('Banner update failed - DB update returned false');
                    return redirect()->back()->with('error', 'Gagal memperbarui banner dalam database.');
                }
            } catch (\Exception $e) {
                \Log::error('Direct DB update failed: ' . $e->getMessage());
                return redirect()->back()->with('error', 'Error database: ' . $e->getMessage());
            }
            
            // Double check the saved data by retrieving fresh from database
            $freshBanner = Banner::find($banner->id);
            \Log::info('Banner after save:', [
                'desktop_image' => $freshBanner->image_desktop,
                'mobile_image' => $freshBanner->image_mobile,  // Fix typo: was mobile_image, should be image_mobile
                'order_number' => $freshBanner->order_number
            ]);
            
            return redirect()->route('admin.content.banners.index')
                ->with('success', 'Banner berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error: ' . $e->getMessage())
                ->withInput();
        }
    }
    
    /**
     * Remove the specified banner from storage.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Banner $banner)
    {
        try {
            // Delete the desktop image
            if (Storage::exists('public/homepage/banner/' . $banner->image_desktop)) {
                Storage::delete('public/homepage/banner/' . $banner->image_desktop);
            }
            
            // Delete the mobile image
            if (Storage::exists('public/homepage/banner/' . $banner->image_mobile)) {
                Storage::delete('public/homepage/banner/' . $banner->image_mobile);
            }
            
            // Delete the banner record
            $banner->delete();
            
            return redirect()->route('admin.content.banners.index')
                ->with('success', 'Banner berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }
    
    /**
     * Update the order of banners.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateOrder(Request $request)
    {
        try {
            $bannerIds = $request->input('banner_ids', []);
            
            foreach ($bannerIds as $order => $bannerId) {
                $banner = Banner::findOrFail($bannerId);
                $banner->update(['order_number' => $order + 1]);
            }
            
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }
}