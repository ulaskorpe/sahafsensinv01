<div class="row mb-0">
    <div class="col-12  mb-2  d-flex justify-content-end">
        <p>Ürün Hakkında Yorum ve Görüşlerinizi belirtmen için</p>
    </div>
    <div class="col-12  mb-2 d-flex justify-content-end">
        <input type="button" value="Tıklayın" onclick="make_comment('{{$product_id}}',0)"  class="btn btn-primary px-3">
    </div>
</div>
@php
$bg = "light";
@endphp
@foreach($comments as $comment)

@php
$bg = ($bg == "secondary") ? "light": "secondary";
@endphp

<div class="row bg-{{$bg}}">
    <div class="col-md-12">

        <div class="media mb-4">

            <div class="media-body">
                <h6  class="mt-3">{{$comment->user()->first()->name}}<small> - <i>{{\Carbon\Carbon::parse($comment['created_at'])->format('d.m.Y H:i')}}</i></small></h6>

                <p class="mt-3">{{$comment['comment']}} </p>
                <div class="col-12 d-flex mb-2 justify-content-end">
                    <input type="button" onclick="make_comment('{{$product_id}}','{{$comment['id']}}')"  value="Yanıtla" class="btn btn-primary px-3">
                </div>
            </div>


        </div>
    </div>


</div>
@foreach($comment->answers()->get() as $answer)
<div class="row bg-light p-5">
    <div class="col-md-12">

        <div class="media mb-4">

            <div class="media-body">
                <h6  class="mt-3">{{$answer->user()->first()->name}}<small> - <i>{{\Carbon\Carbon::parse($answer['created_at'])->format('d.m.Y H:i')}}</i></small></h6>

                <p class="mt-3">{{$answer['comment']}} </p>

            </div>


        </div>
    </div>


</div>
@endforeach

@endforeach

<nav aria-label="Page navigation example" style="margin-top:30px">
    <ul class="pagination justify-content-center">
        @if($page>0)
      <li class="page-item"><a class="page-link"  href="#product_comments" onclick="show_comments('{{$product_id}}','{{$page-1}}')"><i class="fa fa-solid fa-backward"></i>
        </a></li>
      @endif
      @for($i=0;$i<$page_count;$i++)
      @if($page==$i )
      <li class="page-item active">
        <a class="page-link" href="#">{{$i+1}}</a>
          </li>
      @else
      <li class="page-item  ">
        <a class="page-link" href="#product_comments" onclick="show_comments('{{$product_id}}','{{$i}}')">{{$i+1}}</a>
          </li>
      @endif

      @endfor

      @if($page<$page_count-1)
      <li class="page-item"><a class="page-link"  href="#product_comments" onclick="show_comments('{{$product_id}}','{{$page+1}}')"><i class="fa fa-solid fa-forward"></i></a></li>
      @endif
    </ul>
  </nav>

