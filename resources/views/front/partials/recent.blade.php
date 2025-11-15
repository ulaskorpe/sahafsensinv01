<div class="container-fluid pt-5 pb-3">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Son Eklenenler</span></h2>
    <div class="row px-xl-5">
        @foreach($recent as $pr)
        <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
            <div class="product-item bg-light mb-4">
                <div class="product-img position-relative overflow-hidden">
                    <img class="img-fluid w-100" src="{{url('/files/products/'.$pr['slug'].'/500x500'.$pr['icon'])}}"
                    
                    style="height: 300px;width:auto"
                    alt="">
                    <div class="product-action">
                        <a class="btn btn-outline-dark btn-square" href="#" onclick="add_to_chart({{$pr['id']}})"><i class="fa fa-shopping-cart"></i></a>
                        <a class="btn btn-outline-dark btn-square" href="#" onclick="add_to_favorites({{$pr['id']}})"><i class="far fa-heart"></i></a>
                        @if(false)
                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                        @endif
                        
                    </div>
                </div>
                <div class="text-center py-4">
                    <a class="h6 text-decoration-none text-truncate" href="{{route('product_detail',[$pr['slug'],$pr['id']])}}">{{$pr['title']}}</a>
                    <div class="d-flex align-items-center justify-content-center mt-2">
                        <h5>{{$pr['current_price']}} &#8378;</h5><h6 class="text-muted ml-2"><del>{{$pr['start_price']}} &#8378;</del></h6>
                    </div>
                    <div class="d-flex align-items-center justify-content-center mb-1">
                        <small class="fa fa-star text-primary mr-1"></small>
                        <small class="fa fa-star text-primary mr-1"></small>
                        <small class="fa fa-star text-primary mr-1"></small>
                        <small class="fa fa-star text-primary mr-1"></small>
                        <small class="fa fa-star text-primary mr-1"></small>
                        <small>({{$pr['bid_count']}})</small>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
 
    </div>
</div>