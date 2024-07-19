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
        Schema::create('core', function (Blueprint $table) {
            $table->id();
            $table->string('total')->nullable()->default(0);       
            $table->string('underfive')->nullable()->default(0);       
            $table->string('morethanfive')->nullable()->default(0);       
            $table->string('morethanten')->nullable()->default(0);       
            $table->unsignedBigInteger('type_id');
            $table->string('year')->nullable()->default(0);            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
