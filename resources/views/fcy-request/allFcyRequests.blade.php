<x-app-layout>
    <x-slot name="header">

    </x-slot>
    <x-bladewind.notification />
    @if (session('success'))
        {!! session('success') !!}
    @endif

    <div class="container mx-auto">

        <x-bladewind::card reduce_padding="true">
            <h1 class="my-2 text-4xl font-light text-green-900/80"><b>FCY Requests</b></h1>
            <p class="mt-3 mb-6 text-green-900/80 text-sm">
                List Of Registered FCY Requests.
            </p>
        </x-bladewind::card>
        {{-- Trigger Button for Modal --}}
        <div class="flex justify-end gap-4 mb-4">
            <x-bladewind::button type="secondary" onclick="showModal('filter_modal')" class="mb-4">
                Open Filter
            </x-bladewind::button>
        </div>
        {{-- Modal for Filter Form --}}
        <x-bladewind::modal name="filter_modal" title="Filter FCY Requests" size="xl" show_close_icon="true"
            show_action_buttons="false">
            <form method="GET" action="{{ route('fcy-request.allFcyRequests') }}" class="mb-4">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <x-bladewind::input name="idReference" label="Reference ID" value="{{ request('idReference') }}" />
                    <x-bladewind::input name="performaInvoiceNumber" label="Performa Number"
                        value="{{ request('performaInvoiceNumber') }}" />
                    <x-bladewind::input name="applicantName" label="Applicant Name"
                        value="{{ request('applicantName') }}" />
                    <x-bladewind::input name="currencyType" label="Currency Type"
                        value="{{ request('currencyType') }}" />
                    <x-bladewind::input type="date" name="dateOfApplication" label="Application Date"
                        value="{{ request('dateOfApplication') }}" />
                    <x-bladewind::input type="date" name="startDate" label="Start Date"
                        value="{{ request('startDate') }}" />
                    <x-bladewind::input type="date" name="endDate" label="End Date"
                        value="{{ request('endDate') }}" />

                </div>
                <div class="flex justify-end mt-4">
                    <x-bladewind::button type="secondary" has_spinner="true" can_submit="true">
                        Apply Filter
                    </x-bladewind::button>
                </div>
            </form>
        </x-bladewind::modal>

        <x-bladewind::card reduce_padding="true">
            <x-bladewind::table selectable="flase" divider="thin" name="branch_list" searchable="true" celled="false"
                paginated="true" page_size="5" show_row_numbers="true" default_page="1"
                no_data_message="Branch Data empty!!">
                <x-slot:header>
                    <th class="md:hidden">id</th>
                    <th>Reference ID</th>
                    <th>Applicant Name</th>
                    <th>branchName</th>
                    <th>NBE Account Number</th>
                    <th>Currency Type</th>
                    <th>Mode of Payment</th>
                    <th>More</th>
                </x-slot:header>
                @foreach ($allFcyRequest as $fcyRequest)
                    <tr>
                        <td class="md:hidden">{{ $fcyRequest->id }}</td>
                        <td class="text-left">{{ $fcyRequest->idReference }}</td>
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
                        <th>Performa Number</th>
                        <th>Performa Date</th>
                        <th>Shipment Place</th>
                        <th>Destination Place</th>
                        <th>Goods And Services</th>
                        <th>Item HS Code</th>
                        <th>Item Name</th>
                        </x-slot:header>
                    <tr>
                        <td class="text-left">{{ $fcyRequest->performaInvoiceNumber }}</td>
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

    </tr>
    @endforeach
    </x-bladewind::table>
    <div class="flex justify-end gap-4 mb-4">
        <a href="{{ route('fcy-request.export.excel') }}">
            <x-bladewind::button type="secondary" icon="download">Export to Excel</x-bladewind::button>
        </a>

        <a href="{{ route('fcy-request.export.pdf') }}">
            <x-bladewind::button type="secondary" icon="file-text">Export to PDF</x-bladewind::button>
        </a>
    </div>
    </x-bladewind::card>
    </div>
</x-app-layout>
