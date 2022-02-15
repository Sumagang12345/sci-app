<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} | @yield('page-title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="stylesheet" href="https://unpkg.com/sleek-dashboard/dist/assets/css/sleek.min.css">
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.4.95/css/materialdesignicons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    @stack('page-css')
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }
    </style>

</head>
<body onload="setInterval(function(){ if(window.navigator.onLine == true){ document.getElementById('connections').setAttribute('src','{{url('assets/images/connected.png')}}'); }else{ document.getElementById('connections').setAttribute('src','{{url('assets/images/disconnected.png')}}'); }}, 1000);">
    <body class="header-fixed sidebar-fixed sidebar-dark header-light" id="body">
  <div class="wrapper">
    <!-- left-sidebar -->
     <aside class="left-sidebar bg-sidebar">
       <div id="sidebar" class="sidebar sidebar-with-footer">
         <!-- Logo -->
         <div class="app-brand">
           <a href="javascript:void(0)" title="Sleek Dashboard">
             <svg class="brand-icon" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" width="30" height="33" viewBox="0 0 30 33"><g fill="none" fill-rule="evenodd"><path class="logo-fill-blue" fill="#7DBCFF" d="M0 4v25l8 4V0zM22 4v25l8 4V0z"/><path class="logo-fill-white" fill="#FFF" d="M11 4v25l8 4V0z"/></g></svg>
             <span class="brand-name text-truncate">{{ config('app.name') }}</span>
           </a>
         </div>

         <!-- begin sidebar scrollbar -->
         <div class="sidebar-scrollbar">
           <!-- sidebar menu -->
           <ul class="nav sidebar-inner" id="sidebar-menu">
             <li class="has-sub active expand" >
                <a class="sidenav-item-link" href="{{ route('home') }}">
                  <i class="mdi mdi-view-dashboard-outline"></i>
                    Dashboard
                </a>
            </li>

               <li class="has-sub">
                 <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#app" aria-expanded="false" aria-controls="app">
                   <i class="mdi mdi-pencil-box-multiple"></i>
                   <span class="nav-text">SCI Data</span> <b class="caret"></b>
                 </a>

                 <ul class="collapse" id="app" data-parent="#sidebar-menu">
                   <div class="sub-menu">
                     <li>
                       <a class="sidenav-item-link" href="{{ url('import_export'); }}"><span class="nav-text">Import / Export Data</span></a>
                     </li>

                     <li>
                       <a class="sidenav-item-link" href="{{ url('post'); }}"><span class="nav-text">Employee List</span></a>
                     </li>
                   </div>
                 </ul>
               </li>

               {{-- <li class="has-sub">
                 <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#tables" aria-expanded="false" aria-controls="tables">
                   <i class="mdi mdi-table"></i>
                   <span class="nav-text">Nav 3</span> <b class="caret"></b>
                 </a>

                 <ul class="collapse" id="tables" data-parent="#sidebar-menu">
                   <div class="sub-menu">
                     <li>
                       <a class="sidenav-item-link" href="javascript:void(0)"><span class="nav-text">Sub nav 1</span></a>
                     </li>

                     <li class="has-sub">
                       <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#data-tables" aria-expanded="false" aria-controls="data-tables">
                         <span class="nav-text">Sub nav 2</span> <b class="caret"></b>
                       </a>

                       <ul class="collapse" id="data-tables">
                         <div class="sub-menu">
                           <li>
                             <a href="javascript:void(0)">Child Sub nav 1</a>
                           </li>

                           <li>
                             <a href="javascript:void(0)">Child Sub nav 2</a>
                           </li>
                          </div>
                        </ul>
                      </li>
                     </div>
                    </ul>
                  </li> --}}
                </ul>
              </div>
            </div>
          </aside>

          <div class="page-wrapper">
            <!-- Header -->
            <header class="main-header " id="header">
              <nav class="navbar navbar-static-top navbar-expand-lg pr-0">
              <!-- Sidebar toggle button -->
              <button id="sidebar-toggler" class="sidebar-toggle">
                <span class="sr-only">Toggle navigation</span>
              </button>&nbsp;&nbsp;
              <img id="connections" alt="Image" src="{{url('assets/images/connected.png')}}" width="4%"/> 
              <!-- search form -->
              <div class="search-form d-none d-lg-inline-block">
                <div class="input-group">


                 </div>
                </div>

                <div class="navbar-right ">
                  <ul class="nav navbar-nav">
                    <!-- User Account -->
                    <li class="dropdown user-menu">
                    <button href="#" class="dropdown-toggle nav-link" id="dropdownMenuLink" data-toggle="dropdown">
                      {{-- <img src="https://sleek.tafcoder.com/assets/img/user/user.png" class="user-image" alt="User Image" /> --}}
                      <span class="d-none d-lg-inline-block">{{ Auth::user()->name }}</span>

                    </button>
                     <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="#">Account Setting</a>
                        <a class="dropdown-item" href="{{ url('/logout') }}">Logout</a>
                      </div>
                  </li>
                  </ul>
                </div>
              </nav>
            </header>

            <div class="p-3">
              @yield('content')
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://unpkg.com/sleek-dashboard/dist/assets/js/sleek.bundle.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @include('sweetalert::alert')
    @stack('page-scripts')
</body>
</html>
