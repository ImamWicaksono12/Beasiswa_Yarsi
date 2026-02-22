<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('pengajuan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mhs_id')->constrained('mahasiswa');
            $table->foreignId('beasiswa_id')->constrained('beasiswa');
            $table->date('tanggal');
            $table->string('status'); 
            $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan');
    }
};
