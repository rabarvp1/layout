<x-layout.layout :navItems="[
    ['label' => __('index.back'), 'url' => url('/sell'), 'active' => false],
]">
    <div class="">
        <form id="form-id" action="{{ url('/sell/update/'.$invoices->id)  }}" class="vstack gap-3" method="POST">
            @csrf
            @method('PUT')
            <label>{{ __('index.customer') }}</label>
            <select name="customer_id" id="customer_id" class=" form-control ">
                <option value="{{ $invoices->customer_id }}">{{ $invoices->customer_name }}</option>

            </select>
            <label>{{ __('index.note') }}</label>
            <input type="text" name="note" class="form-control" value="{{$invoices->note }}">


            <label>{{ __('index.search_product_name') }}</label>
            <input type="text" name="search_product" id="tags" class="form-control">


            <table class="table  mx-auto table-hover input">

                <thead>
                    @foreach ($sell_products as $sell_product )


                    <tr class="table-dark">
                        <th scope="col">{{ __('index.product_name') }}</th>
                        <th scope="col">{{ __('index.quantity') }}</th>
                        <th scope="col">{{ __('index.selling price') }}</th>
                        <th scope="col">{{ __('index.action') }}</th>

                    </tr>
                </thead>
                <tbody id="productTableBody">

                    <tr>
                        <td>{{ $sell_product->product_name}}</td>
                        <td><input type="number" class="form-control" name="quantity[]" value="{{ $sell_product->quantity }}"></td>

                        <td><input type="number" class="form-control" name="sell_price[]" value="{{ $sell_product->sell_price }}"></td>



                        <input type="hidden" name="product_id[]" value="{{ $sell_product->product_id }}">
                        <td>
                            <button type="button" class="btn btn-danger btn-sm sale-color delete-btn" data-id="%s">{{ __('index.delete') }}</button>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
            <button type="submit" class="btn btn-primary w-25 ">{{ __('index.updateing') }}</button>

        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://code.jquery.com/ui/1.14.1/jquery-ui.js"></script>
    <script>
        $(document).on('click', '.delete-btn', function() {
            const row = $(this).closest('tr');

            row.remove();

            const productId = $(this).data('id');
            $.ajax({
                url: '/delete-sellProduct',
                type: 'POST'
                , data: {
                    id: productId
                    , _token: '{{ csrf_token() }}',
                }
                , success: function(response) {
                    console.log(response.message);
                }
                , error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            , });
        });

    </script>

    <script>
        $(document).ready(function() {
            $("#tags").autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: "/sell/getData_sell",
                        type: "GET"
                        , data: {
                            search: request.term
                        },
                        dataType: "json"
                        , success: function(data) {
                            response(data);
                        }
                    , });
                }
                , minLength: 0,
                select: function(event, ui) {
                    $('#productTableBody').append(ui.item.html);
                }
                , appendTo: "#exampleModal",
            });
        });

    </script>

    <!-- Include Select2 CSS and JS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $('decoment').ready( function() {
            $('#customer_id').select2({
                ajax: {
                    url: "{{ route('search_customer') }}"
                    , type: 'get'
                    , dataType: 'json'
                    , delay: 250
                    , data: function(params) {
                        return {
                            search: params.term || ''
                            , limit: 10
                        };
                    }
                    , processResults: function(data) {
                        return {
                            results: data.map(item => ({
                                id: item.id
                                , text: item.name
                            }))
                        };
                    }
                    , cache: true
                }
                , placeholder: 'Search for a Customer'
                , minimumInputLength: 0
            });
        });

    </script>



</x-layout.layout>
