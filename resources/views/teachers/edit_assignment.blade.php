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
                    <div class="card-header">Update Assignment</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('teacher.assignments.update') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $assignment->student_id }}">
                            
                            <div class="form-group row">
                                <label for="feedback" class="col-md-4 col-form-label text-md-right">{{ __('Feedback') }}</label>

                                <div class="col-md-6">
                                    <textarea rows="5" id="feedback" type="text" class="form-control @error('feedback') is-invalid @enderror" name="feedback" required autocomplete="feedback" autofocus>{{ old('feedback', $assignment->feedback) }}</textarea>
                                    @error('feedback')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="status" id="status" {{ old('status',$assignment->status == 1) ? 'checked' : '' }}>

                                        <label class="form-check-label" for="status">
                                            {{ __('Status') }}
                                        </label>
                                    </div>
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
                                    <a class="btn btn-danger" href="{{ route('student.assignments.index') }}">
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
