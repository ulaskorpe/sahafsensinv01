@extends('front.main_layout')

@section('css')
<style>
    .search-box {
        display: flex;
        justify-content: flex-end;
        max-width: 20%;
    }
</style>
@endsection 
@section('main')
  
<div class="container-fluid">
         <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                   <a class="breadcrumb-item text-dark" href="{{route('index')}}">Anasayfa</a>
                    <a class="breadcrumb-item text-dark" href="#">Hesabım</a>
                    
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Shop Detail Start -->

    <div class="container-fluid pb-5">
      
        <div class="row px-xl-5">
            <div class="col">
                <div class="bg-light p-30">
                    <div class="nav nav-tabs mb-4">
                        <a class="nav-item nav-link text-dark @if($selected==1)active @endif" data-toggle="tab" href="#tab-pane-1">Üyelik Bilgilerim</a>
                        <a class="nav-item nav-link text-dark @if($selected==2)active @endif" data-toggle="tab" href="#tab-pane-2">Adreslerim</a>
                        <a class="nav-item nav-link text-dark @if($selected==3)active @endif" data-toggle="tab" href="#tab-pane-3">Şifre Güncelle</a>
                        <a class="nav-item nav-link text-dark @if($selected==4)active @endif" data-toggle="tab" href="#tab-pane-4">Resimlerim</a>
                        <a class="nav-item nav-link text-dark @if($selected==5)active @endif" data-toggle="tab" href="#tab-pane-5">Hesap Ayarlarım</a>
                     
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade  @if($selected==1) show active @endif" id="tab-pane-1">

                            @include("front.partials.profile_info")
                        </div>
                        <div class="tab-pane fade @if($selected==2) show active @endif" id="tab-pane-2">
                            @include("front.partials.profile_addresses")
                        </div>
                        <div class="tab-pane fade @if($selected==3) show active @endif" id="tab-pane-3">
                           d
                        </div>
                        <div class="tab-pane fade @if($selected==4) show active @endif" id="tab-pane-4">
                            5
                         </div>
                         <div class="tab-pane fade @if($selected==5) show active @endif" id="tab-pane-5">
                           64
                         </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@if(false)
    <div class="container-fluid pb-5">
      
        <div class="row px-xl-5">
            <div class="col">
                <div class="bg-light p-30">
                    <div class="nav nav-tabs mb-4">
                        <a class="nav-item nav-link text-dark active" data-toggle="tab" href="#tab-pane-1">Üyelik Bilgilerim</a>
                        <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-2">Adreslerim</a>
                        <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-3">Şifre Güncelle</a>
                        <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-4">Resimlerim</a>
                        <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-5">Hesap Ayarlarım</a>
                     
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="tab-pane-1">
                          @include("front.partials.profile_info")
                        </div>
                        <div class="tab-pane fade" id="tab-pane-2">
                            <h4 class="mb-3">Additional Information</h4>
                            <p>Eos no lorem eirmod diam diam, eos elitr et gubergren diam sea. Consetetur vero aliquyam invidunt duo dolores et duo sit. Vero diam ea vero et dolore rebum, dolor rebum eirmod consetetur invidunt sed sed et, lorem duo et eos elitr, sadipscing kasd ipsum rebum diam. Dolore diam stet rebum sed tempor kasd eirmod. Takimata kasd ipsum accusam sadipscing, eos dolores sit no ut diam consetetur duo justo est, sit sanctus diam tempor aliquyam eirmod nonumy rebum dolor accusam, ipsum kasd eos consetetur at sit rebum, diam kasd invidunt tempor lorem, ipsum lorem elitr sanctus eirmod takimata dolor ea invidunt.</p>
                            <div class="row">
                                <div class="col-md-6">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item px-0">
                                            Sit erat duo lorem duo ea consetetur, et eirmod takimata.
                                        </li>
                                        <li class="list-group-item px-0">
                                            Amet kasd gubergren sit sanctus et lorem eos sadipscing at.
                                        </li>
                                        <li class="list-group-item px-0">
                                            Duo amet accusam eirmod nonumy stet et et stet eirmod.
                                        </li>
                                        <li class="list-group-item px-0">
                                            Takimata ea clita labore amet ipsum erat justo voluptua. Nonumy.
                                        </li>
                                      </ul> 
                                </div>
                                <div class="col-md-6">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item px-0">
                                            Sit erat duo lorem duo ea consetetur, et eirmod takimata.
                                        </li>
                                        <li class="list-group-item px-0">
                                            Amet kasd gubergren sit sanctus et lorem eos sadipscing at.
                                        </li>
                                        <li class="list-group-item px-0">
                                            Duo amet accusam eirmod nonumy stet et et stet eirmod.
                                        </li>
                                        <li class="list-group-item px-0">
                                            Takimata ea clita labore amet ipsum erat justo voluptua. Nonumy.
                                        </li>
                                      </ul> 
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab-pane-3">
                            <div class="row">
                               
                                <div class="col-md-6">
                                    <h4 class="mb-4">Leave a review</h4>
                                    <small>Your email address will not be published. Required fields are marked *</small>
                                    <div class="d-flex my-3">
                                        <p class="mb-0 mr-2">Your Rating * :</p>
                                        <div class="text-primary">
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                        </div>
                                    </div>
                                    <form>
                                        <div class="form-group">
                                            <label for="message">Your Review *</label>
                                            <textarea id="message" cols="30" rows="5" class="form-control"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Your Name *</label>
                                            <input type="text" class="form-control" id="name">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Your Email *</label>
                                            <input type="email" class="form-control" id="email">
                                        </div>
                                        <div class="form-group mb-0">
                                            <input type="submit" value="Leave Your Review" class="btn btn-primary px-3">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab-pane-4">
                        </div>
                        <div class="tab-pane fade" id="tab-pane-5">
                        </div>
                      
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    <!-- Shop Detail End -->


    <!-- Products Start -->
    
    <!-- Products End -->

