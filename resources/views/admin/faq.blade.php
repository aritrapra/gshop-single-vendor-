
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>FAQ - Admin</title>
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
                <img src="{{ asset('assets/img/faq.png') }}" style="width: 25px;margin-right: 15px;">FAQ Ledelse
            </p>
            <hr style="margin-top: 4px;">
            <div id="content">

                <div class="container-fluid">
                    <h1 class="text-dark mb-4" style="font-size:16px;margin-top:20px;"></h1>
					<hr>
                    <div class="card shadow" style="margin-bottom: 20px;">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 fw-bold">Legg til FAQ</p>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                <table class="table my-0" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th style="width: 35%;"></th>
                                            <th style="width: 45%;"></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <form action="/godisHusetmyadmin/faq/add" method="post">
                                            @csrf
                                            <tr>
                                                <td>
                                                    <label for="news">Faq</label>
                                                    <textarea name="faq"  style="width: 100%;height:80px;padding:5px;" required></textarea></td>
                                                <td>
                                                    <label for="details">Detaljer</label>
                                                    <textarea name="details"  style="width: 100%;height:100px;padding:5px;" required></textarea></td>
                                                <td>
                                                    <button class="btn btn-success btn-icon-split" role="button" style="margin-top:20px;">
                                                        <span class="text-white-50 icon">
                                                            <i class="far fa-plus-square"></i>
                                                        </span>
                                                        <span class="text-white text">Legg Faq</span>
                                                    </button>
                                                </td>
                                            </tr>
                                        </form>
                                    </tbody>
                                    <tfoot>
                                        <tr></tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 fw-bold">Slett FAQ type</p>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive table mt-2" id="dataTable-1" role="grid" aria-describedby="dataTable_info">
                                <table class="table my-0" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th style="width: 30%;">Tittler</th>
                                            <th style="width: 40%;">Detaljer</th>
                                            <th style="width: 30%;">Handling</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $ct)
                                        <tr>
                                            <td>{{ $ct->details }}</td>
                                            <td>
                                                {{ $ct->faq }}
                                            </td>
                                            <td>
                                                <a href="/godisHusetmyadmin/faq/remove/{{ $ct->id }}" class="btn btn-danger btn-icon-split" role="button"><span class="text-white-50 icon"><i class="fas fa-trash"></i></span><span class="text-white text">Slett</span></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr></tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
    <script src="{{ asset('adset/assets/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('adset/assets/js/Drag-and-Drop-Multiple-File-Form-Input-upload-Advanced.js') }}"></script>
    <script src="{{ asset('adset/assets/js/theme.js') }}"></script>
</body>

</html>
