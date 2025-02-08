@props(['navItems'])

<nav class="navbar navbar-expand-lg bg-dark" data-bs-theme="dark">
    <a class="navbar-brand px-3" href="/">
        <img src="{{ asset('snawbar.png') }}" alt="Logo" width="50">
    </a>
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav me-auto mb-2 mb-lg-0 gap-4">

                @foreach ($navItems as $item)
                <li class="nav-item hover-enable {{ $item['active'] ? 'active' : '' }}">
                    <a class="nav-link" href="{{ $item['url'] }}">{{ $item['label'] }}</a>
                </li>
                @endforeach

            </ul>

            <ul class="navbar-nav">
                <li class="nav-item ms-auto">
                    <a class="nav-link" href="">@auth
                        {{ Auth::user()->name }}
                        @endauth</a>
                </li>
              
                <li class="nav-item ms-3">

                    <div class="dropdown text-center">
                        <button class="btn btn-dark  dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ __('index.language') }}
                        </button>
                        <form action="{{ route('change-lang') }}" method="POST">
                            @csrf
                            <ul class="dropdown-menu">
                                <li>
                                    <button type="submit" name="locale" value="en" class="dropdown-item">English</button>
                                </li>
                                <li>
                                    <button type="submit" name="locale" value="ku" class="dropdown-item">کوردی</button>
                                </li>
                                <li>
                                    <button type="submit" name="locale" value="ar" class="dropdown-item">العربية</button>
                                </li>
                            </ul>
                        </form>
                    </div>
                </li>
                <li class="nav-item ms-auto">
                    <form action="/logout" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger">{{ __('index.logout') }}</button>
                    </form>
                </li>


            </ul>
        </div>
    </div>
</nav>
