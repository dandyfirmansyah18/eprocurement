<!DOCTYPE html>
<html lang="en">
<!-- Mirrored from eliteadmin.themedesigner.in/demos/bt4/eliteadmin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 30 Mar 2019 16:21:46 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png') }}">
    <title>
        E-Procurement
    </title>
    <script>
        var base_url = '<?= url('/'); ?>';
        var site_url = '<?= url('/'); ?>';
        var site_name = '.: E-Procurement :.';
    </script>
    <!-- This page CSS -->
    <!-- chartist CSS -->
    <link href="{{ asset('EliteAdmin/assets/node_modules/morrisjs/morris.css') }}" rel="stylesheet">
    <!--Toaster Popup message CSS -->
    <link href="{{ asset('EliteAdmin/assets/node_modules/toast-master/css/jquery.toast.css') }}" rel="stylesheet">

    <link href="{{ asset('EliteAdmin/assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('EliteAdmin/assets/node_modules/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('EliteAdmin/assets/node_modules/switchery/dist/switchery.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('EliteAdmin/assets/node_modules/bootstrap-select/bootstrap-select.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('EliteAdmin/assets/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}" rel="stylesheet" />
    <link href="{{ asset('EliteAdmin/assets/node_modules/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('EliteAdmin/assets/node_modules/multiselect/css/multi-select.css') }}" rel="stylesheet" type="text/css" />
    <!-- -->
    <link href="{{ asset('EliteAdmin/dist/css/pages/tab-page.css') }}" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="{{ asset('css/libs/dropzone/dropzone-theme.css') }}"  type="text/css"/>
    <link rel="stylesheet" href="{{ asset('css/libs/wizard/wizard.css') }}"  type="text/css"/>
    <link rel="stylesheet" href="{{ asset('css/libs/typeahead/typeahead.css') }}"  type="text/css"/>
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}"  type="text/css"/>

    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('EliteAdmin/assets/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css') }}">
    <link href="{{ asset('EliteAdmin/dist/css/style.min.css') }}" rel="stylesheet">
    <!-- Dashboard 1 Page CSS -->
    <link href="{{ asset('EliteAdmin/dist/css/pages/dashboard1.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sweetalert.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('EliteAdmin/assets/node_modules/wizard/steps.css') }}" rel="stylesheet">

    <link href="{{ asset('EliteAdmin/dist/css/pages/error-pages.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/libs/summernote/summernote.css') }}"  type="text/css"/>
    <link rel="stylesheet" href="{{ asset('js/libs/rating/star-rating.min.css') }}"  type="text/css"/>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
    <script src="{{ asset('EliteAdmin/assets/node_modules/jquery/jquery-3.2.1.min.js') }}"></script>
    <!-- Bootstrap popper Core JavaScript -->
    <script src="{{ asset('EliteAdmin/assets/node_modules/popper/popper.min.js') }}"></script>
    <script src="{{ asset('EliteAdmin/assets/node_modules/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="{{ asset('EliteAdmin/dist/js/perfect-scrollbar.jquery.min.js') }}"></script>
    <!--Wave Effects -->
    <script src="{{ asset('EliteAdmin/dist/js/waves.js') }}"></script>
    <!--Menu sidebar -->
    <script src="{{ asset('EliteAdmin/dist/js/sidebarmenu.js') }}"></script>
    <!--stickey kit -->
    <script src="{{ asset('EliteAdmin/assets/node_modules/sticky-kit-master/dist/sticky-kit.min.js') }}"></script>
    <script src="{{ asset('EliteAdmin/assets/node_modules/sparkline/jquery.sparkline.min.js') }}"></script>
    <!--Custom JavaScript -->
    <script src="{{ asset('EliteAdmin/dist/js/custom.min.js') }}"></script>
    <script src="{{ asset('EliteAdmin/assets/node_modules/moment/moment.js') }}"></script>
    <script src="{{ asset('js/main.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/sweetalert.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/bootstrap-filestyle.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/my_validator.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/session-timeout.js') }}" type="text/javascript"></script>

    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->
    <!--morris JavaScript -->
    <script src="{{ asset('EliteAdmin/assets/node_modules/raphael/raphael-min.js') }}"></script>
    <script src="{{ asset('EliteAdmin/assets/node_modules/morrisjs/morris.min.js') }}"></script>
    <script src="{{ asset('EliteAdmin/assets/node_modules/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
    <!-- Popup message jquery -->
    <script src="{{ asset('EliteAdmin/assets/node_modules/toast-master/js/jquery.toast.js') }}"></script>
    <!-- Chart JS -->
    <script src="{{ asset('EliteAdmin/dist/js/dashboard1.js') }}"></script>
    <!-- This is data table -->
    <script src="{{ asset('EliteAdmin/assets/node_modules/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <!-- start - This is for export functionality only -->
    <script src="{{ asset('EliteAdmin/cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('EliteAdmin/cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('EliteAdmin/cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js') }}"></script>
    <script src="{{ asset('EliteAdmin/cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js') }}"></script>
    <script src="{{ asset('EliteAdmin/cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js') }}"></script>
    <script src="{{ asset('EliteAdmin/cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('EliteAdmin/cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js') }}"></script>
    <!-- end - This is for export functionality only -->
    <script src="{{ asset('EliteAdmin/assets/node_modules/switchery/dist/switchery.min.js') }}"></script>
    <script src="{{ asset('EliteAdmin/assets/node_modules/select2/dist/js/select2.full.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('EliteAdmin/assets/node_modules/bootstrap-select/bootstrap-select.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('EliteAdmin/assets/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ asset('EliteAdmin/assets/node_modules/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.js') }}" type="text/javascript"></script>
    <script src="{{ asset('EliteAdmin/assets/node_modules/dff/dff.js') }}" type="text/javascript"></script>
    <script type="text/javascript" src="{{ asset('EliteAdmin/assets/node_modules/multiselect/js/jquery.multi-select.js') }}"></script>
    <script type="text/javascript" src="{{ asset('EliteAdmin/assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    
    <!-- Wizard -->
    <script src="{{ asset('EliteAdmin/assets/node_modules/wizard/jquery.steps.min.js') }}"></script>
    <script src="{{ asset('EliteAdmin/assets/node_modules/wizard/jquery.validate.min.js') }}"></script>
    <!-- End Wizard -->

    <script type="text/javascript" src="{{ asset('js/libs/jquery-validation/dist/jquery.validate.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/libs/dropzone/dropzone.min.js') }}"></script>
    <script type="text/javascript">// Immediately after the js include
        Dropzone.autoDiscover = false;
    </script>
    <script type="text/javascript" src="{{ asset('js/libs/inputmask/jquery.inputmask.bundle.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/libs/typeahead/typeahead.bundle.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/libs/summernote/summernote.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/libs/rating/star-rating.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jsqbc-functions.js') }}"></script>
</head>

<body class="skin-blue fixed-layout">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">E-Proc</p>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        @include('templates/header')
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        @include('templates/sidemenu')
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div id="_content_">
                {!!$_content_!!}
            </div>
            
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- footer -->
        <!-- ============================================================== -->
        @include('templates/footer')
        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    
</body>


<!-- Mirrored from eliteadmin.themedesigner.in/demos/bt4/eliteadmin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 30 Mar 2019 16:25:49 GMT -->
</html>