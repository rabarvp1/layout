<x-layout.layout :navItems="[
    ['label' => __('index.back'), 'url' => url('/users'), 'active' => false],
]">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('index.edit_user') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('update_user', $user->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">{{ __('index.name') }}</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('index.email') }}</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('index.password') }}</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>

                        <button type="submit" class="btn btn-primary">{{ __('index.updateing') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</x-layout.layout>
