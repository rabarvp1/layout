<x-layout.layout>

    <x-slot:header>
        <x-layout.page-header name="Category" modal="exampleModal" />
    </x-slot:header>

    <div class="card">
        <div class="card-body">
            <div class="mb-3">
                <div class="input-group ">

                    <input type="text" id="custom-search" class="form-control rounded-5" placeholder="{{ __('index.search_product_name') }}...">
                </div>


            </div>
       
            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">



                <!-- Table Body -->
                <div class="datatable-scroll">
                    <table id="DataTables_Table_0" class="table datatable-basic dataTable no-footer" aria-describedby="DataTables_Table_0_info">
                        {{-- <thead>
                            <tr>
                                <th class="sorting">First Name</th>
                                <th class="sorting">Last Name</th>
                                <th class="sorting">Job Title</th>
                                <th class="sorting">DOB</th>
                                <th class="sorting">Status</th>
                                <th class="text-center sorting_disabled" style="width: 100px;">Actions</th>
                            </tr>
                        </thead> --}}

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
                            <h1 class="modal-title fs-5" id="exampleModalLabel">{{ __('index.Add Category') }}</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body ">
                            <form id="form-id" action="/cat/insert" class="vstack gap-3" method="POST">
                                @csrf
                                <label>{{ __('index.Add Category') }}</label>
                                <input type="text" name="name" class="form-control">
                                @error('name')
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

    @include('cat.datatatble')

</x-layout.layout>
