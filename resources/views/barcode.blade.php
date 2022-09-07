<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet" />
    <style>
    </style>
</head>
<body class="p-5 grid grid-cols-2 gap-7">
    @php
        $data = 0;
    @endphp
    @foreach ($barcode as $item)
    <div class="h-80 w-80 border-2 flex justify-center gap-5 flex-col items-center">
        <div class="prose">
            <h2>{{$item->nama}}</h2>
        </div>
        <div class="">
           <img src="{{ asset(DNS2D::getBarcodePNGPath($item->url , 'QRCODE',9,9)) }}" alt="">
        </div>
    </div>
    @endforeach
    <script src="{{ mix('/js/app.js') }}" defer></script>
    <script>
       setTimeout(() => {
        window.print();
        window.close();
       }, 1000);
    </script>
</body>
</html>