 <!DOCTYPE html>
 <html lang="en" class="h-full bg-white" >
 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
     <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

     <script src="https://unpkg.com/@tailwindcss/browser@4"></script>

     <title>Document</title>
 </head>

 <body class="h-full">

     <!--
  This example requires updating your template:

  ```
  <html class="h-full bg-white">
  <body class="h-full">
  ```
-->
     <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
         <div class="sm:mx-auto sm:w-full sm:max-w-sm">
             <img class="mx-auto h-35 w-auto" src="snawbar.png" alt="Your Company">
         </div>

         <div class="mt-7 sm:mx-auto sm:w-full sm:max-w-sm">
             <form class="space-y-6" action="#" method="POST">
                 <div>
                     <div class="mt-2">
                         <input placeholder="User" type="text" name="user" id="user" autocomplete="user" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-400 sm:text-sm/6 rounded-5">
                     </div>
                 </div>

                 <div>

                     <div class="mt-2">
                         <input placeholder="Password" type="password" name="password" id="password" autocomplete="current-password" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-400 sm:text-sm/6 rounded-5">
                     </div>
                 </div>

                 <div>
                    <a href="/">
                     <button type="button" class="flex w-full justify-center rounded-md bg-indigo-500 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-400 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 rounded-5">Sign in</button>
                    </a>
                 </div>
             </form>


         </div>
     </div>


 </body>
 </html>
