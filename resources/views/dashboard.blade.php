<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{-- {{ __('Dashboard') }} --}}
            </h2>
        </div>
    </x-slot>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-5">
        <x-bladewind::card class="cursor-pointer hover:shadow-gray-300">
            <x-bladewind::statistic number="{{ $totalFcyRequests ?? 0 }}" label="Total FCY Requests">
                <x-slot name="icon">
                    <x-icons.fcyRequest class="h-16 w-16 p-2 text-white rounded-full " aria-hidden="true" />
                </x-slot>
            </x-bladewind::statistic><br>
            <x-bladewind::statistic currency="USD" number="{{ $totalFcyAmount ?? 0 }}" />
        </x-bladewind::card>

        <x-bladewind::card class="cursor-pointer hover:shadow-gray-300">
            <x-bladewind::statistic number="{{ $totalApproved ?? 0 }}" label="Total Approved">
                <x-slot name="icon">
                    <x-icons.approved class="h-16 w-16 p-2 text-white rounded-full" aria-hidden="true" />
                </x-slot>
            </x-bladewind::statistic><br>
            {{-- <x-bladewind::statistic currency="USD" number="{{ $approvedAmount ?? 0 }}" /> --}}
            @foreach ($approvedAmount as $approved)
                <x-bladewind::statistic currency="{{ $approved->currencyType }}"
                    number="{{ number_format($approved->total_amount, 2) }}" />
            @endforeach
        </x-bladewind::card>
    </div><br>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-5">
        
        <x-bladewind::card class="cursor-pointer hover:shadow-gray-300">
            <x-bladewind::statistic number="{{ $totalRejected ?? 0 }}" label="Total Rejected - Application">
                <x-slot name="icon">
                    <x-icons.rejected class="h-16 w-16 p-2 text-white rounded-full" aria-hidden="true" />
                </x-slot>
            </x-bladewind::statistic><br>
            @foreach ($rejectedAmount as $rejected)
                <x-bladewind::statistic currency="{{ $rejected->currencyType }}"
                    number="{{ number_format($rejected->total_amount, 2) }}" />
            @endforeach
            {{-- <x-bladewind::statistic currency="USD" number="{{ $rejectedAmount ?? 0 }}" /> --}}
        </x-bladewind::card>

        <x-bladewind::card class="cursor-pointer hover:shadow-gray-300">
            <x-bladewind::statistic number="{{ $totalRejectedReg ?? 0 }}" label="Total Rejected - Registration">
                <x-slot name="icon">
                    <x-icons.rejected2 class="h-16 w-16 p-2 text-white rounded-full" aria-hidden="true" />
                </x-slot>
            </x-bladewind::statistic><br>
            @foreach ($rejectedAmountReg as $rejected)
                <x-bladewind::statistic currency="{{ $rejected->currencyType }}"
                    number="{{ number_format($rejected->total_amount, 2) }}" />
            @endforeach
        </x-bladewind::card>
    </div>
    <br>
    <div class="grid grid-cols-1 sm:grid-cols-1 lg:grid-cols-1 gap-5">

        <x-bladewind.card title="FCY Request - Status">

            <x-bladewind::horizontal-line-graph label="Approved: " percentage="{{ $totalPercentApproved }}"
                color="green" class="py-3" />

            <x-bladewind::horizontal-line-graph label="Rejected Application: " percentage="{{ $totalpercentRejected }}"
                color="Yellow" />

            <x-bladewind::horizontal-line-graph label="Rejected Registration: "
                percentage="{{ $totalpercentRejectedReg }}" color="red" />

        </x-bladewind.card>



    </div><br>

    <div class="grid grid-cols-1 sm:grid-cols-1 lg:grid-cols-2 gap-5">

        <x-bladewind::card title="" width="100%">
            <div>
                <canvas id="myChart1"></canvas>
            </div>
        </x-bladewind::card>
        <x-bladewind::card title="" width="100%">
            <div>
                <canvas id="myChart2"></canvas>
            </div>
        </x-bladewind::card>
    </div>
    <br>
</x-app-layout>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx1 = document.getElementById('myChart1');

    new Chart(ctx1, {
        type: 'bar',
        data: {
            labels: @json($labels), // Dynamically pass labels
            datasets: [{
                label: '# of Fcy Requests',
                data: @json($data), // Dynamically pass data
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    const ctx2 = document.getElementById('myChart2');

    new Chart(ctx2, {
        type: 'doughnut',
        data: {
            labels: @json($labels),
            datasets: [{
                label: '# of Fcy Requests',
                data: @json($data),
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
