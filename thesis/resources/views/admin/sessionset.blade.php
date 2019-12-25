@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row my-5">
        <div class="col-12 text-center">
            <h1>Set Session</h1>
        </div>
    </div>
    <div class="row justify-content-center">
        @if(is_null($edit))
        <div class="col-11">
            <form method="POST" action="/admin/createSessionSet" class="submitForm">
                @csrf
                <h3>Session ID</h3>
                <div class="form-group row">
                    <label class="col-3 col-form-label">Session Name</label>
                    <input type="text" class="form-control col-7 @error('session_id') is-invalid @enderror" name="session_id" placeholder="20191" value="{{old('session_id')}}">
                    @error('session_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <h3>Thesis Title and Advisor Proposal</h3>
                <div class="form-group row">
                    <label class="col-3 col-form-label">Start Date</label>
                    <input type="text" id="datepicker1" class="form-control col-7 @error('start_date_title_advisor') is-invalid @enderror" name="start_date_title_advisor" placeholder="01/01/2020" value="{{old('start_date_title_advisor')}}">
                    @error('start_date_title_advisor')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label class="col-3 col-form-label">End Date</label>
                    <input type="text" id="datepicker2" class="form-control col-7 @error('end_date_title_advisor') is-invalid @enderror" name="end_date_title_advisor" placeholder="01/01/2020" value="{{old('end_date_title_advisor')}}">
                    @error('end_date_title_advisor')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <h3 class="mt-5">Signed Thesis Proposal</h3>
                <div class="form-group row">
                    <label class="col-3 col-form-label">Start Date</label>
                    <input type="text" id="datepicker3" class="form-control col-7 @error('start_date_signed_thesis') is-invalid @enderror" name="start_date_signed_thesis" placeholder="01/01/2020" value="{{old('start_date_signed_thesis')}}">
                    @error('start_date_signed_thesis')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label class="col-3 col-form-label">End Date</label>
                    <input type="text" id="datepicker4" class="form-control col-7 @error('end_date_signed_thesis') is-invalid @enderror" name="end_date_signed_thesis" placeholder="01/01/2020" value="{{old('end_date_signed_thesis')}}">
                    @error('end_date_signed_thesis')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <h3 class="mt-5">Signed Interim Report</h3>
                <div class="form-group row">
                    <label class="col-3 col-form-label">Start Date</label>
                    <input type="text" id="datepicker5" class="form-control col-7 @error('start_date_interim') is-invalid @enderror" name="start_date_interim" placeholder="01/01/2020" value="{{old('start_date_interim')}}">
                    @error('start_date_interim')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label class="col-3 col-form-label">End Date</label>
                    <input type="text" id="datepicker6" class="form-control col-7 @error('end_date_interim') is-invalid @enderror" name="end_date_interim" placeholder="01/01/2020" value="{{old('end_date_interim')}}">
                    @error('end_date_interim')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <h3 class="mt-5">Signed Final Draft</h3>
                <div class="form-group row">
                    <label class="col-3 col-form-label">Start Date</label>
                    <input type="text" id="datepicker7" class="form-control col-7 @error('start_date_final_draft') is-invalid @enderror" name="start_date_final_draft" placeholder="01/01/2020" value="{{old('start_date_final_draft')}}">
                    @error('start_date_final_draft')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label class="col-3 col-form-label">End Date</label>
                    <input type="text" id="datepicker8" class="form-control col-7 @error('end_date_final_draft') is-invalid @enderror" name="end_date_final_draft" placeholder="01/01/2020" value="{{old('end_date_final_draft')}}">
                    @error('end_date_final_draft')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="text-center">
                    <!--<button type="submit" class="btn btn-primary px-5 my-4 btnSubmit">Edit</button>-->
                    <button type="submit" class="btn btn-success px-5 my-4 btnSubmit">Save</button>
                </div>
            </form>
        </div>
        @else
        <div class="col-11">
            <form method="POST" action="/admin/editSessionSet" class="submitForm">
                @csrf
                <h3>Session ID</h3>
                <div class="form-group row">
                    <label class="col-3 col-form-label">Session Name</label>
                    <input type="text" class="form-control col-7" disabled value="{{old('session_id')??$session->session_id}}">
                </div>
                <input type="text" class="form-control col-7" style="display:none" name="session_id" value="{{$session->session_id}}">
                <h3>Thesis Title and Advisor Proposal</h3>
                <div class="form-group row">
                    <label class="col-3 col-form-label">Start Date</label>
                    <input type="text" id="datepicker1" class="form-control col-7 @error('start_date_title_advisor') is-invalid @enderror" name="start_date_title_advisor" placeholder="01/01/2020" value="{{old('start_date_title_advisor')??$session->title_adv_req_start}}">
                    @error('start_date_title_advisor')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label class="col-3 col-form-label">End Date</label>
                    <input type="text" id="datepicker2" class="form-control col-7 @error('end_date_title_advisor') is-invalid @enderror" name="end_date_title_advisor" placeholder="01/01/2020" value="{{old('end_date_title_advisor')??$session->title_adv_req_end}}">
                    @error('end_date_title_advisor')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <h3 class="mt-5">Signed Thesis Proposal</h3>
                <div class="form-group row">
                    <label class="col-3 col-form-label">Start Date</label>
                    <input type="text" id="datepicker3" class="form-control col-7 @error('start_date_signed_thesis') is-invalid @enderror" name="start_date_signed_thesis" placeholder="01/01/2020" value="{{old('start_date_signed_thesis')?? $session->thesis_proposal_start}}">
                    @error('start_date_signed_thesis')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label class="col-3 col-form-label">End Date</label>
                    <input type="text" id="datepicker4" class="form-control col-7 @error('end_date_signed_thesis') is-invalid @enderror" name="end_date_signed_thesis" placeholder="01/01/2020" value="{{old('end_date_signed_thesis')??$session->thesis_proposal_end}}">
                    @error('end_date_signed_thesis')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <h3 class="mt-5">Signed Interim Report</h3>
                <div class="form-group row">
                    <label class="col-3 col-form-label">Start Date</label>
                    <input type="text" id="datepicker5" class="form-control col-7 @error('start_date_interim') is-invalid @enderror" name="start_date_interim" placeholder="01/01/2020" value="{{old('start_date_interim')??$session->interim_report_start}}">
                    @error('start_date_interim')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label class="col-3 col-form-label">End Date</label>
                    <input type="text" id="datepicker6" class="form-control col-7 @error('end_date_interim') is-invalid @enderror" name="end_date_interim" placeholder="01/01/2020" value="{{old('end_date_interim')??$session->interim_report_end}}">
                    @error('end_date_interim')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <h3 class="mt-5">Signed Final Draft</h3>
                <div class="form-group row">
                    <label class="col-3 col-form-label">Start Date</label>
                    <input type="text" id="datepicker7" class="form-control col-7 @error('start_date_final_draft') is-invalid @enderror" name="start_date_final_draft" placeholder="01/01/2020" value="{{old('start_date_final_draft')??$session->final_draft_start}}">
                    @error('start_date_final_draft')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label class="col-3 col-form-label">End Date</label>
                    <input type="text" id="datepicker8" class="form-control col-7 @error('end_date_final_draft') is-invalid @enderror" name="end_date_final_draft" placeholder="01/01/2020" value="{{old('end_date_final_draft')??$session->final_draft_end}}">
                    @error('end_date_final_draft')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary px-5 my-4 btnSubmit">Edit</button>
                    <!--<button type="submit" class="btn btn-success px-5 my-4 btnSubmit">Save</button>-->
                </div>
            </form>
        </div>
        @endif
        @if(count($sessions)>0)
        <div class="py-3">
            <h2 class="text-center">Session List</h2>
            <table class="table table-bordered table-hover">
                <thead class="thead-dark text-center">
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Session ID</th>
                        <th scope="col">action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($sessions)>0)
                    @php($num = 1)
                    @foreach($sessions as $session)
                    <tr>
                        <td>{{$num}}.</td>
                        <td>{{$session->session_id}}</td>
                        <td><a href="/admin/sessionSet/{{$session->session_id}}">edit</a></td>
                        @php($num++)
                    </tr>
                    @endforeach
                    @else
                        <tr>
                            <td colspan="4" class="text-center">Records Not Found</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        @endif
    </div>
</div>
@endsection