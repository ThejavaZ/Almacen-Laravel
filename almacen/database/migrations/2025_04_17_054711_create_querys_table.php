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
        Schema::create('querys', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id');
            $table->integer('material_id');
            $table->date('date');
            $table->string('canceled', 1)->default("N");
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('querys');
    }
};
