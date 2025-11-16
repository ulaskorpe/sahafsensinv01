<div id="main-menu" data-scroll-to-active="true" class="main-menu menu-dark menu-fixed menu-shadow menu-accordion">

    <!-- main menu content-->
    <div class="main-menu-content">
      <ul id="main-menu-navigation" data-menu="menu-navigation" class="navigation navigation-main">

        @if( $data['role']['name']  == 'sudo')
        <li class=" nav-item"><a href="{{route('dashboard')}}">

            <i class="icon-key22"></i><span data-i18n="nav.dash.main"  class="menu-title">SUDO Panel </span><span class="tag hidden tag tag-danger tag-pill float-xs-right mr-2">5</span></a>
            <ul class="menu-content">
              <li @if($type->active =='sudo') class="active" @endif><a href="{{route('sudo.types.index')}}" class="menu-item">Content Types </a></li>
              <li><a href="{{ route('sudo.admin-list') }}" class="menu-item">Admins </a></li>
              <li><a href="#" class="menu-item">Roles </a></li>

            </ul>
          </li>
        @endif
        <li class=" nav-item"><a href="{{route('dashboard')}}">
           
               
          <i class="icon-home3"></i><span data-i18n="nav.dash.main"  class="menu-title">AnaSayfa </span><span class="tag hidden tag tag-danger tag-pill float-xs-right mr-2">5</span></a>
          <ul class="menu-content">

            <li @if($type->active =='dashboard') class="active" @endif><a href="{{route('content-list','top_banner')}}" class="menu-item">Künye</a></li>

            <li><a href="{{route('content-list','slider')}}" class="menu-item">Slider  </a></li>
            <li><a href="{{route('content-list','slider_second')}}" class="menu-item">Slider#2</a></li>
            <li><a href="{{route('content-list','quotes')}}" class="menu-item">Alıntılar</a></li>

       <!-- #endregion -->

  <li><a href="{{route('content-list','contact_spot')}}" class="menu-item">İletişim Yazı</a></li>
          </ul>
        </li>
    
        <li class=" nav-item"><a href="{{route('dashboard')}}">
           
               
          <i class="icon-home3"></i><span data-i18n="nav.dash.main"  class="menu-title">Üyeler </span><span class="tag hidden tag tag-danger tag-pill float-xs-right mr-2">5</span></a>
          <ul class="menu-content">

            <li @if($type->active =='users') class="active" @endif><a href="{{ route('Users.index') }}" class="menu-item">Kullanıcı Listesi </a></li>

          
       <!-- #endregion -->

  <li><a href="{{route('content-list','contact_spot')}}" class="menu-item">İletişim Yazı</a></li>
          </ul>
        </li>


      </ul>
    </div>
    <!-- /main menu content-->
    <!-- main menu footer-->
    <div class="main-menu-footer footer-close">
      <div class="header text-xs-center"><a href="#" class="col-xs-12 footer-toggle"><i class="icon-ios-arrow-up"></i></a></div>
      <div class="content">
        <div class="insights">
          <div class="col-xs-12">
            <p>Product Delivery</p>
            <progress value="25" max="100" class="progress progress-xs progress-success">25%</progress>
          </div>
          <div class="col-xs-12">
            <p>Targeted Sales</p>
            <progress value="70" max="100" class="progress progress-xs progress-info">70%</progress>
          </div>
        </div>
        <div class="actions"><a href="javascript: void(0);" data-placement="top" data-toggle="tooltip" data-original-title="Settings"><span aria-hidden="true" class="icon-cog3"></span></a><a href="javascript: void(0);"   data-toggle="tooltip" data-original-title="Lock"><span aria-hidden="true" class="icon-lock4"></span></a><a href="javascript: void(0);" data-placement="top" data-toggle="tooltip" data-original-title="Logout"><span aria-hidden="true" class="icon-power3"></span></a></div>
      </div>
    </div>
    <!-- main menu footer-->
  </div>
