<x-layout.layout :navItems="[
    ['label' => 'Back', 'url' => url('/sell'), 'active' => false],
]">
    <h5 class="d-flex justify-content-between align-items-center pr-1 pl-1 mt-n2" tabindex="-1">
        receipts sold ({{ $invoice->order_number }})
        <span tabindex="-1">
        </span>
    </h5>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <ul class="list-group p-0 m-0">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Order Number
                            <div>{{ $invoice->order_number }}</div>

                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Created at
                            <div dir="ltr">{{ $invoice->created_at }}</div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Customer
                            <div>{{ $invoice->customer }}</div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Note
                            <div>{{ $invoice->note }}</div>
                        </li>


                    </ul>
                </div>
                <div class="col-md-6">
                    <ul class="list-group p-0 m-0">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Sum
                            <div>${{ $invoice->sum }}</div>
                        </li>


                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Discount
                            <div>{{ $invoice->discount }}</div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Total
                            <div>${{ $invoice->total }}</div>
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
                        <th class="text-center">Price</th>
                        <th class="text-center">Sum</th>
                    </tr>
                </thead>
                <tbody class="text-center">

                    {{ $count=null }}

                    @foreach ($sell_product as $sell )

                    <tr>
                        <td>{{ $count=$count+1 }}</td>
                        <td>{{ $sell->product_name }}</td>
                        <td>{{ $sell->quantity }}</td>
                        <td>${{ $sell->sell_price }}</td>
                        <td>${{ $sell->sum }}</td>
                    </tr>

                    @endforeach


                </tbody>
            </table>
        </div>
    </div>


</x-layout.layout>
