<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>SMPN 1 SUMENEP</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{asset('assets/vendors/jquery-bar-rating/css-stars.css')}}" />
    <link href="{{ asset('vendor/fontawesome-free/css/fontawesome.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{asset('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    <!-- End plugin css for this page -->
    <link rel="stylesheet" href="{{asset('assets/vendors/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/flag-icon-css/css/flag-icon.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/css/vendor.bundle.base.css')}}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{asset('assets/css/demo_1/style.css')}}" />
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{asset('assets/images/logo.png')}}" />
  </head>
  <body>
    @php
        $auth = Http::withHeaders([
            'Authorization' => 'Bearer '.request()->cookie('token'),
            'ContentType' => 'application/json',
            'Accept' => 'application/json',
        ])->get('http://127.0.0.1:8000/api/user')->json();
        
        $auth = json_decode(json_encode($auth))->data;
    @endphp
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item nav-profile border-bottom">
            <a href="#" class="nav-link flex-column">
              <div class="nav-profile-image">
                <img src="{{asset('assets/images/faces/face28.png')}}" alt="profile" />
                <!--change to offline or busy as needed-->
              </div>
              <div class="nav-profile-text d-flex ml-0 mb-3 flex-column">
                <span class="font-weight-semibold mb-1 mt-2 text-center">Admin</span>
                
              </div>
            </a>
          </li>
          <li class="nav-item pt-3">
            <a class="nav-link d-block" href="index.html">
              <img class="sidebar-brand-logo" src="{{asset('assets/images/logosmp1.png')}}" alt="" />              
            </a>
    
          </li>
          @include('layouts.sidebar')
        </ul>
      </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">      
        <!-- partial:partials/_navbar.html -->
        @include('layouts.topbar')
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper pb-0">
            @yield('content')
            
            </div>
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
              {{-- <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © SMPN1SUMENEP.com 2020</span> --}}
              {{-- <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Free <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap dashboard templates</a> from Bootstrapdash.com</span> --}}
              <span class="copyright">
                ©
                <script>
                    document.write(new Date().getFullYear())
                </script>, SMPN 1 SUMENEP
            </span>
            </div>

            
          </footer>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{asset('assets/vendors/js/vendor.bundle.base.js')}}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('assets/vendors/jquery-bar-rating/jquery.barrating.min.js')}}"></script>
    <script src="{{asset('assets/vendors/chart.js/Chart.min.js')}}"></script>
    <script src="{{asset('assets/vendors/flot/jquery.flot.js')}}"></script>
    <script src="{{asset('assets/vendors/flot/jquery.flot.resize.js')}}"></script>
    <script src="{{asset('assets/vendors/flot/jquery.flot.categories.js')}}"></script>
    <script src="{{asset('assets/vendors/flot/jquery.flot.fillbetween.js')}}"></script>
    <script src="{{asset('assets/vendors/flot/jquery.flot.stack.js')}}"></script>

    <script src="{{ asset('vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('vendor/select2/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('vendor/clock-picker/clockpicker.js') }}"></script>
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{asset('assets/js/off-canvas.js')}}"></script>
    <script src="{{asset('assets/js/hoverable-collapse.js')}}"></script>
    <script src="{{asset('assets/js/misc.js')}}"></script>
    <script src="{{asset('assets/js/settings.js')}}"></script>
    <script src="{{asset('assets/js/todolist.js')}}"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="{{asset('assets/js/dashboard.js')}}"></script>
    <script type="text/javascript">
      function getCookie(name) {
          let cookie = {};
          document.cookie.split(';').forEach(function(el) {
              let [k, v] = el.split('=');
              cookie[k.trim()] = v;
          })
          return cookie[name];
      }

      $("#logout").on('submit', function(event) {
          event.preventDefault();
          $(".preloader").fadeIn();

          $.ajax({
              url: "http://127.0.0.1:8000/api/logout",
              type: "POST",
              headers: {
                  'Authorization': 'Bearer ' + getCookie('token'),
                  'Content-Type': 'application/json',
                  'Accept': 'application/json',
              },
              cache: false,
              contentType: false,
              processData: false,
              success: function(response) {
                  $(".preloader").fadeOut();
                  if (response.success) {
                      window.location.href = "/";
                      document.cookie.split(";").forEach(function(c) {
                          document.cookie = c.replace(/^ +/, "").replace(/=.*/, "=;expires=" +
                              new Date().toUTCString() + ";path=/");
                      });
                  }
              },
          });
      });
  </script>
    <!-- End custom js for this page -->
  </body>
</html>