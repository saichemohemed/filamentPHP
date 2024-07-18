<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\TaskStatus;

class Tasks extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'project_id',
        'status',
    ];

    protected $casts = [
        'status' => TaskStatus::class,
    ];

    public function project()
    {
        return $this->belongsTo(Projects::class);
    }
}
