<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        {
            Schema::create('tasks', function (Blueprint $table) {
                /* Stavio sam uuid umesto auto increment int id-ja */
                $table->uuid('id')->primary();
                $table->string('title');
                $table->string('description');
                $table->boolean('isCompleted');
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
