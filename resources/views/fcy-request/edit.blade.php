<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('') }}
            </h2>
        </div>
    </x-slot>
    {{-- @if (session('success'))
        {!! session('success') !!}

    @endif
    @if (session('error'))
        {!! session('error') !!}
    @endif --}}
    <?php
    $incotermList = [['label' => 'Cost and Freight', 'value' => 'CFR'], ['label' => ' Cost Insurance and Freight', 'value' => 'CIF'], ['label' => 'Ex Works', 'value' => 'EXW'], ['label' => 'Free Carrier', 'value' => 'FCA'], ['label' => 'Free Alongside Ship', 'value' => 'FAS'], ['label' => 'Free On Board', 'value' => 'FOB'], ['label' => 'Carriage Paid To', 'value' => 'CPT'], ['label' => 'Carriage and Insurance Paid To', 'value' => 'CIP'], ['label' => 'Delivered at Terminal', 'value' => 'DAT'], ['label' => 'Delivered at Place', 'value' => 'DAP'], ['label' => 'Delivered Duty Paid', 'value' => 'DDP']];
    $currencyList = [
        ['label' => 'US Dollar', 'value' => 'USD'],
        ['label' => 'Euro', 'value' => 'EUR'],
        ['label' => 'British pound', 'value' => 'GBP'],
        ['label' => 'Japanese yen', 'value' => 'JPY'],
        ['label' => 'Renminbi', 'value' => 'CNY'],
        ['label' => 'Indian rupee', 'value' => 'INR'],
        ['label' => 'Australian dollar', 'value' => 'AUD'],
        ['label' => 'Canadian dollar', 'value' => 'CAD'],
        ['label' => 'Swiss franc', 'value' => 'CHF'],
        ['label' => 'Hong Kong dollar', 'value' => 'HKD'],
        ['label' => 'Singapore dollar', 'value' => 'SGD'],
        ['label' => 'New Zealand dollar', 'value' => 'NZD'],
        ['label' => 'South Korean won', 'value' => 'KRW'],
        ['label' => 'Brazilian real', 'value' => 'BRL'],
        ['label' => 'Mexican peso', 'value' => 'MXN'],
        ['label' => 'South African rand', 'value' => 'ZAR'],
        ['label' => 'Turkish lira', 'value' => 'TRY'],
        ['label' => 'Russian ruble', 'value' => 'RUB'],
        ['label' => 'Saudi riyal', 'value' => 'SAR'],
        ['label' => 'United Arab Emirates dirham', 'value' => 'AED'],
        ['label' => 'Indonesian rupiah', 'value' => 'IDR'],
        ['label' => 'Thai baht', 'value' => 'THB'],
    ];
    $modeOfPaymentList = [['label' => 'Cash-in-Advance', 'value' => 'CAD'], ['label' => 'Letters of Credit', 'value' => 'LC'], ['label' => 'Documentary Collections', 'value' => 'DC'], ['label' => 'Open Account', 'value' => 'OA'], ['label' => 'Consignment', 'value' => 'CO']];
    ?>
    <x-bladewind.notification />
    <x-bladewind.card>

        <form id="fcy-request-form" class="request-form-update" action="{{ route('fcy-request.update', $fCY_Request) }}"
            method="post" enctype="multipart/form-data">


            <h1 class="my-2 text-4xl font-light text-green-900/80"><b>Update FCY Request</b></h1>
            <p class="mt-3 mb-6 text-green-900/80 text-sm">
                Please edit the below form to update existing FCY Request Registration.
            </p>
            @csrf
            @method('PUT')
            <x-bladewind::card title="General Details">

                <div class="grid grid-cols-2 gap-4">
                    <x-bladewind::datepicker name="dateOfApplication" required="true" label="Date of Application"
                        default_date="{{ $fCY_Request->dateOfApplication ?? '' }}"
                        error_message="The Field Cannot be empty" show_error_inline="true" />
                    <x-bladewind::input name="applicantName" required="true" label="Applicant Name"
                        value="{{ $fCY_Request->applicantName ?? '' }}" error_message="The Field Cannot be empty" />

                </div>
                <div class="grid grid-cols-2 gap-4">
                    <x-bladewind::input name="NBEAccountNumber" required="true" label="NBE Account Number"
                        value="{{ $fCY_Request->NBEAccountNumber ?? '' }}" error_message="The Field Cannot be empty" />

                    <x-bladewind::select name="branchName" required="true" :data="$branchs" label="Request Branch"
                        selected_value="{{ $fCY_Request->branchName ?? '' }}" />

                </div>
            </x-bladewind::card>
            <x-bladewind::card title="Applicant Address">
                <div class="grid grid-cols-2 gap-4">
                    <x-bladewind::input name="telNumber" required="true" label="Applicant Tel Number"
                        value="{{ $fCY_Request->telNumber ?? '' }}" error_message="The Field Cannot be empty" />
                    <x-bladewind::input name="phoneNumber" required="true" label="Applicant Mobile Number"
                        value="{{ $fCY_Request->phoneNumber ?? '' }}" error_message="The Field Cannot be empty" />

                </div>
                <x-bladewind.textarea required="true" name="address" error_message="This Field is required"
                    selected_value="{{ $fCY_Request->address ?? '' }}" show_error_inline="true"
                    label="Applicant Full Address"></x-bladewind.textarea>
            </x-bladewind::card>

            <x-bladewind::card title="FCY Request Details">
                <div class="grid grid-cols-2 gap-4">

                    <x-bladewind::input name="tinNumber" required="true" label="TIN Number"
                    value="{{ $fCY_Request->tinNumber ?? '' }}"
                        error_message="This Field is required" show_error_inline="true" />

                    <x-bladewind::input name="performaInvoiceNumber" required="true" label="Performa Invoice Number"
                    value="{{ $fCY_Request->performaInvoiceNumber ?? '' }}"
                        error_message="The Field Cannot be empty" />

                </div>

                <div class="grid grid-cols-2 gap-4">

                    <x-bladewind::input name="itemName" required="true" label="Item Name"
                        value="{{ $fCY_Request->itemName ?? '' }}" error_message="This Field is required"
                        show_error_inline="true" />

                    <x-bladewind::input name="itemQuantity" required="true" label="Item Quantity"
                        value="{{ $fCY_Request->itemQuantity ?? '' }}" error_message="The Field Cannot be empty" />

                </div>
                <div class="grid grid-cols-2 gap-4">
                    <x-bladewind::input name="itemHSCode" required="true" label="Item HS Code"
                        error_message="The Field Cannot be empty" value="{{ $fCY_Request->itemHSCode ?? '' }}" />

                    <x-bladewind.textarea required="true" name="descriptionOfGoodService"
                        selected_value="{{ $fCY_Request->descriptionOfGoodService ?? '' }}"
                        error_message="This Field is required" show_error_inline="true"
                        label="Description of Good / Service"></x-bladewind.textarea>

                </div>


                <div class="grid grid-cols-2 gap-4">
                    <x-bladewind::dropdown name="currencyType" :data="$currencyList" placeholder="Currency" required="true"
                        selected_value="{{ $fCY_Request->currencyType ?? '' }}" error_message="This Field is required"
                        show_error_inline="true" />
                </div>

                <div class="grid grid-cols-2 gap-4">

                    <x-bladewind::input name="performaAmount" required="true" label="Performa Amount"
                        value="{{ $fCY_Request->performaAmount ?? '' }}" error_message="The Field Cannot be empty" />

                    <x-bladewind::datepicker name="performaDate" required="true" label="Performa Amount"
                        default_date="{{ $fCY_Request->performaDate ?? '' }}"
                        error_message="The Field Cannot be empty" />

                </div>
                <div class="grid grid-cols-1">
                    <x-bladewind::dropdown name="modeOfPayment" :data="$modeOfPaymentList" placeholder="Mode Of Payment"
                        selected_value="{{ $fCY_Request->modeOfPayment ?? '' }}" required="true"
                        error_message="This Field is required" show_error_inline="true" />
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <x-bladewind::input name="shipmentPlace" required="true" label="Shipment Place"
                        value="{{ $fCY_Request->shipmentPlace ?? '' }}" error_message="The Field Cannot be empty" />
                    <x-bladewind::input name="destinationPlace" required="true" label="Place of Destination"
                        value="{{ $fCY_Request->destinationPlace ?? '' }}"
                        error_message="The Field Cannot be empty" />
                </div>
                <div class="grid grid-cols-1">
                    <x-bladewind::dropdown name="incoterms" :data="$incotermList" placeholder="Incoterms" required="true"
                        selected_value="{{ $fCY_Request->incoterms ?? '' }}" error_message="This Field is required"
                        show_error_inline="true" />
                </div>
                {{-- <x-bladewind::filepicker name="requestFiles" label="Attachment" multiple="true"

                    error_message="The Field Cannot be empty" /> --}}

                <div class="flex items-center gap-4">
                    <div class="flex-1">
                        <x-bladewind::filepicker name="requestFiles" placeholder="Request File (PDF)"
                            max_file_size="3" accepted_file_types=".pdf"
                            value="{{ $fCY_Request->requestFiles ?? '' }}" />
                    </div>
                    @if ($fCY_Request->requestFiles)
                        <div class="flex-shrink-0 mt-1">
                            <x-bladewind::button type="secondary" size="tiny" class="inline-flex items-center">
                                <a href="{{ asset('storage/' . $fCY_Request->requestFiles) ?? '' }}" target="_blank"
                                    class="inline-block w-full h-full">
                                    View Request File
                                </a>
                            </x-bladewind::button>
                        </div>
                    @endif
                </div>
                <x-bladewind.textarea required="true" name="requestRemarks" error_message="This Field is required"
                    selected_value="{{ $fCY_Request->requestRemarks ?? '' }}" show_error_inline="true"
                    label="Request Remark"></x-bladewind.textarea>
            </x-bladewind::card>

            <div class="text-right">

                <x-bladewind.button id="submit-btn" has_spinner="true" type="secondary" can_submit="true"
                    class="mt-3">
                    Update
                </x-bladewind.button>
            </div>
        </form>

    </x-bladewind.card>
</x-app-layout>
<script>
    dom_el('.request-form-update').addEventListener('submit', function(e) {
        e.preventDefault();
        if (fcyRequest()) {
            e.target.submit();
        }
    });

    fcyRequest = () => {
        if (validateForm('.request-form-update')) {
            unhide('.btn-save .bw-spinner');
            return true;
        } else {
            hide('.btn-save .bw-spinner');
            return false;
        }
    }
</script>
