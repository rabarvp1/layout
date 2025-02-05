<x-layout.layout :navItems="[
    ['label' => __('index.back'), 'url' => url('/'), 'active' => false],
]">
    <div class="card-body text-center table-responsive">
        <table id="storageTable" class="table  table-hover mx-auto">
            <thead >
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
            $('#storageTable').DataTable({
                processing: true,
                serverSide: false,
                ajax: "{{ route('getData_storage') }}",
                columns: [
                    { data: null, render: function(data, type, row, meta) { return meta.row + 1; } },
                    { data: 'product_name' },
                    { data: 'total_quantity' },
                    { data: 'avg_cost', render: $.fn.dataTable.render.number(',', '.', 2, '$') },
                    { data: 'category_name' }
                ],
                createdRow: function(row, data, dataIndex) {
                    // Apply classes based on the total_quantity
                    if (data.total_quantity === 0) {
                        $('td', row).eq(2).addClass('text-bg-danger');
                    } else if (data.total_quantity < 5) {
                        $('td', row).eq(2).addClass('text-bg-warning');
                    }
                },
                order: [[1, 'asc']]
            });
        });
    </script>
</x-layout.layout>
