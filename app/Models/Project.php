<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'id_project';

    protected $fillable = [
        'name',
        'auditor',
        'audit_at',
    ];

    protected $dates = [
        'audit_at',
        'deleted_at',
    ];
}
