<x-layout.layout :navItems="[
    ['label' => __('index.back'), 'url' => url('/'), 'active' => false],
]">

    <div class="card mt-4">
        <div class="card-header  d-flex align-items-center justify-content-between">
            <h1>{{ __('index.income_list')}}</h1>
        </div>
        <div class="card-body">
            <table class="table " id="income-table">
                <thead>
                    <tr class="table-dark">
                        <th>{{ __('index.product_name') }}</th>
                        <th>{{ __('index.cost') }}</th>
                        <th>{{ __('index.sold quantity')}}</th>
                        <th>{{ __('index.selling price')}}</th>
                        <th>{{ __('index.profit')}}</th>
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

<script>
    $(document).ready(function () {
        $('#income-table').DataTable();
    });
</script>

</x-layout.layout>
