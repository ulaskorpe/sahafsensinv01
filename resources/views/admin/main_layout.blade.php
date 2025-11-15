<!DOCTYPE html>
<html lang="tr" data-textdirection="LTR" class="loading">




  @include("admin.partials.head")
  <body data-open="click" data-menu="vertical-menu" data-col="2-columns" class="vertical-layout vertical-menu 2-columns  fixed-navbar">
    <!-- START PRELOADER-->
  @include("admin.partials.loader")
  @include("admin.partials.nav")

    @yield("css")
    <!-- END PRELOADER-->


    <!-- ////////////////////////////////////////////////////////////////////////////-->


    <!-- main menu-->
    
    <!-- / main menu-->

    <div class="robust-content content container-fluid">
      <div class="content-wrapper">
        <div class="content-header row">

        </div>
        <div class="content-body" style="min-height: 1000px">
             @yield("content")

        </div>
      </div>
    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->


    <footer class="footer footer-light">
      <p class="clearfix text-muted text-sm-center mb-0 px-2"><span class="float-md-left d-xs-block d-md-inline-block">Copyright  &copy; 2025 </p>
    </footer>

    @include("admin.partials.scripts")
    @yield("scripts")
    <!-- END PAGE LEVEL JS-->

    <script>
        function logoutfx(){
            Swal.fire({
            title: 'Are you sure you will logout?',

            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes!',
            cancelButtonText: 'No'
        }).then((result) => {
            // If confirmed
            if (result.isConfirmed) {
                    $('#logout-form').submit();
            }
        });
        }
        </script>
  </body>
</html>
