<div class="container-fluid">
    <div class="row bg-secondary py-1 px-xl-5">
        <div class="col-lg-6 d-none d-lg-block">
            <div class="d-inline-flex align-items-center h-100">
                <a class="text-body mr-3" href="{{route('about-us')}}">Hakkımızda</a>
                <a class="text-body mr-3" href="{{route('contact')}}">İletişim</a>
                <a class="text-body mr-3" href="{{route('help-me')}}">Yardım</a>
                <a class="text-body mr-3" href="{{route('sss')}}">SSS</a>
            </div>
        </div>
        <div class="col-lg-6 text-center text-lg-right">
            <div class="d-inline-flex align-items-center">
                <div class="btn-group bg-primary">
                    <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">
                        <i class="fas fa-user "></i>
                        Hesabım</button>

                    <div class="dropdown-menu dropdown-menu-right">
                        @if(empty(session('user_code')))
                        <button class="dropdown-item" type="button" onclick="window.open('{{route('user-login')}}','_self')">Kullanıcı Girişi</button>
                        <button class="dropdown-item" type="button" onclick="window.open('{{route('user-register')}}','_self')">Kayıt Ol</button>
                        @else


                    <form class="form" id="logout-form" name="logout-form" action="{{ route('logout_user') }}"
                    method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                    
                    </form>
                        <button class="dropdown-item" type="button" onclick="window.open('{{route('user-profile')}}','_self')" >Hesabım</button>
                        <button class="dropdown-item" type="button"  >Ürünlerim</button>
                        <button class="dropdown-item" type="button"  >İzlediklerim</button>
                        <button class="dropdown-item" type="button"  >Mesaj Kutum</button>
                        <button class="dropdown-item" type="button"  >Taleplerim</button>
                        <button class="dropdown-item" type="button"  >Mağazam</button>
      
                        <button class="dropdown-item" type="button"  onclick="logoutfx()">Çıkış Yap</button>
                        @endif
                   
                    </div>
                </div>
                @if(false)
                <div class="btn-group mx-2">
                    <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">USD</button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <button class="dropdown-item" type="button">EUR</button>
                        <button class="dropdown-item" type="button">GBP</button>
                        <button class="dropdown-item" type="button">CAD</button>
                    </div>
                </div>
                <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">EN</button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <button class="dropdown-item" type="button">FR</button>
                        <button class="dropdown-item" type="button">AR</button>
                        <button class="dropdown-item" type="button">RU</button>
                    </div>
                </div>
                @endif
            </div>
            <div class="d-inline-flex align-items-center d-block d-lg-none">
                <a href="" class="btn px-0 ml-2">
                    <i class="fas fa-heart text-dark"></i>
                    <span class="badge text-dark border border-dark rounded-circle" style="padding-bottom: 2px;">0</span>
                </a>
                <a href="" class="btn px-0 ml-2">
                    <i class="fas fa-shopping-cart text-dark"></i>
                    <span class="badge text-dark border border-dark rounded-circle" style="padding-bottom: 2px;">0</span>
                </a>
            </div>
        </div>
    </div>
    <div class="row align-items-center bg-light py-3 px-xl-5 d-none d-lg-flex">
        <div class="col-lg-4">
            <a href="{{route('index')}}" class="text-decoration-none">
                <span class="h1 text-uppercase text-primary bg-dark px-2">Sahaf</span>
                <span class="h1 text-uppercase text-dark bg-primary px-2 ml-n1">Sensİn</span>
            </a>
        </div>
        <div class="col-lg-4 col-6 text-left">
            <form action="">
                <div class="input-group">
                    <input type="text" class="form-control" id="treasure_key" placeholder="Hazine arıyorum ...">
                    <div class="input-group-append">
                        <span class="input-group-text bg-transparent text-primary" style="cursor: pointer" onclick="treasure_search()">
                            <i class="fa fa-search"></i>
                        </span>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-lg-4 col-6 text-right">
            @if(false)
            <p class="m-0">İletişim</p>
            <h5 class="m-0">+0212 345 6789</h5>
            @endif
        </div>
    </div>
</div>