<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div class="flex items-center gap-2.5">
                <div class="w-2.5 h-2.5 rounded-full bg-indigo-500 animate-pulse"></div>
                <h2 class="font-extrabold text-xl text-slate-100 tracking-tight">Teams Management</h2>
                <span class="text-[10px] bg-indigo-500/10 text-indigo-400 px-2 py-0.5 rounded-md border border-indigo-500/20 font-bold uppercase tracking-wider">Workspace</span>
            </div>
            
            <a href="{{ route('teams.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 text-white font-bold text-xs rounded-xl shadow-md hover:bg-indigo-500 transition-all duration-200 transform hover:-translate-y-0.5 self-start sm:self-auto group">
                <i class="fas fa-plus text-[10px] transition-transform group-hover:rotate-90"></i>
                <span>+ New Team</span>
            </a>
        </div>
    </x-slot>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    @if(session('success'))
        <div class="mb-6 p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-sm font-semibold flex items-center gap-2.5 shadow-md max-w-[1600px] mx-auto">
            <i class="fas fa-check-circle text-base text-emerald-500"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <div class="max-w-[1600px] mx-auto pb-12 space-y-6">

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($teams as $team)
                <div class="p-6 rounded-2xl border border-slate-800/80 bg-slate-900/40 backdrop-blur-md shadow-xl hover:border-indigo-500/40 transition-all duration-300 flex flex-col justify-between group relative overflow-hidden">
                    
                    <div class="absolute -right-10 -bottom-10 w-24 h-24 bg-indigo-500/5 rounded-full blur-xl group-hover:bg-indigo-500/10 transition-all"></div>
                    
                    <div>
                        <div class="flex items-start justify-between gap-4 mb-3">
                            <div class="min-w-0">
                                <h4 class="text-lg font-bold text-slate-100 group-hover:text-white transition-colors truncate uppercase tracking-wide">
                                    {{ $team->name }}
                                </h4>
                            </div>
                            
                            <div class="flex items-center gap-1.5 text-[10px] font-bold text-emerald-400 bg-emerald-500/10 border border-emerald-500/20 px-2 py-0.5 rounded-md shrink-0">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span> Synchronized
                            </div>
                        </div>

                        <p class="text-xs text-slate-400 leading-relaxed font-medium mb-4 min-h-[36px] line-clamp-2">
                            {{ $team->description ?? 'No specific technical workspace matrix instructions loaded for this unit.' }}
                        </p>

                        <div class="text-xs font-semibold text-slate-400 mb-5 flex items-center gap-1.5">
                            <i class="fas fa-users text-slate-500 text-[11px]"></i>
                            <span>Members:</span>
                            <span class="text-indigo-400 font-extrabold bg-indigo-500/5 px-2 py-0.5 rounded border border-indigo-500/10">
                                {{ $team->getMemberCount() }}
                            </span>
                        </div>
                    </div>

                    <div class="flex items-center gap-4 pt-4 border-t border-slate-800/60 mt-auto relative z-10 text-xs font-bold">
                        
                        <a href="{{ route('teams.show', $team->id) }}" class="text-indigo-400 hover:text-indigo-300 transition-colors flex items-center gap-1 group/link">
                            <i class="far fa-eye text-[10px]"></i>
                            <span>View</span>
                        </a>

                        <a href="{{ route('teams.edit', $team->id) }}" class="text-amber-400 hover:text-amber-300 transition-colors flex items-center gap-1">
                            <i class="far fa-edit text-[10px]"></i>
                            <span>Edit</span>
                        </a>

                        <form action="{{ route('teams.destroy', $team->id) }}" method="POST" onsubmit="return confirm('Are you certain you want to purge this team cluster node?');" class="inline ml-auto">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-rose-500 hover:text-rose-400 transition-colors flex items-center gap-1 bg-transparent border-none p-0 cursor-pointer font-bold text-xs">
                                <i class="far fa-trash-can text-[10px]"></i>
                                <span>Delete</span>
                            </button>
                        </form>
                        
                    </div>
                </div>
            @empty
                <div class="col-span-1 md:col-span-2 lg:col-span-3 p-12 text-center border border-dashed border-slate-800 rounded-2xl bg-slate-900/10">
                    <div class="w-12 h-12 rounded-2xl bg-slate-900 flex items-center justify-center text-slate-600 border border-slate-800/80 mx-auto mb-3">
                        <i class="fas fa-cubes-split text-base"></i>
                    </div>
                    <h5 class="text-sm font-bold text-slate-300">No Target Units Tracked</h5>
                    <p class="text-xs text-slate-500 max-w-xs mx-auto mt-1">There are no operational active group matrix elements configured in your database layer.</p>
                </div>
            @endforelse
        </div>

    </div>
</x-app-layout>