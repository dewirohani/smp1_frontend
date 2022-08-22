<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="navbar-menu-wrapper d-flex align-items-stretch">
      <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
        <span class="mdi mdi-chevron-double-left"></span>
      </button>
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo-mini" href="index.html"><img src="{{asset('assets/images/logo-mini.svg')}}" alt="logo" /></a>
      </div>            
      <ul class="navbar-nav navbar-nav-right">
      <form id="logout">
          @csrf
          <button type="button" class="btn btn-outline-primary"
              data-dismiss="modal">Cancel</button>
          <button id="submit" class="btn btn-primary">
            <li class="nav-item nav-logout d-none d-lg-block">
            <i class="mdi mdi-logout"></i>
        </li></button>
      </form>          
        
      </ul>
      <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
        <span class="mdi mdi-menu"></span>
      </button>
    </div>
  </nav>