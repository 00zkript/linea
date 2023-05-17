<!doctype html>
<html >
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
</head>
<body>
<div style="width: 100%;display: inline-block;margin-bottom: -50px">
    <div  style="float: left">
        <span style="font-size: 18px">{{ $empresaGeneral->nombre }}</span>
        <br>
        <img style="width: 100px;height: 80px"  src="{{ asset($empresaGeneral->logo ? 'panel/img/empresa/'.$empresaGeneral->logo : 'panel/default/logo.png') }}" alt="">
    </div>
    <div  style="float: right">
        <span>{{ now()->format('d/m/Y') }}</span>
        <br>
        <span>{{ now()->format('h:i A') }}</span>
    </div>
</div>



</body>
</html>
