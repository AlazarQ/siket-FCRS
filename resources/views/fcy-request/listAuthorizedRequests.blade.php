<x-app-layout>
    <x-slot name="header">

    </x-slot>
    <x-bladewind.notification />
    @if (session('success'))
        {!! session('success') !!}
    @endif

    <div class="container mx-auto">

        <x-bladewind::card reduce_padding="true">
            <h1 class="my-2 text-4xl font-light text-green-900/80"><b>FCy Requests - UnApproved</b></h1>
            <p class="mt-3 mb-6 text-green-900/80 text-sm">
                List Of Registered and Authorized but nor Approved FCY -Requests.
            </p>
            {{-- <h1 class="text-2xl font-bold mb-4">Litigation Cases</h1> --}}
            <div class="text-right">
                <x-bladewind::button has_spinner="true" name="save-user" onclick="showButtonSpinner('.save-user')">
                    <a href="{{ route('fcy-request.create') }}" class="btn btn-primary">New Request</a>
                </x-bladewind::button>
            </div><br>

            <x-bladewind::table selectable="flase" divider="thin" name="branch_list"
                no_data_message="Branch Data empty!!">
                <x-slot:header>
                    <th class="md:hidden">id</th>
                    <th>Applicant Name</th>
                    <th>Branch Name</th>
                    <th>NBE Account No</th>
                    <th>Currency</th>
                    <th>Mode of Payment</th>
                    {{-- <th>descriptionOfGoodService</th> --}}
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
                        {{-- <td class="text-left">{{ $fcyRequest->descriptionOfGoodService }}</td> --}}
                        <td class="!text-center md:table-cell">
                            <x-bladewind::dropmenu>
                                <x-bladewind::dropmenu-item>
                                    <x-bladewind::button size="tiny" type="secondary" icon="arrow-right">
                                        <a href="{{ route('fcy-request.authorizeAllocation', $fcyRequest->id) }}" class="btn btn-secondary">Approve</a>
                                    </x-bladewind::button>
                                </x-bladewind::dropmenu-item>
                                <x-bladewind::dropmenu-item>
                                    <x-bladewind::button size="tiny" type="secondary" icon="trash" color="red">
                                        <a href="{{ route('fcy-request.rejectAllocation', $fcyRequest->id) }}" class="btn btn-warning">Reject</a>
                                    </x-bladewind::button>
                                </x-bladewind::dropmenu-item>

                                {{-- <x-bladewind::dropmenu-item>
                                    <form action="" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <x-bladewind::button size="tiny" color="red" type="secondary"
                                            icon="trash" can-submit="true"
                                            onclick="return confirm('Are you sure you want to delete this case?')">Delete</x-bladewind::button>
                                    </form>
                                </x-bladewind::dropmenu-item> --}}
                            </x-bladewind::dropmenu>
                        </td>
                    </tr>
                @endforeach
            </x-bladewind::table>
        </x-bladewind::card>
    </div>
</x-app-layout>
