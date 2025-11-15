 @extends('front.main_layout')

 @section('main')
        @include("front.partials.carousel")
      
        @include("front.partials.recent")
        @if(false)
        @include("front.partials.featured")
        @endif
        @include("front.partials.categories")
        @include("front.partials.products")
        @include("front.partials.offer")
 @endsection