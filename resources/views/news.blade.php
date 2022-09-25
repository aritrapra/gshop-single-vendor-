<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Nyheter - MedisinHuset</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/img/store.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
    
    <link rel="stylesheet" href="{{ asset('assets/fonts/simple-line-icons.min.css') }}">
    
    <link rel="stylesheet" href="{{ asset('assets/css/Steps-Progressbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vanilla-zoom.min.css') }}">
</head>

<body>
    <x-mynav></x-mynav>
    <main class="page faq-page">
        <section class="clean-block clean-faq dark">
            <div class="container">
                <div class="block-heading" style="padding-top: 50px;">
                    <h2 class="text-info">Kunngjøringer</h2>
                    <p></p>
                </div>
                <hr>
                <div class="block-content">
                    @foreach ($news as $nw)
                        <div class="faq-item">
                            @php
                                $start_date = new DateTime($nw->created_at);
                                $since_start = $start_date->diff(new DateTime(now()));
                                if($since_start->days != 0){
                                $online_string = $since_start->days.' dager siden';
                                }elseif ($since_start->h != 0) {
                                $online_string = $since_start->h.' timer siden';
                                }else{
                                $online_string = $since_start->i.' minutter siden';
                                }

                            @endphp
                            <h4 class="question">{{ $nw->heading."  ( ".$online_string. " )" }}</h4>
                            <div class="answer">
                                <p>
                                    @php
                                        echo nl2br(htmlspecialchars($nw->news));
                                    @endphp

                                </p>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </section>
    </main>
    <script src="{{ asset("assets/bootstrap/js/bootstrap.min.js") }}"></script>
</body>

</html>
