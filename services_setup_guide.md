# Services Section Setup Guide

This guide will help you set up the Services section on the homepage and the individual service detail pages.

## Database Setup

1. Create the `sc_3` table in your database:

```sql
CREATE TABLE sc_3 (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,           -- Judul layanan
    slug VARCHAR(255) UNIQUE NOT NULL,     -- Buat URL SEO-friendly (misal /layanan/terapi-wicara)
    short_description TEXT NULL,           -- Deskripsi singkat (buat di beranda)
    description LONGTEXT NULL,             -- Deskripsi detail (buat di halaman detail)
    image VARCHAR(255) NULL,               -- Path gambar utama layanan
    status ENUM('active','inactive') DEFAULT 'active', -- Bisa aktif/nonaktif
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

2. Insert initial data into the table using the provided SQL file:

```
php artisan migrate
php artisan db:seed --class=ServicesSeeder
```

Or manually execute the `services_insert.sql` file in your database management tool.

## Image Setup

1. Create the required directory if it doesn't exist:

```
mkdir -p storage/app/public/homepage/sc_3
```

2. Place your service images in this directory with the following filenames:
   - terapi-wicara.jpg
   - terapi-okupasi.jpg
   - terapi-fisik.jpg
   - konseling-psikologi.jpg

   (or update the database entries to match your image filenames)

3. Ensure the storage is linked:

```
php artisan storage:link
```

## Image Guidelines

- **Recommended image size**: 800px × 600px (4:3 aspect ratio)
- **Format**: JPG or WebP for best compression
- **Content**: The images should visually represent the services - showing therapists working with children, therapy rooms, or relevant equipment
- **Style**: Use bright, positive images with good lighting and warm tones

## Customizing Services

To add or update services:

1. Access your database and modify the entries in the `sc_3` table
2. For new services:
   - Add a meaningful `title`
   - Generate a `slug` (URL-friendly version of the title with dashes)
   - Add a concise `short_description` for the cards on the homepage
   - Add detailed `description` with HTML formatting for the detail page
   - Add the `image` filename
   - Set `status` to 'active' to make it visible on the site

3. For the `description` field, you **must** use proper HTML formatting to ensure paragraphs display correctly:
   - Wrap each paragraph with `<p>...</p>` tags
   - Use `<ul>` and `<li>` tags for bullet points
   - Use `<h3>` or `<h4>` tags for subheadings
   - Use `<strong>` or `<em>` tags for emphasis
   
   **Important**: Without these HTML tags, your paragraphs will not display with proper spacing. The system relies on these HTML tags to format the content correctly.

## Routes

- Homepage with services cards: `/`
- Individual service detail page: `/layanan/{slug}`