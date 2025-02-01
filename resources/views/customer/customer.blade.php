<x-layout.layout :navItems="[
    ['label' => 'Back', 'url' => url('/'), 'active' => false],
]">
    <div class="card mt-4">
        <div class="card-header  d-flex align-items-center justify-content-between">
            <h1>Customer</h1>
            <button class="btn btn-primary w-70 h-70 rounded-5 " data-bs-toggle="modal" data-bs-target="#exampleModal">+</button></a>
        </div>
        <div class="card-body">
            <table class="table  mx-auto table-hover" id="customer-table">
                <thead>
                    <tr class="table-dark">
                        <th scope="col">#</th>
                        <th scope="col">name</th>
                        <th scope="col">address</th>
                        <th scope="col">phone number</th>
                        <th scope="col">Action</th>

                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>

            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Add Customer</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body ">
                            <form id="form-id" action="/inputCustomer" class="vstack gap-3" method="POST">
                                @csrf
                                <label>Name of Customer</label>
                                <input type="text" name="name" class="form-control">
                                @error('name')
                                {{ $message }}

                                @enderror
                                <label>Address</label>
                                <input type="text" name="address" class="form-control">
                                @error('address')
                                {{ $message }}

                                @enderror
                                <label>Phone Number</label>
                                <input type="text" name="phone_number" class="form-control">
                                @error('phone_number')
                                {{ $message }}
                                @enderror


                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" form="form-id" class="btn btn-primary">insert</button>
                        </div>
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


    <script>
        $(document).ready(function() {
            var table = $('#customer-table').DataTable({
                processing: true
                , serverSide: true
                ,searching: false
                , ajax: '{{ url("/customer") }}'
                , columns: [{
                        data: 'id'
                        , name: 'id'
                    }
                    , {
                        data: 'name'
                        , name: 'name'
                    }
                    , {
                        data: 'address'
                        , name: 'address'
                    }
                    , {
                        data: 'phone_number'
                        , name: 'phone_number'
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
