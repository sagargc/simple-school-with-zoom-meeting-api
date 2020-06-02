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
                <h2>Zoom Meeting Lists</h2>
            </div>               
            <div class="col-md-6">                
                <a href="{{ route('admin.meetings.create') }}" class="btn btn-primary pull-right"><span class="fa fa-plus"></span> Add Meeting</a>
            </div>    
        </div>
        {{-- {{ dd($meetings) }} --}}
        <hr>
        <div class="row">
            <div class="col-md-12">
              <table summary="This is table" class="table table-bordered table-hover dt-responsive" style="width: 100%">
              {{-- <table id="example" class="table table-striped table-bordered" style="width: 100%;"> --}}
                {{-- <caption class="text-center">An example of a responsive table based on <a href="https://datatables.net/extensions/responsive/" target="_blank">DataTables</a>:</caption> --}}
                <thead>
                      <tr>
                        <th>Meeting Topic</th>
                        <th>Start Time</th>
                        <th>Agenda</th>
                        <th>Duration</th>
                        <th>Meeting Link</th>
                        <th><span class="fa fa-ellipsis-h"></span></th>
                      </tr>
                </thead>
                <tbody>
                    @if($meetings)
                    @foreach($meetings as $meeting)
                    <tr>
                        <td>{{ ucwords($meeting->topic) }}</td>
                        <td>{{ $meeting->start_time }}</td>
                        <td>{{ ucwords($meeting->agenda) }}</td>
                        <td>{{ $meeting->duration}} Min </td>
                        <td>
                            <a href="{{ $meeting->join_url }}" target="_blank" class="btn btn-success">Open Link</a>
                            <a class="btn btn-info copy_text" href="{{ $meeting->join_url }}" data-toggle="tooltip" title="Copy to Clipboard" class="btn btn-info">Copy Link</a>                            
                        </td>
                        <td>
                            {{-- <a type="button" class="btn btn-secondary btn-md" href=""><i class="fa fa-eye"></i></a> --}}
                            <a title="End the meeting!!" type="button" class="btn btn-primary btn-md" href="{{ route('admin.meetings.end', $meeting->id) }}"><i class="fa fa-remove"></i></a>     
                            <a type="button" class="btn btn-primary btn-md" href="{{ route('admin.meetings.edit', $meeting->id) }}"><i class="fa fa-pencil"></i></a>
                            <a type="button" class="btn btn-danger btn-md" href="{{ route('admin.meetings.delete', $meeting->id) }}" onclick="return confirm('Are you sure')"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach
                    @endif                 
                </tbody>
              </table>
            </div>
        </div>
    </div>
    {{-- Iframe Embbed --}}
    {{-- <div class="iframe-container" style="overflow: hidden; padding-top: 56.25%; position: relative;">
        <iframe allow="microphone; camera" style="border: 0; height: 100%; left: 0; position: absolute; top: 0; width: 100%;" src="https://success.zoom.us/wc/join/{{ $meeting->id }}" frameborder="0"></iframe>
    </div>
     --}}
  
@endsection
