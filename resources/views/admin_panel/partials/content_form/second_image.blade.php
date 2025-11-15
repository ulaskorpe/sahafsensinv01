<div class="col col-md-3"><label for="file-input" class=" form-control-label"><b>Görsel #2</b>
</label></div>
<div class="col-12 col-md-9"><input type="file" id="second_image" name="second_image"
class="form-control-file">


<div class="row" id="preview_pic2" style="display: none">
   <div class="col col-md-3"></div>
   <div class="col-12 col-md-9">
       <img id="previewImage2" src="#" alt="Preview Image-2"
           style="max-width: 200px">
   </div>
</div>
@if(!empty($post['second_image']))
<div class="row" id="preview_second_image" >
    <div class="col col-md-3"></div>
    <div class="col-12 col-md-9">
        <img id="" src="{{url('post_images/'.$post->second_image)}}" alt=" "
            style="max-width: 200px"><br>
            <a href="#" onclick="emptyField('{{$post->id}}','{{$field}}')"
                class="btn btn-primary w-[200px]"  style="width: 300px"  >{{$field}} Sil</a>
    </div>
</div>
@else
<div class="row" id="preview_second_image" ></div>


 @endif
</div>
