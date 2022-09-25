
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Logg inn - Admin</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/img/support.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset("assets/fonts/fontawesome-all.min.css") }}">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="assets/css/Drag--Drop-Upload-Form.css">
    <link rel="stylesheet" href="assets/css/Drag-and-Drop-Multiple-File-Form-Input-upload-Advanced.css">
    <link rel="stylesheet" href="assets/css/Responsive-Form-1.css">
    <link rel="stylesheet" href="assets/css/Responsive-Form.css">
</head>

<body class="bg-gradient-primary" style="background-color: #4e73df;">
    <div class="container">
        <div class="row justify-content-center">
            <p style="text-align: center;font-size: 50px;color: rgb(255,245,0);margin-top: 50px;text-shadow: 2px 2px 3px rgb(0,0,0);">MedicinhusetExpress</p>
            <div class="col-md-9 col-lg-12 col-xl-10">
                <div class="card shadow-lg o-hidden border-0 my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-6 text-center align-self-center">
                                <p style="font-size: 45px;color: rgb(30,49,195);margin-bottom: -14px;text-shadow: 1px 1px rgb(255,245,0);">Admin</p>
                                <p style="font-size: 24px;color: rgb(0,163,255);text-shadow: 1px 1px rgb(0,10,255);margin-bottom: -5px;">Control Panel</p>

                            </div>
                            <div class="col-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h4 class="text-dark mb-4">Admin Log in</h4>
                                        <hr style="margin-top: -10px;margin-bottom: 40px;height: 1px;color: rgb(14,14,14);" />
                                    </div>
                                    <form class="user" action="adminlogin" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            @error('adname')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                            <input name="adname" class="form-control form-control-user" type="text" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Brukernavn">
                                        </div>
                                        <div class="mb-3">
                                            <input class="form-control form-control-user" type="password" id="exampleInputPassword" placeholder="Passord" name="password">
                                        </div>
                                        <button class="btn btn-primary d-block btn-user w-100" type="submit">Logg inn</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <p style="text-align: center;margin-bottom: 0px;"><i class="fa fa-star" style="color: rgb(219,255,0);"></i><i class="fa fa-star" style="color: rgb(219,255,0);"></i><i class="fa fa-star" style="color: rgb(219,255,0);"></i><i class="fa fa-star" style="color: rgb(219,255,0);"></i><i class="fa fa-star" style="color: rgb(219,255,0);"></i></p>
            <hr style="color: rgb(250,255,0);height: 1px;opacity: 1;margin-top: -8px;" />
        </div>
    </div>
    <script src="{{ asset('adset/assets/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('adset/assets/js/Drag-and-Drop-Multiple-File-Form-Input-upload-Advanced.js') }}"></script>
    <script src="{{ asset('adset/assets/js/theme.js') }}"></script>
</body>

</html>
