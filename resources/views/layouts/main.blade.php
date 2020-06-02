<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    <!-- Bootstrap core CSS -->
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link rel='stylesheet' href='https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css'>
  <link rel='stylesheet' href='https://cdn.datatables.net/responsive/2.2.4/css/responsive.bootstrap4.min.css '>
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">

</head>

<body>

  <div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    @include('partials.sidebar')
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">

      <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <button class="btn btn-primary" id="menu-toggle">Toggle Menu</button>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">


           {{--  <li class="nav-item active">
              <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li> --}}

            <!-- Authentication Links -->
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest


          </ul>
        </div>
      </nav>

      <main class="py-4">
        @yield('content')
      </main>
    
    </div>
    <!-- /#page-content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Bootstrap core JavaScript -->

  <!-- Scripts -->

  <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
  {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
  <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>


<script src='https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js'></script>
<script src='https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js'></script>
<script src='https://cdn.datatables.net/responsive/2.2.4/js/dataTables.responsive.min.js'></script>
<script src='https://cdn.datatables.net/responsive/2.2.4/js/responsive.bootstrap4.min.js '></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js'></script>



  <!-- Menu Toggle Script -->


  <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
    $('table').DataTable();
  </script>

  <script type="text/javascript">
  $(function () {

      // INITIALIZE DATEPICKER PLUGIN
      $('.datepicker').datepicker({
          clearBtn: true,
          format: "yyyy-mm-dd"
      });


      // FOR DEMO PURPOSE
      $('#reservationDate').on('change', function () {
          var pickedDate = $('input').val();
          $('#pickedDate').html(pickedDate);
      });

      $('.start_time').on('change', function() {
        var parsed = new Date(this.value);
        var ten    = function(x) { return x < 10 ? '0'+x : x};
        var date   = parsed.getFullYear() + '-' + (parsed.getMonth() + 1) + '-' + parsed.getDate();
        var time   = ten( parsed.getHours() ) + ':' + ten( parsed.getMinutes() );
        // $('#start_time').appendVal(date + time)
        // console.log( date + ', ' + time)
      });
  });

  </script>

    <script>
        $('.copy_text').click(function (e) {
           e.preventDefault();
           var copyText = $(this).attr('href');

           document.addEventListener('copy', function(e) {
              e.clipboardData.setData('text/plain', copyText);
              e.preventDefault();
           }, true);

           document.execCommand('copy');  
           // console.log('copied text : ', copyText);
           alert('copied text: ' + copyText)
         })
    </script>

</body>

</html>
