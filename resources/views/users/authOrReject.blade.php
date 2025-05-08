<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-left md:justify-between">

        </div>
    </x-slot>
    <x-bladewind.notification />
    @if (session('success'))
        {!! session('success') !!}
    @endif

    @if (session('error'))
        {!! session('error') !!}
    @endif
    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        <div class="container mx-auto">



            <x-bladewind::card reduce_padding="true">
                <h1 class="my-2 text-4xl font-light text-green-900/80"><b>Authorize Or Reject User Creation</b></h1>

                <x-bladewind::table selectable="true" divider="thin" name="users_list" no_data_message="Users Data empty!!">
                    <x-slot:header>
                        <th class="hidden">User ID</th>
                        <th class="!text-center md:table-cell">User Full Name</th>
                        <th class="!text-center md:table-cell">User Name</th>
                        <th class="!text-center md:table-cell">Email</th>
                        <th class="!text-center md:table-cell">User Branch</th>
                        <th class="!text-center md:table-cell">User District</th>
                        <th class="!text-center md:table-cell">User Phone No</th>
                        <th class="!text-center md:table-cell">User Role</th>
                        <th class="!text-center">Actions</th>
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
                            <td class="text-left md:table-cell">{{ $user->userRole }}</td>
                            <td class="text-right">
                                <x-bladewind::dropmenu>
                                    <x-bladewind::dropmenu-item>
                                        <form action="{{ route('users.authorize', $user) }}" method="POST"
                                            class="inline-block">
                                            @csrf
                                            @method('PATCH')
                                            <x-bladewind::button size="tiny" type="success" can_submit="true"
                                                icon="check" icon_left="true">
                                                Authorize
                                            </x-bladewind::button>
                                        </form>
                                    </x-bladewind::dropmenu-item>
                                    <x-bladewind::dropmenu-item>
                                        <form action="{{ route('users.reject', $user) }}" method="POST"
                                            class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <x-bladewind::button size="tiny" type="danger" can_submit="true"
                                                icon="x" icon_left="true"
                                                onclick="return confirm('Are you sure you want to reject this user?')">
                                                Reject
                                            </x-bladewind::button>
                                        </form>
                                    </x-bladewind::dropmenu-item>
                                </x-bladewind::dropmenu>
                            </td>
                            <td></td>
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
