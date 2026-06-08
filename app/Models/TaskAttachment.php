<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage; // Ye add karna zaroori hai

class TaskAttachment extends Model
{
    use HasFactory;

    protected $fillable = ['task_id', 'file_path', 'file_name', 'file_size', 'file_type', 'uploaded_by'];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function uploadedBy()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    /**
     * Get the formatted file size for display
     */
    public function getFormattedSize()
    {
        // Agar database mein 'file_size' column hai toh use use karein, 
        // warna storage se size fetch karein
        $bytes = $this->file_size ?? Storage::disk('public')->size($this->file_path);
        
        if ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            return number_format($bytes / 1024, 2) . ' KB';
        }
        return $bytes . ' bytes';
    }
}