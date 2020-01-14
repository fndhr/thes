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
        <form method="POST" action="register/lecturer" class="submitForm">
                @csrf
                <div class="form-group row">
                    <label class="col-2 col-form-label inputRequired">First Name*</label>
                    <label class="col-1 col-form-label">:&nbsp;&nbsp;</label>
                    <input type="text" class="form-control col-9 @error('first_name') is-invalid @enderror" for="first_name" name="first_name" placeholder="Please Input Your First Name" value="{{old('first_name')}}">
                    @error('first_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label inputRequired">Last Name*</label>
                    <label class="col-1 col-form-label">:&nbsp;&nbsp;</label>
                    <input type="text" class="form-control col-9 @error('last_name') is-invalid @enderror" for="last_name" name="last_name" placeholder="Please Input Your Last Name" value="{{old('last_name')}}">
                    @error('last_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label inputRequired">Lecturer ID*</label>
                    <label class="col-1 col-form-label">:&nbsp;&nbsp;</label>
                    <input type="number" class="form-control col-9 @error('lec_id') is-invalid @enderror" for="lec_id" name="lec_id" placeholder="Please Input Your Lecturer ID" value="{{old('lec_id')}}">
                    @error('lec_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label">Role</label>
                    <label class="col-1 col-form-label">:&nbsp;&nbsp;</label>
                    <div class="col-9 pt-2 pl-0" id="roleLecturer">
                        <div class="form-check form-check-inline">
                            @if(!is_null(old('isAdv')))
                                <input class="form-check-input" type="checkbox" for="isAdv" name="isAdv" id="advisor" checked>
                            @else
                                <input class="form-check-input" type="checkbox" for="isAdv" name="isAdv" id="advisor">
                            @endif
                            <label class="form-check-label" for="advisor">Advisor</label>
                        </div>
                        <div class="form-check form-check-inline">
                            @if(!is_null(old('isExm')))
                                <input class="form-check-input" type="checkbox" for="isExm" name="isExm" id="examiner" checked>
                            @else
                                <input class="form-check-input" type="checkbox" for="isExm" name="isExm" id="examiner">
                            @endif
                            <label class="form-check-label" for="examiner">Examiner</label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label">Phone Number</label>
                    <label class="col-1 col-form-label">:&nbsp;&nbsp;</label>
                    <input type="number" class="form-control col-9" for="phone" name="phone" placeholder="Please Input Your Phone Number (ex:08xx)" value="{{old('phone')}}">
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label inputRequired">Email Address*</label>
                    <label class="col-1 col-form-label">:&nbsp;&nbsp;</label>
                    <input type="email" class="form-control col-9 @error('email') is-invalid @enderror" for="email" name="email" placeholder="Please Input Your Email Address" value="{{old('email')}}">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-success btn-pill px-5 my-4 btnSubmit">Save</button>
                </div>
            </form>
        </div>
    </div>
    <div class="py-3">
        <h2 class="text-center">List of Lecturer</h2>
        <table class="table table-bordered table-sm table-hover">
            <thead class="thead-dark text-center">
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Lecturer ID</th>
                    <th scope="col">Lecturer Name</th>
                    <th scope="col">Role</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Email</th>
                </tr>
            </thead>
            <tbody>
                @if(count($lecturers)>0)
                @php($num = 1)
                @foreach($lecturers as $lecturer)
                    <tr>
                        <td>{{$num}}.</td>
                        <td>{{$lecturer->lec_id}}</td>
                        <td>{{$lecturer->user->first_name}} {{$lecturer->user->last_name}}</td>
                        <td>
                            @if($lecturer->isExm || $lecturer->isAdv)
                                {{($lecturer->isExm)? 'Examiner':''}}{{($lecturer->isExm )&&($lecturer->isAdv)? ', ':''}}{{($lecturer->isAdv) ? 'Advisor':''}}
                            @else
                                -
                            @endif
                        </td>
                        <td>{{$lecturer->user->phone ?? 'no phone number'}}</td>
                        <td>{{$lecturer->user->email ?? 'please fill the email'}}</td>
                    </tr>
                @php($num++)
                @endforeach
                @else
                    <tr>
                        <td colspan="6" class="text-center">Records Not Found</td>
                    </tr>
                @endif
            </tbody>
        </table>

        {{$lecturers->links()}}
    </div>
</div>
@endsection