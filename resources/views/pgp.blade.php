
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>PGP key - MedisinHuset</title>
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
                    <h2 class="text-info">MedisinHuset's PGP Public Key</h2>
                    <p>Lagre denne PGP Key, det vill hjelpe deg å verifisere oss.</p>
                </div>
                <div class="block-content">
                    <div class="faq-item">
                        <h4 class="question" style="text-align: center;">PGP Public Key</h4>
                        <div class="answer" style="font-size: 12px;text-align: center;">
                            <pre>{{ $pgp }}</pre>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script src="{{ asset("assets/bootstrap/js/bootstrap.min.js") }}"></script>
</body>

</html>
