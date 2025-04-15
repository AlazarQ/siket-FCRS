<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                
            </h2>
        </div>
    </x-slot>
    <x-bladewind.notification />

    <x-bladewind.card>

        <form id="users-edit-form" class="users-form" action="{{ route('users.resetUserPasswordStore', $user) }}" method="post"
            enctype="multipart/form-data">
            @csrf
            @method('patch')

            <h1 class="my-2 text-4xl font-light text-green-900/80"><b>Password Reset</b></h1>
            <p class="mt-3 mb-6 text-green-900/80 text-sm">
                User Password Reset Form. Please fill the password section to reset.
            </p>

            <x-bladewind::input name="name" required="true" label="User Full Name" value="{{ $user->name }}"
                readonly="true" />

            <x-bladewind::input type="password" name="password" required="true" label="User Password" viewable="true"
                error_message="Please Fill the password" />

            <x-bladewind.textarea required="true" name="remark" error_message="Write remark" show_error_inline="true"
                label="Remark" selected_value="{{ $user->remark }}"></x-bladewind.textarea>

            <div class="text-right">
                <x-bladewind.button id="submit-btn" has_spinner="true" type="secondary" can_submit="true"
                    class="mt-3">
                    Reset Password
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
