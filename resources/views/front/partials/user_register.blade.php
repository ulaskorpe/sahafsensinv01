<div class="col-lg-8">
    <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Üye Kayıt</span></h5>
    <div class="bg-light p-30 mb-5">

        <form class="form" id="register-form" name="register-form" action='{{route('register_user')}}'
        method="post" enctype="multipart/form-data">
        <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
        <div class="row">
            <div class="col-md-6 form-group">
                <label>Adınız Soyadınız</label>
                <input class="form-control" type="text" placeholder="" name="name" id="name">
            </div>
      
            <div class="col-md-6 form-group">
                <label>Kullanıcı Adınız</label>
                <input class="form-control" type="text" placeholder="" name="username" id="username">

            </div>
            <div class="col-md-6 form-group">
                <label>E-mail</label>
                <input class="form-control" type="text" placeholder=""  name="email" id="email">
            </div>
            <div class="col-md-6 form-group">
                <label>Telefon Numaranız</label>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">+90</span>
                    <input type="number" name="phone_number" id="phone_number" maxlength="10" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1">
                  </div>
            </div>
            <div class="col-md-6 form-group">
                <label>Şifre Oluşturun</label>
                <input class="form-control" name="password" id="password" type="password" placeholder="">
            </div>
            <div class="col-md-6 form-group">
                <label>Şifrenizi Yeniden Girin</label>
                <input class="form-control"  name="password_repeat" id="password_repeat" type="password" placeholder="">
            </div>

            <div class="col-md-4 form-group">
                <label>Ben İnsanım :  </label><br>
                <img src="{{url('files/captha/'.$img)}}" style="padding-bottom: 20px">
                <input class="form-control"  name="captha" id="captha" type="text" maxlength="6" placeholder="">
            </div>

     
           

            <div class="col-md-6 form-group">
                <div class="form-check">
                    <input class="form-check-input"  name="i_agree" id="i_agree" style="" type="checkbox" value="13" placeholder="">
                    <label class="form-check-label" for="flexCheckDefault">
                   <a href="#" onclick="fetch_page(14)" class="link-primary" data-toggle="modal" data-target="#largeModal">Kullanım Koşullarını</a> okudum ve kabul ediyorum.
 
                    </label>
                  </div>
           
            </div>

            <div class="col-md-12 form-group d-flex justify-content-center">
                <button class="btn btn-primary font-weight-bold py-3 w-50" onclick="registerFormSubmit()" id="submit_button">Kayıt Ol</button>
            </div>

         

            </form>
            @if(false)


            <div class="col-md-6 form-group">
                <label>Address Line 1</label>
                <input class="form-control" type="text" placeholder="123 Street">
            </div>
            <div class="col-md-6 form-group">
                <label>Address Line 2</label>
                <input class="form-control" type="text" placeholder="123 Street">
            </div>
            <div class="col-md-6 form-group">
                <label>Country</label>
                <select class="custom-select">
                    <option selected>United States</option>
                    <option>Afghanistan</option>
                    <option>Albania</option>
                    <option>Algeria</option>
                </select>
            </div>
            <div class="col-md-6 form-group">
                <label>City</label>
                <input class="form-control" type="text" placeholder="New York">
            </div>
            <div class="col-md-6 form-group">
                <label>State</label>
                <input class="form-control" type="text" placeholder="New York">
            </div>
            <div class="col-md-6 form-group">
                <label>ZIP Code</label>
                <input class="form-control" type="text" placeholder="123">
            </div>

            <div class="col-md-12 form-group">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="newaccount">
                    <label class="custom-control-label" for="newaccount">Create an account</label>
                </div>
            </div>
            <div class="col-md-12">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="shipto">
                    <label class="custom-control-label" for="shipto"  data-toggle="collapse" data-target="#shipping-address">Ship to different address</label>
                </div>
            </div>
             @endif
        </div>
    </div>
    @if(false)
    <div class="collapse mb-5" id="shipping-address">
        <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Shipping Address</span></h5>
        <div class="bg-light p-30">
            <div class="row">
                <div class="col-md-6 form-group">
                    <label>First Name</label>
                    <input class="form-control" type="text" placeholder="John">
                </div>
                <div class="col-md-6 form-group">
                    <label>Last Name</label>
                    <input class="form-control" type="text" placeholder="Doe">
                </div>
                <div class="col-md-6 form-group">
                    <label>E-mail</label>
                    <input class="form-control" type="text" placeholder="example@email.com">
                </div>
                <div class="col-md-6 form-group">
                    <label>Mobile No</label>
                    <input class="form-control" type="text" placeholder="+123 456 789">
                </div>
                <div class="col-md-6 form-group">
                    <label>Address Line 1</label>
                    <input class="form-control" type="text" placeholder="123 Street">
                </div>
                <div class="col-md-6 form-group">
                    <label>Address Line 2</label>
                    <input class="form-control" type="text" placeholder="123 Street">
                </div>
                <div class="col-md-6 form-group">
                    <label>Country</label>
                    <select class="custom-select">
                        <option selected>United States</option>
                        <option>Afghanistan</option>
                        <option>Albania</option>
                        <option>Algeria</option>
                    </select>
                </div>
                <div class="col-md-6 form-group">
                    <label>City</label>
                    <input class="form-control" type="text" placeholder="New York">
                </div>
                <div class="col-md-6 form-group">
                    <label>State</label>
                    <input class="form-control" type="text" placeholder="New York">
                </div>
                <div class="col-md-6 form-group">
                    <label>ZIPss Code</label>
                    <input class="form-control" type="text" placeholder="123">
                </div>

              
            </div>
        </div>
    </div>
    @endif
</div>