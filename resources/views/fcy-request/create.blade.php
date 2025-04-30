<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('') }}
            </h2>
        </div>
    </x-slot>
    @if (session('success'))
        {!! session('success') !!}
    @endif
    @if (session('error'))
        {!! session('error') !!}
    @endif
    <?php
    $incotermList = [['label' => 'Cost and Freight', 'value' => 'CFR'], ['label' => ' Cost Insurance and Freight', 'value' => 'CIF'], ['label' => 'Ex Works', 'value' => 'EXW'], ['label' => 'Free Carrier', 'value' => 'FCA'], ['label' => 'Free Alongside Ship', 'value' => 'FAS'], ['label' => 'Free On Board', 'value' => 'FOB'], ['label' => 'Carriage Paid To', 'value' => 'CPT'], ['label' => 'Carriage and Insurance Paid To', 'value' => 'CIP'], ['label' => 'Delivered at Terminal', 'value' => 'DAT'], ['label' => 'Delivered at Place', 'value' => 'DAP'], ['label' => 'Delivered Duty Paid', 'value' => 'DDP']];
    $currencyList1 = [
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

        <form id="fyr-request-form" class="request-form" action="{{ route('fcy-request.store') }}" method="post"
            enctype="multipart/form-data">


            <h1 class="my-2 text-4xl font-light text-green-900/80"><b>FCY Request</b></h1>
            <p class="mt-3 mb-6 text-green-900/80 text-sm">
                Please Fill the below form to capture new FCY Request Registration.
            </p>
            @csrf
            <x-bladewind::card title="General Details">

                <div class="grid grid-cols-2 gap-4">
                    <x-bladewind::datepicker name="dateOfApplication" required="true" label="Date of Application"
                        error_message="The Field Cannot be empty" show_error_inline="true" />
                    <x-bladewind::input name="applicantName" required="true" label="Applicant Name"
                        error_message="The Field Cannot be empty" />

                </div>
                <div class="grid grid-cols-2 gap-4">
                    <x-bladewind::input name="NBEAccountNumber" required="true" label="NBE Account Number"
                        error_message="The Field Cannot be empty" />
                    <x-bladewind::input name="branchName" required="true" label="Request Branch"
                        error_message="The Field Cannot be empty" />

                </div>
            </x-bladewind::card>
            <x-bladewind::card title="Applicant Address">
                <div class="grid grid-cols-2 gap-4">
                    <x-bladewind::input name="telNumber" required="true" label="Applicant Tel Number"
                        error_message="The Field Cannot be empty" />
                    <x-bladewind::input name="phoneNumber" required="true" label="Applicant Mobile Number"
                        error_message="The Field Cannot be empty" />

                </div>
                <x-bladewind.textarea required="true" name="address" error_message="This Field is required"
                    show_error_inline="true" label="Applicant Full Address"></x-bladewind.textarea>
            </x-bladewind::card>

            <x-bladewind::card title="FCY Request Details">
                <x-bladewind.textarea required="true" name="descriptionOfGoodService"
                    error_message="This Field is required" show_error_inline="true"
                    label="Description of Good / Service"></x-bladewind.textarea>

                <div class="grid grid-cols-2 gap-4">
                    {{-- <x-bladewind::select name="currencyType" :data="$currencyList" label="Currency" required="true"
                        error_message="This Field is required" show_error_inline="true" /> --}}
                    <x-bladewind::select name="currencyType" required="true" :data="$currencyList" label="Currency"
                        error_message="This Field is required" show_error_inline="true" />

                    <x-bladewind::input name="performaAmount" required="true" label="Performa Amount"
                        error_message="The Field Cannot be empty" />

                </div>
                <div class="grid grid-cols-1">
                    <x-bladewind::dropdown name="modeOfPayment" :data="$modeOfPaymentList" placeholder="Mode Of Payment"
                        required="true" error_message="This Field is required" show_error_inline="true" />
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <x-bladewind::input name="sheepmentPlace" required="true" label="Sheepment Place"
                        error_message="The Field Cannot be empty" />
                    <x-bladewind::input name="destinationPlace" required="true" label="Place of Destination"
                        error_message="The Field Cannot be empty" />
                </div>
                <div class="grid grid-cols-1">
                    <x-bladewind::dropdown name="incoterms" :data="$incotermList" placeholder="Incoterms" required="true"
                        error_message="This Field is required" show_error_inline="true" />
                </div>
                <x-bladewind::filepicker name="requestFiles" label="Attachment" multiple="true"
                    error_message="The Field Cannot be empty" />
                <x-bladewind.textarea required="true" name="requestRemarks" error_message="This Field is required"
                    show_error_inline="true" label="Request Remark"></x-bladewind.textarea>
            </x-bladewind::card>

            <div class="text-right">

                <x-bladewind.button id="submit-btn" has_spinner="true" type="secondary" can_submit="true"
                    class="mt-3">
                    Save
                </x-bladewind.button>
            </div>
        </form>

    </x-bladewind.card>
</x-app-layout>
<script>
    // dom_el('.request-form').addEventListener('submit', function(e) {
    //     e.preventDefault();
    //     fcyRequest();
    // });

    // fcyRequest = () => {
    //     (validateForm('.request-form')) ?
    //     unhide('.btn-save .bw-spinner'): // do this is validated
    //         hide('.btn-save .bw-spinner'); // do this if not validated
    // }

    dom_el('.request-form').addEventListener('submit', function(e) {
        e.preventDefault();
        if (fcyRequest()) {
            e.target.submit();
        }
    });

    fcyRequest = () => {
        if (validateForm('.request-form')) {
            unhide('.btn-save .bw-spinner');
            return true;
        } else {
            hide('.btn-save .bw-spinner');
            return false;
        }
    }
</script>
