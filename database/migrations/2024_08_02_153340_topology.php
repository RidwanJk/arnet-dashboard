<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Laravel\Prompts\table;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('topology', function (Blueprint $table) {
            $table->id();
            $table->string('file')->nullable();
            $table-> unsignedBigInteger('device_id');
            $table->timestamp('last_updated')->nullable();

            $table->foreign('device_id')-> references('id') -> on ('dropdowns')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        
    }
};
