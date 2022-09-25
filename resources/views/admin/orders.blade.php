
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Ordre - Admin</title>
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
            <p style="color: rgb(19,14,242);padding: 10px 25px;font-size: 25px;line-height: 25px;letter-spacing: 2px;font-weight: bold;text-shadow: 1px 1px 0px rgb(101,99,53);margin-bottom: 0px;">
                <img src="{{ asset('assets/img/box_color.png') }}" style="width: 25px;margin-right: 15px;">Ordre
            </p>
            <hr style="margin-top: 4px;">
            <div id="content">
                @php
                    use App\Models\Product;
                @endphp
                <div class="container-fluid">
                    <h3 class="text-dark mb-4"></h3>
                    <p style="text-align: right;">
                        <a class="btn btn-primary" href="/godisHusetmyadmin/failed" style="background: rgb(223,104,78);margin-right: 5px;">Misslykkede kjøp</a>
                        <button class="btn btn-primary" type="button">Vis leverte produkter</button>
                    </p>
                    @if ($con_orders->count() == 0 and $shiporder->count() == 0)
                        <p style="color: red;text-align:center;font-size:30px;border:1px solid black;border-radius:10px;">Ingen aktive ordrer</p>
                    @endif
                    @if ($con_orders->count() != 0)
                        <div class="card shadow">
                            <div class="card-header py-3">
                                <p class="text-primary m-0 fw-bold">Venter Shipping</p>
                            </div>

                            @foreach ($con_orders as $od)
                                @php
                                    $data = Product::where('id','=',$od->product_id)->first(['name','img']);
                                    $first_img = explode(',',$data->img)[0];
                                    $first_img_path = asset('assets/productimg').'/'.$first_img;
                                    $start_date = new DateTime($od->created_at);
                                    $since_start = $start_date->diff(new DateTime(now()));
                                    if($since_start->days != 0){
                                        $time_string = $since_start->days.' dager siden';
                                    }elseif ($since_start->h != 0) {
                                        $time_string = $since_start->h.' timer siden';
                                    }else{
                                        $time_string = $since_start->i.' minutter siden';
                                    }

                                    if($od->status == 'confirmed'){
                                        $bar_width = 34;
                                    }else if($od->status == 'shipped'){
                                        $bar_width = 67;
                                    }elseif ($od->status == "delivered") {
                                        $bar_width = 100;
                                    }
                                @endphp
                                <div class="row" style="margin: 10px;border-radius: 10px;border-style: none;box-shadow: 1px 1px 1px 1px rgb(0,0,0);">
                                    <div class="col-xxl-3 align-self-center" style="padding: 0px;"><img style="width: 100%;height: 200px;border-top-left-radius: 10px;border-bottom-left-radius: 10px;" src="{{ $first_img_path }}" /></div>
                                    <div class="col-xxl-7" style="padding: 0px;">
                                        <p style="padding: 5px 10px;font-size: 20px;color: rgb(3,32,255);margin-bottom: 5px;">{{ $data->name }}</p>
                                        <p style="padding: 0px 10px;font-size: 14px;margin-bottom: 5px;">Bestilt av : <a href="#" style="text-decoration: none;color: rgb(54,55,62);">{{ $od->user }}</a></p>
                                        <p style="padding: 0px 10px;font-size: 14px;margin-bottom: 5px;">Bestilt den : {{ $time_string }}</p>
                                        <p style="padding: 0px 10px;font-size: 14px;margin-bottom: 5px;">Ordreverdi : {{ $od->total_price }} NOK eller
                                            @if ($od->payment_type == 'btc')
                                                {{ number_format($od->btc_price,6) }} BTC <img src="{{ asset('assets/img/bitcoin_new.png') }}" alt="" style="width:25px;height:25px;">
                                            @elseif($od->payment_type == 'xmr')
                                                {{ number_format($od->xmr_price,6) }} XMR <img src="{{ asset('assets/img/monero.png') }}" alt="" style="width:25px;height:25px;">
                                            @endif
                                            </p>
                                        <div class="row" style="font-size: 12px;">
                                            <div class="col-3 text-center align-self-center"><img src="{{ asset('/assets/img/placed_color.png') }}" style="width: 30px;" />
                                                <p>Bestillt</p>
                                            </div>
                                            <div class="col-3 text-center align-self-center"><img src="{{ asset("/assets/img/confirm_color.png") }}" style="width: 30px;" />
                                                <p>Confirmed</p>
                                            </div>
                                            <div class="col-3 text-center align-self-center"><img src="{{ asset("assets/img/shipped_color.png") }}" style="width: 30px;" />
                                                <p>Shipped</p>
                                            </div>
                                            <div class="col-3 text-center align-self-center"><img src="{{ asset("assets/img/box_color.png") }}" style="width: 30px;" />
                                                <p>Delivered</p>
                                            </div>
                                            <div class="col">
                                                <div class="progress" style="height: 16px;margin-top: -10px;margin-right: 11.5%;margin-left: 11.5%;background: rgb(213,248,0);">
                                                    <div class="progress-bar" role="progressbar"  style="width: {{ $bar_width }}%;background: rgb(13,80,253);"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col align-self-center">

                                        <a class="btn btn-primary pull-right" href="/godisHusetmyadmin/orders/{{ $od->id }}" style="background: rgb(71,137,55);padding: 2px 10px;border-radius: 15px;float: left;margin:5px;">
                                            <i class="fa fa-check"></i>
                                             Sendt
                                        </a>
                                        <a class="btn btn-primary pull-right" href="/godisHusetmyadmin/order_details/{{ $od->id }}" style="background: rgb(55, 63, 137);padding: 2px 10px;border-radius: 15px;float: left;margin:5px;">
                                            <i class="fa fa-eye"></i>
                                            View
                                        </a>
                                        <a class="btn btn-primary pull-right" target="blank" href="/godisHusetmyadmin/chat/{{ $od->id }}" style="background: rgb(55, 63, 137);padding: 2px 10px;border-radius: 15px;float: left;margin:5px;">
                                            <i class="fa fa-eye"></i>
                                            View chat
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    @if ($shiporder->count() != 0)
                        <div class="card shadow" style="margin-top:20px;">
                            <div class="card-header py-3">
                                <p class="text-primary m-0 fw-bold">Venter for utsendelse</p>
                            </div>

                            @foreach ($shiporder as $od)
                                @php
                                    $data = Product::where('id','=',$od->product_id)->first(['name','img']);
                                    $first_img = explode(',',$data->img)[0];
                                    $first_img_path = asset('assets/productimg').'/'.$first_img;
                                    $start_date = new DateTime($od->created_at);
                                    $since_start = $start_date->diff(new DateTime(now()));
                                    if($since_start->days != 0){
                                        $time_string = $since_start->days.' dager siden';
                                    }elseif ($since_start->h != 0) {
                                        $time_string = $since_start->h.' timer siden';
                                    }else{
                                        $time_string = $since_start->i.' minutter siden';
                                    }
                                    $bar_width = 0;
                                    if($od->status == 'confirmed'){
                                        $bar_width = 34;
                                    }else if($od->status == 'shipped'){
                                        $bar_width = 67;
                                    }elseif ($od->status == "delivered") {
                                        $bar_width = 100;
                                    }
                                @endphp
                                <div class="row" style="margin: 10px;border-radius: 10px;border-style: none;box-shadow: 1px 1px 1px 1px rgb(0,0,0);">
                                    <div class="col-xxl-3 align-self-center" style="padding: 0px;"><img style="width: 100%;height: 200px;border-top-left-radius: 10px;border-bottom-left-radius: 10px;" src="{{ $first_img_path }}" /></div>
                                    <div class="col-xxl-7" style="padding: 0px;">
                                        <p style="padding: 5px 10px;font-size: 20px;color: rgb(3,32,255);margin-bottom: 5px;">{{ $data->name }}</p>
                                        <p style="padding: 0px 10px;font-size: 14px;margin-bottom: 5px;">Bestilt av : <a href="#" style="text-decoration: none;color: rgb(54,55,62);">{{ $od->user }}</a></p>
                                        <p style="padding: 0px 10px;font-size: 14px;margin-bottom: 5px;">Bestilt den : {{ $time_string }}</p>
                                        <p style="padding: 0px 10px;font-size: 14px;margin-bottom: 5px;">Ordreverdi : {{ $od->total_price }} NOK eller {{ number_format($od->btc_price,6) }} BTC</p>
                                        <div class="row" style="font-size: 12px;">
                                            <div class="col-3 text-center align-self-center"><img src="{{ asset('/assets/img/placed_color.png') }}" style="width: 30px;" />
                                                <p>Bestillt</p>
                                            </div>
                                            <div class="col-3 text-center align-self-center"><img src="{{ asset("/assets/img/confirm_color.png") }}" style="width: 30px;" />
                                                <p>Confirmed</p>
                                            </div>
                                            <div class="col-3 text-center align-self-center"><img src="{{ asset("assets/img/shipped_color.png") }}" style="width: 30px;" />
                                                <p>Shipped</p>
                                            </div>
                                            <div class="col-3 text-center align-self-center"><img src="{{ asset("assets/img/box_color.png") }}" style="width: 30px;" />
                                                <p>Delivered</p>
                                            </div>
                                            <div class="col">
                                                <div class="progress" style="height: 16px;margin-top: -10px;margin-right: 11.5%;margin-left: 11.5%;background: rgb(213,248,0);">
                                                    <div class="progress-bar" role="progressbar"  style="width: {{ $bar_width }}%;background: rgb(13,80,253);"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col align-self-center">


                                        <a class="btn btn-primary pull-right" href="/godisHusetmyadmin/order_details/{{ $od->id }}" style="background: rgb(55, 63, 137);padding: 2px 10px;border-radius: 15px;float: left;margin:5px;">
                                            <i class="fa fa-eye"></i>
                                            View
                                        </a>
                                        <a class="btn btn-primary pull-right" target="blank" href="/godisHusetmyadmin/chat/{{ $od->id }}" style="background: rgb(55, 63, 137);padding: 2px 10px;border-radius: 15px;float: left;margin:5px;">
                                            <i class="fa fa-eye"></i>
                                            View chat
                                        </a>

                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif


                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('adset/assets/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('adset/assets/js/Drag-and-Drop-Multiple-File-Form-Input-upload-Advanced.js') }}"></script>
    <script src="{{ asset('adset/assets/js/theme.js') }}"></script>
</body>

</html>
