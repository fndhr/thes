@extends('layouts.app')

@section('content')
<div data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
    <div class="site-wrap">
        <div class="intro-section" id="home-section">
            <div class="slide-1" data-stellar-background-ratio="0.5">
                <div class="container" style="background: none;">
                    <div class="row align-items-center">
                        <div class="col-12">
                            <div class="row align-items-center">
                                <div class="col-lg-6 mb-4">
                                    <h1 data-aos="fade-up" data-aos-delay="100">Thesis and Defense Manager</h1>
                                    <h6 class="text-white mb-4" data-aos="fade-up" data-aos-delay="200">President University - Faculty of Computer Science</h6>
                                </div>
                                <div class="col-lg-5 ml-auto" data-aos="fade-up" data-aos-delay="500">
                                    <form method="post" action="{{ route('login') }}" class="form-box">
                                        @csrf
                                        <div class="text-center mb-5">
                                            <img src="/assets/image/user_navbar.png" width="50" height="50" alt="">
                                            <h4 class="text-black">SIGN IN</h4>
                                        </div>
                                        <div class="form-group">
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Please Input Your Email" autofocus>
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required placeholder="Please Input Your Password" autocomplete="current-password">
                                                <div class="input-group-append">
                                                    <span class="input-group-text myEye"><em class="fas fa-eye"></em></span>
                                                </div>
                                            </div>
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group text-center mt-5">
                                            <input type="submit" class="btn btn-success btn-pill px-5"
                                                value="Sign In"></input>
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
