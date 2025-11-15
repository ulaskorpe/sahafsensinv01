<div class="row">
                               
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <form class="form" id="info-form" name="info-form" action='{{route('user-profile-post')}}'
        method="post" enctype="multipart/form-data">
        <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
        <div class="row">
            <div class="col-md-6 form-group">
                <label>Adınız Soyadınız</label>
                <input class="form-control" type="text" placeholder="" maxlength="100" name="name" id="name" value="{{$user['name']}}">
            </div>
      
            <div class="col-md-6 form-group">
                <label>Kullanıcı Adınız</label>
                <input class="form-control" type="text" placeholder="" maxlength="50" name="username" id="username" value="{{$user['username']}}">

            </div>
            <div class="col-md-6 form-group">
               
                @if($user['new_email'])
                <br>
            <i> Eposta adresinizi {{$user['new_email']}} olarak güncellemek için gönderilen linki kullanınız
            
                <br> iptal etmek için <a href="#" onclick="cancel_email_update()">tıklayınız</a>
            </i>
            
            @else 
            <label>E-posta</label>
            <input class="form-control" type="text" placeholder="" maxlength="100"  name="email" id="email" value="{{$user['email']}}">
                @endif 
            </div>
            <div class="col-md-6 form-group">
                <label>Telefon Numaranız</label>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">+90</span>
                    <input type="number" name="phone_number" id="phone_number" maxlength="10" value="{{$user['phone_number']}}" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1">
                  </div>
            </div>
            <div class="col-md-6 form-group">
                <label>Profil Resmim</label>
                <input class="form-control" type="file" placeholder=""  name="avatar" id="avatar">
            </div>



            <div class="col-md-6 form-group" id="preview_pic" >
                <div class="col col-md-3"></div>
                <div class="col-12 col-md-9"> 
                
                    @if(!empty($user['avatar']))
                        <img src="{{url('files/users/'.$user['id'].'/200h'.$user['avatar'])}}" alt="">
                    @endif
                    <img id="previewImage" src="#" alt="Preview Image"
                        style="max-width: 300px;display:none">
                </div>
            </div>
            <div class="col-md-12 form-group" id="preview_pic" >
                <div class="col col-md-3"></div>
                <div class="col-12 col-md-12"> 
                    <label>Hakkımda</label>
                    <textarea class="form-control" id="about" name="about">{{$user['about']}}</textarea>
                  
                </div>
            </div>

     
           

           

            <div class="col-md-12 form-group d-flex justify-content-center">
                <button class="btn btn-primary font-weight-bold py-3 w-50" onclick="infoFormSubmit()" id="submit_button">Güncelle</button>
            </div>

        </div>

            </form>
    </div>
</div>
