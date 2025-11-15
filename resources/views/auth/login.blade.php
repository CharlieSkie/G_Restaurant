<x-guest-layout>
    <div style="min-height: 100vh; display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, #0f0f0f, #1a1a1a, #000); color: #f3f3f3; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
        <div style="width: 100%; max-width: 400px; background: rgba(25, 25, 25, 0.95); border: 1px solid #333; border-radius: 15px; padding: 2.5rem; box-shadow: 0 0 25px rgba(0,0,0,0.6);">
            
            <h2 style="text-align: center; color: #FFD700; font-size: 24px; font-weight: 700; margin-bottom: 1.5rem;">Login to Your Account</h2>

            <x-validation-errors style="margin-bottom: 1rem;" />

            @session('status')
                <div style="margin-bottom: 1rem; font-size: 14px; color: #00FF7F;">
                    {{ $value }}
                </div>
            @endsession

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div style="margin-bottom: 1rem;">
                    <x-label for="email" value="{{ __('Email') }}" style="color: #e0c97f; font-size: 14px;" />
                    <x-input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username"
                        placeholder="Enter your email"
                        style="margin-top: 6px; width: 100%; background: #1e1e1e; color: #f3f3f3; border: 1px solid #555; border-radius: 8px; padding: 10px; font-size: 15px; outline: none;"
                        onfocus="this.style.borderColor='#FFD700';" onblur="this.style.borderColor='#555';" />
                </div>

                <!-- Password -->
                <div style="margin-bottom: 1rem;">
                    <x-label for="password" value="{{ __('Password') }}" style="color: #e0c97f; font-size: 14px;" />
                    <x-input id="password" type="password" name="password" required autocomplete="current-password"
                        placeholder="Enter your password"
                        style="margin-top: 6px; width: 100%; background: #1e1e1e; color: #f3f3f3; border: 1px solid #555; border-radius: 8px; padding: 10px; font-size: 15px; outline: none;"
                        onfocus="this.style.borderColor='#FFD700';" onblur="this.style.borderColor='#555';" />
                </div>

                <!-- Remember Me -->
                <div style="margin-bottom: 1.5rem;">
                    <label for="remember_me" style="display: flex; align-items: center; font-size: 14px; color: #ccc;">
                        <x-checkbox id="remember_me" name="remember" style="accent-color: #FFD700; margin-right: 6px;" />
                        <span>Remember me</span>
                    </label>
                </div>

                <!-- Buttons -->
                <div style="display: flex; align-items: center; justify-content: space-between;">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" style="font-size: 14px; color: #ccc; text-decoration: none;"
                            onmouseover="this.style.color='#FFD700';" onmouseout="this.style.color='#ccc';">
                            Forgot your password?
                        </a>
                    @endif

                    <x-button style="background-color: #FFD700; color: #1a1a1a; border: none; border-radius: 8px; padding: 10px 20px; font-weight: 600; cursor: pointer; transition: 0.3s;"
                        onmouseover="this.style.backgroundColor='#ffea70';" onmouseout="this.style.backgroundColor='#FFD700';">
                        {{ __('Log in') }}
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
