<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-left md:justify-between">

        </div>
    </x-slot>
    <x-bladewind.notification />
    {{-- @if (session('success'))
        {!! session('success') !!}
    @endif --}}
    @if (session('success'))
        {!! session('success') !!}
    @endif
    @if (session('error'))
        {!! session('error') !!}
    @endif
    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        <div class="container mx-auto">

            <div class="text-right">
                <x-bladewind::button has_spinner="true" name="save-user" onclick="showButtonSpinner('.save-user')">
                    <a href="{{ route('users.create') }}" class="btn btn-primary">New User</a>
                </x-bladewind::button>
            </div><br>

            <x-bladewind::card reduce_padding="true">
                <h1 class="my-2 text-4xl font-light text-green-900/80"><b>Manage Users</b></h1>

                <x-bladewind::table selectable="true" divider="thin" name="users_list" compact="true"
                    no_data_message="Users Data empty!!">
                    <x-slot:header>
                        <th class="hidden">User ID</th>
                        <th class="!text-center md:table-cell">User Full Name</th>
                        <th class="!text-center md:table-cell">User Name</th>
                        <th class="!text-center md:table-cell">Email</th>
                        <th class="!text-center md:table-cell">User Branch</th>
                        <th class="!text-center md:table-cell">User District</th>
                        <th class="!text-center md:table-cell">User Phone No</th>
                        <th class="!text-center">...</th>
                    </x-slot:header>
                    @foreach ($users as $user)
                        <tr>
                            <td class="hidden">{{ $user->id }}</td>
                            <td class="text-left md:table-cell">{{ $user->name }}</td>
                            <td class="text-left md:table-cell">{{ $user->userName }}</td>
                            <td class="text-left md:table-cell">{{ $user->email }}</td>
                            <td class="text-left md:table-cell">{{ $user->userBranch }}</td>
                            <td class="text-left md:table-cell">{{ $user->userDistrict }}</td>
                            <td class="text-left md:table-cell">{{ $user->userPhone }}</td>
                            <td class="text-right">
                                <x-bladewind::dropmenu scrollable="true" height="100">
                                    <x-bladewind::dropmenu-item>
                                        {{-- <x-bladewind::button.circle size="tiny" type="secondary" icon="eye" /> --}}
                                        <x-bladewind::button size="tiny" icon="eye"><a
                                                href="{{ route('users.show', $user) }}"
                                                class="btn btn-secondary">view</a></x-bladewind::button>
                                    </x-bladewind::dropmenu-item>
                                    <x-bladewind::dropmenu-item>
                                        <x-bladewind::button size="tiny" icon="pencil" color="green"><a
                                                href="{{ route('users.edit', $user) }}"
                                                class="btn btn-secondary">edit</a></x-bladewind::button>
                                    </x-bladewind::dropmenu-item>
                                    <x-bladewind::dropmenu-item>
                                        <x-bladewind::button size="tiny" icon="cogs" color="green"><a
                                                href="{{ route('users.resetUserPasswordView', $user) }}"
                                                class="btn btn-secondary">Reset Password</a></x-bladewind::button>
                                        {{-- <form action="{{ route('users.resetUserPassword', $user) }}" method="POST"
                                            class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <x-bladewind::button size="tiny" type="secondary" color="yellow"
                                                icon="cogs" icon_left="true"
                                                onclick="return confirm('Are you sure you want to Reset the user Password?')">
                                                Reset Password
                                            </x-bladewind::button>
                                        </form> --}}
                                    </x-bladewind::dropmenu-item>
                                    <x-bladewind::dropmenu-item>
                                        <form action="{{ route('users.destroy', $user) }}" method="POST"
                                            class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <x-bladewind::button size="tiny" type="secondary" color="red"
                                                icon="trash" icon_left="true"
                                                onclick="return confirm('Are you sure you want to delete this user?')">
                                                Delete
                                            </x-bladewind::button>
                                        </form>
                                    </x-bladewind::dropmenu-item>
                                </x-bladewind::dropmenu>
                            </td>
                        </tr>
                    @endforeach

                </x-bladewind::table>
                <x-slot:footer>
                    <div class="flex justify-between p-4">
                        <div class="flex space-x-4">
                            <br>
                            <br>
                        </div>
                        <div>

                        </div>
                    </div>
                </x-slot:footer>
            </x-bladewind::card>
        </div>
    </div>
</x-app-layout>

<script>
    function toggleDetails(userId) {
        const detailsRow = document.getElementById(`details-${userId}`);
        detailsRow.classList.toggle('hidden');
    }
</script>
