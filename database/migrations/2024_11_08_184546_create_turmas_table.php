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

        Schema::disableForeignKeyConstraints();//desabilita a chave estrangeira

        Schema::create('turma', function (Blueprint $table) {
            $table->id();
            $table->string('nome',150);
            $table->foreignId('professor_id')->constrained('professor');
            $table->foreignId('curso_id')->constrained(table: 'curso');
            $table->string('codigo',20)->nullable();
            $table->date('data_inicio')->nullable();
            $table->date(column: 'data_fim')->nullable();
            $table->timestamps();
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('turma');
    }
};
