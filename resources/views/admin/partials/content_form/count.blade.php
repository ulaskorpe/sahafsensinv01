
@if($type->single == 0)



<div class="col col-md-3"><label for="{{ $field }}" class="form-control-label"> <b>Sıra   </b></label></div>
<div class="col-3 col-md-2">
    <select name="count" id="count" class="form-control" @if(!empty($parent_cat['id'])) disabled @endif  >
    @if( empty($post))

    @for($i=$count+1;$i>0;$i--)
    <option value="{{$i}}">{{$i}}</option>
    @endfor

    @else
    @for($i=1;$i<$count+1;$i++)
    <option value="{{$i}}" @if($post['count']==$i) selected @endif>   {{$i}}</option>
    @endfor

    @endif
</select>
</div>
@else
    <input type="hidden" name="count" id="count" value="1">
@endif
 