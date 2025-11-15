
@if($type->single == 0)

 
<div class="col col-md-3"><label for="count" class="form-control-label"> <b>Sıra   </b></label></div>
<div class="col-3 col-md-2">
    
    @if( empty($post) )
    <select name="count" id="count" class="form-control"   >
    @for($i=$count+1;$i>0;$i--)
    <option value="{{$i}}">{{$i}}</option>
    @endfor

    @else
    <select name="count" id="count" class="form-control"    >
@if(!empty($cat_id))  

        @if($cat_id == $post['parent_id'])

        @for($i=1;$i<$count+1;$i++)
        <option value="{{$i}}" @if($post['count']==$i ) selected @endif>  {{$i}}</option>
        @endfor

        @else

        @for($i=$count;$i>0;$i--)
        <option value="{{$i}}" >  {{$i}}</option>
        @endfor


        @endif


@else

     
     
  
      
    @for($i=1;$i<$count+1;$i++)
    <option value="{{$i}}" @if($post['count']==$i ) selected @endif>  {{$i}}</option>
    @endfor

    @endif

    @endif
</select>
</div>
@else
    <input type="hidden" name="count" id="count" value="1">
@endif
 