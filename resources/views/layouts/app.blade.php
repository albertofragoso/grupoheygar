<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title', 'Heygar')</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="https://d19m59y37dris4.cloudfront.net/dashboard-premium/1-3/css/fontastic.css">
    <link rel="icon" href="http://grupoheygar.com/wp-content/uploads/2017/03/cropped-LOG.fw_-192x192.png" sizes="192x192" />

    <script src="{{ mix('js/app.js') }}"></script>

  </head>
  <body>
    <!-- Side Navbar -->
    <nav class="side-navbar">
      <div class="side-navbar-wrapper">
        <!-- Sidebar Header    -->
        <div class="sidenav-header d-flex align-items-center justify-content-center">
          <!-- User Info-->
          <div class="sidenav-header-inner text-center">
            <img src="{{ Auth::user()->image }}" alt="person" class="img-fluid rounded-circle">
            <h2 class="h5">{{ Auth::user()->name }}</h2><span>{{ Auth::user()->roll ? "Admin" : "Cliente" }}</span>
          </div>
          <!-- Small Brand information, appears on minimized sidebar-->
          <div class="sidenav-header-logo"><a href="/admin" class="brand-small text-center"> <strong style="color:#FFFFFF">G</strong><strong class="text-primary">H</strong></a></div>
        </div>
        <!-- Sidebar Navigation Menus-->
          <div class="main-menu">
            <h5 class="sidenav-heading">Menú</h5>
            <ul id="side-main-menu" class="side-menu list-unstyled">
              @if (Auth::user()->roll)
                <li><a href="/admin"> <i class="icon-home"></i>Home </a></li>
                <li><a href="/customers"> <i class="icon-grid"></i>Clientes </a></li>
                <li><a href="#formsDropdown" aria-expanded="false" data-toggle="collapse" class="collapsed"> Trabajos</a>
                  <ul id="formsDropdown" class="list-unstyled collapse" style="">
                    <li><a href="/products">En proceso</a></li>
                    <li><a href="/products/done">Terminados</a></li>
                  </ul>
                </li>
              @else
                <li><a href="/customers/{{ Auth::user()->id }}"> <i class="icon-user"></i>Mi cuenta </a></li>
              @endif
            </ul>
          </div>
        <div class="admin-menu">
          <h5 class="sidenav-heading">Redes sociales</h5>
          <ul id="side-admin-menu" class="side-menu list-unstyled">
            <li><a href="https://www.facebook.com/Lonas-Heygar-158748178254821/" target="_blank"> <i class="icon-fb"> </i>Facebook</a></li>
            <li><a href="#"> <i class="icon-twitter"> </i>Twitter</a></li>
            <li> <a href="https://www.instagram.com/explore/locations/164824133531446/grupo-heygar/" target="_blank"> <i class="icon-instagram"> </i>Instagram</a></li>
          </ul>
        </div>
      </div>
    </nav>
    <div class="page" id="app">
      <!-- navbar-->
      <header class="header">
        <nav class="navbar">
          <div class="container-fluid">
            <div class="navbar-holder d-flex align-items-center justify-content-between">
              <div class="navbar-header"><a id="toggle-btn" href="#" class="menu-btn"><i class="icon-bars"> </i></a><a href="index.html" class="navbar-brand">
                  <div class="brand-text d-none d-md-inline-block"><span>Grupo </span><strong class="text-primary">Heygar</strong></div></a></div>
              <!--Notificaciones-->
              <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                @if (Auth::guest())
                  <li class="nav-item"><a href="{{ route('login') }}" class="nav-link logout">Entrar<i class="fa fa-sign-out"></i></a></li>
                @else
                  <li class="nav-item dropdown"> <a id="notifications" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link"><i class="icon-mail"></i><span class="badge badge-warning">{{ $count }}</span></a>
                  <ul aria-labelledby="notifications" class="dropdown-menu">
                    @forelse ($notifications as $notification)
                      <li>
                        <a rel="nofollow" href="/products/{{ $notification->data["product"]["id"] }}" class="dropdown-item">
                          <div class="notification d-flex justify-content-between">
                            <div class="notification-content"><i class="icon-rss-feed"></i>Se ha actualizado el pedido: <br><small>{{ $notification->data["product"]["name"] }}</small></div>
                            <div class="notification-time"><small>{{ $notification->created_at->toDateString() }}</small></div>
                          </div>
                        </a>
                      </li>
                    @empty
                      <li>Aún no tienes notificaciones</li>
                      <br>
                    @endif
                    <li>
                      <a rel="nofollow" href="/notifications" class="dropdown-item all-notifications text-center"> <strong><i class="icon-rss-feed"></i>Ver todas tus notificaciones</strong></a>
                    </li>
                  </ul>
                  <!--Fin notificaciones-->
                  <li class="nav-item dropdown"> <a id="logout" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link">{{ Auth::user()->name }} <i class="icon-user"></i></a>
                    <ul aria-labelledby="notifications" class="dropdown-menu">
                        <li><a rel="nofollow" href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                          <div class="msg-body">
                            <strong><i class="icon-close"></i> Salir</strong>
                          </div></a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                        </li>
                    </ul>
                  </li>
                @endif
              </ul>
            </div>
          </div>
        </nav>
      </header>
      <div class="main">
        @yield('content')
      </div>
      <footer class="main-footer">
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-6">
              <p>Grupo Heygar &copy; 2018</p>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </body>
</html>
