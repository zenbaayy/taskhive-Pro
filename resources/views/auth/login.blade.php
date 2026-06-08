<x-guest-layout>
    <div class="w-full rounded-2xl p-8 border shadow-2xl relative overflow-hidden" style="background-color: #0f172a; border-color: #1e293b;">
        
        <h3 class="text-center font-bold text-xl text-white mb-1">Welcome Back</h3>
        <p class="text-center text-xs text-slate-400 mb-6" style="color: #94a3b8;">Enter credentials to log inside your team system.</p>

        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <div>
                <label for="email" class="block text-xs font-semibold mb-1.5" style="color: #cbd5e1;">Registered Email</label>
                <input id="email" type="email" name="email" :value="old('email')" required autofocus class="block w-full px-3.5 py-2.5 border text-sm rounded-xl focus:outline-none focus:ring-1 focus:ring-indigo-500 text-white placeholder-slate-600" style="background-color: #020617; border-color: #334155;" placeholder="name@company.com" />
                <x-input-error :messages="$errors->get('email')" class="mt-1" />
            </div>

            <div>
                <div class="flex justify-between items-center mb-1.5">
                    <label for="password" class="block text-xs font-semibold" style="color: #cbd5e1;">Password</label>
                    @if (Route::has('password.request'))
                        <a class="text-[11px] text-slate-400 hover:text-indigo-400 transition-colors" href="{{ route('password.request') }}">
                            Forgot password?
                        </a>
                    @endif
                </div>
                <input id="password" type="password" name="password" required class="block w-full px-3.5 py-2.5 border text-sm rounded-xl focus:outline-none focus:ring-1 focus:ring-indigo-500 text-white placeholder-slate-700" style="background-color: #020617; border-color: #334155;" placeholder="••••••••" />
                <x-input-error :messages="$errors->get('password')" class="mt-1" />
            </div>

            <div class="flex items-center">
                <input id="remember_me" type="checkbox" name="remember" class="w-4 h-4 rounded text-indigo-600 focus:ring-indigo-500 cursor-pointer" style="background-color: #020617; border-color: #334155;">
                <label for="remember_me" class="ms-2 text-xs text-slate-400 cursor-pointer hover:text-slate-300">Keep me logged in</label>
            </div>

            <div class="pt-2 flex flex-col gap-3">
                <button type="submit" class="w-full py-2.5 px-4 text-white text-sm font-semibold rounded-xl shadow-lg hover:opacity-95 transition-all" style="background-color: #4f46e5;">
                    Log In
                </button>
                <div class="text-center">
                    <a class="text-xs text-slate-400 hover:text-indigo-400 underline" href="{{ route('register') }}">
                        Don't have an enterprise profile? Sign Up
                    </a>
                </div>
            </div>
        </form>
    </div>
</x-guest-layout>