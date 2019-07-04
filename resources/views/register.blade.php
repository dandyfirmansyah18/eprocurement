<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from eliteadmin.themedesigner.in/demos/bt4/eliteadmin/pages-register2.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 30 Mar 2019 16:28:24 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('EliteAdmin/assets/images/favicon.png') }}">
    <title>Register E-Procurement</title>
    
    <!-- page css -->
    <link href="{{ asset('EliteAdmin/dist/css/pages/login-register-lock.css') }}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('EliteAdmin/dist/css/style.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sweetalert.css') }}" rel="stylesheet" type="text/css" />
    
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">Elite admin</p>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <section id="wrapper" class="login-register login-sidebar" style="background-image:url(../../img/dash.jpg);">
        <div class="login-box card">
            <div class="card-body">
                <form class="form-horizontal form-material" id="formrequestpin" role="form" action="/register/request_pin" method="POST">
                    <div class="text-center">
                        <a href="javascript:void(0)" class="db"><img src="{{ asset('img/logoeproc.png') }}" alt="Home" width="200" height="100"/></a>
                    </div>
                    <h3 class="box-title m-t-40 m-b-0">Register Sekarang</h3><small></small>
                    <div class="form-group m-t-20">
                        <div class="col-xs-12">
                            <input class="form-control" type="text" required="" name="name" placeholder="Nama">
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input class="form-control npwp-inputmask" type="text" required="" name="taxpayer_number" placeholder="Npwp">
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input class="form-control" type="text" required="" name="email" placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="customCheck1">
                                <label class="custom-control-label" for="customCheck1">I agree to all <a href="javascript:void(0)">Terms</a></label> 
                            </div> 
                        </div>
                    </div>
                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <a href="#" class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" id="send_request_pin">Registrasi</a>
                        </div>
                    </div>
                    <div class="form-group m-b-0">
                        <div class="col-sm-12 text-center">
                            <p>Sudah Menjadi Penyedia? <a href="{{ url('/signin') }}" class="text-info m-l-5"><b>Masuk</b></a></p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{{ asset('EliteAdmin/assets/node_modules/jquery/jquery-3.2.1.min.js') }}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{ asset('EliteAdmin/assets/node_modules/popper/popper.min.js') }}"></script>
    <script src="{{ asset('EliteAdmin/assets/node_modules/bootstrap/dist/js/bootstrap.min.js') }}"></script>

    <script src="{{ asset('EliteAdmin/assets/node_modules/inputmask/dist/min/jquery.inputmask.bundle.min.js') }}"></script>
    <script src="{{ asset('EliteAdmin/dist/js/pages/mask.init.js') }}"></script>
    <script src="{{ asset('js/sweetalert.min.js') }}" type="text/javascript"></script>
    
    <script type="text/javascript">
        $(function() {
            $(".preloader").fadeOut();
        });
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        });
        // ============================================================== 
        // Login and Recover Password 
        // ============================================================== 
        $('#to-recover').on("click", function() {
            $("#loginform").slideUp();
            $("#recoverform").fadeIn();
        });

        // ============================================================== 
        // External Script by Dandy Firmansyah
        // ============================================================== 

        $("#send_request_pin").click(function(event){
            var form = $('form#formrequestpin');
            var formData = new FormData(form[0]);
            $.ajax({
                type: form.attr("method"),
                url: form.attr("action"),
                data: formData,
                headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    },
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data){
                    var isiMsg = '';
                    var arrdata = data.split('#');
                    if (arrdata[0].trim()==='MSG')
                    {
                        if (arrdata[1] === 'OK') {
                            isiMsg = arrdata[2];
                            swal("", isiMsg, "success");
                            document.getElementById("formrequestpin").reset();
                            document.location = "/signin";
                        } else {
                            isiMsg = arrdata[2];
                            swal("", isiMsg, "error");
                        }
                    }
                    else 
                    {
                        swal("", data, "error");
                    }
                },
                error: function(error){
                    // console.log(error);
                    swal("", "Failed. Something went wrong, please try again later.", "error");
                    // alert("Failed. Something went wrong, please try again later.");
                }
            });
        });
    </script>
</body>


<!-- Mirrored from eliteadmin.themedesigner.in/demos/bt4/eliteadmin/pages-register2.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 30 Mar 2019 16:28:24 GMT -->
</html>