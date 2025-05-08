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
    $status = [['label' => 'Active', 'value' => 'ACTIVE'], ['label' => 'In-Active', 'value' => 'DISABLED']];
    ?>
    <x-bladewind.notification />
    <x-bladewind.card>

        <form id="incoterms-form" class="request-form" action="{{ route('settings.modeOfPayments.update', $modeOfPayments) }}"
            method="POST" enctype="multipart/form-data">


            <h1 class="my-2 text-4xl font-light text-green-900/80"><b>Mode of Payments</b></h1>
            <p class="mt-3 mb-6 text-green-900/80 text-sm">
                Edit Mode of Payment - Status and Description!!
            </p>
            @csrf
            @method('PATCH')

            <div class="grid grid-cols-2 gap-4">
                <x-bladewind::input name="shortCode" label="Short Code" value="{{ $modeOfPayments->shortCode ?? '' }}" max="4" readonly="true" />
                <x-bladewind::dropdown name="status" :data="$status" placeholder="Status" required="true"
                    error_message="This Field is required" show_error_inline="true"
                    selected_value="{{ $modeOfPayments->status ?? '' }}" />

            </div>
            <x-bladewind.textarea required="true" name="description" error_message="This Field is required"
                show_error_inline="true" label="Description"
                selected_value="{{ $modeOfPayments->description ?? '' }}"></x-bladewind.textarea>



            <div class="text-right">

                <x-bladewind.button id="submit-btn" has_spinner="true" type="secondary" can_submit="true"
                    class="mt-3">
                    Save
                </x-bladewind.button>
            </div>
        </form>

    </x-bladewind.card>
</x-app-layout>

