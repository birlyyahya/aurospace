<!-- Main Content -->
<div class="main-content">
    <section class="section" style="position: relative; top:120px;">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-body p-0">
                        <div id="carouselExampleIndicators2" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carouselExampleIndicators2" data-slide-to="0" class="active"></li>
                                <li data-target="#carouselExampleIndicators2" data-slide-to="1"></li>
                                <li data-target="#carouselExampleIndicators2" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img class="img-fluid d-block w-100" style="object-fit: cover; height:500px; background-position: center center;
background-repeat: no-repeat;" src="<?= base_url('assets/assets/') ?>img/slideshow/bas.jpg" alt="First slide">
                                </div>
                                <div class="carousel-item ">
                                    <img class="img-fluid d-block w-100" style="object-fit: fill; height:500px; background-position: center center;
  background-repeat: no-repeat;" src="<?= base_url('assets/assets/') ?>img/slideshow/ba.png" alt="Second slide">
                                </div>
                                <div class="carousel-item ">
                                    <img class="img-fluid d-block" style="object-fit: fill; height:500px; width:100%; background-position: center center;
  background-repeat: no-repeat;" src="<?= base_url('assets/assets/') ?>img/slideshow/basi.jpg" alt="Third slide">
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleIndicators2" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleIndicators2" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <h2 class="section-title text-dark">Produk Terbaru</h2>
        <p class="section-lead">This article component is based on card and flexbox.</p>
        <div class="row">
            <?php $i = 0;
            foreach ($produk as $p) : ?>
                <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                    <article class="article">
                        <div class="article-header position-relative">
                            <div class="article-image" data-background="<?= base_url('assets/assets/img/products/') . $p->foto ?>">
                                <?php if (empty($this->session->userdata('member'))) {
                                } else {
                                    $data = $this->Mfrontend->query("SELECT * FROM tbl_liked WHERE idkonsumen=" . $this->session->userdata('idkonsumen') . " AND idproduk=" . $p->idproduk . '')->result();
                                    if ($data) {
                                ?>
                                        <form action="<?= site_url('produk/favorite') ?>" method="POST">
                                            <button id="like" method="like" class="btn fa-solid fa-heart liked" data-productid="<?= $p->idproduk ?>" data-productkonsumen="<?= $this->session->userdata('idkonsumen') ?>" style="z-index:99;position: absolute; top:8px; right:8px; font-size: 24px; color:red;">
                                            </button>
                                        </form>
                                    <?php   } else {
                                    ?>
                                        <form action="<?= site_url('produk/favorite') ?>" method="POST">
                                            <button id="like" method="unlike" class="btn fa-solid fa-heart liked" data-productid="<?= $p->idproduk ?>" data-productkonsumen="<?= $this->session->userdata('idkonsumen') ?>" style="z-index:99;position: absolute; top:8px; right:8px; font-size: 24px; color:grey;">
                                            </button>
                                        </form>
                                <?php
                                    }
                                } ?>
                            </div>
                            <div class="article-title text-light">
                                <h2 style="max-width:200px; overflow:hidden; text-overflow: ellipsis;"><a href="<?= site_url('produk/detailproduk/') . $p->idproduk ?>"><?= $p->namaproduk ?></a></h2>
                            </div>
                        </div>

                        <div class=" article-details">
                            <p style="max-width:200px; height:80px; overflow:hidden; text-overflow: ellipsis;"><?= $p->deskripsiproduk ?></p>
                            <div class="article-cta">
                                <a href="<?= site_url('world/add_cart/') . $p->idproduk ?>" class="btn btn-danger">Add to cart</a>
                                <a href="<?= site_url('produk/detailproduk/') . $p->idproduk ?>" class="btn btn-primary">Detail</a>
                            </div>
                        </div>

                    </article>
                </div>
            <?php $i++;
            endforeach; ?>
        </div>
        <h2 class="section-title text-dark">Produk Terlaris</h2>
        <p class="section-lead">This article component is based on card and flexbox.</p>
        <div class="row">
            <div class="col-9">
                <div class="row">
                    <?php foreach ($top_n as $item) : ?>
                        <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                            <article class="article">
                                <div class="article-header">
                                    <div class="article-image" data-background="<?= site_url('assets/assets/img/products/') . $item['foto']; ?>">
                                    </div>
                                    <div class="article-title text-light">
                                        <h2 style="max-width:200px; overflow:hidden; text-overflow: ellipsis;"><a href=" <?php echo site_url('produk/detailproduk/' . $item['id']); ?>">
                                                <?php echo $item['title']  . " (" . $item['score'] . ")" ?></a>
                                        </h2>
                                    </div>
                                </div>
                                <div class="article-details">
                                    <p style="max-width:200px; height:80px; overflow:hidden; text-overflow: ellipsis;"> <?= $item['deskripsi']; ?></style=>
                                    <div class="article-cta">
                                        <a href="<?= site_url('world/add_cart/') . $item['id'] ?>" class="btn btn-danger">Add to cart</a>
                                        <a href="<?= site_url('produk/detailproduk/') . $item['id']; ?>" class="btn btn-primary">Detail</a>
                                    </div>
                                </div>
                            </article>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="col-3">
                <div class="col-12 p-0">
                    <div id="carouselExampleIndicators3" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators3" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators3" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators3" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img class="img-fluid d-block w-100" style="object-fit: cover; height:500px; background-position: center center;
        background-repeat: no-repeat;" src="<?= base_url('assets/assets/') ?>img/iklan/iklan1.jpg" alt="First slide">
                            </div>
                            <div class="carousel-item ">
                                <img class="img-fluid d-block w-100" style="object-fit: cover; height:500px; background-position: center center;
          background-repeat: no-repeat;" src="<?= base_url('assets/assets/') ?>img/iklan/iklan3.jpg" alt="Second slide">
                            </div>
                            <div class="carousel-item ">
                                <img class="img-fluid d-block" style="object-fit: cover; height:500px; width:100%; background-position: center center;
          background-repeat: no-repeat;" src="<?= base_url('assets/assets/') ?>img/iklan/iklan4.jpg" alt="Third slide">
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators3" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators3" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-9" style="position: relative ; top:-110px;">
                <div class="col-12 p-0">
                    <div id="carouselExampleIndicators4" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators4" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators4" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators4" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner" style="max-height: 120px ;">
                            <div class="carousel-item active">
                                <img class="img-fluid d-block w-100" style="object-fit: cover; height:110px; background-position: center center;
        background-repeat: no-repeat;" src="<?= base_url('assets/assets/') ?>img/banner/banner2.jpg" alt="First slide">
                            </div>
                            <div class="carousel-item ">
                                <img class="img-fluid d-block w-100" style="object-fit: cover; height:110px; background-position: center center;
          background-repeat: no-repeat;" src="<?= base_url('assets/assets/') ?>img/banner/banner1.jpg" alt="Second slide">
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators4" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators4" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

</div>
</section>
</div>