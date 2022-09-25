<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
    <a class="navbar-brand" href="#">
        <h2 style="color: rgb(255, 123, 0);">MedisinHuset</h2>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav mx-auto">
            <li class="nav-item">
                <a class="nav-link
                @if(Request::segment(1) == 'home')
                    active
                @endif
                " href="/home">
                Hjem</a>
            </li>
            <li class="nav-item">
                <a class="nav-link
                @if(Request::segment(1) == 'orders')
                    active
                @endif
                " href="/orders">Ordre</a>
            </li>
            <li class="nav-item">
                <a class="nav-link
                @if(Request::segment(1) == 'news')
                    active
                @endif
                " href="/news">Nyheter</a>
            </li>
            <li class="nav-item">
                <a class="nav-link
                @if(Request::segment(1) == 'faq')
                    active
                @endif
                " href="/faq">FAQ</a>
            </li>
            <!---
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    View More
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <li><a class="dropdown-item" href="#">Web Development</a></li>
                    <li><a class="dropdown-item" href="#">Web Designing</a></li>
                    <li><a class="dropdown-item" href="#">Android Development</a></li>
                </ul>
            </li>
            -->
            <li class="nav-item">
                <a class="nav-link
                @if(Request::segment(1) == 'supports')
                    active
                @endif
                " href="/supports">Support</a>
            </li>
            <li class="nav-item">
                <a class="nav-link
                @if(Request::segment(1) == 'pgp')
                    active
                @endif
                " href="/pgp">PGP</a>
            </li>
        </ul>
        <div class="d-flex">
            <div class="dropdown">
                <button class="dropbtn">Produkter</button>
                <div class="dropdown-content">
                    @foreach ($cats as $cat)
                        <li><a class="" href="/catagoriview/{{ $cat->cat }}">{{ $cat->cat }}</a></li>
                    @endforeach
                </div>
            </div>
            <style>
                .dropbtn {
                background-color: #ffffff;
                color: rgb(0, 0, 0);
                padding: 7px 20px;
                font-size: 16px;
                border: none;
                cursor: pointer;
                border-radius: 5px;
                }

                .dropdown {
                    position: relative;
                    display: inline-block;
                }

                .dropdown-content {
                    display: none;
                    position: absolute;
                    background-color: #f9f9f9;
                    min-width: 160px;
                    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
                    z-index: 1;
                    list-style: none;

                }

                .dropdown-content a {
                    color: black;
                    padding: 8px 16px;
                    text-decoration: none;
                    display: block;
                    white-space: nowrap;
                }

                .dropdown-content a:hover {background-color: #f1f1f1}

                .dropdown:hover .dropdown-content {
                    display: block;
                }

                .dropdown:hover .dropbtn {
                background-color: #000000;
                color: #fff;
                }
            </style>
            @if($user == "Not_Set")
                <a class="btn btn-light ms-3" style="padding: 7px 20px;" href="/login">Logg inn</a>
                <a class="btn btn-light ms-3" style="padding: 7px 20px;" href="/register">Registrer</a>
            @else
                <a class="btn btn-light ms-3" style="padding: 7px 20px;" href="/profile">{{ $user }}</a>
                <a class="btn btn-light ms-3" style="padding: 7px 20px;" href="/logout">Logg ut</a>
            @endif

        </div>
    </div>
    </div>
</nav>
