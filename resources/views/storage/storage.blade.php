<x-layout.layout :navItems="[
    ['label' => __('index.back'), 'url' => url('/'), 'active' => false],
]">
<x-slot:header>
    <x-layout.page-header name="storage"  />
</x-slot:header>
    <div class="card-body text-center ">
        <div class="mb-3">
            <div class="input-group ">

                <input type="text" id="custom-search" class="form-control rounded-5" placeholder="{{ __('index.search_product_name') }}...">
            </div>


        </div>
        <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">



            <!-- Table Body -->
            <div class="datatable-scroll">
                <table id="storageTable" class="table datatable-basic dataTable no-footer" aria-describedby="DataTables_Table_0_info">
                    <thead>
                        <tr class="">
                            <th class="text-center">#</th>
                            <th class="text-center">{{ __('index.product') }} </th>
                            <th class="text-center">{{ __('index.quantity') }}</th>
                            <th class="text-center">{{ __('index.avg')}}</th>
                            <th class="text-center">{{ __('index.Catigories') }}</th>
                        </tr>
                    </thead>
                </table>
            </div>

            <!-- Table Footer -->
            <div class="datatable-footer">
                <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite"></div>
                <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate"></div>
            </div>
        </div>
{{--
        <table id="storageTable" class="table  table-hover mx-auto">
            <thead>
                <tr class="table-dark ">
                    <th class="text-center">#</th>
                    <th class="text-center">{{ __('index.product') }} </th>
                    <th class="text-center">{{ __('index.quantity') }}</th>
                    <th class="text-center">{{ __('index.avg')}}</th>
                    <th class="text-center">{{ __('index.Catigories') }}</th>
                </tr>
            </thead>
        </table> --}}
    </div>



    <script>
        $(document).ready(function() {
            var table = $('#storageTable').DataTable({



                ajax: {
                    url: '{{ url("/storage/getData_storage") }}'
                    , type: 'GET'
                    , data: function(d) {
                        // Add custom search term to the request
                        d.search = $('#custom-search').val();
                    }
                }
                , columns: [{
                        data: null
                        , render: function(data, type, row, meta) {
                            return meta.row + 1;
                        }
                    }
                    , {
                        data: 'product_name'
                    }
                    , {
                        data: 'total_quantity'
                    }
                    , {
                        data: 'avg_cost'
                        , render: $.fn.dataTable.render.number(',', '.', 2, '$')
                    }
                    , {
                        data: 'category_name'
                    }
                ]
                // , createdRow: function(row, data, dataIndex) {
                //     if (data.total_quantity === 0) {
                //         $('td', row).eq(2).addClass('text-bg-danger');
                //     } else if (data.total_quantity < 5) {
                //         $('td', row).eq(2).addClass('text-bg-warning');
                //     }
                // }
                // , order: [
                //     [1, 'asc']
                // ]

            });
            $('#custom-search').on('keyup', function() {
                // Trigger DataTable search and redraw the table
                table.search(this.value).draw();
            });
        });

    </script>
</x-layout.layout>
