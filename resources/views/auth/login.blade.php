<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>DINDIK | Mutasi</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  
  <!-- Modern CSS -->
  <link rel="stylesheet" href="{{ asset('css/modern.css') }}">

  <link rel="shortcut icon" href="{{ asset('admin/images/logo_trenggalek.ico') }}" type="image/x-icon">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <style>
  body {
    margin: 0;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .content-card {
    width: 100%;
    max-width: 400px;
    border-radius: 12px;
    padding: 35px 30px;
  }

  .login-logo {
    text-align: center;
    margin-bottom: 20px;
  }

  .login-logo img {
    height: 80px;
    margin-bottom: 10px;
  }

  .content-card-title {
    text-align: center;
    font-size: 16px;
    color: #666;
    margin-bottom: 25px;
  }

  .form-group {
    margin-bottom: 18px;
  }

  .form-control {
    height: 45px;
    border-radius: 8px;
    border: 1px solid #ddd;
    padding: 10px 14px;
    font-size: 14px;
  }

  .form-control:focus {
    border-color: #2a5298;
    box-shadow: 0 0 0 2px rgba(42,82,152,.15);
  }

  .help-block {
    font-size: 12px;
    color: #e74c3c;
    margin-top: 4px;
    margin-left: 5px;
  }

  @keyframes fadeInDown {
      from {
        opacity: 0;
        transform: translateY(-20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
</style>

</head>
<body>
  <div class="content-card">
    <div class="login-logo">
      <img alt="Logo Trenggalek" src="{{ asset('admin/images/logo_trenggalek.png') }}" height="100"/>
    </div>

    <div class="detail-card">
      <p class="content-card-title">Sign in to start your session</p>

      <form action="{{ route('login') }}" method="POST">
        {{ csrf_field() }}
        
        <div class="form-group">
          <input id="email" type="text" placeholder="Enter your Username" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
          @if ($errors->has('email'))
          <span class="help-block">
            <strong>{{ $errors->first('email') }}</strong>
          </span>
          @endif
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>

        <div class="form-group">
          <input id="password" type="password" placeholder="Enter your password" class="form-control" name="password" required>
          @if ($errors->has('password'))
          <span class="help-block">
            <strong>{{ $errors->first('password') }}</strong>
          </span>
          @endif
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>

        <div class="row">
          <div class="col-xs-4">
            <button type="submit" class="btn-modern btn-primary-modern">Sign In</button>
          </div>
        </div>
      </form>

    </div>
  </div>

  <!-- jQuery 3 -->
  <script src="{{ asset('admin/bower_components/jquery/dist/jquery.min.js') }}"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="{{ asset('admin/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
  <!-- iCheck -->
  <script src="{{ asset('admin/plugins/iCheck/icheck.min.js') }}"></script>
  <script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%'
    });
  });
  </script>
</body>
</html>