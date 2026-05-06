// database/migrations/2024_01_01_000006_create_tech_stack_selection_table.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tech_stack_selection', function (Blueprint $table) {
            $table->id();
            $table->string('stack_name', 50)->unique();
            $table->boolean('selected')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tech_stack_selection');
    }
};