<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Profile</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item">Profile</div>
            </div>
        </div>
        <div class="section-body">
            <h2 class="section-title">Hi, Pet Lovers!</h2>
            <p class="section-lead">
                Change information about yourself on this page.
            </p>
            <div class="col-12 col-md-12 col-lg-7">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Profile</h4>
                    </div>
                    <form method="post" action="<?= site_url("Profile") ?>">
                        <div class="card-body">
                            <!--awal card-body-->
                            <div class="row">
                                <div class="form-group col-md-6 col-12">
                                    <label>username</label>
                                    <input type="text" name="username" class="form-control">
                                    <div class="invalid-feedback">
                                        Please fill in the first name
                                    </div>
                                </div>
                                <div class="form-group col-md-6 col-12">
                                    <label>password</label>
                                    <input type="text" name="password" class="form-control">
                                    <div class="invalid-feedback">
                                        Please fill in the last name
                                    </div>
                                </div>
                                <div class="form-group col-md-7 col-12">
                                    <label>namaKonsumen</label>
                                    <input type="text" name="namaKonsumen" class="form-control">
                                    <div class="invalid-feedback">
                                        Please fill in the email
                                    </div>
                                </div>
                                <div class="form-group col-md-7 col-12">
                                    <label>email</label>
                                    <input type="email" name="email" class="form-control">
                                    <div class="invalid-feedback">
                                        Please fill in the email
                                    </div>
                                </div>
                                <div class="form-group col-md-5 col-12">
                                    <label>alamat</label>
                                    <input type="text" name="alamat" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-7 col-12">
                                    <label>idKota</label>
                                    <input type="text" name="idKota" class="form-control">
                                    <div class="invalid-feedback">
                                        Please fill in the email
                                    </div>
                                </div>
                                <div class="form-group col-md-7 col-12">
                                    <label>tlpn</label>
                                    <input type="text" name="tlpn" class="form-control">
                                    <div class="invalid-feedback">
                                        Please fill in the email
                                    </div>
                                </div>
                                <div class="form-group col-md-7 col-12">
                                    <label>statusAktif</label>
                                    <input type="text" name="statusAktif" class="form-control">
                                    <div class="invalid-feedback">
                                        Please fill in the email
                                    </div>
                                </div>
                            </div>
                            <!--akhir card-body-->
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary" type="submit">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
<footer class="main-footer">
    <div class="footer-left">
        Copyright &copy; 2018 <div class="bullet"></div> Design By <a href="https://nauval.in/">Muhamad Nauval Azhar</a>
    </div>
    <div class="footer-right">

    </div>
</footer>