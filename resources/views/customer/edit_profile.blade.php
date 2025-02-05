<x-layout.layout :navItems="[
    ['label' => __('index.back'), 'url' => 'javascript:window.history.back();', 'active' => false],
]">
    <h4 class="title">


@if ($customer_payment->type == 'Payments')
    {{ __('index.payment') }}
@elseif ($customer_payment->type == 'Receiving money')
    {{ __('index.receiving_money') }}

@endif

        ({{ $customer_payment->id }})</h4>

    <form id="form-id" action="{{ url('/customer/profile/'.$customer_payment->id.'/'.$customer->id) }}" class="vstack gap-3" method="POST">

        @csrf
        @method('PUT')




        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="amount">
                        {{ __('index.Amount_of_money') }}
                    </label>
                    <input type="text" class="form-control number_input_style" id="amount" name="amount" value="{{ $customer_payment->amount }}">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="type">
                        {{ __('index.type')}}
                    </label>
                    <select name="type" id="type" class="form-control">
                        <option value="">{{ __('index.choose_a_type') }}</option>
                        <option value="Receiving money" {{ $customer_payment->type == 'Receiving money' ? 'selected' : '' }}>
                            {{ __('index.receiving_money') }}
                        </option>
                        <option value="Payments" {{ $customer_payment->type == 'Payments' ? 'selected' : '' }}>
                            {{ __('index.payment') }}
                        </option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="created_at">
                        {{ __('index.created_at') }}
                    </label>
                    <input type="datetime-local" step="1" class="form-control" id="created_at" name="created_at" value="{{ $customer_payment->created_at }}">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="note">
                        {{ __('index.note') }}
                    </label>
                    <input type="text" class="form-control" id="note" name="note" value="{{ $customer_payment->note }}">
                </div>
            </div>
        </div>
        <div class=" justify-content-center" tabindex="-1">
            <button type="button" class="btn btn-secondary mt-3" onclick="window.history.back();">{{ __('index.back') }}</button>
            <button type="submit" class="btn btn-primary mt-3" id="update_method">{{ __('index.updateing') }}</button>
        </div>
    </form>



</x-layout.layout>
