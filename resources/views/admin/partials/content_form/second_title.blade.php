<div class="col col-md-3"><label for="{{ $field }}" class="form-control-label"> <b>Alt Başlık</b></label></div>
<div class="col-12 col-md-9">

<input type="text" id="{{$field}}" name="{{$field}}" value="{{ ($post) ? $post->$field : ''}}"
    class="form-control">
</div>
