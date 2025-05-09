<x-app-layout>
    <x-slot name="header">

    </x-slot>
    <x-bladewind.notification />
    <div class="container mx-auto p-4">

        <x-bladewind::card reduce_padding="true">
            <h1 class="my-2 text-4xl font-light text-green-900/80"><b>User Audit</b></h1>
            <p class="mt-3 mb-6 text-green-900/80 text-sm">
                List Of User Actions.
            </p>
            <div class="flex justify-end gap-4 mb-4">
                <form method="GET" action="{{ route('audit.index') }}" class="mb-4">
                    <div class="flex items-center gap-4">
                        <div class="flex-1">
                            <x-bladewind::input name="user_id" required="true" label="Filter By User Id"
                                value="{{ $userId }}" error_message="The Field Cannot be empty" />
                        </div>
                        <div class="flex-shrink-0 mt-1">
                            <x-bladewind.button id="submit-btn" has_spinner="true" type="secondary" can_submit="true"
                                class="mt-3">
                                Filter
                            </x-bladewind.button>
                        </div>
                    </div>

                </form>
            </div>

            <!-- Filter Form -->


            <!-- Audit Table -->
            <div class="overflow-x-auto">
                <x-bladewind::table selectable="flase" divider="thin" name="branch_list" searchable="true"
                    celled="false" paginated="true" page_size="5" show_row_numbers="true" default_page="1"
                    no_data_message="Audit log is empty !!!" message_as_empty_state="true">
                    <x-slot:header>
                        <td class="border px-4 py-2">Rec ID</td>
                        <td class="border px-4 py-2">User ID</td>
                        <td class="border px-4 py-2">Event</td>
                        <td class="border px-4 py-2">Table</td>
                        <td class="border px-4 py-2">Old Values</td>
                        <td class="border px-4 py-2">New Values</td>
                        <td class="border px-4 py-2">Ip Address</td>
                        <td class="border px-4 py-2">Timestamp</td>
                    </x-slot:header>

                    @foreach ($audits as $audit)
                        <tr>
                            <td class="border px-4 py-2">{{ $audit->id }}</td>
                            <td class="border px-4 py-2">{{ $audit->user_id }}</td>
                            <td class="border px-4 py-2">{{ $audit->event }}</td>
                            <td class="border px-4 py-2">{{ $audit->auditable_type }}</td>

                            <!-- Old Values with Modal Trigger -->
                            <td class="border px-4 py-2 max-w-[200px] truncate cursor-pointer">
                                <div onclick="showModal('modal_old_{{ $audit->id }}')">
                                    {{ Str::limit($audit->old_values, 30, '...') }}
                                </div>
                                <x-bladewind::modal name="modal_old_{{ $audit->id }}" title="Old Values"
                                    size="xl" show_close_icon="true">
                                    <div class="p-4 text-sm">
                                        <pre class="whitespace-pre-wrap overflow-y-auto" style="max-height: 300px;">
                    {{ json_encode(json_decode($audit->old_values), JSON_PRETTY_PRINT) }}
                </pre>
                                    </div>
                                </x-bladewind::modal>
                            </td>

                            <!-- New Values with Modal Trigger -->
                            <td class="border px-4 py-2 max-w-[200px] truncate cursor-pointer">
                                <div onclick="showModal('modal_new_{{ $audit->id }}')">
                                    {{ Str::limit($audit->new_values, 30, '...') }}
                                </div>
                                <x-bladewind::modal name="modal_new_{{ $audit->id }}" title="New Values"
                                    size="xl" show_close_icon="true">
                                    <div class="p-4 text-sm">
                                        <pre class="whitespace-pre-wrap overflow-y-auto" style="max-height: 300px;">
                    {{ json_encode(json_decode($audit->new_values), JSON_PRETTY_PRINT) }}
                </pre>
                                    </div>
                                </x-bladewind::modal>
                            </td>

                            <td class="border px-4 py-2">{{ $audit->ip_address }}</td>
                            <td class="border px-4 py-2">{{ $audit->created_at }}</td>
                        </tr>
                    @endforeach
                </x-bladewind::table>
            </div>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $audits->links() }}
            </div>
        </x-bladewind::card>
    </div>
</x-app-layout>
