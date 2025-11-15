<li class=" nav-item"><a href="{{route('admin-messages')}}"><i class="icon-envelope"></i><span data-i18n="nav.changelog.main" class="menu-title">Mesajlar</span>

    <li class=" nav-item"><a href="#"><i class="icon-pencil-square-o"></i><span data-i18n="nav.dash.treat"  class="menu-title">Hakkımızda</span></a>
        <ul class="menu-content">
          <li  @if($type->active =='about') class="active" @endif><a href="{{route('content-list','about_us')}}" class="menu-item">Hakkımızda</a>
          </li>
          <li><a href="{{route('content-list','about_icons')}}" class="menu-item">Hakkımızda Ikonlar</a>
          </li>

        </ul>
      </li>
      <li class=" nav-item"><a href="#"><i class="icon-pencil-square-o"></i><span data-i18n="nav.dash.treat"  class="menu-title">Ürünler</span></a>
        <ul class="menu-content">



          <li  @if($type->active =='products') class="active" @endif><a href="{{route('content-list','categories')}}" class="menu-item">Ürün Kategorileri</a>
          </li>
          <li><a href="{{route('content-list','products')}}" class="menu-item">Ürünler</a>
          </li>

        </ul>
      </li>
      <li class=" nav-item"><a href="#"><i class="icon-pencil-square-o"></i><span data-i18n="nav.dash.treat"  class="menu-title">Hizmetlerimiz</span></a>
        <ul class="menu-content">
          <li  @if($type->active =='services') class="active" @endif><a href="{{route('content-list','services_spot')}}" class="menu-item">Hizmetlerimiz Spot</a>
          </li>
          <li><a href="{{route('content-list','services')}}" class="menu-item">Hizmetlerimiz</a>
          </li>

        </ul>
      </li>

    <li class=" nav-item"><a href="#"><i class="icon-pencil-square-o"></i><span data-i18n="nav.dash.treat"  class="menu-title">Çalışma Süreci</span></a>
        <ul class="menu-content">
          <li  @if($type->active =='work_process') class="active" @endif><a href="{{route('content-list','work_process_header')}}" class="menu-item">Çalışma Süreci Spot</a>
          </li>
          <li><a href="{{route('content-list','work_process')}}" class="menu-item">Çalışma Süreci Öğeler</a>
          </li>

        </ul>
      </li>
      <li class=" nav-item"><a href="#"><i class="icon-pencil-square-o"></i><span data-i18n="nav.dash.treat"  class="menu-title">Sağlık Turizmi</span></a>
        <ul class="menu-content">
          <li  @if($type->active =='health_tourism') class="active" @endif><a href="{{route('content-list','health_tourism')}}" class="menu-item">ST İçerik</a>
          </li>



        </ul>
      </li>
      <li class=" nav-item"><a href="#"><i class="icon-pencil-square-o"></i><span data-i18n="nav.dash.treat"  class="menu-title">Bizi Seçin</span></a>
        <ul class="menu-content">
          <li  @if($type->active =='choose_us') class="active" @endif><a href="{{route('content-list','choose_us_spot')}}" class="menu-item">Bizi Seçin Spot</a>
          </li>
          <li><a href="{{route('content-list','choose_us')}}" class="menu-item">Bizi Seçin Öğeler</a>
          </li>

        </ul>
      </li>

    <li class=" nav-item"><a href="#"><i class="icon-pencil-square-o"></i><span data-i18n="nav.dash.treat"  class="menu-title">Tedaviler</span></a>
      <ul class="menu-content">
        <li  @if($type->active =='treatments') class="active" @endif><a href="{{route('content-list','treatments_spot')}}" class="menu-item">Tedaviler Spot</a>
        </li>
        <li><a href="{{route('content-list','treatments')}}" class="menu-item">Tedaviler Liste</a>
        </li>

      </ul>
    </li>
{{-- 'lang','type_id','count','title','second_title','prologue','content','link','image','second_image' --}}
    <li class="nav-item"><a href="#"><i class="icon-edit2"></i><span data-i18n="nav.dash.faq" class="menu-title">SSS</span></a>
      <ul class="menu-content">
        <li  @if($type->active =='faqs') class="active" @endif><a href="{{route('content-list','faq_spot')}}" class="menu-item">SSS Spot</a>
        <li @if($type->active =='faqs') class="active" @endif><a href="{{route('content-list',parameters: 'faq_item')}}" class="menu-item">SSS Liste</a></li>
        <li @if($type->active =='faqs') class="active" @endif><a href="{{route('content-list',parameters: 'faq_cat')}}" class="menu-item">SSS Kategoriler</a></li>

      </ul>
    </li>


    <li class=" nav-item"><a href="#"><i class="icon-pencil-square-o"></i><span data-i18n="nav.dash.blog" class="menu-title">Bloglar</span></a>
      <ul class="menu-content">
        <li @if($type->active == 'blogs' ) class="active" @endif ><a href="{{route('content-list','blogs_spot')}}" class="menu-item">Blog Spot</a>
            <li ><a href="{{route('content-list','blogs')}}" class="menu-item">Blog Liste</a></li>
       <!--     <li ><a href="{{route('content-list','tags')}}" class="menu-item">Blog Etiketler</a></li>-->
      </ul>
    </li>



    <li class=" nav-item"><a href="#"><i class="icon-pencil-square-o"></i><span data-i18n="nav.dash.blog" class="menu-title">Medya</span></a>
        <ul class="menu-content">
          <li @if($type->active == 'media' ) class="active" @endif ><a href="{{route('content-list','media')}}" class="menu-item">Medya Spot</a></li>
              <li ><a href="{{route('content-list','video_item')}}" class="menu-item">Video Liste</a></li>
        </ul>
      </li>
      <li class=" nav-item"><a href="#"><i class="icon-pencil-square-o"></i><span data-i18n="nav.dash.blog" class="menu-title">Yorumlar</span></a>
        <ul class="menu-content">
          <li @if($type->active == 'comments' ) class="active" @endif ><a href="{{route('content-list','testmonial_spot')}}" class="menu-item">Yorumlar Spot</a></li>
              <li ><a href="{{route('content-list','comments')}}" class="menu-item">Yorumlar Liste</a></li>
        </ul>
      </li>
    <li class=" nav-item"><a href="#"><i class="icon-pencil-square-o"></i><span data-i18n="nav.dash.blog" class="menu-title">Footer</span></a>
        <ul class="menu-content">
          <li @if($type->active == 'footer' ) class="active" @endif ><a href="{{route('content-list','footer_sm')}}" class="menu-item">SM</a>
              <li ><a href="{{route('content-list','footer_quick')}}" class="menu-item">Quick Linkler</a>
              <li ><a href="{{route('content-list','footer_popular')}}" class="menu-item">Popüler Linkler</a>
        </ul>
      </li>




    <!--    <span class="tag tag tag-pill tag-danger float-xs-right">100</span>-->
    </a>
    </li>