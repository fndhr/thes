@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row my-5">
        <div class="col-12 text-center">
            <h1>Set Defense Schedule</h1>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-11">
            <div class="row py-2 mb-2">
                <div class="col-3">Student</div>
                <div class="col-9">:&nbsp;&nbsp;{{$student->user->first_name}} {{$student->user->last_name}}</div>
            </div>
            <div class="row py-2 mb-2">
                <div class="col-3">Title</div>
                <div class="col-9">:&nbsp;&nbsp;{{$student->title->title_name}}</div>
            </div>
            <div class="row py-2 mb-2">
                <div class="col-3">Advisor</div>
                <div class="col-9">:&nbsp;&nbsp;{{$student->lecturer->user->first_name}} {{$student->lecturer->user->last_name}}</div>
            </div>
            @if(!is_null($student->defense))
            <form method="POST" action="/admin/submitSetDefenseSchedule" class="submit">
                @csrf
                <input type="text" name="std_id" style="display:none" value="{{$student->std_id}}">
                <div class="form-group row">
                    <label class="col-3 col-form-label inputRequired">Date*</label>
                    <input type="text" id="datepicker" class="form-control col-9 @error('date') is-invalid @enderror" name="date" placeholder="ex:01/01/2020" value="{{old('date') ?? $student->defense->date}}">
                    @error('date')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label class="col-3 col-form-label inputRequired">Time*</label>
                    <input type="text" class="form-control col-9 @error('time') is-invalid @enderror" name="time" placeholder="ex:09:00" value="{{old('time')?? $student->defense->time}}">
                    @error('time')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label class="col-3 col-form-label inputRequired">Room*</label>
                    <input type="text" class="form-control col-9 @error('room') is-invalid @enderror" name="room" placeholder="ex:A000" value="{{old('room')?? $student->defense->room}}">
                    @error('room')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label class="col-3 col-form-label inputRequired">Chairman*</label>
                    <select class="form-control col-3" for="chairman_id" name="chairman_id">
                        <option value="">Choose...</option>
                        @foreach($chairmans as $examiner)
                            @if(!is_null(old('chairman_id')))
                                @if(old('chairman_id')==$examiner->lec_id)
                                    <option value="{{$examiner->lec_id}}" selected>{{$examiner->user->first_name}} {{$examiner->user->last_name}}</option>
                                @else
                                    <option value="{{$examiner->lec_id}}">{{$examiner->user->first_name}} {{$examiner->user->last_name}}</option>
                                @endif
                            @else
                                <option value="{{$examiner->lec_id}}">{{$examiner->user->first_name}} {{$examiner->user->last_name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group row">
                    <label class="col-3 col-form-label inputRequired">Examiner*</label>
                    <select class="form-control col-3" for="examiner_id" name="examiner_id">
                        <option value="">Choose...</option>
                        @foreach($examiners as $examiner)
                            @if(!is_null(old('examiner_id')))
                                @if(old('examiner_id')==$examiner->lec_id)
                                    <option value="{{$examiner->lec_id}}" selected>{{$examiner->user->first_name}} {{$examiner->user->last_name}}</option>
                                @else
                                    <option value="{{$examiner->lec_id}}">{{$examiner->user->first_name}} {{$examiner->user->last_name}}</option>
                                @endif
                            @else
                                <option value="{{$examiner->lec_id}}">{{$examiner->user->first_name}} {{$examiner->user->last_name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-success px-5 my-4 btnSubmit">Save</button>
                </div>
            </form>
            @else
            <form method="POST" action="/admin/submitSetDefenseSchedule" class="submit">
                @csrf
                <input type="text" name="std_id" style="display:none" value="{{$student->std_id}}">
                <div class="form-group row">
                    <label class="col-3 col-form-label inputRequired">Date*</label>
                    <input type="text" id="datepicker" class="form-control col-9 @error('date') is-invalid @enderror" name="date" placeholder="ex:01/01/2020" value="{{old('date')}}">
                    @error('date')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label class="col-3 col-form-label inputRequired">Time*</label>
                    <input type="text" class="form-control col-9 @error('time') is-invalid @enderror" name="time" placeholder="ex:09:00" value="{{old('time')}}">
                    @error('time')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label class="col-3 col-form-label inputRequired">Room*</label>
                    <input type="text" class="form-control col-9 @error('room') is-invalid @enderror" name="room" placeholder="ex:A000" value="{{old('room')}}">
                    @error('room')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label class="col-3 col-form-label inputRequired">Chairman*</label>
                    <select class="form-control col-3 @error('chairman_id') is-invalid @enderror" name="chairman_id" for="chairman_id">
                        <option value="">Choose...</option>
                        @foreach($chairmans as $examiner)
                            @if(!is_null(old('chairman_id')))
                                @if(old('chairman_id')==$examiner->lec_id)
                                    <option value="{{$examiner->lec_id}}" selected>{{$examiner->user->first_name}} {{$examiner->user->last_name}}</option>
                                @else
                                    <option value="{{$examiner->lec_id}}">{{$examiner->user->first_name}} {{$examiner->user->last_name}}</option>
                                @endif
                            @else
                                <option value="{{$examiner->lec_id}}">{{$examiner->user->first_name}} {{$examiner->user->last_name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group row">
                    <label class="col-3 col-form-label inputRequired">Examiner*</label>
                    <select class="form-control col-3" name="examiner_id">
                        <option value="">Choose...</option>
                        @foreach($examiners as $examiner)
                            @if(!is_null(old('examiner_id')))
                                @if(old('examiner_id')==$examiner->lec_id)
                                    <option value="{{$examiner->lec_id}}" selected>{{$examiner->user->first_name}} {{$examiner->user->last_name}}</option>
                                @else
                                    <option value="{{$examiner->lec_id}}">{{$examiner->user->first_name}} {{$examiner->user->last_name}}</option>
                                @endif
                            @else
                                <option value="{{$examiner->lec_id}}">{{$examiner->user->first_name}} {{$examiner->user->last_name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-success px-5 my-4 btnSubmit">Save</button>
                </div>
            </form>
            @endif
        </div>
    </div>
</div>
@endsection