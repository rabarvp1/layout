<x-layout.layout :navItems="[
    ['label' => __('index.back'), 'url' => url('/'), 'active' => false],
]">
<x-slot:header>
    <x-layout.page-header name="customer_list" modal="exampleModal" />
</x-slot:header>


    <div class="card mt-4">

        <div class="card-body">
            <div class="remove">

                <input type="text" class="input-title">
                <button id="btn"class="btn">delete</button>

            </div>
            <div class="remove">

                <input type="text" class="input-title">
                <button id="btn"class="btn">delete</button>

            </div>
            <div class="remove">

                <input type="text" class="input-title">
                <button id="btn"class="btn">delete</button>

            </div>


            <div class="mb-3">
                <div class="mb-3">
                    <div class="input-group ">

                        <input type="text" id="custom-search" class="form-control rounded-5" placeholder="{{ __('index.search_product_name') }}...">
                    </div>


                </div>
                <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">



                    <!-- Table Body -->
                    <div class="datatable-scroll">
                        <table id="customer-table" class="table datatable-basic dataTable no-footer w-100" aria-describedby="DataTables_Table_0_info">
                        </table>
                    </div>

                    <!-- Table Footer -->
                    <div class="datatable-footer">
                        <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite"></div>
                        <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate"></div>
                    </div>
                </div>



            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">{{ __('index.add_customer') }}</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body ">
                            <form id="form-id" action="/customer/insert" class="vstack gap-3" method="POST">
                                @csrf
                                <label>{{ __('index.name_of_customer') }}</label>
                                <input type="text" name="name" class="form-control">
                                @error('name')
                                {{ $message }}

                                @enderror
                                <label>{{ __('index.address') }}</label>
                                <input type="text" name="address" class="form-control">
                                @error('address')
                                {{ $message }}

                                @enderror
                                <label>{{ __('index.phone_no')}}</label>
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
            var table = $('#customer-table').DataTable({

                 ajax: {
                    url: '{{ url("/customer") }}',
                    type: 'GET',
                    data: function(d) {
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
                        , render: function(data, type, row) {
                            return `<a href="/customer/profile/${row.id}" class="text-primary">${data}</a>`;
                        }
                    }
                    , {
                        data: 'address'
                        , title: '{{ __('index.address')}}'
                    }
                    , {
                        data: 'phone_number'
                        , title: '{{ __('index.phone_no') }}'
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

            $(document).on('shown.bs.dropdown', function() {
            });


            $('#custom-search').on('keyup', function() {
                table.search(this.value).draw();
            });

        });

    </script>
    <script>

        $(document).ready(function () {

            // $('.page-title').hide();
            $('.a1').hide();
            $('.a2').hide();


            // $('.a2').delay(2000).fadeIn(2000);
            $('.page-title').animate( {
                "margin-right":"+=500px",


            },3000,function () {
                // $('.a1').fadeIn(2000);

            });

            // $('.a1').delay(2000).fadeIn(1000).animate( {
            //     "margin-left":"+=200px",


            // },3000);
            // $('.a2').animate( {
            //     "margin-left":"+=500px",


            // },3000);
            $(".btn").click(function(index){
    //    $(this).remove();
    console.log(index);
       $(this).closest('.remove').fadeOut(2000);

        // alert("Input Value: " + value);
    });

        })
    </script>


</x-layout.layout>
