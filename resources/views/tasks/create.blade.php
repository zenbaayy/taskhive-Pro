<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            <i class="fas fa-plus-circle text-indigo-500 mr-2"></i>Create New Task
        </h2>
    </x-slot>

    <div class="py-12 bg-slate-950 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-slate-900 p-8 rounded-2xl border border-slate-800 shadow-xl">
                
                <form action="{{ route('tasks.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <div>
                        <label class="text-xs font-bold text-slate-400 uppercase">Task Title *</label>
                        <input type="text" name="title" value="{{ old('title') }}" required class="w-full bg-slate-950 border border-slate-800 rounded-xl text-white p-3 mt-1 outline-none">
                    </div>

                    <div>
                        <label class="text-xs font-bold text-slate-400 uppercase">Description</label>
                        <textarea name="description" rows="4" class="w-full bg-slate-950 border border-slate-800 rounded-xl text-white p-3 mt-1 outline-none">{{ old('description') }}</textarea>
                    </div>

                    <div>
                        <label class="text-xs font-bold text-slate-400 uppercase block">Attachments</label>
                        <div class="mt-2 p-4 border-2 border-dashed border-slate-700 rounded-xl bg-slate-950 text-center">
                            <input type="file" name="attachments[]" multiple class="text-slate-400 text-sm">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="text-xs font-bold text-slate-400 uppercase">Category *</label>
                            <select name="category" class="w-full bg-slate-950 border border-slate-800 rounded-xl text-white p-3 mt-1 outline-none">
                                <option value="Work">💼 Work</option>
                                <option value="Study">📚 Study</option>
                                <option value="Personal">👤 Personal</option>
                                <option value="Team">👥 Team</option>
                            </select>
                        </div>
                        <div>
                            <label class="text-xs font-bold text-slate-400 uppercase">Priority *</label>
                            <select name="priority" class="w-full bg-slate-950 border border-slate-800 rounded-xl text-white p-3 mt-1 outline-none">
                                <option value="High">🔴 High</option>
                                <option value="Medium">🟡 Medium</option>
                                <option value="Low">🟢 Low</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="text-xs font-bold text-slate-400 uppercase">Deadline *</label>
                        <input type="datetime-local" name="deadline" required class="w-full bg-slate-950 border border-slate-800 rounded-xl text-white p-3 mt-1 outline-none">
                    </div>

                    @if(auth()->user()->role === 'admin')
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="text-xs font-bold text-slate-400 uppercase">Assign To</label>
                                <select name="assigned_to" class="w-full bg-slate-950 border border-slate-800 rounded-xl text-white p-3 mt-1 outline-none">
                                    <option value="">Select Member</option>
                                    @foreach($teamMembers as $member)
                                        <option value="{{ $member->id }}">{{ $member->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="text-xs font-bold text-slate-400 uppercase">Team</label>
                                <select name="team_id" class="w-full bg-slate-950 border border-slate-800 rounded-xl text-white p-3 mt-1 outline-none">
                                    <option value="">Select Team</option>
                                    @foreach($teams as $team)
                                        <option value="{{ $team->id }}">{{ $team->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endif

                    <div class="flex gap-4 pt-4">
                        <button type="submit" class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 rounded-xl transition-all">Create Task</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>