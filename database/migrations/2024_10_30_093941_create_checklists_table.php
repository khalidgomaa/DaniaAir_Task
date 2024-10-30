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
            Schema::create('checklists', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('inspector');
                $table->date('date'); 
                $table->time('time'); 
                $table->timestamps();
    
                $table->foreign('inspector')->references('id')->on('users')->onDelete('cascade');
            });
    
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checklists');
    }
};
