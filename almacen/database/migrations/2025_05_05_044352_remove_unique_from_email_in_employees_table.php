<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('employees', function (Blueprint $table) {
            // Eliminar el índice único primero
            $table->dropUnique('employees_email_unique');
            
            // Opcional: Si quieres mantenerlo como string normal
            $table->string('email', 255)->change();
        });
    }

    public function down()
    {
        Schema::table('employees', function (Blueprint $table) {
            // Para revertir: volver a añadir el unique
            $table->string('email', 255)->unique()->change();
        });
    }
};
