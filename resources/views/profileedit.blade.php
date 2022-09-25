<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Sett ny PGP - MedisinHuset</title>
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
                    <h2 class="text-info">{{ $user }}</h2>
                    <p>Rediger Profil</p>
                </div>
                <div class="block-content">
                    <form action="/setnewpgp" method="POST">
                        @csrf
                        <div class="faq-item">
                            <h4 class="question" style="text-align: center;">Oppdater ny PGP Key</h4>
                            @error('pgp')
                                <p class="text-center" style="letter-spacing: 0px;font-size: 12px;color: rgb(255,0,0);background: #e9ff00;padding: 6px;font-weight: bold;margin-top:5px;">{{ $message }}</p>
                            @enderror
                            <div class="answer" style="text-align: center;">

                                <textarea style="width: 400px;height: 200px;" name="pgp"></textarea>
                            </div>
                        </div>
                        <p style="text-align: center;"><button class="btn btn-primary" type="submit">Sett ny PGP</button></p>
                    </form>
                </div>
            </div>
        </section>
    </main>
    <script src="{{ asset("assets/bootstrap/js/bootstrap.min.js") }}"></script>
</body>

</html>
