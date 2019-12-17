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
            <form method="POST" action="">
                <h4>Thesis Title and Advisor Proposal</h4>
                <div class="form-group row">
                    <label class="col-3 col-form-label">Start Date</label>
                    <input type="text" id="datepicker1" class="form-control col-6" for="create_at" placeholder="01/01/2020">
                </div>
                <div class="form-group row">
                    <label class="col-3 col-form-label">End Date</label>
                    <input type="text" id="datepicker2" class="form-control col-6" for="create_at" placeholder="01/01/2020">
                </div>

                <h4 class="mt-5">Signed Thesis Proposal</h4>
                <div class="form-group row">
                    <label class="col-3 col-form-label">Start Date</label>
                    <input type="text" id="datepicker3" class="form-control col-6" for="create_at" placeholder="01/01/2020">
                </div>
                <div class="form-group row">
                    <label class="col-3 col-form-label">End Date</label>
                    <input type="text" id="datepicker4" class="form-control col-6" for="create_at" placeholder="01/01/2020">
                </div>

                <h4 class="mt-5">Signed Interim Report</h4>
                <div class="form-group row">
                    <label class="col-3 col-form-label">Start Date</label>
                    <input type="text" id="datepicker5" class="form-control col-6" for="create_at" placeholder="01/01/2020">
                </div>
                <div class="form-group row">
                    <label class="col-3 col-form-label">End Date</label>
                    <input type="text" id="datepicker6" class="form-control col-6" for="create_at" placeholder="01/01/2020">
                </div>

                <h4 class="mt-5">Signed Final Draft</h4>
                <div class="form-group row">
                    <label class="col-3 col-form-label">Start Date</label>
                    <input type="text" id="datepicker7" class="form-control col-6" for="create_at" placeholder="01/01/2020">
                </div>
                <div class="form-group row">
                    <label class="col-3 col-form-label">End Date</label>
                    <input type="text" id="datepicker8" class="form-control col-6" for="create_at" placeholder="01/01/2020">
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary px-5 my-4 btnSubmit">Edit</button>
                    <button type="submit" class="btn btn-primary px-5 my-4 btnSubmit">Save</button>
                </div>
            </form>
            <table class="table table-bordered table-hover">
                <thead class="thead-dark text-center">
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Student</th>
                        <th scope="col">Advisor</th>
                        <th scope="col">Date</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1.</td>
                        <td><a href="">Fiqa Nadhira Luthfia Taufik</a></td>
                        <td>Rikip Ginanjar</td>
                        <td>06-01-2020</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection