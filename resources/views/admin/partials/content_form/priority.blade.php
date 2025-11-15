

<div class="col col-md-3"><b>Öncelik :</b></div>
<div class="col-12 col-md-5">
@if(empty($post))
    <select name="priority" class="form-control" id="priority">

        @foreach($video_image_array as $item)
        <option value="{{$item}}">{{$item}}</option>
        @endforeach

    </select>
    @else

    <select name="priority" class="form-control" id="priority">

        @foreach($video_image_array as $item)
        <option value="{{$item}}" @if($post->priority == $item) selected @endif>  {{$item}}</option>
        @endforeach

    </select>

    @endif
</div>


