@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row my-5">
        <div class="col-12 text-center">
            <h1>Set Session</h1>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-11">
            <form method="POST" action="" class="submitForm">
                <h3>Thesis Title and Advisor Proposal</h3>
                <div class="form-group row">
                    <label class="col-3 col-form-label">Start Date</label>
                    <input type="text" id="datepicker1" class="form-control col-7" for="create_at" placeholder="01/01/2020">
                </div>
                <div class="form-group row">
                    <label class="col-3 col-form-label">End Date</label>
                    <input type="text" id="datepicker2" class="form-control col-7" for="create_at" placeholder="01/01/2020">
                </div>

                <h3 class="mt-5">Signed Thesis Proposal</h3>
                <div class="form-group row">
                    <label class="col-3 col-form-label">Start Date</label>
                    <input type="text" id="datepicker3" class="form-control col-7" for="create_at" placeholder="01/01/2020">
                </div>
                <div class="form-group row">
                    <label class="col-3 col-form-label">End Date</label>
                    <input type="text" id="datepicker4" class="form-control col-7" for="create_at" placeholder="01/01/2020">
                </div>

                <h3 class="mt-5">Signed Interim Report</h3>
                <div class="form-group row">
                    <label class="col-3 col-form-label">Start Date</label>
                    <input type="text" id="datepicker5" class="form-control col-7" for="create_at" placeholder="01/01/2020">
                </div>
                <div class="form-group row">
                    <label class="col-3 col-form-label">End Date</label>
                    <input type="text" id="datepicker6" class="form-control col-7" for="create_at" placeholder="01/01/2020">
                </div>

                <h3 class="mt-5">Signed Final Draft</h3>
                <div class="form-group row">
                    <label class="col-3 col-form-label">Start Date</label>
                    <input type="text" id="datepicker7" class="form-control col-7" for="create_at" placeholder="01/01/2020">
                </div>
                <div class="form-group row">
                    <label class="col-3 col-form-label">End Date</label>
                    <input type="text" id="datepicker8" class="form-control col-7" for="create_at" placeholder="01/01/2020">
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary px-5 my-4 btnSubmit">Edit</button>
                    <button type="submit" class="btn btn-success px-5 my-4 btnSubmit">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection