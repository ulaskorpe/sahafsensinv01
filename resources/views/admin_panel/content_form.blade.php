@extends("admin_panel.main_layout")

@section("css")

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" />

@if(in_array('content',$fields) || in_array('content_2',$fields))
<link rel="stylesheet" type="text/css" href="{{url('/richtexteditor/rte_theme_default.css')}}">
@endif

@endsection
@section('content')

<div class="row match-height">
    <div class="col-md-12">


        <div class="card" style="min-height: 1068px;">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h3>
                    @if($parent_id>0)
                    {{$parent->title}} &gt;

                    @endif
                    {{$type->name}} {{$exe}}</h3>
                <button class="btn btn-secondary"  style="margin-left:80%" onclick="history.back()">Geri Dön</button>
            </div>
            <div class="card-body collapse in">
                <div class="card-block ">
                    <div class="row match-height" style="padding-left: 50px;padding-right: 50px">
                        @if($submit==1)
                            <form id="content-form" name="content-form"
                            action="{{route($route)}}" method="post" enctype="multipart/form-data">
                        @else
                        <form id="content-form" name="content-form" onsubmit="return false"
                        action="#" method="post" enctype="multipart/form-data">
                        @endif

                        @if(!empty($slug_link))
                        <div class="row form-group">

                        <div class="col col-md-3"><label for=" " class="form-control-label"> <b>URL / Link</b></label></div>
                        <div class="col-12 col-md-9">

                            {{$slug_link}}
                        </div>
                        </div>
                        @endif


                            <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="parent_id" id="parent_id" value="{{$parent_id }}">

                            @if(!empty($post))
                                <input type="hidden" name="id" value="{{$post->id}}" >
                            @endif

                                @foreach($fields as $field)
                                <div class="row form-group">
                                @if($field=='count' && !empty($parent_cat))
                                   <div id="count_div">
                                         @include("admin_panel.partials.content_form.".$field)

                                   </div>
                                    @else
                                    @include("admin_panel.partials.content_form.".$field)
                                    @endif
                                </div>
                                @endforeach

                                @if($type['single']==0)
                                <div class="row form-group">
                                <div class="col col-md-3"><label for="{{ $field }}" class="form-control-label"> <b>Göster :</b></label></div>
                                <div class="col-12 col-md-1">
                                    @if(!empty($post))
                                    <input type="checkbox" id="show_post" name="show_post" class="form-control" value="13" {{ ($post->show_post) ? 'checked' : ''}}>
                                    @else
                                    <input type="checkbox" id="show_post" name="show_post" class="form-control" value="13"  checked>
                                    @endif

                                </div>
                                </div>
                                @else
                                    <input type="hidden"  id="show_post" name="show_post" value="13">

                                @endif

                                @if(empty($post) &&false)
                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="{{ $field }}" class="form-control-label"> <b>Diğer Dillere de kopyala :</b></label></div>
                                    <div class="col-12 col-md-1">

                                        <input type="checkbox" id="copy_others" name="copy_others" class="form-control" value="13"   >


                                    </div>
                                    </div>
                                    @endif

                            <div class="row form-group">
                                <div class="col col-md-3"><label  ></label></div>
                                    @if($submit==1)
                                    <input type="submit" value="{{$exe}}" onmouseover="fillblog()">
                                    @else
                                <div class="col-12 col-md-9 "><button onclick="formSubmit()" id="submit_button"
                                        class="btn btn-primary w-[200px]"  style="width: 300px"  onmouseover="fillblog()">{{$exe}}</button></div>

                                        @endif
                            </div>
                        </form>



                        </div>



                </div>
            </div>
        </div>
    </div>
    </div>
  </div>


</div>
@endsection

@section('scripts')




<script src="{{url('/assets/js/saveV3.js')}}" type="text/javascript"></script>

<script src="{{url('/robust-assets/js/core/libraries/jquery_ui/jquery-ui.min.js')}}" type="text/javascript"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js"></script>

@if(in_array('content',$fields) || in_array('content_2',$fields))


<script src="{{url('/richtexteditor/rte.js')}}" type="text/javascript"></script>
<script src="{{url('/richtexteditor/plugins/all_plugins.js')}}" type="text/javascript"></script>

@endif
    <!-- /build-->
<script>

