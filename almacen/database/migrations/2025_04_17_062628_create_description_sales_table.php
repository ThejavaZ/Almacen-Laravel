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
        Schema::create('description_sales', function (Blueprint $table) {
            $table->id();
            $table->integer('sale_id');
            $table->integer('material_id');
            $table->string('description', 50);
            $table->integer('quantity');
            $table->double('price');
            $table->double('total');
            $table->string('available', 1)->default("S");
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('description_sales');
    }
};
