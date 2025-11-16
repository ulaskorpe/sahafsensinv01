@extends("admin_panel.main_layout")
@section('content')

<div class="row match-height">
    <div class="col-md-6">
        <div class="card" style="height: 1068px;">
            
            <div class="card-body collapse in">
                <div class="card-block">
                    <form class="form" id="user-form" name="user-form" action="{{ route('profile-post') }}"
                    method="post" enctype="multipart/form-data"  >
                    <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">

                 
                        <div class="form-body">
                            <h4 class="form-section"><i class="icon-head"></i> Kişisel Bilgiler</h4>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="projectinput1">Admin Kodu </label>

                                        <input type="text" id="admin_code" name="admin_code" disabled
                                        value="{{ $user['admin_code'] }}" class="form-control">
 
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="projectinput1">Adınız Soyadınız</label>
                                        <input type="text" id="name" value="{{$user['name']}}" class="form-control" placeholder="  Name" name="name">
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="projectinput3">E-mail</label>
                                        <input type="text" id="email" value="{{$user['email']}}" class="form-control" placeholder="E-mail" name="email">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="projectinput4">Telefon Numarası</label>
                                        <input type="text" id="phone" class="form-control" placeholder="Phone" value="{{$user['phone_number']}}" name="phone">
                                    </div>
                                </div>
                            </div>

                           

                         
                             

                            <div class="form-group">
                                <label>Select File</label>
                                <label id="projectinput7" class="file center-block">
                                    <input type="file" id="avatar" name="avatar">
                                    <span class="file-custom"></span>
                                   
                                </label>
                            </div>
                            @if(!empty($user['avatar']))
                            <div class="form-group" id="avatar_pic">
                                <div class="input-group"> 
                                   <img src="{{url("files/users/".$user['id']."/200".$user['avatar'])}}" >
                                </div>
                            </div>
                            @endif
                            <div class="form-group" id="preview_pic" style="display: none;">
                                <div class="input-group">
                                    <img id="previewImage"  style="max-height:200px"  src="#" alt="Preview Image">
                                </div>
                            </div>
                             
                        </div>
                        <div class="form-actions right">
                        
                            <button type="button" class="btn btn-primary" onclick="userFormSubmit()" >
                                <i class="icon-check2"></i> Kaydet
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card" style="height: 1068px;">
      
            <div class="card-body collapse in">
                <div class="card-block">

                    <form class="form" id="password-form" name="password-form"  onsubmit="return false"
                    action="{{ route('password-post') }}" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">

                        <div class="form-body">
                            <h4 class="form-section"><i class="icon-lock2"></i>Şifre Değiştir</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="userinput1">Eski Şifre</label>
                                        <input type="password" id="password_old" class="form-control  "   name="password_old">
                                    </div>
                                </div>
                                 
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="userinput3">Yeni Şifre</label>
                                        <input type="password" id="password" name="password" placeholder="Yeni Şifre"
                                        class="form-control ">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="userinput4">Şifre Tekrar</label>
                                        <input type="password" id="password_confirm" class="form-control" name="password_confirm">
                                    </div>
                                </div>
                            </div> 

                        </div>

                        <div class="form-actions right">
                       
                            <button type="submit" class="btn btn-primary" onclick="passwordFormSubmit()">
                                <i class="icon-check2"></i> Kaydet
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection



@section('scripts')
<script src="../../../assets/js/sweetalert2@11.js" type="text/javascript"></script>
<script src="../../../assets/js/saveV3.js" type="text/javascript"></script>
    <script>
 document.getElementById('avatar').addEventListener('change', function(event) {
        const file = event.target.files[0];
        const reader = new FileReader();

        reader.onload = function(e) {
            document.getElementById('previewImage').src = e.target.result;
          $('#avatar_pic').hide();
          $('#preview_pic').show();
        };

        reader.readAsDataURL(file);
    });

async function passwordFormSubmit(){

    let error = false;

    $('#password_old').removeClass('border-danger');
    $('#password').removeClass('border-danger');
    $('#password_confirm').removeClass('border-danger');


if ($('#password_old').val() == '') {

$('#password_old').focus();
$('#password_old').addClass('border-danger');

 

Swal.fire({
    icon: 'error',
    text: 'eski şifrenizi giriniz'
});

error = true;
return false;
} else {
  
    const response = await fetch('/admin-panel/check-old-pw/' + $('#password_old').val());
        const data = await response.json();
        if(data !== 'ok'){
            $('#password_old').val('');
            $('#password_old').addClass('border-danger');
        Swal.fire({
                    icon: 'error',
                    text: data
                });

                error = true;
                return false;
            }

}

if ($('#password').val()=='') {
            $('#password').focus();
            $('#password').addClass('border-danger');
            Swal.fire({
                icon: 'error',
                text: ' şifrenizi giriniz'
            });

            error = true;
            return false;

        }
    if ($('#password').val().length < 8) {
            $('#password').focus();
            $('#password').val('');
            $('#password').addClass('border-danger');
            Swal.fire({
                icon: 'error',
                text: 'şifreniz en az 8 karakter olmalıdır'
            });

            error = true;
            return false;

        }

        if ($('#password').val()!== $('#password_confirm').val()) {
            $('#password_confirm').focus();
            $('#password_confirm').val('');
            $('#password_confirm').addClass('border-danger');
            Swal.fire({
                icon: 'error',
                text: 'şifrenizi yeniden giriniz'
            });

            error = true;
            return false;
        }
    //console.log(error);
    var formData = new FormData(document.getElementById('password-form'));
   // console.log(formData);
           
             save(formData, '{{ route('password-post') }}', '', '','{{url('/admin-panel/profile')}}');

            // document.getElementById('password-form').reset();
           
            
}

 
 

 

async function userFormSubmit(){

   
            var error = false;

            if ($('#name').val() == '') {

                $('#name').focus();
                Swal.fire({
                    icon: 'error',
                    text: 'Ad Soyad giriniz'
                });

                error = true;
                return false;
            }


            if ($('#email').val() == '') {

                $('#email').focus();
                Swal.fire({
                    icon: 'error',
                    text: 'Email adresi giriniz'
                });

                error = true;
                return false;
            } else {
                $.get('/admin-panel/check-email/' + $('#email').val(), function(data, status) {
                    // alert("Data: " + data + "\nStatus: " + status);
                    error = true;
                    if (data != 'ok') {
                        $('#email').val('');
                        $('#email').focus();
                        Swal.fire({
                            icon: 'error',
                            text: data
                        });
                        return false;
                    } else {
                        error = false;
                    }
                });
            }

if ($('#phone').val() == '') {

$('#phone').focus();
Swal.fire({
    icon: 'error',
    text: 'Telefon numarası giriniz'
});

error = true;
return false;
} else {
$.get('/admin-panel/check-phone/' + $('#phone').val(), function(data, status) {
    // alert("Data: " + data + "\nStatus: " + status);
    error = true;
    if (data != 'ok') {
        $('#phone').val('');
        $('#phone').focus();
        Swal.fire({
            icon: 'error',
            text: data
        });
        return false;
    } else {
        error = false;
    }
});
}


            if (error) {
                return false;
            }

            var formData = new FormData(document.getElementById('user-form'));
     
     save(formData, '{{ route('profile-post') }}', '', '','{{url('/admin-panel/profile')}}');

}

 
    </script>
@endsection
