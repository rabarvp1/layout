<x-layout.layout :navItems="[
    ['label' => 'Back', 'url' => url('/'), 'active' => false],
]">
    <div class="card mt-4">
        <div class="card-header  d-flex align-items-center justify-content-between">
            <h1>{{ __('index.supplier_list')}}</h1>
            <button class="btn btn-primary w-70 h-70 rounded-5 " data-bs-toggle="modal" data-bs-target="#exampleModal">+</button></a>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <div class="input-group {{ in_array(app()->getLocale(), ['ar', 'ku']) ? 'rounded-start-pill' : 'rounded-end-pill' }}">
                    <span class="input-group-text bg-light {{ in_array(app()->getLocale(), ['ar', 'ku']) ? 'rounded-end-pill' : 'rounded-start-pill' }}">
                        <i class="fas fa-search"></i>
                    </span>
                    <input type="text" id="custom-search" class="form-control" placeholder="{{ __('index.search_suplier_name') }}...">
                </div>


            </div>
            <table class="table  mx-auto table-hover" id="suplier-table">
                <thead>
                    <tr class="table-dark">
                        <th scope="col">#</th>
                        <th scope="col">{{ __('index.name') }}</th>
                        <th scope="col">{{ __('index.address') }}</th>
                        <th scope="col">{{ __('index.phone_no') }}</th>
                        <th scope="col" class="text-center">{{ __('index.action') }}</th>



                    </tr>
                </thead>
                <tbody>


                </tbody>
            </table>

            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Add Suplier</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body ">
                            <form id="form-id" action="/supplier/insert" class="vstack gap-3" method="POST">
                                @csrf
                                <label>{{ __('index.name_of_supplier') }}</label>
                                <input type="text" name="name" class="form-control">
                                @error('name')
                                {{ $message }}

                                @enderror
                                <label>{{ __('index.address') }}</label>
                                <input type="text" name="address" class="form-control">
                                @error('address')
                                {{ $message }}

                                @enderror
                                <label>{{ __('index.phone_no') }}</label>
                                <input type="text" name="phone_number" class="form-control">
                                @error('phone_number')
                                {{ $message }}
                                @enderror


                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('index.close') }}</button>
                            <button type="submit" form="form-id" class="btn btn-primary">{{ __('index.insert') }}</button>
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
            var table = $('#suplier-table').DataTable({
                processing: true
                , serverSide: true
                , searching: false
                , ajax: {
                    url: '{{ url("/suplier") }}',
                    type: 'GET',
                    data: function(d) {
                        d.search = $('#custom-search').val();
                    }
                }
                , columns: [{
                        data: 'id'
                        , name: 'id'
                    }
                    , {
                        data: 'name'
                        , name: '{{ __('index.name') }}'
                        , render: function(data, type, row) {
                            return `<a href="/suplier/profile/${row.id}" class="text-primary">${data}</a>`;
                        }
                    }
                    , {
                        data: 'address'
                        , name: '{{ __('index.address') }}'
                    }
                    , {
                        data: 'phone_number'
                        , name: '{{ __('index.phone_no') }}'
                    }


                    , {
                        data: 'actions'
                        , name: '{{ __('index.action') }}'
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

            $(document).on('shown.bs.dropdown', function() {});


            $('#custom-search').on('keyup', function() {
                table.search(this.value).draw();
            });
        });

    </script>

</x-layout.layout>
