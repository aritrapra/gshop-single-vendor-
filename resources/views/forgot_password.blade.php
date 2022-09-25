
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Glemt Passord - MedisinHuset</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/img/store.png') }}">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    
    <link rel="stylesheet" href="assets/fonts/simple-line-icons.min.css">
    
    <link rel="stylesheet" href="assets/css/Steps-Progressbar.css">
    <link rel="stylesheet" href="assets/css/vanilla-zoom.min.css">
</head>

<body>
    <x-mynav></x-mynav>
    <main class="page registration-page">
        <section class="clean-block clean-form dark">
            <div class="container">
                <div class="block-heading" style="padding-top: 50px;">
                    <h2 class="text-info">Glemt Passord</h2>
                    <p></p>
                </div>
                <hr>
                <form action="/forgot_password" method="POST">
                    @csrf
                    <div class="mb-3">
                        @error('user')
                            <p style="letter-spacing: 0px;font-size: 12px;color: rgb(255,0,0);background: #e9ff00;padding: 6px;font-weight: bold;margin-top:5px;">{{ $message }}</p>
                        @enderror
                        <label class="form-label" for="password">Brukernavn</label>

                        <input name="user" class="form-control" type="text" id="password">
                    </div>
                    <div class="mb-3">

                        <label class="form-label" for="password">Memmonic</label>
                        <textarea name="key" class="form-control"></textarea>
                    </div>
                    <x-captcha></x-captcha>
                    <button class="btn btn-primary" type="submit">Tilbakestill Passord</button>
                </form>
            </div>
        </section>
    </main>
    <script src="{{ asset("assets/bootstrap/js/bootstrap.min.js") }}"></script>
</body>

</html>
