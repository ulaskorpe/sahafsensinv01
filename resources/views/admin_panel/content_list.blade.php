@extends("admin_panel.main_layout")

@section("css")


<link rel="stylesheet" type="text/css" href="{{url('/robust-assets/css/dataTables.bootstrap5.min.css')}}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

@endsection
@section('content')

<div class="row match-height">
    <div class="col-md-12">
        <div class="card" style="min-height: 1068px;">
            <div class="card-header d-flex align-items-center justify-content-between">
                <div class="row"  >
                    <div class="col-md-6" >
                        <h3>
                        @if($parent_id>0)
                        {{$parent->title}} &gt;
                        @endif
                         {{$type->name}} Liste</h3>
                    </div>
                    <div class="col-md-5" >
                    </div>
                    <div class="col-2 col-md-2">
                        <select name="lang" id="lang" class="form-control" onchange="window.open('/admin-panel/content/list/{{$type->slug}}/'+this.value+'/{{$parent_id}}','_self')">
                            @foreach($langs as $lg)
                            <option value="{{$lg}}" @if($lg==$lang) selected @endif>{{$lg}}</option>
                            @endforeach

                        </select>

                    </div>

                    @if(in_array('parent_id',$fields) )
                    <div class="col-2 col-md-2">
                    <select name="parent_id" id="parent_id" class="form-control" onchange="select_cat()">
                        <option value="0"> No Category</option>
                        @foreach($parents as $parent)
                        <option value="{{$parent['id']}}" @if($parent['id']==$parent_id) selected @endif>{{$parent['title']}}</option>
                        @endforeach
                    </select>
                </div>
                    @endif

                    <div class="col-1 d-flex flex-row-reverse">


                        @if($type->single == 0)
                        <button class="btn btn-primary  "  onclick="createItem()">Yeni  {{ $type->name }}</button>



                        @else
                        <button class="btn btn-primary  " id="submit_button"  onclick="copyOthers()">Diğer Dillere Kopyala</button>
                        <form id="copy-form" name="copy-form" onsubmit="return false"
                        action="#" method="post" enctype="multipart/form-data">


                            <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="lang" id="lang" value="{{ $lang }}">
                            <input type="hidden" name="slug" id="slug" value="{{ $type->slug }}">


                        </form>


                        @endif

                    </div>

                </div>



            </div>
            <div class="card-body collapse in">
                <div class="card-block">
                    <table id="example" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                @if($type->single == 0)
                                <th>Sıra</th>
                                <th>Göster</th>
                                @endif
                                @if(in_array('image',$fields) || in_array('second_image',$fields))

                                <th>Icon</th>
                                @endif

                                @if(in_array('youtube_video',$fields) )

                                <th>youtube</th>
                                @endif

                                <th>Başlık</th>

                                @if(in_array('parent_id',$fields) )
                                <th>Kategori</th>
                                @endif
                                <th>Oluşturulma Tarihi</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                                <tr>
                                    @if($type->single == 0)
                                    <td>{{$post->count}}  </td>
                                    <td>

                                        @if($post->show_post)

                                        <i class="icon-check"></i>
                                        @else
                                        <i class="icon-close2"></i>
                                        @endif

                                        @if($post->show_home)
                                        <i class="icon-check"></i>
                                        @endif
                                    </td>
                                    @endif


                                    @if(in_array('image',$fields) || in_array('second_image',$fields))

                                    <td  >

                                            @if(!empty($post['image']))
                                            <img src="{{url('post_images/icon_'.$post->image)}}" alt="" >

                                            @else
                                        <img src="{{url('post_images/icon_'.$post->second_image)}}" alt="" >

                                            @endif
                                    </td>
                                    @endif

                                    @if(in_array('youtube_video',$fields) )

                                    <td>

                                        <img src="https://img.youtube.com/vi/{{$post['youtube_video']}}/hqdefault.jpg " alt="" style="width:200px">
                                    </td>
                                    @endif

                                    <td style="width: 20%" >{{ $post->title }}</td>

                                    @if(in_array('parent_id',$fields) )

                                    <td>
                                        @if($post['parent_id']>0)
                                        <a href="{{url('/admin-panel/content/list/'.$type['slug'].'/'.$lang.'/'.$post['parent_id'])}}">   {{$post->parent()->first()->title}}
                                        </a>

                                            @endif
                                    </td>
                                    @endif

                                    <td>{{ \Carbon\Carbon::parse($post->created_at)->format('d.m.Y H:i') }}   </td>

                                    <td style="width: 20%" >
                                        <button class="jsgrid-button jsgrid-edit-button btn btn-sm btn-success" title="Düzenle" onclick="updateItem({{$post->id}})">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        @if($type->single == 0  )
                                        <button class="jsgrid-button jsgrid-delete-button btn btn-sm btn-danger" title="Sil" onclick="deleteContent({{$post->id}})">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                        @endif



                                        @if($type->children && !in_array($post->id, [15,16,17]))



                                        <button class="jsgrid-button   btn btn-sm btn-warning" title="subs" onclick="window.open('/admin-panel/content/list/{{$type->children}}/{{$lang}}/{{$post->id}}','_self')">
                                            <i class="icon-server"></i>
                                        </button>
                                        @endif

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


</div>
@endsection

@section('scripts')

<script src="{{url('/robust-assets/js/jquery.dataTables.min.js')}}" type="text/javascript"></script>
<script src="{{url('/robust-assets/js/dataTables.bootstrap5.min.js')}}" type="text/javascript"></script>

<script src="{{url('/assets/js/saveV3.js')}}" type="text/javascript"></script>


    <!-- /build-->
<script>


    $(document).ready(function () {
        @if($type->single == 0)
        $('#example').DataTable();
        @endif
    });



    @if(in_array('parent_id',$fields) )
    function select_cat(){
     //   alert($('#parent_id').val());
        window.open("{{url('/admin-panel/content/list/'.$type['slug'].'/'.$lang.'/')}}/"+$('#parent_id').val(), '_self');
    }
    @endif
    function createItem(){
        window.open("{{route('content-create',[$type->slug,$lang,$parent_id])}}","_self");
    }

    function updateItem(id){
        window.open("/admin-panel/content/update/"+id,"_self");
    }

    @if($type->single == 0)

    function deleteContent(id){
            Swal.fire({
            title: '{{$type->name}} silinecek eminmisiniz',

            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Evet!',
            cancelButtonText: 'Hayır'
        }).then((result) => {
            // If confirmed
            if (result.isConfirmed) {
                window.open("/admin-panel/content/delete/"+id,"_self");
            }
        });
        }
@else
function copyOthers(){

Swal.fire({
            title: '{{$type->name}} diğer dillere kopyalanacak eminmisiniz',

            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Evet!',
            cancelButtonText: 'Hayır'
        }).then((result) => {
            // If confirmed/copy_others/{type}/{lang}
            if (result.isConfirmed) {
                var formData = new FormData(document.getElementById('copy-form'));
 //console.log(formData);
 $('#submit_button').prop('disabled',true);
 save(formData, "{{route('content-copy-others')}}", '', '');

setTimeout(() => {
   // window.open("/admin-panel/content/list/{{$type->slug}}/{{$lang}}", "_self")
   $('#submit_button').prop('disabled',false);
}, 2000);
            }
        });
        }

        @endif

</script>
@endsection
