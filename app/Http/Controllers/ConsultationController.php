<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Consultation;
use App\Models\Cabang;
use Illuminate\Support\Facades\Validator;

class ConsultationController extends Controller
{
    /**
     * Store a newly created consultation in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'patient_name' => 'required|string|max:255',
            'nama_orang_tua' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'phone' => 'required|string|max:50',
            'alamat' => 'required|string',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'meeting_date' => 'required|date|after_or_equal:today',
            'complaint' => 'required|string',
            'cabang_id' => 'required|exists:cabang,id',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        
        // Get the selected branch
        $branch = Cabang::findOrFail($request->cabang_id);
        
        // Buat konsultasi baru
        $consultation = Consultation::create([
            'patient_name' => $request->patient_name,
            'nama_orang_tua' => $request->nama_orang_tua,
            'email' => $request->email,
            'phone' => $request->phone,
            'alamat' => $request->alamat,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'meeting_date' => $request->meeting_date,
            'complaint' => $request->complaint,
            'status' => 'pending',
            'cabang_id' => $request->cabang_id,
        ]);
        
        // Generate WhatsApp URL using the branch's phone number
        $whatsappNumber = $branch->whatsapp_number;
        $message = $consultation->generateWhatsAppMessage();
        $whatsappUrl = "https://api.whatsapp.com/send?phone={$whatsappNumber}&text={$message}";
        
        // Check if the request is AJAX
        if ($request->ajax() || $request->has('open_whatsapp_in_new_tab')) {
            return response()->json([
                'success' => true,
                'message' => 'Appointment telah berhasil di submit',
                'whatsapp_url' => $whatsappUrl,
                'consultation_id' => $consultation->id
            ]);
        }
        
        // Regular form submission - Redirect ke WhatsApp
        return redirect()->away($whatsappUrl);
    }
}