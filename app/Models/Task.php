<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;

    // Columns that can be mass-assigned
    protected $fillable = [
        'title',
        'description',
        'status',
        'assigned_to',
    ];

    /**
     * Get the employee assigned to the task.
     */
    public function employee()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}
