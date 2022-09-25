
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
                        <div class="progress-bar" role="progressbar" aria-valuenow="60" style="width: 34%;background: rgb(13,80,253);"></div>
                    </div>
                </div>
            </div>
            <div class="table-responsive" style="margin: 20px 25px;">
                <form action="/godisHusetmyadmin/product/add2/{{ $id }}" method="POST">
                    @csrf
                    <table class="table">
                        <thead>
                            <tr></tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="width: 30%;">Available Produkt Varianter :</td>
                                <td>
                                    @if($veriants[0] != '')
                                        @php
                                            $i = -1;
                                        @endphp
                                        @foreach ($veriants as $vt)
                                            @php
                                                $i = $i + 1;
                                                $split = explode(',',$vt);
                                            @endphp
                                            <span style="background: #171db7;color: rgb(255,255,255);padding: 2px 10px;border-radius: 15px;margin: 5px;margin-right: 10px;display: inline-block;">{{ $split[0]." ".$unit }} for {{ $split[1] }}Kr
                                                <a href="/godisHusetmyadmin/product/remove1/{{ $id }}/{{ $i }}" style="margin-left: 10px;color: rgb(255,0,0);">
                                                    <i class="fa fa-trash"></i>\
                                                </a>
                                            </span>

                                        @endforeach
                                    @else
                                    <p style="text-align: center;color: rgb(255,19,19);border-width: 2px;border-style: dotted;margin: 10px;">Ingen varianter lagt til</p>
                                    @endif


                                </td>
                            </tr>
                            <tr>
                                <td>add Varianter :</td>
                                <td>
                                    <button type="submit" class="btn btn-primary pull-right">
                                        <i class="fa fa-plus" style="margin-right: 5px;"></i>
                                        Add
                                    </button>
                                    <input type="text" style="width: 200px;border-width: 2px;border-style: dotted;"  name="quantity" placeholder="i tall" >
                                    <span style="margin-left: 5px;">{{ $unit }}</span>
                                    &nbsp;at&nbsp;
                                    <input type="number" style="width: 200px;border-width: 2px;border-style: dotted;scroolbar:hidden;" placeholder="Price" name="price" placeholder="i tall">
                                    Kr

                                </td>
                            </tr>
                            <tr>
                                <td style="padding-top: 200px;">
                                    <a class="btn btn-success btn-icon-split" role="button" href="/godisHusetmyadmin/product/add1/{{ $id }}">
                                        <span class="text-white-50 icon">
                                            <i class="fas fa-plus"></i>
                                        </span>
                                        <span class="text-white text">Edit Info</span>
                                    </a>
                                </td>
                                <td style="text-align: right;padding-top: 200px;">
                                    <a class="btn btn-success btn-icon-split" href="/godisHusetmyadmin/product/add3/{{ $id }}" role="button">
                                        <span class="text-white-50 icon">
                                            <i class="fas fa-plus"></i>
                                        </span>
                                        <span class="text-white text">Add Images</span>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
    <style>
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
        }

        /* Firefox */
        input[type=number] {
        -moz-appearance: textfield;
        }
    </style>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/Drag-and-Drop-Multiple-File-Form-Input-upload-Advanced.js"></script>
    <script src="assets/js/Table-With-Search.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>
