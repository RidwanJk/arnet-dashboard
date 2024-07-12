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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('device');
            $table->unsignedBigInteger('type_id');
            $table->string('brand')->nullable();
            $table->string('serial');
            $table->unsignedBigInteger('sto_id');
            $table->timestamps();

            $table->foreign('sto_id')->references('id')->on('dropdowns')->onDelete('cascade');
            $table->foreign('type_id')->references('id')->on('dropdowns')->onDelete('cascade');
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
