<?php

// Script to prepare and save slider images

// Configuration
$sourceImagesPath = __DIR__ . '/slider_images_source/'; // Place your original images here
$desktopDestPath = __DIR__ . '/storage/app/public/homepage/';
$mobileDestPath = __DIR__ . '/storage/app/public/homepage/';

// Make sure directories exist
if (!file_exists($desktopDestPath)) {
    mkdir($desktopDestPath, 0755, true);
    echo "Created directory: $desktopDestPath\n";
}

if (!file_exists($mobileDestPath)) {
    mkdir($mobileDestPath, 0755, true);
    echo "Created directory: $mobileDestPath\n";
}

// Image mappings
$images = [
    [
        'source' => 'image1.jpg', // Original filename - replace with your actual filenames
        'desktop_dest' => 'slider1-desktop.webp',
        'mobile_dest' => 'slider1-mobile.webp',
        'description' => 'TUMBUH KEMBANG OPTIMAL BERSAMA LALITA'
    ],
    [
        'source' => 'image2.jpg',
        'desktop_dest' => 'slider2-desktop.webp',
        'mobile_dest' => 'slider2-mobile.webp',
        'description' => 'PASTIKAN TUMBUH KEMBANG ANAK OPTIMAL'
    ],
    [
        'source' => 'image3.jpg',
        'desktop_dest' => 'slider3-desktop.webp',
        'mobile_dest' => 'slider3-mobile.webp',
        'description' => 'TUMBUHKAN RASA AMAN DAN PERCAYA DIRI PADA ANAK (version 1)'
    ],
    [
        'source' => 'image4.jpg',
        'desktop_dest' => 'slider4-desktop.webp',
        'mobile_dest' => 'slider4-mobile.webp',
        'description' => 'TUMBUHKAN RASA AMAN DAN PERCAYA DIRI PADA ANAK (version 2)'
    ]
];

// Process images - this is a placeholder. In reality, you would need to manually save the images
// or use an image library to process them.

echo "=== Image Processing Guide ===\n\n";
echo "Please manually save your slider images with the following names:\n\n";

foreach ($images as $image) {
    echo "For '{$image['description']}':\n";
    echo "- Save desktop version as: {$desktopDestPath}{$image['desktop_dest']}\n";
    echo "- Save mobile version as: {$mobileDestPath}{$image['mobile_dest']}\n\n";
}

echo "After saving the images, run the SQL query in 'slider_insert.sql' to add them to the database.\n";
echo "Then visit your homepage to see the slider in action.\n";