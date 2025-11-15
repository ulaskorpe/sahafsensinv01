<div class="container-fluid py-5">
    <h2 class="section-title position-relative  mx-xl-5 mb-4"><span class="bg-secondary pr-3">İlginizi Çekebilir</span></h2>
    <div class="row px-xl-5">
        <div class="col">
            <div class="owl-carousel related-carousel">
                @foreach($similar as $pr)
                <div class="product-item bg-light">
                    <div class="product-img position-relative overflow-hidden">
                        <img class="img-fluid w-100" src="{{url('/files/products/'.$pr['slug'].'/500x500'.$pr['icon'])}}"   alt="{{$pr['slug']}}">
                        <div class="product-action">
                            @include("front.partials.product_action")
                        </div>
                    </div>
                    <div class="text-center py-4">
                        <a class="h6 text-decoration-none text-truncate" href="{{route('product_detail',[$pr["slug"],$pr['id']])}}">{{$pr['title']}}</a>
                        
                        <div class="d-flex align-items-center justify-content-center mt-2">
                            <h5>{{$pr['current_price']}} &#8378;</h5><h6 class="text-muted ml-2"><del>{{$pr['start_price']}} &#8378;</del></h6>
                        </div>
                        <div class="d-flex align-items-center justify-content-center mb-1">
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small>(99)</small>
                        </div>
                    </div>
                </div>
                @endforeach
                 
              
              
            </div>
        </div>
    </div>
</div>