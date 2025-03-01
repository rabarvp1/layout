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
                <div class="col-md-6">
                    <label for="start_date_1">Start Date:</label>
                    <input id="start_date_1" type="datetime-local" step="1" class="form-control">
                </div>
                <div class="col-md-6">
                    <label for="end_date_1">End Date:</label>
                    <input type="datetime-local" step="1" class="form-control" id="end_date_1">
                </div>
            </div>
            <div class="row">



                <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer mt-4">



                    <!-- Table Body -->
                    <div class="datatable-scroll">
                        <table id="mytable1" class="table datatable-basic dataTable no-footer table-hover w-100" aria-describedby="DataTables_Table_0_info">

                            <thead>

                                <tr role="row" class="">
                                    <th class="text-center" rowspan="1" colspan="1"><i class="fas fa-sort-numeric-down"></i></th>
                                    <th class="text-center" rowspan="1" colspan="1">{{ __('index.Receipt_type') }}</th>
                                    <th class="text-center" rowspan="1" colspan="1">{{ __('index.created_at') }}</th>
                                    <th class="text-center" rowspan="1" colspan="1">{{ __('index.add') }}</th>
                                    <th class="text-center" rowspan="1" colspan="1">{{ __('index.minus') }}</th>
                                    <th class="text-center" rowspan="1" colspan="1">{{ __('index.balance') }}</th>
                                    <th class="text-center" rowspan="1" colspan="1">{{ __('index.note') }}</th>
                                    <th class="text-center" rowspan="1" colspan="1">{{ __('index.action') }}</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">

                            </tbody>
                        </table>
                    </div>

                    <!-- Table Footer -->
                    <div class="datatable-footer">
                        <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite"></div>
                        <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate"></div>
                    </div>
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
    <script>

        $(document).ready(function () {
            let supplierId = "{{ $suplier->id }}";
            $('#mytable1').DataTable({

                ajax: {
                    url: '{{ url("/suplier/payment/get") }}',
                    type: "GET",
                    data: function (d) {
                        d.supplier_id = supplierId;
                        d.start_date_1 = $('#start_date_1').val();
                        d.end_date_1 = $('#end_date_1').val();
                    }
                },
                columns: [
                    { data: null, render: (data, type, row, meta) => meta.row + 1 },
                    { data: 'receipt_type', name: 'receipt_type' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'add', name: 'add' },
                    { data: 'minus', name: 'minus' },
                    { data: 'balance', name: 'balance' },
                    { data: 'note', name: 'note' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });

            $('#start_date_1, #end_date_1').on('change', function() {
                table.ajax.reload();
            });
        });
        </script>

</x-layout.layout>
