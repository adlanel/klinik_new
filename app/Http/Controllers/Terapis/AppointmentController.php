<?php

namespace App\Http\Controllers\Terapis;

use App\Http\Controllers\Controller;
use App\Models\Consultation;
use App\Models\Cabang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AppointmentController extends Controller
{
    /**
     * Update the specified appointment in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
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
        
        return redirect()->route('terapis.appointments.index')
            ->with('success', 'Appointment berhasil diperbarui!');
    }
    
    /**
     * Store a newly created appointment in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
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
        
        return redirect()->route('terapis.appointments.index')
            ->with('success', 'Appointment berhasil dibuat!');
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $appointment = Consultation::findOrFail($id);
        $appointment->delete();
        
        return redirect()->route('terapis.appointments.index')
            ->with('success', 'Appointment berhasil dihapus!');
    }
}