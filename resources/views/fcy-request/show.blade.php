<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('') }}
            </h2>
        </div>
    </x-slot>

    <x-bladewind.notification />
    @if (session('success'))
        {!! session('success') !!}
    @endif

    @if (session('error'))
        {!! session('error') !!}
    @endif
    <x-bladewind.card>

        <form id="fcy-request-form" class="request-form-update"
            action="{{ route('fcy-request.authorizeAllocation', $fCY_Request) }}" method=""
            enctype="multipart/form-data">


            <h1 class="my-2 text-4xl font-light text-green-900/80"><b>View FCY Request - Allocation</b></h1>
            <p class="mt-3 mb-6 text-green-900/80 text-sm">
                Approve FCY Request based on the details (Request Allocation).
            </p>
            @csrf
            {{-- @method('PUT') --}}
            <x-bladewind::card title="General Details">
                <x-bladewind::input name="idReference" readonly="true" label="Id Reference"
                    value="{{ $fCY_Request->idReference ?? '' }}" />

                <div class="grid grid-cols-2 gap-4">
                    <x-bladewind::input name="dateOfApplication" readonly="true" label="Date of Application"
                        value="{{ $fCY_Request->dateOfApplication ?? '' }}" />
                    <x-bladewind::input name="applicantName" readonly="true" label="Applicant Name"
                        value="{{ $fCY_Request->applicantName ?? '' }}" />

                </div>
                <div class="grid grid-cols-2 gap-4">
                    <x-bladewind::input name="NBEAccountNumber" readonly="true" label="NBE Account Number"
                        value="{{ $fCY_Request->NBEAccountNumber ?? '' }}" />
                    <x-bladewind::input name="branchName" readonly="true" label="Request Branch"
                        value="{{ $fCY_Request->branchName ?? '' }}" />

                </div>
            </x-bladewind::card>
            <x-bladewind::card title="Applicant Address">
                <div class="grid grid-cols-2 gap-4">
                    <x-bladewind::input name="telNumber" readonly="true" label="Applicant Tel Number"
                        value="{{ $fCY_Request->telNumber ?? '' }}" />
                    <x-bladewind::input name="phoneNumber" readonly="true" label="Applicant Mobile Number"
                        value="{{ $fCY_Request->phoneNumber ?? '' }}" />

                </div>
                <x-bladewind.textarea readonly="true" name="address" error_message="This Field is required"
                    selected_value="{{ $fCY_Request->address ?? '' }}" show_error_inline="true"
                    label="Applicant Full Address"></x-bladewind.textarea>
            </x-bladewind::card>

            <x-bladewind::card title="FCY Request Details">
                <div class="grid grid-cols-2 gap-4">

                    <x-bladewind::input name="tinNumber" readonly="true" label="TIN Number"
                        value="{{ $fCY_Request->tinNumber ?? '' }}" error_message="This Field is required"
                        show_error_inline="true" />

                    <x-bladewind::input name="performaInvoiceNumber" readonly="true" label="Performa Invoice Number"
                        value="{{ $fCY_Request->performaInvoiceNumber ?? '' }}" />

                </div>

                <div class="grid grid-cols-2 gap-4">

                    <x-bladewind::input name="itemName" readonly="true" label="Item Name"
                        value="{{ $fCY_Request->itemName ?? '' }}" error_message="This Field is required"
                        show_error_inline="true" />

                    <x-bladewind::input name="itemQuantity" readonly="true" label="Item Quantity"
                        value="{{ $fCY_Request->itemQuantity ?? '' }}" />

                </div>
                <div class="grid grid-cols-2 gap-4">
                    <x-bladewind::input name="itemHSCode" readonly="true" label="Item HS Code"
                        value="{{ $fCY_Request->itemHSCode ?? '' }}" />

                    <x-bladewind.textarea readonly="true" name="descriptionOfGoodService"
                        selected_value="{{ $fCY_Request->descriptionOfGoodService ?? '' }}"
                        label="Description of Good / Service"></x-bladewind.textarea>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <x-bladewind::select name="currencyType" :data="$currencyList" placeholder="Currency" readonly="true"
                        selected_value="{{ $fCY_Request->currencyType ?? '' }}" error_message="This Field is required"
                        show_error_inline="true" />
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <x-bladewind::input name="performaAmount" readonly="true" label="Performa Amount"
                        value="{{ $fCY_Request->performaAmount ?? '' }}" />

                    <x-bladewind::input name="performaDate" readonly="true" label="Performa Date"
                        value="{{ $fCY_Request->performaDate ?? '' }}" />

                </div>
                <div class="grid grid-cols-1">
                    <x-bladewind::select name="modeOfPayment" :data="$modeOfPaymentsList" placeholder="Mode Of Payment"
                        selected_value="{{ $fCY_Request->modeOfPayment ?? '' }}" readonly="true" />
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <x-bladewind::input name="shipmentPlace" readonly="true" label="Shipment Place"
                        value="{{ $fCY_Request->shipmentPlace ?? '' }}" />
                    <x-bladewind::input name="destinationPlace" readonly="true" label="Place of Destination"
                        value="{{ $fCY_Request->destinationPlace ?? '' }}" />
                </div>
                <div class="grid grid-cols-1">
                    <x-bladewind::select name="incoterms" :data="$incotermsList" placeholder="Incoterms" readonly="true"
                        selected_value="{{ $fCY_Request->incoterms ?? '' }}" />
                </div>


                <div class="flex items-center gap-4">

                    @if ($fCY_Request->requestFiles)
                        <div class="flex-shrink-0 mt-1">
                            <x-bladewind::button type="secondary" size="tiny" class="inline-flex items-center">
                                <a href="{{ asset('storage/' . $fCY_Request->requestFiles) ?? '' }}" target="_blank"
                                    class="inline-block w-full h-full">
                                    View uploaded Request File
                                </a>
                            </x-bladewind::button>
                        </div>
                    @endif
                </div><br>
                <x-bladewind.textarea readonly="true" name="requestRemarks" error_message="This Field is required"
                    selected_value="{{ $fCY_Request->requestRemarks ?? '' }}"
                    label="Request Remark"></x-bladewind.textarea>
            </x-bladewind::card>
            <div class="text-right">

                <x-bladewind.button id="submit-btn" has_spinner="true" color="blue" can_submit="true"
                    icon="arrow-left" class="mt-3">
                    <a href="{{ route('fcy-request.listAuthorizedRequests') }}" class="btn btn-secondary" />
                    Back
                </x-bladewind.button>
            </div>
        </form>

    </x-bladewind.card>
</x-app-layout>
