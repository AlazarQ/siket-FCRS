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
                <x-bladewind::input name="idReference" required="true" readonly="true" label="Record Id"
                    error_message="The Field Cannot be empty - Please Contact System Administrator"
                    show_error_inline="true" value="{{ $idReference ?? '' }}" />

                <div class="grid grid-cols-2 gap-4">
                    <x-bladewind::datepicker name="dateOfApplication" required="true" label="Date of Application"
                        error_message="The Field Cannot be empty" show_error_inline="true" />
                    <x-bladewind::input name="applicantName" required="true" label="Applicant Name"
                        error_message="The Field Cannot be empty" />

                </div>
                <div class="grid grid-cols-2 gap-4">
                    <x-bladewind::input name="NBEAccountNumber" required="true" label="NBE Account Number"
                        error_message="The Field Cannot be empty" />

                    <x-bladewind::select name="branchName" required="true" :data="$branchs" label="Request Branch" />
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

                <div class="grid grid-cols-2 gap-4">

                    <x-bladewind::input name="tinNumber" required="true" label="TIN Number"
                        error_message="This Field is required" show_error_inline="true" />

                    <x-bladewind::input name="performaInvoiceNumber" required="true" label="Performa Invoice Number"
                        error_message="The Field Cannot be empty" />

                </div>

                <div class="grid grid-cols-2 gap-4">

                    <x-bladewind::input name="itemName" required="true"  label="Item Name"
                        error_message="This Field is required" show_error_inline="true" />

                    <x-bladewind::input name="itemQuantity" required="true" label="Item Quantity"
                        error_message="The Field Cannot be empty" />

                </div>
                <div class="grid grid-cols-2 gap-4">
                    <x-bladewind::input name="itemHSCode" required="true" label="Item HS Code"
                        error_message="The Field Cannot be empty" />

                    <x-bladewind.textarea required="true" name="descriptionOfGoodService"
                        error_message="This Field is required" show_error_inline="true"
                        label="Description of Good / Service"></x-bladewind.textarea>

                </div>

                <div class="grid grid-cols-2 gap-4">

                    <x-bladewind::select name="currencyType" required="true" :data="$currencyList" label="Currency"
                        error_message="This Field is required" show_error_inline="true" />

                </div>
                <div class="grid grid-cols-2 gap-4">

                    <x-bladewind::input name="performaAmount" required="true" label="Performa Amount"
                        error_message="The Field Cannot be empty" />

                    <x-bladewind::datepicker name="performaDate" required="true" label="Performa Date"
                        error_message="The Field Cannot be empty" />

                </div>
                <div class="grid grid-cols-1">

                    <x-bladewind::select name="modeOfPayment" required="true" :data="$modeOfPaymentsList"
                        label="Mode of Payments" error_message="This Field is required" show_error_inline="true" />

                </div>
                <div class="grid grid-cols-2 gap-4">
                    <x-bladewind::input name="shipmentPlace" required="true" label="Shipment Place"
                        error_message="The Field Cannot be empty" />
                    <x-bladewind::input name="destinationPlace" required="true" label="Place of Destination"
                        error_message="The Field Cannot be empty" />
                </div>
                <div class="grid grid-cols-1">
                    <x-bladewind::select name="incoterms" required="true" :data="$incotermsList" label="Incoterms"
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
