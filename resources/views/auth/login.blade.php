<!DOCTYPE html>
<html lang="en" class="light-style layout-wide customizer-hide" dir="ltr" data-theme="theme-default"
  data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
  <meta charset="utf-8" />
  <meta name="viewport"
    content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title>Login</title>

  <meta name="description" content="" />
  <link rel="icon" type="image/x-icon" href="{{ asset('assets-auth/img/favicon/favicon.ico') }}" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
    rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('assets/compiled/css/app.css') }}">
  <link rel="stylesheet" href="{{ asset('assets-auth/vendor/fonts/boxicons.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets-auth/vendor/css/core.css') }}" class="template-customizer-core-css" />
  <link rel="stylesheet" href="{{ asset('assets-auth/vendor/css/theme-default.css') }}"
    class="template-customizer-theme-css" />
  <link rel="stylesheet" href="{{ asset('assets-auth/css/demo.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets-auth/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets-auth/vendor/css/pages/page-auth.css') }}" />
  <script src="{{ asset('assets-auth/vendor/js/helpers.js') }}"></script>
  <script src="{{ asset('assets-auth/js/config.js') }}"></script>
</head>

<body class="overflow-hidden">
  <!-- Content -->
  <div class="row vh-100">
    <div class="col-lg-5 col-12 bg-primary-subtle position-relative">
      <img src="{{ asset('assets/compiled/png/logo-colored.png') }}" alt="Logo" class="position-absolute w-25 m-5">
      <div class="h-100 px-5" style="place-content: center">
        <h1>Login</h1>
        <p class="mb-5">
          Login untuk melanjutkan ke dalam dashboard!
        </p>

        @if (session('error'))
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Gagal!</strong>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif

        @error('email')
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Gagal!</strong>
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @enderror

        @error('password')
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Gagal!</strong>
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @enderror

        <form action="{{ route('login') }}" method="POST">
          @csrf
          <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control form-control-xl @error('email') is-invalid @enderror"
              id="email" name="email" aria-describedby="Email" placeholder="user@example.com">
          </div>

          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control form-control-xl @error('password') is-invalid @enderror"
              id="password" name="password" aria-describedby="Password" placeholder="********">
          </div>

          <button type="submit" class="btn btn-primary btn-block btn-lg mt-3 shadow-lg">Masuk</button>
        </form>
      </div>
    </div>

    <div class="col-lg-7 d-none d-lg-block h-100" style="background-image: url('{{ asset('assets-auth/img/backgrounds/bglogin.jpg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
    </div>
  </div>

  <script src="{{ asset('assets-auth/vendor/libs/jquery/jquery.js') }}"></script>
  <script src="{{ asset('assets-auth/vendor/libs/popper/popper.js') }}"></script>
  <script src="{{ asset('assets-auth/vendor/js/bootstrap.js') }}"></script>
  <script src="{{ asset('assets-auth/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
  <script src="{{ asset('assets-auth/vendor/js/menu.js') }}"></script>
  <script src="{{ asset('assets-auth/js/main.js') }}"></script>
  <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>
