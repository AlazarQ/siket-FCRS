<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{-- {{ __('Edit User') }} --}}
            </h2>
        </div>
    </x-slot>
    <x-bladewind.notification />

    <x-bladewind.card>

        <form id="users-edit-form" class="users-form" action="{{ route('users.update', $user) }}" method="post"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <h1 class="my-2 text-4xl font-light text-green-900/80"><b>Edit User</b></h1>
            <p class="mt-3 mb-6 text-green-900/80 text-sm">
                Please update the below form to edit User details.
            </p>

            <x-bladewind::input name="name" required="true" label="User Full Name" value="{{ $user->name }}"
                error_message="Please Enter User Full Name" />
            <div class="flex gap-4">
                <x-bladewind::input type="email" name="email" required="true" label="User Email" value="{{ $user->email }}"
                    error_message="Please Enter users email address" />

                <x-bladewind::input name="userName" required="true" label="User Name" numeric="false" value="{{ $user->userName }}"
                    error_message="Please Enter users name" />
            </div>

            <div class="grid grid-cols-2 gap-4">
                <x-bladewind::select name="userBranch" required="true" :data="$branchs" label="Branch District" selected_value="{{ $user->userBranch }}" />
                <x-bladewind::select name="userDistrict" required="true" :data="$districts" label="User District" selected_value="{{ $user->userDistrict }}" />
            </div>

            <div class="flex gap-4">
                <x-bladewind::radio-button label="Male" name="userGender" value="M" checked="{{ $user->userGender == 'M' }}" />
                <x-bladewind::radio-button label="Female" name="userGender" value="F" checked="{{ $user->userGender == 'F' }}" />
            </div>

            <div class="flex gap-4">
                <x-bladewind::input name="userPhone" required="true" label="User Phone" prefix="+251" max="9" value="{{ $user->userPhone }}"
                    error_message="The Field Cannot be empty" show_error_inline="true" />

                <x-bladewind::input name="userStatus" required="false" label="User Status" value="{{ $user->userStatus }}"
                    error_message="The Field Cannot be empty" readonly="true" show_error_inline="true" />
            </div>

            <x-bladewind.textarea required="true" name="remark" error_message="Write remark" show_error_inline="true"
                label="Remark" selected_value="{{ $user->remark }}"></x-bladewind.textarea>

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
    dom_el('.users-form').addEventListener('submit', function(e) {
        e.preventDefault();
        if (usersEdit()) {
            e.target.submit();
        }
    });

    usersEdit = () => {
        if (validateForm('.users-form')) {
            unhide('.btn-save .bw-spinner');
            return true;
        } else {
            hide('.btn-save .bw-spinner');
            return false;
        }
    }
</script>
