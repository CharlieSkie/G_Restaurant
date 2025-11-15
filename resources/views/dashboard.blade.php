<x-app-layout>
    <x-slot name="header">
        <h2 style="font-weight: 600; font-size: 24px; color: #FFD700; margin-bottom: 1rem;">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <!-- Main Content -->
    <div style="padding: 2rem; background-color: #0f0f0f; min-height: 80vh; color: #f3f3f3; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 24px; font-weight: 600;">
        Hello, {{ Auth::user()->name }}! Welcome back to your dashboard.
    </div>
</x-app-layout>
