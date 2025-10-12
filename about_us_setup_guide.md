# About Us Section Setup Guide

This guide will help you set up the "About Us" section on the homepage.

## Database Setup

1. Create the `about_us` table in your database:

```sql
CREATE TABLE about_us (
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
php artisan db:seed --class=AboutUsSeeder
```

Or manually execute the `about_us_insert.sql` file in your database management tool.

## Image Setup

1. Create the required directory if it doesn't exist:

```
mkdir -p storage/app/public/homepage/about_us
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

## Migration from sc_2

If you're migrating from the old `sc_2` table, you can use the migration file provided in the project:

```
php artisan migrate
```

This will:
1. Create the new `about_us` table
2. Transfer all data from the `sc_2` table to the `about_us` table
3. Update the image paths from `homepage/sc_2/` to `homepage/about_us/`

## Updating Images

After migration, you'll need to move your existing images:

```
mkdir -p storage/app/public/homepage/about_us
cp storage/app/public/homepage/sc_2/* storage/app/public/homepage/about_us/
```

This will ensure your existing images work with the new model structure.