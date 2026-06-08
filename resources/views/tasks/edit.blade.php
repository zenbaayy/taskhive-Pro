<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <i class="fas fa-edit text-indigo-600 mr-2"></i>Edit Task
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('tasks.update', $task->id) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Task Title -->
                        <div>
                            <label for="title" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                Task Title <span class="text-red-600">*</span>
                            </label>
                            <input 
                                type="text" 
                                id="title" 
                                name="title" 
                                value="{{ old('title', $task->title) }}"
                                style="background-color: white; color: black; font-weight: bold;"
                                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 transition"
                                required>
                            @error('title')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div>
                            <label for="description" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                Description
                            </label>
                            <textarea 
                                id="description" 
                                name="description" 
                                rows="4"
                                style="background-color: white; color: black; font-weight: bold;"
                                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 transition">{{ old('description', $task->description) }}</textarea>
                            @error('description')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Category & Priority Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Category -->
                            <div>
                                <label for="category" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                    Category <span class="text-red-600">*</span>
                                </label>
                                <select 
                                    name="category" 
                                    id="category"
                                    style="background-color: white; color: black; font-weight: bold;"
                                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 transition" 
                                    required>
                                    <option value="Work" {{ old('category', $task->category) === 'Work' ? 'selected' : '' }} style="background-color: white; color: black;">💼 Work</option>
                                    <option value="Study" {{ old('category', $task->category) === 'Study' ? 'selected' : '' }} style="background-color: white; color: black;">📚 Study</option>
                                    <option value="Personal" {{ old('category', $task->category) === 'Personal' ? 'selected' : '' }} style="background-color: white; color: black;">👤 Personal</option>
                                    <option value="Team" {{ old('category', $task->category) === 'Team' ? 'selected' : '' }} style="background-color: white; color: black;">👥 Team</option>
                                </select>
                                @error('category')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Priority -->
                            <div>
                                <label for="priority" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                    Priority <span class="text-red-600">*</span>
                                </label>
                                <select 
                                    name="priority" 
                                    id="priority"
                                    style="background-color: white; color: black; font-weight: bold;"
                                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 transition" 
                                    required>
                                    <option value="High" {{ old('priority', $task->priority) === 'High' ? 'selected' : '' }} style="background-color: white; color: black;">🔴 High</option>
                                    <option value="Medium" {{ old('priority', $task->priority) === 'Medium' ? 'selected' : '' }} style="background-color: white; color: black;">🟡 Medium</option>
                                    <option value="Low" {{ old('priority', $task->priority) === 'Low' ? 'selected' : '' }} style="background-color: white; color: black;">🟢 Low</option>
                                </select>
                                @error('priority')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Status -->
                        <div>
                            <label for="status" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                Status <span class="text-red-600">*</span>
                            </label>
                            <select 
                                name="status" 
                                id="status"
                                style="background-color: white; color: black; font-weight: bold;"
                                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 transition" 
                                required>
                                <option value="Pending" {{ old('status', $task->status) === 'Pending' ? 'selected' : '' }} style="background-color: white; color: black;">◯ Pending</option>
                                <option value="In Progress" {{ old('status', $task->status) === 'In Progress' ? 'selected' : '' }} style="background-color: white; color: black;">⏳ In Progress</option>
                                <option value="Completed" {{ old('status', $task->status) === 'Completed' ? 'selected' : '' }} style="background-color: white; color: black;">✓ Completed</option>
                                <option value="Overdue" {{ old('status', $task->status) === 'Overdue' ? 'selected' : '' }} style="background-color: white; color: black;">⚠ Overdue</option>
                            </select>
                            @error('status')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Deadline -->
                        <div>
                            <label for="deadline" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                Deadline <span class="text-red-600">*</span>
                            </label>
                            <input 
                                type="datetime-local" 
                                id="deadline"
                                name="deadline" 
                                value="{{ old('deadline', $task->deadline ? \Carbon\Carbon::parse($task->deadline)->format('Y-m-d\TH:i') : '') }}"
                                style="background-color: white; color: black; font-weight: bold;"
                                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 transition" 
                                required>
                            @error('deadline')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex gap-4 pt-4">
                            <button 
                                type="submit" 
                                class="flex-1 bg-gradient-to-r from-indigo-600 to-indigo-700 text-white font-semibold py-3 px-4 rounded-lg hover:shadow-lg transition">
                                <i class="fas fa-save mr-2"></i>Save Changes
                            </button>
                            <a 
                                href="{{ route('tasks.index') }}" 
                                class="flex-1 bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-white font-semibold py-3 px-4 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition text-center">
                                <i class="fas fa-times mr-2"></i>Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</x-app-layout>