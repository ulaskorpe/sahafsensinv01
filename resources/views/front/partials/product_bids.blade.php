            @php
                $bg = "light";
            @endphp
                @foreach($bids as $bid)

                @php
                $bg = ($bg == "secondary") ? "light": "secondary";
            @endphp

                <div class="row bg-{{$bg}} p-2">
                    <div class="col-md-3">{{\Carbon\Carbon::parse($bid['created_at'])->format('d.m.Y H:i')}} </div>
                    <div class="col-md-3">  {{$bid->user()->first()->name}}</div>
                    <div class="col-md-3">{{$bid['bid_price']}} &#8378;</div>


                </div>
                @endforeach

                <nav aria-label="Page navigation example" style="margin-top:30px">
                    <ul class="pagination justify-content-center">
                        @if($page>0)
                      <li class="page-item"><a class="page-link"  href="#product_bids" onclick="show_bids('{{$product_id}}','{{$page-1}}')"><i class="fa fa-solid fa-backward"></i>
                        </a></li>
                      @endif
                      @for($i=0;$i<$page_count;$i++)
                      @if($page==$i )
                      <li class="page-item active">
                        <a class="page-link" href="#">{{$i+1}}</a>
                          </li>
                      @else
                      <li class="page-item  ">
                        <a class="page-link" href="#product_bids" onclick="show_bids('{{$product_id}}','{{$i}}')">{{$i+1}}</a>
                          </li>
                      @endif

                      @endfor

                      @if($page<$page_count-1)
                      <li class="page-item"><a class="page-link"  href="#product_bids" onclick="show_bids('{{$product_id}}','{{$page+1}}')"><i class="fa fa-solid fa-forward"></i></a></li>
                      @endif
                    </ul>
                  </nav>

