<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div class="flex items-center gap-2.5">
                <div class="w-2.5 h-2.5 rounded-full bg-indigo-500 animate-pulse"></div>
                <h2 class="font-extrabold text-xl text-slate-100 tracking-tight">System Workspace Monitor</h2>
                <span class="text-[10px] bg-indigo-500/10 text-indigo-400 px-2 py-0.5 rounded-md border border-indigo-500/20 font-bold uppercase tracking-wider">Live Sync</span>
            </div>
            <div class="text-xs text-slate-400 font-semibold bg-slate-900/80 backdrop-blur px-3 py-1.5 rounded-xl border border-slate-800/60 shadow-sm self-start sm:self-auto">
                <i class="far fa-calendar-alt text-indigo-400 mr-1.5"></i>{{ now()->format('l, M d, Y') }}
            </div>
        </div>
    </x-slot>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    @if(session('success'))
        <div class="mb-6 p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-sm font-semibold flex items-center gap-2.5 shadow-md transition-all">
            <i class="fas fa-check-circle text-base text-emerald-500"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <div class="space-y-6 max-w-[1600px] mx-auto pb-12">
        
        <div class="p-6 rounded-2xl border relative overflow-hidden shadow-xl" style="background: linear-gradient(135deg, #0f172a 0%, #090d16 100%); border-color: #1e293b;">
            <div class="absolute -right-6 -top-10 w-44 h-44 bg-indigo-600/10 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute right-6 bottom-4 opacity-5 pointer-events-none">
                <i class="fas fa-layer-group text-8xl text-indigo-400"></i>
            </div>
            <h3 class="text-xl font-bold text-white tracking-tight flex items-center gap-2">
                Welcome Back, {{ Auth::user()->name }} <span class="animate-bounce origin-bottom-right inline-block">🚀</span>
            </h3>
            <p class="text-xs text-slate-400 mt-1 font-medium max-w-xl leading-relaxed">System operational matrix initialized. Track global targets, active progress indicators, and team assignments dynamically.</p>
        </div>

        @if(auth()->user() && strtolower(auth()->user()->role) === 'admin')
            <div class="p-5 rounded-2xl border border-slate-800/80 bg-slate-900/20 shadow-sm relative backdrop-blur-sm">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h6 class="text-slate-200 text-xs font-bold uppercase tracking-wider flex items-center gap-2">
                            <i class="fas fa-sliders-h text-indigo-400"></i> Quick Command Deck
                        </h6>
                        <p class="text-[11px] text-slate-400 mt-0.5">Direct system shortcuts for accelerated platform onboarding and control.</p>
                    </div>
                    <span class="text-[9px] bg-rose-500/10 text-rose-400 px-2 py-0.5 rounded-md border border-rose-500/20 font-bold uppercase tracking-widest">Admin Authorization</span>
                </div>
                
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <a href="{{ route('tasks.create') }}" class="flex items-center justify-between p-4 rounded-xl border border-emerald-500/20 transition-all duration-300 transform hover:-translate-y-0.5 hover:shadow-lg hover:shadow-emerald-950/20 bg-gradient-to-br from-emerald-950/60 to-slate-950">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-lg bg-emerald-500/10 flex items-center justify-center text-emerald-400 border border-emerald-500/20">
                                <i class="fas fa-plus text-xs"></i>
                            </div>
                            <div>
                                <span class="block text-slate-200 font-bold text-xs tracking-tight">Assign New Task</span>
                                <span class="text-[10px] text-slate-400 block mt-0.5">Allocate operational targets</span>
                            </div>
                        </div>
                        <i class="fas fa-chevron-right text-[10px] text-slate-600 transition-transform group-hover:translate-x-0.5"></i>
                    </a>

                    <a href="{{ route('teams.index') }}" class="flex items-center justify-between p-4 rounded-xl border border-indigo-500/20 transition-all duration-300 transform hover:-translate-y-0.5 hover:shadow-lg hover:shadow-indigo-950/20 bg-gradient-to-br from-indigo-950/40 to-slate-950">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-lg bg-indigo-500/10 flex items-center justify-center text-indigo-400 border border-indigo-500/20">
                                <i class="fas fa-users-cog text-xs"></i>
                            </div>
                            <div>
                                <span class="block text-slate-200 font-bold text-xs tracking-tight">Manage Team Assets</span>
                                <span class="text-[10px] text-slate-400 block mt-0.5">Configure operational squads</span>
                            </div>
                        </div>
                        <i class="fas fa-chevron-right text-[10px] text-slate-600"></i>
                    </a>

                    <a href="{{ route('admin.register.member') }}" class="flex items-center justify-between p-4 rounded-xl border border-rose-500/20 transition-all duration-300 transform hover:-translate-y-0.5 hover:shadow-lg hover:shadow-rose-950/20 bg-gradient-to-br from-rose-950/40 to-slate-950">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-lg bg-rose-500/10 flex items-center justify-center text-rose-400 border border-rose-500/20">
                                <i class="fas fa-user-plus text-xs"></i>
                            </div>
                            <div>
                                <span class="block text-slate-200 font-bold text-xs tracking-tight">Onboard Member</span>
                                <span class="text-[10px] text-slate-400 block mt-0.5">Register workspace identities</span>
                            </div>
                        </div>
                        <i class="fas fa-chevron-right text-[10px] text-slate-600"></i>
                    </a>
                </div>
            </div>
        @endif

        @if(auth()->user()->role !== 'admin')
            <div class="p-5 rounded-2xl border border-slate-800/80 bg-slate-900/30 backdrop-blur-sm shadow-inner">
                <div class="flex justify-between items-center mb-2">
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider flex items-center gap-1.5">
                        <i class="fas fa-crosshairs text-indigo-400"></i> Personal Target Progression
                    </p>
                    <span class="text-indigo-400 font-extrabold text-xs bg-indigo-500/10 px-2.5 py-0.5 rounded border border-indigo-500/20 shadow-sm">{{ $stats['personalProgress'] }}%</span>
                </div>
                <div class="w-full bg-slate-950 h-3 rounded-full overflow-hidden p-0.5 border border-slate-800/60 shadow-inner">
                    <div class="bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 h-full rounded-full transition-all duration-1000 ease-out shadow-[0_0_12px_rgba(99,102,241,0.4)]" style="width: {{ $stats['personalProgress'] }}%"></div>
                </div>
            </div>
        @endif

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-5">
            <div class="p-5 rounded-2xl border border-slate-800 bg-slate-900/30 flex items-center justify-between group hover:border-indigo-500/30 transition-all duration-300 hover:bg-slate-900/50 shadow-sm">
                <div>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Total Logs</p>
                    <h3 class="text-3xl font-black text-slate-100 mt-1 transition-transform group-hover:scale-105 duration-200">{{ $stats['totalTasks'] }}</h3>
                </div>
                <div class="w-11 h-11 rounded-xl bg-indigo-500/10 flex items-center justify-center text-indigo-400 border border-indigo-500/20 shadow-inner transition-colors group-hover:bg-indigo-500/20">
                    <i class="fas fa-layer-group text-base"></i>
                </div>
            </div>

            <div class="p-5 rounded-2xl border border-slate-800 bg-slate-900/30 flex items-center justify-between group hover:border-emerald-500/30 transition-all duration-300 hover:bg-slate-900/50 shadow-sm">
                <div>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Completed</p>
                    <h3 class="text-3xl font-black text-emerald-400 mt-1 transition-transform group-hover:scale-105 duration-200">{{ $stats['completedTasks'] }}</h3>
                </div>
                <div class="w-11 h-11 rounded-xl bg-emerald-500/10 flex items-center justify-center text-emerald-400 border border-emerald-500/20 shadow-inner transition-colors group-hover:bg-emerald-500/20">
                    <i class="fas fa-check-circle text-base"></i>
                </div>
            </div>

            <div class="p-5 rounded-2xl border border-slate-800 bg-slate-900/30 flex items-center justify-between group hover:border-amber-500/30 transition-all duration-300 hover:bg-slate-900/50 shadow-sm">
                <div>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Active Queue</p>
                    <h3 class="text-3xl font-black text-amber-400 mt-1 transition-transform group-hover:scale-105 duration-200">{{ $stats['pendingTasks'] }}</h3>
                </div>
                <div class="w-11 h-11 rounded-xl bg-amber-500/10 flex items-center justify-center text-amber-400 border border-amber-500/20 shadow-inner transition-colors group-hover:bg-amber-500/20">
                    <i class="fas fa-hourglass-half text-base"></i>
                </div>
            </div>

            <div class="p-5 rounded-2xl border border-slate-800 bg-slate-900/30 flex items-center justify-between group hover:border-rose-500/30 transition-all duration-300 hover:bg-slate-900/50 shadow-sm">
                <div>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Overdue Alerts</p>
                    <h3 class="text-3xl font-black text-rose-400 mt-1 transition-transform group-hover:scale-105 duration-200">{{ $stats['overdueTasks'] }}</h3>
                </div>
                <div class="w-11 h-11 rounded-xl bg-rose-500/10 flex items-center justify-center text-rose-400 border border-rose-500/20 shadow-inner transition-all group-hover:bg-rose-500/20 {{ $stats['overdueTasks'] > 0 ? 'animate-pulse' : '' }}">
                    <i class="fas fa-radiation text-base"></i>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="p-5 rounded-2xl border border-slate-800/80 bg-slate-900/30 flex flex-col justify-between shadow-sm">
                <h4 class="text-xs font-bold text-slate-200 uppercase tracking-wider mb-3 flex items-center gap-2">
                    <i class="fas fa-chart-pie text-indigo-400"></i> Sector Allocation Mix
                </h4>
                <div class="relative w-full max-w-[170px] mx-auto my-auto py-2">
                    <canvas id="taskOverviewDoughnut"></canvas>
                </div>
                <div class="mt-3 pt-3 border-t border-slate-800/60 text-center text-xs font-medium text-slate-400">
                    Overall Productivity Ratio: <span class="text-indigo-400 font-bold ml-1">{{ $stats['completionPercentage'] }}%</span>
                </div>
            </div>

            <div class="p-5 rounded-2xl border border-slate-800/80 bg-slate-900/30 lg:col-span-2 shadow-sm">
                <h4 class="text-xs font-bold text-slate-200 uppercase tracking-wider mb-3 flex items-center gap-2">
                    <i class="fas fa-chart-bar text-indigo-400"></i> Velocity Index Tracker
                </h4>
                <div class="h-[210px] w-full">
                    <canvas id="tasksProgressLinearBar"></canvas>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            <div class="lg:col-span-2 p-5 rounded-2xl border border-slate-800/80 bg-slate-900/30 overflow-hidden flex flex-col justify-between shadow-lg">
                <div>
                    <div class="flex flex-col sm:flex-row justify-between sm:items-center gap-2 mb-5">
                        <div>
                            <h4 class="text-sm font-bold text-white tracking-tight flex items-center gap-2">
                                <i class="fas fa-network-wired text-indigo-400"></i> 
                                {{ auth()->user()->role === 'admin' ? 'Global Task Allocations' : 'My Assigned Workspace Tasks' }}
                            </h4>
                            <p class="text-[11px] text-slate-400 mt-0.5">
                                {{ auth()->user()->role === 'admin' ? 'Global structural view tracking multi-user assignments across database structures.' : 'Sequential tracklist outlining your primary task mandates.' }}
                            </p>
                        </div>
                        <span class="text-[9px] bg-slate-950 text-slate-400 px-2.5 py-1 rounded-md font-bold border border-slate-800 self-start sm:self-auto tracking-wider uppercase">Vault Logs Secured</span>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b border-slate-800 text-[10px] font-bold text-slate-400 uppercase tracking-widest bg-slate-950/50">
                                    <th class="pb-3 pt-2.5 px-3 rounded-l-xl">Assigned Identity</th>
                                    <th class="pb-3 pt-2.5 px-3">Task Scope / Matrix Objective</th>
                                    <th class="pb-3 pt-2.5 px-3">Priority</th>
                                    <th class="pb-3 pt-2.5 px-3 rounded-r-xl">Workflow Metrics</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-800/40 text-xs text-slate-300">
                                @forelse($allocatedTasks as $task)
                                    <tr class="hover:bg-slate-800/20 transition-all duration-150 group">
                                        <td class="py-3 px-3">
                                            <div class="flex items-center gap-3">
                                                @if($task->assignedTo)
                                                    <div class="w-8 h-8 rounded-xl bg-gradient-to-tr from-indigo-600 to-violet-600 text-white flex items-center justify-center font-extrabold text-[10px] uppercase tracking-wider shrink-0 shadow-md border border-indigo-400/10 group-hover:scale-105 transition-transform">
                                                        {{ substr($task->assignedTo->name, 0, 2) }}
                                                    </div>
                                                    <div class="min-w-0">
                                                        <span class="block font-semibold text-slate-200 whitespace-nowrap truncate max-w-[120px]">{{ $task->assignedTo->name }}</span>
                                                        <span class="text-[9px] text-indigo-400/80 uppercase tracking-tight block font-bold mt-0.5">{{ $task->assignedTo->role ?? 'Member' }}</span>
                                                    </div>
                                                @else
                                                    <div class="w-8 h-8 rounded-xl bg-slate-800 text-slate-500 flex items-center justify-center font-bold text-[10px] shrink-0 border border-slate-700/30">
                                                        <i class="fas fa-fingerprint text-[10px]"></i>
                                                    </div>
                                                    <div>
                                                        <span class="block font-semibold text-slate-400 italic whitespace-nowrap">Unallocated</span>
                                                        <span class="text-[9px] text-slate-600 uppercase block font-bold mt-0.5">System Core</span>
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        
                                        <td class="py-3 px-3 max-w-[220px] font-medium text-slate-300">
                                            <div class="truncate font-semibold text-slate-200" title="{{ trim($task->title, ' "') }}">
                                                {{ trim($task->title, ' "') }}
                                            </div>
                                            @if($task->deadline)
                                                <span class="text-[9px] text-slate-500 block mt-1 font-medium">
                                                    <i class="far fa-clock mr-1 text-slate-600"></i>Due Segment: {{ \Carbon\Carbon::parse($task->deadline)->format('M d, Y') }}
                                                </span>
                                            @endif
                                        </td>
                                        
                                        <td class="py-3 px-3">
                                            @if(strtolower($task->priority ?? '') === 'high')
                                                <span class="px-2.5 py-0.5 bg-rose-500/10 text-rose-400 border border-rose-500/20 rounded-md font-extrabold text-[9px] uppercase tracking-wider">High</span>
                                            @elseif(strtolower($task->priority ?? '') === 'medium')
                                                <span class="px-2.5 py-0.5 bg-blue-500/10 text-blue-400 border border-blue-500/20 rounded-md font-extrabold text-[9px] uppercase tracking-wider">Medium</span>
                                            @else
                                                <span class="px-2.5 py-0.5 bg-slate-800/80 text-slate-400 border border-slate-700/50 rounded-md font-extrabold text-[9px] uppercase tracking-wider">Low</span>
                                            @endif
                                        </td>
                                        
                                        <td class="py-3 px-3">
                                            @if($task->status === 'Completed')
                                                <span class="text-emerald-400 font-bold text-[11px] flex items-center gap-1.5 bg-emerald-500/5 px-2.5 py-1 rounded-lg border border-emerald-500/10 w-fit">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span> Completed
                                                </span>
                                            @elseif($task->status === 'In Progress')
                                                <span class="text-amber-400 font-bold text-[11px] flex items-center gap-1.5 bg-amber-500/5 px-2.5 py-1 rounded-lg border border-amber-500/10 w-fit">
                                                    <i class="fas fa-circle-notch fa-spin text-[9px]"></i> In Progress
                                                </span>
                                            @elseif($task->status === 'Overdue' || (\Carbon\Carbon::parse($task->deadline)->isPast() && $task->status !== 'Completed'))
                                                <span class="text-rose-400 font-bold text-[11px] flex items-center gap-1.5 bg-rose-500/5 px-2.5 py-1 rounded-lg border border-rose-500/10 w-fit animate-pulse">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span> Overdue
                                                </span>
                                            @else
                                                <span class="text-slate-400 font-bold text-[11px] flex items-center gap-1.5 bg-slate-800/50 px-2.5 py-1 rounded-lg border border-slate-700/50 w-fit">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-slate-500"></span> Pending
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="py-10 text-center text-slate-500 italic font-medium">
                                            <i class="fas fa-circle-nodes text-xl block mb-2 text-slate-700"></i> No matrix allocations verified inside database cluster logs.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-1 p-5 rounded-2xl border border-slate-800/80 bg-slate-900/30 flex flex-col justify-between shadow-md">
                <div>
                    <h4 class="text-xs font-bold text-slate-200 uppercase tracking-wider mb-4 flex items-center gap-2">
                        <i class="fas fa-chart-line text-emerald-400"></i> Performance Indexing
                    </h4>
                    
                    <div class="space-y-4.5 mt-2">
                        <div>
                            <div class="flex justify-between items-center text-xs mb-1.5 font-semibold text-slate-300">
                                <span class="flex items-center gap-1.5"><i class="fas fa-code text-[10px] text-indigo-400"></i> Engineering Squad</span>
                                <span class="text-indigo-400 font-bold">82% Velocity</span>
                            </div>
                            <div class="w-full bg-slate-950 h-2 rounded-md overflow-hidden p-0.5 border border-slate-800/40">
                                <div class="bg-indigo-500 h-full rounded-sm" style="width: 82%"></div>
                            </div>
                        </div>

                        <div>
                            <div class="flex justify-between items-center text-xs mb-1.5 font-semibold text-slate-300">
                                <span class="flex items-center gap-1.5"><i class="fas fa-bezier-curve text-[10px] text-emerald-400"></i> UI/UX Asset Unit</span>
                                <span class="text-emerald-400 font-bold">94% Efficiency</span>
                            </div>
                            <div class="w-full bg-slate-950 h-2 rounded-md overflow-hidden p-0.5 border border-slate-800/40">
                                <div class="bg-emerald-500 h-full rounded-sm" style="width: 94%"></div>
                            </div>
                        </div>
                        
                        <div>
                            <div class="flex justify-between items-center text-xs mb-1.5 font-semibold text-slate-300">
                                <span class="flex items-center gap-1.5"><i class="fas fa-shield-halved text-[10px] text-purple-400"></i> Quality Controllers</span>
                                <span class="text-purple-400 font-bold">71% Operations</span>
                            </div>
                            <div class="w-full bg-slate-950 h-2 rounded-md overflow-hidden p-0.5 border border-slate-800/40">
                                <div class="bg-purple-500 h-full rounded-sm" style="width: 71%"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-6 pt-3 border-t border-slate-800/60 text-[10px] text-slate-500 flex items-center gap-1.5 font-medium">
                    <i class="fas fa-info-circle text-indigo-400/80"></i> Velocity metrics aggregate live system log sequences.
                </div>
            </div>

        </div>

    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const completed = {{ $stats['completedTasks'] }};
            const pending = {{ $stats['pendingTasks'] }};
            const overdue = {{ $stats['overdueTasks'] }};
            const total = {{ $stats['totalTasks'] }};

            // 1. Doughnut Initialization
            const ctxDoughnut = document.getElementById('taskOverviewDoughnut').getContext('2d');
            new Chart(ctxDoughnut, {
                type: 'doughnut',
                data: {
                    labels: ['Completed', 'Pending', 'Overdue'],
                    datasets: [{
                        data: total > 0 ? [completed, pending, overdue] : [1, 0, 0], 
                        backgroundColor: ['#10b981', '#f59e0b', '#f43f5e'],
                        borderWidth: 3,
                        borderColor: '#0f172a',
                        hoverOffset: 3
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    cutout: '80%'
                }
            });

            // 2. Linear Scaling Bar Matrix
            const ctxBar = document.getElementById('tasksProgressLinearBar').getContext('2d');
            new Chart(ctxBar, {
                type: 'bar',
                data: {
                    labels: ['Total Logs', 'Completed Metric', 'Active Targets', 'Fault Overdues'],
                    datasets: [{
                        data: [total, completed, pending, overdue],
                        backgroundColor: ['#6366f1', '#10b981', '#f59e0b', '#f43f5e'],
                        borderRadius: 5,
                        barThickness: 20,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: {
                            grid: { color: '#1e293b', drawTicks: false },
                            ticks: { color: '#475569', font: { size: 10, weight: '700' }, stepSize: 1 }
                        },
                        x: {
                            grid: { display: false },
                            ticks: { color: '#64748b', font: { size: 10, weight: '700' } }
                        }
                    }
                }
            });
        });
    </script>

    <div id="chat-wrapper" style="position: fixed; bottom: 25px; right: 25px; z-index: 1000;" class="font-sans">
        <div id="chat-box" style="display:none; width: 350px; height: 460px; background: #ffffff; border: 1px solid #e2e8f0; border-radius: 20px; flex-direction: column; box-shadow: 0px 20px 40px rgba(0,0,0,0.35); overflow: hidden; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);">
            
            <div style="background: #0f172a; color: white; padding: 16px 20px; display: flex; align-items: center; justify-content: space-between; border-bottom: 1px solid #1e293b;">
                <div>
                    <span style="display: block; font-weight: 800; font-size: 13px; tracking-wide font-sans text-slate-100">Smart Task Assistant</span>
                    <span style="font-size: 10px; color: #34d399; font-weight: 700; display:flex; align-items:center; gap:5px; margin-top:2px;">
                        <span style="width:6px; height:6px; background:#34d399; border-radius:50%; display:inline-block;" class="animate-pulse"></span> Node Active Integration
                    </span>
                </div>
                <button onclick="toggleChat()" style="background:transparent; color:#64748b; border:none; font-size:14px; cursor:pointer;" class="hover:text-slate-200 transition-colors"><i class="fas fa-times"></i></button>
            </div>
            
            <div id="chat-messages" style="flex: 1; padding: 18px; overflow-y: auto; background: #f8fafc; font-size: 12px;" class="space-y-3.5">
               <div style="margin-bottom: 14px; color: #334155; background:#f1f5f9; padding:12px; border-radius:14px; border-top-left-radius:2px; max-w:85%; font-medium leading-relaxed shadow-sm">
                    🤖 <b>Bot:</b> Hello! I am your Smart Task Assistant. Tell me what tasks you want to manage or create.
               </div>
            </div>
            
            <div style="padding: 12px 16px; display: flex; background: #ffffff; border-top: 1px solid #f1f5f9; align-items:center;">
                <input type="text" id="user-input" placeholder="Type a secure workflow command..." style="flex: 1; padding: 10px 14px; border: 1px solid #e2e8f0; border-radius: 12px; font-size: 12px; outline: none; color: #0f172a; background:#f8fafc; font-weight:500;" onkeypress="if(event.key === 'Enter') sendMessage()">
                <button onclick="sendMessage()" style="background: #6366f1; color: white; border: none; width:36px; height:36px; margin-left: 10px; border-radius: 12px; cursor: pointer; display:flex; align-items:center; justify-content:center; shadow-md transition:all 0.2s;" onmouseover="this.style.background='#4f46e5'; this.style.transform='scale(1.03)';" onmouseout="this.style.background='#6366f1'; this.style.transform='scale(1)';">
                    <i class="fas fa-paper-plane" style="font-size:11px;"></i>
                </button>
            </div>
        </div>

        <button onclick="toggleChat()" style="background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%); color: white; border: none; border-radius: 50%; width: 54px; height: 54px; font-size: 18px; cursor: pointer; box-shadow: 0px 10px 25px rgba(79,70,229,0.35); display: flex; align-items: center; justify-content: center; float: right; transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);" onmouseover="this.style.transform='scale(1.06)';" onmouseout="this.style.transform='scale(1)';">
            <i class="fas fa-bolt"></i>
        </button>
    </div>

    <script>
    function toggleChat() {
        var chatBox = document.getElementById('chat-box');
        chatBox.style.display = (chatBox.style.display === 'none' || chatBox.style.display === '') ? 'flex' : 'none';
    }

    function sendMessage() {
        var inputField = document.getElementById('user-input');
        var messageText = inputField.value.trim();
        if (!messageText) return;

        var chatMessages = document.getElementById('chat-messages');
        chatMessages.innerHTML += `<div style="text-align: right; margin-bottom: 14px; color: #ffffff; background: #6366f1; padding: 11px 14px; border-radius: 14px; border-top-right-radius: 2px; max-width: 85%; margin-left: auto; font-weight: 500; shadow-sm leading-relaxed">${messageText}</div>`;
        inputField.value = '';
        chatMessages.scrollTop = chatMessages.scrollHeight;

        fetch('{{ route("chatbot.message") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ message: messageText })
        })
        .then(response => response.json())
        .then(data => {
            chatMessages.innerHTML += `<div style="text-align: left; margin-bottom: 14px; color: #334155; background: #e2e8f0; padding: 11px 14px; border-radius: 14px; border-top-left-radius: 2px; max-width: 85%; font-medium leading-relaxed shadow-sm">🤖 <b>Bot:</b> ${data.reply}</div>`;
            chatMessages.scrollTop = chatMessages.scrollHeight;
        });
    }
    </script>
</x-app-layout>