@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @include('flash')
            </div>            
        </div>
    </div>
    <div class="container">
        <div class="row">      
            <div class="col-md-6"> 
                <h2>Teacher Lists</h2>
            </div>               
            <div class="col-md-6">                
                <a href="{{ route('admin.teachers.create') }}" class="btn btn-primary pull-right"><span class="fa fa-plus"></span> Add Teacher</a>
            </div>    
        </div>

        <hr>
        <div class="row">
            <div class="col-md-12">
              <table summary="This is table" class="table table-bordered table-hover dt-responsive" style="width: 100%">
              {{-- <table id="example" class="table table-striped table-bordered" style="width: 100%;"> --}}
                {{-- <caption class="text-center">An example of a responsive table based on <a href="https://datatables.net/extensions/responsive/" target="_blank">DataTables</a>:</caption> --}}
                <thead>
                      <tr>
                        <th>Name</th>
                        <th>DOB</th>
                        <th>Gender</th>
                        <th>Phone</th>
                        <th>Specialization</th>
                        <th><span class="fa fa-ellipsis-h"></span></th>
                      </tr>
                </thead>
                <tbody>
                    @if($teachers)
                    @foreach($teachers as $teacher)
                    <tr>
                        <td>{{ ucwords($teacher->name) }}</td>
                        <td>{{ $teacher->dob }}</td>
                        <td>@if($teacher->gender == 1) Male @elseif($teacher->gender == 2) Female  @endif</td>
                        <td>{{ $teacher->phone_no }}</td>
                        <td>{{ ucwords($teacher->specialization) }}</td>
                        <td>
                            {{-- <a type="button" class="btn btn-secondary btn-md" href=""><i class="fa fa-eye"></i></a> --}}
                            <a type="button" class="btn btn-primary btn-md" href="{{ route('admin.teachers.edit', $teacher->id) }}"><i class="fa fa-pencil"></i></a>
                            <a type="button" class="btn btn-danger btn-md" href="{{ route('admin.teachers.delete', $teacher->id) }}" onclick="return confirm('Are you sure')"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach
                    @endif                 
                </tbody>
              </table>
            </div>
        </div>
    </div>
    
@endsection
