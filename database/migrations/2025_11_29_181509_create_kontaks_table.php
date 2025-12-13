<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateKontaksTable extends Migration
{
public function up()
{
    Schema::create('kontaks', function (Blueprint $table) {
        $table->id(); // id_kontak
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->string('nama');
        $table->string('nomor_telepon');
        $table->string('email')->nullable();
        $table->text('alamat')->nullable();
        $table->string('foto')->nullable(); // jika ingin foto profil tetap ada
        $table->timestamps();
    });

    }


public function down()
{
Schema::dropIfExists('contacts');
}
}