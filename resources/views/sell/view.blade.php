<x-layout.layout :navItems="[
    ['label' => __('index.back'), 'url' => url('/sell'), 'active' => false],
]">
    <h5 class="d-flex justify-content-between align-items-center pr-1 pl-1 mt-n2" tabindex="-1">
        {{ __('index.receipts_sold') }} ({{ $invoice->order_number }})
        <span tabindex="-1">
        </span>
    </h5>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <ul class="list-group p-0 m-0">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ __('index.order_no') }}
                            <div>{{ $invoice->order_number }}</div>

                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ __('index.created_at') }}
                            <div dir="ltr">{{ $invoice->created_at }}</div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ __('index.customer') }}
                            <div>{{ $invoice->customer_name }}</div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ __('index.note') }}
                            <div>{{ $invoice->note }}</div>
                        </li>


                    </ul>
                </div>
                <div class="col-md-6">
                    <ul class="list-group p-0 m-0">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ __('index.sum') }}
                            <div>${{ $invoice->sum }}</div>
                        </li>


                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ __('index.discount') }}
                            <div>{{ $invoice->discount }}</div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ __('index.total') }}
                            <div>${{ $invoice->total }}</div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="card-body text-center table-responsive">
            <table class="table table-bordered table-sm w-100 table-hover w-100">
                <thead>
                    <tr class="table-secondary">
                        <th class="text-center"><i class="fas fa-sort-numeric-down"></i></th>
                        <th class="text-center">{{ __('index.product')}} </th>
                        <th class="text-center">{{ __('index.quantity') }}</th>
                        <th class="text-center">{{ __('index.price')}}</th>
                        <th class="text-center">{{ __('index.sum') }}</th>
                    </tr>
                </thead>
                <tbody class="text-center">



                    @foreach ($sell_product as $sell )

                    <tr>
                        <td>{{ $loop->iteration}}</td>
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
