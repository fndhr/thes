@extends('layouts.app')

@section('content')
<div class="container bg-light my-5 px-5 py-4" style="border-radius: 10px; box-shadow: 3px 3px 10px grey;">
    <div class="row my-4">
        <div class="col-12">
            <h1>Student Dashboard</h1>
        </div>
    </div>
    <div class="accordion" id="accordionExample">
        <div class="card">
            <div class="card-header" id="headingOne" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                <h4 class="text-black">Your Progress</h4>
            </div>
            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body">
                    <div class="row py-2">
                        <div class="col-3">Title</div>
                        <div class="col-9">:&nbsp;&nbsp;Thesis's Title</div>
                    </div>
                    <div class="row py-2">
                        <div class="col-3">Advisor</div>
                        <div class="col-9">:&nbsp;&nbsp;Advisor Name</div>
                    </div>
                    <div class="row py-2">
                        <div class="col-3">Status</div>
                        <div class="col-9">:&nbsp;&nbsp;Status Progress</div>
                    </div>
                    <div class="row py-2">
                        <div class="col-3">Defense</div>
                        <div class="col-9">:&nbsp;&nbsp;Date not set</div>
                    </div>
                </div>
            </div>
        </div>


        <div class="card">
            <div class="card-header" id="headingTwo" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                <h4 class="text-black">Title and Advisor Proposal</h4>
            </div>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                <div class="card-body">
                    <div class="row my-4 text-center">
                        <div class="col-3"><h5>Session</h5></div>
                        <div class="col-3"><h5>Start: 16-08-2019</h5></div>
                        <div class="col-3"><h5>End: 24-08-2019</h5></div>
                        <div class="col-3"><h5>Status: null</h5></div>
                    </div>
                    <div class="px-4">
                        <form class="mt-5 mb-3">
                            <div class="form-group row">
                                <label for="firstNameLecturer" class="col-3 col-form-label">Title</label>
                                <input type="text" class="form-control col-9" id="firstNameLecturer" placeholder="Title Name">
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary px-5 my-3 btnSubmit">Submit</button>
                            </div>
                        </form>
                        <div class="py-3">
                            <table class="table table-sm table-bordered table-hover">
                                <thead class="thead-dark text-center">
                                    <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1.</td>
                                        <td>Thesis Title</td>
                                        <td>Rejected</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <form class="mt-5 mb-3">
                            <div class="form-group row">
                                <label for="firstNameLecturer" class="col-3 col-form-label">Advisor</label>
                                <input type="text" class="form-control col-9" id="firstNameLecturer" placeholder="Advisor Name">
                            </div>
                            <div class="form-group row">
                                <label for="majorStudent" class="col-3 col-form-label">Major</label>
                                <select class="form-control col-3" id="majorStudent">
                                    <option selected>Choose...</option>
                                    <option value="1">Lecture Name 1</option>
                                    <option value="2">Lecture Name 2</option>
                                    <option value="3">Lecture Name 3</option>
                                </select>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary px-5 my-3 btnSubmit">Submit</button>
                            </div>
                        </form>
                        <div class="py-3">
                            <table class="table table-sm table-bordered table-hover">
                                <thead class="thead-dark text-center">
                                    <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">Advisor</th>
                                    <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1.</td>
                                        <td>Advisor Name</td>
                                        <td>Rejected</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="card">
            <div class="card-header" id="headingThree" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                <h4 class="text-black">Upload your signed thesis proposal</h4>
            </div>
            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                <div class="card-body">
                    <div class="row my-4 text-center">
                        <div class="col-3"><h5>Session</h5></div>
                        <div class="col-3"><h5>Start: 16-08-2019</h5></div>
                        <div class="col-3"><h5>End: 24-08-2019</h5></div>
                        <div class="col-3"><h5>Status: null</h5></div>
                    </div>
                    <div class="row py-2">
                        <div class="col-3">Title</div>
                        <div class="col-9">:&nbsp;&nbsp;Thesis's Title</div>
                    </div>
                    <div class="row py-2">
                        <div class="col-3">Advisor</div>
                        <div class="col-9">:&nbsp;&nbsp;Advisor Name</div>
                    </div>
                    <div class="row py-2">
                        <div class="col-3">File Submmited</div>
                        <div class="col-9">:&nbsp;&nbsp;Fiqa Nadhira - Thesis Proposal.pdf</div>
                    </div>
                    <div class="row py-2">
                        <div class="col-12 text-center">
                            <form class="text-center">
                                <div class="form-group row justify-content-center">
                                    <input type="file" class="col-3 form-control-file" id="exampleFormControlFile1">
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row py-2">
                        <div class="col text-danger">*Please note that you only have 1 attempt to upload the file</div>
                    </div>
                </div>
            </div>
        </div>


        <div class="card">
            <div class="card-header" id="headingFour" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                <h4 class="text-black">Upload your signed interim report</h4>
            </div>
            <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                <div class="card-body">
                    <div class="row my-4 text-center">
                        <div class="col-3"><h5>Session</h5></div>
                        <div class="col-3"><h5>Start: 16-08-2019</h5></div>
                        <div class="col-3"><h5>End: 24-08-2019</h5></div>
                        <div class="col-3"><h5>Status: null</h5></div>
                    </div>
                    <div class="row py-2">
                        <div class="col-3">Title</div>
                        <div class="col-9">:&nbsp;&nbsp;Thesis's Title</div>
                    </div>
                    <div class="row py-2">
                        <div class="col-3">Advisor</div>
                        <div class="col-9">:&nbsp;&nbsp;Advisor Name</div>
                    </div>
                    <div class="row py-2">
                        <div class="col-3">File Submmited</div>
                        <div class="col-9">:&nbsp;&nbsp;Fiqa Nadhira - Thesis Proposal.pdf</div>
                    </div>
                    <div class="row py-2">
                        <div class="col-12 text-center">
                            <form class="text-center">
                                <div class="form-group row justify-content-center">
                                    <input type="file" class="col-3 form-control-file" id="exampleFormControlFile1">
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row py-2">
                        <div class="col text-danger">*Please note that you only have 1 attempt to upload the file</div>
                    </div>
                </div>
            </div>
        </div>


        <div class="card">
            <div class="card-header" id="headingFive" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                <h4 class="text-black">Upload your signed final draft</h4>
            </div>
            <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample">
                <div class="card-body">
                    <div class="row my-4 text-center">
                        <div class="col-3"><h5>Session</h5></div>
                        <div class="col-3"><h5>Start: 16-08-2019</h5></div>
                        <div class="col-3"><h5>End: 24-08-2019</h5></div>
                        <div class="col-3"><h5>Status: null</h5></div>
                    </div>
                    <div class="row py-2">
                        <div class="col-3">Title</div>
                        <div class="col-9">:&nbsp;&nbsp;Thesis's Title</div>
                    </div>
                    <div class="row py-2">
                        <div class="col-3">Advisor</div>
                        <div class="col-9">:&nbsp;&nbsp;Advisor Name</div>
                    </div>
                    <div class="row py-2">
                        <div class="col-3">File Submmited</div>
                        <div class="col-9">:&nbsp;&nbsp;Fiqa Nadhira - Thesis Proposal.pdf</div>
                    </div>
                    <div class="row py-2">
                        <div class="col-12 text-center">
                            <form class="text-center">
                                <div class="form-group row justify-content-center">
                                    <input type="file" class="col-3 form-control-file" id="exampleFormControlFile1">
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row py-2">
                        <div class="col text-danger">*Please note that you only have 1 attempt to upload the file</div>
                    </div>
                </div>
            </div>
        </div>


        <div class="card">
            <div class="card-header" id="headingSix" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                <h4 class="text-black">Upload your signed final draft</h4>
            </div>
            <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordionExample">
                <div class="card-body">
                    <div class="row py-2">
                        <div class="col-3">Title</div>
                        <div class="col-9">:&nbsp;&nbsp;Thesis's Title</div>
                    </div>
                    <div class="row py-2">
                        <div class="col-3">Advisor</div>
                        <div class="col-9">:&nbsp;&nbsp;Advisor Name</div>
                    </div>
                    <div class="row py-2">
                        <div class="col-3">Date</div>
                        <div class="col-9">:&nbsp;&nbsp;Undefined</div>
                    </div>
                    <div class="row py-2">
                        <div class="col-3">Time</div>
                        <div class="col-9">:&nbsp;&nbsp;Undefined</div>
                    </div>
                    <div class="row py-2">
                        <div class="col-3">Room</div>
                        <div class="col-9">:&nbsp;&nbsp;Undefined</div>
                    </div>
                    <div class="row py-2">
                        <div class="col-3">Chairman</div>
                        <div class="col-9">:&nbsp;&nbsp;Undefined</div>
                    </div>
                    <div class="row py-2">
                        <div class="col-3">Examiner</div>
                        <div class="col-9">:&nbsp;&nbsp;Undefined</div>
                    </div>
                </div>
            </div>
        </div>


        <div class="card">
            <div class="card-header" id="headingSeven" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                <h4 class="text-black">Upload your signed revised document</h4>
            </div>
            <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven" data-parent="#accordionExample">
                <div class="card-body">
                    <div class="row my-4 text-center">
                        <div class="col-3"><h5>Session</h5></div>
                        <div class="col-3"><h5>Start: 16-08-2019</h5></div>
                        <div class="col-3"><h5>End: 24-08-2019</h5></div>
                        <div class="col-3"><h5>Status: null</h5></div>
                    </div>
                    <div class="row py-2">
                        <div class="col-3">Title</div>
                        <div class="col-9">:&nbsp;&nbsp;Thesis's Title</div>
                    </div>
                    <div class="row py-2">
                        <div class="col-3">Advisor</div>
                        <div class="col-9">:&nbsp;&nbsp;Advisor Name</div>
                    </div>
                    <div class="row py-2">
                        <div class="col-3">File Submmited</div>
                        <div class="col-9">:&nbsp;&nbsp;No file</div>
                    </div>
                    <div class="row py-2">
                        <div class="col-12 text-center">
                            <form class="text-center">
                                <div class="form-group row justify-content-center">
                                    <input type="file" class="col-3 form-control-file" id="exampleFormControlFile1">
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row py-2">
                        <div class="col text-danger">*Please note that you only have 1 attempt to upload the file</div>
                    </div>
                </div>
            </div>
        </div>


        <div class="card">
            <div class="card-header" id="headingEight" data-toggle="collapse" data-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                <h4 class="text-black">Upload your signed revised document</h4>
            </div>
            <div id="collapseEight" class="collapse" aria-labelledby="headingEight" data-parent="#accordionExample">
                <div class="card-body">
                    <div class="row my-4 text-center">
                        <div class="col-3"><h5>Session</h5></div>
                        <div class="col-3"><h5>Start: 16-08-2019</h5></div>
                        <div class="col-3"><h5>End: 24-08-2019</h5></div>
                        <div class="col-3"><h5>Status: null</h5></div>
                    </div>
                    <div class="row py-2">
                        <div class="col-3">Title</div>
                        <div class="col-9">:&nbsp;&nbsp;Thesis's Title</div>
                    </div>
                    <div class="row py-2">
                        <div class="col-3">Advisor</div>
                        <div class="col-9">:&nbsp;&nbsp;Advisor Name</div>
                    </div>

                    <div class="row py-2">
                        <div class="col-3">Thesis .doc</div>
                        <div class="col-9">:&nbsp;&nbsp;Fiqa Nadhira - Thesis Proposal.doc</div>
                    </div>
                    <div class="row py-2">
                        <div class="col-12 text-center">
                            <form class="text-center">
                                <div class="form-group row justify-content-center">
                                    <input type="file" class="col-3 form-control-file" id="exampleFormControlFile1">
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="row py-2">
                        <div class="col-3">Thesis .pdf</div>
                        <div class="col-9">:&nbsp;&nbsp;Fiqa Nadhira - Thesis Proposal.pdf</div>
                    </div>
                    <div class="row py-2">
                        <div class="col-12 text-center">
                            <form class="text-center">
                                <div class="form-group row justify-content-center">
                                    <input type="file" class="col-3 form-control-file" id="exampleFormControlFile2">
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="row py-2">
                        <div class="col-3">Source code</div>
                        <div class="col-9">:&nbsp;&nbsp;Fiqa Nadhira - Thesis Proposal.zip</div>
                    </div>
                    <div class="row py-2">
                        <div class="col-12 text-center">
                            <form class="text-center">
                                <div class="form-group row justify-content-center">
                                    <input type="file" class="col-3 form-control-file" id="exampleFormControlFile3">
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="row py-2">
                        <div class="col-3">User Manual</div>
                        <div class="col-9">:&nbsp;&nbsp;Fiqa Nadhira - Thesis Proposal.pdf</div>
                    </div>
                    <div class="row py-2">
                        <div class="col-12 text-center">
                            <form class="text-center">
                                <div class="form-group row justify-content-center">
                                    <input type="file" class="col-3 form-control-file" id="exampleFormControlFile4">
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="row py-2">
                        <div class="col-3">Installer Guide</div>
                        <div class="col-9">:&nbsp;&nbsp;Fiqa Nadhira - Thesis Proposal.pdf</div>
                    </div>
                    <div class="row py-2">
                        <div class="col-12 text-center">
                            <form class="text-center">
                                <div class="form-group row justify-content-center">
                                    <input type="file" class="col-3 form-control-file" id="exampleFormControlFile5">
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="row py-2">
                        <div class="col-3">Summary in English (max 6 pages, .doc/.docx</div>
                        <div class="col-9">:&nbsp;&nbsp;Fiqa Nadhira - Thesis Proposal.pdf</div>
                    </div>
                    <div class="row py-2">
                        <div class="col-12 text-center">
                            <form class="text-center">
                                <div class="form-group row justify-content-center">
                                    <input type="file" class="col-3 form-control-file" id="exampleFormControlFile6">
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="row py-2">
                        <div class="col-3">Summary in Bahasa (max 6 pages, .doc/.docx</div>
                        <div class="col-9">:&nbsp;&nbsp;Fiqa Nadhira - Thesis Proposal.pdf</div>
                    </div>
                    <div class="row py-2">
                        <div class="col-12 text-center">
                            <form class="text-center">
                                <div class="form-group row justify-content-center">
                                    <input type="file" class="col-3 form-control-file" id="exampleFormControlFile7">
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="row py-2">
                        <div class="col-3">Powerpoint Slide</div>
                        <div class="col-9">:&nbsp;&nbsp;Fiqa Nadhira - Thesis Proposal.pptx</div>
                    </div>
                    <div class="row py-2">
                        <div class="col-12 text-center">
                            <form class="text-center">
                                <div class="form-group row justify-content-center">
                                    <input type="file" class="col-3 form-control-file" id="exampleFormControlFile8">
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="row py-2">
                        <div class="col-3">Declaration of Originality</div>
                        <div class="col-9">:&nbsp;&nbsp;Fiqa Nadhira - Thesis Proposal.pdf</div>
                    </div>
                    <div class="row py-2">
                        <div class="col-12 text-center">
                            <form class="text-center">
                                <div class="form-group row justify-content-center">
                                    <input type="file" class="col-3 form-control-file" id="exampleFormControlFile9">
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row py-2">
                        <div class="col text-danger">*Please note that you only have 1 attempt to upload the file</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection