<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('grup_kontak', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('grup_id');
            $table->unsignedBigInteger('kontak_id');
            $table->timestamps();

            $table->foreign('grup_id')->references('id')->on('grups')->onDelete('cascade');
            $table->foreign('kontak_id')->references('id')->on('kontaks')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('grup_kontak');
    }
};
