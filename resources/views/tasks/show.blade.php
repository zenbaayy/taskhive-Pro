<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                <i class="fas fa-eye text-indigo-600 mr-2"></i>Task Details
            </h2>
            <div class="flex gap-2">
                <a href="{{ route('tasks.edit', $task) }}" class="bg-indigo-600 text-white font-semibold py-2 px-4 rounded-lg hover:bg-indigo-700 transition">
                    <i class="fas fa-edit mr-2"></i>Edit
                </a>
                <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="display: inline;" onsubmit="return confirm('Delete this task?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-600 text-white font-semibold py-2 px-4 rounded-lg hover:bg-red-700 transition">
                        <i class="fas fa-trash mr-2"></i>Delete
                    </button>
                </form>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Main Card -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <!-- Title -->
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">
                        {{ $task->title }}
                    </h1>

                    <!-- Status & Badges -->
                    <div class="flex flex-wrap gap-3 mb-6">
                        <!-- Status -->
                        @if($task->status === 'Completed')
                            <span class="px-4 py-2 text-sm font-semibold text-green-700 dark:text-green-200 bg-green-100 dark:bg-green-900 rounded-lg flex items-center gap-2">
                                <i class="fas fa-check-circle"></i> Completed
                            </span>
                        @elseif($task->status === 'Overdue')
                            <span class="px-4 py-2 text-sm font-semibold text-red-700 dark:text-red-200 bg-red-100 dark:bg-red-900 rounded-lg flex items-center gap-2">
                                <i class="fas fa-exclamation-circle"></i> Overdue
                            </span>
                        @elseif($task->status === 'In Progress')
                            <span class="px-4 py-2 text-sm font-semibold text-yellow-700 dark:text-yellow-200 bg-yellow-100 dark:bg-yellow-900 rounded-lg flex items-center gap-2">
                                <i class="fas fa-spinner"></i> In Progress
                            </span>
                        @else
                            <span class="px-4 py-2 text-sm font-semibold text-gray-700 dark:text-gray-200 bg-gray-100 dark:bg-gray-700 rounded-lg flex items-center gap-2">
                                <i class="fas fa-circle"></i> Pending
                            </span>
                        @endif

                        <!-- Priority -->
                        @if($task->priority === 'High')
                            <span class="px-4 py-2 text-sm font-semibold text-red-700 dark:text-red-200 bg-red-100 dark:bg-red-900 rounded-lg">
                                🔴 High Priority
                            </span>
                        @elseif($task->priority === 'Medium')
                            <span class="px-4 py-2 text-sm font-semibold text-orange-700 dark:text-orange-200 bg-orange-100 dark:bg-orange-900 rounded-lg">
                                🟡 Medium Priority
                            </span>
                        @else
                            <span class="px-4 py-2 text-sm font-semibold text-green-700 dark:text-green-200 bg-green-100 dark:bg-green-900 rounded-lg">
                                🟢 Low Priority
                            </span>
                        @endif

                        <!-- Category -->
                        <span class="px-4 py-2 text-sm font-semibold rounded-lg" 
                            style="background-color: {{ $task->getCategoryColor() }}20; color: {{ $task->getCategoryColor() }};">
                            {{ $task->category }}
                        </span>
                    </div>

                    <!-- Progress Bar -->
                    <div class="mb-6">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-sm font-semibold text-gray-700 dark:text-gray-300">Progress</span>
                            <span class="text-sm font-bold text-indigo-600 dark:text-indigo-400">{{ $task->getProgressPercentage() }}%</span>
                        </div>
                        <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-3">
                            <div class="bg-gradient-to-r from-indigo-600 to-pink-600 h-3 rounded-full transition duration-300" 
                                style="width: {{ $task->getProgressPercentage() }}%"></div>
                        </div>
                    </div>

                    <!-- Description -->
                    @if($task->description)
                        <div class="mb-6 pb-6 border-b border-gray-200 dark:border-gray-700">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">
                                <i class="fas fa-align-left text-indigo-600 mr-2"></i>Description
                            </h3>
                            <p class="text-gray-700 dark:text-gray-300 leading-relaxed">
                                {{ $task->description }}
                            </p>
                        </div>
                    @endif

                    <!-- Meta Information -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pb-6 border-b border-gray-200 dark:border-gray-700">
                        <!-- Deadline -->
                        <div>
                            <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                <i class="fas fa-calendar-alt text-indigo-600 mr-2"></i>Deadline
                            </h4>
                            <p class="text-lg font-semibold text-gray-900 dark:text-white">
                                {{ $task->deadline->format('M d, Y - h:i A') }}
                            </p>
                            @if(!$task->isCompleted())
                                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                                    {{ $task->getRemainingTime() }}
                                </p>
                            @endif
                        </div>

                        <!-- Assigned To -->
                        <div>
                            <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                <i class="fas fa-user text-indigo-600 mr-2"></i>Assigned To
                            </h4>
                            @if($task->assignedTo)
                                <p class="text-lg font-semibold text-gray-900 dark:text-white">
                                    {{ $task->assignedTo->name }}
                                </p>
                            @else
                                <p class="text-gray-600 dark:text-gray-400">Not assigned</p>
                            @endif
                        </div>

                        <!-- Created By -->
                        <div>
                            <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                <i class="fas fa-user-circle text-indigo-600 mr-2"></i>Created By
                            </h4>
                            <p class="text-lg font-semibold text-gray-900 dark:text-white">
                                {{ $task->assignedBy->name }}
                            </p>
                        </div>

                        <!-- Created Date -->
                        <div>
                            <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                <i class="fas fa-clock text-indigo-600 mr-2"></i>Created
                            </h4>
                            <p class="text-lg font-semibold text-gray-900 dark:text-white">
                                {{ $task->created_at->format('M d, Y') }}
                            </p>
                        </div>
                    </div>

                    <!-- Team Info -->
                    @if($task->team)
                        <div class="mb-6 pb-6 border-b border-gray-200 dark:border-gray-700">
                            <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                <i class="fas fa-users text-indigo-600 mr-2"></i>Team
                            </h4>
                            <p class="text-lg font-semibold text-gray-900 dark:text-white">
                                {{ $task->team->name }}
                            </p>
                        </div>
                    @endif

                    <!-- Attachments -->
                    @if($task->attachments->count() > 0)
                        <div class="mb-6 pb-6 border-b border-gray-200 dark:border-gray-700">
                            <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-4">
                                <i class="fas fa-file-alt text-indigo-600 mr-2"></i>Attachments
                            </h4>
                            <div class="space-y-2">
                                @foreach($task->attachments as $attachment)
                                    <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                        <div class="flex items-center gap-3">
                                            <i class="fas fa-file text-indigo-600"></i>
                                            <div>
                                                <p class="font-medium text-gray-900 dark:text-white">
                                                    {{ $attachment->file_name }}
                                                </p>
                                                <p class="text-xs text-gray-600 dark:text-gray-400">
                                                    {{ $attachment->getFormattedSize() }}
                                                </p>
                                            </div>
                                        </div>
                                        <a href="{{ asset('storage/' . $attachment->file_path) }}" 
                                            download class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-600">
                                            <i class="fas fa-download"></i>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Update Status Card -->
            @if(auth()->user()->id === $task->assigned_to || auth()->user()->id === $task->assigned_by)
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                            <i class="fas fa-tasks text-indigo-600 mr-2"></i>Update Status
                        </h3>
                        <form action="{{ route('tasks.update', $task) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <input type="hidden" name="title" value="{{ $task->title }}">
                            <input type="hidden" name="description" value="{{ $task->description }}">
                            <input type="hidden" name="category" value="{{ $task->category }}">
                            <input type="hidden" name="priority" value="{{ $task->priority }}">
                            <input type="hidden" name="deadline" value="{{ $task->deadline }}">

                            <div class="flex gap-3 mb-4">
                                <select name="status" class="flex-1 px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-indigo-500">
                                    <option value="Pending" {{ $task->status === 'Pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="In Progress" {{ $task->status === 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                    <option value="Completed" {{ $task->status === 'Completed' ? 'selected' : '' }}>Completed</option>
                                </select>
                                <button type="submit" class="bg-indigo-600 text-white font-semibold py-2 px-6 rounded-lg hover:bg-indigo-700 transition">
                                    Update
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <form action="{{ route('tasks.upload', $task) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="file" class="text-sm">
    <button type="submit" class="bg-indigo-600 text-white px-3 py-1 rounded">Upload</button>
</form>

<div class="mt-4">
    @foreach($task->attachments as $file)
        <div class="flex items-center justify-between p-2 bg-gray-50 dark:bg-gray-700 rounded mb-2">
            <a href="{{ asset('storage/' . $file->file_path) }}" target="_blank" class="text-blue-500 hover:underline">
                {{ $file->file_name }}
            </a>
            @if(auth()->user()->role === 'admin')
               <form action="{{ route('attachments.destroy', [$task->id, $file->id]) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit" class="text-red-500 text-xs">Delete</button>
</form>
            @endif
        </div>
    @endforeach
</div>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</x-app-layout>
