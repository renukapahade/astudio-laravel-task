<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timesheet extends Model
{
    use HasFactory;
    protected $fillable = ['task_name', 'date', 'hours', 'user_id', 'project_id'];

    // User relationship: One-to-One (inverse)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Project relationship: One-to-One (inverse)
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
