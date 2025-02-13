 <!DOCTYPE html>
 <html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'en' ? 'ltr' : 'rtl' }}" class="h-full bg-white">
 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="ie=edge">
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

     <title>Login</title>
 </head>

 <body class="h-full">

     <!-- Page content -->
     <div class="page-content">

         <!-- Main content -->
         <div class="content-wrapper">

             <!-- Inner content -->
             <div class="content-inner ">

                 <!-- Content area -->
                 <div class="content d-flex justify-content-center align-items-center">

                     <!-- Login form -->
                     <form class="login-form" action="/login" method="POST">
                         @csrf
                         <div class="card mb-0 rounded-5">
                             <div class="card-body">
                                 <div class="text-center mb-3">
                                     <div class="d-inline-flex align-items-center justify-content-center mb-4 mt-2">
                                         <img src="/snawbar.png" class="h-80px" alt="">
                                     </div>
                                     <h5 class="mb-0">Login to your account</h5>
                                     <span class="d-block text-muted">Enter your credentials below</span>
                                 </div>

                                 <div class="mb-3">
                                     <label class="form-label">Username</label>
                                     <div class="form-control-feedback form-control-feedback-start">
                                         <input type="text" class="form-control" placeholder="john@doe.com" name="email">
                                         <div class="form-control-feedback-icon">
                                             <i class="ph-user-circle text-muted"></i>
                                         </div>
                                     </div>
                                 </div>

                                 <div class="mb-3">
                                     <label class="form-label">Password</label>
                                     <div class="form-control-feedback form-control-feedback-start">
                                         <input type="password" class="form-control" placeholder="•••••••••••" name="password">
                                         <div class="form-control-feedback-icon">
                                             <i class="ph-lock text-muted"></i>
                                         </div>
                                     </div>
                                 </div>



                                 <div class="mb-3">
                                     <button type="submit" class="btn btn-primary w-100">Sign in</button>
                                 </div>








                             </div>
                         </div>
                     </form>
                     <!-- /login form -->

                 </div>
                 <!-- /content area -->



             </div>
             <!-- /inner content -->

         </div>
         <!-- /main content -->

     </div>
     <!-- /page content -->


     {{--
     <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
         <div class="sm:mx-auto sm:w-full sm:max-w-sm">
             <img class="mx-auto h-35 w-auto" src="snawbar.png" alt="Your Company">
         </div>

         <div class="mt-7 sm:mx-auto sm:w-full sm:max-w-sm">
             @if(session('error'))
             <div class="alert alert-danger">{{ session('error') }}</div>
     @endif
     <form class="space-y-6" action="/login" method="POST">
         @csrf
         <div>
             <div class="mt-2">
                 <input placeholder="{{ __('index.email') }}" type="text" name="email" id="email" value="{{ old('email') }}" autocomplete="email" class="block w-full rounded-md border-2 border-gray-100 @error('email') border-red-300 @enderror bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-400 sm:text-sm/6 rounded-5">
                 @error('email')
                 <div class="text-danger mt-1">{{ $message }}</div>
                 @enderror
             </div>
         </div>

         <div>

             <div class="mt-2">
                 <input placeholder="{{ __('index.password') }}" type="password" name="password" id="password" autocomplete="current-password" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-400 sm:text-sm/6 rounded-5">
                 @error('password')
                 <div class="text-danger mt-1">{{ $message }}</div>
                 @enderror
             </div>
         </div>

         <div>

             <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-500 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-400 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 rounded-5">
                 {{ __('index.login') }}
             </button>
         </div>
     </form>


     </div>
     </div> --}}


 </body>
 </html>
