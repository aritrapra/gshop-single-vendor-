
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Profil - MedisinHuset</title>
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
                    <h2 class="text-info">{{ $user }}
                        @if ($user == 'godisHusetmyadmin' or $user == 'GodisHuset')
                            <a style="text-decoration:none;font-size:14px;color:blue;" href="/godisHusetmyadmin" target="blank">(Admin)</a>
                        @endif
                    </h2>
                    <p>Brukerprofil</p>
                </div>
                <div class="block-content">
                    <div class="faq-item">
                        <h4 class="question" style="text-align: center;">Nåværende PGP Key</h4>
                        <div class="answer" style="font-size: 12px;text-align: center;">
                            @if ($userdata->pgp != null)
                                <pre>{{ $userdata->pgp }}</pre>
                            @else
                                <p style="font-size: 18px;color:red;">Legg till en PGP KEY for å sikkre din konto ytterligere</p>
                            @endif

                        </div>
                    </div>
                    <p style="text-align: center;"><a class="btn btn-primary" href="/setpgp" type="submit">Oppdater PGP</a></p>
                </div>
                <div class="block-content" style="margin-top: 20px;">
                    <div class="faq-item">
                        <h4 class="question" style="text-align: center;">2 Faktor-Autentisering</h4>
                        <div class="answer" style="font-size: 12px;text-align: center;">
                            <p>
                                <span>Nåværende Status :&nbsp;</span>
                                @if ($userdata->two_factor != 1)
                                    <span style="color: rgb(237,23,23);">Deaktivert</span>
                                @else
                                    <span style="color: rgb(57,195,8);">Aktivert</span></p>
                                @endif


                        </div>
                    </div>
                    <form action="/twofactor" method="post">
                        @csrf
                        <p style="text-align: center;">
                            @if ($userdata->two_factor != 1)
                                <button class="btn btn-primary" type="submit" value="enable" name="twofactor" style="background: rgb(33,153,37);">Aktiver Nå</button>
                            @else
                                <button class="btn btn-primary" type="submit" value="disable" name="twofactor" style="margin-left: 5px;background: rgb(253,13,27);">Deaktiver Nå</button>
                            @endif


                        </p>
                    </form>
                </div>
            </div>
        </section>
    </main>
    <script src="{{ asset("assets/bootstrap/js/bootstrap.min.js") }}"></script>
</body>

</html>
