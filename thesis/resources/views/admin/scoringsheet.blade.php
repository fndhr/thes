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
            @if(count($advisor)==0)    
            <form method="POST" action="/admin/submitScoringSheet" class="submitForm">
                @csrf
                <h4>Final Report Evaluation</h4>
                <div class="form-group row">
                    <label class="col-2 col-form-label">Question 1</label>
                    <label class="col-1 col-form-label">:&nbsp;&nbsp;</label>
                    <input type="text" class="form-control col-9 @error('final_question.0') is-invalid @enderror" name="final_question[]" placeholder="" value="{{old('final_question.0')}}">
                    @error('final_question.0')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label">Question 2</label>
                    <label class="col-1 col-form-label">:&nbsp;&nbsp;</label>
                    <input type="text" class="form-control col-9 @error('final_question.1') is-invalid @enderror" name="final_question[]" placeholder="" value="{{old('final_question.1')}}">
                    @error('final_question.1')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label">Question 3</label>
                    <label class="col-1 col-form-label">:&nbsp;&nbsp;</label>
                    <input type="text" class="form-control col-9 @error('final_question.2') is-invalid @enderror" name="final_question[]" placeholder="" value="{{old('final_question.2')}}">
                    @error('final_question.2')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label">Question 4</label>
                    <label class="col-1 col-form-label">:&nbsp;&nbsp;</label>
                    <input type="text" class="form-control col-9 @error('final_question.3') is-invalid @enderror" name="final_question[]" placeholder="" value="{{old('final_question.3')}}">
                    @error('final_question.3')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label">Question 5</label>
                    <label class="col-1 col-form-label">:&nbsp;&nbsp;</label>
                    <input type="text" class="form-control col-9 @error('final_question.4') is-invalid @enderror" name="final_question[]" placeholder="" value="{{old('final_question.4')}}">
                    @error('final_question.4')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label">Question 6</label>
                    <label class="col-1 col-form-label">:&nbsp;&nbsp;</label>
                    <input type="text" class="form-control col-9 @error('final_question.5') is-invalid @enderror" name="final_question[]" placeholder="" value="{{old('final_question.5')}}">
                    @error('final_question.5')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label">Question 7</label>
                    <label class="col-1 col-form-label">:&nbsp;&nbsp;</label>
                    <input type="text" class="form-control col-9 @error('final_question.6') is-invalid @enderror" name="final_question[]" placeholder="" value="{{old('final_question.6')}}">
                    @error('final_question.6')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label">Question 8</label>
                    <label class="col-1 col-form-label">:&nbsp;&nbsp;</label>
                    <input type="text" class="form-control col-9 @error('final_question.7') is-invalid @enderror" name="final_question[]" placeholder="" value="{{old('final_question.7')}}">
                    @error('final_question.7')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label">Question 9</label>
                    <label class="col-1 col-form-label">:&nbsp;&nbsp;</label>
                    <input type="text" class="form-control col-9 @error('final_question.8') is-invalid @enderror" name="final_question[]" placeholder="" value="{{old('final_question.8')}}">
                    @error('final_question.8')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label">Question 10</label>
                    <label class="col-1 col-form-label">:&nbsp;&nbsp;</label>
                    <input type="text" class="form-control col-9 @error('final_question.9') is-invalid @enderror" name="final_question[]" placeholder="" value="{{old('final_question.9')}}">
                    @error('final_question.9')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <h4 class=" mt-5">Presentation Evaluation</h4>
                <div class="form-group row">
                    <label class="col-2 col-form-label">Question 1</label>
                    <label class="col-1 col-form-label">:&nbsp;&nbsp;</label>
                    <input type="text" class="form-control col-9 @error('pre_question.0') is-invalid @enderror" name="pre_question[]" placeholder="" value="{{old('pre_question.0')}}">
                    @error('pre_question.0')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label">Question 2</label>
                    <label class="col-1 col-form-label">:&nbsp;&nbsp;</label>
                    <input type="text" class="form-control col-9 @error('pre_question.1') is-invalid @enderror" name="pre_question[]" placeholder="" value="{{old('pre_question.1')}}">
                    @error('pre_question.1')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label">Question 3</label>
                    <label class="col-1 col-form-label">:&nbsp;&nbsp;</label>
                    <input type="text" class="form-control col-9 @error('pre_question.2') is-invalid @enderror" name="pre_question[]" placeholder="" value="{{old('pre_question.2')}}">
                    @error('pre_question.2')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label">Question 4</label>
                    <label class="col-1 col-form-label">:&nbsp;&nbsp;</label>
                    <input type="text" class="form-control col-9 @error('pre_question.3') is-invalid @enderror" name="pre_question[]" placeholder="" value="{{old('pre_question.3')}}">
                    @error('pre_question.3')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label">Question 5</label>
                    <label class="col-1 col-form-label">:&nbsp;&nbsp;</label>
                    <input type="text" class="form-control col-9 @error('pre_question.4') is-invalid @enderror" name="pre_question[]" placeholder="" value="{{old('pre_question.4')}}">
                    @error('pre_question.4')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label">Question 6</label>
                    <label class="col-1 col-form-label">:&nbsp;&nbsp;</label>
                    <input type="text" class="form-control col-9 @error('pre_question.5') is-invalid @enderror" name="pre_question[]" placeholder="" value="{{old('pre_question.5')}}">
                    @error('pre_question.5')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label">Question 7</label>
                    <label class="col-1 col-form-label">:&nbsp;&nbsp;</label>
                    <input type="text" class="form-control col-9 @error('pre_question.6') is-invalid @enderror" name="pre_question[]" placeholder="" value="{{old('pre_question.6')}}">
                    @error('pre_question.6')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label">Question 8</label>
                    <label class="col-1 col-form-label">:&nbsp;&nbsp;</label>
                    <input type="text" class="form-control col-9 @error('pre_question.7') is-invalid @enderror" name="pre_question[]" placeholder="" value="{{old('pre_question.7')}}">
                    @error('pre_question.7')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label">Question 9</label>
                    <label class="col-1 col-form-label">:&nbsp;&nbsp;</label>
                    <input type="text" class="form-control col-9 @error('pre_question.8') is-invalid @enderror" name="pre_question[]" placeholder="" value="{{old('pre_question.8')}}">
                    @error('pre_question.8')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label">Question 10</label>
                    <label class="col-1 col-form-label">:&nbsp;&nbsp;</label>
                    <input type="text" class="form-control col-9 @error('pre_question.9') is-invalid @enderror" name="pre_question[]" placeholder="" value="{{old('pre_question.9')}}">
                    @error('pre_question.9')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <h4 class=" mt-5">Supervisior Evaluation</h4>
                <div class="form-group row">
                    <label class="col-2 col-form-label">Question 1</label>
                    <label class="col-1 col-form-label">:&nbsp;&nbsp;</label>
                    <input type="text" class="form-control col-9 @error('super_question.0') is-invalid @enderror" name="super_question[]" placeholder="" value="{{old('super_question.0')}}">
                    @error('super_question.0')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label">Question 2</label>
                    <label class="col-1 col-form-label">:&nbsp;&nbsp;</label>
                    <input type="text" class="form-control col-9 @error('super_question.1') is-invalid @enderror" name="super_question[]" placeholder="" value="{{old('super_question.1')}}">
                    @error('super_question.1')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label">Question 3</label>
                    <label class="col-1 col-form-label">:&nbsp;&nbsp;</label>
                    <input type="text" class="form-control col-9 @error('super_question.2') is-invalid @enderror" name="super_question[]" placeholder="" value="{{old('super_question.2')}}">
                    @error('super_question.2')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label">Question 4</label>
                    <label class="col-1 col-form-label">:&nbsp;&nbsp;</label>
                    <input type="text" class="form-control col-9 @error('super_question.3') is-invalid @enderror" name="super_question[]" placeholder="" value="{{old('super_question.3')}}">
                    @error('super_question.3')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-success btn-pill px-5 my-4 btnSubmit">Submit</button>
                </div>
            </form>
            @else
            <form method="POST" action="/admin/submitScoringSheet" class="submitForm">
                @csrf
                <h4>Final Report Evaluation</h4>
                <div class="form-group row">
                    <label class="col-2 col-form-label">Question 1</label>
                    <label class="col-1 col-form-label">:&nbsp;&nbsp;</label>
                    <input type="text" class="form-control col-9 @error('final_question.0') is-invalid @enderror" name="final_question[]" placeholder="" value="{{old('final_question.0') ?? $report[0]->question}}">
                    @error('final_question.0')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label">Question 2</label>
                    <label class="col-1 col-form-label">:&nbsp;&nbsp;</label>
                    <input type="text" class="form-control col-9 @error('final_question.1') is-invalid @enderror" name="final_question[]" placeholder="" value="{{old('final_question.1')??$report[1]->question}}">
                    @error('final_question.1')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label">Question 3</label>
                    <label class="col-1 col-form-label">:&nbsp;&nbsp;</label>
                    <input type="text" class="form-control col-9 @error('final_question.2') is-invalid @enderror" name="final_question[]" placeholder="" value="{{old('final_question.2')?? $report[2]->question}}">
                    @error('final_question.2')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label">Question 4</label>
                    <label class="col-1 col-form-label">:&nbsp;&nbsp;</label>
                    <input type="text" class="form-control col-9 @error('final_question.3') is-invalid @enderror" name="final_question[]" placeholder="" value="{{old('final_question.3')?? $report[3]->question}}">
                    @error('final_question.3')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label">Question 5</label>
                    <label class="col-1 col-form-label">:&nbsp;&nbsp;</label>
                    <input type="text" class="form-control col-9 @error('final_question.4') is-invalid @enderror" name="final_question[]" placeholder="" value="{{old('final_question.4')?? $report[4]->question}}">
                    @error('final_question.4')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label">Question 6</label>
                    <label class="col-1 col-form-label">:&nbsp;&nbsp;</label>
                    <input type="text" class="form-control col-9 @error('final_question.5') is-invalid @enderror" name="final_question[]" placeholder="" value="{{old('final_question.5')?? $report[5]->question}}">
                    @error('final_question.5')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label">Question 7</label>
                    <label class="col-1 col-form-label">:&nbsp;&nbsp;</label>
                    <input type="text" class="form-control col-9 @error('final_question.6') is-invalid @enderror" name="final_question[]" placeholder="" value="{{old('final_question.6')?? $report[6]->question}}">
                    @error('final_question.6')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label">Question 8</label>
                    <label class="col-1 col-form-label">:&nbsp;&nbsp;</label>
                    <input type="text" class="form-control col-9 @error('final_question.7') is-invalid @enderror" name="final_question[]" placeholder="" value="{{old('final_question.7')?? $report[7]->question}}">
                    @error('final_question.7')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label">Question 9</label>
                    <label class="col-1 col-form-label">:&nbsp;&nbsp;</label>
                    <input type="text" class="form-control col-9 @error('final_question.8') is-invalid @enderror" name="final_question[]" placeholder="" value="{{old('final_question.8')?? $report[8]->question}}">
                    @error('final_question.8')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label">Question 10</label>
                    <label class="col-1 col-form-label">:&nbsp;&nbsp;</label>
                    <input type="text" class="form-control col-9 @error('final_question.9') is-invalid @enderror" name="final_question[]" placeholder="" value="{{old('final_question.9')?? $report[9]->question}}">
                    @error('final_question.9')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <h4 class=" mt-5">Presentation Evaluation</h4>
                <div class="form-group row">
                    <label class="col-2 col-form-label">Question 1</label>
                    <label class="col-1 col-form-label">:&nbsp;&nbsp;</label>
                    <input type="text" class="form-control col-9 @error('pre_question.0') is-invalid @enderror" name="pre_question[]" placeholder="" value="{{old('pre_question.0')??$presentation[0]->question}}">
                    @error('pre_question.0')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label">Question 2</label>
                    <label class="col-1 col-form-label">:&nbsp;&nbsp;</label>
                    <input type="text" class="form-control col-9 @error('pre_question.1') is-invalid @enderror" name="pre_question[]" placeholder="" value="{{old('pre_question.1')??$presentation[1]->question}}">
                    @error('pre_question.1')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label">Question 3</label>
                    <label class="col-1 col-form-label">:&nbsp;&nbsp;</label>
                    <input type="text" class="form-control col-9 @error('pre_question.2') is-invalid @enderror" name="pre_question[]" placeholder="" value="{{old('pre_question.2')??$presentation[2]->question}}">
                    @error('pre_question.2')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label">Question 4</label>
                    <label class="col-1 col-form-label">:&nbsp;&nbsp;</label>
                    <input type="text" class="form-control col-9 @error('pre_question.3') is-invalid @enderror" name="pre_question[]" placeholder="" value="{{old('pre_question.3')??$presentation[3]->question}}">
                    @error('pre_question.3')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label">Question 5</label>
                    <label class="col-1 col-form-label">:&nbsp;&nbsp;</label>
                    <input type="text" class="form-control col-9 @error('pre_question.4') is-invalid @enderror" name="pre_question[]" placeholder="" value="{{old('pre_question.4')??$presentation[4]->question}}">
                    @error('pre_question.4')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label">Question 6</label>
                    <label class="col-1 col-form-label">:&nbsp;&nbsp;</label>
                    <input type="text" class="form-control col-9 @error('pre_question.5') is-invalid @enderror" name="pre_question[]" placeholder="" value="{{old('pre_question.5')??$presentation[5]->question}}">
                    @error('pre_question.5')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label">Question 7</label>
                    <label class="col-1 col-form-label">:&nbsp;&nbsp;</label>
                    <input type="text" class="form-control col-9 @error('pre_question.6') is-invalid @enderror" name="pre_question[]" placeholder="" value="{{old('pre_question.6')??$presentation[6]->question}}">
                    @error('pre_question.6')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label">Question 8</label>
                    <label class="col-1 col-form-label">:&nbsp;&nbsp;</label>
                    <input type="text" class="form-control col-9 @error('pre_question.7') is-invalid @enderror" name="pre_question[]" placeholder="" value="{{old('pre_question.7')??$presentation[7]->question}}">
                    @error('pre_question.7')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label">Question 9</label>
                    <label class="col-1 col-form-label">:&nbsp;&nbsp;</label>
                    <input type="text" class="form-control col-9 @error('pre_question.8') is-invalid @enderror" name="pre_question[]" placeholder="" value="{{old('pre_question.8')??$presentation[8]->question}}">
                    @error('pre_question.8')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label">Question 10</label>
                    <label class="col-1 col-form-label">:&nbsp;&nbsp;</label>
                    <input type="text" class="form-control col-9 @error('pre_question.9') is-invalid @enderror" name="pre_question[]" placeholder="" value="{{old('pre_question.9')??$presentation[9]->question}}">
                    @error('pre_question.9')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <h4 class=" mt-5">Supervisior Evaluation</h4>
                <div class="form-group row">
                    <label class="col-2 col-form-label">Question 1</label>
                    <label class="col-1 col-form-label">:&nbsp;&nbsp;</label>
                    <input type="text" class="form-control col-9 @error('super_question.0') is-invalid @enderror" name="super_question[]" placeholder="" value="{{old('super_question.0')??$advisor[0]->question}}">
                    @error('super_question.0')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label">Question 2</label>
                    <label class="col-1 col-form-label">:&nbsp;&nbsp;</label>
                    <input type="text" class="form-control col-9 @error('super_question.1') is-invalid @enderror" name="super_question[]" placeholder="" value="{{old('super_question.1')??$advisor[1]->question}}">
                    @error('super_question.1')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label">Question 3</label>
                    <label class="col-1 col-form-label">:&nbsp;&nbsp;</label>
                    <input type="text" class="form-control col-9 @error('super_question.2') is-invalid @enderror" name="super_question[]" placeholder="" value="{{old('super_question.2')??$advisor[2]->question}}">
                    @error('super_question.2')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label">Question 4</label>
                    <label class="col-1 col-form-label">:&nbsp;&nbsp;</label>
                    <input type="text" class="form-control col-9 @error('super_question.3') is-invalid @enderror" name="super_question[]" placeholder="" value="{{old('super_question.3')??$advisor[3]->question}}">
                    @error('super_question.3')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-success btn-pill px-5 my-4 btnSubmit">Submit</button>
                </div>
            </form>
            @endif
        </div>
    </div>
</div>
@endsection