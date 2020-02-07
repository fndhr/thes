@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row my-5">
        <div class="col-12 text-center">
            <h1>Scoring Sheet</h1>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-11">   
            <form method="POST" action="" class="submitForm">
                @csrf
                <div class="form-group row">
                    <label class="col-4 col-form-label inputRequired">Final Report Evaluation Sheets*</label>
                    <label class="col-1 col-form-label">:&nbsp;&nbsp;</label>
                    <input type="number" class="form-control col-2 @error('final_report') is-invalid @enderror" name="final_report" placeholder="" value="{{old('final_report')}}">
                    @error('final_report')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label class="col-4 col-form-label inputRequired">Presentation Evaluation Sheets*</label>
                    <label class="col-1 col-form-label">:&nbsp;&nbsp;</label>
                    <input type="number" class="form-control col-2 @error('presentation_evaluation') is-invalid @enderror" name="presentation_evaluation" placeholder="" value="{{old('presentation_evaluation')}}">
                    @error('presentation_evaluation')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label class="col-4 col-form-label inputRequired">Supervisior Evaluation Sheets*</label>
                    <label class="col-1 col-form-label">:&nbsp;&nbsp;</label>
                    <input type="number" class="form-control col-2 @error('supervisior_evaluation') is-invalid @enderror" name="supervisior_evaluation" placeholder="" value="{{old('supervisior_evaluation')}}">
                    @error('supervisior_evaluation')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-success btn-pill px-5 my-4 btnSubmit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection