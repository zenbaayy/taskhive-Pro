<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    // Database structure configuration allocation
    protected $fillable = [
        'title',
        'description',
        'category',
        'priority',
        'status',
        'assigned_by',
        'assigned_to',
        'team_id',      // Ye add karein
    'attachment',
        'deadline'
    ];

    protected $casts = [
        'deadline' => 'datetime',
        'completion_date' => 'datetime',
    ];
    public function attachments()
{
    return $this->hasMany(TaskAttachment::class);
}

    // Relationships
    public function assignedBy()
    {
        return $this->belongsTo(User::class, 'assigned_by');
    }

    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

  

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    // Helper Methods
    public function isOverdue()
    {
        return $this->deadline < now() && $this->status != 'Completed';
    }
public function isCompleted()
{
    return $this->status === 'Completed';
}
    public function getRemainingTime()
    {
        if ($this->status === 'Completed') return 'Completed ✓';
        if ($this->isOverdue()) return 'Overdue!';

        $hours = $this->deadline->diffInHours(now());
        $days = $this->deadline->diffInDays(now());

        if ($hours < 1) return 'Less than 1 hour';
        if ($hours < 24) return $hours . ' hours left';
        return $days . ' days left';
    }

    public function getCategoryColor()
    {
        return match($this->category) {
            'Work' => '#6366F1',
            'Study' => '#3B82F6',
            'Personal' => '#EC4899',
            'Team' => '#10B981',
            default => '#6B7280'
        };
    }

    public function getProgressPercentage()
    {
        return match($this->status) {
            'Completed' => 100,
            'In Progress' => 50,
            'Pending' => 10,
            'Overdue' => 0,
            default => 0
        };
    }
}