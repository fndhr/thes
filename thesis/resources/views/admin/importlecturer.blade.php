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
            <form class="text-center submitForm" action="" method="POST" enctype="multipart/form-data">
                <div class="form-group row justify-content-center">
                    <input type="hidden" name="" value="">
                    <input type="file" class="col-3 form-control-file" id="file" for="file" name="file">
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-success btn-pill px-5 my-3 btnSubmitProposal">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection