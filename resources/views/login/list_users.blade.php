<x-layout.layout :navItems="[
    ['label' => __('index.back'), 'url' => url('/'), 'active' => false],
]">


    <div class=" mt-2">
        <table id="products-table" class="table ms-auto table-hover mt-2">
            <thead class="table-dark mt-2">
                <tr>
                    <th>#</th>
                    <th>{{ __('index.name') }}</th>
                    <th>{{ __('index.email') }}</th>
                    <th class="text-center"">{{ __('index.action') }}</th>
            </tr>

        </thead>
        <tbody>

            @foreach ($users as $user)
            <tr>
                <td> {{ $loop->iteration}}</td>
                <td> {{ $user->name }}</td>
                <td> {{ $user->email}}</td>

                <td>
                    <div class=" dropdown text-center">
                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ __('index.action') }}
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <form action="{{ url('/users/edit/' . $user->id) }}" method="GET" style="display: inline;">
                                    <button type="submit" class="dropdown-item">{{ __('index.edit') }} </button>
                                </form>
                            </li>

                            <li>
                                <form action="{{ url('/users/' . $user->id) }}" method="POST" style="display: inline;" onsubmit="return confirm(\'Are you sure you want to delete this user?\')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="dropdown-item text-danger">{{ __('index.delete') }}</button>
                                </form>
                            </li>
                        </ul>
    </div>
    </td>
    </tr>

    @endforeach
    </tbody>
    </div>





</x-layout.layout>
