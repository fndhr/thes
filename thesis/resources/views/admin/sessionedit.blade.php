@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row my-5">
        <div class="col-12 text-center">
            <h1>Edit Session {{old('session_id')??$session->session_id}}</h1>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-11">
            <form method="POST" action="/admin/editSessionSet" class="submitForm">
                @csrf
                <h4>Session ID</h4>
                <div class="form-group row">
                    <label class="col-3 col-form-label">Session Name</label>
                    <label class="col-1 col-form-label">:&nbsp;&nbsp;</label>
                    <input type="text" class="form-control col-6" disabled value="{{old('session_id')??$session->session_id}}">
                </div>
                <input type="text" class="form-control col-6" style="display:none" name="session_id" value="{{$session->session_id}}">

                <h4 class="mt-5">Consultation Sheet</h4>
                <div class="form-group row">
                    <label class="col-3 col-form-label inputRequired">Maximum Consultation Sheet</label>
                    <label class="col-1 col-form-label">:&nbsp;&nbsp;</label>
                    <input type="number" id="" class="form-control col-6 @error('') is-invalid @enderror" name="" placeholder="ex:10" value="">
                    @error('')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                
                <h4 class="mt-5">Thesis Title and Advisor Proposal</h4>
                <div class="form-group row">
                    <label class="col-3 col-form-label">Deadline</label>
                    <label class="col-1 col-form-label">:&nbsp;&nbsp;</label>
                    <input type="text" id="datepicker1" class="form-control col-6 @error('end_date_title_advisor') is-invalid @enderror" name="end_date_title_advisor" placeholder="01/01/2020" value="{{old('end_date_title_advisor')??$session->title_adv_req_end}}">
                    @error('end_date_title_advisor')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <h4 class="mt-5">Signed Thesis Proposal</h4>
                <div class="form-group row">
                    <label class="col-3 col-form-label">Deadline</label>
                    <label class="col-1 col-form-label">:&nbsp;&nbsp;</label>
                    <input type="text" id="datepicker2" class="form-control col-6 @error('end_date_signed_thesis') is-invalid @enderror" name="end_date_signed_thesis" placeholder="01/01/2020" value="{{old('end_date_signed_thesis')??$session->thesis_proposal_end}}">
                    @error('end_date_signed_thesis')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <h4 class="mt-5">Signed Interim Report</h4>
                <div class="form-group row">
                    <label class="col-3 col-form-label">Deadline</label>
                    <label class="col-1 col-form-label">:&nbsp;&nbsp;</label>
                    <input type="text" id="datepicker3" class="form-control col-6 @error('end_date_interim') is-invalid @enderror" name="end_date_interim" placeholder="01/01/2020" value="{{old('end_date_interim')??$session->interim_report_end}}">
                    @error('end_date_interim')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <h4 class="mt-5">Signed Final Draft</h4>
                <div class="form-group row">
                    <label class="col-3 col-form-label">Deadline</label>
                    <label class="col-1 col-form-label">:&nbsp;&nbsp;</label>
                    <input type="text" id="datepicker4" class="form-control col-6 @error('end_date_final_draft') is-invalid @enderror" name="end_date_final_draft" placeholder="01/01/2020" value="{{old('end_date_final_draft')??$session->final_draft_end}}">
                    @error('end_date_final_draft')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-success px-5 my-4 btnSubmit">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection