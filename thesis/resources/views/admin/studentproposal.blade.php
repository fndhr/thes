@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row my-5">
        <div class="col-12 text-center">
            <h1>Student Title and Advisor Proposal</h1>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-11">
            <div class="row py-2 mb-2">
                <div class="col-3">Name</div>
                <div class="col-9">:&nbsp;&nbsp;Cindy Grace Zebua</div>
            </div>
        
            <h2 class="text-center mt-5">Title</h2>
            <table class="table table-bordered table-hover">
                <thead class="thead-dark text-center">
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Title</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1.</td>
                        <td>Restourant Management System for Bubble Tea Stall</td>
                        <td><span class="text-success">YES</span>&emsp;<span class="text-danger">NO</span></td>
                    </tr>
                </tbody>
            </table>

            <h2 class="text-center mt-5">Advisor</h2>
            <table class="table table-bordered table-hover">
                <thead class="thead-dark text-center">
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Advisor</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1.</td>
                        <td>Rila Mandala Ph.D</td>
                        <td><span class="text-success">YES</span>&emsp;<span class="text-danger">NO</span></td>
                    </tr>
                    <tr>
                        <td>2.</td>
                        <td>Rikip Ginanjar M.Sc</td>
                        <td><span class="text-success">YES</span>&emsp;<span class="text-danger">NO</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection