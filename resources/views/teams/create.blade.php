<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Create Team</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('teams.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Team Name *</label>
                        <input type="text" name="name" value="{{ old('name') }}" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 dark:bg-gray-700 dark:text-white dark:border-gray-600">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Description</label>
                        <textarea name="description" rows="4"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 dark:bg-gray-700 dark:text-white dark:border-gray-600">{{ old('description') }}</textarea>
                    </div>
                    <div class="flex gap-4">
                        <button type="submit" class="flex-1 bg-indigo-600 text-white py-3 rounded-lg hover:bg-indigo-700">Create Team</button>
                        <a href="{{ route('teams.index') }}" class="flex-1 bg-gray-200 text-gray-900 py-3 rounded-lg text-center hover:bg-gray-300">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>