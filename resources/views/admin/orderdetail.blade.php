
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Order Details : Admin</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/img/support.png') }}">
    <link rel="stylesheet" href="{{ asset('adset/assets/bootstrap/css/bootstrap.min.css') }}">
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
                <p style="color: rgb(19,14,242);padding: 10px 25px;font-size: 25px;line-height: 25px;letter-spacing: 2px;font-weight: bold;text-shadow: 1px 1px 0px rgb(101,99,53);margin-bottom: 0px;">
                    <img src="{{ asset('assets/img/cat.png') }}" style="width: 25px;margin-right: 15px;">Order Details
                </p>
                <hr style="margin-top: 4px;">
                <div class="container-fluid">
                    <h3 class="text-dark mb-4"></h3>
                </div>
                <div class="row">
                    @php
                        if($product == null){
                            $name = "product deleted";
                            $unit = 'unit';
                        }else{
                            $name = $product->name;
                            $unit = $product->unit;
                        }
                    @endphp
                    <div class="col" style="padding: 0px 40px;">
                        <p style="margin-bottom: 5px;">Product Name :<span style="margin-left: 5px;color: rgb(0,30,255);">{{ $name }}</span></p>
                        <p style="margin-bottom: 5px;">Order By :<span style="margin-left: 5px;color: rgb(33,173,31);">{{ $order->user }}</span></p>
                        <p style="margin-bottom: 5px;">Order Status :
                            @if ($order->status == 'started')
                            <span style="margin-left: 5px;color: rgb(232, 13, 13);">Started</span>
                            @elseif ($order->status == 'confirmed')
                            <span style="margin-left: 5px;color: rgb(232,92,13);">Confirmed</span>

                            @elseif ($order->status == 'shipped')
                            <span style="margin-left: 5px;color: rgb(200,193,33);">Shipped</span>
                            @elseif ($order->status == 'delivered')
                            <span style="margin-left: 5px;color: rgb(33,147,15);">Delivered</span>
                            @endif



                        </p>
                        @php
                            $start_date = new DateTime($order->created_at);
                            $since_start = $start_date->diff(new DateTime(now()));
                            if($since_start->days != 0){
                                $online_string = $since_start->days.' dager siden';
                            }elseif ($since_start->h != 0) {
                                $online_string = $since_start->h.' timer siden';
                            }else{
                                $online_string = $since_start->i.' minutter siden';
                            }
                        @endphp
                        <p style="margin-bottom: 5px;">Order on :<span style="margin-left: 5px;color: rgb(0,0,0);font-size: 14px;">{{ $online_string }}</span></p>
                        @php
                            $veriant = explode(',',$order->veriant);
                        @endphp
                        <p style="margin-bottom: 5px;">Order Veriant :<span style="margin-left: 5px;color: rgb(0,0,0);font-size: 14px;">{{ $veriant[0] }} {{ $unit }} at {{ $veriant[1] }} NOK</span>&nbsp;</p>
                        <p style="margin-bottom: 5px;">Order Value in NOK :<span style="margin-left: 5px;color: rgb(0,0,0);font-size: 14px;">{{ $order->total_price }} NOK</span></p>
                        @if ($order->payment_type == 'btc')
                        <p style="margin-bottom: 5px;">Order Value in BTC :<span style="margin-left: 5px;color: rgb(0,0,0);font-size: 14px;">{{ number_format($order->btc_price,8) }} BTC</span></p>
                        <p style="margin-bottom: 5px;">Payment Mode :<span style="margin-left: 5px;color: rgb(0,0,0);font-size: 14px;">BTC <img src="{{ asset('assets/img/bitcoin_new.png') }}" alt="" style="width: 25px;height:25px;"></span></p>
                        @elseif($order->payment_type == 'xmr')
                        <p style="margin-bottom: 5px;">Order Value in XMR :<span style="margin-left: 5px;color: rgb(0,0,0);font-size: 14px;">{{ number_format($order->xmr_price,8) }} XMR</span></p>
                        <p style="margin-bottom: 5px;">Payment Mode :<span style="margin-left: 5px;color: rgb(0,0,0);font-size: 14px;">XMR <img src="{{ asset('assets/img/monero.png') }}" alt="" style="width: 25px;height:25px;"></span></p>
                        @endif


                        <p style="margin-bottom: 5px;">Payment Address :<span style="margin-left: 5px;color: rgb(0,0,0);font-size: 14px;">{{ $order->address }}</span></p>
                        <p style="margin-bottom: 5px;">Delhivary Message :</p>
                        <textarea style="font-size:14px;color:black;border:0.5px dotted black;width:700px;height:400px;">{{ $order->message }}</textarea>
                        <p class="text-center" style="margin-bottom: 50px;margin-top:10px;">
                            <a class="btn btn-primary pull-right" href="/godisHusetmyadmin/orders/{{ $order->id }}" style="background: rgb(71,137,55);padding: 2px 10px;border-radius: 15px;float: left;margin:5px;">
                                <i class="fa fa-check"></i>
                                 Sendt
                            </a>
                        </p>

                    </div>
                </div>
            </div>
        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
    <script src="{{ asset('adset/assets/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('adset/assets/js/Drag-and-Drop-Multiple-File-Form-Input-upload-Advanced.js') }}"></script>
    <script src="{{ asset('adset/assets/js/theme.js') }}"></script>
</body>

</html>
