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
        Schema::create('solicitacoes', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('comprovante');
            $table->integer('carga_horaria');
            $table->enum('status', ['pendente', 'aprovado', 'rejeitado'])->default('pendente');

            $table->softDeletes();
            $table->timestamps();

            $table->foreignId('aluno_id')->constrained('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicitacoes');
    }
};
