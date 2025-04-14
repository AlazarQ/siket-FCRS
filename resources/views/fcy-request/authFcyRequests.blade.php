<x-app-layout>
    <x-slot name="header">

    </x-slot>
    <x-bladewind.notification />
    @if (session('success'))
        {!! session('success') !!}
    @endif

    <div class="container mx-auto">

        <x-bladewind::card reduce_padding="true">
            <h1 class="my-2 text-4xl font-light text-green-900/80"><b>FCy Requests - Authorized</b></h1>
            <p class="mt-3 mb-6 text-green-900/80 text-sm">
                List Of Authorized FCy Requests.
            </p>

            <x-bladewind::table selectable="flase" divider="thin" name="branch_list" searchable="true" celled="false"
                paginated="true" page_size="5" show_row_numbers="true" default_page="1"
                no_data_message="Branch Data empty!!">
                <x-slot:header>
                    <th class="md:hidden">id</th>
                    <th>applicantName</th>
                    <th>branchName</th>
                    <th>NBEAccountNumber</th>
                    <th>currencyType</th>
                    <th>Mode of Payment</th>
                    <th>Record Status</th>
                </x-slot:header>
                @foreach ($authFcyRequests as $fcyRequest)
                    <tr>
                        <td class="md:hidden">{{ $fcyRequest->id }}</td>
                        <td class="text-left">{{ $fcyRequest->applicantName }}</td>
                        <td class="text-left">{{ $fcyRequest->branchName }}</td>
                        <td class="text-left">{{ $fcyRequest->NBEAccountNumber }}</td>
                        <td class="text-left">{{ $fcyRequest->currencyType }}</td>
                        <td class="text-left">{{ $fcyRequest->modeOfPayment }}</td>
                        <td class="text-left">{{ $fcyRequest->recordStatus }}</td>
                    </tr>
                @endforeach
            </x-bladewind::table>
        </x-bladewind::card>
    </div>
</x-app-layout>
