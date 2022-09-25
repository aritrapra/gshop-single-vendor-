
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>2-Faktor Autotentisering - MedisinHuset</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/img/store.png') }}">
    <link rel="stylesheet" href="{{ asset("assets/bootstrap/css/bootstrap.min.css") }}">
 
    <link rel="stylesheet" href="{{ asset("assets/fonts/font-awesome.min.css") }}">

    <link rel="stylesheet" href="{{ asset("assets/css/steps-progressbar-1.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/css/Steps-Progressbar.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/css/vanilla-zoom.min.css") }}">
</head>

<body>
    <x-mynav></x-mynav>
    <main class="page faq-page">
        <section class="clean-block clean-faq dark">
            <div class="container">
                <div class="block-heading" style="padding-top: 50px;">
                    <h2 class="text-info">2-Faktor Autotentisering</h2>
                    <p>Din konto har 2FA beskyttelse, verifiser din pgp key før du kan fortsette.</p>
                </div>
                <div class="block-content">
                    <div class="faq-item">
                        <h4 class="question" style="text-align: center;">Kryptert Melding</h4>
                        <div class="answer" style="font-size: 12px;text-align: center;">
                            <pre>{{ $msg }}</pre>
                        </div>
                    </div>
                    <form action="/verify2fa" method="POST">
                        @csrf
                        <div class="faq-item">
                            <h4 class="question" style="text-align: center;">Dekryptert Melding</h4>
                            <div class="answer" style="text-align: center;"><input type="text" name="decode" style="width: 400px;"></div>
                        </div>
                        <p style="text-align: center;"><button class="btn btn-primary" type="submit">Verifiser</button></p>
                    </form>
                </div>
            </div>
        </section>
    </main>
    <script src="{{ asset("assets/bootstrap/js/bootstrap.min.js") }}"></script>
</body>

</html>
