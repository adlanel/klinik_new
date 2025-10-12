@extends('layouts.app')

@section('title', 'Buat Janji Konsultasi - Klinik Alfatih Center')

@section('content')
<div class="bg-gradient-to-r from-blue-500 to-indigo-600 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-3xl md:text-4xl font-bold text-white mb-4">Buat Janji Konsultasi</h1>
            <p class="text-xl text-white opacity-90 max-w-3xl mx-auto">
                Isi formulir di bawah ini untuk membuat janji konsultasi dengan tim ahli kami
            </p>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="md:flex">
            <div class="md:w-1/3 bg-blue-700 text-white p-8">
                <h3 class="text-2xl font-bold mb-6">Informasi Konsultasi</h3>
                
                <div class="space-y-6">
                    <div class="flex items-start">
                        <div class="flex-shrink-0 mt-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="font-medium text-blue-200">Jadwal Konsultasi</p>
                            <p class="text-white">Senin - Jumat: 08.00 - 17.00</p>
                            <p class="text-white">Sabtu: 08.00 - 15.00</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="flex-shrink-0 mt-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="font-medium text-blue-200">Persiapan</p>
                            <p class="text-white">Bawa kartu identitas dan riwayat medis anak jika ada</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="flex-shrink-0 mt-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="font-medium text-blue-200">Bantuan</p>
                            <p class="text-white">Hubungi +62 811-1234-5678 untuk info lebih lanjut</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="w-full md:w-2/3 p-8">
                <h3 class="text-2xl font-bold text-gray-800 mb-6">Form Janji Konsultasi</h3>
                
                <form action="{{ route('consultation.store') }}" method="POST" class="space-y-6" id="consultation-form-element">
                    @csrf
                    <input type="hidden" name="open_whatsapp_in_new_tab" value="1">
                    
                    <!-- Data Orang Tua Section -->
                    <div class="bg-blue-50 p-4 rounded-lg mb-6">
                        <h4 class="text-xl font-semibold text-blue-800 mb-4 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                            </svg>
                            Data Orang Tua
                        </h4>
                        
                        <div class="space-y-4">
                            <div>
                                <label for="nama_orang_tua" class="block text-sm font-medium text-gray-700 mb-1">Nama Orang Tua</label>
                                <input 
                                    type="text" 
                                    id="nama_orang_tua" 
                                    name="nama_orang_tua" 
                                    class="w-full px-4 py-3 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none {{ $errors->has('nama_orang_tua') ? 'border border-red-500' : 'border border-gray-300' }}" 
                                    placeholder="Masukkan nama lengkap orang tua"
                                    value="{{ old('nama_orang_tua') }}"
                                    required
                                >
                                @error('nama_orang_tua')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                <input 
                                    type="email" 
                                    id="email" 
                                    name="email" 
                                    class="w-full px-4 py-3 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none {{ $errors->has('email') ? 'border border-red-500' : 'border border-gray-300' }}" 
                                    placeholder="Contoh: email@example.com"
                                    value="{{ old('email') }}"
                                    required
                                >
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon / WhatsApp</label>
                                <input 
                                    type="text" 
                                    id="phone" 
                                    name="phone" 
                                    class="w-full px-4 py-3 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none {{ $errors->has('phone') ? 'border border-red-500' : 'border border-gray-300' }}" 
                                    placeholder="Contoh: 08123456789"
                                    value="{{ old('phone') }}"
                                    required
                                >
                                @error('phone')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <!-- Data Anak Section -->
                    <div class="bg-green-50 p-4 rounded-lg mb-6">
                        <h4 class="text-xl font-semibold text-green-800 mb-4 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                            </svg>
                            Data Anak
                        </h4>
                        
                        <div class="space-y-4">
                            <div>
                                <label for="patient_name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap Anak</label>
                                <input 
                                    type="text" 
                                    id="patient_name" 
                                    name="patient_name" 
                                    class="w-full px-4 py-3 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none {{ $errors->has('patient_name') ? 'border border-red-500' : 'border border-gray-300' }}" 
                                    placeholder="Masukkan nama lengkap anak"
                                    value="{{ old('patient_name') }}"
                                    required
                                >
                                @error('patient_name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin</label>
                                <div class="flex gap-6 mt-1">
                                    <div class="flex items-center">
                                        <input 
                                            type="radio" 
                                            id="laki-laki" 
                                            name="jenis_kelamin" 
                                            value="Laki-laki" 
                                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300" 
                                            {{ old('jenis_kelamin') == 'Laki-laki' ? 'checked' : '' }}
                                            required
                                        >
                                        <label for="laki-laki" class="ml-2 text-sm text-gray-700">Laki-laki</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input 
                                            type="radio" 
                                            id="perempuan" 
                                            name="jenis_kelamin" 
                                            value="Perempuan" 
                                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300" 
                                            {{ old('jenis_kelamin') == 'Perempuan' ? 'checked' : '' }}
                                        >
                                        <label for="perempuan" class="ml-2 text-sm text-gray-700">Perempuan</label>
                                    </div>
                                </div>
                                @error('jenis_kelamin')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="tempat_lahir" class="block text-sm font-medium text-gray-700 mb-1">Tempat Lahir</label>
                                    <input 
                                        type="text" 
                                        id="tempat_lahir" 
                                        name="tempat_lahir" 
                                        class="w-full px-4 py-3 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none {{ $errors->has('tempat_lahir') ? 'border border-red-500' : 'border border-gray-300' }}" 
                                        placeholder="Kota kelahiran"
                                        value="{{ old('tempat_lahir') }}"
                                        required
                                    >
                                    @error('tempat_lahir')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div>
                                    <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir</label>
                                    <input 
                                        type="date" 
                                        id="tanggal_lahir" 
                                        name="tanggal_lahir" 
                                        class="w-full px-4 py-3 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none {{ $errors->has('tanggal_lahir') ? 'border border-red-500' : 'border border-gray-300' }}" 
                                        value="{{ old('tanggal_lahir') }}"
                                        required
                                    >
                                    @error('tanggal_lahir')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            
                            <div>
                                <label for="alamat" class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                                <textarea 
                                    id="alamat" 
                                    name="alamat" 
                                    rows="2" 
                                    class="w-full px-4 py-3 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none {{ $errors->has('alamat') ? 'border border-red-500' : 'border border-gray-300' }}" 
                                    placeholder="Masukkan alamat lengkap"
                                    required
                                >{{ old('alamat') }}</textarea>
                                @error('alamat')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <!-- Data Konsultasi Section -->
                    <div class="bg-yellow-50 p-4 rounded-lg mb-6">
                        <h4 class="text-xl font-semibold text-yellow-800 mb-4 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                            </svg>
                            Detail Konsultasi
                        </h4>
                        
                        <div class="space-y-4">
                            <div>
                                <label for="meeting_date" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Konsultasi</label>
                                <input 
                                    type="date" 
                                    id="meeting_date" 
                                    name="meeting_date" 
                                    class="w-full px-4 py-3 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none {{ $errors->has('meeting_date') ? 'border border-red-500' : 'border border-gray-300' }}"
                                    min="{{ date('Y-m-d') }}"
                                    value="{{ old('meeting_date') }}"
                                    required
                                >
                                @error('meeting_date')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="complaint" class="block text-sm font-medium text-gray-700 mb-1">Keluhan / Jenis Terapi</label>
                                <textarea 
                                    id="complaint" 
                                    name="complaint" 
                                    rows="4" 
                                    class="w-full px-4 py-3 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none {{ $errors->has('complaint') ? 'border border-red-500' : 'border border-gray-300' }}" 
                                    placeholder="Ceritakan keluhan anak atau jenis terapi yang diinginkan"
                                    required
                                >{{ old('complaint') }}</textarea>
                                @error('complaint')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="cabang_id" class="block text-sm font-medium text-gray-700 mb-1">Pilih Cabang</label>
                                <div class="relative">
                                    <select
                                        id="cabang_id"
                                        name="cabang_id"
                                        class="appearance-none w-full px-4 py-3 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none {{ $errors->has('cabang_id') ? 'border border-red-500' : 'border border-gray-300' }} bg-white"
                                        required
                                    >
                                        <option value="" disabled {{ old('cabang_id') ? '' : 'selected' }}>Pilih cabang klinik</option>
                                        @foreach($branches as $branch)
                                        <option value="{{ $branch->id }}" {{ old('cabang_id') == $branch->id ? 'selected' : '' }} 
                                            title="{{ $branch->nama_cabang }} - {{ $branch->alamat }}" data-full-info="{{ $branch->nama_cabang }} - {{ $branch->alamat }}">
                                            {{ $branch->nama_cabang }}{{ strlen($branch->alamat) > 15 ? ' - ' . substr($branch->alamat, 0, 15) . '...' : ' - ' . $branch->alamat }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                                @error('cabang_id')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="pt-4">
                        <button 
                            type="submit" 
                            id="consultation-submit"
                            class="w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-bold py-3 px-4 rounded-lg transition duration-300 flex items-center justify-center gap-2"
                        >
                            <span>Kirim & Hubungi via WhatsApp</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </button>
                        
                        <p class="text-sm text-gray-500 mt-4 text-center">
                            Setelah mengisi form, Anda akan diarahkan ke WhatsApp untuk konfirmasi janji konsultasi
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Simple toast notification for success message -->
<div id="appointment-success" class="fixed top-5 right-5 bg-green-600 text-white px-4 py-3 rounded shadow-lg z-50 hidden">
    <div class="flex items-center">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
        </svg>
        <span class="font-bold">Berhasil Submit! Membuka WhatsApp...</span>
    </div>
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const consultationForm = document.getElementById('consultation-form-element');
        const successMessage = document.getElementById('appointment-success');
        
        console.log('Form element found:', !!consultationForm);
        console.log('Success message element found:', !!successMessage);
        
        if (consultationForm) {
            consultationForm.addEventListener('submit', function(e) {
                e.preventDefault(); // Always prevent default first
                
                // Check if the form is valid
                if (consultationForm.checkValidity()) {
                    // Get the form data
                    const formData = new FormData(consultationForm);
                    
                    // Log the form data for debugging
                    console.log('Submitting form data...');
                    
                    // Get CSRF token from meta tag
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    
                    // Send the form data using fetch API
                    fetch(consultationForm.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json'
                        },
                        credentials: 'same-origin' // Include cookies
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log('Response data:', data);
                        
                        // Reset the form
                        consultationForm.reset();
                        
                        // Show toast notification
                        if (successMessage) {
                            successMessage.classList.remove('hidden');
                            
                            // Auto-dismiss after 3 seconds
                            setTimeout(() => {
                                successMessage.classList.add('hidden');
                            }, 3000);
                        }
                        
                        // Open WhatsApp in new tab if URL is provided
                        if (data.whatsapp_url) {
                            window.open(data.whatsapp_url, '_blank');
                        }
                    })
                    .catch(error => {
                        console.error('Form submission error:', error);
                        // Fallback to normal form submission
                        consultationForm.removeEventListener('submit', arguments.callee);
                        consultationForm.submit();
                    });
                }
            });
        }
    });
</script>
@endpush