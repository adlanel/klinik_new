<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FixFasilitasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Only execute if the table exists
        if (Schema::hasTable('fasilitas')) {
            // Modify the id column to make it auto-increment
            DB::statement('ALTER TABLE fasilitas MODIFY id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY');
        } else {
            // Create the table if it doesn't exist
            Schema::create('fasilitas', function (Blueprint $table) {
                $table->id(); // This creates an auto-incrementing bigInteger
                $table->string('title');
                $table->string('slug');
                $table->text('short_description')->nullable();
                $table->longText('description')->nullable();
                $table->string('image')->nullable();
                $table->enum('status', ['active', 'inactive'])->default('active');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // No need to drop the table in the down method
        // as we're only ensuring the id is auto-increment
    }
}