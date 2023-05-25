<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_detail_sumber_days', function (Blueprint $table) {
            $table->id();
            $table->string('id_sumber_daya')->nullable();
            $table->string('pemilik')->nullable();
            $table->string('alamat')->nullable();
            $table->string('masa_panen')->nullable();
            $table->string('satuan_panen')->nullable();
            $table->string('jumlah_hasil')->nullable();
            $table->string('satuan_hasil')->nullable();
            $table->string('jumlah _anggota')->nullable();
            $table->string('luas')->nullable();
            $table->string('satuan_luas')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('data_detail_sumber_days');
    }
};
