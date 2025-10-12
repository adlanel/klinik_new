<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cabang;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $branches = Cabang::orderBy('nama_cabang', 'asc')->paginate(10);
        return view('admin.branches.index', compact('branches'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.branches.create');
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
            'nama_cabang' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_telp' => 'required|string|max:20',
            'link_maps' => 'nullable|url|max:500',
            'lokasi' => 'nullable|string|max:255',
        ]);

        Cabang::create($request->all());
        
        return redirect()->route('admin.content.branches.index')
            ->with('success', 'Cabang berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $branch = Cabang::findOrFail($id);
        return view('admin.branches.edit', compact('branch'));
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
            'nama_cabang' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_telp' => 'required|string|max:20',
            'link_maps' => 'nullable|url|max:500',
            'lokasi' => 'nullable|string|max:255',
        ]);

        $branch = Cabang::findOrFail($id);
        $branch->update($request->all());
        
        return redirect()->route('admin.content.branches.index')
            ->with('success', 'Cabang berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Check if branch has patients or consultations
        $branch = Cabang::findOrFail($id);
        
        if ($branch->patients()->count() > 0 || $branch->consultations()->count() > 0) {
            return redirect()->route('admin.content.branches.index')
                ->with('error', 'Cabang tidak dapat dihapus karena masih terkait dengan pasien atau konsultasi.');
        }
        
        $branch->delete();
        
        return redirect()->route('admin.content.branches.index')
            ->with('success', 'Cabang berhasil dihapus.');
    }
}