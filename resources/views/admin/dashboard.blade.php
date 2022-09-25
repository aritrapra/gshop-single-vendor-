<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Dashboard : Admin</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/img/support.png') }}">
    <link rel="stylesheet" href="{{ asset('adset/assets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="{{ asset('adset/assets/fonts/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset("adset/assets/fonts/font-awesome.min.css") }}">
    <link rel="stylesheet" href="{{ asset('adset/assets/fonts/fontawesome5-overrides.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adset/assets/css/Drag--Drop-Upload-Form.css') }}">
    <link rel="stylesheet" href="{{ asset('adset/assets/css/Drag-and-Drop-Multiple-File-Form-Input-upload-Advanced.css') }}">
    <link rel="stylesheet" href="{{ asset('adset/assets/css/Responsive-Form-1.css') }}">
    <link rel="stylesheet" href="{{ asset('adset/assets/css/Responsive-Form.css') }}">
</head>

<body id="page-top">
    <div id="wrapper">
        <x-lognav></x-lognav>
        <div class="d-flex flex-column" id="content-wrapper">
            <p style="color: rgb(19,14,242);padding: 10px 25px;font-size: 25px;line-height: 25px;letter-spacing: 2px;font-weight: bold;text-shadow: 1px 1px 0px rgb(101,99,53);margin-bottom: 0px;">
                <img src="{{ asset('assets/img/dashboard.png') }}" style="width: 25px;margin-right: 15px;">Admin Dashboard
            </p>
            <hr style="margin-top: 4px;">
            <div id="content">

                <div class="container-fluid">
                    <h3 class="text-dark mb-4"></h3>
                </div>
                <div class="row" style="margin: 0px 20px;">
                    <div class="col-3 align-self-center" style="padding: 5px;">
                        <div class="text-center" style="background: #eb0505;box-shadow: 1px 1px rgb(0,0,0);border-radius: 5px;padding: 5px;">
                            <p style="color: rgb(255,255,255);margin: 0px;">Ventende Ordre</p>
                            <p style="margin: 0px;color: rgb(255,255,255);font-size: 20px;">3</p>
                        </div>
                    </div>
                    <div class="col-3 align-self-center" style="padding: 5px;">
                        <div class="text-center" style="background: #ebb805;box-shadow: 1px 1px rgb(0,0,0);border-radius: 5px;padding: 5px;">
                            <p style="color: rgb(255,255,255);margin: 0px;">Sendte Ordre</p>
                            <p style="margin: 0px;color: rgb(255,255,255);font-size: 20px;">3</p>
                        </div>
                    </div>
                    <div class="col-3 align-self-center" style="padding: 5px;">
                        <div class="text-center" style="background: #5b962d;box-shadow: 1px 1px rgb(0,0,0);border-radius: 5px;padding: 5px;">
                            <p style="color: rgb(255,255,255);margin: 0px;">Antall Sendte</p>
                            <p style="margin: 0px;color: rgb(255,255,255);font-size: 20px;">3</p>
                        </div>
                    </div>
                    <div class="col-3 align-self-center" style="padding: 5px;">
                        <div class="text-center" style="background: #eb0505;box-shadow: 1px 1px rgb(0,0,0);border-radius: 5px;padding: 5px;">
                            <p style="color: rgb(255,255,255);margin: 0px;">Antall Brukere</p>
                            <p style="margin: 0px;color: rgb(255,255,255);font-size: 20px;">3</p>
                        </div>
                    </div>
                </div>
                <p style="margin-left: 25px;color: rgb(0,0,0);margin-top: 30px;">Addresse som mottar transaksjonene automatiskt</p>
                <form action="/godisHusetmyadmin/updateadd" method="POST">
                    @csrf
                    <p style="margin-left: 25px;">{{ $add }}</p>
                    <p style="margin-left: 25px;color: rgb(0,0,0);">Oppdater ny addresse</p>
                    <p style="margin-left: 25px;color: rgb(0,0,0);">
                        <input type="text" name="add" style="width: 500px;">
                    </p>
                    <button class="btn btn-primary" type="submit" style="margin-left: 25px;">Oppdater addresse</button>
                </form>
            </div>
        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
    <script src="{{ asset('adset/assets/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('adset/assets/js/Drag-and-Drop-Multiple-File-Form-Input-upload-Advanced.js') }}"></script>
    <script src="{{ asset('adset/assets/js/theme.js') }}"></script>
</body>

</html>
