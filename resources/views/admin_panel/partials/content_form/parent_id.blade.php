<div class="col col-md-3"><label for="{{ $field }}" class="form-control-label" > <b>Kategori:</b></label></div>
<div class="col-5 col-md-5">

    @if(!empty($post))

 
<select name="parent_id" id="parent_id" class="form-control" onchange="count_select(this.value,{{$post['id']}})">
    <option value="NoCat">Seçiniz</option>
    @foreach($product_cats as $cat)
    <option value="{{$cat['id']}}" @if($cat['id']==$post['parent_id']) selected @endif> {{$cat['title']}}</option>
    @endforeach

</select>
@else

<select name="parent_id" id="parent_id" class="form-control"  onchange="count_select(this.value,0,{{$type['id']}})">

    <option value="NoCat">Seçiniz</option>
    @foreach($product_cats as $cat)

    <option value="{{$cat['id']}}"   @if($parent_id == $cat['id']) selected @endif 
   >  {{$cat['title']}}</option>
    @endforeach

</select>
@endif
</div>

