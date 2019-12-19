@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row my-5">
        <div class="col-12 text-center">
            <h1>Student Search</h1>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-11">
            <form method="POST" action="/register/lecturer">
                <div class="form-group row">
                    <label class="col-3 col-form-label inputRequired">Student*</label>
                    <input type="text" class="form-control col-9" for="std_id" placeholder="Input Student Name or ID">
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary px-5 my-4 btnSubmit">Search</button>
                </div>
            </form>
            <table class="table table-bordered table-hover">
                <thead class="thead-dark text-center">
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Student</th>
                        <th scope="col">Status</th>
                        <th scope="col">Advisor</th>
                    </tr>
                </thead>
                <tbody>
                    @php($count = 1)
                    @foreach($students as $student)
                    <tr>
                        <td>1.</td>
                        <td><a href="/admin/studentDetail/1">Fiqa Nadhira Luthfia Taufik</a></td>
                        <td>Interim</td>
                        <td>Rikip Ginanjar</td>
                    </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection