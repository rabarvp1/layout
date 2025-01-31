<x-layout.layout :navItems="[
    ['label' => 'Back', 'url' => url('/buy'), 'active' => false],
]">
    <h5 class="d-flex justify-content-between align-items-center pr-1 pl-1 mt-n2" tabindex="-1">
        receipts Purchased ({{ $purchase->order_number }})
        <span>
        </span>
    </h5>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <ul class="list-group p-0 m-0">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Order Number
                            <div>{{ $purchase->order_number }}</div>

                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Created at
                            <div dir="ltr">{{ $purchase->created_at }}</div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Suplier
                            <div> {{ $purchase->suplier }}</div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Note
                            <div>{{ $purchase->note }}</div>
                        </li>


                    </ul>
                </div>
                <div class="col-md-6">
                    <ul class="list-group p-0 m-0">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Sum
                            <div>${{ $purchase->sum }}</div>
                        </li>


                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Discount
                            <div>{{ $purchase->discount }}</div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Total
                            <div>${{ $purchase->total }}</div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="card-body text-center table-responsive">
            <table class="table table-bordered table-sm w-100 table-hover">
                <thead>
                    <tr class="table-secondary">
                        <th class="text-center"><i class="fas fa-sort-numeric-down"></i></th>
                        <th class="text-center">Product</th>
                        <th class="text-center">Quantity</th>
                        <th class="text-center">Cost</th>
                        <th class="text-center">Sum</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($purchase_product as $purchase )

                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $purchase->product_name }}</td>
                        <td>{{ $purchase->quantity }}</td>
                        <td>${{ $purchase->cost }}</td>
                        <td>${{ $purchase->sum }}</td>
                    </tr>

                    @endforeach


                </tbody>
            </table>
        </div>
    </div>


</x-layout.layout>
