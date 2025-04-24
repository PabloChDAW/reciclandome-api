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
        Schema::create('point_type', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('point_id');
            $table->foreign('point_id')
                  ->references('id')
                  ->on('points')
                  ->unUpdate('cascade')
                  ->onDelete('cascade');

            $table->unsignedBigInteger('type_id');
            $table->foreign('type_id')
                ->references('id')
                ->on('types')
                ->unUpdate('cascade')
                ->onDelete('cascade');

            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('point_type');
    }
};
