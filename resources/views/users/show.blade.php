<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('District Details') }}
            </h2>
        </div>
    </x-slot>
    <x-bladewind.notification />

    <x-bladewind.card>
        <h1 class="my-2 text-4xl font-light text-green-900/80"><b>User Details</b></h1>
        <p class="mt-3 mb-6 text-green-900/80 text-sm">
            Below are the details of the selected District.
        </p>
        <div class="grid grid-cols-1">

            <x-bladewind::card compact="true">
                <div class="flex items-center">
                    <div>
                        <x-icons.defaultUser class="flex-shrink-0 w-24 h-24" aria-hidden="true" />
                    </div>
                    <div class="grow pl-12 pt-1">
                        <div class="flex"><p class="w-48">User Full Name:</p> <span class="text-green-900/80">{{ $user->name }}</span></div>
                            {{-- <x-bladewind::input value="{{ $user->name }}" /></div> --}}
                        <div class="flex">
                            <p class="w-48">User Email:</p>
                            <span class="text-green-900/80">{{ $user->email }}</span>
                        </div>
                        <div class="flex"><p class="w-48">User Username:</p><span class="text-green-900/80"> {{ $user->userName }}</span></div>
                        <div class="flex"><p class="w-48">User Branch:</p><span class="text-green-900/80"> {{ $user->userBranch }}</span></div>
                        <div class="flex"><p class="w-48">User District:</p><span class="text-green-900/80"> {{ $user->userDistrict }}</span></div>
                        <div class="flex"><p class="w-48">User Gender:</p><span class="text-green-900/80"> {{ $user->userGender }}</span></div>
                        <div class="flex"><p class="w-48">User Phone Number:</p><span class="text-green-900/80"> {{ $user->userPhone }}</span></div>
                        <div class="flex"><p class="w-48">User Status:</p><span class="text-green-900/80"> {{ $user->userStatus }}</span></div>
                        <div class="flex"><p class="w-48">User Role:</p><span class="text-green-900/80"> {{ $user->userRole }}</span></div>
                        <div class="flex"><p class="w-48">User Remark:</p><span class="text-green-900/80"> {{ $user->remark }}</span></div>
                    </div>
                    <div>
                        <a href="">
                            <svg>
                                ...
                            </svg>
                        </a>
                    </div>
                </div>
            </x-bladewind::card>
        </div>

        <div class="text-right">
            
            <x-bladewind::button icon="arrow-small-left" icon_left="true">
                <a href="{{ route('users.index') }}" class="btn btn-secondary">Back to List</a>
            </x-bladewind::button>
        </div>
    </x-bladewind.card>
</x-app-layout>
