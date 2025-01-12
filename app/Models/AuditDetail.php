<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_project_audit',
        'id_question',
        'exist',
        'document_evidence',
    ];

    public function projectAudit()
    {
        return $this->belongsTo(ProjectAudit::class, 'id_project_audit');
    }

    public function question()
    {
        return $this->belongsTo(Question::class, 'id_question');
    }
}
