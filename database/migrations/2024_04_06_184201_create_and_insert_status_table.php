<?php

use Illuminate\Support\Facades\DB;
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
        Schema::create('status_task', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->smallInteger('status');
            $table->string("color", 7);
        });
        
        // Adicionar itens na tabela status_task
        DB::table('status_task')->insert([
            ['status' => 1, 'name' => 'ativo', 'color' => '#0000FF'],
            ['status' => 2, 'name' => 'concluído', 'color' => '#00FF7F'],
            ['status' => 3, 'name' => 'excluida', 'color' => '#808080']
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('status_task');
    }
};
