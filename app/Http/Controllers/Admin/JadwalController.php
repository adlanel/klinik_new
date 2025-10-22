<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class JadwalController extends Controller
{
    public function index(Request $request)
    {
        // Get filter parameters
        $tanggal = $request->get('tanggal', Carbon::today()->format('Y-m-d'));
        $search = $request->get('search', '');
        
        // Define jam sesi untuk struktur jadwal
        $jamSesi = [
            '08.00-08.45',
            '08.45-09.30', 
            '09.30-10.15',
            '10.15-11.00',
            '11.00-11.45',
            '11.45-12.30',
            '12.30-13.15',
            '13.15-14.00',
            '14.00-14.45',
            '14.45-15.30',
            '15.30-16.15',
            '16.15-17.00',
            '17.00-17.45',
            '17.45-18.30'
        ];

        // Generate 30 days starting from selected date
        $carbonDate = Carbon::parse($tanggal);
        $startDate = $carbonDate->copy()->startOfMonth();
        $endDate = $startDate->copy()->addDays(29); // 30 days total
        
        $monthDates = [];
        for ($i = 0; $i < 30; $i++) {
            $date = $startDate->copy()->addDays($i);
            $monthDates[] = [
                'date' => $date->format('Y-m-d'),
                'day' => $date->format('D'),
                'dayName' => $date->locale('id')->format('l'),
                'dayNumber' => $date->format('d'),
                'isToday' => $date->isToday(),
                'isSelected' => $date->format('Y-m-d') === $tanggal,
                'carbonDate' => $date
            ];
        }

        // Query untuk mengambil jadwal terapi untuk 30 hari
        $jadwalQuery = DB::table('history_terapi')
            ->join('data_pasien', 'history_terapi.id_pasien', '=', 'data_pasien.id_pasien')
            ->join('layanan', 'history_terapi.id_layanan', '=', 'layanan.id')
            ->join('cabang', 'history_terapi.id_cabang', '=', 'cabang.id')
            ->leftJoin('users', 'history_terapi.id_terapis', '=', 'users.id')
            ->select(
                'history_terapi.*',
                'data_pasien.nama_anak as nama_pasien',
                'users.name as nama_terapis',
                'layanan.title as nama_layanan',
                'cabang.nama_cabang'
            )
            ->whereBetween('history_terapi.tanggal_terapi', [$startDate->format('Y-m-d'), $endDate->format('Y-m-d')]);

        // Apply search filter
        if (!empty($search)) {
            $jadwalQuery->where(function($query) use ($search) {
                $query->where('data_pasien.nama_anak', 'like', "%{$search}%")
                      ->orWhere('users.name', 'like', "%{$search}%")
                      ->orWhere('layanan.title', 'like', "%{$search}%")
                      ->orWhere('cabang.nama_cabang', 'like', "%{$search}%");
            });
        }

        $allJadwal = $jadwalQuery->orderBy('history_terapi.tanggal_terapi')
                                ->orderBy('history_terapi.jam_sesi')
                                ->get();

        // Group jadwal berdasarkan tanggal dan jam sesi
        $jadwalTerstruktur = [];
        foreach ($monthDates as $dateInfo) {
            $jadwalTerstruktur[$dateInfo['date']] = [];
            foreach ($jamSesi as $jam) {
                $jadwalTerstruktur[$dateInfo['date']][$jam] = $allJadwal->where('tanggal_terapi', $dateInfo['date'])
                                                                      ->where('jam_sesi', $jam);
            }
        }

        // Get summary statistics for the month
        $totalSesi = $allJadwal->count();
        $totalPasien = $allJadwal->unique('id_pasien')->count();
        $totalTerapis = $allJadwal->whereNotNull('id_terapis')->unique('id_terapis')->count();

        // Get week navigation for selected date
        $startOfWeek = $carbonDate->copy()->startOfWeek(Carbon::MONDAY);
        $weekDates = [];
        for ($i = 0; $i < 7; $i++) {
            $date = $startOfWeek->copy()->addDays($i);
            $weekDates[] = [
                'date' => $date->format('Y-m-d'),
                'day' => $date->format('D'),
                'dayName' => $date->locale('id')->format('l'),
                'dayNumber' => $date->format('d'),
                'isToday' => $date->isToday(),
                'isSelected' => $date->format('Y-m-d') === $tanggal
            ];
        }

        return view('admin.jadwal.index', compact(
            'jadwalTerstruktur', 
            'tanggal', 
            'search', 
            'jamSesi',
            'totalSesi',
            'totalPasien', 
            'totalTerapis',
            'weekDates',
            'carbonDate',
            'monthDates'
        ));
    }

    // API methods for dropdown data
    public function getPatients()
    {
        $patients = DB::table('data_pasien')
            ->select('id_pasien', 'nama_anak')
            ->orderBy('nama_anak')
            ->get();
            
        return response()->json($patients);
    }

    public function getTherapists()
    {
        $therapists = DB::table('users')
            ->select('id', 'name')
            ->where('role', 'terapis')
            ->orderBy('name')
            ->get();
            
        return response()->json($therapists);
    }

    public function getServices()
    {
        $services = DB::table('layanan')
            ->select('id', 'title')
            ->orderBy('title')
            ->get();
            
        return response()->json($services);
    }

    public function getBranches()
    {
        $branches = DB::table('cabang')
            ->select('id', 'nama_cabang')
            ->orderBy('nama_cabang')
            ->get();
            
        return response()->json($branches);
    }

    // CRUD methods
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_pasien' => 'required|exists:data_pasien,id_pasien',
            'id_terapis' => 'nullable|exists:users,id',
            'id_layanan' => 'required|exists:layanan,id',
            'id_cabang' => 'required|exists:cabang,id',
            'tanggal_terapi' => 'required|date',
            'jam_sesi' => 'required|string',
            'status' => 'required|in:Belum Dikerjakan,Sudah Dikerjakan,Cancel',
            'jenis_paket' => 'nullable|in:reguler_weekday,reguler_weekend,paket_weekday,paket_weekend',
            'notes' => 'nullable|string',
            'saran_dirumah' => 'nullable|string'
        ]);

        DB::table('history_terapi')->insert([
            'id_pasien' => $validatedData['id_pasien'],
            'id_terapis' => $validatedData['id_terapis'],
            'id_layanan' => $validatedData['id_layanan'],
            'id_cabang' => $validatedData['id_cabang'],
            'tanggal_terapi' => $validatedData['tanggal_terapi'],
            'jam_sesi' => $validatedData['jam_sesi'],
            'status' => $validatedData['status'],
            'jenis_paket' => $validatedData['jenis_paket'],
            'notes' => $validatedData['notes'],
            'saran_dirumah' => $validatedData['saran_dirumah'],
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Sesi terapi berhasil ditambahkan'
        ]);
    }

    public function edit($id)
    {
        $session = DB::table('history_terapi')
            ->where('id', $id)
            ->first();

        if (!$session) {
            return response()->json([
                'success' => false,
                'message' => 'Sesi tidak ditemukan'
            ], 404);
        }

        return response()->json($session);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'id_pasien' => 'required|exists:data_pasien,id_pasien',
            'id_terapis' => 'nullable|exists:users,id',
            'id_layanan' => 'required|exists:layanan,id',
            'id_cabang' => 'required|exists:cabang,id',
            'tanggal_terapi' => 'required|date',
            'jam_sesi' => 'required|string',
            'status' => 'required|in:Belum Dikerjakan,Sudah Dikerjakan,Cancel',
            'jenis_paket' => 'nullable|in:reguler_weekday,reguler_weekend,paket_weekday,paket_weekend',
            'notes' => 'nullable|string',
            'saran_dirumah' => 'nullable|string'
        ]);

        $updated = DB::table('history_terapi')
            ->where('id', $id)
            ->update([
                'id_pasien' => $validatedData['id_pasien'],
                'id_terapis' => $validatedData['id_terapis'],
                'id_layanan' => $validatedData['id_layanan'],
                'id_cabang' => $validatedData['id_cabang'],
                'tanggal_terapi' => $validatedData['tanggal_terapi'],
                'jam_sesi' => $validatedData['jam_sesi'],
                'status' => $validatedData['status'],
                'jenis_paket' => $validatedData['jenis_paket'],
                'notes' => $validatedData['notes'],
                'saran_dirumah' => $validatedData['saran_dirumah'],
                'updated_at' => now()
            ]);

        if ($updated) {
            return response()->json([
                'success' => true,
                'message' => 'Sesi terapi berhasil diupdate'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengupdate sesi terapi'
            ]);
        }
    }

    public function destroy($id)
    {
        $deleted = DB::table('history_terapi')
            ->where('id', $id)
            ->delete();

        if ($deleted) {
            return response()->json([
                'success' => true,
                'message' => 'Sesi terapi berhasil dihapus'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus sesi terapi'
            ]);
        }
    }
}