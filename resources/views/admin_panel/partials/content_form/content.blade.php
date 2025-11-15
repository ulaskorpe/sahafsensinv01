<div class="row form-group">

    <div class="col col-md-12">
        <label for="content" class=" form-control-label"><b>İçerik #1</b></label>
    </div>



    <div class="col col-md-12  pl-2 pr-2">


         <textarea name="content" id="content" class="form-control richtext" style="height: 300px">{{ ($post) ? $post->content : ''}}</textarea>
        </div>
        </div>
