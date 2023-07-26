<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Aurospace</title>
       <link rel="icon" href="<?= base_url('assets') ?>/assets/img/aurospace.png" type="image/x-icon">

    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Template CSS -->
    <link rel="stylesheet" href="<?= base_url('assets') ?>/assets/css/style.css">
    <link rel="stylesheet" href="<?= base_url('assets') ?>/assets/css/components.css">
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="../node_modules/jqvmap/dist/jqvmap.min.css">
    <link rel="stylesheet" href="../node_modules/summernote/dist/summernote-bs4.css">
    <link rel="stylesheet" href="../node_modules/owl.carousel/dist/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="../node_modules/owl.carousel/dist/assets/owl.theme.default.min.css">
</head>

<body class="layout-3">
    <div id="app">
        <div class="main-wrapper container">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <a href="<?= site_url('world') ?>" class="navbar-brand sidebar-gone-hide">AuroSpace</a>
                <div class="navbar-nav">
                    <a href="#" class="nav-link sidebar-gone-show" data-toggle="sidebar"><i class="fas fa-bars"></i></a>
                </div>
                <div class="nav-collapse">
                    <a class="sidebar-gone-show nav-collapse-toggle nav-link" href="#">
                        <i class="fas fa-ellipsis-v"></i>
                    </a>
                    <ul class="navbar-nav">
                        <li class="nav-item active"><a href="#" class="nav-link">Tentang Aurospace</a></li>
                        <li class="nav-item"><a href="#" class="nav-link">Cara Belanja</a></li>
                        <li class="nav-item"><a href="#" class="nav-link">Hubungi Kami</a></li>
                    </ul>
                </div>
                <form class="form-inline mx-auto">
                    <ul class="navbar-nav">
                        <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
                    </ul>
                    <div class="search-element">
                        <select data-width="150" class="form-control">
                            <option class="form-control">Baju Laki-laki</option>
                            <option class="form-control">Celana Cowok</option>
                            <option class="form-control">Baju Cewek</option>
                        </select>
                        <input class="form-control" type="search" placeholder="Search" aria-label="Search" data-width="500">
                        <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                    </div>
                </form>
                <?php if (!empty($this->session->userdata('member') || $this->session->userdata('admin'))) {
                ?>
                    <ul class="navbar-nav navbar-right pl-2">
                        <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg beep"><i class="fa-solid fa-basket-shopping"></i></a>
                            <div class="dropdown-menu dropdown-list dropdown-menu-right">
                                <div class="dropdown-header">Keranjang
                                    <div class="float-right">
                                        <a href="#">Mark All As Read</a>
                                    </div>
                                </div>
                                <div class="dropdown-list-content dropdown-list-icons">
                                    <a href="#" class="dropdown-item dropdown-item-unread">
                                        <div class="dropdown-item-icon bg-primary text-white">
                                            <i class="fas fa-code"></i>
                                        </div>
                                        <div class="dropdown-item-desc">
                                            Template update is available now!
                                            <div class="time text-primary">2 Min Ago</div>
                                        </div>
                                    </a>
                                    <a href="#" class="dropdown-item">
                                        <div class="dropdown-item-icon bg-info text-white">
                                            <i class="far fa-user"></i>
                                        </div>
                                        <div class="dropdown-item-desc">
                                            <b>You</b> and <b>Dedik Sugiharto</b> are now friends
                                            <div class="time">10 Hours Ago</div>
                                        </div>
                                    </a>
                                    <a href="#" class="dropdown-item">
                                        <div class="dropdown-item-icon bg-success text-white">
                                            <i class="fas fa-check"></i>
                                        </div>
                                        <div class="dropdown-item-desc">
                                            <b>Kusnaedi</b> has moved task <b>Fix bug header</b> to <b>Done</b>
                                            <div class="time">12 Hours Ago</div>
                                        </div>
                                    </a>
                                    <a href="#" class="dropdown-item">
                                        <div class="dropdown-item-icon bg-danger text-white">
                                            <i class="fas fa-exclamation-triangle"></i>
                                        </div>
                                        <div class="dropdown-item-desc">
                                            Low disk space. Let's clean it!
                                            <div class="time">17 Hours Ago</div>
                                        </div>
                                    </a>
                                    <a href="#" class="dropdown-item">
                                        <div class="dropdown-item-icon bg-info text-white">
                                            <i class="fas fa-bell"></i>
                                        </div>
                                        <div class="dropdown-item-desc">
                                            Welcome to Stisla template!
                                            <div class="time">Yesterday</div>
                                        </div>
                                    </a>
                                </div>
                                <div class="dropdown-footer text-center">
                                    <a href="#">View All <i class="fas fa-chevron-right"></i></a>
                                </div>
                            </div>
                        </li>
                        <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                                <img alt="image" src="<?= base_url('assets'); ?>/assets/img/avatar/avatar-1.png" class="rounded-circle mr-1">
                                <div class="d-sm-none d-lg-inline-block ">
                                    <span class="font-weight-bold" style="text-shadow:0 0px 1px #5a5d9d; color:white!important; text-transform:capitalize;"><?= $this->session->userdata('member')  ?></span>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <div class="dropdown-title">Logged in 5 min ago</div>
                                <a href="<?= site_url('world/dashboard') ?>" class="dropdown-item has-icon">
                                    <i class="far fa-user"></i> Profile
                                </a>
                                <a href="<?= site_url('world/profile') ?>" class="dropdown-item has-icon">
                                    <i class="fas fa-bolt"></i> Activities
                                </a>
                                <a href="features-settings.html" class="dropdown-item has-icon">
                                    <i class="fas fa-cog"></i> Settings
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="<?= site_url('world/logout') ?>" class="dropdown-item has-icon text-danger">
                                    <i class="fas fa-sign-out-alt"></i> Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                <?php } else { ?>
                    <a href="<?= site_url('world/login') ?>" class="btn btn-outline-primary">Login</a>
                <?php
                } ?>

            </nav>

            <nav class="navbar navbar-secondary navbar-expand-lg">
                <div class="container">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="#" class="nav-link"><span>Baju Laki-laki</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link"><span>Celana Cowok</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link"><span>Baju Cewek</span></a>
                        </li>
                    </ul>
                </div>
            </nav>


            <!-- Main Content -->
            <?= $contents ?>

        </div>
    </div>
    </section>
    </div>
    <footer class="main-footer" style="position: relative; top: 90px;">
        <div class="footer-left">
            Copyright &copy; 2018 <div class="bullet"></div> Design By <a href="https://nauval.in/">Muhamad Nauval Azhar</a>
        </div>
        <div class="footer-right">
            2.3.0
        </div>
    </footer>
    </div>
    </div>
    <!-- General JS Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="<?= base_url('assets') ?>/assets/js/stisla.js"></script>

    <!-- JS Libraies -->
    <script src="../node_modules/jquery-sparkline/jquery.sparkline.min.js"></script>
    <script src="../node_modules/chart.js/dist/Chart.min.js"></script>
    <script src="../node_modules/owl.carousel/dist/owl.carousel.min.js"></script>
    <script src="../node_modules/summernote/dist/summernote-bs4.js"></script>
    <script src="../node_modules/chocolat/dist/js/jquery.chocolat.min.js"></script>

    <!-- Template JS File -->
    <script src="<?= base_url('assets') ?>/assets/js/scripts.js"></script>
    <script src="<?= base_url('assets') ?>/assets/js/custom.js"></script>

    <!-- Page Specific JS File -->
    <script src="<?= base_url('assets') ?>/assets/js/page/index.js"></script>
</body>

</html>