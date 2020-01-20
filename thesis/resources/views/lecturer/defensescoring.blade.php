@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row my-5">
        <div class="col-12 text-center">
            <h1>Defense Scoring</h1>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-11">
        <div class="row py-2">
                <div class="col-3">Student</div>
                <div class="col-9">:&nbsp;&nbsp;{{$student->user->first_name}} {{$student->user->last_name}}</div>
            </div>
            <div class="row py-2">
                <div class="col-3">Title</div>
                <div class="col-9">:&nbsp;&nbsp;{{$student->title->title_name}}</div>
            </div>
            <div class="row py-2">
                <div class="col-3">Advisor</div>
                <div class="col-9">:&nbsp;&nbsp;{{$student->lecturer->user->first_name}} {{$student->lecturer->user->last_name}}</div>
            </div>
            <div class="row py-2">
                <div class="col-3">Date</div>
                <div class="col-9">:&nbsp;&nbsp;{{$student->date}}</div>
            </div>
            <div class="row py-2">
                <div class="col-3">Time</div>
                <div class="col-9">:&nbsp;&nbsp;{{$student->time}}</div>
            </div>
            <div class="row py-2">
                <div class="col-3">Room</div>
                <div class="col-9">:&nbsp;&nbsp;{{$student->defense->room}}</div>
            </div>
            <div class="row py-2">
                <div class="col-3">Chairman</div>
                <div class="col-9">:&nbsp;&nbsp;{{$student->defense->chairman_name->user->first_name}} {{$student->defense->chairman_name->user->last_name}}</div>
            </div>
            <div class="row py-2">
                <div class="col-3">Examiner</div>
                <div class="col-9">:&nbsp;&nbsp;{{$student->defense->examiner_name->user->first_name}} {{$student->defense->examiner_name->user->last_name}}</div>
            </div>
            
            <form action="/lecturer/submitScoring" method="post" class="submitForm">
                @csrf
                <input type="text" name="student_id" value="{{$student->std_id}}" style="display:none">
                <input type="text" name="lec_id" value="{{$lecturer->lec_id}}" style="display:none">
                @if(!($lecturer->lec_id == $student->lec_id))
                <table class="table table-sm table-bordered mt-5">
                    <thead class="thead-dark text-center">
                        <tr>
                            <th scope="col" width="5%">No.</th>
                            <th scope="col" width="80%">Final Report Evaluation (Refer to Grading Criteria for Final Report)</th>
                            <th scope="col" width="10%">Point (1-6)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php($num=1)
                        @foreach($reports as $question)
                        <tr>
                            <td>{{$num}}</td>
                            <td>{{$question->question}}</td>
                            <td>
                                <select class="form-control" id="SelectFinal10" name="final_report[]">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                    <option>6</option>
                                </select>
                            </td>
                        </tr>
                        @php($num++)
                        @endforeach
                    </tbody>
                </table>
                <ul style="list-style-type:none">
                    <li>6 = Excellent</li>
                    <li>5 = Good</li>
                    <li>4 = Average</li>
                    <li>3 = Inadequate, Needs Improvement</li>
                    <li>2 = Major Revision</li>
                    <li>1 = Unaccepted</li>
                </ul>
                <table class="table table-sm table-bordered mt-5">
                    <thead class="thead-dark text-center">
                        <tr>
                            <th scope="col" width="5%">No.</th>
                            <th scope="col" width="80%">Presentation Evaluation</th>
                            <th scope="col" width="10%">Point</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php($num=1)
                        @foreach($presentation as $question)
                        <tr>
                            <td>{{$num}}</td>
                            <td>{{$question->question}}</td>
                            <td>
                                <select class="form-control" id="SelectPre10" name="presentation[]">
                                    <option>0</option>
                                    <option>1</option>
                                    <option>2</option>
                                </select>
                            </td>
                        </tr>
                        @php($num++)
                        @endforeach
                    </tbody>
                </table>
                <ul style="list-style-type:none">
                    <li>2 = Good, Above Expectation</li>
                    <li>1 = Average, Adequate</li>
                    <li>0 = Inadequate, Needs Improvement</li>
                </ul>
                @else
                <table class="table table-sm table-bordered mt-5">
                    <thead class="thead-dark text-center">
                        <tr>
                            <th scope="col" width="5%">No.</th>
                            <th scope="col" width="80%">Supervisory Evaluation (Advisor Only) (Refer to Grading Criteria for Advisor)</th>
                            <th scope="col" width="10%">Point</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php($num=1)
                        @foreach($advisor as $question)
                        <tr>
                            <td>{{$num}}</td>
                            <td>{{$question->question}}</td>
                            <td>
                                <select class="form-control" id="SelectSuper4" name="advisor[]">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                            </td>
                        </tr>
                        @php($num++)
                        @endforeach
                        </tr>
                    </tbody>
                </table>
                <ul style="list-style-type:none">
                    <li>5 = Excellent</li>
                    <li>4 = Good Average, Adequate</li>
                    <li>3 = Average, Adequate</li>
                    <li>2 = Inadequate, Needs Improvement</li>
                    <li>1 = Major Revision</li>
                </ul>
                <br />
                @endif
                <div class="form-group row mt-5">
                    <label class="col-3 col-form-label" for="correctionTextArea">Suggestion</label>
                    <textarea class="col-9 form-control" id="correctionTextArea" rows="3" style="resize: none;" name="suggestion"></textarea>
                </div>
                <div class="form-group row">
                    <label class="col-3 col-form-label" for="correctionTextArea">Correction</label>
                    <textarea class="col-9 form-control" id="correctionTextArea" rows="3" style="resize: none;" name="correction"></textarea>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-success px-5 my-4 btnSubmit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection