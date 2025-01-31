<x-layout.layout :navItems="[
    ['label' => 'Back', 'url' => url('/'), 'active' => false],
]">
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>


<div class="card mt-4">
        <div class="card-header  d-flex align-items-center justify-content-between">
            <h1>Purchase</h1>
            <button class="btn btn-primary w-70 h-70 rounded-5 " data-bs-toggle="modal" data-bs-target="#exampleModal">BuyProduct</button></a>
        </div>
        <div class="card-body">
            <table class="table  mx-auto table-hover">
                <thead>
                    <tr class="table-dark">
                        <th scope="col">#</th>
                        <th scope="col">Supplier</th>
                        <th scope="col">order number</th>
                        <th scope="col">discount</th>
                        <th scope="col">Note</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Action</th>


                    </tr>
                </thead>
                <tbody>
                    @foreach ($purchases as $purchase)
                    <tr>
                        <th scope="row">{{ $purchase->id }}</th>
                        <td>{{ $purchase->suplier }}</td>
                        <td>{{ $purchase->order_number }}</td>
                        <td>{{ $purchase->discount }}</td>
                        <td>{{ $purchase->note }}</td>
                        <td>{{ $purchase->created_at }}</td>

                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Actions
                                    </button>

                                    <ul class="dropdown-menu">
                                        <li>
                                            <form action="{{ url('/buy/view/'.$purchase->id) }}" method="GET">
                                                <button type="submit" class="dropdown-item">View</button>
                                            </form>
                                        </li>
                                        <li>
                                            <form action="{{ url('/buy/'.$purchase->id.'/edit') }}" method="GET">
                                                <button type="submit" class="dropdown-item">Edit</button>
                                            </form>
                                        </li>
                                        <li>
                                            <form action="{{ url('/buy/'.$purchase->id) }}" method="POST" onsubmit="return confirm('تۆ دڵنیای لە سڕینەوەی ئەم وەسڵە ؟')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item text-danger">Delete</button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </td>





                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">New Purchase Order</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body ">
                            <form id="form-id" action="/insert" class="vstack gap-3" method="POST">
                                @csrf

                                <label>Suppliers</label>
                                <select name="suplier" id="suplier" class=" form-control ">

                                </select>

                                <label>Note</label>
                                <input type="text" name="note" class="form-control">

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

                                    </tbody>
                                </table>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" form="form-id" class="btn btn-primary">Buy</button>
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
      $('#exampleModal').on('shown.bs.modal', function() {
    $('#suplier').select2({
        ajax: {
            url: "{{ route('search_suplier') }}",
            type: 'get',
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return { search: params.term || '', limit: 10 };
            },
            processResults: function(data) {
                return {
                    results: data.map(item => ({
                        id: item.id,
                        text: item.name
                    }))
                };
            },
            cache: true
        },
        placeholder: 'Search for a Supplier',
        minimumInputLength: 0,
        dropdownParent: $("#exampleModal")
    });
});


    </script>






</x-layout.layout>
