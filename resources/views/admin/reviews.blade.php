
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Reviews : Admin</title>
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
            <p style="color: rgb(19,14,242);padding: 10px 25px;font-size: 25px;line-height: 25px;letter-spacing: 8px;font-weight: bold;text-shadow: 1px 1px 0px rgb(101,99,53);margin-bottom: 0px;">
                <img src="{{ asset('assets/img/book.png') }}" style="width: 25px;margin-right: 15px;">All Reviews
            </p>
            <hr style="margin-top: 4px;">
            <div id="content">
                @foreach ($reviews as $rw)
                    <div class="row" style="margin: 10px 20px;border-width: 1px;border-style: solid;border-radius: 5px;box-shadow: 1px 1px 1px;">
                        <div class="col-2 text-center align-self-center">
                            <p style="margin: 0px;">{{ $rw->user }}</p>
                            @php
                                $start_date = new DateTime($rw->created_at);
                                $since_start = $start_date->diff(new DateTime(now()));
                                if($since_start->days != 0){
                                    $online_string = $since_start->days.' dager siden';
                                }elseif ($since_start->h != 0) {
                                    $online_string = $since_start->h.' timer siden';
                                }else{
                                    $online_string = $since_start->i.' minutter siden';
                                }
                            @endphp
                            <p style="margin: 0px;font-size: 12px;font-style: italic;">{{ $online_string }}</p>
                        </div>
                        <div class="col-8 align-self-center">
                            <p style="margin: 0px;">Rating :&nbsp;
                                @for ($i = 0; $i < 5; $i++)
                                    @if ($i < intval($rw->rating))
                                        <img src="{{ asset("assets/img/star.svg") }}" style="width: 14px;">
                                    @else
                                        <img src="{{ asset("assets/img/star-empty.svg") }}" style="width: 14px;">
                                    @endif
                                @endfor
                            </p>
                            <p style="margin: 0px;font-size: 14px;">{{ $rw->comment }}</p>
                        </div>
                        <div class="col text-center align-self-center">
                            <a class="btn btn-light btn-icon-split" role="button" href="/godisHusetmyadmin/removereview/{{ $rw->id }}">
                                <span class="text-black-50 icon">
                                    <i class="far fa-trash-alt"></i>
                                </span>
                                <span class="text-dark text" style="background: #ff000f;color: rgb(249,249,249);">Delete</span>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
    <script src="{{ asset('adset/assets/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('adset/assets/js/Drag-and-Drop-Multiple-File-Form-Input-upload-Advanced.js') }}"></script>
    <script src="{{ asset('adset/assets/js/theme.js') }}"></script>
</body>

</html>
