<x-layout.layout :navItems="[
    ['label' => __('index.back'), 'url' => url('/users'), 'active' => false],
]">
<x-slot:header>
    <x-layout.page-header name="register"  />
</x-slot:header>

    <div class="container mt-2">
        <div class="row justify-content-center">
            <div class="d-flex justify-content-between col-12 bg-white">
                <div class="bg-white p-4 p-md-5 rounded shadow-sm">
                    <h2 class="text-center mb-4">{{ __('index.register') }}</h2>
                    <form action="/users/create" method="POST" id="form">
                        @csrf
                        <div class="row gy-3">

                            <div class="col-12">
                                <label for="name" class="form-label"> {{ __('index.name') }} </label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-vcard" viewBox="0 0 16 16">
                                            <path d="M5 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4m4-2.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5M9 8a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4A.5.5 0 0 1 9 8m1 2.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5" />
                                            <path d="M2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2zM1 4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H8.96c.026-.163.04-.33.04-.5C9 10.567 7.21 9 5 9c-2.086 0-3.8 1.398-3.984 3.181A1.006 1.006 0 0 1 1 12z" />
                                        </svg>
                                    </span>
                                    <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="email" class="form-label">{{ __('index.email') }}</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                                            <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z" />
                                        </svg>
                                    </span>
                                    <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}">
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="password" class="form-label">{{ __('index.password') }}</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-key" viewBox="0 0 16 16">
                                            <path d="M0 8a4 4 0 0 1 7.465-2H14a.5.5 0 0 1 .354.146l1.5 1.5a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0L13 9.207l-.646.647a.5.5 0 0 1-.708 0L11 9.207l-.646.647a.5.5 0 0 1-.708 0L9 9.207l-.646.647A.5.5 0 0 1 8 10h-.535A4 4 0 0 1 0 8zm4-3a3 3 0 1 0 2.712 4.285A.5.5 0 0 1 7.163 9h.63l.853-.854a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.793-.793-1-1h-6.63a.5.5 0 0 1-.451-.285A3 3 0 0 0 4 5z" />
                                            <path d="M4 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                                        </svg>
                                    </span>
                                    <input type="password" class="form-control" name="password" id="password" value="">
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="password_confirmation" class="form-label">{{ __('index.confirm_password') }}</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-key" viewBox="0 0 16 16">
                                            <path d="M0 8a4 4 0 0 1 7.465-2H14a.5.5 0 0 1 .354.146l1.5 1.5a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0L13 9.207l-.646.647a.5.5 0 0 1-.708 0L11 9.207l-.646.647a.5.5 0 0 1-.708 0L9 9.207l-.646.647A.5.5 0 0 1 8 10h-.535A4 4 0 0 1 0 8zm4-3a3 3 0 1 0 2.712 4.285A.5.5 0 0 1 7.163 9h.63l.853-.854a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.793-.793-1-1h-6.63a.5.5 0 0 1-.451-.285A3 3 0 0 0 4 5z" />
                                            <path d="M4 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                                        </svg>
                                    </span>
                                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
                                </div>
                            </div>






                </div>
            </div>
            {{-- permissions --}}
            <div class="col-md-6">
                <div class="bg-white p-4 p-md-5 rounded shadow-sm">
                    <h2 class="text-center mb-4">{{ __('index.select_role') }}</h2>

                    <div class="row gy-3">



                        <div class="row mt-3">
                            <div class="col-12 mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="select_all">
                                    <label class="form-check-label" for="select_all">
                                        <span class="user-select-none">Select all</span>
                                    </label>
                                </div>
                            </div>
                            @foreach ($roles as $role)
                            <div class="col-xl-4 col-lg-6 col-md-12 col-12 mb-4">
                                <div class="form-check">
                                    <input class="form-check-input role-checkbox" type="checkbox"
                                           name="permission[]" value="{{ $role->prefix }}"
                                           id="{{ $role->prefix }}"
                                           @if(in_array($role->prefix, old('permission', []))) checked @endif>
                                    <label class="form-check-label" for="{{ $role->prefix }}">
                                        <span class="user-select-none">{{ $role->name }}</span>
                                    </label>
                                </div>
                            </div>
                        @endforeach

                        </div>




                    </div>

                </form>

            </div>

        </div>

        {{-- <div class="col-md-5 d-flex align-items-center justify-content-center">
            <img src="{{ asset('snawbar.png') }}" alt="Logo" class="img-fluid rounded shadow" width="400" height="400">
        </div> --}}
       </div>  <div class="col-12">
        <div class="d-grid">
            <button class="btn btn-primary  w-100 mt-3 mt-sm-3" type="submit" form="form">{{ __('index.sign_up')}}</button>
        </div>
    </div>
      </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get 'Select All' checkbox and role checkboxes
            const selectAllCheckbox = document.getElementById('select_all');
            const roleCheckboxes = document.querySelectorAll('.role-checkbox');

            // Add event listener for the 'Select All' checkbox
            selectAllCheckbox.addEventListener('change', function() {
                const isChecked = selectAllCheckbox.checked;
                roleCheckboxes.forEach(function(checkbox) {
                    checkbox.checked = isChecked;
                });
            });

            // Add event listener to each role checkbox to update 'Select All' state
            roleCheckboxes.forEach(function(checkbox) {
                checkbox.addEventListener('change', function() {
                    const allChecked = Array.from(roleCheckboxes).every(function(checkbox) {
                        return checkbox.checked;
                    });
                    selectAllCheckbox.checked = allChecked;
                    selectAllCheckbox.indeterminate = !allChecked && Array.from(roleCheckboxes).some(function(checkbox) {
                        return checkbox.checked;
                    });
                });
            });
        });
    </script>

{{-- <script>

    $(document).ready(function () {
$('input:checkbox').change(function(){

    var ischecked=$(this).is(":checked");
    if (ischecked) {
        $(this).fadeOut(2002);

    }
});

    })
</script> --}}
</x-layout.layout>
