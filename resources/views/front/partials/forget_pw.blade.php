<div class="col-lg-8">
    <h5 class="section-title position-relative   mb-3"><span class="bg-secondary pr-3">ÜYE GİRİŞ</span></h5>
    <div class="bg-light p-30 mb-5">

        <form class="form" id="forget-form" name="forget-form" action='{{route('forget_pw_post')}}'
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

            <div class="col-md-6 form-group p-6">
              
            </div>
            <div class="col-md-12 form-group d-flex justify-content-center">
                <button class="btn btn-primary font-weight-bold py-3 w-50" onclick="forgetFormSubmit()" id="submit_button">Şifrem Eposta Adresime Gelsin</button>
            </div>
            <div class="col-md-12 form-group d-flex justify-content-center">
               
            </div>

         

            </form>
            
        </div>
    </div>
    
</div>