<x-layout.layout :navItems="[
    ['label' => __('index.back'), 'url' => url('/customer'), 'active' => false],
]">
    <div class="card mt-4">
        <div class="card-header  d-flex align-items-center justify-content-between">
            <div class="modal-body ">
                <form id="form-id" action="{{ url('/customer/update/'.$customer->id) }}" class="vstack gap-3" method="POST">
                    @csrf
                    @method('PUT')
                    <label>{{ __('index.name_of_customer')}}</label>
                    <input type="text" name="name" class="form-control" value="{{ $customer->name }}">
                    @error('name')
                    {{ $message }}

                    @enderror
                    <label>{{ __('index.address') }} </label>
                    <input type="text" name="address" class="form-control" value="{{ $customer->address }}">
                    @error('address')
                    {{ $message }}

                    @enderror
                    <label>{{ __('index.phone_no') }}</label>
                    <input type="text" name="phone_number" class="form-control" value="{{ $customer->phone_number }}">
                    @error('phone_number')
                    {{ $message }}
                    @enderror
                    <button type="submit" class="btn btn-primary w-25 ">{{ __('index.updateing') }}</button>


                </form>
            </div>
        </div>
    </div>



</x-layout.layout>
