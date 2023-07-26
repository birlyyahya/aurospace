<!-- Main Content -->
<div class="main-content">
    <section class="section" style="position: relative; top:120px;">
        <form action="<?= site_url('produk/add_cart') ?>" method="POST">
            <article class="bg-white p-3">
                <div class="row">
                    <input type="hidden" name="idtoko" value="<?= $toko[0]->idtoko ?>">
                    <input type="hidden" name="namatoko" value="<?= $toko[0]->namatoko ?>">
                    <input type="hidden" name="idproduk" value="<?= $detail[0]->idproduk; ?>">
                    <div class="col-5 position-relative">
                        <div id="carouselExampleIndicators2" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carouselExampleIndicators2" data-slide-to="0" class="active"></li>
                                <li data-target="#carouselExampleIndicators2" data-slide-to="1"></li>
                                <li data-target="#carouselExampleIndicators2" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <input type="hidden" name="foto" value="<?= $detail[0]->foto ?>">
                                    <img class="img-fluid d-block w-100" style="object-fit: cover; height:500px; background-position: center center;
background-repeat: no-repeat;" src="<?= base_url('assets/assets/img/products/') ?><?= $detail[0]->foto ?>" alt="First slide">
                                </div>
                                <a id="like" onclick="func(this)" class="fa-solid fa-heart" style="z-index:99;position: absolute; top:18px; right:18px; font-size: 24px; color:grey;">
                                </a>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-7">
                        <input type="hidden" name="namaproduk" value="<?= $detail[0]->namaproduk ?>">
                        <div class="row">
                            <tittle class="col-12">
                                <p style="max-width: 100%;font-size: 30px;overflow: hidden;max-height: 75px;line-height: 35px;"><?= $detail[0]->namaproduk ?></p>
                            </tittle>
                            <div class="col-12">
                                <div class="d-flex">
                                    <div class="pr-2" id="review" style=" display: flex;">
                                        <div class="h6">Penilaian : </div>
                                        <div class="h6 pl-1"><a href="">4.5</a></div>
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dot" viewBox="0 0 16 16">
                                        <path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z" />
                                    </svg>
                                    <div id="jual" style="display: flex;">
                                        <div class="h6 pl-2">Terjual : </div>
                                        <div class="h6 pl-1">999</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="alert alert-secondary" role="alert" style="background-color:#c0c0c024;">
                                    <input type="hidden" name="harga" value="<?= $detail[0]->harga ?>">
                                    <h3 class="text-dark">Rp<span><?= number_format($detail[0]->harga, 0, '', '.') ?></span></h3>
                                </div>
                            </div>
                            <div class="col-12 text-dark">
                                <div class="row">
                                    <div class="col-1">Stok</div>
                                    <div class="col-1">:</div>
                                    <input type="hidden" name="stok" value="<?= $detail[0]->stok ?>">
                                    <div class="col-7"><?= $detail[0]->stok ?></div>
                                </div>
                                <div class="row">
                                    <div class="col-1">Berat</div>
                                    <div class="col-1">:</div>
                                    <input type="hidden" name="berat" value="<?= $detail[0]->berat ?>">
                                    <div class="col-7"><?= $detail[0]->berat ?> Gram</div>

                                </div>
                                <div class="row mt-4 mb-5">
                                    <div class="col-3">
                                        <h6>Deskripsi Produk</h6>
                                    </div>
                                    <div class="col-12 overflow-auto"><?= $detail[0]->deskripsiproduk ?></div>
                                </div>
                            </div>
                            <div class="col-12 mt-5">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="d-grid gap-2 col-12s mb-4">
                                            <button class="btn btn-primary mr-4">Add Chart</button>
                                            <button class="btn btn-danger">Beli Sekarang</button>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="d-flex justify-content-end">
                                            <button class="btn btn-danger">
                                                <i class="fa-solid fa-flag"></i> Report
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
        </form>
        <article class="bg-white py-4 px-3 mt-3" style="max-height: 200px;">
            <div class="row">
                <div class="col-2 text-center">
                    <img src="<?= site_url('assets/assets/img/toko/') . $toko[0]->logo ?>" class="rounded-circle" alt="..." width="125" height="125">
                </div>
                <div class="col-3">
                    <h6><?= $toko[0]->namatoko ?></h6>
                    <p><?= $toko[0]->namakonsumen ?></p>
                    <div class="d-flex justify-content-between">
                        <button class="btn btn-dark">Chat Pelapak</button>
                        <a href="<?= site_url('world/dashboard_toko/') . $toko[0]->idtoko ?>" class="btn btn-success">Kunjungi Toko</a>
                    </div>
                </div>
                <div class="col-1 text-center">
                    <hr style="width: 2px;height:90%;background: #c0c0c024; margin:0px; display:inline-flex;">
                </div>
                <div class="col-6">
                    <h5>Deskripsi Toko</h5>
                    <p class="overflow-auto" style="text-overflow:ellipsis; max-height: 95px ;"><?= $toko[0]->deskripsi ?></p>
                </div>
            </div>
        </article>
        <h2 class="section-title text-dark">Review Produk</h2>
        <aside class="pt-4" style="max-height: 550px; overflow-y:scroll;">
            <?php
            if (!empty($komentar)) {
                foreach ($komentar as $komen) { ?>
                    <div class="card">
                        <div class="card-header bg-white justify-content-between">
                            <span>Penilaian Pelanggan</span>
                            <div class="badge badge-primary fs-5">
                                <?php for ($i = 1; $i <= $komen->nilai; $i++) {
                                ?>

                                    <i class="fa-solid fa-star text-warning"></i>
                                <?php
                                } ?>
                            </div>
                        </div>
                        <div class="card-body bg-white">
                            <blockquote class="blockquote mb-3">
                                <p><?= $komen->komentar ?></p>
                                <footer class="blockquote-footer">Someone Buyer in <cite title="Source Title">Aurospace</cite></footer>
                            </blockquote>

                        </div>
                    </div>
                <?php
                }
            } else { ?>
                <div class="card">
                    <div class="card-header bg-white justify-content-between">
                        <span>Penilaian Pelanggan</span>
                        <div class="badge badge-primary fs-5"></div>
                    </div>
                    <div class="card-body bg-white">
                        <blockquote class="blockquote mb-3">
                            <p>Belum ada komentar yang dimuat</p>
                            <footer class="blockquote-footer">Aurospacer <cite title="Source Title">Source Admin</cite></footer>
                        </blockquote>

                    </div>
                </div>
            <?php } ?>
        </aside>
        <h2 class="section-title text-dark">Rekomendasi Produk</h2>
        <div class="row">
            <?php foreach ($top_n as $p) : ?>
                <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                    <article class="article">
                        <div class="article-header">
                            <div class="article-image" data-background="<?= base_url('assets/assets/img/products/') . $p['title']['foto']  ?>">
                            </div>
                            <div class="article-title text-light">
                                <h2 style="max-width:200px; overflow:hidden; text-overflow: ellipsis;"><a href="<?= site_url('produk/detailproduk/') . $p['id'] ?>"><?= $p['title']['namaproduk'] ?></a></h2>
                            </div>
                        </div>

                        <div class=" article-details">
                            <p style="max-width:200px; height:80px; overflow:hidden; text-overflow: ellipsis;"><?= $p['title']['deskripsiproduk']  ?></p>
                            <div class="article-cta">
                                <a href="<?= site_url('world/add_cart/') . $p['id'] ?>" class="btn btn-primary">Add to cart</a>
                            </div>
                        </div>
                    </article>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</div>