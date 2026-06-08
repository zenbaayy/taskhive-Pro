<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-slate-100 leading-tight">Edit Team</h2>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="rounded-2xl border border-slate-800/80 bg-slate-900/40 backdrop-blur-md shadow-xl p-6">
                
                <form action="{{ route('teams.update', $team->id) }}" method="POST" class="space-y-6">
                    @csrf 
                    @method('PUT')
                    
                    <!-- Team Name -->
                    <div>
                        <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">
                            Team Name *
                        </label>
                        <input 
                            type="text" 
                            name="name" 
                            value="{{ old('name', $team->name) }}" 
                            required
                            style="background-color: white; color: black; font-weight: bold;"
                            class="w-full px-4 py-3 rounded-xl border border-slate-700 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition-all duration-200 text-sm"
                            placeholder="Type team name here...">
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div>
                        <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">
                            Description
                        </label>
                        <textarea 
                            name="description" 
                            rows="4"
                            style="background-color: white; color: black; font-weight: bold;"
                            class="w-full px-4 py-3 rounded-xl border border-slate-700 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition-all duration-200 text-sm resize-none"
                            placeholder="Type description here...">{{ old('description', $team->description) }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Buttons -->
                    <div class="flex gap-4 pt-2">
                        <button 
                            type="submit" 
                            class="flex-1 bg-indigo-600 text-white py-3 rounded-xl font-bold text-xs uppercase tracking-wider hover:bg-indigo-500 transition-all duration-200 shadow-lg">
                            Save Changes
                        </button>
                        <a 
                            href="{{ route('teams.index') }}" 
                            class="flex-1 bg-slate-800 text-slate-300 py-3 rounded-xl text-center font-bold text-xs uppercase tracking-wider hover:bg-slate-700 border border-slate-700 transition-all duration-200">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>