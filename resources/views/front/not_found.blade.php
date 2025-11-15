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
    <div class="row px-xl-5 p-5"  >
        <div class="col-md-12 text-center">
            <h1>404</h1>
            <h2>Aradığınız şey bulunamadı</h2>
            <p>
          <a href="{{route('index')}}" style="color: black"> Lütfen tekrar deneyin</a>
            </p>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
 
 
    </script>
@endsection