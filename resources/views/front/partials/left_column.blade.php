<div class="col-lg-4">
    <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Öne Çıkanlar</span></h5>
    <div class="bg-light p-30 mb-5">
        @foreach($products as $pr)
     
        <div class="col-lg-12 col-md-12 col-sm-12 pb-1">
            <div class="product-item bg-light mb-4">
                <div class="product-img position-relative overflow-hidden">
                    <img class="img-fluid w-100" src="{{url('/files/products/'.$pr['slug'].'/500x500'.$pr['icon'])}}" style="max-height: 200px" alt="">
                    <div class="product-action">
                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                        <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                    </div>
                </div>
                <div class="text-center py-4">
                    <a class="h6 text-decoration-none text-truncate" href="">{{$pr['title']}}</a>
                    <div class="d-flex align-items-center justify-content-center mt-2">
                        <h5>{{$pr['current_price']}}  &#8378;</h5><h6 class="text-muted ml-2"><del>{{$pr['start_price']}} &#8378;</del></h6>
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
         
            
     
    @endforeach
</div>