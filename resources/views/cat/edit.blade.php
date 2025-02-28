<x-layout.layout :navItems="[
    ['label' => __('index.back'), 'url' => url('/cat'), 'active' => false],
]">

<div class="modal-body ">
    <form id="form-id" action="{{ url('/cat/update'.$cat->id) }}" class="vstack gap-3" method="POST">
        @csrf
        @method('PUT')
        <label>{{ __('index.name_of_category')}}</label>
        <input type="text" name="name" class="form-control" value="{{ $cat->name }}">
        @error('name')
        {{ $message }}
        @enderror

        <button type="submit" class="btn btn-primary">{{ __('index.updateing') }}</button>

    </form>
</div>
</x-layout.layout>
