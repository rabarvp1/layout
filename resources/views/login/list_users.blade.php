<x-layout.layout :navItems="[
    ['label' => __('index.back'), 'url' => url('/'), 'active' => false],
]">

    <div class="card mt-4">

        <div class="card-header  d-flex align-items-center justify-content-between">
            <h1>{{ __('index.users_list') }}</h1>
            <a href="/users/view/create">
                <button class="btn btn-primary w-70 h-70 rounded-5">{{ __('index.add_user')}}</button>
            </a>
            
        </div>
        <div class="card-body">
            <div class="mb-3">
                <div class="input-group {{ in_array(app()->getLocale(), ['ar', 'ku']) ? 'rounded-start-pill' : 'rounded-end-pill' }}">
                    <span class="input-group-text bg-light {{ in_array(app()->getLocale(), ['ar', 'ku']) ? 'rounded-end-pill' : 'rounded-start-pill' }}">
                        <i class="fas fa-search"></i>
                    </span>
                    <input type="text" id="custom-search" class="form-control" placeholder="{{ __('index.search') }}...">
                </div>
            </div>
            <div class=" mt-2">
                <table id="users-table" class="table ms-auto table-hover mt-2">
                    <thead class="table-dark mt-2">
                        <tr>
                            <th>#</th>
                            <th>{{ __('index.name') }}</th>
                            <th>{{ __('index.email') }}</th>
                            <th class="text-center"">{{ __('index.action') }}</th>
            </tr>

        </thead>
        <tbody>


            </tbody>
        </div>
    </div>
    </div>
    <script>
        $(document).ready(function() {
            var table = $('#users-table').DataTable({
                processing: true
                , serverSide: true
                ,searching: false
                ,ajax: {
                    url: '{{ url("/users") }}',
                    type: 'GET',
                    data: function(d) {
                        // Add custom search term to the request
                        d.search = $('#custom-search').val();
                    }
                }
                , columns: [{
                        data: 'id'
                        , name: 'id'
                    }
                    , {
                        data: 'name'
                        , name: '{{ __('index.name') }}'
                    }
                    , {
                        data: 'email'
                        , name: '{{ __('index.email') }}'
                    }

                    , {
                        data: 'actions'
                        , name: '{{ __('index.action') }}'
                        , orderable: false
                        , searchable: false

                    }
                ]
                , dom: '<" top"l>rt<"bottom"ip>'
                                    , lengthMenu: [
                                    [5, 10, 25, 50, -1]
                                    , [5, 10, 25, 50, "All"]
                                    ]
                                    , pageLength: 5
                                    , language: {
                                    searchPlaceholder: "Search products..."
                                    , lengthMenu: "Show _MENU_ entries"
                                    }
                                    });

                                    $(document).on('shown.bs.dropdown', function() {
                                    });


                                    $('#custom-search').on('keyup', function() {
                                    // Trigger DataTable search and redraw the table
                                    table.search(this.value).draw();
                                    });
                                    });

                                    </script>



</x-layout.layout>
