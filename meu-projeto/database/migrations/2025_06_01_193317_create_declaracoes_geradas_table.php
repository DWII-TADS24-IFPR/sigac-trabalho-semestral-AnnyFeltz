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
        Schema::create('declaracoes_geradas', function (Blueprint $table) {
            $table->id();
            $table->string('hash')->unique();
            $table->string('url_pdf')->nullable();
            $table->date('data_geracao');
            $table->softDeletes();
            $table->timestamps();

            $table->foreignId('aluno_id')->constrained('alunos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('declaracoes_geradas');
    }
};
