@extends('front.main_layout')

@section('main')
     
     
    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="{{route('index')}}">Anasayfa</a>
                    <span class="breadcrumb-item active">{{ $todo}}</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Checkout Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            
            @include("front.partials.".$action)
            @include("front.partials.left_column")
         
        </div>
    </div>
    <!-- Checkout End -->
       
@endsection


@section('scripts')

<script>

$('#forget-form').submit(function(e) {
    e.preventDefault();
    var error = false;
    var formData = new FormData(this);
    formData.append('additionalData', 'value');
});


$('#register-form').submit(function(e) {
    e.preventDefault();
    var error = false;
    var formData = new FormData(this);
    formData.append('additionalData', 'value');
});

$('#login-form').submit(function(e) {
    e.preventDefault();
    var error = false;
    var formData = new FormData(this);
    formData.append('additionalData', 'value');
});


async function forgetFormSubmit() {

let error = false;

if ($('#username_or_email').val() == '') {
    $('#username_or_email').focus();
    Swal.fire({
        icon: 'error',
        text: 'Kullanıcı adınızı ya da kayıt olduğunuz eposta adresini giriniz'
    });
    error = true;
    return false;
 }


if ($('#captha').val() == '') {
               
               $('#captha').focus();
               Swal.fire({
                   icon: 'error',
                   text: 'Lütfen resimdeki yazıyı doğrulayınız'
               });
            
               error = true;
               return false;
           }else if(($('#captha').val() != '{{$text}}') ){

            $('#captha').focus();
            $('#captha').val('');
               Swal.fire({
                   icon: 'error',
                   text: 'Lütfen resimdeki yazıyı yanlış girdiniz'
               });
            
               error = true;
               return false;
           }



var formData = new FormData(document.getElementById('forget-form'));
$('#submit_button').prop('disabled',true);
  await save(formData, '/forget-pw-post', '', '','{{url('/')}}');
 
}

async function loginFormSubmit() {

let error = false;
if ($('#username_or_email').val() == '') {
    $('#username_or_email').focus();
    Swal.fire({
        icon: 'error',
        text: 'Kullanıcı adınızı ya da kayıt olduğunuz eposta adresini giriniz'
    });
    error = true;
    return false;
 }
 if ($('#password').val() == '') {
    $('#password').focus();
    Swal.fire({
        icon: 'error',
        text: 'Şifrenizi giriniz'
    });
    error = true;
    return false;
 }

if ($('#captha').val() == '') {
               
               $('#captha').focus();
               Swal.fire({
                   icon: 'error',
                   text: 'Lütfen resimdeki yazıyı doğrulayınız'
               });
            
               error = true;
               return false;
           }else if(($('#captha').val() != '{{$text}}') ){

            $('#captha').focus();
            $('#captha').val('');
               Swal.fire({
                   icon: 'error',
                   text: 'Lütfen resimdeki yazıyı yanlış girdiniz'
               });
            
               error = true;
               return false;
           }
           var formData = new FormData(document.getElementById('login-form'));
$('#submit_button').prop('disabled',true);
  
  @if(empty(session('return_link')))
await save(formData, '/login_user', '', '','{{url('/')}}');
@else
await save(formData, '/login_user', '', '','{{session('return_link')}}');
@endif 
}////

async function registerFormSubmit() {

let error = false;
 
 

if ($('#name').val() == '') {
    $('#name').focus();
    Swal.fire({
        icon: 'error',
        text: 'Adınız ve soyadınızı giriniz'
    });
    error = true;
    return false;
 }


 if ($('#username').val() == '') {
    $('#username').focus();
    Swal.fire({
        icon: 'error',
        text: 'Lütfen kullanıcı adı seçiniz'
    });
    error = true;
    return false;
 }else{
    const response = await fetch('/check-username/' + $('#username').val());
    const data2 = await response.json();
    if (data2 !== 'ok') {
        $('#username').val('');
        $('#username').focus();
        Swal.fire({
            icon: 'error',
            text: data2
        });

        error = true;
        return false;
    }
 }


 if ($('#email').val() == '') {
    $('#email').focus();
    Swal.fire({
        icon: 'error',
        text: 'Eposta adresi giriniz'
    });
    error = true;
    return false;

 }else{
    const response = await fetch('/check-email/' + $('#email').val());
    const data = await response.json();
    if (data !== 'ok') {
        $('#email').val('');
        $('#email').focus();
        Swal.fire({
            icon: 'error',
            text: data
        });

        error = true;
        return false;
    }


 }




 if ($('#phone_number').val() != '') {
 
    const response = await fetch('/check-phone/' + $('#phone_number').val());
    const data3 = await response.json();
    if (data3 !== 'ok') {
        $('#phone_number').val('');
        $('#phone_number').focus();
        Swal.fire({
            icon: 'error',
            text: data3
        });

        error = true;
        return false;
    }
}

        if ($('#password').val() == '') {
               
               $('#password').focus();
               Swal.fire({
                   icon: 'error',
                   text: 'Şifre giriniz'
               });
            
               error = true;
               return false;
           }else{
            const pw = $('#password').val();

                if(pw.length <6 ){
                    $('#password').val('');
                    $('#password').focus();
               Swal.fire({
                   icon: 'error',
                   text: 'Şifreniz en az 6 karakter olmalıdır'
               });
            
               error = true;
               return false;
                }else{
                    if ($('#password_repeat').val() != $('#password').val()) {
               
                            $('#password_repeat').val('');
                            $('#password_repeat').focus();
                            Swal.fire({
                                icon: 'error',
                                text: 'Lütfen şifrenizi tekrar giriniz'
                            });
                            
                            error = true;
                            return false;
                     }

                }

           }



           if ($('#captha').val() == '') {
               
               $('#captha').focus();
               Swal.fire({
                   icon: 'error',
                   text: 'Lütfen resimdeki yazıyı doğrulayınız'
               });
            
               error = true;
               return false;
           }else if(($('#captha').val() != '{{$text}}') ){

            $('#captha').focus();
            $('#captha').val('');
               Swal.fire({
                   icon: 'error',
                   text: 'Lütfen resimdeki yazıyı yanlış girdiniz'
               });
            
               error = true;
               return false;
           }

 if (!$('#i_agree').prop('checked')) {
    $('#i_agree').focus();
    Swal.fire({
        icon: 'error',
        text: 'Lütfen kullanım koşullarını okuyup onayladığınızı belirtiniz.'
    });
    error = true;
    return false;

 }

var formData = new FormData(document.getElementById('register-form'));
$('#submit_button').prop('disabled',true);
@if(empty(session('return_link')))
await save(formData, '/register_user', '', '','{{url('/')}}');
@else
await save(formData, '/register_user', '', '','{{session('return_link')}}');
@endif 
  
 
// setTimeout(() => {
//       window.open('{{url('/')}}','_self');
// }, 2000);

}


 
 
</script>

@endsection