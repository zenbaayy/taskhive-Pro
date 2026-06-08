<x-guest-layout>
    <div class="w-full rounded-2xl p-8 border shadow-2xl relative overflow-hidden" style="background-color: #0f172a; border-color: #1e293b;">
        
        <h3 class="text-center font-bold text-xl text-white mb-1">Create New Account</h3>
        <p class="text-center text-xs text-slate-400 mb-6" style="color: #94a3b8;">Join TaskHive Pro to optimize team productivity.</p>

        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <div class="flex flex-col items-center justify-center mb-4">
                <div class="relative w-20 h-20 mb-2 cursor-pointer rounded-full flex items-center justify-center text-xl font-bold uppercase" onclick="document.getElementById('avatar').click()" id="avatar-placeholder" style="background: linear-gradient(to bottom right, #4f46e5, #2563eb); border: 3px solid #334155; color: white;">
                    ?
                </div>
                <label for="avatar" class="text-xs font-semibold text-indigo-400 hover:text-indigo-300 cursor-pointer">
                    Choose Profile Photo
                </label>
                <input id="avatar" name="avatar" type="file" class="hidden" accept="image/*" onchange="previewImage(this)" />
                <x-input-error :messages="$errors->get('avatar')" class="mt-1" />
            </div>

            <div>
                <label for="name" class="block text-xs font-semibold mb-1" style="color: #cbd5e1;">Full Name</label>
                <input id="name" type="text" name="name" :value="old('name')" required autofocus onkeyup="updatePlaceholderInitials(this.value)" class="block w-full px-3.5 py-2 border text-sm rounded-xl focus:outline-none focus:ring-1 focus:ring-indigo-500 text-white" style="background-color: #020617; border-color: #334155;" placeholder="Zainab Afzal" />
                <x-input-error :messages="$errors->get('name')" class="mt-1" />
            </div>

            <div>
                <label for="email" class="block text-xs font-semibold mb-1" style="color: #cbd5e1;">Business Email</label>
                <input id="email" type="email" name="email" :value="old('email')" required class="block w-full px-3.5 py-2 border text-sm rounded-xl focus:outline-none focus:ring-1 focus:ring-indigo-500 text-white" style="background-color: #020617; border-color: #334155;" placeholder="name@company.com" />
                <x-input-error :messages="$errors->get('email')" class="mt-1" />
            </div>

            <input type="hidden" name="role" value="member">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="password" class="block text-xs font-semibold mb-1" style="color: #cbd5e1;">Password</label>
                    <input id="password" type="password" name="password" required class="block w-full px-3.5 py-2 border text-sm rounded-xl focus:outline-none focus:ring-1 focus:ring-indigo-500 text-white" style="background-color: #020617; border-color: #334155;" placeholder="••••••••" />
                    <x-input-error :messages="$errors->get('password')" class="mt-1" />
                </div>
                <div>
                    <label for="password_confirmation" class="block text-xs font-semibold mb-1" style="color: #cbd5e1;">Confirm</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required class="block w-full px-3.5 py-2 border text-sm rounded-xl focus:outline-none focus:ring-1 focus:ring-indigo-500 text-white" style="background-color: #020617; border-color: #334155;" placeholder="••••••••" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
                </div>
            </div>

            <div class="pt-3 flex flex-col gap-3">
                <button type="submit" class="w-full py-2.5 px-4 text-white text-sm font-semibold rounded-xl shadow-lg hover:opacity-95 transition-all" style="background-color: #4f46e5;">
                    Create Account
                </button>
                <div class="text-center">
                    <a class="text-xs text-slate-400 hover:text-indigo-400 underline" href="{{ route('login') }}">
                        Already registered? Log In
                    </a>
                </div>
            </div>
        </form>
    </div>

    <script>
        function previewImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    let container = document.getElementById('avatar-placeholder');
                    container.innerHTML = `<img src="${e.target.result}" class="w-20 h-20 rounded-full object-cover">`;
                    container.style.padding = '0';
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        
        function updatePlaceholderInitials(name) {
            let placeholder = document.getElementById('avatar-placeholder');
            if (placeholder && !placeholder.querySelector('img')) {
                placeholder.innerText = name ? name.trim().charAt(0).toUpperCase() : '?';
            }
        }

        // Automatic script execution to listen to URL parameters on load
        window.addEventListener('DOMContentLoaded', () => {
            const urlParams = new URLSearchParams(window.location.search);
            const type = urlParams.get('type');
            const roleSelect = document.getElementById('role');
            
            if (type && roleSelect) {
                if (type === 'member' || type === 'admin') {
                    roleSelect.value = type;
                }
            }
        });
    </script>
</x-guest-layout>