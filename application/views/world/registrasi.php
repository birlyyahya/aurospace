<body class="layout-3 bg-dark">
  <div id="app">
    <div class="main-wrapper">
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">

          <div class="row">
            <div class="col-12 col-sm-2 offset-sm-1 col-md-4 offset-md-2 col-lg-4 offset-lg-2 col-xl-4 offset-xl-" style="margin-left: 3%; ">
              <div class="text-right">
                <img src="<?= base_url('assets') ?>/assets/img/aurospace.png" alt="logo" width="80" class="shadow-light rounded-circle mb-5 mt-2">
              </div>
              <div class="text-right">
                <h4 class="text-light font-weight-normal">Welcome to <span class="font-weight-bold">Aurospace</span></h4>
                <p class="text-muted">Before you get started, you must login or register if you don't already have an account.</p>
                <a href="<?= base_url('world/login') ?>">
                  <div class="btn btn-primary">Already Have Account?</div>
                </a>
              </div>

            </div>
            <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-6 offset-xl-1 align" style="margin-left: 3%;">
              <div class="card card-primary">
                <div class="card-header">
                  <h4>Register</h4>
                </div>
                <div class="card-body">
                  <form method="POST" action="<?= site_url('world/aksi_regis'); ?>">
                    <div class="row">
                      <div class="form-group col-6">
                        <label for="nama">Nama Lengkap</label>
                        <input id="nama" type="text" class="form-control" name="nama" value="<?= set_value('nama') ?>" autofocus>
                        <?php echo form_error('nama', '<div class="error text-danger">', '</div>'); ?>
                      </div>
                      <div class="form-group col-6">
                        <label for="email">Email</label>
                        <input id="email" type="email" class="form-control" name="email" value="<?= set_value('email') ?>">
                        <?php echo form_error('email', '<div class="error text-danger">', '</div>'); ?>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="username">Username</label>
                      <input id="username" type="text" class="form-control" name="username" value="<?= set_value('username') ?>">
                      <?php echo form_error('username', '<div class="error text-danger">', '</div>'); ?>
                      <div class="invalid-feedback">
                      </div>
                    </div>

                    <div class="row">
                      <div class="form-group col-6">
                        <label for="password" class="d-block">Password</label>
                        <input id="password" type="password" class="form-control pwstrength" data-indicator="pwindicator" name="password">
                        <?php echo form_error('password', '<div class="error text-danger">', '</div>'); ?>
                        <div id="pwindicator" class="pwindicator">
                          <div class="bar"></div>
                          <div class="label"></div>
                        </div>
                      </div>
                      <div class="form-group col-6">
                        <label for="password_confirm" class="d-block">Password Confirmation</label>
                        <input id="password_confirm" type="password" class="form-control" name="password_confirm">
                        <?php echo form_error('password_confirm', '<div class="error text-danger">', '</div>'); ?>
                      </div>
                    </div>

                    <div class="form-divider text-light">
                      Your Home
                    </div>
                    <div class="row">
                      <div class="form-group col-12">
                        <label for="alamat">Alamat</label>
                        <input id="alamat" type="text" class="form-control" name="alamat" value="<?= set_value('alamat') ?>">
                        <div class="invalid-feedback">
                          <?php echo form_error('alamat', '<div class="error text-danger">', '</div>'); ?>
                        </div>
                      </div>
                      <div class="form-group col-6">
                        <label>Kota</label>
                        <select class="form-control selectric" name="kota">
                          <?php foreach ($kota as $k) : ?>
                            <option value="<?= $k->idkota ?>" Selected><?= $k->namakota ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                      <div class="form-group col-6">
                        <label>No Telpon</label>
                        <input type="telp" id="no_telpon" class="form-control" name="no_telpon" value="<?= set_value('nama') ?>">
                        <?php echo form_error('no_telpon', '<div class="error text-danger">', '</div>'); ?>
                      </div>
                    </div>

                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-lg btn-block">
                        Register
                      </button>
                    </div>
                  </form>
                </div>
              </div>

            </div>


          </div>
        </section>
      </div>
    </div>

    <footer class="main-footer">
      <div class="footer-left">
        Copyright &copy; 2018 <div class="bullet"></div> Design By <a href="https://nauval.in/">Muhamad Nauval Azhar</a>
      </div>
      <div class="footer-right">
        2.3.0
      </div>
    </footer>
  </div>