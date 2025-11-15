<!DOCTYPE html>
<html lang="en" data-textdirection="LTR" class="loading">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Robust admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, robust admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>Sahaf Sensin Yönetim Paneli</title>


    <link rel="apple-touch-icon" sizes="60x60" href="{{url('/robust-assets/ico/apple-icon-60.png')}}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{url('/robust-assets/ico/apple-icon-76.png')}}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{url('/robust-assets/ico/apple-icon-120.png')}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{url('/robust-assets/ico/apple-icon-152.png')}}">

    <link rel="shortcut icon" type="image/x-icon" href="{{url('/robust-assets/ico/favicon.ico')}}">
    <link rel="shortcut icon" type="image/png" href="{{url('/robust-assets/ico/favicon-32.png')}}">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <!-- BEGIN VENDOR CSS-->
    <!-- build:css robust-assets/css/vendors.min.css-->
    <link rel="stylesheet" type="text/css" href="{{url('/robust-assets/css/bootstrap.css')}}">
    <!-- /build-->
    <!-- BEGIN VENDOR CSS-->
    <!-- BEGIN Font icons-->
    <link rel="stylesheet" type="text/css" href="{{url('/robust-assets/fonts/icomoon.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('/robust-assets/fonts/flag-icon-css/css/flag-icon.min.css')}}">
    <!-- END Font icons-->
    <!-- BEGIN Plugins CSS-->
    <link rel="stylesheet" type="text/css" href="{{url('/robust-assets/css/plugins/sliders/slick/slick.css')}}">
    <!-- END Plugins CSS-->

    <!-- BEGIN Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{url('/robust-assets/css/plugins/forms/icheck/icheck.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('/robust-assets/css/plugins/forms/icheck/custom.css')}}">
    <!-- END Vendor CSS-->
    <!-- BEGIN ROBUST CSS-->
    <!-- build:css robust-assets/css/app.min.css-->
    <link rel="stylesheet" type="text/css" href="{{url('/robust-assets/css/bootstrap-robust.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('/robust-assets/css/components.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('/robust-assets/css/colors.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('/assets/css/style.css')}}">

    <!-- END Custom CSS-->
  </head>
  <body data-open="click" data-menu="vertical-menu" data-col="1-column" class="vertical-layout vertical-menu 1-column  blank-page blank-page">
    <!-- START PRELOADER-->

    <div id="preloader-wrapper">
      <div id="loader">
        <div class="line-scale-pulse-out-rapid loader-white">
          <div></div>
          <div></div>
          <div></div>
          <div></div>
          <div></div>
        </div>
      </div>
      <div class="loader-section section-top bg-cyan"></div>
      <div class="loader-section section-bottom bg-cyan"></div>
    </div>

    <!-- END PRELOADER-->
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <div class="robust-content content container-fluid">
      <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body"><section class="flexbox-container">
    <div class="col-md-4 offset-md-4 col-xs-10 offset-xs-1  box-shadow-2 p-0">
        <div class="card border-grey border-lighten-3 m-0">
            <div class="card-header no-border">
                <div class="card-title text-xs-center">
                    <div class="p-1"><img src="{{url('/images/05c1adcc-0579-4f80-a7db-4a3a82d31b50.jpeg')}}" alt="branding logo"></div>
                </div>
                <h6 class="card-subtitle line-on-side text-muted text-xs-center font-small-3 pt-2"><span>Sahaf Sensin</span></h6>
            </div>
            <div class="card-body collapse in">
                <div class="card-block">


                    <form class="form-horizontal form-simple" id="login-form" name="login-form" action="{{ route('admin-login-post') }}" onsubmit="return false"
                    method="post" enctype="multipart/form-data" novalidate>
                    <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">


                        <fieldset class="form-group has-feedback has-icon-left mb-0">
                            <input type="text" class="form-control form-control-lg input-lg" id="admin_code" name="admin_code" placeholder="Admin Code"    >
                            <div class="form-control-position">
                                <i class="icon-head"></i>
                            </div>
                        </fieldset>
                        <fieldset class="form-group has-feedback has-icon-left">
                            <input type="password" class="form-control form-control-lg input-lg" id="password" name="password" value="" placeholder="Enter Password"  >
                            <div class="form-control-position">
                                <i class="icon-key3"></i>
                            </div>
                        </fieldset>
                        <fieldset class="form-group row">
                            <div class="col-md-6 col-xs-12 text-xs-center text-md-left">
                                <fieldset>
                                    <input type="checkbox" id="remember-me" class="chk-remember">
                                    <label for="remember-me"> Remember Me</label>
                                </fieldset>
                            </div>
                            <div class="col-md-6 col-xs-12 text-xs-center text-md-right"><a href="#" class="card-link">Forgot Password?</a></div>
                        </fieldset>
                        <button type="submit" class="btn btn-primary btn-lg btn-block"><i class="icon-unlock2"></i> Login</button>
                    </form>
                </div>
            </div>
            <div class="card-footer">
                <div class="">
                    <!--
                    <p class="float-sm-left text-xs-center m-0"><a href="recover-password.html" class="card-link">Recover password</a></p>
                    <p class="float-sm-right text-xs-center m-0">New to Robust? <a href="register-simple.html" class="card-link">Sign Up</a></p>
                    -->
                </div>
            </div>
        </div>
    </div>
</section>

        </div>
      </div>
    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->

    <!-- BEGIN VENDOR JS-->
    <!-- build:js robust-assets/js/vendors.min.js-->
    <script src="{{url('/robust-assets/js/core/libraries/jquery.min.js')}}" type="text/javascript"></script>
    <script src="{{url('/assets/js/sweetalert2@11.js')}}" type="text/javascript"></script>
    <script src="{{url('/assets/js/saveV3.js')}} " type="text/javascript"></script>
    <script src="{{url('/robust-assets/js/plugins/ui/tether.min.js')}}" type="text/javascript"></script>
    <script src="{{url('/robust-assets/js/core/libraries/bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="{{url('/robust-assets/js/plugins/ui/perfect-scrollbar.jquery.min.js')}}" type="text/javascript"></script>
    <script src="{{url('/robust-assets/js/plugins/ui/unison.min.js')}}" type="text/javascript"></script>
    <script src="{{url('/robust-assets/js/plugins/ui/blockUI.min.js')}}" type="text/javascript"></script>
    <script src="{{url('/robust-assets/js/plugins/ui/jquery.matchHeight-min.js')}}" type="text/javascript"></script>
    <script src="{{url('/robust-assets/js/plugins/ui/jquery-sliding-menu.js')}}" type="text/javascript"></script>
    <script src="{{url('/robust-assets/js/plugins/sliders/slick/slick.min.js')}}" type="text/javascript"></script>
    <script src="{{url('/robust-assets/js/plugins/ui/screenfull.min.js')}}" type="text/javascript"></script>
    <script src="{{url('/robust-assets/js/plugins/forms/icheck/icheck.min.js')}}" type="text/javascript"></script>
    <script src="{{url('/robust-assets/js/plugins/forms/validation/jqBootstrapValidation.js')}}" type="text/javascript"></script>
    <script src="{{url('/robust-assets/js/core/robust-menu.js')}}" type="text/javascript"></script>
    <script src="{{url('/robust-assets/js/core/robust.js')}}" type="text/javascript"></script>




    <script>
           $('#login-form').submit(function(e) {
            e.preventDefault();
            var error = false;

            if ($('#admin_code').val() == '') {
                $('#admin_code').focus();
                Swal.fire({
                    icon: 'error',
                    text: 'Enter Your Admin Panel'
                });
                error = true;
                return false;
             }

            if ($('#password').val() == '') {

                $('#password').focus();
                Swal.fire({
                    icon: 'error',
                    text: 'Enter Password'
                });

                error = true;
                return false;
            }
            if (error) {
                return false;
            }
            //function save(formData,route,formID,btn,reload) {
            var formData = new FormData(this);
            save(formData,'{{ route('admin-login-post') }}','login-form','','/admin-panel');

        });

    </script>
    <!-- END PAGE LEVEL JS-->
  </body>
</html>
