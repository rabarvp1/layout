<x-layout.layout :navItems="[
    ['label' => __('index.back'), 'url' => url('/suplier'), 'active' => false],
]">
    <form action="{{ url('/suplier/payment/' . $suplier->id) }}" method="POST">
        @csrf
        <div class="card">
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-md-4"> {{ __('index.name') }} : {{ $suplier->name}}</div>
                    <div class="col-md-4">{{ __('index.phone_no') }} : {{ $suplier->phone_number }} </div>
                    <div class="col-md-4">{{ __('index.address') }} : {{ $suplier->address }}</div>
                </div>
            </div>
            <hr>
            <div class="row mb-3 mx-3">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="amount">
                            {{ __('index.Amount_of_money') }}
                        </label>
                        <input type="text" class="form-control number_input_style" id="amount" name="amount" value="0">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="type">
                            {{ __('index.type')}}
                        </label>
                        <select name="type" id="type" class="form-control">
                            <option value="" null="">{{ __('index.choose_a_type') }}</option>
                            <option value="Receiving money">{{ __('index.receiving_money') }}</option>
                            <option value="Payments">{{ __('index.payment') }}</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="created_at">
                            {{ __('index.created_at') }}
                        </label>
                        <input type="datetime-local" step="1" class="form-control" id="created_at" name="created_at" value="2025-02-02T21:21:27">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="note">
                            {{ __('index.note') }}
                        </label>
                        <input type="text" class="form-control" id="note" name="note" value="">
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer mt-3 mb-3">
            <button type="submit" class="btn btn-primary">{{ __('index.add') }}</button>
        </div>

    </form>





    <div class="card">
        <div class="card-body">

            <div class="row">
                <div class="col-sm-12 col-md-6"></div>
                <div class="col-sm-12 col-md-6"></div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <table id="mytable" class="table  w-100    table-hover" role="grid" aria-describedby="mytable_info" style="width: 1450px;">
                        <thead>

                            <tr role="row" class="table-dark">
                                <th class="text-center" rowspan="1" colspan="1"><i class="fas fa-sort-numeric-down"></i></th>
                                <th class="text-center" rowspan="1" colspan="1">{{ __('index.Receipt_type') }}</th>
                                <th class="text-center" rowspan="1" colspan="1">{{ __('index.created_at') }}</th>
                                <th class="text-center" rowspan="1" colspan="1">{{ __('index.Amount_of_money') }}</th>
                                <th class="text-center" rowspan="1" colspan="1">{{ __('index.balance') }}</th>
                                <th class="text-center" rowspan="1" colspan="1">{{ __('index.note') }}</th>
                                <th class="text-center" rowspan="1" colspan="1">{{ __('index.action') }}</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach ($payments as $payment )
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>

                                    @if ($payment->type == 'Payments')
                                    {{ __('index.payment') }} ({{ $payment->id }})
                                @elseif ($payment->type == 'Receiving money')
                                    {{ __('index.receiving_money') }} ({{ $payment->id }})

                                @endif

                            </td>
                                <td>{{ $payment->created_at }}</td>
                                <td>${{ $payment->amount }}</td>
                                <td>${{ $payment->balance }}</td>
                                <td>{{ $payment->note }}</td>
                                <td>
                                    <div class="dropdown text-center">
                                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            {{ __('index.action') }}
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <form action="{{ url('/suplier/profile/edit/' . $payment->id . '/' . $suplier->id) }}" method="GET" style="display: inline;">
                                                    <button type="submit" class="dropdown-item" >{{ __('index.edit') }}  </button>
                                                </form>
                                            </li>

                                            <li>
                                                <form action="{{ url('/suplier/payment/' . $payment->id) }}" method="POST" style="display: inline;" onsubmit="return confirm(\'Are you sure you want to delete this payment?\')">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="dropdown-item text-danger">{{ __('index.delete') }}</button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>


        </div>
    </div>



    @if ($errors->any())
    <script>
        $(document).ready(function() {
            $('#modal-edit').modal('show');
        });

    </script>
    @endif
</x-layout.layout>
