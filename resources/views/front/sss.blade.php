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
        <div class="col-12 mb-5" >
            <div class="search-box float-right"  >
                <div class="input-group">
                    <input type="text" id="key" name="key" class="form-control" placeholder="Search" onchange="showsss()">
                    <div class="input-group-append">
                        <span class="input-group-text" onclick="showsss();">
                            <i class="fas fa-search"></i>
                        </span>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-12" id="sss_content">
       
    
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $( document ).ready(function() {
   showsss();
});
async function showsss(){
let key = $('#key').val();
 

 $.get( "/faqin/"+key, function( data ) {
 
    $('#sss_content').html(data);
  
});
   
}
    </script>
@endsection