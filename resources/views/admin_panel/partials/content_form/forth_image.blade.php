<div class="col col-md-3"><label for="file-input" class=" form-control-label"><b>Görsel #4</b>
</label></div>
<div class="col-12 col-md-9"><input type="file" id="forth_image" name="forth_image"
class="form-control-file">


<div class="row" id="preview_pic4" style="display: none">
   <div class="col col-md-3"></div>
   <div class="col-12 col-md-9">
       <img id="previewImage4" src="#" alt="Preview Image-3"
           style="max-width: 200px">
   </div>
</div>
@if(!empty($post[$field]))
<div class="row" id="preview_forth_image" >
    <div class="col col-md-3"></div>
    <div class="col-12 col-md-9">
        <img id="" src="{{url('post_images/'.$post->forth_image)}}" alt=""
            style="max-width: 200px">
            <br>
            <a href="#" onclick="emptyField('{{$post->id}}','{{$field}}')"
                class="btn btn-primary w-[200px]"  style="width: 300px"  >{{$field}} Sil</a>
    </div>
</div>
@else
<div class="row" id="preview_forth_image" ></div>


 @endif
</div>
