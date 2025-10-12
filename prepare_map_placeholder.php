<?php

// Script to prepare map placeholder images
if (!file_exists('storage/images')) {
    mkdir('storage/images', 0777, true);
}

// Create a simple map placeholder image
$image = imagecreatetruecolor(600, 400);
$bg_color = imagecolorallocate($image, 230, 230, 230);
$text_color = imagecolorallocate($image, 100, 100, 100);
imagefill($image, 0, 0, $bg_color);

// Add text to the image
$text = 'Lokasi Klinik';
$font_size = 5;
$text_box = imagettfbbox($font_size, 0, 'arial.ttf', $text);
$text_width = abs($text_box[4] - $text_box[0]);
$text_height = abs($text_box[5] - $text_box[1]);
$x = (600 - $text_width) / 2;
$y = (400 + $text_height) / 2;

// Uncomment to use built-in font (no need for TTF)
imagestring($image, $font_size, $x, $y, $text, $text_color);

// Save the image
imagejpeg($image, 'storage/images/map-placeholder.jpg', 90);
imagedestroy($image);

echo "Map placeholder created successfully!";