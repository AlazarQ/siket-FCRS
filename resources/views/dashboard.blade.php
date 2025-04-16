<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{-- {{ __('Dashboard') }} --}}
            </h2>

        </div>
    </x-slot>
    <?php
    $labels = ['Red', 'Blue', 'Yellow', 'Green', 'Purple'];
    $data = [12, 19, 13, 15, 9, 10];
    ?>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
        <x-bladewind::card class="cursor-pointer hover:shadow-gray-300">
            <x-bladewind::statistic number="34" label="Total FCY Requests">
                <x-slot name="icon">
                    <x-icons.fcyRequest class="h-16 w-16 p-2 text-white rounded-full " aria-hidden="true" />
                </x-slot>

            </x-bladewind::statistic>
            <x-bladewind::statistic currency="USD" number="500,100" />
        </x-bladewind::card>

        <x-bladewind::card class="cursor-pointer hover:shadow-gray-300">
            <x-bladewind::statistic number="30" label="Total Approved">
                <x-slot name="icon">
                    <x-icons.approved class="h-16 w-16 p-2 text-white rounded-full" aria-hidden="true" />
                </x-slot>
            </x-bladewind::statistic>
            <x-bladewind::statistic currency="USD" number="400,000" />
        </x-bladewind::card>

        <x-bladewind::card class="cursor-pointer hover:shadow-gray-300">
            <x-bladewind::statistic number="4" label="Total Rejected">
                <x-slot name="icon">
                    <x-icons.rejected class="h-16 w-16 p-2 text-white rounded-full" aria-hidden="true" />

                </x-slot>
            </x-bladewind::statistic>
            <x-bladewind::statistic currency="USD" number="100,100" />
        </x-bladewind::card>
    </div><br>
    <div class="grid grid-cols-1 sm:grid-cols-1 lg:grid-cols-2 gap-5">

        <x-bladewind.card title="FCY Request - Status">

            <x-bladewind::horizontal-line-graph label="ALL: " percentage="55" color="yellow" />

            <x-bladewind::horizontal-line-graph label="Approved: " percentage="30" color="red" class="py-3" />

            <x-bladewind::horizontal-line-graph label="Rejected: " percentage="15" color="blue" />

        </x-bladewind.card>

        <x-bladewind.card title="Dummy Graph">

            <x-bladewind::horizontal-line-graph label="Siket Bank 1: " percentage="33" color="cyan" />

            <x-bladewind::horizontal-line-graph label="Siket Bank 2: " percentage="43" color="purple" class="py-3" />

            <x-bladewind::horizontal-line-graph label="Siket Bank 3: " percentage="24" color="gray" />

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
            labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
            datasets: [{
                label: '# of Votes',
                data: [12, 19, 3, 5, 2, 3],
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
            labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
            datasets: [{
                label: '# of Votes',
                data: [12, 19, 3, 5, 2, 3],
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
