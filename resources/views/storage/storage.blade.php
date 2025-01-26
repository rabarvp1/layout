
<x-layout.layout>
    <div class="card-body text-center table-responsive">
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
            <tbody class="text-center">

                {{ $count=null }}

                @foreach ($storage as $item )

                <tr>
                    <td>{{ $count=$count+1 }}</td>
                    <td>{{ $item->product_name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>${{ $item->avg_cost }}</td>
                    <td>{{ $item->cat_name}}</td>
                </tr>

                @endforeach


            </tbody>
        </table>
    </div>



</x-layout.layout>
