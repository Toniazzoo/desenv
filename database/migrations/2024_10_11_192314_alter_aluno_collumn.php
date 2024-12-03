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
        Schema::disableForeignKeyConstraints();

        Schema::table('aluno', function (Blueprint $table) {
            $table->foreignId('categoria_id')
                ->after('telefone')
                ->constrained('categoria_formacao');
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('Aluno', function (Blueprint $table) {
            //
        });
    }
};
