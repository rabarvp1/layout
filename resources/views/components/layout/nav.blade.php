@props(['navItems'])
<div class="sidebar sidebar-dark sidebar-main sidebar-expand-lg">

    <!-- Sidebar content -->
    <div class="sidebar-content">

        <!-- Sidebar header -->
        <div class="sidebar-section">
            <div class="sidebar-section-body d-flex justify-content-center">
                <h5 class="sidebar-resize-hide flex-grow-1 my-auto">Super Market</h5>

                <div>
                    <button type="button" class="btn btn-flat-white btn-icon btn-sm rounded-pill border-transparent sidebar-control sidebar-main-resize d-none d-lg-inline-flex">
                        <i class="ph-arrows-left-right"></i>
                    </button>

                    <button type="button" class="btn btn-flat-white btn-icon btn-sm rounded-pill border-transparent sidebar-mobile-main-toggle d-lg-none">
                        <i class="ph-x"></i>
                    </button>
                </div>
            </div>
        </div>


        <div class="sidebar-section">
            <ul class="nav nav-sidebar" data-nav-type="accordion">


                <li class="nav-item">
                    <a href="/" class="nav-link" class="nav-link">
                        <i class="ph-house"></i>
                        <span>
                            {{ __('index.dashboard') }}
                        </span>
                    </a>
                </li>
                <li class="nav-item nav-item-submenu">
                    <a href="javascript:void(0)" class="nav-link">
                        <i class="fa-solid fa-layer-group"></i> <!-- Solid (Free) -->
                        <span>{{ __('index.product') }}</span>
                    </a>
                    <ul class="nav-group-sub collapse">
                        <li class="nav-item"><a href="/product/view" class="nav-link ">{{ __('index.product') }}</a></li>
                        <li class="nav-item"><a href="/cat/view" class="nav-link">{{ __('index.Catigories') }}</a></li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="/sell/view" class="nav-link">
                        <i class="fa-solid fa-bag-shopping"></i>
                        <span>{{ __('index.sell') }}</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/buy/view" class="nav-link">
                        <i class="bi bi-bag"></i>
                        <span>{{ __('index.purchase') }}</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/storage/view" class="nav-link">
                        <i class="fa-solid fa-box-open"></i>
                        <span>{{ __('index.storage') }}</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/suplier/view" class="nav-link">
                        <i class="fa-solid fa-truck"></i>
                        <span>{{ __('index.supplier') }}</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/customer/view" class="nav-link">
                        <i class="fa-solid fa-address-card"></i>

                        <span>{{ __('index.customer') }}</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/users/view" class="nav-link">
                        <i class="fa-regular fa-user"></i>
                        <span>{{ __('index.user') }}</span>
                    </a>
                </li>
        </div>

    </div>

</div>
