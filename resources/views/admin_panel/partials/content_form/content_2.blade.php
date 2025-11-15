<div class="row form-group">

    <div class="col col-md-12">
        <label for="content_2" class=" form-control-label"><b>İçerik #2</b></label>
    </div>

    <div class="col col-md-12  pl-2 pr-2">


    <textarea name="content_2" id="content_2" class="form-control richtext" style="height: 300px">{{ ($post) ? $post->content_2 : ''}}</textarea>
</div>
</div>

