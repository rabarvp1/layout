<x-layout.layout :navItems="[
    ['label' => __('index.back'), 'url' => url('/buy'), 'active' => false],
]">
    <div class="modal-body">
        <form id="form-id" action="{{ url('/buy/update'.$purchase->id) }}" class="vstack gap-3" method="POST">
            @csrf
            @method('PUT')

            <label>{{ __('index.supplier') }}</label>
            <select name="suplier" id="suplier" class="form-control">
                <option value="{{ $purchase->suplier_id }}">{{ $purchase->suplier }}</option>
            </select>

            <label>{{ __('index.note') }}</label>
            <input type="text" name="note" class="form-control" value="{{ $purchase->note }}">

            <label>{{ __('index.search_product_name') }}</label>
            <input type="text" name="search_product" id="search_product" class="form-control">


  <!-- Table Body -->
  <div class="datatable-scroll">
    <table id="productTableBody" class="table datatable-basic dataTable no-footer" aria-describedby="DataTables_Table_0_info">

        <thead>
            <tr class="text-center align-middle">
                <th>{{ __('index.product_name') }}</th>
                <th>{{ __('index.quantity') }}</th>
                <th>{{ __('index.price') }}</th>
                <th>{{ __('index.single_price') }}</th>
                <th>{{ __('index.multi_price') }}</th>
                <th>{{ __('index.action') }}</th>
            </tr>
        </thead>
        <tbody id="productTableBody">
            @foreach ($purchase_product as $purchase)
                <tr>
                    <td class="text-center">{{ $purchase->product_name }}</td>
                    <td><input type="number" class="form-control text-center" name="quantity[]" value="{{ $purchase->quantity }}"></td>
                    <td><input type="number" class="form-control text-center" name="cost[]" value="{{ $purchase->cost }}"></td>
                    <td><input type="number" class="form-control text-center" name="single_price[]" value="0"></td>
                    <td><input type="number" class="form-control text-center" name="multi_price[]" value="0"></td>
                    <input type="hidden" name="product_id[]" value="{{ $purchase->product_id }}">
                    <td>
                        <button type="button" class="btn btn-danger btn-sm delete-btn" data-id="{{ $purchase->product_id }}">{{ __('index.delete') }}</button>
                    </td>
                </tr>
            @endforeach
        </tbody>


    </table>
</div>

<!-- Table Footer -->
<div class="datatable-footer">
    <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite"></div>
    <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate"></div>
</div>
</div>




            <br>
            <button type="submit" class="btn btn-primary w-25">{{ __('index.updateing') }}</button>
        </form>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://code.jquery.com/ui/1.14.1/jquery-ui.js"></script>

    <!-- Delete Product -->
    <script>
        $(document).on('click', '.delete-btn', function() {
            const row = $(this).closest('tr');
            const productId = $(this).data('id');

            $.ajax({
                url: '/delete-product/' + productId,
                type: 'DELETE',
                data: { _token: '{{ csrf_token() }}' },
                success: function(response) {
                    console.log(response.message);
                    row.remove();
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        });
    </script>

    <!-- Product Autocomplete Search -->
    <script>
        $(document).ready(function() {
            $("#search_product").autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: "/buy/getData",
                        type: "GET",
                        data: { search: request.term },
                        dataType: "json",
                        success: function(data) {
                            response(data);
                        }
                    });
                },
                minLength: 1,
                select: function(event, ui) {
                    if ($("#productTableBody input[value='" + ui.item.id + "']").length === 0) {
                        $('#productTableBody').append(ui.item.html);
                    }
                    $('#search_product').val('');
                    return false;
                },
                appendTo: "#exampleModal"
            });
        });
    </script>

    <!-- Select2 for Suplier -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#suplier').select2({
                ajax: {
                    url: "{{ route('search_suplier') }}",
                    type: 'GET',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return { search: params.term || '', limit: 10 };
                    },
                    processResults: function(data) {
                        return {
                            results: data.map(item => ({ id: item.id, text: item.name }))
                        };
                    },
                    cache: true
                },
                placeholder: '{{ __("index.search") }}',
                minimumInputLength: 1
            });
        });
    </script>
</x-layout.layout>
