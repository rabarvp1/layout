<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'en' ? 'ltr' : 'rtl' }}" >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}

    <title>Market</title>

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.14.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.14.1/jquery-ui.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">


    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="/css/all.css">
    <link rel="stylesheet" type="text/css" href="/css/login.css">
    <link rel="stylesheet" type="text/css" href="/css/dashbord.css">

    {{-- @stack('scripts') --}}
    <link rel="icon" type="image/png" href="{{ asset('snawbar.png') }}">
</head>

<body>
    @props(['navItems' => []])
    <x-layout.nav :navItems="$navItems"/>
      <div class="container mt-3 mb-2">
        {{ $slot }}
    </div>
    {{-- <script>
        $(document).ready(function() {
            // Set global DataTable defaults
            $.fn.dataTable.defaults = {
                searching: true,          // Enable search
                paging: false,             // Enable pagination
                lengthChange: false,      // Disable changing the number of entries per page
                pageLength: 10,           // Set default page length
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.11.5/i18n/English.json" // Set language file (you can change this dynamically)
                },
                order: [[0, 'asc']],      // Default sorting (first column ascending)
                dom: 'lfrtip',            // Layout of the table controls
                responsive: true,         // Enable responsive layout for smaller screens
            };

            // Initialize all DataTables with the global settings
            $('table').DataTable(); // This will apply to all tables in the DOM
        });</script> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>




</body>
</html>
