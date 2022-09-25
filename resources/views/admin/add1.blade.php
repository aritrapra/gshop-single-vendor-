
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
                        <div class="progress-bar" role="progressbar" aria-valuenow="60" style="width: 1%;background: rgb(13,80,253);"></div>
                    </div>
                </div>
            </div>
            <div class="table-responsive" style="margin: 20px 25px;">
                <form action="/godisHusetmyadmin/product/add1/{{ $id }}" method="POST">
                    @csrf
                    <table class="table">
                        <thead>
                            <tr></tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="width: 30%;">Produkt Navn :</td>
                                <td>
                                    @error('name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <input name="name" value="{{ $name }}" type="text" style="width: 500px;border-width: 2px;border-style: dotted;">
                                </td>
                            </tr>
                            <tr>
                                <td>Produkt Informasjon :</td>
                                <td>
                                    @error('details')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <textarea name="details" style="width: 500px;border-width: 2px;border-style: dotted;height: 300px;">{{ $details }}</textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>Produkt Kategori :</td>
                                <td>
                                    <select style="width: 500px;border-width: 2px;border-style: dotted;" name="catagories">
                                        <optgroup label="Velg Kategori">
                                            @foreach ($cats as $cat)
                                                <option value="{{ $cat->cat }}"
                                                    @if($cat->cat == $catagori)
                                                        selected=""
                                                    @endif
                                                    >{{ $cat->cat }}
                                                </option>
                                            @endforeach
                                        </optgroup>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Produkt Enhet :</td>
                                <td>
                                    @error('unit')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <input name="unit" placeholder="g" value="{{ $unit }}" type="text" style="width: 200px;">
                                </td>
                            </tr>
                            <tr>
                                <td>Delivary Time :</td>
                                <td>
                                    @error('delivary')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <input type="text" name="delivary" placeholder="eks: 2-4" value="{{ $delivary }}" style="width: 200px;"></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td style="text-align: right;">
                                    <button class="btn btn-success btn-icon-split" role="button" type="submit">
                                        <span class="text-white-50 icon">
                                            <i class="fas fa-plus"></i>
                                        </span>
                                        <span class="text-white text">Legg til prisinfo</span>
                                    </button>
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
