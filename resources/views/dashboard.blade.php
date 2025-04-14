<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Dashboard') }}
            </h2>

        </div>
    </x-slot>

    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
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
