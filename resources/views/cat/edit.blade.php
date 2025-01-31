<x-layout.layout :navItems="[
    ['label' => 'Back', 'url' => url('/cat'), 'active' => false],
]">

<div class="modal-body ">
    <form id="form-id" action="{{ url('/cat/'.$cat->id) }}" class="vstack gap-3" method="POST">
        @csrf
        @method('PUT')
        <label>Name of Catigories</label>
        <input type="text" name="name" class="form-control" value="{{ $cat->name }}">
        @error('name')
        {{ $message }}
        @enderror

        <button type="submit" class="btn btn-primary">Update category</button>

    </form>
</div>
</x-layout.layout>
