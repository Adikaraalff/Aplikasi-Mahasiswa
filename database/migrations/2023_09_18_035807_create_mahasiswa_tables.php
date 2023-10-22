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
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->string('nim');
            $table->foreignId('id_kelas')->constrained('kelas')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('id_prodi')->constrained('prodi')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('nohp');
            $table->string('email');
            $table->string('username');
            $table->string('password');
            $table->string('image');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswa');
    }
};
