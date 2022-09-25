
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Ordre - MedisinHuset</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/img/store.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/store.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
    
    <link rel="stylesheet" href="{{ asset('assets/fonts/simple-line-icons.min.css') }}">
    
    <link rel="stylesheet" href="{{ asset('assets/css/Steps-Progressbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vanilla-zoom.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/steps-progressbar-1.css') }}">
</head>

<body>
    <x-mynav></x-mynav>
    <main class="page faq-page">
        <section class="clean-block clean-faq dark">
            <div class="container">
                <div class="block-heading" style="padding-top: 50px;">
                    <h2 class="text-info">Ordrehistorikk</h2>
                    <p></p>
                </div>
                <hr>
                @php
                    use App\Models\Product;
                @endphp
                @foreach ($orders as $od)
                <div class="container d-flex justify-content-center mt-50 mb-50" style="width: 100%;">

                    <div class="row" style="width: 100%;">
                        @php

                            $product_data = Product::where('id','=',$od->product_id)->first(['name','catagori','img','delivary']);
                            if($product_data != null){
                                $first_img = explode(',',$product_data->img)[0];
                                $first_img_path = asset('assets/productimg').'/'.$first_img;
                                $name = $product_data->name;
                                $catagori = $product_data->catagori;
                                $delivary = $product_data->delivary;
                            }else {
                                $first_img_path = asset('assets/img/box.png');
                                $name = "product deleted";
                                $catagori = "product deleted";
                                $delivary = "product deleted";
                            }
                        @endphp
                        <div class="card card-body">
                            <div class="row media align-items-center align-items-lg-start  text-lg-left flex-column flex-lg-row">
                                <div class="mr-2 mb-3 mb-lg-0 col-md-2 text-center">
                                    <img src="{{ $first_img_path }}" width="150" height="150" alt=""> </div>
                                <div class="media-body col-md-8" style="font-size: .8125rem;
                                font-weight: 400;">
                                    <h6 class="media-title font-weight-semibold"> <a href="{{ asset('/productview').'/'.$od->product_id }}" data-abc="true">{{ $name }}</a> </h6>
                                    <ul class="list-inline list-inline-dotted mb-3 mb-lg-2">
                                        <li class="list-inline-item" style="background-color: #6b54c04f;padding:0px 5px;border-radius:10px;"><a href="{{ asset('/catagoriview').'/'.$catagori }}" class="text-muted" data-abc="true">{{ $catagori }}</a></li>
                                    </ul>
                                    <p class="mb-3">Leveres innom : {{ $delivary }} dager</p>
                                    <div class="row text-center">
                                        <div class="col-2">
                                            <img src="{{ asset("/assets/img/placed_color.png") }}" alt="" style="width: 35px;height:35px;">
                                            <p class="">Plassert</p>
                                        </div>
                                        @if ($od->status == 'confirmed' or $od->status == 'shipped' or $od->status == 'delivered')
                                            <div class="col-1" style="height: 35px; padding:5px;">
                                                <img src="{{ asset("/assets/img/arrow_color.png") }}" alt="" style="width: 25px;height:25px;">

                                            </div>
                                            <div class="col-2">
                                                <img src="{{ asset("/assets/img/confirm_color.png") }}" alt="" style="width: 35px;height:35px;" >
                                                <p class="">Bekreftet</p>
                                            </div>
                                        @else
                                            <div class="col-1" style="height: 35px; padding:5px;">
                                                <img src="{{ asset("/assets/img/arrow_black.png") }}" alt="" style="width: 25px;height:25px;">

                                            </div>
                                            <div class="col-2">
                                                <img src="{{ asset("/assets/img/confirm_black.png") }}" alt="" style="width: 35px;height:35px;" >
                                                <p class="">Bekreftet</p>
                                            </div>
                                        @endif
                                        @if ($od->status == 'shipped' or $od->status == 'delivered')
                                            <div class="col-1" style="height: 35px; padding:5px;">
                                                <img src="{{ asset("/assets/img/arrow_color.png") }}" alt="" style="width: 25px;height:25px;">

                                            </div>
                                            <div class="col-2">
                                                <img src="{{ asset("/assets/img/shipped_color.png") }}" alt="" style="width: 35px;height:35px;" >
                                                <p class="">Sendt</p>
                                            </div>
                                        @else
                                            <div class="col-1" style="height: 35px; padding:5px;">
                                                <img src="{{ asset("/assets/img/arrow_black.png") }}" alt="" style="width: 25px;height:25px;">

                                            </div>
                                            <div class="col-2">
                                                <img src="{{ asset("/assets/img/shipped_black.png") }}" alt="" style="width: 35px;height:35px;" >
                                                <p class="">Sendt</p>
                                            </div>
                                        @endif
                                        @if ($od->status == 'delivered')
                                            <div class="col-1" style="height: 35px; padding:5px;">
                                                <img src="{{ asset("/assets/img/arrow_color.png") }}" alt="" style="width: 25px;height:25px;">

                                            </div>
                                            <div class="col-2">
                                                <img src="{{ asset("/assets/img/box_color.png") }}" alt="" style="width: 35px;height:35px;" >
                                                <p class="">Mottatt</p>
                                            </div>
                                        @else
                                            <div class="col-1" style="height: 35px; padding:5px;">
                                                <img src="{{ asset("/assets/img/arrow_black.png") }}" alt="" style="width: 25px;height:25px;">

                                            </div>
                                            <div class="col-2">
                                                <img src="{{ asset("/assets/img/box_black.png") }}" alt="" style="width: 35px;height:35px;" >
                                                <p class="">Mottatt</p>
                                            </div>
                                        @endif

                                    </div>

                                </div>
                                <div class="mt-3 mt-lg-0 ml-lg-3 text-center col-md-2 " style="height:100%;padding-top:20px;">
                                    <h3 class="mb-0 font-weight-semibold">{{ $od->total_price }} NOK</h3>
                                    <div> {{ number_format($od->btc_price,8) }} BTC </div>

                                    <a href="{{ asset('/showorder').'/'.$od->id }}" class="btn btn-warning mt-4 text-white">Detaljer</a>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
                @endforeach
            </div>
        </section>
    </main>
    <script src="{{ asset("assets/bootstrap/js/bootstrap.min.js") }}"></script>
</body>
<style>
    body {
    margin: 0;


    line-height: 1.5385;
    color: #333;
    text-align: left;
    background-color: #f5f5f5
}

.mt-50 {
    margin-top: 50px
}

.mb-50 {
    margin-bottom: 50px
}

.bg-teal-400 {
    background-color: #26a69a
}

a {
    text-decoration: none !important
}

.fa {
    color: red
}
</style>
</html>
