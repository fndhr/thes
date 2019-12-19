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
        <form method="POST" action="/register/lecturer">
                @csrf
                <div class="form-group row">
                    <label class="col-3 col-form-label inputRequired">First Name*</label>
                    <input type="text" class="form-control col-9 @error('user_name') is-invalid @enderror" for="first_name" name="first_name" placeholder="Please Input Your First Name" value="{{old('first_name')}}">
                    @error('first_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label class="col-3 col-form-label inputRequired">Last Name*</label>
                    <input type="text" class="form-control col-9 @error('last_name') is-invalid @enderror" for="last_name" name="last_name" placeholder="Please Input Your Last Name" value="{{old('last_name')}}">
                    @error('last_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label class="col-3 col-form-label inputRequired">Lecturer ID*</label>
                    <input type="text" class="form-control col-9 @error('lec_id') is-invalid @enderror" for="lec_id" placeholder="Please Input Your Lecturer ID" value="{{old('lec_id')}}">
                    @error('lec_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label class="col-3 col-form-label inputRequired">Role*</label>
                    <div class="col-9 pt-2 pl-0" id="roleLecturer">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" for="isAdv" name="isAdv" id="advisor" value="option1">
                            <label class="form-check-label" for="advisor">Advisor</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" for="isExm" name="isExm" id="examiner" value="option2">
                            <label class="form-check-label" for="examiner">Examiner</label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-3 col-form-label inputRequired">Phone Number*</label>
                    <input type="text" class="form-control col-9" for="phone" placeholder="Please Input Your Phone Number">
                </div>
                <div class="form-group row">
                    <label class="col-3 col-form-label inputRequired">Email Address*</label>
                    <input type="email" class="form-control col-9 @error('email') is-invalid @enderror" for="email" name="email" placeholder="Please Input Your Email Address" value="{{old('email')}}">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label class="col-3 col-form-label inputRequired">Password*</label>
                    <input type="password" class="form-control col-9" for="password" name="password" placeholder="Please Input Your Password">
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-success px-5 my-4 btnSubmit">Save</button>
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