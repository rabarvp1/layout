<x-layout.layout :navItems="[
    ['label' => 'Back', 'url' => url('/'), 'active' => false],
]">
    <div class="card-body text-center table-responsive">

        <input type="text" name="search_product" id="tags" class="form-control w-25 mb-3" placeholder="Search for products">
        @error('search_product')
        {{ $message }}
        @enderror
        <table class="table table-bordered table-sm w-100 table-hover">
            <thead>
                <tr class="table-secondary">
                    <th class="text-center"><i class="fas fa-sort-numeric-down"></i></th>
                    <th class="text-center">Product</th>
                    <th class="text-center">Quantity</th>
                    <th class="text-center">AVG Cost</th>
                    <th class="text-center">Category</th>
                </tr>
            </thead>
            <tbody class="text-center" id="storage">

                {{ $count=null }}

                @foreach ($storage as $item )
                @php
                // Set color based on quantity value
                $quantityColor = '';
                if ($item->quantity == 0) {
                $quantityColor = 'text-bg-danger'; // Red for quantity 0
                } elseif ($item->quantity < 5) { $quantityColor='text-bg-warning' ; // Yellow for quantity less than 5
                 } @endphp <tr>
                    <td>{{ $count=$count+1 }}</td>
                    <td>{{ $item->product_name }}</td>
                    <td class="{{ $quantityColor }}">{{ $item->quantity }}</td>
                    <td>${{ $item->avg_cost }}</td>
                    <td>{{ $item->cat_name }}</td>
                    </tr>
                    @endforeach

            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://code.jquery.com/ui/1.14.1/jquery-ui.js"></script>




</x-layout.layout>
