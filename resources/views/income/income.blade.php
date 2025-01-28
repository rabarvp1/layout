<x-layout.layout :navItems="[
    ['label' => 'Back', 'url' => url('/'), 'active' => false],
]">

    <div class="card mt-4">
        <div class="card-header  d-flex align-items-center justify-content-between">
            <h1>Income</h1>
        </div>
        <div class="card-body">
            <table class="table ">
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
                    @foreach ($mergedData as $data)
                    <tr>
                        <td>{{ $data->product_name }}</td>
                        <td>${{ $data->buying_price}}</td>
                        <td>{{ $data->sold_quantity }}</td>
                        <td>${{ $data->selling_price}}</td>
                        <td>${{ ($data->selling_price-$data->buying_price)*$data->sold_quantity }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>




    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });

    </script>
</x-layout.layout>
