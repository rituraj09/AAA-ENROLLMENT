<nav class="navbar navbar-expand-md  navbar-dark bg-dark navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto"> 
                    <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
                      <a class="nav-link" href="{{url('')}}">Import <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item {{ Request::is('report') ? 'active' : '' }}">
                      <a class="nav-link" href="{{url('/report')}}">Report</a>
                    </li>
                  
                  </ul> 
                </div>
            </div>
        </nav>