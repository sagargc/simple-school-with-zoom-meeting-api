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
                    <div class="card-header">Update Subject</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.assignments.update') }}" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="id" value="{{ $assignment->student_id }}">
                            <div class="form-group row">
                                <label for="student_id" class="col-md-4 col-form-label text-md-right">{{ __('Student') }}</label>
                                <div class="col-md-6">
                                        <select class="custom-select d-block w-100" id="student_id" name="student_id" required="">
                                          <option value="">Choose...</option>
                                          @foreach($students as $student)
                                            <option value="{{ $student->id }}" @if($student->id == $assignment->student_id) selected="" @endif>{{ $student->name }}</option>
                                          @endforeach
                                        </select>
                                        <div class="invalid-feedback">
                                          Please select a valid student.
                                        </div>
                                    @error('student_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="subject_id" class="col-md-4 col-form-label text-md-right">{{ __('Subject Name') }}</label>
                                <div class="col-md-6">
                                        <select class="custom-select d-block w-100" id="subject_id" name="subject_id" required="">
                                          <option value="">Choose...</option>
                                          @foreach($subjects as $subject)
                                            <option value="{{ $subject->id }}" @if($subject->id ==  $assignment->subject_id) selected="" @endif>{{ $subject->name }}</option>
                                          @endforeach
                                        </select>
                                        <div class="invalid-feedback">
                                          Please select a valid subject.
                                        </div>
                                    @error('subject_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Assignment Title') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $assignment->name }}" required autocomplete="name" autofocus>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="detail" class="col-md-4 col-form-label text-md-right">{{ __('Detail') }}</label>

                                <div class="col-md-6">
                                    <textarea rows="5" id="detail" type="text" class="form-control @error('detail') is-invalid @enderror" name="detail" required autocomplete="detail" autofocus>{{ old('detail', $assignment->detail) }}</textarea>
                                    @error('detail')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            

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
                                <label for="document" class="col-md-4 col-form-label text-md-right">{{ __('Document') }}</label>
                                <div class="col-md-6">
                                    <input type="file" name="document" class="form-control-file" id="document" aria-describedby="fileHelp" >
                                    @error('document')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <small id="fileHelp" class="form-text text-muted text-xs">Please upload a valid image file. Size of image should not be more than 3MB.</small>
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
                                    <a class="btn btn-danger" href="{{ route('admin.assignments.index') }}">
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
