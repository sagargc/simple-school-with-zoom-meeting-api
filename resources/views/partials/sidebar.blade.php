  <div class="bg-light border-right" id="sidebar-wrapper">
      <div class="sidebar-heading">  
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a> 
      </div>
      <div class="list-group list-group-flush">
        <a href="{{ url('/') }}" class="list-group-item list-group-item-action bg-light">Dashboard</a>
        @if(Auth::user()->isAdmin())
        <a href="{{ route('admin.teachers.index') }}" class="list-group-item list-group-item-action bg-light">Teachers</a>
        <a href="{{ route('admin.students.index') }}" class="list-group-item list-group-item-action bg-light">Students</a>
        <a href="{{ route('admin.subjects.index') }}" class="list-group-item list-group-item-action bg-light">Subjects</a>
        <a href="{{ route('admin.assignments.index') }}" class="list-group-item list-group-item-action bg-light">Assignments</a>
        @endif
        @if(Auth::user()->isTeacher())
        <a href="{{ route('teacher.assignments.index') }}" class="list-group-item list-group-item-action bg-light">Assignments</a>
        @endif
        @if(Auth::user()->isStudent())
        <a href="{{ route('student.assignments.index') }}" class="list-group-item list-group-item-action bg-light">Assignments</a>
        @endif
        @if(Auth::user()->isAdmin())
        <a href="{{ route('admin.meetings.index') }}" class="list-group-item list-group-item-action bg-light">Live Class</a>
        @endif 
        @if(Auth::user()->isTeacher())
        <a href="{{ route('teacher.meetings.index') }}" class="list-group-item list-group-item-action bg-light">Live Class</a>
        @endif
        @if(Auth::user()->isStudent())
        <a href="{{ route('student.meetings.index') }}" class="list-group-item list-group-item-action bg-light">Live Class</a>
        @endif
      </div>
    </div>
