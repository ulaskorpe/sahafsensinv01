<div class="container-fluid mb-3">
    <div class="row px-xl-5">
        <div class="col-lg-8">
            <div id="header-carousel" class="carousel slide carousel-fade mb-30 mb-lg-0" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#header-carousel" data-slide-to="0" class="active"></li>
                    <li data-target="#header-carousel" data-slide-to="1"></li>
                    <li data-target="#header-carousel" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
 
                    <div class="carousel-item position-relative active" style="height: 430px;">
                        <img class="position-absolute w-100 h-100" src="{{url('/files/products/'.$carousel[0]['slug'].'/1000w'.$carousel[0]['icon'])}}" style="object-fit: cover;">
                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            <div class="p-3" style="max-width: 700px;">
                                <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">{{$carousel[0]['title']}}</h1>
                                <p class="mx-md-5 px-5 animate__animated animate__bounceIn">{{substr($carousel[0]['prologue'],0,300)}}</p>
                                <a class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp" href="{{route('product_detail',[$carousel[0]['slug'],$carousel[0]['id']])}}">İncele</a>
                            </div>
                        </div>
                    </div>
                  
                    <div class="carousel-item position-relative" style="height: 430px;">
                        <img class="position-absolute w-100 h-100" src="{{url('/files/products/'.$carousel[1]['slug'].'/1000w'.$carousel[1]['icon'])}}" style="object-fit: cover;">
                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            <div class="p-3" style="max-width: 700px;">
                                <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">{{$carousel[1]['title']}}</h1>
                                <p class="mx-md-5 px-5 animate__animated animate__bounceIn">{{substr($carousel[1]['prologue'],0,300)}}</p>
                                <a class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp" href="{{route('product_detail',[$carousel[1]['slug'],$carousel[1]['id']])}}">İncele</a>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item position-relative" style="height: 430px;">
                        <img class="position-absolute w-100 h-100" src="{{url('/files/products/'.$carousel[2]['slug'].'/1000w'.$carousel[2]['icon'])}}" style="object-fit: cover;">
                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            <div class="p-3" style="max-width: 700px;">
                                <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">{{$carousel[2]['title']}}</h1>
                                <p class="mx-md-5 px-5 animate__animated animate__bounceIn">{{substr($carousel[2]['prologue'],0,300)}}</p>
                                <a class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp" href="{{route('product_detail',[$carousel[2]['slug'],$carousel[2]['id']])}}">İncele</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="product-offer mb-30" style="height: 200px;">
                <img class="img-fluid" src="{{url('/files/blogs/'.$blogs[0]['slug'].'/1000x430'.$blogs[0]['icon'])}}" alt="">
                <div class="offer-text">
                    
                    <h3 class="text-white mb-3">{{$blogs[0]['title']}}</h3>
                    <a href="{{ route('blog_detail', [$blogs[1]['slug'], $blogs[1]['id']]) }}" class="btn btn-primary">İncele</a>
                </div>
            </div>
            <div class="product-offer mb-30" style="height: 200px;">
                <img class="img-fluid" src="{{url('/files/blogs/'.$blogs[1]['slug'].'/1000x430'.$blogs[1]['icon'])}}" alt="">
                <div class="offer-text">
                    
                    <h3 class="text-white mb-3">{{$blogs[1]['title']}}</h3>
                    <a href="{{ route('blog_detail', [ $blogs[1]['slug'],  $blogs[1]['id']]) }}" class="btn btn-primary">İncele</a>
                </div>
            </div>
        </div>
    </div>
</div>