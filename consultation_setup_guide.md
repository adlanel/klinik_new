# Consultation Section Setup Guide

Panduan ini menjelaskan cara mengatur bagian "Janji Konsultasi" pada website Al-Fatih Center.

## Struktur Database

Bagian konsultasi menggunakan tabel `consultations` dengan struktur berikut:

```sql
CREATE TABLE consultations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    patient_name VARCHAR(255) NOT NULL,     -- Nama pasien
    phone VARCHAR(50) NOT NULL,             -- Nomor telepon
    meeting_date DATE NOT NULL,             -- Tanggal ketemuan
    complaint TEXT NOT NULL,                -- Keluhan / jenis terapi yang diinginkan
    status ENUM('pending','approved','rejected') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

## Langkah-langkah Setup

1. **Migrasi Database**
   ```bash
   php artisan migrate
   ```

2. **Update Route**
   Pastikan route sudah terdaftar di `routes/web.php`:
   ```php
   Route::post('/consultation', [App\Http\Controllers\ConsultationController::class, 'store'])->name('consultation.store');
   ```

3. **Nomor WhatsApp**
   
   Ubah nomor WhatsApp di `ConsultationController.php` jika diperlukan:
   ```php
   $whatsappNumber = '6281386607778';
   ```

## Fitur Konsultasi

Fitur ini menyediakan:
1. Form untuk input data pasien
2. Penyimpanan data ke database
3. Redirect otomatis ke WhatsApp dengan pesan yang terformat sesuai data form
4. Validasi input untuk memastikan data yang dimasukkan valid

## Customisasi Pesan WhatsApp

Pesan WhatsApp dapat dikustomisasi dengan mengedit method `generateWhatsAppMessage()` pada model `Consultation.php`:

```php
public function generateWhatsAppMessage()
{
    $message = "Halo, saya *{$this->patient_name}* ingin membuat janji konsultasi.\n\n";
    $message .= "Detail janji:\n";
    $message .= "- Tanggal: {$this->formatted_date}\n";
    $message .= "- Keluhan: {$this->complaint}\n";
    $message .= "- No. HP: {$this->phone}\n\n";
    $message .= "Mohon konfirmasi ketersediaan jadwal untuk tanggal tersebut. Terima kasih.";
    
    return urlencode($message);
}
```

## Pengelolaan Data Konsultasi

Data konsultasi dapat dikelola melalui panel admin. Implementasi panel admin untuk mengelola data konsultasi dapat ditambahkan di masa mendatang.