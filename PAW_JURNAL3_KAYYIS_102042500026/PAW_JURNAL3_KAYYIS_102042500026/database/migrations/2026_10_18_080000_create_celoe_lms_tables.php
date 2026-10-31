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
        // Tabel Mata Kuliah
  // Tabel Mata Kuliah
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('kode_mk', 20)->unique();
            $table->string('nama_mk');
            $table->text('deskripsi')->nullable();
            $table->integer('sks')->default(3);
            $table->foreignId('dosen_id')->nullable()->constrained('users')->cascadeOnDelete();
            $table->timestamps();
        });
        // Tabel Materi Pembelajaran
       // Tabel Materi Pembelajaran
        Schema::create('materials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained('courses')->cascadeOnDelete();
            $table->string('judul');
            $table->text('konten')->nullable();
            $table->integer('minggu_ke')->default(1);
            $table->integer('urutan')->default(1);
            $table->string('file_path')->nullable();
            $table->timestamps();
        });

        // Tabel Tugas / Assignments
        Schema::create('assignments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained('courses')->cascadeOnDelete();
            $table->string('judul');
            $table->text('deskripsi')->nullable();
            $table->dateTime('deadline')->nullable();
            $table->timestamps();
        });

        // Tabel Pengumpulan Jawaban Mahasiswa
        Schema::create('submissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assignment_id')->constrained('assignments')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->longText('jawaban');
            $table->dateTime('submitted_at');
            $table->unique(['assignment_id', 'user_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submissions');
        Schema::dropIfExists('assignments');
        Schema::dropIfExists('materials');
        Schema::dropIfExists('courses');
    }
};