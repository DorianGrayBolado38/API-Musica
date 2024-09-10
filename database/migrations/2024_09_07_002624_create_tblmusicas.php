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
        Schema::create('tblmusicas', function (Blueprint $table) {
            $table->id("codigo");  // Define a chave primária
            $table->string('nomeMusica', 30);    // nomeLivro varchar(30)
            $table->string('generoMusica', 10);  // generoLivro varchar(10)
            $table->date("albumMusica");           // anoLivro date
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tblmusicas');
    }
};
