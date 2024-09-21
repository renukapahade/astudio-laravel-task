<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'department', 'start_date', 'end_date', 'status'];

    // Define many-to-many relationship with User through Timesheet
    public function users()
    {
        return $this->hasManyThrough(User::class, Timesheet::class);
    }

    // Define one-to-many relationship with Timesheet
    public function timesheets()
    {
        return $this->hasMany(Timesheet::class);
    }
}
