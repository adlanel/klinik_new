<?php
// This is a simple test script to check if the logo directory is writable

$directory = __DIR__ . '/storage/app/public/logo';
$testFile = $directory . '/test_' . time() . '.txt';

echo "Testing write access to: $directory\n";

// Check if directory exists
if (!file_exists($directory)) {
    echo "Directory does not exist. Trying to create...\n";
    if (!mkdir($directory, 0755, true)) {
        echo "FAILED: Could not create directory\n";
        exit(1);
    }
    echo "Directory created successfully\n";
}

// Check if directory is writable
if (!is_writable($directory)) {
    echo "FAILED: Directory is not writable\n";
    exit(1);
}

// Try to create a test file
$content = "Test file created at " . date('Y-m-d H:i:s');
if (file_put_contents($testFile, $content) === false) {
    echo "FAILED: Could not write test file\n";
    exit(1);
}

// Verify file was created
if (!file_exists($testFile)) {
    echo "FAILED: Test file not found after creation\n";
    exit(1);
}

// Read the content back
$readContent = file_get_contents($testFile);
if ($readContent !== $content) {
    echo "FAILED: File content doesn't match what was written\n";
    exit(1);
}

// Delete the test file
if (!unlink($testFile)) {
    echo "WARNING: Could not delete test file, but write test was successful\n";
}

echo "SUCCESS: Directory is writable and file operations work correctly\n";
echo "PHP user: " . get_current_user() . "\n";
echo "PHP running as: " . (function_exists('posix_getpwuid') ? posix_getpwuid(posix_geteuid())['name'] : 'unknown (Windows)') . "\n";
?>