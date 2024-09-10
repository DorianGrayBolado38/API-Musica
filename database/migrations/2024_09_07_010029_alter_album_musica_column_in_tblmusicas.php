<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterAlbumMusicaColumnInTblmusicas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tblmusicas', function (Blueprint $table) {
            $table->string('albumMusica')->change(); // Altera para VARCHAR
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tblmusicas', function (Blueprint $table) {
            // Aqui você deve definir o tipo original se necessário, por exemplo:
            // $table->date('albumMusica')->change();
        });
    }
}
