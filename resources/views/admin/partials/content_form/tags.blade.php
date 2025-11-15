


<div class="col col-md-3"><label for="{{ $field }}" class="form-control-label"> <b>Etiketler   </b></label></div>
<div class="col-3 col-md-9">


    <select id="tags" name="tags[]" multiple class="form-control">
 @foreach($tags as $tag)
        <option value="{{$tag['id']}}"  @if(in_array($tag['id'],$selected_tags)) selected @endif>{{$tag['title']}}</option>
 @endforeach
    </select>

</div>

