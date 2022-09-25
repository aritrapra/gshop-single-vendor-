
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Produkter : Admin</title>
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
                <img src="{{ asset('assets/img/products.png') }}" style="width: 25px;margin-right: 15px;">Produkter
            </p>
            <hr style="margin-top: 4px;">
            <div id="content">
                @php
                    use App\Models\Review;
                @endphp
                <div class="container-fluid">
                    <h3 class="text-dark mb-4">Produkter</h3>
                    <div class="card shadow" style="margin-bottom: 20px;">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 fw-bold">Alle tilgjengelig produkter</p>
                        </div>
                        <div class="card-body" style="min-height: 450px;">
                            <div class="row">
                                <div class="col-md-6 col-xl-12">
                                    <div class="text-md-end dataTables_filter" id="dataTable_filter"><label class="form-label"><input type="search" class="form-control form-control-sm" aria-controls="dataTable" placeholder="Søk"></label><a class="btn btn-light btn-icon-split" role="button" style="margin-left: 25px;"><span class="text-black-50 icon"><i class="fas fa-arrow-right"></i></span><span class="text-dark text">Søk</span></a></div>
                                </div>
                            </div>
                            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info" >
                                <table class="table my-0" id="dataTable" >
                                    <thead>
                                        <tr>
                                            <th class="col-4">Navn</th>
                                            <th class="col-1">Kategori</th>
                                            <th class="col-1">Status</th>
                                            <th class="col-2">Publisert</th>
                                            <th class="col-4">Handling</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($product as $pt)
                                            <tr>
                                                <td>{{ $pt->name }}</td>
                                                <td>{{ $pt->catagori }}</td>
                                                <td>
                                                    @if($pt->active == '1')
                                                        active
                                                    @else
                                                        inactive
                                                    @endif
                                                </td>
                                                <td>{{ $pt->created_at }}</td>
                                                <td>
                                                    <a href="/godisHusetmyadmin/product/add1/{{ $pt->id }}" class="btn btn-light btn-icon-split" role="button" style="width:40px;height:40px;font-size:20px;">
                                                        <span class="text-black-50 icon"><i class="fas fa-edit"></i></span>
                                                    </a>
                                                    <a href="/godisHusetmyadmin/product/clone/{{ $pt->id }}" class="btn btn-light btn-icon-split" role="button" style="width:40px;height:40px;font-size:20px;">
                                                        <span class="text-black-50 icon"><i class="fas fa-copy"></i></span>
                                                    </a>
                                                    <a href="/godisHusetmyadmin/product/pause/{{ $pt->id }}" class="btn btn-light btn-icon-split" role="button" style="width:40px;height:40px;font-size:20px;">
                                                        <span class="text-black-50 icon">
                                                            @if ($pt->active == '1')
                                                                <i class="fas fa-pause"></i>
                                                            @else
                                                                <i class="fas fa-play"></i>
                                                            @endif
                                                        </span>
                                                    </a>
                                                    <a href="/godisHusetmyadmin/product/delete/{{ $pt->id }}/
                                                        @if($id !== null)
                                                            {{ $id }}
                                                        @else
                                                            0
                                                        @endif
                                                        " class="btn btn-light btn-icon-split" role="button" style="width:40px;height:40px;font-size:20px;">
                                                        <span class="text-black-50 icon"><i class="fas fa-trash"></i></span>

                                                    </a>
                                                    @php
                                                        $c = Review::where('product_id','=',$pt->id)->count();
                                                    @endphp
                                                    <a href="/godisHusetmyadmin/reviews/{{ $pt->id }}" class="btn btn-light btn-icon-split" role="button" style="">
                                                        <span class="text-black-50 icon">
                                                            <img src="{{ asset('assets/img/book.png') }}" alt="" style="width: 20px;">
                                                        </span>
                                                        <span class="text-light text" style="background: #81d125;color: rgb(249,249,249);">{{ $c }} Reviews</span>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach


                                    </tfoot>
                                </table>
                            </div>

                        </div>

                    </div>
                    <div class="row" >
                        <div class="col-md-6 align-self-center" >
                            <p id="dataTable_info" class="dataTables_info" role="status" aria-live="polite">Viser {{ $showing }} av {{ $total }}</p>
                        </div>
                        <div class="col-md-6">
                            <nav class="d-lg-flex justify-content-lg-end dataTables_paginate paging_simple_numbers">
                                <ul class="pagination" >
                                    @if($id >= 1)
                                        <li class="page-item"><a class="page-link" href="/godisHusetmyadmin/products/{{ $id -1 }}" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
                                    @endif
                                    @for($i = 0; $i <= $count; $i++)
                                        <li class="page-item active"><a class="page-link" href="/godisHusetmyadmin/products/{{ $i }}">{{ $i+1 }}</a></li>
                                    @endfor


                                    @if($id < $count)
                                        <li class="page-item"><a class="page-link" href="/godisHusetmyadmin/products/{{ $id+1 }}" aria-label="Next"><span aria-hidden="true">»</span></a></li>
                                    @endif
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('adset/assets/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('adset/assets/js/Drag-and-Drop-Multiple-File-Form-Input-upload-Advanced.js') }}"></script>
    <script src="{{ asset('adset/assets/js/theme.js') }}"></script>
</body>

</html>
