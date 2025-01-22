<x-layout.layout>
    <div class="card mt-4">
        <div class="card-header  d-flex align-items-center justify-content-between">
            <h1>Purchase</h1>
            <button class="btn btn-primary w-70 h-70 rounded-5 " data-bs-toggle="modal" data-bs-target="#exampleModal">BuyProduct</button></a>
        </div>
        <div class="card-body">
            <table class="table  mx-auto table-hover">
                <thead>
                    <tr class="table-dark">
                        <th scope="col">#</th>
                        <th scope="col">order number</th>
                        <th scope="col">discount</th>
                        <th scope="col">Note</th>
                        <th scope="col">Created At</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($purchases  as $purchase)
                    <tr>
                        <th scope="row">{{ $purchase->id }}</th>
                        <td>{{ $purchase->order_number }}</td>
                        <td>{{ $purchase->discount }}</td>
                        <td>{{ $purchase->note }}</td>
                        <td>{{ $purchase->created_at }}</td>




                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">New Purchase Order</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body ">
                            <form id="form-id" action="/insert" class="vstack gap-3" method="POST">
                                @csrf
                                <label>Supliers</label>
                                <select name="suplier" class=" form-control ">
                                    @foreach($supliers as $suplier)
                                    <option value="{{ $suplier->id }}" {{ old('cat_id') == $suplier->id ? 'selected' : '' }}>{{ $suplier->name }}</option>
                                    @endforeach
                                </select>

                                <label>Note</label>
                                <input type="text" name="note" class="form-control">
                                @error('note')
                                {{ $message }}
                                @enderror

                                <label>search products</label>
                                <input type="text" name="search_product" id="tags" class="form-control">
                                @error('search_product')
                                {{ $message }}
                                @enderror

  <table class="table  mx-auto table-hover">

                <thead>
                    <tr class="table-dark">
                        <th scope="col">Product Name</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Buy Price</th>
                        <th scope="col">Single Price</th>
                        <th scope="col">Multi Price</th>
                        <th scope="col">Action</th>

                    </tr>
                </thead>
                <tbody id="productTableBody">

                </tbody>
            </table>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" form="form-id" class="btn btn-primary">Buy</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

       <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
       <script src="https://code.jquery.com/ui/1.14.1/jquery-ui.js"></script>
      <script>
        $(document).ready(function () {
  $("#tags").autocomplete({
    source: function (request, response) {
      $.ajax({
        url: "/buy/getData", // Laravel route to fetch products
        type: "GET",
        data: { search: request.term }, // Send search term
        dataType: "json",
        success: function (data) {
          response(data);
        },
      });
    },
    minLength: 2, // Minimum characters before searching
    select: function (event, ui) {
        $('#productTableBody').append(ui.item.html);
    },
    appendTo: "#exampleModal", // Ensure dropdown works inside the modal
  });
});

        </script>

</x-layout.layout>
