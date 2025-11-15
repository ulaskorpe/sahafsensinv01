<div class="container-fluid pt-5 pb-3">
    <div class="row px-xl-5">
        @for($i=0;$i<2;$i++)
        @php
             $x = rand(1,2);
        @endphp
        <div class="col-md-6">
            <div class="product-offer mb-30" style="height: 300px;">
                <img class="img-fluid" src="{{url('/files/blogs/'.$blogs[$i]['slug'].'/1000x430'.$blogs[$i]['icon'])}}" alt="">
                <div class="offer-text">
                    <h3 class="text-white mb-3"> {{$blogs[$i]['title']}}</h3>
                    <h6 class="text-white text-uppercase">{{$blogs[$i]['prologue']}}</h6>
                  
                    <a href="{{ route('blog_detail', ['slug' => $blogs[$i]['slug'], 'id' => $blogs[$i]['id']]) }}" class="btn btn-primary">İncele</a>
                </div>
            </div>
        </div>
        @endfor
         
    </div>
</div>