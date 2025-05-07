<x-app-layout>
    <x-slot name="header">

    </x-slot>
    <x-bladewind.notification />

    @if (session('success'))
        {!! session('success') !!}
    @endif

    @if (session('error'))
        {!! session('error') !!}
    @endif
    <?php
    $roles = [
        ['label' => 'Admin', 'value' => 'ADMIN'], 
        ['label' => 'Excutive Secretery', 'value' => 'MAKER'], 
        ['label' => 'Verifier', 'value' => 'OFFICER'], 
        ['label' => 'Authorizer', 'value' => 'MANAGER'],
    ];
    ?>

    <x-bladewind.card>

        <form id="users-registration-form" class="users-form" action="{{ route('users.store') }}" method="post"
            enctype="multipart/form-data">
            <h1 class="my-2 text-4xl font-light text-green-900/80"><b>Register New User</b></h1>
            <p class="mt-3 mb-6 text-green-900/80 text-sm">
                Please fill the below form to capture new User details.
            </p>
            @csrf

            <x-bladewind::input name="name" required="true" label="User Full Name"
                error_message="Please Enter User Full Name" />
            <div class="flex gap-4">
                <x-bladewind::input type="email" name="email" required="true" label="User Email"
                    error_message="Please Enter users email address" />

                <x-bladewind::input name="userName" required="true" label="User Name" numeric="false"
                    error_message="Please Enter users name" />
            </div>
            <div class="grid grid-cols-2 gap-4">
                <x-bladewind::input type="password" name="password" required="true" label="Password" viewable="true"
                    clearable="false" value="123456" readonly="true" />
                <x-bladewind::select name="userRole" required="true" :data="$roles" label="User Role" />
            </div>

            <div class="grid grid-cols-2 gap-4">
                <x-bladewind::select name="userDistrict" required="true" :data="$districts" label="User District" />
                <x-bladewind::select name="userBranch" required="true" :data="$branchs" label="Branch Branch" />
            </div>

            <div class="flex gap-4">
                <x-bladewind::radio-button label="Male" name="userGender" value="M" />
                <x-bladewind::radio-button label="Female" name="userGender" value="F" />
            </div>

            <div class="flex gap-4">
                <x-bladewind::input name="userPhone" required="true" label="User Phone" prefix="+251" max="9"
                    error_message="The Field Cannot be empty" show_error_inline="true" />

                <x-bladewind::input name="userStatus" required="false" label="User Status"
                    error_message="The Field Cannot be empty" show_error_inline="true" readonly="true" value="NEW" />
            </div>

            <x-bladewind.textarea required="true" name="remark" error_message="Write remark" show_error_inline="true"
                label="Remark"></x-bladewind.textarea>

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
        if (usersRegister()) {
            e.target.submit();
        }
    });

    usersRegister = () => {
        if (validateForm('.users-form')) {
            unhide('.btn-save .bw-spinner');
            return true;
        } else {
            hide('.btn-save .bw-spinner');
            return false;
        }
    }
</script>
