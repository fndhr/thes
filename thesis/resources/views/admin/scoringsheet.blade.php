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
                <h4>Final Report Evaluation</h4>
                <div class="form-group row">
                    <label class="col-2 col-form-label">Question 1</label>
                    <label class="col-1 col-form-label">:&nbsp;&nbsp;</label>
                    <input type="text" class="form-control col-9 @error('final_question1') is-invalid @enderror" name="final_question1" placeholder="" value="{{old('final_question1')}}">
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label">Question 2</label>
                    <label class="col-1 col-form-label">:&nbsp;&nbsp;</label>
                    <input type="text" class="form-control col-9 @error('final_question2') is-invalid @enderror" name="final_question2" placeholder="" value="{{old('final_question2')}}">
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label">Question 3</label>
                    <label class="col-1 col-form-label">:&nbsp;&nbsp;</label>
                    <input type="text" class="form-control col-9 @error('final_question3') is-invalid @enderror" name="final_question3" placeholder="" value="{{old('final_question3')}}">
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label">Question 4</label>
                    <label class="col-1 col-form-label">:&nbsp;&nbsp;</label>
                    <input type="text" class="form-control col-9 @error('final_question4') is-invalid @enderror" name="final_question4" placeholder="" value="{{old('final_question4')}}">
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label">Question 5</label>
                    <label class="col-1 col-form-label">:&nbsp;&nbsp;</label>
                    <input type="text" class="form-control col-9 @error('final_question5') is-invalid @enderror" name="final_question5" placeholder="" value="{{old('final_question5')}}">
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label">Question 6</label>
                    <label class="col-1 col-form-label">:&nbsp;&nbsp;</label>
                    <input type="text" class="form-control col-9 @error('final_question6') is-invalid @enderror" name="final_question6" placeholder="" value="{{old('final_question6')}}">
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label">Question 7</label>
                    <label class="col-1 col-form-label">:&nbsp;&nbsp;</label>
                    <input type="text" class="form-control col-9 @error('final_question7') is-invalid @enderror" name="final_question7" placeholder="" value="{{old('final_question7')}}">
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label">Question 8</label>
                    <label class="col-1 col-form-label">:&nbsp;&nbsp;</label>
                    <input type="text" class="form-control col-9 @error('final_question8') is-invalid @enderror" name="final_question8" placeholder="" value="{{old('final_question8')}}">
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label">Question 9</label>
                    <label class="col-1 col-form-label">:&nbsp;&nbsp;</label>
                    <input type="text" class="form-control col-9 @error('final_question9') is-invalid @enderror" name="final_question9" placeholder="" value="{{old('final_question9')}}">
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label">Question 10</label>
                    <label class="col-1 col-form-label">:&nbsp;&nbsp;</label>
                    <input type="text" class="form-control col-9 @error('final_question10') is-invalid @enderror" name="final_question10" placeholder="" value="{{old('final_question10')}}">
                </div>

                <h4 class=" mt-5">Presentation Evaluation</h4>
                <div class="form-group row">
                    <label class="col-2 col-form-label">Question 1</label>
                    <label class="col-1 col-form-label">:&nbsp;&nbsp;</label>
                    <input type="text" class="form-control col-9 @error('pre_question1') is-invalid @enderror" name="pre_question1" placeholder="" value="{{old('pre_question1')}}">
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label">Question 2</label>
                    <label class="col-1 col-form-label">:&nbsp;&nbsp;</label>
                    <input type="text" class="form-control col-9 @error('pre_question2') is-invalid @enderror" name="pre_question2" placeholder="" value="{{old('pre_question2')}}">
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label">Question 3</label>
                    <label class="col-1 col-form-label">:&nbsp;&nbsp;</label>
                    <input type="text" class="form-control col-9 @error('pre_question3') is-invalid @enderror" name="pre_question3" placeholder="" value="{{old('pre_question3')}}">
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label">Question 4</label>
                    <label class="col-1 col-form-label">:&nbsp;&nbsp;</label>
                    <input type="text" class="form-control col-9 @error('pre_question4') is-invalid @enderror" name="pre_question4" placeholder="" value="{{old('pre_question4')}}">
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label">Question 5</label>
                    <label class="col-1 col-form-label">:&nbsp;&nbsp;</label>
                    <input type="text" class="form-control col-9 @error('pre_question5') is-invalid @enderror" name="pre_question5" placeholder="" value="{{old('pre_question5')}}">
                </div>

                <h4 class=" mt-5">Supervisior Evaluation</h4>
                <div class="form-group row">
                    <label class="col-2 col-form-label">Question 1</label>
                    <label class="col-1 col-form-label">:&nbsp;&nbsp;</label>
                    <input type="text" class="form-control col-9 @error('super_question1') is-invalid @enderror" name="super_question1" placeholder="" value="{{old('super_question1')}}">
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label">Question 2</label>
                    <label class="col-1 col-form-label">:&nbsp;&nbsp;</label>
                    <input type="text" class="form-control col-9 @error('super_question2') is-invalid @enderror" name="super_question2" placeholder="" value="{{old('super_question2')}}">
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label">Question 3</label>
                    <label class="col-1 col-form-label">:&nbsp;&nbsp;</label>
                    <input type="text" class="form-control col-9 @error('super_question3') is-invalid @enderror" name="super_question3" placeholder="" value="{{old('super_question3')}}">
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label">Question 4</label>
                    <label class="col-1 col-form-label">:&nbsp;&nbsp;</label>
                    <input type="text" class="form-control col-9 @error('super_question4') is-invalid @enderror" name="super_question4" placeholder="" value="{{old('super_question4')}}">
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-success btn-pill px-5 my-4 btnSubmit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection