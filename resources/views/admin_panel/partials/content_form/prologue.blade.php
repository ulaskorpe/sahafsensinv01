<div class="col col-md-3"><label for="{{ $field }}" class="form-control-label"> <b>Ön Yazı</b></label></div>
<div class="col-12 col-md-9">

    <textarea  id="{{$field}}" name="{{$field }}"  class="form-control" > {{ ($post) ? $post->prologue : ''}}</textarea>

</div>
