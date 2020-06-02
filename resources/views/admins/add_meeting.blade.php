@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                @include('flash')
            </div>            
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Add Zoom Meeting</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.meetings.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Meeting Topic') }}</label>

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
                                <label for="agenda" class="col-md-4 col-form-label text-md-right">{{ __('Meeting Agenda') }}</label>

                                <div class="col-md-6">
                                    <textarea rows="3" id="agenda" type="text" class="form-control @error('agenda') is-invalid @enderror" name="agenda" required autocomplete="agenda" autofocus>{{ old('agenda') }}</textarea> 
                                    @error('agenda')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="start_time" class="col-md-4 col-form-label text-md-right">{{ __('Meeting Start Time') }}</label>

                                <div class="col-md-6">
                                     {{-- <div class="input-group p-0 shadow-sm"> --}}
                                        <input  onchange="(this.value.split('T')[0]);"  id="start_time" type="datetime-local" class="start_time form-control @error('start_time') is-invalid @enderror" name="start_time" value="{{ old('start_time') }}" required autocomplete="start_time" autofocus>

                                        {{-- <div class="input-group-append"><span class="input-group-text px-4"><i class="fa fa-calendar fa-1x"></i></span></div> --}}
                                    {{-- </div> --}}
                                    

                                    @error('start_time')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                           

                          

                            <div class="form-group row">
                                <label for="duration" class="col-md-4 col-form-label text-md-right">{{ __('Meeting Duration') }}</label>

                                <div class="col-md-6">
                                    <input id="duration" type="duration" class="form-control @error('duration') is-invalid @enderror" name="duration" value="{{ old('duration') }}" required autocomplete="duration" autofocus>

                                    <i style="font-size: 14px;float: right;color: #ff0000cf;font-weight: 500;">Time no more than 30 minutes.</i>
                                    @error('duration')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>                    



                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('SAVE') }}
                                    </button>
                                    <button type="reset" class="btn btn-info">
                                        {{ __('CLEAR') }}
                                    </button>                                 
                                    <a class="btn btn-danger" href="{{ route('admin.meetings.index') }}">
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
