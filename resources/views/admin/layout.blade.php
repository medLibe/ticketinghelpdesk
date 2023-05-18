<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="images/favicon.ico" type="image/ico" />
    <title>Helpdesk Ticketing System | {{ $title }}</title>

    <link href="cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link href="/assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="/assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <link href="/assets/vendors/nprogress/nprogress.css" rel="stylesheet">

    <link href="/assets/vendors/iCheck/skins/flat/green.css" rel="stylesheet">

    <link href="/assets/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">

    <link href="/assets/vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet" />

    <link href="/assets/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <link href="/assets/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="/assets/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="/assets/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="/assets/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="/assets/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <link href="/assets/build/css/custom.min.css" rel="stylesheet">

    <script src="/assets/vendors/jquery/dist/jquery.min.js"></script>

    <script src="/assets/vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

    <meta name="robots" content="index, nofollow">
</head>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            @include('sweetalert::alert')
            @include('admin.navbar')

            @yield('content')

            <footer>
                <div class="pull-right">
                </div>
                <div class="clearfix"></div>
            </footer>

        </div>
    </div>

    <script src="/assets/vendors/fastclick/lib/fastclick.js"></script>

    <script src="/assets/vendors/nprogress/nprogress.js"></script>

    <script src="/assets/vendors/Chart.js/dist/Chart.min.js"></script>

    <script src="/assets/vendors/gauge.js/dist/gauge.min.js"></script>

    <script src="/assets/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>

    <script src="/assets/vendors/iCheck/icheck.min.js"></script>

    <script src="/assets/vendors/skycons/skycons.js"></script>

    <script src="/assets/vendors/Flot/jquery.flot.js"></script>
    <script src="/assets/vendors/Flot/jquery.flot.pie.js"></script>
    <script src="/assets/vendors/Flot/jquery.flot.time.js"></script>
    <script src="/assets/vendors/Flot/jquery.flot.stack.js"></script>
    <script src="/assets/vendors/Flot/jquery.flot.resize.js"></script>

    <script src="/assets/vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="/assets/vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="/assets/vendors/flot.curvedlines/curvedLines.js"></script>

    <script src="/assets/vendors/DateJS/build/date.js"></script>

    <script src="/assets/vendors/jqvmap/dist/jquery.vmap.js"></script>
    <script src="/assets/vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="/assets/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>

    <script src="/assets/vendors/moment/min/moment.min.js"></script>
    <script src="/assets/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

    <script src="/assets/build/js/custom.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

    <script src="/assets/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="/assets/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="/assets/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="/assets/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="/assets/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="/assets/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="/assets/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="/assets/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="/assets/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="/assets/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="/assets/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="/assets/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="/assets/vendors/jszip/dist/jszip.min.js"></script>
    <script src="/assets/vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="/assets/vendors/pdfmake/build/vfs_fonts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</body>

</html>
