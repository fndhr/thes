@extends('layouts.app')

@section('content')
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
                    <label for="firstNameLecturer" class="col-3 col-form-label">First Name</label>
                    <input type="text" class="form-control col-9" id="firstNameLecturer" placeholder="example">
                </div>
                <div class="form-group row">
                    <label for="lastNameLecturer" class="col-3 col-form-label">Last Name</label>
                    <input type="text" class="form-control col-9" id="lastNameLecturer" placeholder="example">
                </div>
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
                    <label for="firstNameStudent" class="col-3 col-form-label">First Name</label>
                    <input type="text" class="form-control col-9" id="firstNameStudent" placeholder="example">
                </div>
                <div class="form-group row">
                    <label for="lastNameStudent" class="col-3 col-form-label">Last Name</label>
                    <input type="text" class="form-control col-9" id="lastNameStudent" placeholder="example">
                </div>
                <div class="form-group row">
                    <label for="nameStudent" class="col-3 col-form-label">Username</label>
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
    @endsection