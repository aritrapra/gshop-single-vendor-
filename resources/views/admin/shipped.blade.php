
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Utsending</title>
    <link rel="stylesheet" href="{{ asset('adset/assets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="{{ asset('adset/assets/fonts/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset("adset/assets/fonts/font-awesome.min.css") }}">
    <link rel="stylesheet" href="{{ asset('adset/assets/fonts/fontawesome5-overrides.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adset/assets/css/Drag--Drop-Upload-Form.css') }}">
    <link rel="stylesheet" href="{{ asset('adset/assets/css/Drag-and-Drop-Multiple-File-Form-Input-upload-Advanced.css') }}">
    <link rel="stylesheet" href="{{ asset('adset/assets/css/Responsive-Form-1.css') }}">
    <link rel="stylesheet" href="{{ asset('adset/assets/css/Responsive-Form.css') }}">
</head>

<body id="page-top">
    <div id="wrapper">
        <x-lognav></x-lognav>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <p style="color: rgb(19,14,242);padding: 10px 25px;font-size: 25px;line-height: 25px;letter-spacing: 8px;font-weight: bold;text-shadow: 1px 1px 0px rgb(101,99,53);margin-bottom: 0px;">
                    <img src="{{ asset('assets/img/shipped_color.png') }}" style="width: 25px;margin-right: 15px;">Utsending
                </p>
                <hr style="margin-top: 4px;">
                <div class="container-fluid">
                    <h3 class="text-dark mb-4"></h3>
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 fw-bold">Send Produkt</p>
                        </div>
                        <div class="card-body">
                            <div class="col" style="padding: 10px;">
                                <p style="margin-bottom: 5px;">Produkt Navn :<span style="margin-left: 5px;color: rgb(0,30,255);">{{ $product->name }}</span></p>
                                <p style="margin-bottom: 5px;">Bestillt av :<span style="margin-left: 5px;color: rgb(33,173,31);">{{ $order->user }}</span></p>
                                @php
                                    $veriants = explode(',',$order->veriant);
                                @endphp
                                <p style="margin-bottom: 5px;">Order Veriant :<span style="margin-left: 5px;color: rgb(0,0,0);font-size: 14px;">{{ $veriants[0] }} NOK for {{ $veriants[1] }} g</span>&nbsp;</p>
                                <p style="margin-bottom: 5px;">Bestillings Addresse :<span style="margin-left: 5px;color: rgb(0,0,0);font-size: 14px;">{{ $order->address }}</span></p>
                                <form action="/godisHusetmyadmin/orders/ship/{{ $order->id }}" method="post">
                                    @csrf
                                    <p style="margin-bottom: 5px;">Shipment Melding :</p>
                                    <p style="margin-bottom: 5px;">:<textarea style="margin-left: 0px;width: 600px;height: 300px;" name="message"></textarea></p>
                                    @if ($pgp == 1)
                                        <p style="margin-bottom: 5px;">
                                            <input type="radio" id="encrypt" name="encrypt" value="1">
                                            <label for="encrypt">
                                                Encrypt With user PGP
                                            </label>
                                        </p>
                                    @endif
                                    <p style="margin-bottom: 5px;"><button class="btn btn-primary" type="submit">Merk Sendt</button></p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('adset/assets/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('adset/assets/js/Drag-and-Drop-Multiple-File-Form-Input-upload-Advanced.js') }}"></script>
    <script src="{{ asset('adset/assets/js/theme.js') }}"></script>
</body>

</html>
