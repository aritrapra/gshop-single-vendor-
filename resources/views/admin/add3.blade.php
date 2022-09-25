
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Add Product - Admin</title>
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
        <div style="width: 100%;">
            <p style="color: rgb(19,14,242);padding: 10px 25px;font-size: 25px;line-height: 25px;letter-spacing: 2px;font-weight: bold;text-shadow: 1px 1px 0px rgb(101,99,53);margin-bottom: 0px;">
                <img src="{{ asset('assets/img/add2.png') }}" style="width: 25px;margin-right: 15px;">Create Ad
            </p>
            <hr style="margin-top: 4px;">
            <div class="row">
                <div class="col-3 text-center align-self-center"><img src="{{ asset("assets/img/information.png") }}" style="width: 30px;">
                    <p>Info</p>
                </div>
                <div class="col-3 text-center align-self-center"><img src="{{ asset("assets/img/best-price.png") }}" style="width: 30px;">
                    <p>Price</p>
                </div>
                <div class="col-3 text-center align-self-center"><img src="{{ asset('assets/img/image-gallery(1).png') }}" style="width: 30px;">
                    <p>Images</p>
                </div>
                <div class="col-3 text-center align-self-center"><img src="{{ asset('assets/img/checkmark.png') }}" style="width: 30px;">
                    <p>Done</p>
                </div>
                <div class="col">
                    <div class="progress" style="height: 4px;margin-top: 10px;margin-right: 11.5%;margin-left: 11.5%;background: rgb(213,248,0);">
                        <div class="progress-bar" role="progressbar" aria-valuenow="60" style="width: 67%;background: rgb(13,80,253);"></div>
                    </div>
                </div>
            </div>
            <div class="table-responsive" style="margin: 20px 25px;">
                <form method="post" action="/godisHusetmyadmin/product/add3/{{ $id }}" enctype="multipart/form-data">
                    @csrf
                    <table class="table">
                        <thead>
                            <tr></tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="width: 30%;">Available Product Images :</td>
                                <td>



                                    <div class="container">
                                        <div class="row">
                                            @if($imgs[0] != '')
                                            @php
                                                $i = 0;
                                            @endphp
                                                @foreach ($imgs as $img)
                                                    <div class="col-md-4" style="text-align: center;border-width: 2px;border-style: dotted;">
                                                        <img src="{{ asset('/assets/productimg/'.$img) }}" style="margin-top: 10px;width: 150px;height: 150px;">
                                                        <p style="margin-bottom: 5px;">
                                                            <a href="/godisHusetmyadmin/product/remove2/{{ $id }}/{{ $i }}">
                                                                <i class="fa fa-trash" style="border-width: 2px;border-style: dotted;padding: 2px 10px;margin-top: 5px;"></i>
                                                            </a>
                                                        </p>
                                                    </div>

                                                    @php
                                                        $i = $i + 1;
                                                    @endphp

                                                @endforeach
                                            @else
                                            <p style="text-align: center;color: rgb(255,19,19);border-width: 2px;border-style: dotted;margin: 10px;">No Image Available</p>
                                            @endif

                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Add new image :</td>
                                <td>
                                    @error('images')
                                        <p style="letter-spacing: 0px;font-size: 12px;color: rgb(255,0,0);background: #e9ff00;padding: 6px;font-weight: bold;margin-top:5px;">{{ $message }}</p>
                                    @enderror
                                    <input type="file" name="images">
                                    <button class="btn btn-primary pull-right" type="submit" value="upload" name="submit">
                                        <i class="fa fa-arrow-up" style="margin-right: 5px;"></i>
                                        &nbsp;upload
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-top: 200px;">
                                    <button class="btn btn-success btn-icon-split" role="button" type="submit" value="back" name="submit">
                                        <span class="text-white-50 icon">
                                            <i class="fas fa-arrow-left"></i>
                                        </span>
                                        <span class="text-white text">Edit Price Info</span>
                                    </button>
                                </td>
                                <td style="text-align: right;padding-top: 200px;">
                                    @if($imgs[0] != '')
                                        <a class="btn btn-success btn-icon-split" role="button" href="/godisHusetmyadmin/product/finish/{{ $id }}">
                                            <span class="text-white-50 icon">
                                                <i class="fas fa-plus"></i>
                                            </span>
                                            <span class="text-white text">Post Ad</span>
                                        </a>
                                    @endif

                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/Drag-and-Drop-Multiple-File-Form-Input-upload-Advanced.js"></script>
    <script src="assets/js/Table-With-Search.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>
