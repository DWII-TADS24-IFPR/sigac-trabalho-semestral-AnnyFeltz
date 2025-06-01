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
        Schema::create('solicitacoes_horas', function (Blueprint $table) {
            $table->id();
            $table->decimal('horas_solicitadas', 5, 2);
            $table->text('descricao')->nullable();
            $table->enum('status', ['pendente', 'aprovado', 'recusado'])->default('pendente');
            $table->text('comentario_admin')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreignId('aluno_id')->constrained('alunos')->onDelete('cascade');
            $table->foreignId('categoria_id')->constrained('categorias')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicitacoes_horas');
    }
};
