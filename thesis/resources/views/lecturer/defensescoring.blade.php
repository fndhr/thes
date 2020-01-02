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
                <div class="col-9">:&nbsp;&nbsp;001201600001 - Cindy Grace Zebua</div>
            </div>
            <div class="row py-2">
                <div class="col-3">Thesis Title</div>
                <div class="col-9">:&nbsp;&nbsp;Test 1</div>
            </div>
            <div class="row py-2">
                <div class="col-3">Program</div>
                <div class="col-9">:&nbsp;&nbsp;Information System</div>
            </div>
            <div class="row py-2">
                <div class="col-3">Faculty</div>
                <div class="col-9">:&nbsp;&nbsp;Computing</div>
            </div>
            <div class="row py-2">
                <div class="col-3">Date and Time</div>
                <div class="col-9">:&nbsp;&nbsp;Monday, July 07, 2019, 09.00 - 10.30</div>
            </div>
            <div class="row py-2">
                <div class="col-3">Advisor</div>
                <div class="col-9">:&nbsp;&nbsp;Nur Hadisukmana</div>
            </div>
            <div class="row py-2">
                <div class="col-3">Examiner 1 (CHAIRMAN)</div>
                <div class="col-9">:&nbsp;&nbsp;Tjong Wan Sen</div>
            </div>
            <div class="row py-2">
                <div class="col-3">Examiner 2</div>
                <div class="col-9">:&nbsp;&nbsp;Rusdianto Roestam</div>
            </div>
            <table class="table table-bordered mt-5">
                <thead class="thead-dark text-center">
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Final Report Evaluation (Refer to Grading Criteria for Final Report)</th>
                        <th scope="col">Point</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Did the report provide clear thesis statement and report outline?</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Was overall organization of the report clear with appropriate transitions?</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Did the report address important points of thesis problem with accurate and substantive understanding?</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Did the report identify fundamental assumptions of thesis topic and respectfully engage the basic theories through the development of substantive counter-arguments?</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>Did the report profoundly problem important issue at stake in the report?</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>Ddid the report use graceful sentences with appropriate variety of structures?</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>7</td>
                        <td>Were there errors of spelling, grammer, punctuation, or usage?</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>8</td>
                        <td>Did the report follow the regulated format?</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>9</td>
                        <td>Did the report show a great deal of independent insight and originality?</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>10</td>
                        <td>Has the solution for thesis problem been proposed, verified, and implemented in some applications??</td>
                        <td></td>
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
            <table class="table table-bordered mt-5">
                <thead class="thead-dark text-center">
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Presentation Evaluation</th>
                        <th scope="col">Point</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Does he/she show deep understanding or just on the surface?</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>How deep of explanation does the presenter provide?</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>How well are the substance structures?</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Does the substance show in-depth throughts of the subject?</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>How creative is the presentation</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>Is the presenter able to capture the audience's attention</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>7</td>
                        <td>Does the presenter clearly communicate the message? (English Skill)</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>8</td>
                        <td>How is non-verbal communication? (body language, gestures, eye contact, etc.)</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>9</td>
                        <td>Ability to answer question</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>10</td>
                        <td>Managing time allocated</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
            <ul style="list-style-type:none">
                <li>2 = Good, Above Expectation</li>
                <li>1 = Average, Adequate</li>
                <li>0 = Inadequate, Needs Improvement</li>
            </ul>
            <table class="table table-bordered mt-5">
                <thead class="thead-dark text-center">
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Supervisory Evaluation (Advisor Only) (Refer to Grading Criteria for Advisor)</th>
                        <th scope="col">Point</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Did the candidate propose the subject by himself?</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Did the candidate produce interim report that showed gradual progress with minor adjustment?</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Was the candidate able to work independently?</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Did the candidate consult with the advisor on regular basis and submit reports on time?</td>
                        <td></td>
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
            <form>
                <div class="form-group row mt-5">
                    <label class="col-3 col-form-label" for="correctionTextArea">Correction</label>
                    <textarea class="col-9 form-control" id="correctionTextArea" rows="3" style="resize: none;"></textarea>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-success px-5 my-4 btnSubmit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection