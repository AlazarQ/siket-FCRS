<x-app-layout>
    <x-slot name="header">

    </x-slot>
    <x-bladewind.notification />
    @if (session('success'))
        {!! session('success') !!}
    @endif

    <div class="container mx-auto">

        <x-bladewind::card reduce_padding="true">
            <h1 class="my-2 text-4xl font-light text-green-900/80"><b>FCy Requests</b></h1>
            <p class="mt-3 mb-6 text-green-900/80 text-sm">
                List Of Registered FCy Requests.
            </p>
            {{-- <h1 class="text-2xl font-bold mb-4">Litigation Cases</h1> --}}
            {{-- <div class="text-right">
                <x-bladewind::button has_spinner="true" name="save-user" onclick="showButtonSpinner('.save-user')">
                    <a href="{{ route('fcy-request.create') }}" class="btn btn-primary">New Request</a>
                </x-bladewind::button>
            </div><br> --}}

            <x-bladewind::table selectable="flase" divider="thin" name="branch_list" searchable="true" celled="false"
                paginated="true" page_size="5" show_row_numbers="true" default_page="1"
                no_data_message="FCY Request Data empty!!">
                <x-slot:header>
                    <th class="md:hidden">id</th>
                    <th>applicantName</th>
                    <th>branchName</th>
                    <th>NBEAccountNumber</th>
                    <th>currencyType</th>
                    <th>Mode of Payment</th>
                    <th>More Detrails</th>
                    <th class="text-right">Actions</th>
                </x-slot:header>
                @foreach ($fcyRequests as $fcyRequest)
                    <tr>
                        <td class="md:hidden">{{ $fcyRequest->id }}</td>
                        <td class="text-left">{{ $fcyRequest->applicantName }}</td>
                        <td class="text-left">{{ $fcyRequest->branchName }}</td>
                        <td class="text-left">{{ $fcyRequest->NBEAccountNumber }}</td>
                        <td class="text-left">{{ $fcyRequest->currencyType }}</td>
                        <td class="text-left">{{ $fcyRequest->modeOfPayment }}</td>

                        <td class="border px-4 py-2 max-w-[200px] truncate cursor-pointer">
                            <div onclick="showModal('modal_more_{{ $fcyRequest->id }}')">
                                More
                            </div>
                            <x-bladewind::modal name="modal_more_{{ $fcyRequest->id }}" title="" size="xl" 
                                show_close_icon="true" show_action_buttons="false">
                                <div class="p-4 text-sm">
                                    <div class="overflow-auto max-h-[400px]">
                                        <x-bladewind::table selectable="flase" 
                                            no_data_message="FCY Request Data empty!!">
                                            <x-slot:header>
                        <th>Performa Date</th>
                        <th>Shipment Place</th>
                        <th>Destination Place</th>
                        <th>Goods And Services</th>
                        <th>Item HS Code</th>
                        <th>Item Name</th>
                        </x-slot:header>
                    <tr>
                        <td class="text-left">{{ $fcyRequest->performaDate }}</td>
                        <td class="text-left">{{ $fcyRequest->shipmentPlace }}</td>
                        <td class="text-left">{{ $fcyRequest->destinationPlace }}</td>
                        <td class="text-left">{{ $fcyRequest->descriptionOfGoodService }}</td>
                        <td class="text-left">{{ $fcyRequest->itemHSCode }}</td>
                        <td class="text-left">{{ $fcyRequest->itemName }}</td>
                    </tr>
            </x-bladewind::table>

    </div>
    </x-bladewind::modal>
    </td>

    <td class="!text-center md:table-cell">
        <x-bladewind::dropmenu>
            <x-bladewind::dropmenu-item>
                <x-bladewind::button size="tiny" type="secondary" icon="eye">
                    <a href="{{ route('fcy-request.show', $fcyRequest) }}" class="btn btn-secondary">View</a>
                </x-bladewind::button>
            </x-bladewind::dropmenu-item>
        </x-bladewind::dropmenu>
    </td>
    </tr>
    @endforeach
    </x-bladewind::table>
    </x-bladewind::card>
    </div>
</x-app-layout>
