<?php

namespace App\Http\Controllers;

use App\Models\Cabang;
use Illuminate\Http\Request;

class CabangController extends Controller
{
    public function index()
    {
        $branches = Cabang::all();
        return view('pages.cabang-kontak', compact('branches'));
    }
}