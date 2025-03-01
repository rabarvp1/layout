<x-layout.layout :navItems="[
    ['label' => __('index.back'), 'url' => url('/'), 'active' => false],
]">

<x-slot:header>
    <x-layout.page-header name="product_list" modal="exampleModal" />
</x-slot:header>

    <div class="container mt-1">
        <div class="card shadow-lg">

            <div class="card-body">
                <div class="mb-3">
                    <div class="input-group ">

                        <input type="text" id="custom-search" class="form-control rounded-5" placeholder="{{ __('index.search_product_name') }}...">
                    </div>


                </div>
                <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">



                    <!-- Table Body -->
                    <div class="datatable-scroll">
                        <table id="DataTables_Table_0" class="table datatable-basic dataTable no-footer w-100" aria-describedby="DataTables_Table_0_info">
                        </table>
                    </div>

                    <!-- Table Footer -->
                    <div class="datatable-footer">
                        <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite"></div>
                        <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate"></div>
                    </div>
                </div>

            </div>
        </div>

        <div class=" modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header ">
                                <h5 class="modal-title" id="exampleModalLabel">{{ __('index.add_product') }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <form id="product-form" action="/product/insert" method="POST" class="row g-3">
                                    @csrf
                                    <div class="col-12">
                                        <label class="form-label fw-bold">{{ __('index.product_name') }}</label>
                                        <input type="text" name="name" class="form-control" required>
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label fw-bold">{{ __('index.Catigories') }}</label>


                                            <div class="col-lg-9" data-select2-id="247">
                                                <select  class="form-control" id="cat_id"  tabindex="-1" name="cat_id" >

                                                </select>
                                            </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('index.close') }}</button>
                                <button type="submit" form="product-form" class="btn btn-primary">{{ __('index.insert') }}</button>
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
                var table = $('#DataTables_Table_0').DataTable({

                    ajax: {
                        url: '{{ url("/product") }}'
                        , type: 'GET'
                        , data: function(d) {
                            d.search = $('#custom-search').val();
                        }
                    }
                    , columns: [{
                            data: 'id'
                            , title: '#'
                        }
                        , {
                            data: 'name'
                            , title: '{{ __('index.name') }}'
                        }
                        , {
                            data: 'category'
                            , title: '{{ __('index.Catigories') }}'
                        }
                        , {
                            data: 'actions'
                            , title: '{{ __('index.action') }}'
                            , className: 'text-center'
                            , orderable: false
                            , searchable: false
                        }
                    ]



                });

                $(document).on('shown.bs.dropdown', function() {});

                $('#custom-search').on('keyup', function() {
                    table.search(this.value).draw();
                });
            });

        </script>



        <script>
            $('#exampleModal').on('shown.bs.modal', function() {
                $('#cat_id').select2({
                    ajax: {
                        url: "{{ route('search_cat') }}"
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
                    , placeholder: 'Chooase a category'
                    , minimumInputLength: 0
                    , dropdownParent: $("#exampleModal")
                });
            });

        </script>

</x-layout.layout>
