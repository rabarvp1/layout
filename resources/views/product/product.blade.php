<x-layout.layout>

    <div class="card mt-4">
        <div class="card-header  d-flex align-items-center justify-content-between">
            <h1>product</h1>
            <button class="btn btn-primary w-70 h-70 rounded-5 " data-bs-toggle="modal" data-bs-target="#exampleModal">+</button></a>
        </div>
        <div class="card-body">
            <table class="table  mx-auto">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">name</th>
                        <th scope="col">price</th>
                        <th scope="col">stock</th>
                        <th scope="col">categories</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)

                    <tr>
                        <th scope="row">{{ $product->id }}</th>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->stock  }}</td>
                        <td>{{ $product->category }}</td>

                        {{-- <td><button class="btn btn-danger rounded-4">Delete</button></td> --}}

                    </tr>



                    @endforeach

                </tbody>
            </table>
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Add Product</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body ">
                            <form id="form-id" action="/upload" class="vstack gap-3" method="POST">
                                @csrf
                                <label>name</label>
                                <input type="text" name="name" class="form-control">
                                @error('name')
                                {{ $message }}
                                @enderror

                                <label>price</label>
                                <input type="text" name="price" class="form-control">
                                @error('price')
                                {{ $message }}
                                @enderror

                                <label>stock</label>
                                <input type="text" name="stock" class="form-control">
                                @error('stock')
                                {{ $message }}
                                @enderror

                                <label>catagoreis</label>
                                <select name="cat_id" class="form-control">
                                    @foreach($cat as $category) <!-- Assuming $categories is passed from the controller -->
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
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
