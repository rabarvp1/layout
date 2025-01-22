
<x-layout.layout>
    <div class="card mt-4">
        <div class="card-header  d-flex align-items-center justify-content-between">
            <h1>Supliers</h1>
            <button class="btn btn-primary w-70 h-70 rounded-5 " data-bs-toggle="modal" data-bs-target="#exampleModal">+</button></a>
        </div>
        <div class="card-body">
            <table class="table  mx-auto table-hover">
                <thead>
                    <tr class="table-dark">
                        <th scope="col">#</th>
                        <th scope="col">name</th>
                        <th scope="col">address</th>
                        <th scope="col">phone number</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($supliers as $suplier)

                    <tr>
                        <th scope="row">{{ $suplier->id }}</th>
                        <td>{{ $suplier->name }}</td>
                        <td>{{ $suplier->address }}</td>
                        <td>{{ $suplier->phone_number}}</td>


                        {{-- <td><button class="btn btn-danger rounded-4">Delete</button></td> --}}

                    </tr>



                    @endforeach

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
                            <form id="form-id" action="/inputSuplier" class="vstack gap-3" method="POST">
                                @csrf
                                <label>Name of Suplier</label>
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

</x-layout.layout>
