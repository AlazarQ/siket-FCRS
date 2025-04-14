<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Change Password') }}
            </h2>
        </div>
    </x-slot>
    <x-bladewind.notification />
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-md mx-auto bg-white rounded-lg shadow-md overflow-hidden">
            <div class="bg-blue-600 py-4 px-6">
                <h1 class="text-white text-xl font-bold">Change Your Password</h1>
                <p class="text-blue-100 text-sm mt-1">You must change your default password before proceeding.</p>
            </div>

            <div class="p-6">
                <form method="POST" action="{{ route('password.change') }}">
                    @csrf

                    <div class="mb-4">
                        <x-bladewind::input type="password" name="password" label="New Password" required="true"
                            placeholder="Enter your new password" class="w-full" />
                        @error('password')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <x-bladewind::input type="password" name="password_confirmation" label="Confirm New Password"
                            required="true" placeholder="Confirm your new password" class="w-full" />
                    </div>

                    <div class="flex justify-end">
                        <x-bladewind::button type="primary" can_submit="true" class="w-full justify-center">
                            Change Password
                        </x-bladewind::button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>