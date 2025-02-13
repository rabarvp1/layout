<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ session('direction') }}">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Market</title>

	<!-- Global stylesheets -->
	<link href="/resources/fonts/inter/inter.css" rel="stylesheet" type="text/css">
	<link href="/resources/icons/phosphor/styles.min.css" rel="stylesheet" type="text/css">
	<link href="/resources/assets/css/{{ session('direction') }}/all.min.css" id="stylesheet" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<!-- Core JS files -->
    <script src="/resources/js/jquery/jquery.min.js"></script>
	<script src="/resources/js/bootstrap/bootstrap.bundle.min.js"></script>
	<script src="/resources/assets/js/app.js"></script>
	<script src="/resources/js/vendor/tables/datatables/datatables.min.js"></script>

    <x-layout.global-datatables />

</head>

<body>

	<!-- Main navbar -->
	<div class="navbar navbar-dark navbar-expand-lg navbar-static border-bottom border-bottom-white border-opacity-10">
		<div class="container-fluid">
			<div class="d-flex d-lg-none me-2">
				<button type="button" class="navbar-toggler sidebar-mobile-main-toggle rounded-pill">
					<i class="ph-list"></i>
				</button>
			</div>

			<div class="navbar-brand flex-1 flex-lg-0">
				<a href="index.html" class="d-inline-flex align-items-center">
                    <img src="/snawbar.png" class="-32px h-32px rounded-pill">
				</a>
			</div>

			<ul class="nav flex-row justify-content-end order-1 order-lg-2">
				<li class="nav-item nav-item-dropdown-lg dropdown ms-lg-2">
					<a href="javascript:void(0)" class="navbar-nav-link align-items-center rounded-pill p-1" data-bs-toggle="dropdown">
						<div class="status-indicator-container">
							<img src="/resources/images/demo/users/face12.jpg" class="-32px h-32px rounded-pill">
							<span class="status-indicator bg-success"></span>
						</div>
						<span class="d-none d-lg-inline-block mx-lg-2">{{ auth()->user()->name }}</span>
					</a>

					<div class="dropdown-menu dropdown-menu-end">
						<a href="javascript:void(0)" class="dropdown-item">
							<i class="ph-gear me-2"></i>
							Account settings
						</a>
						<a href="javascript:void(0)" class="dropdown-item" onclick="document.getElementById('logout_form').submit();">
                            <form method="POST" action="{{ route('logout') }}" id="logout_form">
                                @csrf
                            </form>
							<i class="ph-sign-out me-2"></i>
							Logout
						</a>
					</div>
				</li>
			</ul>
		</div>
	</div>
	<!-- /main navbar -->


	<!-- Page content -->
	<div class="page-content">

		<!-- Main sidebar -->
        <x-layout.nav />
		<!-- /main sidebar -->


		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Inner content -->
			<div class="content-inner">

				<!-- Page header -->
                @isset($header)
                 {{ $header }}
                @endisset
				<!-- /page header -->


				<!-- Content area -->
				<div class="content">
                    {{ $slot }}
				</div>
				<!-- /content area -->


				<!-- Footer -->
				<div class="navbar navbar-sm navbar-footer border-top">
					<div class="container-fluid">
						<span>&copy; 2022 <a href="https://themeforest.net/item/limitless-responsive-web-application-kit/13080328">Limitless Web App Kit</a></span>

						<ul class="nav">
							<li class="nav-item">
								<a href="https://kopyov.ticksy.com/" class="navbar-nav-link navbar-nav-link-icon rounded" target="_blank">
									<div class="d-flex align-items-center mx-md-1">
										<i class="ph-lifebuoy"></i>
										<span class="d-none d-md-inline-block ms-2">Support</span>
									</div>
								</a>
							</li>
							<li class="nav-item ms-md-1">
								<a href="https://themes.kopyov.com/limitless/demo/Documentation/index.html" class="navbar-nav-link navbar-nav-link-icon rounded" target="_blank">
									<div class="d-flex align-items-center mx-md-1">
										<i class="ph-file-text"></i>
										<span class="d-none d-md-inline-block ms-2">Docs</span>
									</div>
								</a>
							</li>
							<li class="nav-item ms-md-1">
								<a href="https://themeforest.net/item/limitless-responsive-web-application-kit/13080328?ref=kopyov" class="navbar-nav-link navbar-nav-link-icon text-primary bg-primary bg-opacity-10 fw-semibold rounded" target="_blank">
									<div class="d-flex align-items-center mx-md-1">
										<i class="ph-shopping-cart"></i>
										<span class="d-none d-md-inline-block ms-2">Purchase</span>
									</div>
								</a>
							</li>
						</ul>
					</div>
				</div>
				<!-- /footer -->

			</div>
			<!-- /inner content -->

		</div>
		<!-- /main content -->

	</div>
	<!-- /page content -->

</body>

</html>
