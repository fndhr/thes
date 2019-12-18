@extends('layouts.app')

@section('content')
<div id="StudentDetail" class="container">
    <div class="row my-5">
        <div class="col-12 text-center">
            <h1>Student Detail</h1>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-11">
            <div class="row py-2 mb-2">
                <div class="col-3">Name</div>
                <div class="col-9">:&nbsp;&nbsp;Cindy Grace Zebua</div>
            </div>
            <div class="row py-2 mb-2">
                <div class="col-3">Title</div>
                <div class="col-7">:&nbsp;&nbsp;Restourant Management System for Bubble Tea Stall</div>
                <div class="col-1">&#10003;</div>
            </div>
            <div class="row py-2 mb-2">
                <div class="col">
                    <table class="table table-sm table-bordered table-hover">
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
                </div>
            </div>
            <div class="row py-2 mb-2">
                <div class="col-3">Advisor</div>
                <div class="col-7">:&nbsp;&nbsp;Rikip Ginanjar, M.Sc</div>
                <div class="col-1">&#10003;</div>
            </div>
            <div class="row py-2 mb-2">
                <div class="col">
                    <table class="table table-sm table-bordered table-hover">
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
            <div class="row py-2 mb-2">
                <div class="col-3">Proposal</div>
                <div class="col-5">:&nbsp;&nbsp;Fiqa Nadhira - Proposal.pdf</div>
                <div class="col-2"><a href="">Download</a></div>
                <div class="col-1">&#10003;</div>
            </div>
            <div class="row py-2 mb-2">
                <div class="col-3">Inteirm</div>
                <div class="col-5">:&nbsp;&nbsp;Fiqa Nadhira - Interim.pdf</div>
                <div class="col-2"><a href="">Download</a></div>
                <div class="col-1">&#10003;</div>
            </div>
            <div class="row py-2 mb-2">
                <div class="col-3">Final Draft</div>
                <div class="col-5">:&nbsp;&nbsp;Not uploaded</div>
                <div class="col-2">Download</div>
                <div class="col-1"></div>
            </div>
            <div class="row py-2 mb-2">
                <div class="col-3">Defense Date</div>
                <div class="col-5">:&nbsp;&nbsp;Not set</div>
                <div class="col-2"><a href="">View</a>&nbsp;|&nbsp;<a href="">Set</a></div>
                <div class="col-1"></div>
            </div>
            <div class="row py-2 mb-2">
                <div class="col-3">Revision</div>
                <div class="col-5">:&nbsp;&nbsp;Not uploaded</div>
                <div class="col-2">Download</div>
                <div class="col-1"></div>
            </div>
            <div class="row py-2 mb-2">
                <div class="col-3">Thesis .doc</div>
                <div class="col-5">:&nbsp;&nbsp;Not uploaded</div>
                <div class="col-2">Download</div>
                <div class="col-1"></div>
            </div>
            <div class="row py-2 mb-2">
                <div class="col-3">Thesis .pdf</div>
                <div class="col-5">:&nbsp;&nbsp;Not uploaded</div>
                <div class="col-2">Download</div>
                <div class="col-1"></div>
            </div>
        </div>
    </div>
</div>
@endsection