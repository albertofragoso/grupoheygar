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
    <link rel="icon" href="http://grupoheygar.com/wp-content/uploads/2017/03/cropped-LOG.fw_-192x192.png" sizes="192x192" />

  </head>
  <body>
    <div class="page login-page">
      <div class="container">
        <div class="form-outer text-center d-flex align-items-center">
          <div class="form-inner">
            <div class="logo text-uppercase"><span>Grupo</span><strong class="text-primary">Heygar</strong></div>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud.</p>
            <div class="main">
              @yield('content')
            </div>
          </div>
          <div class="copyrights text-center">
            <p>Copyright © 2018. Todos los derechos reservados.</p>
          </div>
        </div>
      </div>
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
  </body>
</html>
