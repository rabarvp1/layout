<x-layout.layout :navItems="[
    ['label' => 'Back', 'url' => url('/buy'), 'active' => false],
]">

    <div class="modal-body ">
        <form id="form-id" action="{{ url('/buy/'.$purchase->id) }}" class="vstack gap-3" method="POST">
            @csrf
        @method('PUT')

            <label>Suppliers</label>
            <select name="suplier" id="suplier" class=" form-control">
               <option value="{{ $purchase->suplier_id }}">{{ $purchase->suplier }}</option>
            </select>

            <label>Note</label>
            <input type="text" name="note" class="form-control" value="{{ $purchase->note }}">

            <label>search products</label>
            <input type="text" name="search_product" id="search_product" class="form-control">


            <table class="table  mx-auto table-hover">

                <thead>
                    <tr class="table-dark">
                        <th scope="col">Product Name</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Buy Price</th>
                        <th scope="col">Single Price</th>
                        <th scope="col">Multi Price</th>
                        <th scope="col">Action</th>

                    </tr>
                </thead>
                <tbody id="productTableBody">
                    @foreach ($purchase_product as $purchase )


                    <tr>
                        <td>{{ $purchase->product_name }}</td>
        <td><input type="number" class="form-control" name="quantity[]" value="{{ $purchase->quantity }}"></td>

        <td><input type="number" class="form-control" name="cost[]" value="{{ $purchase->cost }}"></td>

        <td><input type="number" class="form-control" name="single_price[]" value="0"></td>

        <td><input type="number" class="form-control" name="multi_price[]" value="0"></td>
        <input type="hidden" name="product_id[]" value="{{ $purchase->product_id }}">


        <td>
            <button type="button" class="btn btn-danger btn-sm sale-color delete-btn" data-id="%s">Delete</button>
        </td>
    </tr>
                    @endforeach


                </tbody>
            </table>
            <br>
            <button type="submit" class="btn btn-primary w-25 ">Update Product</button>
        </form>

    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://code.jquery.com/ui/1.14.1/jquery-ui.js"></script>

    <script>
        $(document).on('click', '.delete-btn', function() {
            // Get the current row
            const row = $(this).closest('tr');

            // Remove the row from the table
            row.remove();

            // Optionally, you can perform an AJAX request to notify the server
            const productId = $(this).data('id');
            $.ajax({
                url: '/delete-product', // Replace with your endpoint
                type: 'POST'
                , data: {
                    id: productId
                    , _token: '{{ csrf_token() }}', // Add CSRF token for security
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
            $("#search_product").autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: "/buy/getData", // Laravel route to fetch products
                        type: "GET"
                        , data: {
                            search: request.term
                        }, // Send search term
                        dataType: "json"
                        , success: function(data) {
                            response(data);
                        }
                    , });
                }
                , minLength: 0, // Minimum characters before searching
                select: function(event, ui) {
                    $('#productTableBody').append(ui.item.html);
                    $('#search_product').val('');
                    return false;

                }
                , appendTo: "#exampleModal", // Ensure dropdown works inside the modal
            });
        });

    </script>

    <!-- Include Select2 CSS and JS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
$(document).ready(function() {
    $('#suplier').select2({
                ajax: {
                    url: "{{ route('search_suplier') }}"
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
                , placeholder: 'Search for a Supplier'
                , minimumInputLength: 0
            });
        });

    </script>



</x-layout.layout>
