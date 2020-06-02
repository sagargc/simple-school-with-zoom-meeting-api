@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @include('flash')
            </div>            
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Update Teacher</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.teachers.update') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $teacher->id }}">
                            <input type="hidden" name="user_id" value="{{ $teacher->user_id }}">
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $teacher->name) }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="dob" class="col-md-4 col-form-label text-md-right">{{ __('Date of Birth') }}</label>

                                <div class="col-md-6">
                                     <div class="datepicker date input-group p-0 shadow-sm">
                                        <input id="dob" type="text" class="datepicker form-control @error('dob') is-invalid @enderror" name="dob" value="{{ old('dob', $teacher->dob) }}" required autocomplete="dob" autofocus>

                                        <div class="input-group-append"><span class="input-group-text px-4"><i class="fa fa-calendar fa-1x"></i></span></div>
                                    </div>

                                    @error('dob')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>
                                <div class="col-md-6">
                                        <select class="custom-select d-block w-100" id="gender" name="gender" required="">
                                          <option value="">Choose...</option>
                                          <option value="1" @if($teacher->gender == 1) selected="" @endif>Male</option>
                                          <option value="2" @if($teacher->gender == 2) selected="" @endif>Female</option>
                                        </select>
                                        <div class="invalid-feedback">
                                          Please select a valid country.
                                        </div>
                                    @error('gender')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="phone_no" class="col-md-4 col-form-label text-md-right">{{ __('Phone No.') }}</label>

                                <div class="col-md-6">
                                    <input id="phone_no" type="text" class="form-control @error('phone_no') is-invalid @enderror" name="phone_no" value="{{ old('phone_no', $teacher->phone_no) }}" required autocomplete="phone_no" autofocus>

                                    @error('phone_no')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" 
                                    type="email" 
                                    class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autofocus placeholder="{{ $teacher->email }}">
                                    <span><i>Current Email: </i>{{ $teacher->email }}</span>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                                <div class="col-md-6">
                                    <input id="address" type="address" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address', $teacher->address) }}" required autocomplete="address" autofocus>

                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="specialization" class="col-md-4 col-form-label text-md-right">{{ __('Specialization') }}</label>
                                <div class="col-md-6">
                                        <select class="custom-select d-block w-100" name="specialization" id="specialization" required="">
                                          <option value="">Choose...</option>
                                          <option value="math" @if($teacher->specialization == 'math') selected="" @endif>Math</option>
                                          <option value="english" @if($teacher->specialization == 'english') selected="" @endif>English</option>
                                          <option value="science" @if($teacher->specialization == 'science') selected="" @endif>Science</option>
                                          <option value="computer" @if($teacher->specialization == 'computer') selected="" @endif>Computer</option>
                                          <option value="social" @if($teacher->specialization == 'social') selected="" @endif>Social</option>
                                          <option value="other" @if($teacher->specialization == 'other') selected="" @endif>Other</option>
                                        </select>
                                        <div class="invalid-feedback">
                                          Please select a valid specialization.
                                        </div>
                                    @error('specialization')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="photo" class="col-md-4 col-form-label text-md-right">{{ __('Profile Photo') }}</label>
                                <div class="col-md-6">
                                    <input type="file" name="photo" class="form-control-file" id="phpto" aria-describedby="fileHelp">
                                    <small id="fileHelp" class="form-text text-muted">Please upload a valid image file. Size of image should not be more than 2MB.</small>
                                </div>
                            </div>


                            {{-- <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div> --}}

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('SAVE') }}
                                    </button>
                                    <button type="reset" class="btn btn-info">
                                        {{ __('CLEAR') }}
                                    </button>                                 
                                    <a class="btn btn-danger" href="{{ route('admin.teachers.index') }}">
                                        {{ __('GO BACK') }}
                                    </a>                                
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>        
@endsection
