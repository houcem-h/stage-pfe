<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="CoreUI Bootstrap 4 Admin Template">
  <meta name="author" content="Lukasz Holeczek">
  <meta name="keyword" content="Login StagePFE">
  <!-- <link rel="shortcut icon" href="assets/ico/favicon.png"> -->

  <title>.: Login :.</title>

  <!-- Icons -->
  <link href="{{ asset('dashboard_assets/node_modules/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
  <link href="{{ asset('dashboard_assets/node_modules/simple-line-icons/css/simple-line-icons.css') }}" rel="stylesheet">

  <!-- Main styles for this application -->
  <link href="{{ asset('dashboard_assets/css/style.css') }}" rel="stylesheet">

  <!-- Styles required by this views -->

</head>

<body class="app flex-row align-items-center">
  
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card-group">
          <div class="card p-4">
            <div class="card-body">
                <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}
              <h1>Login</h1>
              <p class="text-muted">Sign In - As Admin</p>
              <div class="input-group mb-3">
                <span class="input-group-addon"><i class="icon-user"></i></span>
                <input type="text" name="email" class="form-control" placeholder="Email">
              </div>
              <div class="input-group mb-4">
                <span class="input-group-addon"><i class="icon-lock"></i></span>
                <input type="password" name="password" class="form-control" placeholder="Password">
              </div>
              <div class="row">
                <div class="col-6">
                  <button type="submit" class="btn btn-primary px-4">Login</button>
                </div>
                <div class="col-6 text-right">
                  <a class="btn btn-link px-0" href="{{ route('password.request') }}">Forgot password?</a>
                </div>
              </div>
            </form>
            </div>
          </div>
          <div class="card text-white bg-primary py-5 d-md-down-none" style="width:44%">
            <div class="card-body text-center">
              <div>
                <h2>Sign up</h2>
                <p><br>You Don't Have an account ? No Problem <br> Click Here To Create Your Account</p>
                <a href="{{ route('register') }}" class="btn btn-primary active mt-3">Register Now!</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap and necessary plugins -->
  <script src="{{ asset('dashboard_assets/node_modules/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('dashboard_assets/node_modules/popper.js/dist/umd/popper.min.js') }}"></script>
  <script src="{{ asset('dashboard_assets/node_modules/bootstrap/dist/js/bootstrap.min.js') }}"></script>

</body>
</html>