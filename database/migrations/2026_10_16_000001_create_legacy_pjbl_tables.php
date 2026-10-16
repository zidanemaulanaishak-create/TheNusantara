<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('tb_login')) {
            Schema::create('tb_login', function (Blueprint $table) {
                $table->increments('id');
                $table->string('email', 100)->unique();
                $table->string('password', 255);
            });
        }

        if (! Schema::hasTable('tb_pulau')) {
            Schema::create('tb_pulau', function (Blueprint $table) {
                $table->increments('id');
                $table->string('nama', 100);
                $table->string('gambar', 255)->nullable();
                $table->text('keterangan')->nullable();
                $table->text('deskripsi')->nullable();
                $table->timestamp('created_at')->useCurrent();
                $table->integer('views')->default(0);
                $table->string('herosection', 255)->nullable();
            });
        }

        if (! Schema::hasTable('tb_informasi')) {
            Schema::create('tb_informasi', function (Blueprint $table) {
                $table->increments('id');
                $table->string('judul', 255)->nullable();
                $table->text('keterangan')->nullable();
                $table->string('pulau', 100)->nullable();
                $table->unsignedInteger('pulau_id')->nullable();
                $table->string('gambar', 255)->nullable();
                $table->string('gambar2', 255)->nullable();
                $table->string('gambar3', 255)->nullable();
                $table->string('gambar4', 255)->nullable();
                $table->string('caption2', 255)->nullable();
                $table->string('caption3', 255)->nullable();
                $table->string('caption4', 255)->nullable();
                $table->timestamp('created_at')->useCurrent();
                $table->text('pengertian')->nullable();
                $table->text('cara_bermain')->nullable();
                $table->text('filosofi')->nullable();
                $table->text('asal_usul')->nullable();
            });
        }

        if (! Schema::hasTable('tb_galeri')) {
            Schema::create('tb_galeri', function (Blueprint $table) {
                $table->increments('id');
                $table->string('judul', 100)->nullable();
                $table->string('gambar', 255)->nullable();
                $table->timestamp('created_at')->useCurrent();
            });
        }

        if (! Schema::hasTable('tb_faq')) {
            Schema::create('tb_faq', function (Blueprint $table) {
                $table->increments('id');
                $table->string('pertanyaan', 255);
                $table->text('jawaban');
                $table->timestamp('created_at')->useCurrent();
            });
        }

        if (! Schema::hasTable('tb_laporan')) {
            Schema::create('tb_laporan', function (Blueprint $table) {
                $table->increments('id');
                $table->string('nama', 100)->nullable();
                $table->string('email', 100);
                $table->text('pesan')->nullable();
                $table->enum('status', ['pending', 'proses', 'selesai'])->default('pending');
                $table->timestamp('created_at')->useCurrent();
                $table->boolean('notif')->default(0);
            });
        }

        if (! Schema::hasTable('tb_tentang')) {
            Schema::create('tb_tentang', function (Blueprint $table) {
                $table->increments('id');
                $table->string('judul', 250)->nullable();
                $table->text('isi')->nullable();
                $table->string('gambar', 225)->nullable();
                $table->string('gambar2', 225)->nullable();
                $table->string('gambar3', 225)->nullable();
            });
        }

        if (! Schema::hasTable('tb_pengunjung')) {
            Schema::create('tb_pengunjung', function (Blueprint $table) {
                $table->increments('id');
                $table->date('tanggal')->unique();
                $table->integer('jumlah')->default(0);
            });
        }

        if (! Schema::hasTable('tb_catatan')) {
            Schema::create('tb_catatan', function (Blueprint $table) {
                $table->increments('id');
                $table->string('email', 100);
                $table->text('isi');
                $table->dateTime('dibuat')->useCurrent();
            });
        }
    }

    public function down(): void
    {
        // Sengaja tidak drop tabel legacy agar data lama aman.
    }
};
