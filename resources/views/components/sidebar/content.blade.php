<x-perfect-scrollbar as="nav" aria-label="main" class="flex flex-col flex-1 gap-4 px-3">

    <x-sidebar.link title="Dashboard" href="{{ route('dashboard') }}" :isActive="request()->routeIs('dashboard')">
        <x-slot name="icon">
            <x-icons.dashboard class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>
    </x-sidebar.link>
    @switch(auth()->user()->userRole)
        @case('ADMIN')
            <x-sidebar.dropdown title="Users" :active="Str::startsWith(request()->route()->uri(), 'users')">
                <x-slot name="icon">
                    <x-icons.users class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
                </x-slot>

                <x-sidebar.sublink title="New User" href="{{ route('users.create') }}" :active="request()->routeIs('users.create')" />

                <x-sidebar.sublink title="Manage User" href="{{ route('users.index') }}" :active="request()->routeIs('users.index')" />

                <x-sidebar.sublink title="Auth/Reject User" href="{{ route('users.authOrReject') }}" :active="request()->routeIs('users.authOrReject')" />
            </x-sidebar.dropdown>

            <x-sidebar.dropdown title="FCY Request" :active="Str::startsWith(request()->route()->uri(), 'fcy-request')">
                <x-slot name="icon">
                    <x-icons.forex class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
                </x-slot>

                <x-sidebar.sublink title="Request Registration" href="{{ route('fcy-request.create') }}" :active="request()->routeIs('fcy-request.create')" />

                <x-sidebar.sublink title="Verify Request (Registration)"
                    href="{{ route('fcy-request.listUnauthorizedRequests') }}" :active="request()->routeIs('fcy-request.listUnauthorizedRequests')" />

                <x-sidebar.sublink title="Authorize Request (Registration 2)"
                    href="{{ route('fcy-request.listUnauthorizedRequests2') }}" :active="request()->routeIs('fcy-request.listUnauthorizedRequests2')" />

                <x-sidebar.sublink title="Approve Request (Allocation)" href="{{ route('fcy-request.listAuthorizedRequests') }}"
                    :active="request()->routeIs('fcy-request.listAuthorizedRequests')" />

                <x-sidebar.sublink title="Request Lists " href="{{ route('fcy-request.index') }}" :active="request()->routeIs('fcy-request.index')" />

            </x-sidebar.dropdown>

            <x-sidebar.dropdown title="Reports" :active="Str::startsWith(request()->route()->uri(), 'reports')">
                <x-slot name="icon">
                    <x-icons.reports class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
                </x-slot>

                <x-sidebar.sublink title="All Fcy Requests" href="{{ route('fcy-request.allFcyRequests') }}"
                    :active="request()->routeIs('fcy-request.allFcyRequests')" />
                <x-sidebar.sublink title="Unauthorized Requests" href="{{ route('fcy-request.unAuthFcyRequests') }}"
                    :active="request()->routeIs('fcy-request.unAuthFcyRequests')" />
                <x-sidebar.sublink title="Authorized Requests" href="{{ route('fcy-request.authFcyRequests') }}"
                    :active="request()->routeIs('fcy-request.authFcyRequests')" />

                <x-sidebar.sublink title="Approved Requests" href="{{ route('fcy-request.approvedFcyRequests') }}"
                    :active="request()->routeIs('fcy-request.approvedFcyRequests')" />
                <x-sidebar.sublink title="Rejected Requests" href="{{ route('fcy-request.rejectedFcyRequests') }}"
                    :active="request()->routeIs('fcy-request.rejectedFcyRequests')" />
            </x-sidebar.dropdown>


            <x-sidebar.dropdown title="Audits" :active="Str::startsWith(request()->route()->uri(), 'audit')">
                <x-slot name="icon">
                    <x-icons.audits class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
                </x-slot>

                <x-sidebar.sublink title="User Audit" href="{{ route('audit.index') }}" :active="request()->routeIs('audit.index')" />

            </x-sidebar.dropdown>

            <x-sidebar.dropdown title="Settings " :active="Str::startsWith(request()->route()->uri(), 'settings')">
                <x-slot name="icon">
                    <x-icons.settings class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
                </x-slot>

                <x-sidebar.sublink title="Currency" href="{{ route('settings.currency.index') }}" :active="request()->routeIs('settings.currency.index')" />

                <x-sidebar.sublink title="Mode of Payment" href="{{ route('settings.modeOfPayments.index') }}"
                    :active="request()->routeIs('settings.modeOfPayments.index')" />

                <x-sidebar.sublink title="Incoterms" href="{{ route('settings.incoterms.index') }}" :active="request()->routeIs('settings.incoterms.index')" />

                <x-sidebar.sublink title="Other Settings" href="{{ route('settings.otherSettings.otherSettingsIndex') }}"
                    :active="request()->routeIs('settings.otherSettings.otherSettingsIndex')" />

            </x-sidebar.dropdown>
        @break

        @default
    @endswitch

    @switch(auth()->user()->userRole)
        @case('MAKER')
            <x-sidebar.dropdown title="Users" :active="Str::startsWith(request()->route()->uri(), 'users')">
                <x-slot name="icon">
                    <x-icons.users class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
                </x-slot>

                <x-sidebar.sublink title="New User" href="{{ route('users.create') }}" :active="request()->routeIs('users.create')" />

                <x-sidebar.sublink title="Manage User" href="{{ route('users.index') }}" :active="request()->routeIs('users.index')" />

                <x-sidebar.sublink title="Auth/Reject User" href="{{ route('users.authOrReject') }}" :active="request()->routeIs('users.authOrReject')" />
            </x-sidebar.dropdown>

            <x-sidebar.dropdown title="FCY Request" :active="Str::startsWith(request()->route()->uri(), 'fcy-request')">
                <x-slot name="icon">
                    <x-icons.forex class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
                </x-slot>

                <x-sidebar.sublink title="Request Registration" href="{{ route('fcy-request.create') }}" :active="request()->routeIs('fcy-request.create')" />

                <x-sidebar.sublink title="Verify Request (Registration)"
                    href="{{ route('fcy-request.listUnauthorizedRequests') }}" :active="request()->routeIs('fcy-request.listUnauthorizedRequests')" />

                <x-sidebar.sublink title="Request Lists " href="{{ route('fcy-request.index') }}" :active="request()->routeIs('fcy-request.index')" />

            </x-sidebar.dropdown>

            <x-sidebar.dropdown title="Reports" :active="Str::startsWith(request()->route()->uri(), 'reports')">
                <x-slot name="icon">
                    <x-icons.reports class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
                </x-slot>

                <x-sidebar.sublink title="All Fcy Requests" href="{{ route('fcy-request.allFcyRequests') }}"
                    :active="request()->routeIs('fcy-request.allFcyRequests')" />
                <x-sidebar.sublink title="Unauthorized Requests" href="{{ route('fcy-request.unAuthFcyRequests') }}"
                    :active="request()->routeIs('fcy-request.unAuthFcyRequests')" />
                <x-sidebar.sublink title="Authorized Requests" href="{{ route('fcy-request.authFcyRequests') }}"
                    :active="request()->routeIs('fcy-request.authFcyRequests')" />

                <x-sidebar.sublink title="Approved Requests" href="{{ route('fcy-request.approvedFcyRequests') }}"
                    :active="request()->routeIs('fcy-request.approvedFcyRequests')" />
                <x-sidebar.sublink title="Rejected Requests" href="{{ route('fcy-request.rejectedFcyRequests') }}"
                    :active="request()->routeIs('fcy-request.rejectedFcyRequests')" />
            </x-sidebar.dropdown>
        @break

        @default
    @endswitch

    @switch(auth()->user()->userRole)
        @case('OFFICER')
            <x-sidebar.dropdown title="FCY Request" :active="Str::startsWith(request()->route()->uri(), 'fcy-request')">
                <x-slot name="icon">
                    <x-icons.forex class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
                </x-slot>

                <x-sidebar.sublink title="Verify Request (Registration)"
                    href="{{ route('fcy-request.listUnauthorizedRequests') }}" :active="request()->routeIs('fcy-request.listUnauthorizedRequests')" />

                <x-sidebar.sublink title="Approve Request (Allocation)"
                    href="{{ route('fcy-request.listAuthorizedRequests') }}" :active="request()->routeIs('fcy-request.listAuthorizedRequests')" />

                <x-sidebar.sublink title="Request Lists " href="{{ route('fcy-request.index') }}" :active="request()->routeIs('fcy-request.index')" />

            </x-sidebar.dropdown>

            <x-sidebar.dropdown title="Reports" :active="Str::startsWith(request()->route()->uri(), 'reports')">
                <x-slot name="icon">
                    <x-icons.reports class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
                </x-slot>

                <x-sidebar.sublink title="All Fcy Requests" href="{{ route('fcy-request.allFcyRequests') }}"
                    :active="request()->routeIs('fcy-request.allFcyRequests')" />
                <x-sidebar.sublink title="Unauthorized Requests" href="{{ route('fcy-request.unAuthFcyRequests') }}"
                    :active="request()->routeIs('fcy-request.unAuthFcyRequests')" />
                <x-sidebar.sublink title="Authorized Requests" href="{{ route('fcy-request.authFcyRequests') }}"
                    :active="request()->routeIs('fcy-request.authFcyRequests')" />

                <x-sidebar.sublink title="Approved Requests" href="{{ route('fcy-request.approvedFcyRequests') }}"
                    :active="request()->routeIs('fcy-request.approvedFcyRequests')" />
                <x-sidebar.sublink title="Rejected Requests" href="{{ route('fcy-request.rejectedFcyRequests') }}"
                    :active="request()->routeIs('fcy-request.rejectedFcyRequests')" />
            </x-sidebar.dropdown>
        @break

        @default
    @endswitch

    @switch(auth()->user()->userRole)
        @case('MANAGER')
            <x-sidebar.dropdown title="FCY Request" :active="Str::startsWith(request()->route()->uri(), 'fcy-request')">
                <x-slot name="icon">
                    <x-icons.forex class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
                </x-slot>

                <x-sidebar.sublink title="Authorize Request (Registration 2)"
                    href="{{ route('fcy-request.listUnauthorizedRequests2') }}" :active="request()->routeIs('fcy-request.listUnauthorizedRequests2')" />

                <x-sidebar.sublink title="Approve Request (Allocation)"
                    href="{{ route('fcy-request.listAuthorizedRequests') }}" :active="request()->routeIs('fcy-request.listAuthorizedRequests')" />

                <x-sidebar.sublink title="Request Lists " href="{{ route('fcy-request.index') }}" :active="request()->routeIs('fcy-request.index')" />

            </x-sidebar.dropdown>

            <x-sidebar.dropdown title="Settings " :active="Str::startsWith(request()->route()->uri(), 'settings')">
                <x-slot name="icon">
                    <x-icons.settings class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
                </x-slot>

                <x-sidebar.sublink title="Currency" href="{{ route('settings.currency.index') }}" :active="request()->routeIs('settings.currency.index')" />

                <x-sidebar.sublink title="Mode of Payment" href="{{ route('settings.modeOfPayments.index') }}"
                    :active="request()->routeIs('settings.modeOfPayments.index')" />

                <x-sidebar.sublink title="Incoterms" href="{{ route('settings.incoterms.index') }}" :active="request()->routeIs('settings.incoterms.index')" />

            </x-sidebar.dropdown>

            <x-sidebar.dropdown title="Reports" :active="Str::startsWith(request()->route()->uri(), 'reports')">
                <x-slot name="icon">
                    <x-icons.reports class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
                </x-slot>

                <x-sidebar.sublink title="All Fcy Requests" href="{{ route('fcy-request.allFcyRequests') }}"
                    :active="request()->routeIs('fcy-request.allFcyRequests')" />
                <x-sidebar.sublink title="Unauthorized Requests" href="{{ route('fcy-request.unAuthFcyRequests') }}"
                    :active="request()->routeIs('fcy-request.unAuthFcyRequests')" />
                <x-sidebar.sublink title="Authorized Requests" href="{{ route('fcy-request.authFcyRequests') }}"
                    :active="request()->routeIs('fcy-request.authFcyRequests')" />

                <x-sidebar.sublink title="Approved Requests" href="{{ route('fcy-request.approvedFcyRequests') }}"
                    :active="request()->routeIs('fcy-request.approvedFcyRequests')" />
                <x-sidebar.sublink title="Rejected Requests" href="{{ route('fcy-request.rejectedFcyRequests') }}"
                    :active="request()->routeIs('fcy-request.rejectedFcyRequests')" />
            </x-sidebar.dropdown>
        @break

        @default
    @endswitch
</x-perfect-scrollbar>
