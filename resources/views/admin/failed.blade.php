
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Failed Orders : Admin</title>
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
                <img src="{{ asset('assets/img/close.png') }}" style="width: 25px;margin-right: 15px;">Failed Orders
            </p>
            <hr style="margin-top: 4px;">
            <div class="table-responsive table table-hover table-bordered results" style="margin: 0px 20px;padding-right:30px;min-height:600px;">
                <table class="table table-hover table-bordered" style="border:1px solid black;">
                    <thead class="bill-header cs">
                        <tr style="background-color: rgb(59, 24, 94);">
                            <th id="trs-hd" class="col-lg-1" style="width: 25%;text-align: left;">Product name</th>
                            <th id="trs-hd" class="col-lg-2" style="width: 15%;text-align: left;">Order Value</th>
                            <th id="trs-hd" class="col-lg-2" style="width: 20%;text-align: left;">Address</th>
                            <th id="trs-hd" class="col-lg-3" style="width: 13%;text-align: left;">Customer Name</th>
                            <th id="trs-hd" class="col-lg-2" style="width: 12%;text-align: left;">Order On</th>
                            <th id="trs-hd" class="col-lg-2" style="width: 15%;text-align: left;">Cause</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            use App\Models\Product;
                            #$products = Product::orderBy('created_at','desc');
                        @endphp
                        @if ($order == null)
                            <tr class="warning no-result">
                                <td colspan="12"><i class="fa fa-warning"></i>&nbsp; No Result !!!</td>
                            </tr>
                        @else
                            @foreach ($order as $od)
                                @php
                                    $name = Product::where('id','=',$od->product_id)->first('name');
                                    if($name == null){
                                        $name = 'Product Deleted';
                                    }else{
                                        $name = $name->name;
                                    }
                                @endphp
                                <tr style="padding: 0px;">
                                    <td>{{ $name }}</td>
                                    <td>{{ $od->total_price }} NOK / {{ number_format($od->btc_price,8) }}</td>
                                    <td>{{ $od->address }}</td>
                                    <td>{{ $od->user }}</td>
                                    @php
                                        $start_date = new DateTime($od->created_at);
                                        $since_start = $start_date->diff(new DateTime(now()));
                                        if($since_start->days != 0){
                                            $time_string = $since_start->days.' dager siden';
                                        }elseif ($since_start->h != 0) {
                                            $time_string = $since_start->h.' timer siden';
                                        }else{
                                            $time_string = $since_start->i.' minutter siden';
                                        }
                                    @endphp
                                    <td>{{ $time_string }}</td>
                                    <td>
                                        @php
                                            if($od->placed == '0'){
                                                echo "Order Not Place";
                                            }else {
                                                echo "Payment Not Made";
                                            }
                                        @endphp
                                    </td>
                                </tr>
                            @endforeach
                        @endif


                    </tbody>
                </table>

            </div>
            <nav class="d-lg-flex justify-content-lg-end dataTables_paginate paging_simple_numbers">
                <ul class="pagination">
                    @if($nowpage >= 1)
                        <li class="page-item"><a class="page-link" href="/godisHusetmyadmin/failed/{{ $nowpage -1 }}" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
                    @endif
                    @for($i = 0; $i < $count; $i++)
                        <li class="page-item active"><a class="page-link" href="/godisHusetmyadmin/failed/{{ $i }}">{{ $i+1 }}</a></li>
                    @endfor


                    @if($nowpage <= $count-1)
                        <li class="page-item"><a class="page-link" href="/godisHusetmyadmin/failed/{{ $nowpage+1 }}" aria-label="Next"><span aria-hidden="true">»</span></a></li>
                    @endif
                </ul>
            </nav>
        </div>
    </div>
    <style>
        tr:nth-child(2n+1){
            background-color: rgba(113, 121, 194, 0.329);
        }
    </style>
    <script src="{{ asset('adset/assets/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('adset/assets/js/Drag-and-Drop-Multiple-File-Form-Input-upload-Advanced.js') }}"></script>
    <script src="{{ asset('adset/assets/js/theme.js') }}"></script>
</body>

</html>
