<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectAudit extends Model
{
    use HasFactory;

    protected $table = 'project_audits'; // Nama tabel
    protected $primaryKey = 'id_project_audit'; // Primary key

    protected $fillable = [
        'id_project',
        'id_audit_process',
        'level',
    ];

    // Relasi dengan Project (jika ada model Project)
    public function project()
    {
        return $this->belongsTo(Project::class, 'id_project', 'id_project');
    }
    public function processAudit()
    {
        return $this->belongsTo(ProcessAudit::class, 'id_audit_process', 'id_process_audit');
    }

}
