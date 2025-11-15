 
<div class="col col-md-3"><label for="{{ $field }}" class="form-control-label"> <b>Ürün Seçiniz   </b></label></div>
<div class="col-3 col-md-2">
    <select name="product_id" id="product_id" class="form-control" >
        <option value="0">Linki Kullan</option>
    @if( empty($post))

    @foreach ($products as $product )
        <option value="{{$product['id']}}">{{$product['title']}}</option>
    @endforeach

    @else
    @foreach ($products as $product )
    <option value="{{$product['id']}}" @if($product['id']==$post['product_id']) selected @endif> {{$product['title']}}</option>
@endforeach

    @endif
</select>
</div>
 
