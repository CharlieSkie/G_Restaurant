<x-guest-layout>
    <div style="min-height: 100vh; display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, #0f0f0f, #1a1a1a, #000); color: #f3f3f3; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
        <div style="width: 100%; max-width: 420px; background: rgba(25, 25, 25, 0.95); border: 1px solid #333; border-radius: 15px; padding: 2.5rem; box-shadow: 0 0 25px rgba(0,0,0,0.6);">
            
            <h2 style="text-align: center; color: #FFD700; font-size: 24px; font-weight: 700; margin-bottom: 1.5rem;">Create Your Account</h2>

            <x-validation-errors style="margin-bottom: 1rem;" />

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div style="margin-bottom: 1rem;">
                    <x-label for="name" value="{{ __('Name') }}" style="color: #e0c97f; font-size: 14px;" />
                    <x-input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name"
                        placeholder="Enter your full name"
                        style="margin-top: 6px; width: 100%; background: #1e1e1e; color: #f3f3f3; border: 1px solid #555; border-radius: 8px; padding: 10px; font-size: 15px; outline: none;"
                        onfocus="this.style.borderColor='#FFD700';" onblur="this.style.borderColor='#555';" />
                </div>

                <!-- Email -->
                <div style="margin-bottom: 1rem;">
                    <x-label for="email" value="{{ __('Email') }}" style="color: #e0c97f; font-size: 14px;" />
                    <x-input id="email" type="email" name="email" :value="old('email')" required autocomplete="username"
                        placeholder="Enter your email address"
                        style="margin-top: 6px; width: 100%; background: #1e1e1e; color: #f3f3f3; border: 1px solid #555; border-radius: 8px; padding: 10px; font-size: 15px; outline: none;"
                        onfocus="this.style.borderColor='#FFD700';" onblur="this.style.borderColor='#555';" />
                </div>

                <!-- Password -->
                <div style="margin-bottom: 1rem;">
                    <x-label for="password" value="{{ __('Password') }}" style="color: #e0c97f; font-size: 14px;" />
                    <x-input id="password" type="password" name="password" required autocomplete="new-password"
                        placeholder="Minimum 8 characters" minlength="8"
                        style="margin-top: 6px; width: 100%; background: #1e1e1e; color: #f3f3f3; border: 1px solid #555; border-radius: 8px; padding: 10px; font-size: 15px; outline: none;"
                        onfocus="this.style.borderColor='#FFD700';" onblur="this.style.borderColor='#555';" />
                </div>

                <!-- Confirm Password -->
                <div style="margin-bottom: 1rem;">
                    <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" style="color: #e0c97f; font-size: 14px;" />
                    <x-input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                        placeholder="Re-enter your password"
                        style="margin-top: 6px; width: 100%; background: #1e1e1e; color: #f3f3f3; border: 1px solid #555; border-radius: 8px; padding: 10px; font-size: 15px; outline: none;"
                        onfocus="this.style.borderColor='#FFD700';" onblur="this.style.borderColor='#555';" />
                </div>

                <!-- Phone -->
                <div style="margin-bottom: 1rem;">
                    <x-label for="phone" value="{{ __('Phone') }}" style="color: #e0c97f; font-size: 14px;" />
                    <x-input id="phone" type="text" name="phone" :value="old('phone')" required autocomplete="phone"
                        placeholder="Enter your phone number"
                        style="margin-top: 6px; width: 100%; background: #1e1e1e; color: #f3f3f3; border: 1px solid #555; border-radius: 8px; padding: 10px; font-size: 15px; outline: none;"
                        onfocus="this.style.borderColor='#FFD700';" onblur="this.style.borderColor='#555';" />
                </div>

                <!-- Address -->
                <div style="margin-bottom: 1rem;">
                    <x-label for="address" value="{{ __('Address') }}" style="color: #e0c97f; font-size: 14px;" />
                    <x-input id="address" type="text" name="address" :value="old('address')" required autocomplete="address"
                        placeholder="Enter your address"
                        style="margin-top: 6px; width: 100%; background: #1e1e1e; color: #f3f3f3; border: 1px solid #555; border-radius: 8px; padding: 10px; font-size: 15px; outline: none;"
                        onfocus="this.style.borderColor='#FFD700';" onblur="this.style.borderColor='#555';" />
                </div>

                <!-- Terms -->
                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                    <div style="margin-bottom: 1.2rem; font-size: 13px; color: #ccc;">
                        <x-label for="terms">
                            <div style="display: flex; align-items: center;">
                                <x-checkbox name="terms" id="terms" required style="accent-color: #FFD700; margin-right: 6px;" />
                                <div>
                                    {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" style="color:#FFD700; text-decoration: underline;">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" style="color:#FFD700; text-decoration: underline;">'.__('Privacy Policy').'</a>',
                                    ]) !!}
                                </div>
                            </div>
                        </x-label>
                    </div>
                @endif

                <!-- Buttons -->
                <div style="display: flex; align-items: center; justify-content: space-between; margin-top: 1.5rem;">
                    <a href="{{ route('login') }}" style="font-size: 14px; color: #ccc; text-decoration: none;" 
                        onmouseover="this.style.color='#FFD700';" onmouseout="this.style.color='#ccc';">
                        {{ __('Already registered?') }}
                    </a>

                    <x-button style="background-color: #FFD700; color: #1a1a1a; border: none; border-radius: 8px; padding: 10px 20px; font-weight: 600; cursor: pointer; transition: 0.3s;"
                        onmouseover="this.style.backgroundColor='#ffea70';" onmouseout="this.style.backgroundColor='#FFD700';">
                        {{ __('Register') }}
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
