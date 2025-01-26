<x-layout.layout>
    <div class="card mt-4">

        <div class="card-header  d-flex align-items-center justify-content-between">
            <h1>Sell</h1>
            <button class="btn btn-primary w-70 h-70 rounded-5 " data-bs-toggle="modal" data-bs-target="#exampleModal">Sell Products</button></a>
        </div>
        <div class="card-body">
            <table class="table  mx-auto table-hover">
                <thead>
                    <tr class="table-dark">
                        <th scope="col">#</th>
                        <th scope="col">order number</th>
                        <th scope="col">Customer</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Sum</th>
                        <th scope="col">discount</th>
                        <th scope="col">Note</th>
                        <th scope="col">Total</th>
                        <th scope="col">Action</th>
                        <th scope="col">Action</th>


                    </tr>
                </thead>
                <tbody>
                    @foreach ($invoices as $invoice)
                    <tr>
                        <th scope="row">{{ $invoice->id }}</th>
                        <td>{{ $invoice->order_number }}</td>
                        <td>{{ $invoice->customer }}</td>
                        <td>{{ $invoice->created_at }}</td>
                        <td>{{ $invoice->sum }}</td>
                        <td>{{ $invoice->discount }}</td>
                        <td>{{ $invoice->note }}</td>
                        <td>{{ $invoice->total }}</td>
                        <td>
                            <!-- Form for editing the product -->
                            <form action="{{ url('/sell/view/'.$invoice->id) }}" method="GET">

                                <button type="submit" class="btn btn-secondary btn-sm">View</button>
                            </form>
                        </td>
                        <td>
                            <form action="{{ url('/sell/'.$invoice->id) }}" method="POST" onsubmit="return confirm('تۆ دڵنیای لە سڕینەوەی ئەم کاڵایە ؟')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm sale-color">Delete</button>
                            </form>
                        </td>




                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Selling products</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body ">
                            <form id="form-id" action="/insert_sell" class="vstack gap-3" method="POST">
                                @csrf
                                <label>Customer</label>
                                <select name="customer" class=" form-control ">
                                    @foreach($customers as $customer)
                                    <option value="{{ $customer->name }}"> {{ $customer->name }}</option>
                                    @endforeach
                                </select>

                                <label>Note</label>
                                <input type="text" name="note" class="form-control">
                                @error('note')
                                {{ $message }}
                                @enderror

                                <label>search products</label>
                                <input type="text" name="search_product" id="tags" class="form-control">
                                @error('search_product')
                                {{ $message }}
                                @enderror

                                <table class="table  mx-auto table-hover input">

                                    <thead>
                                        <tr class="table-dark">
                                            <th scope="col">Product Name</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">sell Price</th>
                                            <th scope="col">Action</th>

                                        </tr>
                                    </thead>
                                    <tbody id="productTableBody">

                                    </tbody>
                                </table>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" form="form-id" class="btn btn-primary">Sell</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                url: '/delete-sellProduct', // Replace with your endpoint
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
            $("#tags").autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: "/sell/getData_sell", // Laravel route to fetch products
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
                }
                , appendTo: "#exampleModal", // Ensure dropdown works inside the modal
            });
        });

    </script>



</x-layout.layout>
