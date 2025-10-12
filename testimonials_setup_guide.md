# Testimonial Section Setup Guide

Panduan ini menjelaskan cara mengatur bagian "Cerita Ayah Bunda" pada website Al-Fatih Center.

## Struktur Database

Bagian testimoni menggunakan tabel `sc_5` dengan struktur berikut:

```sql
CREATE TABLE sc_5 (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,           -- Nama pemberi testimoni
    role VARCHAR(255) NOT NULL,           -- Status atau peran
    testimonial_text TEXT NOT NULL,       -- Isi testimoni panjang
    image VARCHAR(255) NULL,              -- Path foto profil
    order_number INT NOT NULL DEFAULT 0,  -- Urutan tampilan
    status ENUM('active','inactive') DEFAULT 'active', -- Status aktif/tidak aktif
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

## Langkah-langkah Setup

1. **Migrasi Database**
   ```bash
   php artisan migrate
   ```

2. **Jalankan Seeder**
   ```bash
   php artisan db:seed --class=TestimonialsSeeder
   ```
   
   Atau gunakan file SQL yang disediakan:
   ```bash
   mysql -u username -p database_name < testimonials_insert.sql
   ```

3. **Persiapan Gambar**
   
   Buat folder untuk gambar testimoni:
   ```bash
   mkdir -p storage/app/public/homepage/sc_5
   ```

   Pastikan symbolic link sudah dibuat:
   ```bash
   php artisan storage:link
   ```

4. **Upload Gambar Testimoni**
   
   Siapkan gambar dengan nama:
   - testimonial-1.jpg
   - testimonial-2.jpg
   - testimonial-3.jpg
   
   Letakkan di folder:
   ```
   storage/app/public/homepage/sc_5/
   ```

## Tampilan pada Website

Testimoni akan ditampilkan dalam format slider dengan:
- Nama pemberi testimoni
- Peran/status
- Teks testimoni
- Foto profil
- Tombol navigasi

## Menambahkan Testimoni Baru

1. Insert data ke tabel `sc_5`
2. Upload foto ke folder `storage/app/public/homepage/sc_5/`
3. Set `status = 'active'` untuk menampilkan testimoni
4. Atur `order_number` untuk menentukan urutan tampilan

## Pengeditan Testimoni

Bisa dilakukan langsung melalui database atau buat panel admin untuk mengelolanya.