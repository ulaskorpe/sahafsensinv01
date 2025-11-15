<div class="col col-md-3"><label for="{{ $field }}" class="form-control-label"> <b>Youtube Video :</b></label></div>
<div class="col-12 col-md-9">

<input type="text" id="{{$field}}" name="{{$field}}"
    class="form-control">
</div>
@if(!empty($post->$field))

<div class="col col-md-3" ><label for="{{ $field }}" class="form-control-label">  </label></div>
<div class="col-12 col-md-9">

    <iframe width="560" style="margin-top:50px" height="315" src="https://www.youtube.com/embed/{{$post->$field}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
    <br>

    <a href="#" onclick="emptyField('{{$post->id}}','{{$field}}')"
    class="btn btn-primary w-[200px]"  style="width: 300px"  >{{$field}} Sil</a>

</div>




@endif