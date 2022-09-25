<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Kontakt oss - MedisinHuset</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/img/store.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/fonts/simple-line-icons.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/Steps-Progressbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vanilla-zoom.min.css') }}">
</head>

<body>
    <x-mynav></x-mynav>
    <main class="page contact-us-page">
        <section class="clean-block clean-form dark">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-info">Hjelpesenter</h2>
                    <p>Skriv dine spørsmål/problem her</p>
                </div>
                <form action="/createsupport" method="post">
                    @csrf
                    <div class="mb-3">
                        @error('submited')
                            <div class="alert alert-success">{{ $message }}</div>
                        @enderror
                        @error('name')
                        <p style="letter-spacing: 0px;font-size: 12px;color: rgb(255,0,0);background: #e9ff00;padding: 6px;font-weight: bold;margin-top:5px;">{{ $message }}</p>
                        @enderror
                        <label class="form-label" for="name">Brukernavn</label><input class="form-control" type="text" id="name" name="name" value="{{ $user }}" disabled></div>
                    <div class="mb-3">
                        @error('reason')
                        <p style="letter-spacing: 0px;font-size: 12px;color: rgb(255,0,0);background: #e9ff00;padding: 6px;font-weight: bold;margin-top:5px;">{{ $message }}</p>
                        @enderror
                        <label class="form-label" for="subject">Tittel</label><input class="form-control" type="text" id="subject" name="reason"></div>
                    <div class="mb-3">
                        @error('message')
                        <p style="letter-spacing: 0px;font-size: 12px;color: rgb(255,0,0);background: #e9ff00;padding: 6px;font-weight: bold;margin-top:5px;">{{ $message }}</p>
                        @enderror
                        <label class="form-label" for="message">Melding</label><textarea class="form-control" id="message" name="message"></textarea></div>
                    <div class="mb-3">
                        <button class="btn btn-primary" type="submit">Send</button></div>
                </form>
            </div>
        </section>
    </main>
    <script src="{{ asset("assets/bootstrap/js/bootstrap.min.js") }}"></script>
</body>

</html>
