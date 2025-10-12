<?php

namespace App\Http\Controllers;

use App\Models\Cabang;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        // Get all branches for the branch selection dropdown
        $branches = Cabang::all();
        return view('pages.buat-janji', compact('branches'));
    }
}