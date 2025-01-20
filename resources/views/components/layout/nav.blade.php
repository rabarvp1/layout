<nav class="navbar navbar-expand-lg bg-dark" data-bs-theme="dark">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 gap-4">
                <li class="nav-item ">
                    <a class="nav-link {{ Request::is('product') ? 'active' : '' }}" href="{{ route('product') }} " aria-current="page" href="/product">Product</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('buy') ? 'active' : '' }}" href="{{ route('buy') }}" href="/buy">Purchase</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('sell') ? 'active' : '' }}" href="{{ route('sell') }}" href="/sell">Invoice</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('cat') ? 'active' : '' }}" href="{{ route('cat') }}" href="/cat">Catigories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('income') ? 'active' : '' }}" href="{{ route('income') }}" href="/income">Income</a>
                </li>




            </ul>
            <ul class="navbar-nav ">
                <li class="nav-item ms-auto">
                    <a class="nav-link " href="">rabar</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
