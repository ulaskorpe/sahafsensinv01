<div class="col col-md-3"><label for="{{ $field }}" class="form-control-label"> <b>URL / Link</b></label></div>
<div class="col-12 col-md-9">

<input type="text" id="{{$field}}" name="{{$field}}" value="{{ ($post) ? $post->link : ''}}"
    class="form-control">
</div>
