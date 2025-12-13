<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('grups', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // tiap user punya grup masing2
            $table->string('nama');
            $table->text('deskripsi')->nullable();
            $table->timestamps();

            // relasi user
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('grups');
    }
};
