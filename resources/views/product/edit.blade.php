<x-layout.layout :navItems="[
    ['label' => __('index.back'), 'url' => url('/'), 'active' => false],
]">
    <form action="{{ url('/product/'.$product->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label for="name">{{ __('index.product_name') }}</label>
            <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
        </div>




        <div class="form-group">
            <label for="cat_id">{{ __('index.cat') }}</label>
            <select name="cat_id" class="form-control" required>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $category->id == $product->cat_id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
<br>
        <button type="submit" class="btn btn-primary">{{ __('index.updateing') }}</button>
    </form>




</x-layout.layout>
