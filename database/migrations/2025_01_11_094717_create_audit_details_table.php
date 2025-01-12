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
        Schema::create('audit_details', function (Blueprint $table) {
            $table->id(); // Auto-increment primary key
            $table->foreignId('id_project_audit')->constrained()->onDelete('cascade'); // Foreign key referencing 'project_audits'
            $table->foreignId('id_question')->constrained()->onDelete('cascade'); // Foreign key referencing 'questions'
            $table->boolean('exist')->default(0); // Checkbox value (0 or 1)
            $table->text('document_evidence')->nullable(); // Textarea for document evidence
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audit_details');
    }
};
