<x-layout.layout :navItems="[
    ['label' => __('index.back'), 'url' => url('/'), 'active' => false],
]">
<x-slot:header>
    <x-layout.page-header name="purchase_list" modal="exampleModal" />
</x-slot:header>



<div class="card mt-3">

        <div class="card-body">
            <div class="mb-3">
                <div class="input-group ">

                    <input type="text" id="custom-search" class="form-control rounded-5" placeholder="{{ __('index.search_product_name') }}...">
                </div>


            </div>



            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">



                <!-- Table Body -->
                <div class="datatable-scroll">
                    <table id="DataTables_Table_1" class="table datatable-basic dataTable no-footer" aria-describedby="DataTables_Table_0_info">
                    </table>
                </div>

                <!-- Table Footer -->
                <div class="datatable-footer">
                    <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite"></div>
                    <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate"></div>
                </div>
            </div>

            <div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title" id="exampleModalLabel">{{ __('index.new_purchase_order') }}</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body ">
                            <form id="form-id" action="/buy/insert" class="row g-3" method="POST">
                                @csrf

                                <div class="col-12">
                                    <label>{{ __('index.supplier') }}</label>

                                    <div class="col-lg-9 mt-2" data-select2-id="247">
                                        <select  class="form-control" name="suplier" id="suplier"  tabindex="-1"  >

                                        </select>
                                    </div>

                                </div>


                                <label>{{ __('index.note') }}</label>
                                <input type="text" name="note" class="form-control">

                                <div class="mb-4">
                                    <label>{{ __('index.search_product_name') }}</label>
                                    <input type="search" class="form-control mt-2" id="autocomplete_basic" placeholder="Search product">
                                </div>


                                <table class="table  mx-auto table-hover">

                                    <thead>
                                        <tr class="text-center align-middle">
                                            <th scope="col">{{ __('index.product_name') }}</th>
                                            <th scope="col">{{ __('index.quantity') }}</th>
                                            <th scope="col">{{ __('index.price') }}</th>
                                            <th scope="col">{{ __('index.single_price') }}</th>
                                            <th scope="col">{{ __('index.multi_price') }}</th>
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
                            <button type="submit" form="form-id" class="btn btn-primary">{{ __('index.buy') }}</button>
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
                url: '/delete-product',
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
            $("#autocomplete_basic").autocomplete({

                source: function(request, response) {
                    $.ajax({
                        url: "/buy/getData",
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
                    $('#autocomplete_basic').val('');
                    return false;

                }
                , appendTo: "#exampleModal",
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
<script>
    $(document).ready(function() {
        var table = $('#DataTables_Table_1').DataTable({

           ajax: {
                    url: '{{ url("/buy") }}',
                    type: 'GET',
                    data: function(d) {
                        d.search = $('#custom-search').val();
                    }
                }
            , columns: [{
                    data: 'id'
                    , title: '#'
                    ,className:'text-center align-middle'

                }
                , {
                    data: 'suplier'
                    , title: '{{ __('index.supplier') }}'
                    ,className:'text-center align-middle'

                }
                , {
                    data: 'order_number'
                    , title: '{{ __('index.order_no') }}'
                   ,className:'text-center align-middle'


                }
                , {
                    data: 'discount'
                    , title: '{{ __('index.discount') }}'
                    ,className:'text-center align-middle'

                }
                , {
                    data: 'note'
                    , title: '{{ __('index.note') }}'
                    ,className:'text-center align-middle'

                }
                , {
                    data: 'created_at'
                    , title: '{{ __('index.created_at') }}'
                    ,className:'text-center align-middle'

                }
                , {
                    data: 'actions'
                    , title: '{{ __('index.action') }}'
                    ,className:'text-center align-middle'

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
