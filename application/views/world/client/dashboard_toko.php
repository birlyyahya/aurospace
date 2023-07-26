<div class="main-content">
    <section class="section" style="position: relative; top:120px;">
        <div class="section-header">
            <div class="section-header-back">
                <a href="features-settings.html" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Menu Utama Dashboard Toko</h1>
        </div>
        <div class="section-body">
            <div id="output-status"></div>
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h4>Menu Toko</h4>
                        </div>
                        <div class="card-body">
                            <ul class="nav nav-pills flex-column">
                                <li class="nav-item"><a href="<?= site_url('world/dashboard_toko/') . $toko->idtoko ?>" class="nav-link active">Beranda</a></li>
                                <li class="nav-item"><a href="<?= site_url('world/produk/') . $toko->idtoko ?>" class="nav-link">Upload Produk</a></li>
                                <li class="nav-item"><a href="<?= site_url('transaksi/konfirmasi/') . $toko->idtoko ?>" class="nav-link">Riwayat Transaksi</a></li>
                                <li class="nav-item"><a href="<?= site_url('transaksi/laporan_toko/') . $toko->idtoko ?>" class="nav-link">Laporan</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-primary">
                                    <i class="far fa-user"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>Total Transaksi</h4>
                                    </div>
                                    <div class="card-body">
                                        <?php echo count($transaksi) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-danger">
                                    <i class="far fa-newspaper"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>Total Produk</h4>
                                    </div>
                                    <div class="card-body">
                                        <?php echo count($produk) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-warning">
                                    <i class="fa-solid fa-heart-circle-exclamation text-white" style="font-size: 32px;"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>Kesehatan Toko</h4>
                                    </div>
                                    <div class="card-body">
                                        <?= intval($kesehatantoko->nilai) ?>%
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="max-width: 777px ;">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Data Produk Toko <?= $toko->namatoko ?> </h4>
                                        <div class="card-header-action">
                                        </div>
                                    </div>
                                    <div class="card-body p-0">
                                        <div class="table-responsive table-hover">
                                            <table class="table table-bordered table-md" style="border-spacing: 0px 10px; border-collapse: separate;">
                                                <tr>
                                                    <th>Foto</th>
                                                    <th>Nama Produk</th>
                                                    <th>Nama Kategori</th>
                                                    <th>Harga</th>
                                                    <th>Berat</th>
                                                    <th>Deskripsi</th>
                                                    <th>Stok</th>
                                                </tr>
                                                <?php foreach ($produk as $tk) : ?>
                                                    <tr style="border-bottom: 1px solid #fff ;">
                                                        <td>
                                                            <img src="<?= base_url('assets/assets/img/products/' . $tk->foto) ?>" width="90" height="90" alt="">
                                                        </td>
                                                        <td class="align-middle" style="max-width:200px;white-space:nowrap ; overflow:hidden;text-overflow: ellipsis;"><?= $tk->namaproduk ?></td>
                                                        <td class="align-middle"><?= $tk->namakategori ?></td>
                                                        <td class="font-weight-600 align-middle"><?= $tk->harga ?></td>
                                                        <td class="align-middle"><?= $tk->berat ?></td>
                                                        <td class="align-middle" style="max-width:50px;white-space: nowrap; overflow:hidden;text-overflow: ellipsis; "><?= $tk->deskripsiproduk ?></td>
                                                        <td class="align-middle">
                                                            <?php if ($tk->stok > 10) { ?>
                                                                <span class="badge badge-primary" style="width: 88.5px;"><?= $tk->stok ?></span>
                                                            <?php } else { ?>
                                                                <span class="badge badge-danger" style="width: 88.5px;"><?= $tk->stok ?></span>
                                                            <?php } ?>
                                                        </td>
                                                        <td style="vertical-align: middle;">
                                                            <a href="<?= site_url('world/dashboard_toko/') . $tk->idtoko ?>" class="btn btn-danger">Hapus</a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>