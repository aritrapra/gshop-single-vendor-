
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Katalog - MedisinHuset</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/img/store.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/fonts/simple-line-icons.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/Steps-Progressbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vanilla-zoom.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adset/assets/fonts/fontawesome-all.min.css') }}">
</head>

<body>
    <x-mynav></x-mynav>
    @php
        use App\Models\Review;
    @endphp
    <main class="page catalog-page">
        <section class="clean-block clean-catalog dark">
            <div class="container">
                <div class="block-heading" style="padding-top: 50px;">
                    <h2 class="text-info">Produkter</h2>
                </div>
                <div class="content">
                    <div class="row" style="padding-bottom:20px;">
                        @foreach ($products as $pt)
                            <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-3 col-xxl-3" style="padding-top:10px;">
                                <div class="clean-product-item" style="box-shadow: 1px 1px 2px 1px rgb(135,148,162);margin: 3px;border-width: 1px;border-color: rgb(0,0,0);border-radius: 5px;">
                                    <div class="image" >
                                        <a href="/productview/{{ $pt->id }}">
                                            <img class="img-fluid d-block mx-auto" src="/assets/productimg/{{ explode(',',$pt->img)[0] }}" style="height: 150px;">
                                        </a>
                                    </div>
                                    <div class="product-name"><a style="word-break: break-all;" href="/productview/{{ $pt->id }}">{{ substr($pt->name,0,40) }}</a></div>
                                    <p style="font-size: 12px;word-break: break-all;">{{ substr($pt->details,0,150) }}</p>
                                    <div class="about">
                                        @php

                                            $allrate = 0;
                                            $data = Review::where('product_id','=',$pt->id)->get();
                                            foreach ($data as $dt) {
                                                $allrate = $allrate + $dt->rating;
                                            }
                                            $totalrate = $data->count();
                                            if($totalrate == 0){
                                                $rate = 0;
                                            }else{
                                                $rate = $allrate / $totalrate;
                                            }
                                        @endphp
                                        <div class="rating">
                                            @for ($i = 0; $i < 5; $i++)
                                                @if ($i < $rate)
                                                    <span class="fa fa-star"></span>
                                                @else
                                                    <span class="fa fa-star" style="color:black;"></span>
                                                @endif
                                            @endfor
                                            ({{ $totalrate }})
                                        </div>
                                        <div class="pris">
                                            @php
                                                $list = explode('-',$pt->veriant);
                                                $minprice = 100000000000000000;
                                                for ($i=0; $i < count($list); $i++) {
                                                    $price = explode(',',$list[$i])[1];
                                                    if($price < $minprice){
                                                        $minprice = $price;
                                                    }
                                                }
                                            @endphp
                                            <h3>{{ $minprice }} Kr</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script src="{{ asset("assets/bootstrap/js/bootstrap.min.js") }}"></script>
</body>

</html>
