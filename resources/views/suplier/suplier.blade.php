<x-layout.layout :navItems="[
    ['label' => 'Back', 'url' => url('/'), 'active' => false],
]">

<x-slot:header>
    <x-layout.page-header name="supplier_list" modal="exampleModal" />
</x-slot:header>


        <div class="card-body">

            <div class="mb-3">
                <div class="input-group ">

                    <input type="text" id="custom-search" class="form-control rounded-5" placeholder="{{ __('index.search_product_name') }}...">
                </div>


            </div>
            {{-- <table class="table  mx-auto table-hover" id="suplier-table">
                <thead>
                    <tr class="table-dark">
                        <th scope="col">#</th>
                        <th scope="col">{{ __('index.name') }}</th>
                        <th scope="col">{{ __('index.address') }}</th>
                        <th scope="col">{{ __('index.phone_no') }}</th>
                        <th scope="col" class="text-center">{{ __('index.action') }}</th>



                    </tr>
                </thead>
                <tbody>


                </tbody>
            </table> --}}

            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">



                <!-- Table Body -->
                <div class="datatable-scroll">
                    <table id="suplier-table" class="table datatable-basic dataTable no-footer" aria-describedby="DataTables_Table_0_info">
                    </table>
                </div>

                <!-- Table Footer -->
                <div class="datatable-footer">
                    <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite"></div>
                    <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate"></div>
                </div>
            </div>

            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Add Suplier</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body ">
                            <form id="form-id" action="/supplier/insert" class="vstack gap-3" method="POST">
                                @csrf
                                <label>{{ __('index.name_of_supplier') }}</label>
                                <input type="text" name="name" class="form-control">
                                @error('name')
                                {{ $message }}

                                @enderror
                                <label>{{ __('index.address') }}</label>
                                <input type="text" name="address" class="form-control">
                                @error('address')
                                {{ $message }}

                                @enderror
                                <label>{{ __('index.phone_no') }}</label>
                                <input type="text" name="phone_number" class="form-control">
                                @error('phone_number')
                                {{ $message }}
                                @enderror


                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('index.close') }}</button>
                            <button type="submit" form="form-id" class="btn btn-primary">{{ __('index.insert') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if ($errors->any())
    <script>
        $(document).ready(function() {
            $('#exampleModal').modal('show');
        });

    </script>
    @endif

    <script>
        $(document).ready(function() {
            var table = $('#suplier-table').DataTable({

                 ajax: {
                    url: '{{ url("/suplier") }}',
                    type: 'GET',
                    data: function(d) {
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
                        , render: function(data, type, row) {
                            return `<a href="/suplier/profile/${row.id}" class="text-primary">${data}</a>`;
                        }
                    }
                    , {
                        data: 'address'
                        , title: '{{ __('index.address') }}'
                    }
                    , {
                        data: 'phone_number'
                        , title: '{{ __('index.phone_no') }}'
                    }


                    , {
                        data: 'actions'
                        , title: '{{ __('index.action') }}'
                        , className: 'text-center'

                     

                    }

                ]

            });

            $(document).on('shown.bs.dropdown', function() {});


            $('#custom-search').on('keyup', function() {
                table.search(this.value).draw();
            });
        });

    </script>

</x-layout.layout>
