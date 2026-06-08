<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $pendingStatus = 'In Progress'; 

        if ($user->role === 'admin') {
            $stats = [
                'totalTasks'     => Task::count(),
                'completedTasks' => Task::where('status', 'Completed')->count(),
                'pendingTasks'   => Task::where('status', $pendingStatus)->count(),
                'overdueTasks'   => Task::where('status', '!=', 'Completed')->where('deadline', '<', now())->count(),
            ];
            
            $stats['personalProgress'] = 0;
            
            // 🌟 FIX: Eager loading with exact model assignment values
            $allocatedTasks = Task::with(['assignedTo'])->latest()->get();
            $members       = User::where('role', 'member')->with('tasks')->get();
            $upcomingTasks = collect(); 
        } else {
            $stats = [
                'totalTasks'     => Task::where('assigned_to', $user->id)->count(),
                'completedTasks' => Task::where('assigned_to', $user->id)->where('status', 'Completed')->count(),
                'pendingTasks'   => Task::where('assigned_to', $user->id)->where('status', $pendingStatus)->count(),
                'overdueTasks'   => Task::where('assigned_to', $user->id)->where('status', '!=', 'Completed')->where('deadline', '<', now())->count(),
            ];
            
            $stats['personalProgress'] = $stats['totalTasks'] > 0 
                ? round(($stats['completedTasks'] / $stats['totalTasks']) * 100) 
                : 0;
            
            $allocatedTasks = Task::with(['assignedTo'])->where('assigned_to', $user->id)->latest()->get();
            $members       = collect(); 
            $upcomingTasks = Task::where('assigned_to', $user->id)
                ->where('status', '!=', 'Completed')
                ->where('deadline', '>', now())
                ->orderBy('deadline')
                ->take(5)
                ->get();
        }

        $stats['completionPercentage'] = $stats['totalTasks'] > 0
            ? round(($stats['completedTasks'] / $stats['totalTasks']) * 100)
            : 0;

        return view('dashboard', compact('stats', 'allocatedTasks', 'members', 'upcomingTasks'));
    }
}