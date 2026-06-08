<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Models\TaskAttachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        
        // Base Query setting based on Authorization Rules
        if ($user->role === 'admin') {
            $query = Task::with(['assignedBy', 'assignedTo', 'team']);
        } else {
            $query = Task::where('assigned_to', $user->id)->with(['assignedBy', 'team']);
        }
// Category Filter
if ($request->filled('category')) {
    $query->where('category', $request->category);
}
        // 🎯 INTERCEPT ROUTE QUERY: Handle "View Overdue Logs" Red Button request dynamically
        if ($request->has('status') && $request->status === 'overdue') {
            $query->where(function($q) {
                $q->where('status', 'Overdue')
                  ->orWhere(function($subQ) {
                      $subQ->where('status', '!=', 'Completed')
                           ->where('deadline', '<', now());
                  });
            });
        }

        // Fetch paginated execution dataset
        $tasks = $query->latest()->paginate(15)->withQueryString();

        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        $teams = auth()->user()->adminTeams ?? collect();
        $teamMembers = $teams->isNotEmpty() 
            ? User::whereIn('id', DB::table('team_members')->whereIn('team_id', $teams->pluck('id'))->pluck('user_id'))->get()
            : collect();

        return view('tasks.create', compact('teams', 'teamMembers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required',
            'priority' => 'required',
            'deadline' => 'required|date',
            'assigned_to' => 'nullable|exists:users,id',
            'team_id' => 'nullable|exists:teams,id',
            'attachments.*' => 'file|mimes:pdf,doc,docx,jpg,png|max:5120',
        ]);

        $data = $validated;
        $data['status'] = 'Pending';
        $data['assigned_by'] = auth()->id();
        $data['assigned_to'] = $request->assigned_to ?? auth()->id();

        $task = Task::create($data);

        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $path = $file->store('attachments', 'public');
                $task->attachments()->create([
                    'file_path' => $path,
                    'file_name' => $file->getClientOriginalName(),
                    'uploaded_by' => auth()->id(),
                ]);
            }
        }

        return redirect()->route('tasks.index')->with('success', 'Task created successfully!');
    }

    public function show(Task $task)
    {
        $task->load(['assignedBy', 'assignedTo', 'team', 'attachments']);
        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        $users = User::all();
        return view('tasks.edit', compact('task', 'users'));
    }

    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|in:Study,Work,Personal,Team',
            'priority' => 'required|in:High,Medium,Low',
            'status' => 'required|in:Pending,In Progress,Completed,Overdue',
            'deadline' => 'required|date',
            'assigned_to' => 'nullable|exists:users,id',
        ]);

        if ($validated['status'] === 'Completed' && $task->status !== 'Completed') {
            $validated['completion_date'] = now();
        }

        $task->update($validated);
        return redirect()->route('tasks.show', $task)->with('success', 'Task updated successfully!');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully!');
    }

    // Attachment Features
    public function uploadFile(Request $request, Task $task)
    {
        $request->validate(['file' => 'required|file|max:51200']);
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $path = $file->store('task-attachments', 'public');
            $task->attachments()->create([
                'file_path' => $path,
                'file_name' => $file->getClientOriginalName(),
                'uploaded_by' => auth()->id(),
            ]);
            return response()->json(['message' => 'File uploaded!']);
        }
    }

    public function deleteFile(Task $task, $attachmentId)
    {
        $attachment = $task->attachments()->find($attachmentId);
        if ($attachment) {
            Storage::disk('public')->delete($attachment->file_path);
            $attachment->delete();
            return response()->json(['message' => 'File deleted!']);
        }
        return response()->json(['error' => 'Not found!'], 404);
    }

    // Filter Feature
    public function filter(Request $request)
    {
        $user = auth()->user();
        $query = $user->role === 'admin' ? Task::query() : Task::where('assigned_to', $user->id);

        if ($request->filled('status')) $query->where('status', $request->status);
        if ($request->filled('priority')) $query->where('priority', $request->priority);
        
        $tasks = $query->with(['assignedBy', 'assignedTo'])->latest()->paginate(15);
        return view('tasks.index', compact('tasks'));
    }

 // 🔄 Ajax Status Update Function
    public function updateStatus(Request $request, Task $task)
    {
        $request->validate([
            'status' => 'required|in:Pending,In Progress,Completed,Overdue',
        ]);

        // Update task status
        $task->update([
            'status' => $request->status,
            'completion_date' => $request->status === 'Completed' ? now() : null
        ]);

        // Return JSON response
        return response()->json([
            'success' => true,
            'message' => 'Status updated successfully!',
            'status' => $task->status
        ]);
    }
} // Class closing bracket