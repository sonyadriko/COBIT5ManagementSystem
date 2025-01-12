<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProcessAudit extends Model
{
    use HasFactory;

    protected $table = 'process_audits'; // Nama tabel
    protected $primaryKey = 'id_process_audit'; // Primary key
    protected $fillable = ['name', 'desc']; // Kolom yang dapat diisi

    public function projectAudits()
    {
        return $this->hasMany(ProjectAudit::class, 'id_audit_process', 'id_process_audit');
    }
}
