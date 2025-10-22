<?php

namespace App\Http\Controllers\Terapis;

use App\Http\Controllers\Controller;
use App\Models\DataPasien;
use App\Models\Cabang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PDF;

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



    /**
     * Show patient therapy history page
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function showHistory($id)
    {
        $patient = DataPasien::with('cabang')->findOrFail($id);
        
        // Get therapy history from history_terapi table
        $histories = \DB::table('history_terapi')
            ->join('layanan', 'history_terapi.id_layanan', '=', 'layanan.id')
            ->join('cabang', 'history_terapi.id_cabang', '=', 'cabang.id')
            ->leftJoin('users', 'history_terapi.id_terapis', '=', 'users.id')
            ->where('history_terapi.id_pasien', $id)
            ->select(
                'history_terapi.*',
                'layanan.title as layanan_name',
                'layanan.harga_reguler_weekday',
                'layanan.harga_paket_weekday',
                'layanan.harga_reguler_weekend',
                'layanan.harga_paket_weekend',
                'cabang.nama_cabang',
                'users.name as terapis_name'
            )
            ->orderBy('history_terapi.tanggal_terapi', 'desc')
            ->paginate(10);
        
        return view('pages.terapis.patients.history-page', compact('patient', 'histories'));
    }

    /**
     * Show the detailed information for a specific therapy history.
     *
     * @param  int  $patient
     * @param  int  $history
     * @return \Illuminate\View\View
     */
    public function showHistoryDetail($patient, $history)
    {
        $patient = DataPasien::with('cabang')->findOrFail($patient);
        
        // Get specific history detail
        $historyDetail = \DB::table('history_terapi')
            ->join('layanan', 'history_terapi.id_layanan', '=', 'layanan.id')
            ->join('cabang', 'history_terapi.id_cabang', '=', 'cabang.id')
            ->leftJoin('users', 'history_terapi.id_terapis', '=', 'users.id')
            ->where('history_terapi.id', $history)
            ->where('history_terapi.id_pasien', $patient->id_pasien)
            ->select(
                'history_terapi.*',
                'layanan.title as layanan_name',
                'cabang.nama_cabang',
                'users.name as terapis_name'
            )
            ->first();

        if (!$historyDetail) {
            abort(404, 'History not found');
        }
        
        return view('pages.terapis.patients.history-detail', compact('patient', 'historyDetail'));
    }

    /**
     * Download PDF for a specific therapy history.
     *
     * @param  int  $patient
     * @param  int  $history
     * @return \Illuminate\Http\Response
     */
    public function downloadHistoryPDF($patient, $history)
    {
        $patient = DataPasien::with('cabang')->findOrFail($patient);
        
        // Get specific history detail
        $historyDetail = \DB::table('history_terapi')
            ->join('layanan', 'history_terapi.id_layanan', '=', 'layanan.id')
            ->join('cabang', 'history_terapi.id_cabang', '=', 'cabang.id')
            ->leftJoin('users', 'history_terapi.id_terapis', '=', 'users.id')
            ->where('history_terapi.id', $history)
            ->where('history_terapi.id_pasien', $patient->id_pasien)
            ->select(
                'history_terapi.*',
                'layanan.title as layanan_name',
                'cabang.nama_cabang',
                'cabang.alamat as cabang_alamat',
                'cabang.no_telp as cabang_telepon',
                'users.name as terapis_name'
            )
            ->first();

        if (!$historyDetail) {
            abort(404, 'History not found');
        }

        $pdf = \PDF::loadView('pages.terapis.patients.history-pdf', compact('patient', 'historyDetail'));
        
        $filename = 'Laporan_Terapi_' . $patient->nama_anak . '_' . \Carbon\Carbon::parse($historyDetail->tanggal_terapi)->format('d-m-Y') . '.pdf';
        
        return $pdf->download($filename);
    }
}