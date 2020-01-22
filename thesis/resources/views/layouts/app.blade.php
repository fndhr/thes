<!doctype html>
<html lang="en">

<head>
    <title>President University</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
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
            {{$student->std_id}} - {{Auth::user()->first_name}} {{Auth::user()->last_name}}
            @elseif($role == 2)
            {{$lecturer->lec_id}} - {{Auth::user()->first_name}} {{Auth::user()->last_name}}
            @else
            Admin - {{Auth::user()->first_name}} {{Auth::user()->last_name}}
            @endif
        </a>
        @if($role == 1)
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Registration
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="/admin/registerStudent">Student</a>
                        <a class="dropdown-item" href="/admin/registerLecturer">Lecturer</a>
                    </div>
                </div>
                <a class="nav-item nav-link" href="/admin/sessionSet">Set Session</a>
                <a class="nav-item nav-link" href="/admin/studentSearch">Student Search</a>
                <a class="nav-item nav-link" href="/admin/getDefenseSchedule">Upcoming Defense Schedule</a>
                <a class="nav-item nav-link" href="/admin/scoringSheet">Scoring Sheet</a>
                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Import
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <form method='post' action='/home' enctype='multipart/form-data' >
                        {{ csrf_field() }}
                            <input type="file" class="dropdown-item" name = "file">Import User Student</a>
                            <input type='submit' name='submit' value='Import'>
                        </form>
                        <form method='post' action='/home' enctype='multipart/form-data' >
                        {{ csrf_field() }}
                            <input type="file" class="dropdown-item" name = "file">Import User Lecturer</a>
                            <input type='submit' name='submit' value='Import'>
                        </form>
                    </div>
                </div>
                <a class="nav-item nav-link" href="">Report</a>
            </div>
        </div>
        @elseif($role == 2)
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-item nav-link" href="/lecturer/studentSearch">Student Search</a>
                <a class="nav-item nav-link" href="/lecturer/defenseScheduleSearch">Upcoming Defense Schedule</a>
                <a class="nav-item nav-link" href="">Report</a>
            </div>
        </div>
        @else
        <div class="navbar-collapse"></div>
        @endif
        <div class="dropdown">
            <a class="navbar-brand messages" data-toggle="modal" data-target="#modalNotification"><img src="/assets/image/admin_message.png" width="30" height="30" alt=""></a>
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Hi, {{Auth::user()->first_name}}
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item showAccount" href="" data-toggle="modal" data-target="#AccountModal">Account Profile</a>
                <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
            </div>
        </div>
        @endif
    </nav>

    <div class="modal fade" id="AccountModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Account</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/homeChangePass" method="POST" class="submitForm">
                        {{ csrf_field() }}
                        <div class="row py-2">
                            @if(!is_null($role ?? null))
                            <div class="col-4">Student ID</div>
                            <div class="col-1 col-form-label">:&nbsp;&nbsp;</div>
                            <div class="col-7">
                                @if($role == 3)
                                {{$student->std_id}}
                                @elseif($role == 2)
                                {{$lecturer->lec_id}}
                                @else
                                Admin
                                @endif
                            </div>
                            @endif
                        </div>
                        <div class="row py-2">
                            <label class="col-4 col-form-label">Phone</label>
                            <label class="col-1 col-form-label">:&nbsp;&nbsp;</label>
                            <div class="col-6">
                                <input type="text" class="form-control @error('phone') is-invalid @enderror inputPhone" for="phone" name="phone" value="{{Auth::user()->phone ?? '-'}}" disabled>
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row py-2">
                            <div class="col-4">Email</div>
                            <div class="col-1 col-form-label">:&nbsp;&nbsp;</div>
                            <div class="col-7">{{Auth::user()->email}}</div>
                        </div>
                        <div class="form-group row inputPass">
                            <label class="col-4 col-form-label">New Password</label>
                            <label class="col-1 col-form-label">:&nbsp;&nbsp;</label>
                            <div class="col-6">
                                <input id="pass" type="password" class="form-control" for="new_password" name="new_password"
                                    placeholder="" value="{{old('new_password')}}">
                                <span id="passValidator" role="alert" style="display:none; color:red;">
                                    <strong>Password must be 8 character at least!</strong>
                                </span>
                            </div>
                        </div>
                        <div class="form-group row inputRePass">
                            <label class="col-4 col-form-label">Re-enter Password</label>
                            <label class="col-1 col-form-label">:&nbsp;&nbsp;</label>
                            <div class="col-6">
                                <input id ="repass" type="password" class="form-control" for="reenter_password" name="reenter_password"
                                    placeholder="" value="{{old('reenter_password')}}">
                                <span id="notif" style="color:red; display:none;"><strong>Password Isn't Match!</strong></span>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button id="btnEdit" type="button" class="btn btn-primary">Edit</button>
                            <button id="btnSubmit" type="submit" class="btn btn-success">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalNotification" tabindex="-1" role="dialog" aria-labelledby="modalNotificationTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalNotificationTitle">Notifications</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="padding: 0 !important;">
                    <div class="list-group">
                        @if(count(Auth::user()->notifications) > 0)
                            @for($c=count(Auth::user()->notifications)-1;$c>=0 ;$c--)
                            @php($notif = Auth::user()->notifications[$c])
                            <div class="list-group-item list-group-item-action">
                                <p class="mb-1 font-weight-bold">{{$notif->message}}</p>
                                <small>
                                @if((int)date_diff(date_create(),date_create($notif->created_at))->format("%d") == 0)
                                    Today
                                @elseif((int)date_diff(date_create(),date_create($notif->created_at))->format("%d") == 1)
                                    Yesterday
                                @else
                                    {{date_diff(date_create(),date_create($notif->created_at))->format("%d")}} days ago
                                @endif
                                </small>
                            </div>
                            @endfor
                        @else
                            <div class="list-group-item list-group-item-action text-center">
                                <p class="mb-1 font-weight-bold">Empty</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endauth
    @if (session('alert'))
    <div class="alert alert-success">
        {{ session('alert') }}
    </div>
    @endif
    @yield('content')
    <script src="/assets/js/jquery-3.4.1.slim.min.js"></script>
    <script src="/assets/js/jquery-1.12.4.js"></script>
    <script src="/assets/js/popper.min.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>
    <script src="/assets/js/jquery-ui.min.js"></script>
    <script src="/assets/js/aos.js"></script>
    <script src="/assets/js/index.js"></script>
    <script src="/assets/js/main.js"></script>
    <script>
    $(".submitForm").on("submit", function(){
        return confirm("Are you sure?");
    });
    $(".submitPropose").on("click", function(){
        return confirm("Are you sure?");
    });

    $(".submit").on("submit", function () {
        return confirm("Are you sure?");
    });
    
    $("#pass").on("keyup", function(e){
        var pass = $("#pass").val().length;
        if(pass < 8){
            $("#passValidator").css('display','block')
        }else{
            $("#passValidator").css('display','none')
        }
    });

    $("#repass").on("keyup", function(e){
        var pass = $("#pass").val()
        var retype = $("#repass").val()

        if(pass == retype){
            document.getElementById("btnSubmit").disabled = false;
            $("#notif").css('display','none')
        }else{
            document.getElementById("btnSubmit").disabled = true;
            $("#notif").css('display','block')
        }
    });

    $(".showAccount").on("click", function(e) {
        $("#btnEdit").css('display','');
        $("#btnSubmit").css('display','none');
        $(".inputPass").css('display','none');
        $(".inputRePass").css('display','none');
    });

    $("#btnEdit").on("click", function(e) {
        $("#btnSubmit").css('display','');
        $("#btnEdit").css('display','none');
        $(".inputPass").css('display','');
        $(".inputRePass").css('display','');
        $(".inputPhone").removeAttr("disabled");
    });
</script>
</body>

</html>
