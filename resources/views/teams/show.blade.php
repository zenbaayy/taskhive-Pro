<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ $team->name }}</h2>
            <div class="flex gap-2">
                <a href="{{ route('teams.edit', $team) }}" 
                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md font-semibold transition">
                    Edit
                </a>
                <form action="{{ route('teams.destroy', $team) }}" method="POST" style="display: inline;" onsubmit="return confirm('Delete this team?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md font-semibold transition">
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Description -->
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6 mb-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">Description</h3>
                <p class="text-gray-600 dark:text-gray-400">{{ $team->description ?? 'No description added.' }}</p>
            </div>

            <!-- Add Member -->
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6 mb-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Add Member</h3>
                <form action="{{ route('teams.addMember', $team->id) }}" method="POST" class="flex gap-4">
                    @csrf
                    <select 
                        name="user_id" 
                        style="background-color: white; color: black; font-weight: bold;"
                        class="flex-1 px-4 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="" style="background-color: white; color: black;">Select a member...</option>
                        @foreach(\App\Models\User::all() as $user)
                            <option value="{{ $user->id }}" style="background-color: white; color: black;">
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                    <button 
                        type="submit" 
                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-md font-semibold transition">
                        Add
                    </button>
                </form>
                @error('user_id')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Members List -->
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                    Members ({{ $team->members->count() }})
                </h3>
                
                @forelse($team->members as $member)
                    <div class="flex justify-between items-center py-3 px-4 border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 rounded transition">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-indigo-600 rounded-full flex items-center justify-center text-white font-bold text-sm">
                                {{ substr($member->name, 0, 1) }}
                            </div>
                            <div>
                                <p class="text-gray-900 dark:text-white font-semibold">{{ $member->name }}</p>
                                <p class="text-sm text-gray-500 dark:text-gray-400">{{ $member->email }}</p>
                            </div>
                        </div>
                        <form action="{{ route('teams.removeMember', [$team->id, $member->id]) }}" method="POST" style="display: inline;" onsubmit="return confirm('Remove this member?');">
                            @csrf
                            @method('DELETE')
                            <button 
                                type="submit" 
                                class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm font-semibold transition">
                                Remove
                            </button>
                        </form>
                    </div>
                @empty
                    <p class="text-gray-500 dark:text-gray-400 py-4 text-center">No members yet!</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>