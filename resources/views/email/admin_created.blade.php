<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    sayın {{$name}},<br>
    Sahafsensin.com  yönetim paneline giriş bilgileriniz :
    <br>
    admin code : {{$admin_code}}<br>
    password : {{$password}}<br>

  <a href="{{url('/login')}}" target="_blank">Yönetim Paneli</a>  
</body>
</html>