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
        Schema::create('project_audits', function (Blueprint $table) {
            $table->id('id_project_audit'); // Kolom id_project_audit
            $table->foreignId('id_project')->constrained()->onDelete('cascade'); // Menghubungkan id_project dengan foreign key
            $table->foreignId('id_audit_process')->constrained()->onDelete('cascade'); // Kolom audit_process
            $table->string('level'); // Kolom level
            $table->string('status'); // Kolom level
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_audits');
    }
};