</div>
@endsection

@section('scripts')
<script>
 
 

let addresses_show = false ;

my_addresses(0);

 document.getElementById('avatar').addEventListener('change', function(event) {
   
    const file = event.target.files[0];
    const reader = new FileReader();

    reader.onload = function(e) {
        document.getElementById('previewImage').src = e.target.result;
        $('#previewImage').show();
    };

    reader.readAsDataURL(file);
});

function my_addresses(address_id){
    if(addresses_show){
        addresses_show = false ;
        $('#my_addresses').show();
        $('#new_address').hide();

        $.get( "{{url('/address-form')}}/"+address_id, function( data ) {
                $( "#address_div" ).html( data );
        });

    }else{
        addresses_show = true;
        $('#my_addresses').hide();
        $('#new_address').show();
        $.get( "{{url('/user-addresses')}}", function( data ) {
                $( "#address_div" ).html( data );
        });


    }

}



$('#forget-form').submit(function(e) {
    e.preventDefault();
    var error = false;
    var formData = new FormData(this);
    formData.append('additionalData', 'value');
});


$('#info-form').submit(function(e) {
    e.preventDefault();
    var error = false;
    var formData = new FormData(this);
    formData.append('additionalData', 'value');
});

async function infoFormSubmit() {

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

        



           
 

var formData = new FormData(document.getElementById('info-form'));
$('#submit_button').prop('disabled',true);
// alert("ok");
///async function save(formData,route,formID,btn,reload) 
await save(formData, '/user-profile-post', '', '','{{url('/hesabim')}}');
 
  
 
// setTimeout(() => {
//       window.open('{{url('/hesabim')}}','_self');
// }, 2000);

}


@if($user['new_email'])
async function cancel_email_update() {
    Swal.fire({
        title: 'Eposta güncellemeniz iptal edilecek , eminmisiniz?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Evet!',
        cancelButtonText: 'Hayır'
    }).then(async (result) => {  
        // If confirmed
        if (result.isConfirmed) {
            try {
                const response = await fetch('/cancel-email-update/');
                const data = await response.json();
                console.log(data);
                if (data == 'ok') {
                    Swal.fire({
                        icon: 'success',
                        text: "Eposta güncelleme talebiniz iptal edildi"
                    });
                }
            } catch (error) {
                Swal.fire({
                    icon: 'error',
                    text: "Bir hata oluştu, lütfen tekrar deneyin."
                });
            }

            setTimeout(() => {
                        window.location.reload();  
                    }, 2000);  
        }
    });
}

