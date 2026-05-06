// database/migrations/2024_01_01_000004_create_contents_contact_table.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contents_contact', function (Blueprint $table) {
            $table->id();
            $table->string('type', 100);
            $table->string('value', 255);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contents_contact');
    }
};