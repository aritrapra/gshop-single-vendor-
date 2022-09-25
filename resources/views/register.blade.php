
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Registrering - MedisinHuset</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/img/store.png') }}">
    <link rel="stylesheet" href="{{ asset("assets/bootstrap/css/bootstrap.min.css") }}">
    
    <link rel="stylesheet" href="{{ asset("assets/fonts/simple-line-icons.min.css") }}">
   
    <link rel="stylesheet" href="{{ asset("assets/css/Steps-Progressbar.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/css/vanilla-zoom.min.css") }}">
</head>

<body>
    <x-mynav></x-mynav>
    <main class="page registration-page">
        <section class="clean-block clean-form dark">
            <div class="container">
                <div class="block-heading" style="padding-top: 50px;">
                    <h2 class="text-info">Registrering</h2>
                    <p></p>
                </div>
                <hr>
                <form action="/register" method="POST">
                    @csrf
                    <div class="mb-3">
                        @error('name')
                            <p style="letter-spacing: 0px;font-size: 12px;color: rgb(255,0,0);background: #e9ff00;padding: 6px;font-weight: bold;margin-top:5px;">{{ $message }}</p>
                        @enderror
                        <label class="form-label" for="name">Brukernavn</label>
                        <input name="name" class="form-control item" type="text" id="name">
                    </div>
                    <div class="mb-3">
                        @error('password')
                            <p style="letter-spacing: 0px;font-size: 12px;color: rgb(255,0,0);background: #e9ff00;padding: 6px;font-weight: bold;margin-top:5px;">{{ $message }}</p>
                        @enderror
                        <label class="form-label" for="password">Passord</label>
                        <input name="password" class="form-control item" type="password" id="password">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="email">Bekreft Passord</label>
                        <input name="password_confirmation" class="form-control item" type="text" >
                    </div>
                    <x-captcha></x-captcha>
                    <button class="btn btn-primary" type="submit">Registrer Nå</button>
                </form>
            </div>
        </section>
    </main>
    <script src="{{ asset("assets/bootstrap/js/bootstrap.min.js") }}"></script>
</body>

</html>
