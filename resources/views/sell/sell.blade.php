<x-layout.layout :navItems="[
    ['label' => 'Back', 'url' => url('/'), 'active' => false],
]">
    <div class="card mt-4">

        <div class="card-header  d-flex align-items-center justify-content-between">
            <h1>Sell</h1>
            <button class="btn btn-primary w-70 h-70 rounded-5 " data-bs-toggle="modal" data-bs-target="#exampleModal">Sell Products</button>
                </div>
        <div class="card-body">
            <table class="table  mx-auto table-hover" id="invoice-table">
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



                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>

            <div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header text-white bg-info">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Selling products</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body ">
                            <form id="form-id" action="/insert_sell" class="vstack gap-3" method="POST">
                                @csrf
                                <label>Customer</label>
                                <select name="customer_id" id="customer_id" class=" form-control ">

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
            const row = $(this).closest('tr');

            row.remove();

            const productId = $(this).data('id');
            $.ajax({
                url: '/delete-sellProduct',
                type: 'POST'
                , data: {
                    id: productId
                    , _token: '{{ csrf_token() }}', /
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
                        }, // Send search term
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

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $('#exampleModal').on('shown.bs.modal', function() {
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
                , dropdownParent: $("#exampleModal")
            });
        });

    </script>

<script>
    $(document).ready(function() {
        var table = $('#invoice-table').DataTable({
            processing: true
            , serverSide: true
            ,searching: false
            , ajax: '{{ url("/sell") }}'
            , columns: [{
                    data: 'id'
                    , name: 'id'
                }

                , {
                    data: 'order_number'
                    , name: 'order_number'
                }
                , {
                    data: 'customer'
                    , name: 'customer'
                }
                , {
                    data: 'created_at'
                    , name: 'created_at'
                }
                , {
                    data: 'sum'
                    , name: 'sum'
                }
                , {
                    data: 'discount'
                    , name: 'discount'
                }
                , {
                    data: 'note'
                    , name: 'note'
                }


                , {
                    data: 'total'
                    , name: 'total'
                }
                , {
                    data: 'actions'
                    , name: 'actions'
                    , orderable: false
                    , searchable: false

                }

               

            ]
            , dom: '<"top"l>rt<"bottom"ip>'
            , lengthMenu: [
                [5, 10, 25, 50, -1]
                , [5, 10, 25, 50, "All"]
            ]
            , pageLength: 5
            , language: {
                searchPlaceholder: "Search products..."
                , lengthMenu: "Show _MENU_ entries"
            }
        });

        $(document).on('shown.bs.dropdown', function() {
        });


        $('#custom-search').on('keyup', function() {
            table.search(this.value).draw();
        });
    });

</script>




</x-layout.layout>
