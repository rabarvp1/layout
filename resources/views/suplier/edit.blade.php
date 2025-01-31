<x-layout.layout :navItems="[
    ['label' => 'Back', 'url' => url('/suplier'), 'active' => false],
]">
    <div class="card mt-4">
        <div class="card-header  d-flex align-items-center justify-content-between">
            <div class="">
                <form id="form-id" action="{{ url('/suplier/'.$suplier->id) }}" class="vstack gap-3" method="POST">
                    @csrf
                    @method('PUT')
                    <label>Name of Customer</label>
                    <input type="text" name="name" class="form-control" value="{{ $suplier->name }}">
                    @error('name')
                    {{ $message }}

                    @enderror
                    <label>Address</label>
                    <input type="text" name="address" class="form-control" value="{{ $suplier->address }}">
                    @error('address')
                    {{ $message }}

                    @enderror
                    <label>Phone Number</label>
                    <input type="text" name="phone_number" class="form-control" value="{{ $suplier->phone_number }}">
                    @error('phone_number')
                    {{ $message }}
                    @enderror
                    <button type="submit" class="btn btn-primary w-25 ">Update Supplier</button>


                </form>
            </div>
        </div>
    </div>



</x-layout.layout>
