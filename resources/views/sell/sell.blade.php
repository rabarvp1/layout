<x-layout.layout :navItems="[
    ['label' => __('index.back'), 'url' => url('/'), 'active' => false],
]">
<x-slot:header>
    <x-layout.page-header name="sell" modal="exampleModal" />
</x-slot:header>

    <div class="card mt-4">


        <div class="card-body">
            <div class="mb-3">
                <div class="input-group ">

                    <input type="text" id="custom-search" class="form-control rounded-5" placeholder="{{ __('index.search_product_name') }}...">
                </div>


            </div>
            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">



                <!-- Table Body -->
                <div class="datatable-scroll">
                    <table id="DataTables_Table_2" class="table datatable-basic dataTable no-footer" aria-describedby="DataTables_Table_0_info">
                    </table>
                </div>

                <!-- Table Footer -->
                <div class="datatable-footer">
                    <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite"></div>
                    <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate"></div>
                </div>
            </div>

            <div class="modal fade " id="exampleModal"  aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header text-white bg-info">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">{{ __('index.sell_product')}}</h1>
                            <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body ">
                            <form id="form-id" action="/insert_sell" class="vstack gap-3" method="POST">
                                @csrf
                                <label>{{ __('index.customer') }}</label>
                                <select name="customer_id" id="customer_id" class=" form-control ">

                                </select>

                                <label>{{ __('index.note') }}</label>
                                <input type="text" name="note" class="form-control">
                                @error('note')
                                {{ $message }}
                                @enderror

                                <label>{{ __('index.search_product_name')}}</label>
                                {{-- <input type="text" name="search_product" id="tags" class="form-control">
                                @error('search_product')
                                {{ $message }}
                                @enderror --}}
                                <div class="mb-4">
                                    <div class="fw-bold border-bottom pb-2 mb-2">Basic usage</div>
                                    <input type="search" class="form-control" id="tags" placeholder="Search product">
                                </div>

                                <table class="table  mx-auto table-hover input">

                                    <thead>
                                        <tr class="table-dark">
                                            <th scope="col">{{ __('index.product_name')}}</th>
                                            <th scope="col">{{ __('index.quantity') }}</th>
                                            <th scope="col">{{ __('index.selling price')}}</th>
                                            <th scope="col">{{ __('index.action') }}</th>

                                        </tr>
                                    </thead>
                                    <tbody id="productTableBody">

                                    </tbody>
                                </table>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('index.close') }}</button>
                            <button type="submit" form="form-id" class="btn btn-primary">{{ __('index.sell') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>





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
                    $('#search_product').val('');
                    return false;


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
        var table = $('#DataTables_Table_2').DataTable({

             ajax: {
                    url: '{{ url("/sell") }}',
                    type: 'GET',
                    data: function(d) {
                        // Add custom search term to the request
                        d.search = $('#custom-search').val();
                    }
                }
              ,  columns: [{
                    data: 'id'
                    , title: '#'
                }

                , {
                    data: 'order_number'
                    , title: '{{ __('index.order_no')}}'
                }
                , {
                    data: 'customer'
                    , title: ' {{ __('index.customer')}}'
                }
                , {
                    data: 'created_at'
                    , title: '{{ __('index.created_at')}}'
                }
                , {
                    data: 'sum'
                    , title: ' {{ __('index.sum') }} '
                }
                , {
                    data: 'discount'
                    , title: ' {{ __('index.discount')}}'
                }
                , {
                    data: 'total'
                    , title: ' {{ __('index.total')}}'
                }
                , {
                    data: 'note'
                    , title: ' {{ __('index.note')}}'
                }



                , {
                    data: 'actions'
                    , title: '{{ __('index.action') }}'
                    , orderable: false
                    , searchable: false

                }



            ]

        });

        $(document).on('shown.bs.dropdown', function() {
        });


        $('#custom-search').on('keyup', function() {
            table.search(this.value).draw();
        });
    });

</script>




</x-layout.layout>
