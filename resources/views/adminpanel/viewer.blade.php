<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Viewer</title>
</head>
<body>


@foreach($manuscript as $data)
<br/>
<a href="{{URL('/assets/manuscript')}}/{{$data->file}}"> If not Download actomatically, click Here</a>

<iframe src="{{URL('/assets/manuscript')}}/{{$data->file}}" width='1366px' height='623px' frameborder='0'></iframe>


@endforeach









    
</body>
</html>