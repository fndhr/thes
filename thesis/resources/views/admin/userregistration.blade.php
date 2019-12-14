<?php
    session_start();
    include('connect.php');
    if(!isset($_SESSION['login'])) {
        echo "You need to login first!";
        header('Location: index.php');  
    }
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>President University</title>
</head>

<body style="background-color: rgb(126, 129, 119);">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="">
            <img src="https://cdn0.iconfinder.com/data/icons/elasto-online-store/26/00-ELASTOFONT-STORE-READY_user-circle-512.png" width="30" height="30" class="d-inline-block align-top" alt="">
            001201600001 - Admin
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav">
            <a class="nav-item nav-link active" href="#">Home <span class="sr-only">(current)</span></a>
            <a class="nav-item nav-link" href="#">User Registration</a>
            <a class="nav-item nav-link" href="#">Set Session</a>
            <a class="nav-item nav-link" href="#">Student</a>
            <a class="nav-item nav-link" href="#">Defense Schedule</a>
          </div>
        </div>
        <div class="dropdown">
            <a class="navbar-brand"><img src="https://cdn4.iconfinder.com/data/icons/integral/128/message-512.png" width="30" height="30" class="d-inline-block align-top" alt=""></a>
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Hi, Fiqa
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item" href="#">Account</a>
              <a class="dropdown-item" href="#">Change Password</a>
              <a class="dropdown-item" href="#">Sign Out</a>
            </div>
        </div>
    </nav>
    <div class="container bg-light my-5 px-5" style="border-radius: 10px; box-shadow: 3px 3px 10px grey;">
        <div class="row py-4">
            <div class="col-4">
                <h1>User Registration</h1>
            </div>
            <div class="col-2">
                <select class="custom-select mt-2 type" id="inputGroupSelect04" aria-label="Example select with button addon">
                    <option selected>Choose...</option>
                    <option value="lecturer">Lecturer</option>
                    <option value="student">Student</option>
                </select>
            </div>
        </div>
        <div class="entry entryLecturer">
            <form>
                <div class="form-group row">
                    <label for="nameLecturer" class="col-3 col-form-label">Name</label>
                    <input type="text" class="form-control col-9" id="nameLecturer" placeholder="example">
                </div>
                <div class="form-group row">
                    <label for="idLecturer" class="col-3 col-form-label">Lecturer ID</label>
                    <input type="text" class="form-control col-9" id="idLecturer" placeholder="123456789">
                </div>
                <div class="form-group row">
                    <label for="roleLecturer" class="col-3 col-form-label">Role</label>
                    <div class="col-9 pt-2 pl-0" id="roleLecturer">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="advisor" value="option1">
                            <label class="form-check-label" for="advisor">Advisor</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="examiner" value="option2">
                            <label class="form-check-label" for="examiner">Examiner</label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="phoneLecturer" class="col-3 col-form-label">Phone Number</label>
                    <input type="text" class="form-control col-9" id="phoneLecturer" placeholder="081234567890">
                </div>
                <div class="form-group row">
                    <label for="emailLecturer" class="col-3 col-form-label">Email Address</label>
                    <input type="email" class="form-control col-9" id="emailLecturer" placeholder="name@example.com">
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary px-5 my-3 btnSubmit">Save</button>
                </div>
            </form>
            <div class="dataTable py-3">
                <h2 class="text-center">Student List</h2>
                <table class="table table-bordered table-hover">
                    <thead class="thead-dark text-center">
                        <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Student ID</th>
                        <th scope="col">Major</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <td>Fiqa Nadhira</td>
                        <td>001201600001</td>
                        <td>Information System</td>
                        <td>081234567890</td>
                        <td>fiqa.nadhira@gmail.com</td>
                        </tr>
                        <tr>
                            <td>Muhammad Fadrean</td>
                            <td>001201600002</td>
                            <td>Information System</td>
                            <td>081234567890</td>
                            <td>muhammad.fadrean@gmail.com</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="entry entryStudent">
            <form>
                <div class="form-group row">
                    <label for="nameStudent" class="col-3 col-form-label">Name</label>
                    <input type="text" class="form-control col-9" id="nameStudent" placeholder="example">
                </div>
                <div class="form-group row">
                    <label for="idStudent" class="col-3 col-form-label">Student ID</label>
                    <input type="text" class="form-control col-9" id="idStudent" placeholder="123456789">
                </div>
                <div class="form-group row">
                    <label for="phoneStudent" class="col-3 col-form-label">Phone Number</label>
                    <input type="text" class="form-control col-9" id="phoneStudent" placeholder="081234567890">
                </div>
                <div class="form-group row">
                    <label for="emailStudent" class="col-3 col-form-label">Email Address</label>
                    <input type="email" class="form-control col-9" id="emailStudent" placeholder="name@example.com">
                </div>
                <div class="form-group row">
                    <label for="majorStudent" class="col-3 col-form-label">Major</label>
                    <select class="form-control col-3" id="majorStudent">
                        <option selected>Choose...</option>
                        <option value="1">Information System</option>
                        <option value="2">Information Technology</option>
                        <option value="3">Visual Design Graphic</option>
                    </select>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary px-5 my-3 btnSubmit">Save</button>
                </div>
            </form>
            <div class="dataTable py-3">
                <h2 class="text-center">Student List</h2>
                <table class="table table-bordered table-hover">
                    <thead class="thead-dark text-center">
                        <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Student ID</th>
                        <th scope="col">Major</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <td>Fiqa Nadhira</td>
                        <td>001201600001</td>
                        <td>Information System</td>
                        <td>081234567890</td>
                        <td>fiqa.nadhira@gmail.com</td>
                        </tr>
                        <tr>
                            <td>Muhammad Fadrean</td>
                            <td>001201600002</td>
                            <td>Information System</td>
                            <td>081234567890</td>
                            <td>muhammad.fadrean@gmail.com</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
    $(document).ready(function() {
        $('.dataTable').hide();
        $('.btnSubmit').click(function() {
            $('.dataTable').show();
        }); 
    });
    $(document).ready(function() {
        $('.entry').hide(); 
        $('.type').change(function() {
            if($('.type').val() == 'student') {
                $('.entryStudent').show();
                $('.entryLecturer').hide();
                $('.entryLecturer form').get(0).reset();
            } else if ($('.type').val() == 'lecturer') {
                $('.entryLecturer').show();
                $('.entryStudent').hide();
                $('.entryStudent form').get(0).reset();
            } else {
                $('.entryLecturer').hide();
                $('.entryStudent').hide();
                $('.entry input').val('');
                $('.entryLecturer form').get(0).reset();
                $('.entryStudent form').get(0).reset();
            }
        });
    });
    </script>
</body>
</html>