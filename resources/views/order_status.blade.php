
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Betaling - Medicinhuset</title>
        <link rel="icon" type="image/png" href="{{ asset('assets/img/store.png') }}">
        <link rel="stylesheet" href="{{ asset("assets/bootstrap/css/bootstrap.min.css") }}">

        <link rel="stylesheet" href="{{ asset("assets/fonts/font-awesome.min.css") }}">

        <link rel="stylesheet" href="{{ asset("assets/css/steps-progressbar-1.css") }}">
        <link rel="stylesheet" href="{{ asset("assets/css/Steps-Progressbar.css") }}">
        <link rel="stylesheet" href="{{ asset("assets/css/vanilla-zoom.min.css") }}">
    </head>

    <body>
        <x-mynav></x-mynav>
        <main class="page payment-page">
            <section class="clean-block payment-form dark">
                <div class="container">
                    <div class="block-heading" style="padding-top: 50px;">
                        <h2 class="text-info">Ordre Status</h2>
                        <p>Betal for å bekrefte din ordre</p>
                    </div>
                    <form>
                        @php
                            if($product != null){
                                $name = $product->name;
                                $delivary = $product->delivary;
                            }else{
                                $name = "Product Deleted";
                                $delivary = "Product Deleted";
                            }
                        @endphp
                        <div class="products">
                            <h3 class="title">Sjekk ut</h3>
                            <div class="item"><span class="price">{{ $order->total_price }} NOK</span>
                                <p class="item-name">{{ $name }}</p>
                                <p class="item-description">på {{ $delivary }} dager</p>
                            </div>

                            <div class="total"><span>Total</span><span class="price">{{ $order->total_price }} NOK</span></div>
                            <div class="total">
                                @if ($order->payment_type == 'btc')
                                    <span>Total BTC</span>
                                    <span class="price">{{ number_format($order->btc_price,8) }} BTC</span>
                                @elseif($order->payment_type == 'xmr')
                                    <span>Total XMR</span>
                                    <span class="price">{{ number_format($order->xmr_price,8) }} XMR</span>
                                @endif

                            </div>
                            <div class="total">
                                <span>Betale med :</span>
                                @if ($order->payment_type == 'btc')

                                    <span class="price"><img src="{{ asset('assets/img/bitcoin_new.png') }}" alt="" style="width: 25px;height:25px;"> BTC</span>
                                @elseif($order->payment_type == 'xmr')
                                    <span class="price"><img src="{{ asset('assets/img/monero.png') }}" alt="" style="width: 25px;height:25px;"> XMR</span>
                                @endif

                            </div>
                        </div>
                        <div class="card-details">
                            @if ($order->status != 'shipped')
                                <h3 class="title">Betalingsdetaljer</h3>
                            @else
                                <h3 class="title">Send besked</h3>

                            @endif
                            @php
                                use chillerlan\QRCode\QRCode;
                                use chillerlan\QRCode\QROptions;
                                require_once('./../vendor/autoload.php');
                                $options = new QROptions(
                                [
                                    'eccLevel' => QRCode::ECC_L,
                                    'outputType' => QRCode::OUTPUT_MARKUP_SVG,
                                    'version' => 5,
                                ]
                                );
                                if ($order->payment_type == 'btc') {
                                    $string = 'bitcoin:'.trim($order->address).'?amount='.$order->btc_price;
                                }elseif ($order->payment_type == 'xmr') {
                                    $string = trim($order->address);
                                }

                                $qrcode = (new QRCode($options))->render($string);
                            @endphp
                            <div class="row">
                                @if ($order->status == 'started')
                                    <div class="text-center">

                                        <img style="width: 200px;height: 200px;" src='{{ $qrcode }}'/>
                                        <p>scan for addresse</p>
                                    </div>
                                    <div class="col-sm-7 col-xl-12">
                                        <div class="mb-3">
                                            <label class="form-label" for="card_holder">Betalingslenke</label>
                                            @if ($order->payment_type == 'btc')
                                                <input disabled class="form-control" type="text" id="card_holder" placeholder="Address" name="ADDRESS" value="{{ $order->address }}">
                                            @elseif ($order->payment_type == 'xmr')
                                                <p style="word-break: break-all;background-color:rgba(107, 104, 104, 0.293);padding:5px;border-radius:3px;">{{ $order->address }}</p>
                                            @endif

                                        </div>
                                    </div>
                                @elseif($order->status == 'confirmed')
                                    <pre class="text-center" style="font-size: 18px;">Waiting For Shipping</pre>

                                @elseif($order->status == 'shipped')
                                    <pre class="text-center" style="font-size: 14px;">{{ $order->shipmessage }}</pre>
                                @endif


                                <div class="col-sm-12">
                                    <div class="products">
                                        <h3 class="title">Ordre Status</h3>
                                        <div class="item">
                                            @if($order->status == 'started')
                                                <p class="item-name" style="color: var(--bs-red);">Ingen betaling mottatt</p>
                                            @elseif ($order->status == 'confirmed')
                                                <p class="item-name" style="color: rgb(54,183,22);">Ordre Bekreftet</p>
                                            @endif
                                        </div>
                                        <div class="steps-progressbar">
                                            <ul>
                                                @if($order->status == 'started')
                                                    <li class="active">Plassert</li>
                                                    <li class="">Betaling</li>
                                                    <li class="">Sendt</li>
                                                    <li>Mottatt</li>
                                                @elseif($order->status == 'confirmed')
                                                    <li class="previous">Plassert</li>
                                                    <li class="active">Betaling</li>
                                                    <li class="">Sendt</li>
                                                    <li>Mottatt</li>
                                                @elseif($order->status == 'shipped')
                                                    <li class="previous">Plassert</li>
                                                    <li class="previous">Betaling</li>
                                                    <li class="active">Sendt</li>
                                                    <li>Mottatt</li>
                                                @elseif($order->status == 'delivered')
                                                    <li class="previous">Plassert</li>
                                                    <li class="previous">Betaling</li>
                                                    <li class="previous">Sendt</li>
                                                    <li class="previous">Mottatt</li>
                                                @else
                                                    <li class="previous">Plassert</li>
                                                    <li class="active">Order Canceled</li>
                                                @endif

                                            </ul>
                                        </div>
                                    </div>
                                    <div style="width: 100%;height:10px;" ></div>
                                    @if ($order->status == 'shipped')
                                        <div class="mb-3 text-center">
                                            <a href="{{ asset('/markdeliver').'/'.$order->id }}" class="btn btn-primary" type="submit">merke levert</a>
                                        </div>
                                    @endif
                                    @if ($order->status == 'confirmed' && $order->status == 'shipped')
                                        <div class="mb-3 text-center">
                                            <a href="{{ asset('/chat').'/'.$order->id }}" class="btn btn-primary" type="submit">chatte med selger</a>
                                        </div>
                                    @endif
                                    @if ($order->status == 'started')
                                        <div class="mb-3 text-center">
                                            <a href="{{ asset('/showorder').'/'.$order->id }}" class="btn btn-primary" type="submit">Oppdater Ordre</a>
                                        </div>
                                    @elseif($order->status == 'delivered' and $order->review != 1)
                                        <div class="mb-3">
                                            <a href="{{ asset('/review').'/'.$order->id }}" class="btn btn-primary d-block w-100" type="submit">Ranger Produkt</a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
        </main>
        <script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets/js/Bootstrap-DataTables.js') }}"></script>
        <script src="{{ asset('assets/js/theme.js') }}"></script>
    </body>

    </html>
