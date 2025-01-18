<x-layout.layout>
    <div class="card mt-4">
        <div class="card-header  d-flex align-items-center justify-content-between">
            <h1>Income</h1>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
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
                        <td>${{ $data->product_price }}</td>
                        <td>{{ $data->sold_quantity }}</td>
                        <td>{{ $data->selling_price}}</td>
                        <td>{{ ($data->selling_price-$data->product_price)*$data->sold_quantity }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>



</x-layout.layout>
