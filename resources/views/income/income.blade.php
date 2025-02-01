<x-layout.layout :navItems="[
    ['label' => 'Back', 'url' => url('/'), 'active' => false],
]">

    <div class="card mt-4">
        <div class="card-header  d-flex align-items-center justify-content-between">
            <h1>Income</h1>
        </div>
        <div class="card-body">
            <table class="table " id="income-table">
                <thead>
                    <tr class="table-dark">
                        <th>Product Name</th>
                        <th>cost</th>
                        <th>Sold Quantity</th>
                        <th>Selling Price</th>
                        <th>Profit</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>




    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });

    </script>

<script>
    $(document).ready(function() {
        $('#income-table').DataTable({
            processing: true,
            serverSide: false,
            ajax: '{{ url("/income") }}'
            ,
            columns: [
                { data: null, render: function(data, type, row, meta) { return meta.row + 1; } },
                { data: 'product_name' },
                { data: 'sold_quantity' },
                { data: 'selling_price' },
                { data: 'bought_quantity'},
                { data: 'buying_price' }
            ],

            order: [[1, 'asc']]
        });
    });
</script>
</x-layout.layout>
