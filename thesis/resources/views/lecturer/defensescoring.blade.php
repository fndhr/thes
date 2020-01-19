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
                <table class="table table-sm table-bordered mt-5">
                    <thead class="thead-dark text-center">
                        <tr>
                            <th scope="col" width="5%">No.</th>
                            <th scope="col" width="80%">Final Report Evaluation (Refer to Grading Criteria for Final Report)</th>
                            <th scope="col" width="10%">Point (1-6)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Did the report provide clear thesis statement and report outline?</td>
                            <td>
                                <select class="form-control" id="SelectFinal1" name="final_report[]">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                    <option>6</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Was overall organization of the report clear with appropriate transitions?</td>
                            <td>
                                <select class="form-control" id="SelectFinal2" name="final_report[]">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                    <option>6</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Did the report address important points of thesis problem with accurate and substantive understanding?</td>
                            <td>
                                <select class="form-control" id="SelectFinal3" name="final_report[]">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                    <option>6</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Did the report identify fundamental assumptions of thesis topic and respectfully engage the basic theories through the development of substantive counter-arguments?</td>
                            <td>
                                <select class="form-control" id="SelectFinal14" name="final_report[]">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                    <option>6</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>Did the report profoundly problem important issue at stake in the report?</td>
                            <td>
                                <select class="form-control" id="SelectFinal5" name="final_report[]">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                    <option>6</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>6</td>
                            <td>Ddid the report use graceful sentences with appropriate variety of structures?</td>
                            <td>
                                <select class="form-control" id="SelectFinal6" name="final_report[]">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                    <option>6</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>7</td>
                            <td>Were there errors of spelling, grammer, punctuation, or usage?</td>
                            <td>
                                <select class="form-control" id="SelectFinal7" name="final_report[]">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                    <option>6</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>8</td>
                            <td>Did the report follow the regulated format?</td>
                            <td>
                                <select class="form-control" id="SelectFinal8" name="final_report[]">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                    <option>6</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>9</td>
                            <td>Did the report show a great deal of independent insight and originality?</td>
                            <td>
                                <select class="form-control" id="SelectFinal9" name="final_report[]">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                    <option>6</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>10</td>
                            <td>Has the solution for thesis problem been proposed, verified, and implemented in some applications??</td>
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
                        <tr>
                            <td>1</td>
                            <td>Does he/she show deep understanding or just on the surface?</td>
                            <td>
                                <select class="form-control" id="SelectPre1" name="presentation[]">
                                    <option>0</option>
                                    <option>1</option>
                                    <option>2</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>How deep of explanation does the presenter provide?</td>
                            <td>
                                <select class="form-control" id="SelectPre2" name="presentation[]">
                                    <option>0</option>
                                    <option>1</option>
                                    <option>2</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>How well are the substance structures?</td>
                            <td>
                                <select class="form-control" id="SelectPre3" name="presentation[]">
                                    <option>0</option>
                                    <option>1</option>
                                    <option>2</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Does the substance show in-depth throughts of the subject?</td>
                            <td>
                                <select class="form-control" id="SelectPre4" name="presentation[]">
                                    <option>0</option>
                                    <option>1</option>
                                    <option>2</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>How creative is the presentation</td>
                            <td>
                                <select class="form-control" id="SelectPre5" name="presentation[]">
                                    <option>0</option>
                                    <option>1</option>
                                    <option>2</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>6</td>
                            <td>Is the presenter able to capture the audience's attention</td>
                            <td>
                                <select class="form-control" id="SelectPre6" name="presentation[]">
                                    <option>0</option>
                                    <option>1</option>
                                    <option>2</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>7</td>
                            <td>Does the presenter clearly communicate the message? (English Skill)</td>
                            <td>
                                <select class="form-control" id="SelectPre7" name="presentation[]">
                                    <option>0</option>
                                    <option>1</option>
                                    <option>2</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>8</td>
                            <td>How is non-verbal communication? (body language, gestures, eye contact, etc.)</td>
                            <td>
                                <select class="form-control" id="SelectPre8" name="presentation[]">
                                    <option>0</option>
                                    <option>1</option>
                                    <option>2</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>9</td>
                            <td>Ability to answer question</td>
                            <td>
                                <select class="form-control" id="SelectPre9" name="presentation[]">
                                    <option>0</option>
                                    <option>1</option>
                                    <option>2</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>10</td>
                            <td>Managing time allocated</td>
                            <td>
                                <select class="form-control" id="SelectPre10" name="presentation[]">
                                    <option>0</option>
                                    <option>1</option>
                                    <option>2</option>
                                </select>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <ul style="list-style-type:none">
                    <li>2 = Good, Above Expectation</li>
                    <li>1 = Average, Adequate</li>
                    <li>0 = Inadequate, Needs Improvement</li>
                </ul>
                @if($lecturer->lec_id == $student->lec_id)
                <table class="table table-sm table-bordered mt-5">
                    <thead class="thead-dark text-center">
                        <tr>
                            <th scope="col" width="5%">No.</th>
                            <th scope="col" width="80%">Supervisory Evaluation (Advisor Only) (Refer to Grading Criteria for Advisor)</th>
                            <th scope="col" width="10%">Point</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Did the candidate propose the subject by himself?</td>
                            <td>
                                <select class="form-control" id="SelectSuper1" name="advisor[]">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Did the candidate produce interim report that showed gradual progress with minor adjustment?</td>
                            <td>
                                <select class="form-control" id="SelectSuper2" name="advisor[]">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Was the candidate able to work independently?</td>
                            <td>
                                <select class="form-control" id="SelectSuper3" name="advisor[]">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Did the candidate consult with the advisor on regular basis and submit reports on time?</td>
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