@endif 

//// addresss fx ////////////



async function delete_addr(addr_id) {
    Swal.fire({
        title: 'Adres silinecek, eminmisiniz?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Evet!',
        cancelButtonText: 'Hayır'
    }).then(async (result) => {  
        // If confirmed
        if (result.isConfirmed) {
            try {
                const response = await fetch('/delete-address/'+addr_id);
                const data = await response.json();
                console.log(data);
                if (data == 'ok') {
                    Swal.fire({
                        icon: 'success',
                        text: "Adres silindi"
                    });
                }else{
                    Swal.fire({
                    icon: 'error',
                    text: data
                });
                }
            } catch (error) {
                Swal.fire({
                    icon: 'error',
                    text: "Bir hata oluştu, lütfen tekrar deneyin."
                });
            }
               addresses_show = false ;

                my_addresses(0);
            // setTimeout(() => {
            //             window.location.reload();  
            //         }, 2000);  
        }
    });
}

async function make_primary(addr_id) {
    Swal.fire({
        title: 'Adres birincil adresiniz olarak atanacak , eminmisiniz?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Evet!',
        cancelButtonText: 'Hayır'
    }).then(async (result) => {  
        // If confirmed
        if (result.isConfirmed) {
            try {
                const response = await fetch('/make-primary/'+addr_id);
                const data = await response.json();
                console.log(data);
                if (data == 'ok') {
                    Swal.fire({
                        icon: 'success',
                        text: "Adres birincil adresiniz olarak seçildi."
                    });
                }
            } catch (error) {
                Swal.fire({
                    icon: 'error',
                    text: "Bir hata oluştu, lütfen tekrar deneyin."
                });
            }
               addresses_show = false ;

                my_addresses(0);
            // setTimeout(() => {
            //             window.location.reload();  
            //         }, 2000);  
        }
    });
}

