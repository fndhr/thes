@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row my-5">
        <div class="col-12 text-center">
            <h1>Import User Lecturer</h1>
        </div>
    </div>
    <div class="row py-2">
        <div class="col-12 text-center">
            <form method='post' action='/home' enctype='multipart/form-data' >
                {{ csrf_field() }}
                <input type="file" class="dropdown-item" name = "file">Import User Student</a>
                <input type='submit' name='submit' value='Import'>
            </form>            
        </div>
    </div>
</div>
@endsection