<div class="col-lg-3 col-md-4 col-sm-6 pb-1"  >
    <div class="product-item bg-light mb-4">
        <div class="product-img position-relative overflow-hidden">
            <img class="img-fluid w-100" src="{{url('/files/products/'.$pr['slug'].'/500x500'.$pr['icon'])}}" style="max-height: 200px" alt="">
            <div class="product-action">
              @include("front.partials.product_action")
            </div>
        </div>
        <div class="text-center py-4">
           
            <a class="h6 text-decoration-none text-truncate" href="{{route('product_detail',[$pr["slug"],$pr['id']])}}">{{$pr['title']}}</a>
            <div class="d-flex align-items-center justify-content-center mt-2">
                <h5>{{$pr['current_price']}}    &#8378;</h5><h6 class="text-muted ml-2"><del>{{$pr['start_price']}} &#8378;</del></h6>
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
</div>