<x-layout.layout :navItems="[
    ['label' => __('index.back'), 'url' => url('/'), 'active' => false],
]">

<div class="container-fluid mt-90 mb-2" tabindex="-1">

    <h5 class="d-flex justify-content-between align-items-center pr-1 pl-1 mt-n2" tabindex="-1">
        گۆڕینی وشەی نهێنی
        <span tabindex="-1">






        </span>
    </h5>
    <form action="{{ url('/users/change_password/update') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="current_password" class="form-label">Current Password</label>
            <div class="input-group">
                <input type="password" id="current_password" name="current_password" class="form-control">
                <span class="input-group-text" id="toggleCurrentPassword">
                    <i class="fas fa-eye" id="currentEyeIcon"></i>
                </span>
            </div>
        </div>

        <div class="mb-3">
            <label for="new_password" class="form-label">New Password</label>
            <div class="input-group">
                <input type="password" id="new_password" name="new_password" class="form-control">
                <span class="input-group-text" id="toggleNewPassword">
                    <i class="fas fa-eye" id="newEyeIcon"></i>
                </span>
            </div>
        </div>

        <div class="mb-3">
            <label for="new_password_confirmation" class="form-label">Confirm Password</label>
            <div class="input-group">
                <input type="password" id="new_password_confirmation" name="new_password_confirmation" class="form-control">
                <span class="input-group-text" id="toggleConfirmPassword">
                    <i class="fas fa-eye" id="confirmEyeIcon"></i>
                </span>
            </div>
        </div>


        <button type="submit" class="btn btn-primary">Change Password</button>
    </form>

        </div>

        <script>
            // Current Password Toggle
            document.getElementById('toggleCurrentPassword').addEventListener('click', function () {
                const currentPasswordField = document.getElementById('current_password');
                const currentEyeIcon = document.getElementById('currentEyeIcon');

                if (currentPasswordField.type === 'password') {
                    currentPasswordField.type = 'text';
                    currentEyeIcon.classList.remove('fa-eye');
                    currentEyeIcon.classList.add('fa-eye-slash');
                } else {
                    currentPasswordField.type = 'password';
                    currentEyeIcon.classList.remove('fa-eye-slash');
                    currentEyeIcon.classList.add('fa-eye');
                }
            });

            // New Password Toggle
            document.getElementById('toggleNewPassword').addEventListener('click', function () {
                const newPasswordField = document.getElementById('new_password');
                const newEyeIcon = document.getElementById('newEyeIcon');

                if (newPasswordField.type === 'password') {
                    newPasswordField.type = 'text';
                    newEyeIcon.classList.remove('fa-eye');
                    newEyeIcon.classList.add('fa-eye-slash');
                } else {
                    newPasswordField.type = 'password';
                    newEyeIcon.classList.remove('fa-eye-slash');
                    newEyeIcon.classList.add('fa-eye');
                }
            });

            // Confirm Password Toggle
            document.getElementById('toggleConfirmPassword').addEventListener('click', function () {
                const confirmPasswordField = document.getElementById('new_password_confirmation');
                const confirmEyeIcon = document.getElementById('confirmEyeIcon');

                if (confirmPasswordField.type === 'password') {
                    confirmPasswordField.type = 'text';
                    confirmEyeIcon.classList.remove('fa-eye');
                    confirmEyeIcon.classList.add('fa-eye-slash');
                } else {
                    confirmPasswordField.type = 'password';
                    confirmEyeIcon.classList.remove('fa-eye-slash');
                    confirmEyeIcon.classList.add('fa-eye');
                }
            });
        </script>



</x-layout.layout>
