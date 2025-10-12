# About Section Setup Guide

This guide will help you set up the "About Us" section on the homepage.

## Database Setup

1. Create the `aboutus` table in your database:

```sql
CREATE TABLE aboutus (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    image VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

2. Insert initial data into the table using the provided SQL file:

```
php artisan migrate
php artisan db:seed --class=AboutSectionSeeder
```

Or manually execute the `about_section_insert.sql` file in your database management tool.

## Image Setup

1. Create the required directory if it doesn't exist:

```
mkdir -p storage/app/public/homepage/sc_2
```

2. Place your clinic image in this directory with the filename `clinic-building.jpg` or update the database entry to match your image filename.

3. Ensure the storage is linked:

```
php artisan storage:link
```

## Image Guidelines

- Recommended image size: 1000px × 562px (16:9 aspect ratio)
- Format: JPG or WebP for best compression
- The image should be clear and professional, showing the clinic building or facilities
- Avoid text on the image as the text will be provided separately in the content section

## Customizing Content

To update the About section content:

1. Access your database and modify the entry in the `sc_2` table
2. Update the `title` field for the section heading
3. Update the `description` field for the main content
4. Update the `image` field if you want to use a different image filename