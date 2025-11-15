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
                      <h1> Mesaj Detay </h1>
                    </div>
                    <div class="col-md-5" >
                        <div class="card-header d-flex align-items-center justify-content-between">

                            <button class="btn btn-secondary"  style="margin-left:80%" onclick="window.open('/admin-panel/messages','_self')">Geri Dön</button>
                        </div>
                    </div>
                    <div class="col-1 col-md-1">


                    </div>
                    <div class="col-1 d-flex flex-row-reverse">
                        <form id="content-form" name="content-form"
                        action="#" method="post" enctype="multipart/form-data" onsubmit="return false">
                        <input type="hidden" name="id" id="id" value="{{$contact['id']}}">
                        <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                        <table id="example" class="table table-striped table-bordered">
                            <tr><td style="width: 20%">Gönderen :</td><td>{{$contact['name_surname']}}</td></tr>
                            <tr><td style="width: 20%">Eposta :</td><td>{{$contact['email']}}</td></tr>
                            <tr><td style="width: 20%">Telefon :</td><td>{{$contact['phone']}}</td></tr>
                            @if($contact['treatment_id'])
                            <tr><td style="width: 20%">Tedavi :</td><td>{{$contact->treatment()->first()->title}}</td></tr>
                            @endif
                            <tr><td style="width: 20%">Mesaj :</td><td>{{$contact['message']}}</td></tr>

                            <tr><td style="width: 20%">Kullanılan Form :</td><td>{{$contact['used_form']}}</td></tr>
                            <tr><td colspan="2" style="text-align: center"><b>Mesajı Yanıtlayın</b></td></tr>

                            <tr><td style="width: 20%">Yanıt Başlığı :</td><td>
                                <input type="text" id="reply_subject" name="reply_subject"  value="{{$contact['reply_subject']}}" class="form-control">
                            </div>
                            </td></tr>
                            <tr><td style="width: 20%">Yanıtınız :</td><td>

                                <textarea name="reply_text" id="reply_text" class="form-control" style="height: 300px;width:100%">{{$contact['reply_text']}}</textarea>

                            </td></tr>
                            <tr><td></td><td>  <div class="col-12 col-md-9 "><button onclick="formSubmit()" id="submit_button"
                                class="btn btn-primary w-[200px]"  style="width: 300px"   >

                            @if($contact['reply_text'])
                                Yeniden mesaj gönder
                            @else
                            Yanıtla
                            @endif
                            </button></div></td></tr>
                        </table>
                        </form>

                    </div>

                </div>



            </div>
            <div class="card-body collapse in">
                <div class="card-block">

                </div>
            </div>
        </div>
    </div>


</div>
@endsection

@section('scripts')


<script src="{{url('/assets/js/saveV3.js')}}" type="text/javascript"></script>


    <!-- /build-->
<script>




async function formSubmit() {


let error = false;



if ($('#reply_subject').val() == '') {

$('#reply_subject').focus();
Swal.fire({
    icon: 'error',
    text: 'yanıt başlığı giriniz'
});

error = true;
return false;
}


if ($('#reply_text').val() == '') {

$('#reply_text').focus();
Swal.fire({
    icon: 'error',
    text: 'yanıt metni giriniz'
});

error = true;
return false;
}


//console.log(error);
 var formData = new FormData(document.getElementById('content-form'));
 //console.log(formData);
 $('#submit_button').prop('disabled',true);
 save(formData, '{{route("admin-message-reply")}}', '', '');

setTimeout(() => {
    $('#submit_button').prop('disabled',true);
     window.open("/admin-panel/message-view/{{$contact['id']}}", "_self")
}, 3000);

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
                window.open("/admin-panel/messages/delete/"+id,"_self");
            }
        });
        }
</script>
@endsection
