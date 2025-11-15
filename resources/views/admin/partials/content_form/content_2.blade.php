
<div class="row form-group">

    <div class="col col-md-12"><label for="file-input" class=" form-control-label"><b>İçerik #2</b>
    </label></div>
@if(false)
    <div class="col col-md-12  pl-2 pr-2">
        <input type="hidden" name="content" id="content" value="{{ ($post) ? $post->content : ''}}">
        <div id="div_editor1">@php
                 if(!empty($post)){
                    echo $post->content;
                 }
             @endphp</div>
    </div>
    @endif

    <div class="col col-md-12  pl-2 pr-2">

         <textarea name="content_2" id="content_2" class="form-control" style="height: 300px">{{ ($post) ? $post->content_2 : ''}}</textarea>
</div>
