<div class="col col-md-3"><label for="{{ $field }}" class="form-control-label" > <b>Dil Seçiniz</b></label></div>
<div class="col-3 col-md-2">

    @if(empty($post))
<select name="lang" id="lang" class="form-control" onchange="window.open('/admin-panel/content/create/{{$type->slug}}/'+this.value+'/{{$parent_id}}','_self')">
    @foreach($langs as $lg)
    <option value="{{$lg}}" @if($lg==$lang) selected @endif>{{$lg}}</option>
    @endforeach

</select>
@else


@if($type->single == 1)
<select name="lang" id="lang" class="form-control" onchange="window.open('/admin-panel/content/change_lang/{{$post->type_id}}/'+this.value ,'_self')">
    @foreach($langs as $lg)
    <option value="{{$lg}}" @if($lg==$lang) selected @endif> {{$lg}}</option>
    @endforeach

</select>
    @else
    <b>{{$lang}}</b>
    <input type="hidden" name="lang" id="lang" value="{{$lang}}">
    @endif


@endif
</div>