async function addressFormSubmit() {
    

    let error = false;
 
 

 if ($('#address_name').val() == '') {
     $('#address_name').focus();
     Swal.fire({
         icon: 'error',
         text: 'Lütfen adres adı giriniz'
     });
     error = true;
     return false;
  }

     
 if ($('#type').val() == '0') {
     $('#type').focus();
     Swal.fire({
         icon: 'error',
         text: 'Lütfen adres tipi seçiniz'
     });
     error = true;
     return false;
  }

  if ($('#city_id').val() == '0') {
     $('#city_id').focus();
     Swal.fire({
         icon: 'error',
         text: 'Lütfen şehir seçiniz'
     });
     error = true;
     return false;
  }
  if ($('#town_id').val() == '0') {
     $('#town_id').focus();
     Swal.fire({
         icon: 'error',
         text: 'Lütfen ilçe seçiniz'
     });
     error = true;
     return false;
  }
        
  if ($('#district_id').val() == '0') {
     $('#district_id').focus();
     Swal.fire({
         icon: 'error',
         text: 'Lütfen bölge seçiniz'
     });
     error = true;
     return false;
  }

  if ($('#neighborhood_id').val() == '0') {
     $('#neighborhood_id').focus();
     Swal.fire({
         icon: 'error',
         text: 'Lütfen mahalle seçiniz'
     });
     error = true;
     return false;
  }

  if ($('#address_text').val() == '') {
     $('#address_text').focus();
     Swal.fire({
         icon: 'error',
         text: 'Lütfen bina ve numara giriniz'
     });
     error = true;
     return false;
  }

var formData = new FormData(document.getElementById('address-form'));
$('#submit_button').prop('disabled',true);
// alert("ok");
///async function save(formData,route,formID,btn,reload) 
await save(formData, '/user-address-post', '', '','{{url('/hesabim')}}');


}
function town_select(selected_town) {
        let cityId = $('#city_id').val();  
      
        if (cityId != "0") {
            $.ajax({
                url: '/town-select/'+cityId,  
                type: 'GET',
                data: { city_id: cityId },
                success: function(data) {
                    $('#town_id').prop('disabled',false);
                    // Assuming data is the JSON array you provided
                    const townSelect = document.getElementById('town_id');
                    
                    // Clear existing options except the default one
                    townSelect.innerHTML = '<option value="0">Seçiniz</option>';
                    
                    // Populate the town select box
                    data.forEach(function(town) {
                        const option = document.createElement('option');
                        option.value = town.id;
                        option.text = town.name;
                        if (selected_town && town.id == selected_town) {
                        option.selected = true;
                        }

                        townSelect.appendChild(option);
                    });
                },
                error: function(error) {
                    console.error('An error occurred:', error);
                }
            });
        } else {
            // Reset town select box if no city is selected
            $('#town_id').prop('disabled',true);
           

            document.getElementById('town_id').innerHTML = '<option value="0">Seçiniz</option>';
           
        }
        $('#district_id').prop('disabled',true);
            $('#neighborhood_id').prop('disabled',true);
        document.getElementById('district_id').innerHTML = '<option value="0">Seçiniz</option>';
            document.getElementById('neighborhood_id').innerHTML = '<option value="0">Seçiniz</option>';
    }




    async function district_select(selected_district=0,townId=0) {
    
        if (townId != 0) {
            $.ajax({
                url: '/district-select/'+townId,  
                type: 'GET',
                data: { town_id: townId },
                success: function(data) {
                    $('#district_id').prop('disabled',false);
                    // Assuming data is the JSON array you provided
                    const districtSelect = document.getElementById('district_id');
                    
                    // Clear existing options except the default one
                    districtSelect.innerHTML = '<option value="0">Seçiniz</option>';
                    
                    // Populate the town select box
                    data.forEach(function(district) {
                        const option = document.createElement('option');
                        option.value = district.id;
                        option.text = district.name;
                        if (selected_district && district.id == selected_district) {
                        option.selected = true;
                        }
                        districtSelect.appendChild(option);
                    });
                },
                error: function(error) {
                    console.error('An error occurred:', error);
                }
            });
        } else {
            // Reset town select box if no city is selected
         
            $('#district_id').prop('disabled',true);
           

         
            document.getElementById('district_id').innerHTML = '<option value="0">Seçiniz</option>';
          
        }
        $('#neighborhood_id').prop('disabled',true);
        document.getElementById('neighborhood_id').innerHTML = '<option value="0">Seçiniz</option>';
    }




    function neighborhood_select(selected_neighborhood=0,districtId=0) {
        //let districtId = $('#district_id').val();  

       
        if (districtId != 0) {
            $.ajax({
                url: '/neighborhood-select/'+districtId,  
                type: 'GET',
                data: { district_id: districtId },
                success: function(data) {
                    $('#neighborhood_id').prop('disabled',false);
                    // Assuming data is the JSON array you provided
                    const neighborhoodSelect = document.getElementById('neighborhood_id');
                    
                    // Clear existing options except the default one
                    neighborhoodSelect.innerHTML = '<option value="0">Seçiniz</option>';
                    
                    // Populate the town select box
                    data.forEach(function(neighborhood) {
                        const option = document.createElement('option');
                        option.value = neighborhood.id;
                        option.text = neighborhood.name+"  ["+neighborhood.postal_code+"]" ;
                        if (selected_neighborhood && neighborhood.id == selected_neighborhood) {
                        option.selected = true;
                        }
                        neighborhoodSelect.appendChild(option);
                    });
                },
                error: function(error) {
                    console.error('An error occurred:', error);
                }
            });
        } else {
            $('#neighborhood_id').prop('disabled',true);
          
            document.getElementById('neighborhood_id').innerHTML = '<option value="0">Seçiniz</option>';
        }
    }

//// addresss fx ////////////


    </script>
@endsection