@if($type['single']==0)
<div class="row form-group">
<div class="col col-md-3"><label for="{{ $field }}" class="form-control-label"> <b>Anasayfada göster :</b></label></div>
<div class="col-12 col-md-1">
    @if(!empty($post))
    <input type="checkbox" id="show_home" name="show_home" class="form-control" value="13" {{ ($post->show_home) ? 'checked' : ''}}>
    @else
    <input type="checkbox" id="show_home" name="show_home" class="form-control" value="13"  checked>
    @endif

</div>
</div>
@else
    <input type="hidden"  id="show_home" name="show_home" value="13">

@endif
