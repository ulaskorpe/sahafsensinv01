<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    Sayın {{$name}},<br>
    Yeni şifreniz :  {{$password}}, <br>
    Sahafsensin.com  giriş yapmak için için aşağıdaki linke tıklayınız :
 
  <a href="{{url('/giris')}}" target="_blank">{{url('/giris')}}</a>  
</body>
</html>