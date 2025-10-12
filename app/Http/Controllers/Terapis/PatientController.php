<?php

namespace App\Http\Controllers\Terapis;

use App\Http\Controllers\Controller;
use App\Models\DataPasien;
use App\Models\Cabang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PatientController extends Controller
{
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

        return redirect()->route('terapis.patients.index')
            ->with('success', 'Data pasien berhasil ditambahkan');
    }
    
    /**
     * Update the specified patient in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $patient = DataPasien::findOrFail($id);
        
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
            'hasil_follow_up' => 'nullable|string',
            'terakhir_konsultasi' => 'nullable|date',
            'status_pasien' => 'required|in:Aktif,Tidak Aktif',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $patient->update($request->all());
        
        return redirect()->route('terapis.patients.index')
            ->with('success', 'Data pasien berhasil diperbarui');
    }
    
    /**
     * Remove the specified patient from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $patient = DataPasien::findOrFail($id);
        $patient->delete();
        
        return redirect()->route('terapis.patients.index')
            ->with('success', 'Data pasien berhasil dihapus');
    }
}