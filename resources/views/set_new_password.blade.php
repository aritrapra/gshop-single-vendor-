
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Bytt passord - MedisinHuset</title>

    <link rel="icon" type="image/png" href="{{ asset('assets/img/store.png') }}">
    <link rel="stylesheet" href="a{{ asset("ssets/bootstrap/css/bootstrap.min.css") }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset("assets/fonts/font-awesome.min.css") }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome5-overrides.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/input.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/Navigation-Menu.css') }}">
</head>

<body id="page-top">
    <x-lognav></x-lognav>
    <div class="container" style="display: flex;justify-content: center;align-items: center;">
        <div class="text-center" style="width: 400px;margin-top: 100px;padding: 20px 0px;border-width: 1px;border-style: solid;border-radius: 5px;box-shadow: 2px 2px 5px 5px rgb(133, 135, 150);">
            <h4 class="text-center" style="color: rgb(0,0,0);font-family: Aclonica, sans-serif;">Bytt passord</h4>
            <hr>
            <form action="/set_password" method="POST" class="text-center" style="padding: 5px;font-size: 16px;letter-spacing: 5px;">
                @csrf
                <div>
                    @error('password')
                        <p style="letter-spacing: 0px;font-size: 12px;color: rgb(255,0,0);background: #e9ff00;padding: 6px;font-weight: bold;margin-top:5px;">{{ $message }}</p>
                    @enderror
                    <p style="font-size: 14px;font-weight: bold;letter-spacing: 3px;margin-bottom: 5px;">Nytt Passord</p>
                    <input name="password" class="form-control" type="text" style="width: 250px;margin-left: 75px;">
                </div>
                <div>
                    @error('password_confirmation')
                        <p style="letter-spacing: 0px;font-size: 12px;color: rgb(255,0,0);background: #e9ff00;padding: 6px;font-weight: bold;margin-top:5px;">{{ $message }}</p>
                    @enderror
                    <p style="font-size: 14px;font-weight: bold;letter-spacing: 3px;margin-bottom: 5px;">Bekreft Passord</p>
                    <input name="password_confirmation" class="form-control" type="text" style="width: 250px;margin-left: 75px;">
                </div>


                <button class="btn btn-primary" type="submit" style="margin: 10px;background: rgb(0,0,0);padding-right: 20px;padding-left: 20px;border-radius: 20px;">Bytt Passord</button>
            </form>
        </div>
    </div>
    <script src="{{ asset("assets/bootstrap/js/bootstrap.min.js") }}"></script>
</body>

</html>
