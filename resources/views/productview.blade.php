
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Produkter - MedisinHuset</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/img/store.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/fonts/simple-line-icons.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/Steps-Progressbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vanilla-zoom.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adset/assets/fonts/fontawesome-all.min.css') }}">
</head>

<body>
    <x-mynav></x-mynav>
    <main class="page product-page">
        <section class="clean-block clean-product dark">
            <div class="container">
                <div class="block-heading" style="padding-top: 50px;">
                    <h2 class="text-info">Produkt</h2>
                    <p></p>
                </div>
                <div class="block-content">
                    <div class="product-info">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="gallery">
                                    <div id="product-preview" class="vanilla-zoom">
                                        <div class="zoomed-image" style="overflow: hidden;">
                                            @php
                                                $imgs = explode(',',$data->img);
                                            @endphp
                                            <img id='bigimg' class="img-fluid d-block small-preview" src="/assets/productimg/{{ $imgs[0] }}">
                                        </div>
                                        <div class="sidebar">
                                            @php
                                                $imgs = explode(',',$data->img);
                                            @endphp
                                            @foreach ($imgs as $ig)
                                                <img class="img-fluid d-block small-preview" src="/assets/productimg/{{ $ig }}" onclick="change_img('/assets/productimg/{{ $ig }}')">
                                            @endforeach
                                        </div>
                                        <script language="javascript">
                                            function change_img(url) {
                                                document.getElementById("bigimg").src = url;
                                            }
                                        </script>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info">
                                    <h3>{{ $data->name }}</h3>
                                    @php
                                        $t = 0;
                                        $treview = $reviews->count();
                                        foreach ($reviews as $rw) {
                                            $t = $t + $rw->rating;
                                        }
                                        if ($treview == 0) {
                                            $rate = 0;
                                        }else{
                                            $rate = $t / $treview;
                                        }
                                    @endphp
                                    <div class="rating" >
                                        @for ($i = 0; $i < 5; $i++)
                                            @if($i < $rate)
                                                <span class="fa fa-star"></span>
                                            @else
                                                <span class="fa fa-star" style="color: black;"></span>
                                            @endif

                                        @endfor
                                        ({{ $treview }})
                                    </div>
                                    <div class="price">
                                        <h3><span style="font-weight: normal;font-size:1.5vw;margin-right:10px;">Fra</span>
                                            @php
                                                $list = explode('-',$data->veriant);
                                                $minprice = 100000000000000000;
                                                for ($i=0; $i < count($list); $i++) {
                                                    $price = explode(',',$list[$i])[1];
                                                    if($price < $minprice){
                                                        $minprice = $price;
                                                    }
                                                }
                                            @endphp
                                            {{ $minprice }} Kr</h3>
                                    </div>
                                    <form action="/buynow" method="post">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $data->id }}">
                                        <div>
                                            <select style="width: 80%;height: 40px;border-radius: 7px;" name="veriant">
                                                <optgroup label="Velg listing">
                                                    @for($i = 0; $i < count($list); $i++)
                                                        @php
                                                            $price = explode(',',$list[$i]);

                                                        @endphp
                                                        <option value="{{ $i }}">{{ $price[0]." ".$data->unit." for ".$price[1]."Kr" }}</option>
                                                    @endfor
                                                </optgroup>
                                            </select>
                                        </div>
                                        <div style="mergin-top:10px;">
                                            <button class="btn btn-primary" style="margin-top:10px;" type="submit"><i class="icon-basket" ></i>Kjøp Nå</button>
                                        </div>
                                    </form>

                                    <div class="summary">
                                        <p>{{ $data->details }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-info">
                        <div>
                            <ul class="nav nav-tabs" role="tablist" id="myTab">
                                <li class="nav-item" role="presentation"><a class="nav-link active" role="tab" data-bs-toggle="tab" id="description-tab" href="#description">Annen Info</a></li>
                                <li class="nav-item" role="presentation"><a class="nav-link" role="tab" data-bs-toggle="tab" id="specifications-tabs" href="#specifications">Listinger</a></li>
                                <li class="nav-item" role="presentation"><a class="nav-link" role="tab" data-bs-toggle="tab" id="reviews-tab" href="#reviews">Reviews</a></li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active " role="tabpanel" id="description" style="padding: 20px;">
                                    <p>Leveringstid : {{ $data->delivary }} Dager</p>
                                    <p>Publisert : {{ explode(' ',$data->created_at)[0] }}</p>
                                </div>
                                <div class="tab-pane fade specifications" role="tabpanel" id="specifications">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <th>Mengde</th>
                                                <th>Pris</th>
                                            </thead>
                                            <tbody>
                                                @foreach ($list as $pdata)
                                                    @php
                                                        $price = explode(',',$pdata);
                                                    @endphp
                                                    <tr>
                                                        <td class="stat">{{ $price[0].' '.$data->unit }}</td>
                                                        <td>{{ $price[1] }}Kr</td>
                                                    </tr>
                                                @endforeach


                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" role="tabpanel" id="reviews">

                                    @if ($reviews != null)
                                        @foreach ($reviews as $rw)
                                            <div class="reviews">
                                                <div class="review-item">
                                                    <div class="rating">

                                                        @for ($i = 0; $i < 5; $i++)
                                                            @if ($i < intval($rw->rating))
                                                                <img src="{{ asset("assets/img/star.svg") }}">
                                                            @else
                                                                <img src="{{ asset("assets/img/star-empty.svg") }}">
                                                            @endif
                                                        @endfor



                                                    </div>
                                                    @php
                                                        $start_date = new DateTime($rw->created_at);
                                                        $since_start = $start_date->diff(new DateTime(now()));
                                                        if($since_start->days != 0){
                                                            $online_string = $since_start->days.' dager siden';
                                                        }elseif ($since_start->h != 0) {
                                                            $online_string = $since_start->h.' timer siden';
                                                        }else{
                                                            $online_string = $since_start->i.' minutter siden';
                                                        }
                                                    @endphp
                                                    <span class="text-muted">{{ $rw->user }}, {{ $online_string }}</span>
                                                    <p style="font-style: italic;">{{ $rw->comment }}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <p>No Reviews Yet</p>
                                    @endif


                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </main>

    <script src="{{ asset("assets/bootstrap/js/bootstrap.min.js") }}"></script>
</body>

</html>
