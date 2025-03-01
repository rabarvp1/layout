<x-layout.layout>
    @php
    $roles = DB::table('roles')
    ->where('user_id', auth()->user()->id)
    ->pluck('name');

    @endphp


    <div class="row mx-5" id="body">

        @if (checkPermission('product'))

        <div class="col-xl-3 col-lg-3 col-6 text-center mb-4 ">
            <a href="/product/view" class=" link-underline link-underline-opacity-0">
                <div class=" d-flex justify-content-between align-items-center   card-shadow btn_icon product-color rounded-4 mt-4 ">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 2048 2048">
                        <rect width="2048" height="2048" fill="none" />
                        <path fill="#f4efef" d="m1344 2l704 352v785l-128-64V497l-512 256v258l-128 64V753L768 497v227l-128-64V354zm0 640l177-89l-463-265l-211 106zm315-157l182-91l-497-249l-149 75zm-507 654l-128 64v-1l-384 192v455l384-193v144l-448 224L0 1735v-676l576-288l576 288zm-640 710v-455l-384-192v454zm64-566l369-184l-369-185l-369 185zm576-1l448-224l448 224v527l-448 224l-448-224zm384 576v-305l-256-128v305zm384-128v-305l-256 128v305zm-320-288l241-121l-241-120l-241 120z" />
                    </svg>
                    <span class=" mt-2 ">{{ __('index.product') }}</span>
                </div>
            </a>
        </div>
        @endif

        @if (checkPermission('cat'))

        <div class="col-xl-3 col-lg-3 col-6 text-center mb-4 ">
            <a href="/cat/view" class=" link-underline link-underline-opacity-0">
                <div class=" d-flex justify-content-between align-items-center  card-shadow btn_icon product-color rounded-4 mt-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 32 32">
                        <rect width="32" height="32" fill="none" />
                        <path fill="#f4efef" d="M29 10h-5v2h5v6h-7v2h3v2.142a4 4 0 1 0 2 0V20h2a2.003 2.003 0 0 0 2-2v-6a2 2 0 0 0-2-2m-1 16a2 2 0 1 1-2-2a2.003 2.003 0 0 1 2 2M19 6h-5v2h5v6h-7v2h3v6.142a4 4 0 1 0 2 0V16h2a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2m-1 20a2 2 0 1 1-2-2a2.003 2.003 0 0 1 2 2M9 2H3a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h2v10.142a4 4 0 1 0 2 0V12h2a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2M8 26a2 2 0 1 1-2-2a2 2 0 0 1 2 2M3 10V4h6l.002 6z" />
                    </svg>
                    <span class=" mt-2 ">{{ __('index.Catigories') }}</span>
                </div>
            </a>
        </div>
        @endif

        @if (checkPermission('storage'))

        <div class="col-xl-3 col-lg-3 col-6 text-center mb-4 ">
            <a href="/storage/view" class=" link-underline link-underline-opacity-0">
                <div class=" d-flex justify-content-between align-items-center  card-shadow btn_icon inventory-color rounded-4 mt-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 16 16">
                        <rect width="16" height="16" fill="none" />
                        <path fill="#f4efef" d="M16 4L7.94 0L0 4v1h1v11h2V7h10v9h2V5h1zM4 6V5h2v1zm3 0V5h2v1zm3 0V5h2v1z" />
                        <path fill="#f4efef" d="M6 9H5V8H4v3h3V8H6zm0 4H5v-1H4v3h3v-3H6zm4 0H9v-1H8v3h3v-3h-1z" />
                    </svg>
                    <span class=" mt-2 ">{{ __('index.storage') }}</span>
                </div>
            </a>
        </div>
        @endif

        @if (checkPermission('purchase'))

        <div class="col-xl-3 col-lg-3 col-6 text-center mb-4 ">
            <a href="/buy/view" class=" link-underline link-underline-opacity-0">
                <div class=" d-flex justify-content-between align-items-center  card-shadow btn_icon product-color rounded-4 mt-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 32 32">
                        <rect width="32" height="32" fill="none" />
                        <path fill="#f4efef" d="M16 3c-2.746 0-5 2.254-5 5v1H6.062L6 9.938l-1 18L4.937 29h22.125L27 27.937l-1-18L25.937 9H21V8c0-2.746-2.254-5-5-5m0 2a3 3 0 0 1 3 3v1h-6V8a3 3 0 0 1 3-3m-8.063 6H11v3h2v-3h6v3h2v-3h3.063l.875 16H7.063z" />
                    </svg>

                    <span class="mt-2 ">{{ __('index.purchase')}}</span>
                </div>
            </a>
        </div>
        @endif

        @if (checkPermission('sell'))

        <div class="col-xl-3 col-lg-3 col-6 text-center mb-4 ">
            <a href="/sell/view" class=" link-underline link-underline-opacity-0">
                <div class=" d-flex justify-content-between align-items-center card-shadow btn_icon sale-color rounded-4 mt-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 50 50">
                        <rect width="50" height="50" fill="none" />
                        <circle cx="44" cy="42" r="4" fill="#f4efef" />
                        <circle cx="15" cy="42" r="4" fill="#f4efef" />
                        <path fill="#f4efef" d="M47 33H15.771l.667-1.082c.286-.464.37-1.025.233-1.553l-.651-2.506l28.983-1.506C46.102 26.297 47 25.35 47 24.25V11c0-1.1-.9-2-2-2H11.119l-.391-1.503A2 2 0 0 0 8.792 6H2a2 2 0 0 0 0 4h5.246l5.34 20.545l-2.1 3.405a2 2 0 0 0-.043 2.024A2 2 0 0 0 12.188 37H47a2 2 0 0 0 0-4" />
                    </svg>
                    <span class=" mt-2 ">{{ __('index.sell') }}</span>
                </div>
            </a>
        </div>
        @endif

        @if (checkPermission('customer'))

        <div class="col-xl-3 col-lg-3 col-6 text-center mb-4 ">
            <a href="/customer/view" class=" link-underline link-underline-opacity-0">
                <div class=" d-flex justify-content-between align-items-center card-shadow btn_icon sale-color rounded-4 mt-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 32 32">
                        <rect width="32" height="32" fill="none" />
                        <path fill="#f4efef" d="M28.523 23.813c-.518-.51-6.795-2.938-7.934-3.396c-1.133-.45-1.585-1.697-1.585-1.697s-.51.282-.51-.51c0-.793.51.51 1.02-2.548c0 0 1.415-.397 1.134-3.68h-.34s.85-3.51 0-4.698c-.853-1.188-1.187-1.98-3.06-2.548c-1.87-.567-1.19-.454-2.548-.396c-1.36.057-2.492.793-2.492 1.188c0 0-.85.057-1.188.397c-.34.34-.906 1.924-.906 2.32s.283 3.06.566 3.624l-.337.11c-.283 3.284 1.132 3.682 1.132 3.682c.51 3.058 1.02 1.755 1.02 2.548c0 .792-.51.51-.51.51s-.453 1.246-1.585 1.697c-1.132.453-7.416 2.887-7.927 3.396c-.51.52-.453 2.896-.453 2.896h12.036l.878-3.46l-.78-.78l1.343-1.345l1.343 1.344l-.78.78l.878 3.46h12.036s.063-2.378-.453-2.897z" />
                    </svg>
                    <span class=" mt-2 ">{{ __('index.customer') }}</span>
                </div>
            </a>
        </div>
        @endif

        @if (checkPermission('supplier'))

        <div class="col-xl-3 col-lg-3 col-6 text-center mb-4 ">
            <a href="/suplier/view" id="btn" class=" link-underline link-underline-opacity-0 supp">
                <div class=" dash-card d-flex justify-content-between align-items-center card-shadow btn_icon product-color mt-3  ">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 14 14">
                        <rect width="14" height="14" fill="none" />
                        <g fill="none" stroke="#f4efef" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9.159 10.89V4.104a1 1 0 0 0-1-1H1.702a1 1 0 0 0-1 1v6.626a1 1 0 0 0 1 1h.75m10.846-3.893H9.16m2.792 3.706h.345a1 1 0 0 0 1-1v-3L11.904 4.69a1 1 0 0 0-.898-.56H9.339" />
                            <path d="M2.502 11.76a1.396 1.396 0 1 0 2.792 0a1.396 1.396 0 1 0-2.792 0m6.337 0a1.396 1.396 0 1 0 2.792 0a1.396 1.396 0 1 0-2.792 0m-.262-.03H5.64" />
                        </g>
                    </svg>
                    <span class=" mt-2">{{ __('index.supplier') }}</span>
                </div>
            </a>
        </div>
        @endif

        @if (checkPermission('supplier'))

        <div class="col-xl-3 col-lg-3 col-6 text-center mb-4 ">
            <a href="/suplier/view" id="btn" class=" link-underline link-underline-opacity-0 supp">
                <div class=" dash-card d-flex justify-content-between align-items-center card-shadow btn_icon product-color mt-3  ">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 14 14">
                        <rect width="14" height="14" fill="none" />
                        <g fill="none" stroke="#f4efef" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9.159 10.89V4.104a1 1 0 0 0-1-1H1.702a1 1 0 0 0-1 1v6.626a1 1 0 0 0 1 1h.75m10.846-3.893H9.16m2.792 3.706h.345a1 1 0 0 0 1-1v-3L11.904 4.69a1 1 0 0 0-.898-.56H9.339" />
                            <path d="M2.502 11.76a1.396 1.396 0 1 0 2.792 0a1.396 1.396 0 1 0-2.792 0m6.337 0a1.396 1.396 0 1 0 2.792 0a1.396 1.396 0 1 0-2.792 0m-.262-.03H5.64" />
                        </g>
                    </svg>
                    <span class=" mt-2">{{ __('index.supplier') }}</span>
                </div>
            </a>
        </div>
        @endif

        @if (checkPermission('supplier'))

        <div class="col-xl-3 col-lg-3 col-6 text-center mb-4 ">
            <a href="/suplier/view" id="btn" class=" link-underline link-underline-opacity-0 supp">
                <div class=" dash-card d-flex justify-content-between align-items-center card-shadow btn_icon product-color mt-3  ">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 14 14">
                        <rect width="14" height="14" fill="none" />
                        <g fill="none" stroke="#f4efef" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9.159 10.89V4.104a1 1 0 0 0-1-1H1.702a1 1 0 0 0-1 1v6.626a1 1 0 0 0 1 1h.75m10.846-3.893H9.16m2.792 3.706h.345a1 1 0 0 0 1-1v-3L11.904 4.69a1 1 0 0 0-.898-.56H9.339" />
                            <path d="M2.502 11.76a1.396 1.396 0 1 0 2.792 0a1.396 1.396 0 1 0-2.792 0m6.337 0a1.396 1.396 0 1 0 2.792 0a1.396 1.396 0 1 0-2.792 0m-.262-.03H5.64" />
                        </g>
                    </svg>
                    <span class=" mt-2">{{ __('index.supplier') }}</span>
                </div>
            </a>
        </div>
        @endif

        @if (checkPermission('supplier'))

        <div class="col-xl-3 col-lg-3 col-6 text-center mb-4 ">
            <a href="/suplier/view" id="btn" class=" link-underline link-underline-opacity-0 supp">
                <div class=" dash-card d-flex justify-content-between align-items-center card-shadow btn_icon product-color mt-3  ">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 14 14">
                        <rect width="14" height="14" fill="none" />
                        <g fill="none" stroke="#f4efef" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9.159 10.89V4.104a1 1 0 0 0-1-1H1.702a1 1 0 0 0-1 1v6.626a1 1 0 0 0 1 1h.75m10.846-3.893H9.16m2.792 3.706h.345a1 1 0 0 0 1-1v-3L11.904 4.69a1 1 0 0 0-.898-.56H9.339" />
                            <path d="M2.502 11.76a1.396 1.396 0 1 0 2.792 0a1.396 1.396 0 1 0-2.792 0m6.337 0a1.396 1.396 0 1 0 2.792 0a1.396 1.396 0 1 0-2.792 0m-.262-.03H5.64" />
                        </g>
                    </svg>
                    <span class=" mt-2">{{ __('index.supplier') }}</span>
                </div>
            </a>
        </div>
        @endif

        @if (checkPermission('user'))

        <div class="col-xl-3 col-lg-3 col-6 text-center mb-4 ">
            <a href="/users/view" class=" link-underline link-underline-opacity-0">
                <div class=" dash-card d-flex justify-content-between align-items-center card-shadow btn_icon report-color mt-3  ">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 640 512">
                        <rect width="640" height="512" fill="none" />
                        <path fill="currentColor" d="M144 160a80 80 0 1 0 0-160a80 80 0 1 0 0 160m368 0a80 80 0 1 0 0-160a80 80 0 1 0 0 160M0 298.7C0 310.4 9.6 320 21.3 320h214c-26.6-23.5-43.3-57.8-43.3-96c0-7.6.7-15 1.9-22.3c-13.6-6.3-28.7-9.7-44.6-9.7h-42.7C47.8 192 0 239.8 0 298.7M320 320c24 0 45.9-8.8 62.7-23.3c2.5-3.7 5.2-7.3 8-10.7c2.7-3.3 5.7-6.1 9-8.3C410 262.3 416 243.9 416 224c0-53-43-96-96-96s-96 43-96 96s43 96 96 96m65.4 60.2c-10.3-5.9-18.1-16.2-20.8-28.2H261.4C187.7 352 128 411.7 128 485.3c0 14.7 11.9 26.7 26.7 26.7h300.6c-2.1-5.2-3.2-10.9-3.2-16.4v-3c-1.3-.7-2.7-1.5-4-2.3l-2.6 1.5c-16.8 9.7-40.5 8-54.7-9.7c-4.5-5.6-8.6-11.5-12.4-17.6l-.1-.2l-.1-.2l-2.4-4.1l-.1-.2l-.1-.2c-3.4-6.2-6.4-12.6-9-19.3c-8.2-21.2 2.2-42.6 19-52.3l2.7-1.5v-4.6l-2.7-1.5zM533.3 192h-42.7c-15.9 0-31 3.5-44.6 9.7c1.3 7.2 1.9 14.7 1.9 22.3c0 17.4-3.5 33.9-9.7 49c2.5.9 4.9 2 7.1 3.3l2.6 1.5c1.3-.8 2.6-1.6 4-2.3v-3c0-19.4 13.3-39.1 35.8-42.6c7.9-1.2 16-1.9 24.2-1.9s16.3.6 24.2 1.9c22.5 3.5 35.8 23.2 35.8 42.6v3c1.3.7 2.7 1.5 4 2.3l2.6-1.5c16.8-9.7 40.5-8 54.7 9.7c2.3 2.8 4.5 5.8 6.6 8.7c-2.1-57.1-49-102.7-106.6-102.7zm91.3 163.9c6.3-3.6 9.5-11.1 6.8-18c-2.1-5.5-4.6-10.8-7.4-15.9l-2.3-4c-3.1-5.1-6.5-9.9-10.2-14.5c-4.6-5.7-12.7-6.7-19-3l-2.9 1.7c-9.2 5.3-20.4 4-29.6-1.3s-16.1-14.5-16.1-25.1v-3.4c0-7.3-4.9-13.8-12.1-14.9c-6.5-1-13.1-1.5-19.9-1.5s-13.4.5-19.9 1.5c-7.2 1.1-12.1 7.6-12.1 14.9v3.4c0 10.6-6.9 19.8-16.1 25.1s-20.4 6.6-29.6 1.3l-2.9-1.7c-6.3-3.6-14.4-2.6-19 3c-3.7 4.6-7.1 9.5-10.2 14.6l-2.3 3.9c-2.8 5.1-5.3 10.4-7.4 15.9c-2.6 6.8.5 14.3 6.8 17.9l2.9 1.7c9.2 5.3 13.7 15.8 13.7 26.4s-4.5 21.1-13.7 26.4l-3 1.7c-6.3 3.6-9.5 11.1-6.8 17.9c2.1 5.5 4.6 10.7 7.4 15.8l2.4 4.1c3 5.1 6.4 9.9 10.1 14.5c4.6 5.7 12.7 6.7 19 3l2.9-1.7c9.2-5.3 20.4-4 29.6 1.3s16.1 14.5 16.1 25.1v3.4c0 7.3 4.9 13.8 12.1 14.9c6.5 1 13.1 1.5 19.9 1.5s13.4-.5 19.9-1.5c7.2-1.1 12.1-7.6 12.1-14.9V492c0-10.6 6.9-19.8 16.1-25.1s20.4-6.6 29.6-1.3l2.9 1.7c6.3 3.6 14.4 2.6 19-3c3.7-4.6 7.1-9.4 10.1-14.5l2.4-4.2c2.8-5.1 5.3-10.3 7.4-15.8c2.6-6.8-.5-14.3-6.8-17.9l-3-1.7c-9.2-5.3-13.7-15.8-13.7-26.4s4.5-21.1 13.7-26.4l3-1.7zM472 384a40 40 0 1 1 80 0a40 40 0 1 1-80 0" />
                    </svg>

                    {{ __('index.user') }}
                </div>
            </a>
         </div>

         @endif

           <div class="mt-5" id="div-test"></div>


         </div>


    <script>
        $(document).ready(function() {

            $(".supp").click(function() {
                console.log("hello");
                $(this).attr("href","#");



                $.ajax({

                    url: "/test"
                    , type: "GET"
                    , success: function(response) {
                        $("#div-test").html(response.table);
                    }
                });


            });


        });

    </script>


</x-layout.layout>
