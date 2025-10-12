<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class UploadController extends Controller
{
    /**
     * Upload an image for CKEditor
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadImage(Request $request)
    {
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = Str::slug($fileName) . '_' . time() . '.' . $extension;
        
            // Create directory if it doesn't exist
            $path = storage_path('app/public/uploads/content');
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            
            // Save the file
            $request->file('upload')->move($path, $fileName);
        
            $url = asset('storage/uploads/content/' . $fileName);
            
            return response()->json([
                'fileName' => $fileName,
                'uploaded'=> 1,
                'url' => $url
            ]);
        }
        
        return response()->json([
            'uploaded' => 0,
            'error' => [
                'message' => 'No file uploaded'
            ]
        ]);
    }
}