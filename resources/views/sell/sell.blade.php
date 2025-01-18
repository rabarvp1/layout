<x-layout.layout>

    <div class="card mt-4">
        <div class="card-header  d-flex align-items-center justify-content-between">
            <h1>sell</h1>
            <button class="btn btn-primary w-70 h-70 rounded-5 " data-bs-toggle="modal" data-bs-target="#exampleModal">Sell Product</button></a>
        </div>
        <div class="card-body">
            <table class="table  mx-auto table-hover">
                <thead>
                    <tr class="table-dark">
                        <th scope="col">#</th>
                        <th scope="col">name</th>
                        <th scope="col">quantity</th>
                        <th scope="col">sale price</th>
                        <th scope="col">total</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($sells as $sale )
                    <tr>

                        <td>{{ $sale->id }}</td>
                        <td>{{ $sale->product_name }}</td>
                        <td>{{ $sale->quantity }}</td>
                        <td>{{ $sale->sell_price }}</td>
                        <td>{{ $sale->total }}</td>

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
                            <form id="form-id" action="/insert_sell" class="vstack gap-3" method="POST">
                                @csrf
                                <label>Product name</label>

                                <select name="product_id" class="form-control">
                                    @foreach($products as $product)
                                    <option value="{{ $product->id }}" >{{ $product->name }}</option>
                                    @endforeach
                                </select>


                                <label>Quantity</label>
                                <input type="text" name="quantity" class="form-control">
                                @error('quantity')
                                {{ $message }}
                                @enderror

                                <label>Sale price</label>
                                <input type="text" name="sell_price" class="form-control">
                                @error('sell_price')
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



</x-layout.layout>
