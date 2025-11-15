<div class="container-fluid pt-5">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Popüler Kategoriler</span></h2>
    <div class="row px-xl-5 pb-3">
        @foreach($popular_cats as $cat)
     
        <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
            <a class="text-decoration-none" href="">
                <div class="cat-item d-flex align-items-center mb-4">
                    <div class="overflow-hidden" style="width: 100px; height: 100px;">
                        @if(!empty($cat['icon']))
                        <img class="img-fluid" src="{{url('/files/categories/'.$cat['slug'].'/200x200'.$cat['icon'])}}" alt="">
                        @else 
                        <img class="img-fluid" src="{{url('/files/categories/book_item.png')}}" alt="">
                        @endif
                    </div>
                    <div class="flex-fill pl-3">
                        <h6><a href="{{route('category_detail',$cat['slug'])}}" style="color:black">
                            @foreach ($cat->parent_tree as $parent)
                             {{ $parent->name }}  @if($parent['id'] != $cat['id']) > @endif
                        @endforeach
                            </a>
                             </h6>
                        <small class="text-body">{{$cat['product_count']}} Ürün</small>
                    </div>
                </div>
            </a>
        </div>
        @endforeach

        
    </div>
</div>