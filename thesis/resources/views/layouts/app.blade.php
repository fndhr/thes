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
            @if(!is_null($role ?? null))
                <a class="navbar-brand" href="/home">
                    <img src="/assets/image/user_navbar.png" width="30" height="30" class="d-inline-block align-top" alt="">
                    @if($role == 3)
                    {{$student->std_id}} - {{Auth::user()->username}}
                    @elseif($role == 2)
                    {{$lecturer->lec_id}} - {{Auth::user()->username}}
                    @else
                    Admin - {{Auth::user()->username}}
                    @endif
                </a>
                @if($role ==1)
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
                                <a class="dropdown-item" href="/admin/registerStudent">Student</a>
                                <a class="dropdown-item" href="/admin/registerLecturer">Lecturer</a>
                            </div>
                        </div>
                        <a class="nav-item nav-link" href="/admin/sessionSet">Set Session</a>
                        <a class="nav-item nav-link" href="/admin/studentSearch">Student Search</a>
                        <div class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Defense
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="/admin/setDefenseSchedule">Set Defense Schedule</a>
                                <a class="dropdown-item" href="/admin/getDefenseSchedule">Upcoming Defense Schedule</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                <div class="dropdown">
                    <a class="navbar-brand"><img src="/assets/image/admin_message.png" width="30" height="30" class="" alt=""></a>
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
