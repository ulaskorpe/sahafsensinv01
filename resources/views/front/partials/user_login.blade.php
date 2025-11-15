<div class="col-lg-8">
    <h5 class="section-title position-relative   mb-3"><span class="bg-secondary pr-3">ÜYE GİRİŞ</span></h5>
    <div class="bg-light p-30 mb-5">

        <form class="form" id="login-form" name="login-form" action='{{route('login_user')}}'
        method="post" enctype="multipart/form-data">
        <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
        <div class="row">
            <div class="col-md-6 form-group">
                <label>Eposta / Kullanıcı Adı / Kullanıcı Kodu</label>
                <input class="form-control" type="text" placeholder="" name="username_or_email" id="username_or_email">
            </div>
      
            <div class="col-md-6 form-group">
                

            </div>
            <div class="col-md-6 form-group">
                <label>Şifreniz</label>
                <input class="form-control" name="password" id="password" type="password" placeholder="">
            </div>
            <div class="col-md-6 form-group">
               
            </div>
            <div class="col-md-6 form-group">
                <label>Ben İnsanım :  </label><br>
                <img src="{{url('files/captha/'.$img)}}" style="padding-bottom: 20px">
                <input class="form-control"  name="captha" id="captha" type="text" maxlength="6" placeholder="">
            </div>

          
            <div class="col-md-4 form-group">
              
            </div>

            <div class="col-md-6 form-group">
                <div class="form-check">
                    <input class="form-check-input"  name="remember_me" id="remember_me" style="" type="checkbox" value="13" placeholder="">
                    <label class="form-check-label" for="flexCheckDefault">
                        Beni Hatırla
 
                    </label>
                  </div>
           
            </div>
            <div class="col-md-12 form-group d-flex justify-content-center">
                <button class="btn btn-primary font-weight-bold py-3 w-50" onclick="loginFormSubmit()" id="submit_button">Üye Giriş</button>
            </div>
            <div class="col-md-12 form-group d-flex justify-content-center">
               <a href="{{route('user-forget-pw')}}" style="color:red">!!!Şifremi unuttum!!!!</a>
            </div>

         

            </form>
            
        </div>
    </div>
    
</div>