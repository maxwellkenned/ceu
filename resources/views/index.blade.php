<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <form action="/u" method="post" enctype="multipart/form-data">
    Select image to upload:
    {{ csrf_field() }}
    <input type="file" name="uploadFile" id="uploadFile">
    <input type="submit" value="Upload Image" name="submit">
    @if($arquivos)
       <h1>Listagem de arquivos</h1>
       <table class="table table-striped">
            @foreach($arquivos as $arq)
           <tr>
               <td><a href="d/{{$arq["download"]}}">{{ $arq["name"] }}</a></td>
           </tr>
           @endforeach
       </table>
       @endif
    </form>

    <script src="js/bootstrap.min.js"></script>
</body>
</html>