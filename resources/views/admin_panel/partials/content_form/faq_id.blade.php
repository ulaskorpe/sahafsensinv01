<div class="col col-md-3"><label for="{{ $field }}" class="form-control-label" > <b>SSS Kategori:</b></label></div>
<div class="col-5 col-md-5">

    @if(!empty($post))

    @php

    $selected  = ($post->type_id==9) ? $post['parent_id']:$post['faq_id'];
@endphp
<select name="faq_id" id="faq_id" class="form-control" >
    <option value="NoCat">SSS Yok</option>
    @foreach($cats as $cat)
    <option value="{{$cat['id']}}" @if($cat['id']==$selected) selected @endif>{{$cat['title']}}</option>
    @endforeach

</select>
@else

<select name="faq_id" id="faq_id" class="form-control" >

    <option value="NoCat">SSS Yok</option>
    @foreach($cats as $cat)

    <option value="{{$cat['id']}}"   @if($cat['id']==$parent_id) selected @endif> {{$cat['title']}}</option>
    @endforeach

</select>
@endif
</div>

