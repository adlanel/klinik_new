<?php

$directory = __DIR__ . '/storage/app/public/logo';
$testFile = $directory . '/test_file.txt';

echo "Testing file permissions for directory: " . $directory . "\n\n";

// Check if directory exists
echo "Directory exists: " . (file_exists($directory) ? 'Yes' : 'No') . "\n";

// Check if directory is writable
echo "Directory is writable: " . (is_writable($directory) ? 'Yes' : 'No') . "\n";

// Try to create a test file
$result = file_put_contents($testFile, 'This is a test file to check write permissions.');
echo "Write test result: " . ($result !== false ? 'Success (' . $result . ' bytes written)' : 'Failed') . "\n";

// Check if the file exists
echo "Test file exists: " . (file_exists($testFile) ? 'Yes' : 'No') . "\n";

// Try to read the test file
if (file_exists($testFile)) {
    $content = file_get_contents($testFile);
    echo "Read test result: " . ($content !== false ? 'Success' : 'Failed') . "\n";
    
    // Try to delete the test file
    $deleteResult = unlink($testFile);
    echo "Delete test result: " . ($deleteResult ? 'Success' : 'Failed') . "\n";
}

// Additional checks for the Laravel storage
echo "\nLaravel storage path: " . storage_path('app/public/logo') . "\n";
echo "Laravel storage exists: " . (file_exists(storage_path('app/public/logo')) ? 'Yes' : 'No') . "\n";
echo "Laravel storage writable: " . (is_writable(storage_path('app/public/logo')) ? 'Yes' : 'No') . "\n";

// Output server user
echo "\nServer running as user: " . get_current_user() . "\n";

// List current files in the directory
echo "\nCurrent files in directory:\n";
$files = scandir($directory);
foreach ($files as $file) {
    if ($file != '.' && $file != '..') {
        echo "- " . $file . " (size: " . filesize($directory . '/' . $file) . " bytes)\n";
    }
}