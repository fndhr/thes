@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row my-5">
        <div class="col-12 text-center">
            <h1>Set Session</h1>
        </div>
    </div>
    <div class="row justify-content-center">
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

                
                <h3 class="mt-5">Signed Revised Document</h3>
                <div class="form-group row">
                    <label class="col-3 col-form-label inputRequired">Start Date*</label>
                    <input type="text" id="datepicker9" class="form-control col-7 @error('start_date_revised_document') is-invalid @enderror" name="start_date_revised_document" placeholder="ex:01/01/2020" value="{{old('start_date_revised_document')??$session->signed_revised_doc_start_date}}">
                    @error('start_date_revised_document')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label class="col-3 col-form-label inputRequired">End Date*</label>
                    <input type="text" id="datepicker10" class="form-control col-7 @error('end_date_revised_document') is-invalid @enderror" name="end_date_revised_document" placeholder="ex:01/01/2020" value="{{old('end_date_revised_document')??$session->signed_revised_doc_end_date}}">
                    @error('end_date_revised_document')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <h3 class="mt-5">Finalized Documents</h3>
                <div class="form-group row">
                    <label class="col-3 col-form-label inputRequired">Start Date*</label>
                    <input type="text" id="datepicker11" class="form-control col-7 @error('start_date_finalized_document') is-invalid @enderror" name="start_date_finalized_document" placeholder="ex:01/01/2020" value="{{old('start_date_finalized_document')??$session->finalized_doc_start_date}}">
                    @error('start_date_finalized_document')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label class="col-3 col-form-label inputRequired">End Date*</label>
                    <input type="text" id="datepicker12" class="form-control col-7 @error('end_date_finalized_document') is-invalid @enderror" name="end_date_finalized_document" placeholder="ex:01/01/2020" value="{{old('end_date_finalized_document')??$session->finalized_doc_end_date}}">
                    @error('end_date_finalized_document')
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