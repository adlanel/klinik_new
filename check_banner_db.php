<?php
require 'vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

echo "Checking Banner table structure...\n\n";

// Check if the table exists
if (Schema::hasTable('banner')) {
    echo "✓ Table 'banner' exists.\n";
} else if (Schema::hasTable('banners')) {
    echo "✓ Table 'banners' exists (plural form).\n";
} else {
    echo "✗ Neither 'banner' nor 'banners' table exists.\n";
}

// Get the columns
$columns = Schema::getColumnListing('banner');
if (empty($columns)) {
    $columns = Schema::getColumnListing('banners');
    echo "Using 'banners' table for column listing.\n";
} else {
    echo "Using 'banner' table for column listing.\n";
}

if (!empty($columns)) {
    echo "\nColumns in table:\n";
    foreach ($columns as $column) {
        echo "- {$column}\n";
    }
} else {
    echo "\n✗ No columns found in either table.\n";
}

// Check the actual model properties vs database
echo "\nChecking model vs database alignment...\n";

try {
    $banner = new App\Models\Banner();
    $fillable = $banner->getFillable();
    echo "Banner model fillable attributes: \n";
    echo implode(", ", $fillable) . "\n";
} catch (Exception $e) {
    echo "Error loading Banner model: " . $e->getMessage() . "\n";
}

// Get a sample record
echo "\nFetching a sample banner record:\n";
try {
    $sample = DB::table('banner')->first();
    if ($sample) {
        print_r($sample);
    } else {
        $sample = DB::table('banners')->first();
        if ($sample) {
            print_r($sample);
            echo "\nNote: Record found in 'banners' table, but model might be using 'banner'.\n";
        } else {
            echo "No banner records found in either table.\n";
        }
    }
} catch (Exception $e) {
    echo "Database error: " . $e->getMessage() . "\n";
}

echo "\nDone checking Banner database structure.\n";