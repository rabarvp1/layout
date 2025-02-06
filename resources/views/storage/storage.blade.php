<x-layout.layout :navItems="[
    ['label' => __('index.back'), 'url' => url('/'), 'active' => false],
]">
    <div class="card-body text-center ">
        <div class="mb-3">
            <div class="input-group {{ in_array(app()->getLocale(), ['ar', 'ku']) ? 'rounded-start-pill' : 'rounded-end-pill' }}">
                <span class="input-group-text bg-light {{ in_array(app()->getLocale(), ['ar', 'ku']) ? 'rounded-end-pill' : 'rounded-start-pill' }}">
                    <i class="fas fa-search"></i>
                </span>
                <input type="text" id="custom-search" class="form-control" placeholder="{{ __('index.search_product_name') }}...">
            </div>


        </div>
        <table id="storageTable" class="table  table-hover mx-auto">
            <thead>
                <tr class="table-dark ">
                    <th class="text-center">#</th>
                    <th class="text-center">{{ __('index.product') }} </th>
                    <th class="text-center">{{ __('index.quantity') }}</th>
                    <th class="text-center">{{ __('index.avg')}}</th>
                    <th class="text-center">{{ __('index.cat') }}</th>
                </tr>
            </thead>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

    <script>
        $(document).ready(function() {
            var table = $('#storageTable').DataTable({
                processing: true
                , serverSide: true
                , searching: false,
                lengthChange: false,
          

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
                , createdRow: function(row, data, dataIndex) {
                    if (data.total_quantity === 0) {
                        $('td', row).eq(2).addClass('text-bg-danger');
                    } else if (data.total_quantity < 5) {
                        $('td', row).eq(2).addClass('text-bg-warning');
                    }
                }
                , order: [
                    [1, 'asc']
                ]
                , pageLength: 10, // default page length
                lengthMenu: [10, 25, 50, 100], // pagination options
                language: {
                    paginate: {
                        previous: '<i class="fa fa-chevron-left"></i>'
                        , next: '<i class="fa fa-chevron-right"></i>'
                    }
                }
            });
            $('#custom-search').on('keyup', function() {
                // Trigger DataTable search and redraw the table
                table.search(this.value).draw();
            });
        });

    </script>
</x-layout.layout>
