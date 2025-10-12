<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('about_us')) {
            Schema::create('about_us', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->text('description');
                $table->string('image');
                $table->timestamps();
            });
            
            // Migrate data from old table if exists
            if (Schema::hasTable('aboutus')) {
                DB::statement('INSERT INTO about_us (title, description, image, created_at, updated_at) 
                              SELECT title, description, image, created_at, updated_at FROM aboutus');
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_us');
    }
};