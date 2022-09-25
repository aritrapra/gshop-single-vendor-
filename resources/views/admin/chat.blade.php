<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>chatte med selger - Medicinhuset</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/img/store.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,700,700i,600,600i">
    <link rel="stylesheet" href="{{ asset('assets/fonts/simple-line-icons.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/Steps-Progressbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vanilla-zoom.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adset/assets/fonts/fontawesome-all.min.css') }}">
</head>

<body style="overflow: hidden;">
    <div class="row" style="margin-top: 0px;">
        <div class="col">
            <p style="padding: 10px 20px;margin-bottom: 0px;">Order Chat</p>
            <hr>
            <div style="height: calc(100vh - 145px);overflow-y: scroll;scroll-behavior: revert;scrollbar-width: none;display:flex;flex-direction: column-reverse;">
                @foreach ($data as $ct)
                    @php
                        $start_date = new DateTime($ct->created_at);
                        $since_start = $start_date->diff(new DateTime(now()));
                        if($since_start->days != 0){
                            $online_string = $since_start->days.' dager siden';
                        }elseif ($since_start->h != 0) {
                            $online_string = $since_start->h.' timer siden';
                        }else{
                            $online_string = $since_start->i.' minutter siden';
                        }
                    @endphp
                    @if ($ct->user == 'admin')
                        <div style="text-align: right;">
                            <div style="padding: 10px;background: #b8ccd2;display: inline-block;color: rgb(0,0,0);margin: 10px 20px;border-top-left-radius: 0px;border-top-right-radius: 15px;border-bottom-right-radius: 15px;border-bottom-left-radius: 15px;box-shadow: 2px 2px rgb(167,167,167);font-style:italic;font-size:14px;">
                                <p style="margin-bottom: 0px;font-size: 12px;">
                                    <span style="color: rgb(217,19,19);margin-right: 10px;">admin</span>

                                    {{ $online_string }}
                                </p>
                                <span class="msg">
                                    {{ $ct->message }}
                                </span>
                            </div>
                        </div>

                    @else
                        <div>
                            <div style="padding: 10px;background: #bad2b8;display: inline-block;color: rgb(0,0,0);margin: 10px 20px;border-top-left-radius: 15px;border-top-right-radius: 0px;border-bottom-right-radius: 15px;border-bottom-left-radius: 15px;box-shadow: 2px 2px rgb(167,167,167);">
                                <p style="margin-bottom: 0px;font-size: 12px;">
                                    <span style="color: rgb(82, 30, 223);margin-right: 10px;">{{ $ct->user }}</span>
                                    {{ $online_string }}
                                </p>
                                <span class="msg">
                                    {{ $ct->message }}
                                </span>
                            </div>
                        </div>
                    @endif
                @endforeach
<style>
    .msg{
        font-size: 14px;
    }
</style>


            </div>
            <div style="background-color:white;">
                <form action="/godisHusetmyadmin/postmsg/{{ $id }}" method="post">
                    @csrf
                    <input type="text" name="message" style="width: 88%;height: 50px;margin-left:1%;">
                    <button class="btn btn-primary" type="submit" style="width: 8%;margin: 1%;">Send</button>
                </form>
            </div>
        </div>
    </div>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.js"></script>
    <script src="assets/js/vanilla-zoom.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>
