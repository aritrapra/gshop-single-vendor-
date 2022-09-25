
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Betaling - MedisinHuset</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/img/store.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/fonts/simple-line-icons.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/Steps-Progressbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vanilla-zoom.min.css') }}">
</head>

<body>
    <x-mynav></x-mynav>
    <main class="page payment-page">
        <section class="clean-block payment-form dark">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-info">Betaling</h2>
                    <p>Utfør betaling for å bekrefte ordren</p>
                </div>
                <form action="/confirm_order" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{ $id }}">
                    <div class="products">
                        <h3 class="title">Ordreinformasjon</h3>
                        <div class="item"><span class="price">{{ $price }} NOK</span>
                            <p class="item-name">{{ $product->name }}</p>
                            <p class="item-description">Antatt levering {{ $product->delivary }} Dager</p>
                        </div>

                        <div class="total"><span>Sum</span><span class="price">{{ $price }} NOK</span></div>
                        <div class="total"><span>BTC</span><span class="price" style="color: #909409;">{{ number_format($btc,6) }} BTC</span></div>
                        <div class="total"><span>XMR</span><span class="price" style="color: #b54a11;">{{ number_format($xmr,6) }} XMR</span></div>

                    </div>
                    <p style="color: red;margin:0px 40px;text-align:center;font-style:italic;font-size:15px;">Fyll inn utsendingsinfo kryptert med vår PGP, trykk deretter på plasser ordre.</p>
                    <div class="card-details">
                        <h3 class="title">Forsendelse detaljer</h3>
                            <div class="row">
                                <div class="col-sm-7 col-xl-12">
                                    @error('message')
                                        <p style="text-align: center;">{{ $message }}</p>
                                    @enderror
                                    <div class="mb-3">
                                        <label class="form-label" for="card_holder">Utsendingsinfo</label>
                                        <textarea name="message" id="" class="form-control" maxlength="4000" required></textarea>
                                    </div>


                                    <div class="mb-3">
                                        <label class="form-label" for="card_holder" style="color:red;">This message will automatically encrypted with MedisinHuset's pgp key</label>
                                    </div>

                                </div>

                                <div class="col-sm-12 align-self-center">
                                    <label class="form-label" for="card_holder">Plasser Ordre</label>
                                    <div class="mb-3">
                                        <label class="form-label" style="transform: translateY(75%);margin-right:5px;">Betale med :</label>
                                        <button class="btn btn-primary" type="submit" name="pay" value="btc" style="font-size: 14px;font-style: italic;font-weight: bold;padding: 8px 25px;background: rgb(183,162,50);margin-left: 0px;margin-right: 10px;">
                                            <img style="width: 25px;height: 25px;margin-right: 10px;" src="{{ asset('assets/img/bitcoin_new.png') }}" />
                                            Bitcoin
                                        </button>
                                        <button class="btn btn-primary" type="submit" name="pay" value="xmr" style="font-size: 14px;font-style: italic;font-weight: bold;padding: 8px 25px;background: rgb(187,70,20);">
                                            <img style="width: 25px;height: 25px;margin-right: 10px;" src="{{ asset('assets/img/monero.png') }}" />
                                            Monero
                                        </button>

                                    </div>
                                </div>
                            </div>

                    </div>
                </form>
            </div>
        </section>
    </main>

    <script src="{{ asset("assets/bootstrap/js/bootstrap.min.js") }}"></script>
</body>

</html>
