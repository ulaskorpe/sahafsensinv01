@extends('front.main_layout')

@section('main')

<div class="container-fluid">
    <div class="row px-xl-5 p-5" style="height: 350px">
        
        <div class="container-lg mt-5 text-center pt-5 bg-secondary text-white rounded shadow"  ><h3>{{$msg}}</h3>
        
            <button class="btn btn-primary font-weight-bold py-3 mt-3 w-10" onclick="window.open('/','_self')" id="submit_button">Devam edeyim ... </button>
        </div>     
    </div>
</div>

@endsection