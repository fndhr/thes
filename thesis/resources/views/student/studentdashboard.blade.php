@extends('layouts.app')

@section('content')
<div class="container">
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
                        <form class="mt-5 mb-3" action="/student/submitTitle" method="POST" class="submit">
                            @csrf
                            <div class="form-group row">
                                <label class="col-3 col-form-label">Title</label>
                                <input type="text" class="form-control col-9" for="title_name" name="title_name" placeholder="Title Name">
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-success px-5 my-3 btnSubmit">Submit</button>
                            </div>
                        </form>
                        @if(count($proposedTitle)>0)
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
                                    @for($counter = 0 ; $counter < count($proposedTitle) ;$counter++)
                                    <tr>
                                        <td>{{$counter+1}}.</td>
                                        <td>{{$proposedTitle[$counter]->title_name}}</td>
                                        <td>{{$proposedTitle[$counter]->statuses[0]->sts_name}}</td>
                                    </tr>
                                    @endfor
                                </tbody>
                            </table>
                        </div>
                        @endif
                        <form class="mt-5 mb-3" action="/student/submitAdvisor" method="POST" class="submit"> 
                            @csrf   
                            <div class="form-group row">
                                <label for="majorStudent" class="col-3 col-form-label">Advisor</label>
                                <select class="form-control col-9 @error('advisor') is-invalid @enderror" for="advisor" name="advisor">
                                    <option value="">Choose...</option>
                                    @foreach($lecturers as $lecturer)
                                        <option value="{{$lecturer->lec_id}}">{{$lecturer->user->first_name}} {{$lecturer->user->last_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-3"></div>
                                <div class="col-9 px-0">
                                    @error('advisor')
                                        <span class="invalid-feedback" role="alert" style="display:block; margin-top: -10px;">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-success px-5 my-3 btnSubmit">Submit</button>
                            </div>
                        </form>
                        @if(count($proposedLecturers)>0)
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
                                    @for($counter = 0 ; $counter < count($proposedLecturers) ;$counter++)
                                    <tr>
                                        <td>{{$counter+1}}.</td>
                                        <td>{{$proposedLecturers[$counter]->lecturers[0]->user->first_name}} {{$proposedLecturers[$counter]->lecturers[0]->user->last_name}}</td>
                                        <td>{{$proposedLecturers[$counter]->statuses[0]->sts_name}}</td>
                                    </tr>
                                    @endfor
                                </tbody>
                            </table>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>


        <div class="card">
            <div class="card-header" id="headingThree" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                <h4 class="text-black">Upload Your Signed Thesis Proposal</h4>
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
                            <form class="text-center" action="/student/uploadDocThesisProposal" method="POST" enctype="multipart/form-data" class="submit">
                            {{ csrf_field() }}
                                <div class="form-group row justify-content-center">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="file" class="col-3 form-control-file" id="file" for="file" name="file">
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success px-5 my-3 btnSubmit">Submit</button>
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
                <h4 class="text-black">Upload Your Signed Interim Report</h4>
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
                        <form class="text-center" action="/student/uploadDocThesisInterim" method="POST" enctype="multipart/form-data" class="submit">
                            {{ csrf_field() }}
                                <div class="form-group row justify-content-center">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="file" class="col-3 form-control-file" id="file" for="file" name="file">
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success px-5 my-3 btnSubmit">Submit</button>
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
                <h4 class="text-black">Upload Your Signed Final Draft</h4>
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
                        <form class="text-center" action="/student/uploadDocThesisFinalDraft" method="POST" enctype="multipart/form-data" class="submit">
                            {{ csrf_field() }}
                                <div class="form-group row justify-content-center">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="file" class="col-3 form-control-file" id="file" for="file" name="file">
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success px-5 my-3 btnSubmit">Submit</button>
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
                <h4 class="text-black">Your Defense Schedule</h4>
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
                <h4 class="text-black">Upload Your Signed Revised Document</h4>
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
                            <form class="text-center" class="submit">
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
                <h4 class="text-black">Upload Your Finalized Documents</h4>
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
                            <form class="text-center" class="submit">
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
                            <form class="text-center" class="submit">
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
                            <form class="text-center" class="submit">
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
                            <form class="text-center" class="submit">
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
                            <form class="text-center" class="submit">
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
                            <form class="text-center" class="submit">
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
                            <form class="text-center" class="submit">
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
                            <form class="text-center" class="submit">
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
                            <form class="text-center" class="submit">
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