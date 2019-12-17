<!doctype html>
<html lang="en">

<head>
    <title>President University</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="/assets/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="/assets/css/jquery-ui.css">
    <link rel="stylesheet" href="/assets/css/aos.css">
    <link rel="stylesheet" href="/assets/css/main.css">
    <link rel="stylesheet" href="/assets/css/style.css">
</head>

<body>
    @auth
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            @if($role == 3)
                <a class="navbar-brand" href="">
                    <img src="https://cdn0.iconfinder.com/data/icons/elasto-online-store/26/00-ELASTOFONT-STORE-READY_user-circle-512.png" width="30" height="30" class="d-inline-block align-top" alt="">
                    {{$student->std_id}} - {{Auth::user()->username}}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <div class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Registration
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="#">Student</a>
                                <a class="dropdown-item" href="#">Lecturer</a>
                            </div>
                        </div>
                        <a class="nav-item nav-link" href="#">Set Session</a>
                        <div class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Student
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="#">Search Student</a>
                                <a class="dropdown-item" href="#">Title and Advisor Proposal</a>
                            </div>
                        </div>
                        <div class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Defense
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="#">Set Defense Schedule</a>
                                <a class="dropdown-item" href="#">Upcoming Defense Schedule</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="dropdown">
                    <a class="navbar-brand"><img src="https://cdn4.iconfinder.com/data/icons/integral/128/message-512.png" width="30" height="30" class="d-inline-block align-top" alt=""></a>
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Hi, {{Auth::user()->username}}
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#">Account Profile</a>
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                    </div>
                </div>
            @endif
        </nav>
    @endauth
    @yield('content')
    <script src="/assets/js/jquery-3.4.1.slim.min.js"></script>
    <script src="/assets/js/jquery-1.12.4.js"></script>
    <script src="/assets/js/popper.min.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>
    <script src="/assets/js/jquery-ui.min.js"></script>
    <script src="/assets/js/aos.js"></script>
    <script src="/assets/js/main.js"></script>
    <script src="/assets/js/index.js"></script>
</body>

</html>
