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
            </div>
        </div>
        @elseif($role == 2)
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-item nav-link" href="/admin/studentSearch">Student Search</a>
                <a class="nav-item nav-link" href="/admin/getDefenseSchedule">Upcoming Defense Schedule</a>
            </div>
        </div>
        @else
        <div class="navbar-collapse"></div>
        @endif
        <div class="dropdown">
            <a class="navbar-brand messages" onClick="alert('COMMING SOON')"><img src="/assets/image/admin_message.png" width="30" height="30" alt=""></a>
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
                            <div class="col-4">ID</div>
                            <div class="col-8">:&nbsp;&nbsp;
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
                            <div class="col-4">Phone</div>
                            <div class="col-8">:&nbsp;&nbsp;{{Auth::user()->phone}}</div>
                        </div>
                        <div class="row py-2">
                            <div class="col-4">Email</div>
                            <div class="col-8">:&nbsp;&nbsp;{{Auth::user()->email}}</div>
                        </div>
                        <div class="form-group row inputPass">
                            <label class="col-4 col-form-label">Password</label>
                            <input id="pass" type="text" class="form-control col-6" for="new_password" name="new_password"
                                placeholder="" value="{{old('new_password')}}">
                                <span id="passValidator" role="alert" style="display:none; color:red;">
                                    <strong>Password must be 8 character at least!</strong>
                                </span>
                        </div>
                        <div class="form-group row inputRePass">
                            <label class="col-4 col-form-label">Re-enter Password</label>
                            <input id ="repass" type="text" class="form-control col-6" for="reenter_password" name="reenter_password"
                                placeholder="" value="{{old('reenter_password')}}">
                                <a id="notif" style="color:red; display:none;">Password Isn't Match!</a>
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
    });
</script>
</body>

</html>
