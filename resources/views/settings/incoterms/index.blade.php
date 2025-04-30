<x-app-layout>
    <x-slot name="header">

    </x-slot>
    <x-bladewind.notification />
    @if (session('success'))
        {!! session('success') !!}
    @endif

    <div class="container mx-auto">

        <x-bladewind::card reduce_padding="true">
            <h1 class="my-2 text-4xl font-light text-green-900/80"><b>Incoterms</b></h1>
            <p class="mt-3 mb-6 text-green-900/80 text-sm">
                List Of Registered Incoterms.
            </p>
            {{-- <h1 class="text-2xl font-bold mb-4">Litigation Cases</h1> --}}
            <div class="text-right">
                <x-bladewind::button has_spinner="true" name="save-user" onclick="showButtonSpinner('.save-user')">
                    <a href="{{ route('settings.incoterms.create') }}" class="btn btn-primary">Add New</a>
                </x-bladewind::button>
            </div><br>

            <x-bladewind::table selectable="flase" divider="thin" name="branch_list" searchable="true" celled="false"
                paginated="true" page_size="5" show_row_numbers="true" default_page="1"
                no_data_message="Branch Data empty!!">
                <x-slot:header>
                    <th class="md:hidden">id</th>
                    <th>Short Code</th>
                    <th>Description / Name</th>
                    <th class="text-right">Actions</th>
                </x-slot:header>
                {{-- @foreach ($fcyRequests as $fcyRequest) --}}
                    <tr>
                        <td class="md:hidden">1</td>
                        <td class="text-left">DEF</td>
                        <td class="text-left">Test Data</td>
                        <td class="text-left">ACTIVE</td>
                        <td class="!text-center md:table-cell">
                            <x-bladewind::dropmenu>
                                
                                <x-bladewind::dropmenu-item>
                                    <x-bladewind::button size="tiny" type="secondary" icon="pencil">
                                        Edit
                                    </x-bladewind::button>
                                </x-bladewind::dropmenu-item>

                                
                            </x-bladewind::dropmenu>
                        </td>
                    </tr>
                {{-- @endforeach --}}
            </x-bladewind::table>
        </x-bladewind::card>
    </div>
</x-app-layout>