$(document).ready(function() {
        $('#tags').selectize({
            plugins: ['remove_button'], // Adds "X" button to remove items
            delimiter: ',',
            persist: false,
            create: function(input) {
                return {
                    value: input,
                    text: input
                };
            }
        });
    });

    @if(in_array('content',$fields) || in_array('content_2',$fields))
let editorContentInstance = null;
let editorContent2Instance = null;

document.addEventListener('DOMContentLoaded', function () {
    const contentTextarea = document.getElementById('content');
    if (contentTextarea) {
        editorContentInstance = new RichTextEditor(contentTextarea);
    }

    const content2Textarea = document.getElementById('content_2');
    if (content2Textarea) {
        editorContent2Instance = new RichTextEditor(content2Textarea);
    }
});


function fillblog(){

    if (editorContentInstance) {
        editorContentInstance.syncToTextarea();
    }
    if (editorContent2Instance) {
        editorContent2Instance.syncToTextarea();
    }
}

@else
function fillblog(){}
@endif

@if(in_array('image',$fields))
document.getElementById('image').addEventListener('change', function(event) {
    const file = event.target.files[0];
    const reader = new FileReader();

    reader.onload = function(e) {
        document.getElementById('previewImage').src = e.target.result;
        $('#preview_pic').show();
        $('#preview_image').hide();

    };

    reader.readAsDataURL(file);
});
@endif


@if(in_array('second_image',$fields))
document.getElementById('second_image').addEventListener('change', function(event) {
    const file = event.target.files[0];
    const reader = new FileReader();

    reader.onload = function(e) {
        document.getElementById('previewImage2').src = e.target.result;
        $('#preview_pic2').show();
        $('#preview_second_image').hide();
    };

    reader.readAsDataURL(file);
});
@endif

@if(in_array('third_image',$fields))
document.getElementById('third_image').addEventListener('change', function(event) {
    const file = event.target.files[0];
    const reader = new FileReader();

    reader.onload = function(e) {
        document.getElementById('previewImage3').src = e.target.result;
        $('#preview_pic3').show();
        $('#preview_third_image').hide();
    };

    reader.readAsDataURL(file);
});
@endif


@if(in_array('forth_image',$fields))
document.getElementById('forth_image').addEventListener('change', function(event) {
    const file = event.target.files[0];
    const reader = new FileReader();

    reader.onload = function(e) {
        document.getElementById('previewImage4').src = e.target.result;
        $('#preview_pic4').show();
        $('#preview_forth_image').hide();
    };

    reader.readAsDataURL(file);
});
@endif

@if(in_array('fifth_image',$fields))
document.getElementById('fifth_image').addEventListener('change', function(event) {
    const file = event.target.files[0];
    const reader = new FileReader();

    reader.onload = function(e) {
        document.getElementById('previewImage5').src = e.target.result;
        $('#preview_pic5').show();
        $('#preview_fifth_image').hide();
    };

    reader.readAsDataURL(file);
});
@endif



function emptyField(id,field){
            Swal.fire({
            title: field+' silinecek eminmisiniz',

            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Evet!',
            cancelButtonText: 'Hayır'
        }).then((result) => {
            // If confirmed
            if (result.isConfirmed) {
                window.open("/admin-panel/content/empty_field/"+id+"/"+field,"_self");
            }
        });
        }


async function formSubmit() {


let error = false;
fillblog();
@foreach($fields as $field)
    @if(  !in_array($field,['image','second_image','third_image','forth_image','fifth_image','tags','youtube_video']))


if ($('#{{$field}}').val() == '') {

$('#{{$field}}').focus();
Swal.fire({
    icon: 'error',
    text: '{{$field}} giriniz'
});

error = true;
return false;
}
  @endif
@endforeach

//console.log(error);
 var formData = new FormData(document.getElementById('content-form'));
 //console.log(formData);
 $('#submit_button').prop('disabled',true);
 save(formData, '{{route($route)}}', '', '');

setTimeout(() => {
    window.open("/admin-panel/content/list/{{$type->slug}}/{{$lang}}/{{$parent_id}}", "_self")
    //location.reload();
}, 2000);

}
@if(!empty($parent_cat['id']))
function count_select(cat_id,post_id){
//alert(cat_id+" Ç:: "+post_id);
$.get( "/admin-panel/content/count-select/"+cat_id+"/{{$type['id']}}/"+post_id, function( data ) {
  $( "#count_div" ).html( data );

});

}
@endif


</script>
@endsection
