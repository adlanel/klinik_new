# Image Preparation Guide for Homepage Slider

## Instructions

1. Save the provided images with these names in the folder `C:\xampp\htdocs\klinik\storage\app\public\homepage`:

### Image 1: "TUMBUH KEMBANG OPTIMAL BERSAMA LALITA"
- Desktop version: `slider1-desktop.webp`
- Mobile version: `slider1-mobile.webp`

### Image 2: "PASTIKAN TUMBUH KEMBANG ANAK OPTIMAL" with doctors
- Desktop version: `slider2-desktop.webp`
- Mobile version: `slider2-mobile.webp`

### Image 3: "TUMBUHKAN RASA AMAN DAN PERCAYA DIRI PADA ANAK" (first version)
- Desktop version: `slider3-desktop.webp`
- Mobile version: `slider3-mobile.webp`

### Image 4: "TUMBUHKAN RASA AMAN DAN PERCAYA DIRI PADA ANAK" (second version)
- Desktop version: `slider4-desktop.webp`
- Mobile version: `slider4-mobile.webp`

## Database Setup

Run the SQL query in the `slider_insert.sql` file to create the slider entries:

```sql
INSERT INTO banner (image_desktop, image_mobile, order_number, created_at) VALUES
('slider1-desktop.webp', 'slider1-mobile.webp', 1, NOW()),
('slider2-desktop.webp', 'slider2-mobile.webp', 2, NOW()),
('slider3-desktop.webp', 'slider3-mobile.webp', 3, NOW()),
('slider4-desktop.webp', 'slider4-mobile.webp', 4, NOW());
```

## Notes:
- For best results, optimize the image size before uploading:
  - Desktop images: Recommended width 1920px
  - Mobile images: Recommended width 768px
- Make sure the storage link is set up correctly with `php artisan storage:link`
- The images will be displayed in the order specified by the `order_number` field