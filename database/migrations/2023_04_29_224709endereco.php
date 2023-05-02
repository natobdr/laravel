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
        Schema::create('endereco', function (Blueprint $table) {
            $table->id();
            $table->foreign('id')->references('id')->on('pessoas')->onDelete('cascade')->onUpdate('cascade');
            $table->char('end_tp_endereco');
            $table->string('end_nm_logradouro');
            $table->string('end_ds_complemento');
            $table->integer('end_nu_imovel');
            $table->string('end_nm_bairro');
            $table->string('end_nu_cep');
            $table->unsignedBigInteger('id_pessoa');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('END_endereco');
    }
};
