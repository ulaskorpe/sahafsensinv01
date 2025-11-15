<head>
    <meta charset="utf-8">
    <title>@if( !empty( $title)) {{$title}} @else SahafSensin @endif </title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="{{url('front_assets/favicon.ico')}}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link  rel="stylesheet"  href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" >  

    <!-- Font Awesome -->
 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Libraries Stylesheet -->
 
 
    <link href="{{url('front_assets/lib/animate/animate.min.css')}}" rel="stylesheet">
    <link href="{{url('front_assets/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{url('front_assets/css/style.css')}}" rel="stylesheet">

 
   
 
 
    <style>
        .modal-dialog-centered {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .modal-body img {
            max-width: 100%;
            height: auto;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
    @yield('css')
</head>