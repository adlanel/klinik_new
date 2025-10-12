<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataPasien;
use App\Models\Cabang;
use Illuminate\Support\Facades\Validator;

class PatientController extends Controller
{
    /**
     * Display a listing of the patients.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $query = DataPasien::query();
        
        // Search functionality
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_anak', 'like', "%{$search}%")
                  ->orWhere('nama_orang_tua', 'like', "%{$search}%")
                  ->orWhere('telepon', 'like', "%{$search}%");
            });
        }
        
        // Filter by status
        if ($request->has('status') && $request->status != 'all') {
            $query->where('status_pasien', $request->status);
        }
        
        // Filter by branch
        if ($request->has('cabang') && $request->cabang != 'all') {
            $query->where('id_cabang', $request->cabang);
        }
        
        // Order by
        $query->orderBy('nama_anak', 'asc');
        
        $patients = $query->paginate(10);
        $branches = Cabang::all();
        
        return view('admin.patients.index', compact('patients', 'branches'));
    }

    /**
     * Show the form for creating a new patient.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $branches = Cabang::all();
        return view('admin.patients.create', compact('branches'));
    }

    /**
     * Store a newly created patient in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_anak' => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'nullable|string|max:100',
            'tanggal_lahir' => 'nullable|date',
            'nama_orang_tua' => 'nullable|string|max:100',
            'telepon' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'id_cabang' => 'required|exists:cabang,id',
            'keluhan_awal' => 'nullable|string',
            'jenis_terapi' => 'nullable|string|max:100',
            'status_pasien' => 'required|in:Aktif,Tidak Aktif',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DataPasien::create($request->all());

        return redirect()->route('admin.patients.index')
            ->with('success', 'Data pasien berhasil ditambahkan');
    }

    /**
     * Display the specified patient.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $patient = DataPasien::with('cabang')->findOrFail($id);
        return view('admin.patients.show', compact('patient'));
    }

    /**
     * Show the form for editing the specified patient.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $patient = DataPasien::findOrFail($id);
        $branches = Cabang::all();
        return view('admin.patients.edit', compact('patient', 'branches'));
    }

    /**
     * Update the specified patient in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_anak' => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'nullable|string|max:100',
            'tanggal_lahir' => 'nullable|date',
            'nama_orang_tua' => 'nullable|string|max:100',
            'telepon' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'id_cabang' => 'required|exists:cabang,id',
            'keluhan_awal' => 'nullable|string',
            'jenis_terapi' => 'nullable|string|max:100',
            'status_pasien' => 'required|in:Aktif,Tidak Aktif',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $patient = DataPasien::findOrFail($id);
        $patient->update($request->all());

        return redirect()->route('admin.patients.index')
            ->with('success', 'Data pasien berhasil diperbarui');
    }

    /**
     * Remove the specified patient from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $patient = DataPasien::findOrFail($id);
        $patient->delete();

        return redirect()->route('admin.patients.index')
            ->with('success', 'Data pasien berhasil dihapus');
    }
}