<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'admin_id',
        'logo',
    ];

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    // 🌟 FIX: Pivot table ka naam 'team_members' set kiya taake User model se match kare
    public function members() 
    {
        return $this->belongsToMany(User::class, 'team_members'); 
    }

    // Blade templates ke smooth fallback control ke liye users alias extension
    public function users() 
    {
        return $this->belongsToMany(User::class, 'team_members'); 
    }

    public function tasks() 
    {
        return $this->hasMany(Task::class);
    }

    public function getMemberCount(): int
    {
        return $this->members()->count();
    }

    public function getCompletionPercentage(): float|int
    {
        $total = $this->tasks()->count();
        if ($total === 0) return 0;
        
        $completed = $this->tasks()->where('status', 'Completed')->count();
        return round(($completed / $total) * 100);
    }
}