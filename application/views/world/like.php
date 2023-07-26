<!-- Main Content -->
<div class="main-content">
    <section class="section" style="position: relative; top:120px;">
        <h2 class="section-title text-dark">Produk Disukai</h2>

        <div class="row">
            <?php
            if (!empty($produk)) {
                $i = 0;
                foreach ($produk as $p) :
            ?>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                        <article class="article">
                            <div class="article-header position-relative">
                                <div class="article-image" data-background="<?= base_url('assets/assets/img/products/') . $p[0]->foto ?>">
                                </div>
                                <div class="article-title text-light">
                                    <h2 style="max-width:200px; overflow:hidden; text-overflow: ellipsis;"><a href="<?= site_url('produk/detailproduk/') . $p[0]->idproduk ?>"><?= $p[0]->namaproduk ?></a></h2>
                                </div>
                            </div>

                            <div class=" article-details">
                                <p style="max-width:200px; height:80px; overflow:hidden; text-overflow: ellipsis;"><?= $p[0]->deskripsiproduk ?></p>
                                <div class="article-cta">
                                    <a href="<?= site_url('world/add_cart/') . $p[0]->idproduk ?>" class="btn btn-danger">Add to cart</a>
                                    <a href="<?= site_url('produk/detailproduk/') . $p[0]->idproduk ?>" class="btn btn-primary">Detail</a>
                                </div>
                            </div>

                        </article>
                    </div>
                <?php $i++;
                endforeach;
            } else { ?>
        </div>
        <h2 class="text-center">Data favorit kosong</h2>
    <?php } ?>

    </section>
</div>