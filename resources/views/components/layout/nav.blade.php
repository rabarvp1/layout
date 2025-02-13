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

                <!-- Main -->
                <li class="nav-item-header pt-0">
                    <div class="text-uppercase fs-sm lh-sm opacity-50 sidebar-resize-hide">Main</div>
                    <i class="ph-dots-three sidebar-resize-show"></i>
                </li>
                {{-- <li class="nav-item">
                    <a href="/" class="nav-link ">
                        <i class="ph-house"></i>
                        <span>
                            Dashboard
                        </span>
                    </a>
                </li> --}}
                <li class="nav-item nav-item-submenu">
                    <a href="javascript:void(0)" class="nav-link">
                        <i class="ph-layout"></i>
                        <span>{{ __('index.product') }}</span>
                    </a>
                    <ul class="nav-group-sub collapse">
                        <li class="nav-item"><a href="/product/view" class="nav-link ">{{ __('index.product') }}</a></li>
                        <li class="nav-item"><a href="/cat/view" class="nav-link">{{ __('index.cat') }}</a></li>
                    </ul>
                </li>
                <li class="nav-item nav-item-submenu">
                    <a href="javascript:void(0)" class="nav-link">
                        <i class="ph-swatches"></i>
                        <span>{{ __('index.sell') }}</span>
                    </a>
                    <ul class="nav-group-sub collapse">
                        <li class="nav-item"><a href="/sell/view" class="nav-link ">{{ __('index.sell') }}</a></li>
                    </ul>
                </li>

                <li class="nav-item nav-item-submenu">
                    <a href="javascript:void(0)" class="nav-link">
                        <i class="ph-note-blank"></i>
                        <span>{{ __('index.purchase') }}</span>
                    </a>
                    <ul class="nav-group-sub collapse">
                        <li class="nav-item"><a href="/buy/view" class="nav-link">{{ __('index.buy') }}</a></li>
                    </ul>
                </li>


                <li class="nav-item nav-item-submenu">
                    <a href="javascript:void(0)" class="nav-link">
                        <i class="ph-list-numbers"></i>
                        <span>{{ __('index.storage') }}</span>
                    </a>
                    <ul class="nav-group-sub collapse">
                        <li class="nav-item"><a href="/storage/view" class="nav-link">{{ __('index.storage') }}</a></li>
                    </ul>
                </li>

                <li class="nav-item nav-item-submenu">
                    <a href="javascript:void(0)" class="nav-link">
                        <i class="ph-note-pencil"></i>
                        <span>{{ __('index.supplier') }}</span>
                    </a>
                    <ul class="nav-group-sub collapse">
                        <li class="nav-item"><a href="form_checkboxes_radios.html" class="nav-link">{{ __('index.supplier') }}</a></li>
                    </ul>
                </li>
                <li class="nav-item nav-item-submenu">
                    <a href="javascript:void(0)" class="nav-link">
                        <i class="ph-text-aa"></i>
                        <span>{{ __('index.customer') }}</span>
                    </a>
                    <ul class="nav-group-sub collapse">

                        <li class="nav-item"><a href="/customer/view" class="nav-link">{{ __('index.customer') }}</a></li>

                    </ul>
                </li>
                <li class="nav-item nav-item-submenu">
                    <a href="javascript:void(0)" class="nav-link">
                        <i class="ph-hand-pointing"></i>
                        <span>{{ __('index.user') }}</span>
                    </a>
                    <ul class="nav-group-sub collapse">
                        <li class="nav-item"><a href="/users/view" class="nav-link">{{ __('index.user') }}</a></li>
                    </ul>
                </li>

                </li>



            </ul>
        </div>

    </div>

</div>
