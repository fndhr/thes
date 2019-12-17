@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row my-5">
        <div class="col-12 text-center">
            <h1>User Registration Lecturer</h1>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-11">
            <form  method="POST" action="/register/student">
                @csrf
                <div class="form-group row">
                    <label class="col-3 col-form-label">First Name</label>
                    <input type="text" class="form-control col-9 @error('user_name') is-invalid @enderror" for="first_name" name="first_name" placeholder="example" value="{{old('first_name')}}">
                    @error('first_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label class="col-3 col-form-label">Last Name</label>
                    <input type="text" class="form-control col-9" for="last_name" name="last_name" placeholder="example">
                    @error('last_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label class="col-3 col-form-label">Username</label>
                    <input type="text" class="form-control col-9 @error('username') is-invalid @enderror" for="username" name="username" placeholder="example" value="{{old('username')}}">
                    @error('username')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label class="col-3 col-form-label">Student ID</label>
                    <input type="text" class="form-control col-9" for="std_id" name="std_id" placeholder="123456789">
                </div>
                <div class="form-group row">
                    <label class="col-3 col-form-label">Phone Number</label>
                    <input type="text" class="form-control col-9" for="phone" name="phone" placeholder="081234567890">
                </div>
                <div class="form-group row">
                    <label class="col-3 col-form-label">Email Address</label>
                    <input type="email" class="form-control col-9" for="email" name="email" placeholder="name@example.com">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label class="col-3 col-form-label">Password</label>
                    <input type="password" class="form-control col-9" for="password" name="password" placeholder="name@example.com">
                </div>
                <div class="form-group row">
                    <label class="col-3 col-form-label">Major</label>
                    <select class="form-control col-3" for="major_id" name="major_id">
                        <option selected>Choose...</option>
                        <option value="1">Information System</option>
                        <option value="2">Information Technology</option>
                        <option value="3">Visual Design Graphic</option>
                    </select>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary px-5 my-4 btnSubmit">Save</button>
                </div>
            </form>
        </div>
    </div>
    <div class="py-3">
        <h2 class="text-center">Lecturer List</h2>
        <table class="table table-bordered table-hover">
            <thead class="thead-dark text-center">
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Lecturer ID</th>
                    <th scope="col">Role</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Email</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Rikip Ginanjar</td>
                    <td>331232</td>
                    <td>Advisor Examiner</td>
                    <td>081234567890</td>
                    <td>rikipginanjar@president.co</td>
                </tr>
                <tr>
                    <td>Nurhadi Sukmana</td>
                    <td>8455425</td>
                    <td>Advisor Examiner</td>
                    <td>081234567890</td>
                    <td>nurhadisukmana@president.co</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection