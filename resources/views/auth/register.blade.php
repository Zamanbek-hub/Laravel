@extends('layouts.layout')

@section('head_links')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <link href="{{ asset('css/register.css') }}" rel="stylesheet">
@endsection

@section('content')
<body style="background-image: url('img/bg-applicant-asia-1__min_.jpg');">  
    <section id="cover" class="min-vh-100" >
        <div id="cover-caption">
            <div class="container ">
                <div class="row text-white ">
                    <div class="col-md-6-offset-12 mx-auto text-center ">
                        <h4 class="display-4 py-2 text-truncate mb-5 mt-3">Registration</h4>
                        <div class="px-2">
                            <form  method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="form-group">
                                    <input type="text" id="surname" class="form-control" name="surname" placeholder="Surname">
                                </div>
                                <div class="form-group">
                                    <input type="text" id="name" class="form-control" name="name" placeholder="Name">
                                </div>
                                <div class="form-group">
                                    <input type="email" id="email" class="form-control" name="email" placeholder="Email Address">
                                </div>
                                <div class="form-group">
                                    <input type="tel" id="phone_number" class="form-control" name="phone_number" placeholder="Phone number" pattern="[7-8]{1}-[0-9]{3}-[0-9]{3}-[0-9]{2}-[0-9]{2}" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" id="company_name" class="form-control" name="company_name" placeholder="Company Name ">
                                </div>
                                <div class="form-group">
                                
                                    <select type="text" id="region" class="form-control" name="region" placeholder="Region ">
                                    
                                        <option value="1">Алматы</option>
                                  
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" name="password" placeholder="Password" required autocomplete="new-password">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm password" required autocomplete="new-password">
                                </div>
                                <button type="submit" class="btn btn-outline mt-4 " style="color:#fff; border-color: #fff; ">Sign up</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
        <!-- <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('Register') }}</div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf

                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                    <div class="col-md-6">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Register') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
</body>
@endsection
