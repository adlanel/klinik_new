<?php

namespace App\Http\Controllers\Terapis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class JadwalTugasController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $therapistId = auth()->id();
        
        $jadwalTugas = DB::table('history_terapi')
            ->leftJoin('data_pasien', 'history_terapi.id_pasien', '=', 'data_pasien.id_pasien')
            ->leftJoin('layanan', 'history_terapi.id_layanan', '=', 'layanan.id')
            ->leftJoin('cabang', 'history_terapi.id_cabang', '=', 'cabang.id')
            ->leftJoin('users', 'history_terapi.id_terapis', '=', 'users.id')
            ->select(
                'history_terapi.*',
                'data_pasien.nama_anak as nama_pasien',
                'data_pasien.nama_orang_tua',
                'data_pasien.telepon',
                'data_pasien.alamat',
                'layanan.title as nama_layanan',
                'cabang.nama_cabang',
                'users.name as nama_terapis'
            )
            ->where('history_terapi.id', $id)
            ->where('history_terapi.id_terapis', $therapistId)
            ->first();

        if (!$jadwalTugas) {
            return redirect()->route('terapis.jadwal-tugas.index')
                ->with('error', 'Jadwal tugas tidak ditemukan atau Anda tidak memiliki akses.');
        }

        return view('pages.terapis.jadwal-tugas.show', compact('jadwalTugas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $therapistId = auth()->id();
        
        $jadwalTugas = DB::table('history_terapi')
            ->leftJoin('data_pasien', 'history_terapi.id_pasien', '=', 'data_pasien.id_pasien')
            ->leftJoin('layanan', 'history_terapi.id_layanan', '=', 'layanan.id')
            ->leftJoin('cabang', 'history_terapi.id_cabang', '=', 'cabang.id')
            ->leftJoin('users', 'history_terapi.id_terapis', '=', 'users.id')
            ->select(
                'history_terapi.*',
                'data_pasien.nama_anak as nama_pasien',
                'layanan.title as nama_layanan',
                'cabang.nama_cabang',
                'users.name as nama_terapis'
            )
            ->where('history_terapi.id', $id)
            ->where('history_terapi.id_terapis', $therapistId)
            ->first();

        if (!$jadwalTugas) {
            return redirect()->route('terapis.jadwal-tugas.index')
                ->with('error', 'Jadwal tugas tidak ditemukan atau Anda tidak memiliki akses.');
        }

        return view('pages.terapis.jadwal-tugas.edit', compact('jadwalTugas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $therapistId = auth()->id();
        
        // Validate request
        $request->validate([
            'status' => 'required|in:Belum Dikerjakan,Sudah Dikerjakan,Cancelled',
            'notes' => 'nullable|string|max:1000',
            'saran_dirumah' => 'nullable|string|max:1000',
        ]);

        // Check if the task belongs to the authenticated therapist
        $jadwalTugas = DB::table('history_terapi')
            ->where('id', $id)
            ->where('id_terapis', $therapistId)
            ->first();

        if (!$jadwalTugas) {
            return redirect()->route('terapis.jadwal-tugas.index')
                ->with('error', 'Jadwal tugas tidak ditemukan atau Anda tidak memiliki akses.');
        }

        // Update the task
        DB::table('history_terapi')
            ->where('id', $id)
            ->update([
                'status' => $request->status,
                'notes' => $request->notes,
                'saran_dirumah' => $request->saran_dirumah,
                'updated_at' => now(),
            ]);

        return redirect()->route('terapis.jadwal-tugas.index')
            ->with('success', 'Jadwal tugas berhasil diperbarui.');
    }

    /**
     * Download PDF for specific jadwal tugas.
     */
    public function downloadPDF($id)
    {
        $therapistId = auth()->id();
        
        // Get jadwal tugas detail with patient info
        $jadwalTugas = DB::table('history_terapi')
            ->leftJoin('data_pasien', 'history_terapi.id_pasien', '=', 'data_pasien.id_pasien')
            ->leftJoin('layanan', 'history_terapi.id_layanan', '=', 'layanan.id')
            ->leftJoin('cabang', 'history_terapi.id_cabang', '=', 'cabang.id')
            ->leftJoin('users', 'history_terapi.id_terapis', '=', 'users.id')
            ->select(
                'history_terapi.*',
                'data_pasien.nama_anak as nama_pasien',
                'data_pasien.nama_orang_tua',
                'data_pasien.telepon',
                'data_pasien.alamat as alamat_pasien',
                'data_pasien.tanggal_lahir',
                'data_pasien.jenis_kelamin',
                'layanan.title as nama_layanan',
                'cabang.nama_cabang',
                'cabang.alamat as cabang_alamat',
                'cabang.no_telp as cabang_telepon',
                'users.name as nama_terapis'
            )
            ->where('history_terapi.id', $id)
            ->where('history_terapi.id_terapis', $therapistId)
            ->first();

        if (!$jadwalTugas) {
            abort(404, 'Jadwal tugas tidak ditemukan atau Anda tidak memiliki akses.');
        }

        // Generate PDF using the same template as history
        $pdf = \PDF::loadView('pages.terapis.jadwal-tugas.pdf', [
            'patient' => (object)[
                'nama_anak' => $jadwalTugas->nama_pasien,
                'nama_orang_tua' => $jadwalTugas->nama_orang_tua,
                'telepon' => $jadwalTugas->telepon,
                'alamat' => $jadwalTugas->alamat_pasien,
                'tanggal_lahir' => $jadwalTugas->tanggal_lahir,
                'jenis_kelamin' => $jadwalTugas->jenis_kelamin,
            ],
            'historyDetail' => (object)[
                'tanggal_terapi' => $jadwalTugas->tanggal_terapi,
                'jam_sesi' => $jadwalTugas->jam_sesi,
                'layanan_name' => $jadwalTugas->nama_layanan,
                'nama_cabang' => $jadwalTugas->nama_cabang,
                'cabang_alamat' => $jadwalTugas->cabang_alamat,
                'cabang_telepon' => $jadwalTugas->cabang_telepon,
                'terapis_name' => $jadwalTugas->nama_terapis,
                'status' => $jadwalTugas->status,
                'jenis_paket' => $jadwalTugas->jenis_paket,
                'notes' => $jadwalTugas->notes,
                'saran_dirumah' => $jadwalTugas->saran_dirumah,
            ]
        ]);
        
        $filename = 'Laporan_Terapi_' . $jadwalTugas->nama_pasien . '_' . \Carbon\Carbon::parse($jadwalTugas->tanggal_terapi)->format('d-m-Y') . '.pdf';
        
        return $pdf->download($filename);
    }

    // Note: Delete method tidak disediakan untuk menjaga integritas data medis
    // Data history terapi harus dipertahankan untuk audit trail dan keperluan medis
}