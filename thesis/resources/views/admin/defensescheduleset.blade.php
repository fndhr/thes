@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row my-5">
        <div class="col-12 text-center">
            <h1>Set Defense Schedule</h1>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-11">
            <div class="row py-2 mb-2">
                <div class="col-3">Student</div>
                <div class="col-9">:&nbsp;&nbsp;Cindy Grace Zebua</div>
            </div>
            <div class="row py-2 mb-2">
                <div class="col-3">Title</div>
                <div class="col-9">:&nbsp;&nbsp;Android-Base Application for HR Management in PT Emerio</div>
            </div>
            <div class="row py-2 mb-2">
                <div class="col-3">Advisor</div>
                <div class="col-9">:&nbsp;&nbsp;Rikip Ginanjar</div>
            </div>
            <form method="POST" action="/register/lecturer" class="submit">
                <div class="form-group row">
                    <label class="col-3 col-form-label inputRequired">Date*</label>
                    <input type="text" id="datepicker" class="form-control col-9" for="create_at" placeholder="01/01/2020">
                </div>
                <div class="form-group row">
                    <label class="col-3 col-form-label inputRequired">Time*</label>
                    <input type="text" class="form-control col-9" for="create_at" placeholder="09:00">
                </div>
                <div class="form-group row">
                    <label class="col-3 col-form-label inputRequired">Room*</label>
                    <input type="text" class="form-control col-9" for="create_at" placeholder="A000">
                </div>
                <div class="form-group row">
                    <label class="col-3 col-form-label inputRequired">Chairman*</label>
                    <select class="form-control col-3" for="chairman_id" name="major_id">
                        <option selected>Choose...</option>
                        <option value="1">Ronny</option>
                        <option value="2">Ocha</option>
                        <option value="3">Ghofir</option>
                    </select>
                </div>
                <div class="form-group row">
                    <label class="col-3 col-form-label inputRequired">Examiner*</label>
                    <select class="form-control col-3" for="examiner_id" name="major_id">
                        <option selected>Choose...</option>
                        <option value="1">Tjong Wan Sen</option>
                        <option value="2">Wiranto</option>
                        <option value="3">Nurhadi</option>
                    </select>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-success px-5 my-4 btnSubmit">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection