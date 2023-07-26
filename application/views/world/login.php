<body>
  <div id="app">
    <section class="section">
      <div class="d-flex flex-wrap align-items-stretch">
        <div class="col-lg-4 col-md-6 col-12 order-lg-1 min-vh-100 order-2 bg-dark">
          <div class="p-4 m-3">
            <img src="<?= base_url('assets') ?>/assets/img/aurospace.png" alt="logo" width="80" class="shadow-light rounded-circle mb-5 mt-2">
            <h4 class="text-light font-weight-normal">Welcome to <span class="font-weight-bold">Aurospace</span></h4>
            <p class="text-muted">Before you get started, you must login or register if you don't already have an account.</p>
            <form method="POST" action="<?= site_url('world/aksi_login'); ?>" class="needs-validation" novalidate="">
              <?= $this->session->flashdata('message'); ?>
              <div class="form-group">
                <label for="username" class="text-light">Username</label>
                <input id="username" type="username" class="form-control" name="username" tabindex="1" required autofocus>
                <div class="invalid-feedback">
                  Please fill in your email
                </div>
              </div>

              <div class="form-group">
                <div class="d-block">
                  <label for="password" class="control-label text-light">Password</label>
                </div>
                <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                <div class="invalid-feedback">
                  please fill in your password
                </div>
              </div>

              <div class="form-group">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                  <label class="custom-control-label" for="remember-me">Remember Me</label>
                </div>
              </div>

              <div class="form-group text-right">
                <a href="auth-forgot-password.html" class="float-left mt-3">
                  Forgot Password?
                </a>
                <button type="submit" class="btn btn-primary btn-lg btn-icon icon-right" tabindex="4">
                  Login
                </button>
              </div>

              <div class="mt-5 text-center">
                Don't have an account? <a href="<?= base_url('world/regis') ?>">Create new one</a>
              </div>
            </form>

            <div class="text-center mt-5 text-small">
              Copyright &copy; Your Company. Made with 💙 by Stisla
              <div class="mt-2">
                <a href="#">Privacy Policy</a>
                <div class="bullet"></div>
                <a href="#">Terms of Service</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-8 col-12 order-lg-2 order-1 min-vh-100 background-walk-y position-relative overlay-gradient-bottom" data-background="<?= base_url('assets') ?>/assets/img/space.jpg">
          <div class="absolute-bottom-left index-2">
            <div class="text-light p-5 pb-2">
              <div class="mb-5 pb-3">
                <h1 class="mb-2 display-4 font-weight-bold">Proxima Centaury</h1>
                <h5 class="font-weight-normal text-muted-transparent">Aurora Space, Centaurus Galaxy</h5>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>