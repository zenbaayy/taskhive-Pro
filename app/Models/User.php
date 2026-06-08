<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'avatar',
        'phone',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Relationships
    public function tasks()
    {
        return $this->hasMany(Task::class, 'assigned_to');
    }

    public function createdTasks()
    {
        return $this->hasMany(Task::class, 'assigned_by');
    }

    public function teams()
    {
        return $this->belongsToMany(Team::class, 'team_members');
    }

    public function adminTeams()
    {
        return $this->hasMany(Team::class, 'admin_id');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    // Helper Methods
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function getOverdueTasks()
    {
        return $this->tasks()
            ->where('status', '!=', 'Completed')
            ->where('deadline', '<', now())
            ->count();
    }
}