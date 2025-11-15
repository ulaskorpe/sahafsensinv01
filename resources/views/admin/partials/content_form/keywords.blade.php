<div class="col col-md-3"><label for="{{ $field }}" class="form-control-label"> <b>Keywords:</b></label></div>
<div class="col-12 col-md-9">

<input type="text" id="{{$field}}" name="{{$field}}" max="255" value="{{ ($post) ? $post->keywords : ''}}"
    class="form-control"> ( virgül ile ayırınız )
</div>
