  <!-- JavaScript Libraries -->
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
 
  <script src="{{url('front_assets/lib/easing/easing.min.js')}}"></script>
  
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="{{ url('assets/js/saveV3.js') }}"></script>

  <!-- Contact Javascript File -->
  @if(false)
  <script src="{{url('front_assets/lib/owlcarousel/owl.carousel.min.js')}}"></script>
  <script src="mail/jqBootstrapValidation.min.js"></script>
  <script src="mail/contact.js"></script>
  <script src="{{url('front_assets/js/main.js')}}"></script>
  @endif
    <!-- Template Javascript -->
  

 <script>
async function fetch_page(page_id){

  const response = await fetch('/fetch-page/' + page_id);
    const data_modal = await response.json();
    let content = data_modal.body;
    if(data_modal.icon !=''){
   
      content+="<img  src='http://sahafsensin.test/files/pages/"+data_modal.slug+"/"+data_modal.icon+"'  >";
      console.log(content);
    }
   $('#large_modal_title').html(data_modal.title);
   $('#large_modal_body').html(content);
     
}



function logoutfx(){
            Swal.fire({
            title: 'Çıkış yapılacak eminmisiniz',
         
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Evet!',
            cancelButtonText: 'Hayır'
        }).then((result) => {
            // If confirmed
            if (result.isConfirmed) {
                    $('#logout-form').submit();
            }
        });
        }
</script>