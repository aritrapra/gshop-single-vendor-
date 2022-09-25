
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Logg inn - MedisinHuset</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/img/store.png') }}">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    
    <link rel="stylesheet" href="assets/fonts/simple-line-icons.min.css">
    
    <link rel="stylesheet" href="assets/css/Steps-Progressbar.css">
    <link rel="stylesheet" href="assets/css/vanilla-zoom.min.css">
</head>

<body>
    <x-mynav></x-mynav>
    <main class="page login-page">
        <section class="clean-block clean-form dark">
            <div class="container">
                <div class="block-heading" style="padding-top: 50px;">
                    <h2 class="text-info">Logg Inn</h2>
                    <p>Logg inn for å se brukerkonto</p>
                    <hr>
                </div>
                <form action="/login" method="POST">
                    @csrf
                    @error('User_registered')
                        <div class="alert alert-success">{{ $message }}</div>
                    @enderror
                    <div class="mb-3">
                        @error('Username')
                            <p style="letter-spacing: 0px;font-size: 12px;color: rgb(255,0,0);background: #e9ff00;padding: 6px;font-weight: bold;margin-top:5px;">{{ $message }}</p>
                        @enderror
                        <label class="form-label" for="email">Brukernavn</label>
                        <input name="Username" class="form-control item" type="text" id="email">
                    </div>
                    <div class="mb-3">
                        @error('password')
                            <p style="letter-spacing: 0px;font-size: 12px;color: rgb(255,0,0);background: #e9ff00;padding: 6px;font-weight: bold;margin-top:5px;">{{ $message }}</p>
                        @enderror
                        <label class="form-label" for="password">Passord</label>
                        <input name="password" class="form-control" type="password" id="password">
                    </div>
                    <x-captcha></x-captcha>
                    <button class="btn btn-primary" type="submit">Logg Inn</button>
                    <br>
                    <a style="padding-top:10px;text-decoration:none;" href="/forgot_password">Glemt passord?</a>
                </form>
            </div>
        </section>
    </main>
    <script src="{{ asset("assets/bootstrap/js/bootstrap.min.js") }}"></script>

</body>

</html>
