<html>

<head>
    <title>Faktur Pembayaran</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        #tabel {
            font-size: 15px;
            border-collapse: collapse;
        }

        #tabel td {
            padding-left: 5px;
            border: 1px solid black;
        }
    </style>
</head>

<body style='font-family:tahoma; font-size:8pt;'>
    <center>
        <table style='width:350px; font-size:16pt; font-family:calibri; border-collapse: collapse;' border='0'>
            <td width='70%' align='CENTER' vertical-align:top'><span style='color:black;'>
            </td>
        </table>
        <style>
            hr {
                display: block;
                margin-top: 0.5em;
                margin-bottom: 0.5em;
                margin-left: auto;
                margin-right: auto;
                border-style: inset;
                border-width: 1px;
            }
        </style>

        <div style='width:350px; font-size:12pt; font-family:calibri;  border-collapse: collapse;' border='0'>
            <b class="mt-2 text-3xl capitalize">{{$perusahaan}}</b>
            <p class="mt-2"><span style='font-size:12pt'>No. : {{$pemesanan->id}}, {{ date('Y-m-d') }}, {{ date('h:i:s')
                    }}</span></p>
            <table class="w-full border-b-2 mt-2 border-black">
                <thead class="border-b-2 border-black">
                    <tr class="w-full text-sm text-center">
                        <td>Item</td>
                        <td>Harga</td>
                        <td>Jumlah</td>
                        <td>Total</td>
                    </tr>
                </thead>
                <tbody class="text-center text-sm">
                    @foreach ($pemesanan_detail as $item)
                    <tr>
                        <td class="text-left">{{$item->nama}}</td>
                        <td>{{$item->harga}}</td>
                        <td>x{{$item->jumlah}}</td>
                        <td>Rp. {{$item->total}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="w-full flex flex-row text-right">
                <div class="w-7/12 h-5 font-bold">Total :</div>
                <div class="w-6/12 h-5 ">Rp. {{$pemesanan->total}}</div>
            </div>
            <div class="w-full flex flex-row text-right">
                <div class="w-7/12 h-5 font-bold">Cash :</div>
                <div class="w-6/12 h-5 ">Rp. {{$pemesanan->bayar}}</div>
            </div>
            <div class="w-full flex flex-row text-right">
                <div class="w-7/12 h-5 font-bold">Sisa :</div>
                <div class="w-6/12 h-5 ">Rp. {{$pemesanan->kembalian}}</div>
            </div>

        </div>
        <table style='width:350; font-size:12pt;' cellspacing='2'>
            <tr></br>
                <td align='center'>****** TERIMAKASIH ******</br></td>
            </tr>
        </table>
    </center>
</body>
<script>
    // window.print()
    // location.href = ;
</script>

</html>