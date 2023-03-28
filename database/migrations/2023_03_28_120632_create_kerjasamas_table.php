<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKerjasamasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kerjasamas', function (Blueprint $table) {
            $table->id('id_kerjasama');
            $table->foreignId('id_user')->references('id')->on('users');
            $table->foreignId('id_kategori')->references('id_kategori')->on('kategoris');
            $table->string('nama_instansi');
            $table->string('nomor_mou');
            $table->string('jenis_kegiatan');
            $table->string('manfaat');
            $table->string('implementasi');
            $table->date('tgl_mulai');
            $table->date('tgl_berakhir');
            $table->string('status', 20)->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kerjasamas');
    }
}
