<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                <i class="fas fa-tasks text-indigo-600 mr-2"></i>My Tasks
            </h2>
            <a href="{{ route('tasks.create') }}" class="bg-gradient-to-r from-indigo-600 to-indigo-700 text-white font-semibold py-2 px-4 rounded-lg hover:shadow-lg transition">
                <i class="fas fa-plus mr-2"></i>New Task
            </a>
        </div>
    </x-slot>

    <style>
        .force-black-text {
            color: #000000 !important;
        }
        .force-black-text::placeholder {
            color: #4b5563 !important;
        }
        .force-black-text option {
            color: #000000 !important;
            background-color: #ffffff !important;
        }
        .status-select {
            background-color: white !important;
            color: black !important;
            font-weight: bold !important;
            border: 2px solid #e5e7eb !important;
        }
        .status-select:hover {
            border-color: #4f46e5 !important;
        }
    </style>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Filters Section -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <form action="{{ route('tasks.filter') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Search</label>
                            <input type="text" name="search" placeholder="Search tasks..." value="{{ request('search') }}"
                                class="w-full px-4 py-2 border border-gray-400 dark:border-gray-600 rounded-lg bg-white focus:ring-2 focus:ring-indigo-500 force-black-text">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Status</label>
                            <select name="status" class="w-full px-4 py-2 border border-gray-400 dark:border-gray-600 rounded-lg bg-white focus:ring-2 focus:ring-indigo-500 force-black-text">
                                <option value="">All Status</option>
                                <option value="Pending" {{ request('status') === 'Pending' ? 'selected' : '' }}>Pending</option>
                                <option value="In Progress" {{ request('status') === 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                <option value="Completed" {{ request('status') === 'Completed' ? 'selected' : '' }}>Completed</option>
                                <option value="Overdue" {{ request('status') === 'Overdue' ? 'selected' : '' }}>Overdue</option>
                            </select>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Priority</label>
                            <select name="priority" class="w-full px-4 py-2 border border-gray-400 dark:border-gray-600 rounded-lg bg-white focus:ring-2 focus:ring-indigo-500 force-black-text">
                                <option value="">All Priorities</option>
                                <option value="High" {{ request('priority') === 'High' ? 'selected' : '' }}>High</option>
                                <option value="Medium" {{ request('priority') === 'Medium' ? 'selected' : '' }}>Medium</option>
                                <option value="Low" {{ request('priority') === 'Low' ? 'selected' : '' }}>Low</option>
                            </select>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Category</label>
                            <select name="category" class="w-full px-4 py-2 border border-gray-400 dark:border-gray-600 rounded-lg bg-white focus:ring-2 focus:ring-indigo-500 force-black-text">
                                <option value="">All Categories</option>
                                <option value="Work" {{ request('category') === 'Work' ? 'selected' : '' }}>Work</option>
                                <option value="Study" {{ request('category') === 'Study' ? 'selected' : '' }}>Study</option>
                                <option value="Personal" {{ request('category') === 'Personal' ? 'selected' : '' }}>Personal</option>
                                <option value="Team" {{ request('category') === 'Team' ? 'selected' : '' }}>Team</option>
                            </select>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Tasks Grid -->
            @if($tasks->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($tasks as $task)
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg hover:shadow-lg transition duration-300 transform hover:-translate-y-1">
                            <div class="p-6">
                                <div class="flex justify-between items-start mb-3">
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white flex-1">
                                        <a href="{{ route('tasks.show', $task) }}" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition">
                                            {{ $task->title }}
                                        </a>
                                    </h3>
                                    <div class="flex gap-2">
                                        <a href="{{ route('tasks.edit', $task) }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-600">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="display: inline;" onsubmit="return confirm('Delete this task?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-600">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>

                                @if($task->description)
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-4 line-clamp-2">
                                        {{ $task->description }}
                                    </p>
                                @endif

                                <!-- Badges & Status Dropdown -->
                                <div class="flex flex-wrap gap-2 mb-4 items-center">
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full" 
                                        style="background-color: {{ $task->getCategoryColor() }}20; color: {{ $task->getCategoryColor() }};">
                                        {{ $task->category }}
                                    </span>
                                    
                                    @if($task->priority === 'High')
                                        <span class="px-3 py-1 text-xs font-semibold text-red-700 dark:text-red-200 bg-red-100 dark:bg-red-900 rounded-full">
                                            {{ $task->priority }}
                                        </span>
                                    @elseif($task->priority === 'Medium')
                                        <span class="px-3 py-1 text-xs font-semibold text-orange-700 dark:text-orange-200 bg-orange-100 dark:bg-orange-900 rounded-full">
                                            {{ $task->priority }}
                                        </span>
                                    @else
                                        <span class="px-3 py-1 text-xs font-semibold text-green-700 dark:text-green-200 bg-green-100 dark:bg-green-900 rounded-full">
                                            {{ $task->priority }}
                                        </span>
                                    @endif

                                    <!-- Status Dropdown with AJAX Update -->
                                    <select onchange="updateStatus({{ $task->id }}, this.value)" class="px-3 py-1 text-xs font-semibold rounded-full cursor-pointer status-select">
                                        <option value="Pending" {{ $task->status === 'Pending' ? 'selected' : '' }} style="background-color: white; color: black;">◯ Pending</option>
                                        <option value="In Progress" {{ $task->status === 'In Progress' ? 'selected' : '' }} style="background-color: white; color: black;">⏳ In Progress</option>
                                        <option value="Completed" {{ $task->status === 'Completed' ? 'selected' : '' }} style="background-color: white; color: black;">✓ Completed</option>
                                        <option value="Overdue" {{ $task->status === 'Overdue' ? 'selected' : '' }} style="background-color: white; color: black;">⚠ Overdue</option>
                                    </select>
                                </div>

                                <!-- Progress Bar -->
                                <div class="mb-4">
                                    <div class="flex justify-between items-center mb-1">
                                        <span class="text-xs text-gray-600 dark:text-gray-400">Progress</span>
                                        <span class="text-xs font-semibold text-gray-900 dark:text-white">{{ $task->getProgressPercentage() }}%</span>
                                    </div>
                                    <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                                        <div class="bg-gradient-to-r from-indigo-600 to-pink-600 h-2 rounded-full transition duration-300" 
                                            style="width: {{ $task->getProgressPercentage() }}%"></div>
                                    </div>
                                </div>

                                <!-- Footer -->
                                <div class="flex items-center justify-between pt-4 border-t border-gray-200 dark:border-gray-700">
                                    <span class="text-xs text-gray-600 dark:text-gray-400">
                                        <i class="fas fa-calendar-alt mr-1"></i>{{ $task->deadline->format('M d, Y') }}
                                    </span>
                                    <a href="{{ route('tasks.show', $task) }}" class="text-indigo-600 dark:text-indigo-400 hover:underline text-sm font-medium">
                                        View
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $tasks->links() }}
                </div>
            @else
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-12 text-center">
                        <i class="fas fa-inbox text-4xl text-gray-300 dark:text-gray-600 mb-4"></i>
                        <p class="text-gray-600 dark:text-gray-400 mb-4">No tasks found.</p>
                        <a href="{{ route('tasks.create') }}" class="inline-block bg-indigo-600 text-white font-semibold py-2 px-4 rounded-lg hover:bg-indigo-700 transition">
                            <i class="fas fa-plus mr-2"></i>Create your first task
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- AJAX Status Update Script -->
    <script>
        function updateStatus(taskId, status) {
            fetch(`/tasks/${taskId}/update-status`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ status: status })
            }).then(response => {
                if(response.ok) {
                    // ✅ Admin ka dashboard bhi update hoga
                    location.reload();
                } else {
                    alert('Status update failed!');
                }
            }).catch(error => {
                console.error('Error: ', error);
                alert('Connection error.');
            });
        }
    </script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</x-app-layout>