@extends('main')
@section('image')
<img src="assets/img/sora.jpg" class="navbar-logo" alt="logo">
@endsection
@section('head')
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
<title>الفاتورة الإلكترونية </title>
<link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
<link href="assets/css/loader.css" rel="stylesheet" type="text/css" />
<script src="assets/js/loader.js"></script>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="assets/css/plugins.css" rel="stylesheet" type="text/css" />
<!-- END GLOBAL MANDATORY STYLES -->

<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="plugins/table/datatable/datatables.css">
<link rel="stylesheet" type="text/css" href="plugins/table/datatable/dt-global_style.css">
<link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
<link href="assets/css/loader.css" rel="stylesheet" type="text/css" />
<script src="assets/js/loader.js"></script>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="assets/css/plugins.css" rel="stylesheet" type="text/css" />
<!-- END GLOBAL MANDATORY STYLES -->

<!-- BEGIN PAGE LEVEL CUSTOM STYLES -->
<link rel="stylesheet" type="text/css" href="plugins/table/datatable/datatables.css">
<link rel="stylesheet" type="text/css" href="plugins/table/datatable/custom_dt_html5.css">
<link rel="stylesheet" type="text/css" href="plugins/table/datatable/dt-global_style.css">
<link href="assets/css/scrollspyNav.css" rel="stylesheet" type="text/css" />
<link href="assets/css/components/custom-carousel.css" rel="stylesheet" type="text/css" />
<style>
    .online-actions {
        display: none;
    }

    #html5-extension td {
        font-size: 20px;
        font-weight: bold;
        text-align: center
    }

    #html5-extension th {
        text-align: center
    }

    .navbar-expand-sm {
        justify-content: center
    }
</style>
@endsection
@section('page')
الصفحة الرئيسية
@endsection

@section('content')
<div class="container" style="max-width: 928px;">
    <div class="row">
        <div class="col-lg-12 col-md-12 mb-5 p-0">
            <div id="style1" class="carousel slide style-custom-1" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#style1" data-slide-to="0" class="active"></li>
                    <li data-target="#style1" data-slide-to="1"></li>
                    <li data-target="#style1" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100 slide-image" src="assets/img/fatora.png" alt="First slide">
                        <div class="carousel-caption">
                            .................
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100 slide-image" src="assets/img/tax.jpg" alt="Second slide">
                        <div class="carousel-caption">
                            .................
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100 slide-image" src="assets/img/service.jpg" alt="Third slide">
                        <div class="carousel-caption">
                            .................
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#style1" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#style1" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="assets/js/libs/jquery-3.1.1.min.js"></script>
<script src="bootstrap/js/popper.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="assets/js/app.js"></script>

<script>
    $(document).ready(function() {
            App.init();
        });
</script>
<script src="assets/js/custom.js"></script>
<!-- END GLOBAL MANDATORY SCRIPTS -->

<!-- BEGIN PAGE LEVEL CUSTOM SCRIPTS -->
<script src="plugins/table/datatable/datatables.js"></script>
<!-- NOTE TO Use Copy CSV Excel PDF Print Options You Must Include These Files  -->
<script src="plugins/highlight/highlight.pack.js"></script>
<script src="assets/js/scrollspyNav.js"></script>
<script src="plugins/table/datatable/button-ext/dataTables.buttons.min.js"></script>
<script src="plugins/table/datatable/button-ext/jszip.min.js"></script>
<script src="plugins/table/datatable/button-ext/buttons.html5.min.js"></script>
<script src="plugins/table/datatable/button-ext/buttons.print.min.js"></script>
<script>
    $('#html5-extension').DataTable( {
            "dom": "<'dt--top-section'<'row'<'col-sm-12 col-md-6 d-flex justify-content-md-start justify-content-center'B><'col-sm-12 col-md-6 d-flex justify-content-md-end justify-content-center mt-md-0 mt-3'f>>>" +
        "<'table-responsive'tr>" +
        "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
            buttons: {
                buttons: [
                    // { extend: 'copy', className: 'btn btn-sm' },
                    { extend: 'csv', className: 'btn btn-sm' },
                    { extend: 'excel', className: 'btn btn-sm' },
                    // { extend: 'print', className: 'btn btn-sm' }
                ]
            },
            "oLanguage": {
                "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                "sInfo": "Showing page _PAGE_ of _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Search...",
               "sLengthMenu": "Results :  _MENU_",
            },
            "stripeClasses": [],
            "lengthMenu": [7,15, 10, 20, 50],
            "pageLength": 15,
            "sort":false
        } );
</script>
@endsection
