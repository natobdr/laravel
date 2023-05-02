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
        Schema::create('telefones', function (Blueprint $table) {
            $table->id();
            $table->foreign('id')->references('id')->on('pessoas')->onDelete('cascade')->onUpdate('cascade');
            $table->string('tel_cd_ddd');
            $table->string('tel_nu_telefone');
            $table->unsignedBigInteger('tel_id_pessoa');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('TEL_telefone');
    }
};
