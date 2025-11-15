<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<table border="1">
    @foreach($types as $type)

    <tr>
        <td>{{$type->id}}</td>
        <td>{{$type->name}}</td>
        <td>{{$type->slug}}</td>
        <td>{{$type->fields}}</td>
        <td>{{$type->single}}</td>
        <td>{{$type->active}}</td>
    </tr>
    @endforeach

</table>
</body>
</html>
