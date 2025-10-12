<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Consultation;
use App\Models\Cabang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the appointments.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $query = Consultation::query();
        
        // Filter by status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }
        
        // Filter by date range
        if ($request->has('start_date') && $request->start_date != '') {
            $query->whereDate('meeting_date', '>=', $request->start_date);
        }
        
        if ($request->has('end_date') && $request->end_date != '') {
            $query->whereDate('meeting_date', '<=', $request->end_date);
        }
        
        // Search by patient name or phone
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('patient_name', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }
        
        // Sort by date
        $query->orderBy('meeting_date', $request->has('sort') ? $request->sort : 'asc');
        
        $appointments = $query->paginate(10);
        
        return view('admin.appointments.index', compact('appointments'));
    }
    
    /**
     * Show the form for creating a new appointment.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $branches = Cabang::all();
        return view('admin.appointments.create', compact('branches'));
    }
    
    /**
     * Store a newly created appointment in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'patient_name' => 'required|string|max:255',
            'email' => 'required|email|max:100',
            'phone' => 'required|string|max:50',
            'alamat' => 'required|string',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'nama_orang_tua' => 'required|string|max:100',
            'meeting_date' => 'required|date',
            'complaint' => 'required|string',
            'cabang_id' => 'required|exists:cabang,id',
            'status' => 'required|in:pending,approved,rejected'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Consultation::create($request->all());
        
        return redirect()->route('admin.appointments.index')
            ->with('success', 'Appointment berhasil dibuat!');
    }
    
    /**
     * Display the specified appointment.
     *
     * @param  \App\Models\Consultation  $appointment
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $appointment = Consultation::findOrFail($id);
        return view('admin.appointments.show', compact('appointment'));
    }
    
    /**
     * Show the form for editing the specified appointment.
     *
     * @param  \App\Models\Consultation  $appointment
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $appointment = Consultation::findOrFail($id);
        $branches = Cabang::all();
        return view('admin.appointments.edit', compact('appointment', 'branches'));
    }
    
    /**
     * Update the specified appointment in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Consultation  $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $appointment = Consultation::findOrFail($id);
        
        $validator = Validator::make($request->all(), [
            'patient_name' => 'required|string|max:255',
            'email' => 'required|email|max:100',
            'phone' => 'required|string|max:50',
            'alamat' => 'required|string',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'nama_orang_tua' => 'required|string|max:100',
            'meeting_date' => 'required|date',
            'complaint' => 'required|string',
            'cabang_id' => 'required|exists:cabang,id',
            'status' => 'required|in:pending,approved,rejected'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        
        $appointment->update($request->all());
        
        return redirect()->route('admin.appointments.index')
            ->with('success', 'Appointment berhasil diperbarui!');
    }
    
    /**
     * Update the status of the appointment.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateStatus(Request $request, $id)
    {
        try {
            $appointment = Consultation::findOrFail($id);
            
            $request->validate([
                'status' => 'required|in:pending,approved,rejected'
            ]);
            
            $oldStatus = $appointment->status;
            $newStatus = $request->status;
            
            $appointment->status = $newStatus;
            $appointment->save();
            
            // Log this change
            \Log::info("Appointment #{$id} status changed from {$oldStatus} to {$newStatus}");
            
            // Set flash message
            return redirect()->back()->with('success', 'Status berhasil diperbarui menjadi ' . ucfirst($newStatus) . '!');
            
        } catch (\Exception $e) {
            \Log::error("Error updating appointment status: " . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal memperbarui status: ' . $e->getMessage());
        }
    }
    
    /**
     * Remove the specified appointment from storage.
     *
     * @param  \App\Models\Consultation  $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $appointment = Consultation::findOrFail($id);
        $appointment->delete();
        
        return redirect()->route('admin.appointments.index')
            ->with('success', 'Appointment berhasil dihapus!');
    }
}