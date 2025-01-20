<x-layout.layout>

    <div class="card mt-4">
        <div class="card-header  d-flex align-items-center justify-content-between">
            <h1>product</h1>
            <button class="btn btn-primary w-70 h-70 rounded-5 " data-bs-toggle="modal" data-bs-target="#exampleModal">+</button></a>
        </div>
        <div class="card-body">
            <table class="table  mx-auto table-hover ">
                <thead>

                    <tr class="table-dark">
                        <th scope="col">#</th>

                        <th scope="col">name</th>

                        <th scope="col">price</th>


                        <th scope="col">categories</th>

                        <th scope="col"></th>

                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)

                    <tr>
                        <th scope="row">{{ $product->id }}</th>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->category }}</td>
                       <td>
                            <!-- Form for editing the product -->
                            <form action="{{ url('/product/'.$product->id.'/edit') }}" method="GET">
                                @csrf
                                <button type="submit" class="btn btn-secondary btn-sm">Edit</button>
                            </form>
                        </td>

                        <td>
                            <!-- Form for deleting the product -->
                            <form action="{{ url('/product/'.$product->id) }}" method="POST" onsubmit="return confirm('تۆ دڵنیای لە سڕینەوەی ئەم کاڵایە ؟')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>


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



                                <label>catagoreis</label>
                                <select name="cat_id" class="form-control">
                                    @foreach($cat as $category)
                                    <option value="{{ $category->id }}" {{ old('cat_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
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



            {{-- // this modal for Editing product --}}

            <div class="modal fade" id="EditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Add Product</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body ">


                        </div>

                    </div>
                </div>
            </div>

            {{-- end modal edit --}}
        </div>
    </div>
    @if ($errors->any())
    <script>
        $(document).ready(function() {
            $('#exampleModal').modal('show');
        });

    </script>
    @endif
    {{--
<script>
    $(document).ready(function() {
        $('.delete-btn').click(function() {
            var productId = $(this).data('id');

            if (confirm('Are you sure you want to delete this product?')) {
                $.ajax({
                    url: '/product/' + productId,  // Route for deleting the product
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}' // CSRF token for security
    },
    success: function(response) {
    if (response.success) {
    // On success, remove the deleted product row from the table
    $('button[data-id="'+ productId +'"]').closest('tr').remove();
    alert('Product deleted successfully!');
    }
    },
    error: function(xhr, status, error) {
    alert('There was an error deleting the product.');
    }
    });
    }
    });
    });
    </script> --}}
</x-layout.layout>
