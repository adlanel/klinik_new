<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\layanan;
use App\Models\Fasilitas;

class LayananFasilitasController extends Controller
{
    /**
     * Display a listing of layanan and fasilitas.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $type = $request->input('type', 'all');
        
        // Start with basic queries
        $layananQuery = layanan::where('status', 'active');
        $fasilitasQuery = Fasilitas::where('status', 'active');
        
        // Apply search if provided
        if ($search) {
            $layananQuery->where(function($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")
                      ->orWhere('short_description', 'like', "%{$search}%")
                      ->orWhere('description', 'like', "%{$search}%");
            });
            
            $fasilitasQuery->where(function($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")
                      ->orWhere('short_description', 'like', "%{$search}%")
                      ->orWhere('description', 'like', "%{$search}%");
            });
        }
        
        // Get results based on type filter with separate pagination for each type
        if ($type == 'layanan' || $type == 'all') {
            $layananList = $layananQuery->orderBy('created_at', 'desc')->paginate(6, ['*'], 'layanan_page');
        } else {
            $layananList = collect(); // Empty collection
        }
        
        if ($type == 'fasilitas' || $type == 'all') {
            $fasilitasList = $fasilitasQuery->orderBy('created_at', 'desc')->paginate(6, ['*'], 'fasilitas_page');
        } else {
            $fasilitasList = collect(); // Empty collection
        }
        
        // Append all query parameters to pagination links
        if ($layananList instanceof \Illuminate\Pagination\LengthAwarePaginator) {
            $layananList->appends(request()->except('layanan_page'));
        }
        
        if ($fasilitasList instanceof \Illuminate\Pagination\LengthAwarePaginator) {
            $fasilitasList->appends(request()->except('fasilitas_page'));
        }
        
        return view('layanan-fasilitas.index', compact('layananList', 'fasilitasList', 'search', 'type'));
    }
}