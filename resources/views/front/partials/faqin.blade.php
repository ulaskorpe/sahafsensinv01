 
@if($faqs->count()> 0)
<div class="accordion" id="accordionExample">
    @php 
        $i=1;
    @endphp
    @foreach($faqs as $faq)
    @php 
        $i++;
    @endphp
    <div class="card">
      <div class="card-header" id="headingOne">
        <h2 class="mb-0">
          <button class="btn  btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse{{$i}}" aria-expanded="false" aria-controls="collapseOne">
            <h6>{{$faq['question']}}</h6>
          </button>
        </h2>
      </div>
  
      <div id="collapse{{$i}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
        <div class="card-body">
         {{$faq['answer']}}
        </div>
      </div>
    </div>
    @endforeach


  </div>
  @else 
 
    <div class="row px-xl-5 p-5"  >
        
        <div class="container-lg text-center pt-5 bg-secondary text-white rounded shadow"  ><h3>Sonuç Bulunamadı</h3>
        
            <button class="btn btn-primary mb-4 font-weight-bold py-3 mt-3 w-10" onclick="$('#key').val('');showsss()" id="submit_button">Devam edeyim ... </button>
        </div>     
    </div>
 

  @endif