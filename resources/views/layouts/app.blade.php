<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>TaskHive Pro</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        * { font-family: 'Inter', sans-serif; }
        /* Ultra Dark Dashboard Canvas System */
        body { background-color: #020617; color: #f8fafc; }
        .sidebar { width: 260px; min-height: 100vh; background: linear-gradient(180deg, #0b1329 0%, #020617 100%); border-right: 1px solid #1e293b; }
        .main-content { margin-left: 260px; min-height: 100vh; background: #020617; }
        .stat-card { background: #0f172a; border-radius: 12px; padding: 24px; border: 1px solid #1e293b; box-shadow: 0 4px 20px rgba(0,0,0,0.4); }
        .nav-item { display: flex; align-items: center; gap: 12px; padding: 10px 20px; color: #94a3b8; border-radius: 8px; margin: 2px 12px; transition: all 0.2s; text-decoration: none; }
        .nav-item:hover, .nav-item.active { background: rgba(99, 102, 241, 0.15); color: #818cf8; border-left: 3px solid #6366f1; }
        .nav-item i { width: 20px; text-align: center; }
        .badge { padding: 3px 10px; border-radius: 20px; font-size: 11px; font-weight: 600; }
    </style>
</head>
<body class="font-sans antialiased text-slate-200">
    <div class="flex min-h-screen">
        <div class="sidebar fixed top-0 left-0 z-40 shadow-2xl">
            <div class="p-6 border-b" style="border-color: #1e293b;">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 bg-indigo-600 rounded-lg flex items-center justify-center shadow-lg shadow-indigo-500/20">
                        <i class="fas fa-hive text-white text-lg"></i>
                    </div>
                    <div>
                        <h1 class="text-white font-black text-lg leading-tight tracking-wide">TaskHive</h1>
                        <p class="text-indigo-400 text-xs font-bold uppercase tracking-widest">Pro System</p>
                    </div>
                </div>
            </div>

            <div class="p-4 border-b" style="border-color: #1e293b;">
                <div class="flex items-center gap-3 bg-slate-900/50 p-2.5 rounded-xl border" style="border-color: #1e293b;">
                    <div class="w-9 h-9 bg-gradient-to-tr from-indigo-500 to-purple-500 rounded-full flex items-center justify-center text-white font-bold text-sm shadow-md">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <div class="truncate">
                        <p class="text-slate-200 text-sm font-semibold truncate">{{ Auth::user()->name }}</p>
                        <p class="text-indigo-400 text-xs font-medium capitalize flex items-center gap-1.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                            {{ Auth::user()->role }}
                        </p>
                    </div>
                </div>
            </div>

            <nav class="py-4 space-y-1">
                <p class="text-slate-500 text-[10px] font-bold uppercase px-6 mb-2 tracking-widest">Main Menu</p>

                <a href="{{ route('dashboard') }}" class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="fas fa-th-large"></i>
                    <span class="text-sm font-medium">Dashboard</span>
                </a>

                <a href="{{ route('tasks.index') }}" class="nav-item {{ request()->routeIs('tasks.*') ? 'active' : '' }}">
                    <i class="fas fa-tasks"></i>
                    <span class="text-sm font-medium">My Tasks</span>
                </a>

                @if(Auth::user()->role === 'admin')
                <a href="{{ route('teams.index') }}" class="nav-item {{ request()->routeIs('teams.*') ? 'active' : '' }}">
                    <i class="fas fa-users"></i>
                    <span class="text-sm font-medium">Teams Management</span>
                </a>
                @endif

                <div class="border-t mt-4 pt-4" style="border-color: #1e293b;">
                    <p class="text-slate-500 text-[10px] font-bold uppercase px-6 mb-2 tracking-widest">Account Control</p>
                    <a href="{{ route('profile.edit') }}" class="nav-item {{ request()->routeIs('profile.*') ? 'active' : '' }}">
                        <i class="fas fa-user-circle"></i>
                        <span class="text-sm font-medium">Profile Settings</span>
                    </a>
                    
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="nav-item w-full text-left hover:text-red-400">
                            <i class="fas fa-sign-out-alt"></i>
                            <span class="text-sm font-medium">Secure Logout</span>
                        </button>
                    </form>
                </div>
            </nav>
        </div>

        <div class="main-content flex-1 flex flex-col">
            <div class="border-b px-8 py-4 flex justify-between items-center sticky top-0 z-30" style="background-color: #070a13; border-color: #1e293b;">
                @isset($header)
                    <div class="text-white">{{ $header }}</div>
                @else
                    <div></div>
                @endisset
                
                <div class="flex items-center gap-4">
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider bg-slate-900 px-3 py-1.5 rounded-lg border border-slate-800">
                        <i class="far fa-calendar-alt text-indigo-400 mr-1.5"></i>{{ now()->format('D, M d Y') }}
                    </span>
                    <div class="w-9 h-9 bg-gradient-to-tr from-indigo-600 to-indigo-800 text-white rounded-full flex items-center justify-center font-black text-sm shadow-md border border-indigo-500/30">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                </div>
            </div>

            <main class="p-8 flex-1 bg-slate-950">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>