<div class="row">
                               
    <div class="col-md-2"></div>
    <div class="col-md-8">
        
        <form class="form" id="address-form" name="address-form" action='{{route('user-address-post')}}'
        method="post" enctype="multipart/form-data">
        <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="address_id" id="address_id" value="{{ $address_id }}">
        <div class="row">
         

        <div class="col-md-6 form-group">
            <label>Adres Adı</label>
            <input class="form-control" type="text" placeholder="" maxlength="100" name="address_name" id="address_name" value="{{$name}}">
        </div>
        <div class="col-md-6 form-group">
            <label>Adres Tipi</label>
            <select name="type" id="type" class="form-control">
                <option value="0">Seçiniz</option>
                <option value="home" @if($type=='home') selected @endif>Ev</option>
                <option value="work" @if($type=='work') selected @endif>İş</option>
                <option value="other" @if($type=='other') selected @endif>Diğer</option>
                

            </select>
        </div>
        <div class="col-md-6 form-group">
            <label>Şehir </label>
            <select name="city_id" id="city_id" class="form-control" onchange="town_select()">
                <option value="0">Seçiniz</option>
                @foreach ($cities as $city )
                    <option value="{{$city['id']}}" @if($city_id==$city['id']) selected @endif>{{$city['name']}}</option>
                @endforeach
                    
                 
            </select>
        </div>

        <div class="col-md-6 form-group">
            <label>İlçe  </label>
            <select name="town_id" id="town_id" class="form-control" onchange="district_select(0,this.value)" disabled>
                <option value="0">Seçiniz</option>
            </select>
        </div>
        <div class="col-md-6 form-group">
            <label>Bölge  </label>
            <select name="district_id" id="district_id" class="form-control" onchange="neighborhood_select(0,this.value)" disabled>
                <option value="0">Seçiniz</option>
            </select>
        </div>

        <div class="col-md-6 form-group">
            <label>Mahalle  </label>
            <select name="neighborhood_id" id="neighborhood_id" class="form-control" disabled>
                <option value="0">Seçiniz</option>
            </select>
        </div>

        <div class="col-md-12 form-group">
            <label>Adres  </label>
            <input class="form-control" type="text" placeholder="" maxlength="255" name="address_text" id="address_text" value="{{$address_text}}">
        </div>
        <div class="col-md-6 form-group  ml-3 "><br>
            <input class="form-check-input "  name="selected" id="selected" style="" @if($selected) checked @endif type="checkbox" value="13" placeholder="">
            <label class="form-check-label" for="flexCheckDefault">
              Birincil Adresim

            </label>
        </div>
        <div class="col-md-12 form-group d-flex justify-content-center">
            <button class="btn btn-primary font-weight-bold py-3 w-50" onclick="addressFormSubmit()" id="address_submit_button">
                
             {{$exe}} 
            
            </button>
        </div>

        
        </div>
        </form>

    </div>
    
</div>
<script>
@if($address_id>0)
town_select({{$town_id}});
district_select({{$district_id}},{{$town_id}});
neighborhood_select({{$neighborhood_id}},{{$district_id}});
@endif

    $('#address-form').submit(function(e) {
    e.preventDefault();
   
    var error = false;
    var formData = new FormData(this);
    formData.append('additionalData', 'value');
});
    </script>
 