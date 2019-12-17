@extends('layouts.app')

@section('content')
<div data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
    <div class="site-wrap">
        <div class="intro-section" id="home-section">
            <div class="slide-1" style="background-image: url('images/hero_1.jpg');" data-stellar-background-ratio="0.5">
                <div class="container" style="background: none;">
                    <div class="row align-items-center">
                        <div class="col-12">
                            <div class="row align-items-center">
                                <div class="col-lg-6 mb-4">
                                    <h1 data-aos="fade-up" data-aos-delay="100">Thesis and Defense Manager</h1>
                                    <p class="mb-4" data-aos="fade-up" data-aos-delay="200">President University - Faculty of Computer Science</p>
                                </div>
                                <div class="col-lg-5 ml-auto" data-aos="fade-up" data-aos-delay="500">
                                    <form method="post"  action="{{ route('login') }}" class="form-box">
                                    @csrf
                                        <h3 class="h4 text-black mb-4">Sign In</h3>
                                        <div class="form-group">
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" class="btn btn-primary btn-pill" value="Sign In"></input>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection