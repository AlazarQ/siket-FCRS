<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Dashboard') }}
            </h2>

        </div>
    </x-slot>
    <?php
    $labels = ['Red', 'Blue', 'Yellow', 'Green', 'Purple'];
    $data = [12, 19, 13, 15, 9, 10];
    ?>

    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1" width="100%">
        <x-bladewind::card title="" width="50%">

            <div>
                <canvas id="myChart1"></canvas>
            </div>

        </x-bladewind::card>
        <x-bladewind::card width="50%">
            
        <div>
            <canvas id="myChart2"></canvas>
        </div>
        </x-bladewind::card>
    </div><br>
    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        {{-- create some visual metrics that show the FCY Request and Performance using charts tables ... and mock the values --}}
        <x-bladewind::card title="invoice details">

            <x-bladewind.table striped="true">
                <x-slot name="header">
                    <th>Item</th>
                    <th width="10%" class="text-center">Quantity</th>
                    <th width="20%" class="text-right">Price (USD)</th>
                </x-slot>
                <tr>
                    <td>Airpods Max (Black)</td>
                    <td class="text-center">1</td>
                    <td class="text-right">500.00</td>
                </tr>
                ...
            </x-bladewind.table>

        </x-bladewind::card>
        
    </div>
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
