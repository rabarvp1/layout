<x-layout.layout :navItems="[
    ['label' => 'Back', 'url' => url('/'), 'active' => false],
]">
    <div class="container mt-4">
        <div class="card shadow-lg">
            <div class="card-header bg-info text-white d-flex align-items-center justify-content-between">
                <h3 class="mb-0">Product List</h3>
                <button class="btn btn-light text-primary fw-bold rounded-5 px-4 py-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    + Add Product
                </button>
            </div>
            <div class="card-body">
                <!-- Custom Styled Search -->
                <div class="mb-3">
                    <div class="input-group rounded-end-pill">
                        <span class="input-group-text bg-light rounded-start-pill"><i class="fas fa-search"></i></span>
                        <input type="text" id="custom-search" class="form-control" placeholder="Search by product name...">
                    </div>
                </div>

                <div class="table-responsive mt-2">
                    <table id="products-table" class="table mx-auto table-hover mt-2">
                        <thead class="table-dark mt-2">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Table rows will be populated dynamically by DataTables -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Modal for Adding Product -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header text-white bg-info">
                        <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form id="product-form" action="/upload" method="POST" class="row g-3">
                            @csrf
                            <div class="col-12">
                                <label class="form-label fw-bold">Product Name</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-bold">Category</label>
                                <select name="cat_id" class="form-select">
                                    @foreach($cat as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" form="product-form" class="btn btn-primary">Insert</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if ($errors->any())
    <script>
        $(document).ready(function() {
            $('#exampleModal').modal('show');
        });

    </script>
    @endif

    @push('scripts')
    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Include DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <!-- Include Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Include Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            var table = $('#products-table').DataTable({
                processing: true
                , serverSide: true
                , ajax: '{{ url("/product") }}'
                , columns: [{
                        data: 'id'
                        , name: 'id'
                    }
                    , {
                        data: 'name'
                        , name: 'name'
                    }
                    , {
                        data: 'category'
                        , name: 'category'
                    }
                    , {
                        data: 'actions'
                        , name: 'actions'
                        , orderable: false
                        , searchable: false
                        , render: function(data, type, row) {
                            return `
                        <div class="dropdown">
                            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                Actions
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <li><a class="dropdown-item" href="{{ url('/product') }}/${row.id}/edit">Edit</a></li>
                                <li>
                                    <form action="{{ url('/product') }}/${row.id}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    `
                        }
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
    @endpush
</x-layout.layout>
