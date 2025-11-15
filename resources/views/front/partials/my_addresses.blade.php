
<div class="row">
@foreach ($addresses as $addr )
  


<div class="col-md-3 p-3">   
<div class="card @if($addr['selected']==1) bg-warning @endif" style="width: 18rem;">
    <div class="card-body">
      <h5 class="card-title">{{$addr['name']}} 
        @if($addr['selected']==0)
        <a href="#" class="card-link " onclick="make_primary({{$addr['id']}})"  style="color:#1f1f1f"><i class="fa-solid fa-square-check"></i></a>
        @endif 
  
      </h5>    
      <h6 class="card-subtitle mb-2 text-muted">{{ $type_array[$addr['type']]}}</h6>
      <p class="card-text">
        {{$addr['address']}}<br>

        {{$addr->neighborhood()->first()->name}} ,
        {{$addr->district()->first()->name}} ,
        {{$addr->town()->first()->name}} ,
      <b>  {{$addr->city()->first()->name}} </b>,
      {{$addr->neighborhood()->first()->postal_code}} 

      </p>
   
      <a href="#" class="card-link" style="color:#1f1f1f" onclick="my_addresses({{$addr['id']}})">
        <i class="fa-regular fa-pen-to-square"></i>
      </a>
  

      <a href="#" class="card-link " onclick="delete_addr({{$addr['id']}})"  style="color:red">
        <i class="fa-solid fa-trash"></i>
      </a>
    </div>
  </div>

</div>
  @endforeach

</div>