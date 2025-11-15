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
                    <div class="col-md-3" >
                      <h1> Kullanıcı Mesajları</h1>
                    </div>
                    <div class="col-md-5" >
                    </div>
                    <div class="col-1 col-md-1">


                    </div>
                    <div class="col-1 d-flex flex-row-reverse">



                    </div>

                </div>



            </div>
            <div class="card-body collapse in">
                <div class="card-block">
                    <table id="example" class="table table-striped table-bordered">
                        <thead>
                            <tr>

                                <th>Gönderen</th>

                                <th>Form</th>
                                <th>Tedavi</th>
                                <th>Okundu</th>
                                <th>Oluşturulma Tarihi</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                                <tr>

                                    <td>{{$post['name_surname']}}
                                                <br>
                                                {{$post['email']}}<br>{{$post['phone']}}

                                    </td>

                                    <td>{{$post['used_form']}}</td>
                                    <td>
                                        @if($post['treatment_id']>0)
                                            {{$post->treatment()->first()->title}}
                                        @endif

                                    </td>
                                    <td>

                                        @if($post['is_read'])
                                        <i class="bi bi-check-circle-fill"></i>
                                            @if($post['reply_text'])
                                            <br>( Yanıtlandı )
                                            @endif

                                        @else

                                        <i class="bi bi-x-circle-fill"></i>
                                        @endif

                                    </td>



                                    <td>{{ \Carbon\Carbon::parse($post->created_at)->format('d.m.Y H:i') }}   </td>

                                    <td  >
                                        <button class="jsgrid-button jsgrid-edit-button btn btn-sm btn-success" title="Düzenle" onclick="updateItem({{$post->id}})">
                                            <i class="bi bi-pencil"></i>
                                        </button>

                                        <button class="jsgrid-button jsgrid-delete-button btn btn-sm btn-danger" title="Sil" onclick="deleteContent({{$post->id}})">
                                            <i class="bi bi-trash"></i>
                                        </button>






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

        $('#example').DataTable();

    });



    function updateItem(id){
        window.open("/admin-panel/message-view/"+id,"_self");
    }


    function deleteContent(id){
            Swal.fire({
            title: 'mesaj silinecek eminmisiniz',

            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Evet!',
            cancelButtonText: 'Hayır'
        }).then((result) => {
            // If confirmed
            if (result.isConfirmed) {
                window.open("/admin-panel/messages-delete/"+id,"_self");
            }
        });
        }
</script>
@endsection
