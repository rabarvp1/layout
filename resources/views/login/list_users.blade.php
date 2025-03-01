<x-layout.layout :navItems="[
    ['label' => __('index.back'), 'url' => url('/'), 'active' => false],
]">
    <x-slot:header>
        <x-layout.page-header name="users_list" url="/users/view/create" />
    </x-slot:header>

    <div class="card mt-4">

        <div class="card-body">
            <div class="mb-3">
                <div class="input-group ">

                    <input type="text" id="custom-search" class="form-control rounded-5" placeholder="{{ __('index.search_product_name') }}...">
                </div>


            </div>
            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">



                <!-- Table Body -->
                <div class="datatable-scroll">
                    <table id="users-table" class="table datatable-basic dataTable no-footer w-100" aria-describedby="DataTables_Table_0_info">
                    </table>
                </div>

                <!-- Table Footer -->
                <div class="datatable-footer">
                    <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite"></div>
                    <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate"></div>
                </div>
            </div>


        </div>
    </div>
    <script>
        $(document).ready(function() {
            var table = $('#users-table').DataTable({

                ajax: {
                    url: '{{ url("/users") }}'
                    , type: 'GET'
                    , data: function(d) {
                        // Add custom search term to the request
                        d.search = $('#custom-search').val();
                    }
                }
                , columns: [{
                        data: 'id'
                        , title: '#'
                    }
                    , {
                        data: 'name'
                        , title: '{{ __('index.name') }}'
                    }
                    , {
                        data: 'email'
                        , title: '{{ __('index.email') }}'
                    }

                    , {
                        data: 'actions'
                        , title: '{{ __('index.action') }}'
                        , className: 'text-center'

                        , orderable: false
                        , searchable: false

                    }
                ]

            });

            $(document).on('shown.bs.dropdown', function() {});


            $('#custom-search').on('keyup', function() {
                // Trigger DataTable search and redraw the table
                table.search(this.value).draw();
            });
        });

    </script>

</x-layout.layout>
