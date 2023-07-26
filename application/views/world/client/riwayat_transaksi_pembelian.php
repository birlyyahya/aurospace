<div class="main-content">
    <section class="section" style="position: relative; top:120px;">
        <!-- Button trigger modal -->

        <div class="section-header">
            <div class="section-header-back">
                <a href="features-settings.html" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Menu Utama Dashboard Member</h1>
        </div>
        <div class="section-body">
            <div id="output-status"></div>
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h4>Menu Member</h4>
                        </div>
                        <div class="card-body">
                            <ul class="nav nav-pills flex-column">
                                <li class="nav-item"><a href="<?= site_url('world/dashboard') ?>" class="nav-link">Beranda</a></li>
                                <li class="nav-item"><a href="<?= site_url('transaksi/order') ?>" class="nav-link">Transaksi</a></li>
                                <li class="nav-item"><a href="<?= site_url('transaksi/riwayat_pembelian') ?>" class="nav-link active">Riwayat Transaksi</a></li>
                                <li class="nav-item"><a href="<?= site_url('world/toko') ?>" class="nav-link">Toko</a></li>
                                <li class="nav-item"><a href="" class="nav-link">Ubah Profil</a></li>
                                <li class="nav-item"><a href="<?= site_url('world/logout') ?>" class="nav-link">Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Riwayat Trinsaksi</h4>
                                    <div class="card-header-action">
                                        <?= $this->session->flashdata('message'); ?>
                                    </div>
                                </div>
                                <div class="card-body p-0">
                                    <div class="wrapper rounded">
                                        <nav class="navbar navbar-expand-lg navbar-dark dark d-lg-flex align-items-lg-start"> <a class="navbar-brand" href="#">Transactions <p class="text-muted pl-1">Welcome to your transactions</p> </a> <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
                                        </nav>
                                        <div class="table-responsive mt-3">
                                            <table class="table table-borderless">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">No Invoice</th>
                                                        <th scope="col">Activity</th>
                                                        <th scope="col">Date</th>
                                                        <th scope="col" class="text-center">Status Bayar</th>
                                                        <th scope="col" class="text-center">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($order as $or) {
                                                    ?>
                                                        <tr>
                                                            <td>#<?= $or->idorder ?></td>
                                                            <td scope="row"><span class="fa fa-user mr-1"></span><?= $or->namakonsumen ?></td>
                                                            <td class="text-muted"><?= $or->tanggal ?></td>
                                                            <?php if ($or->statusorder == 'Belum Bayar') { ?>
                                                                <td class="text-center"> <span class="badge badge-secondary"><?= $or->statusorder ?></span></td>
                                                            <?php
                                                            } else if ($or->statusorder == 'Dibatalkan') { ?>
                                                                <td class="text-center"> <span class="badge badge-danger"><?= $or->statusorder ?></span></td>
                                                            <?php } else if ($or->statusorder == 'Dikirim') { ?>
                                                                <td class="text-center"> <span class="badge badge-warning"><?= $or->statusorder ?></span></td>
                                                            <?php } else if ($or->statusorder == 'Diterima') { ?>
                                                                <td class="text-center"> <span class="badge badge-success"><?= $or->statusorder ?></span></td>
                                                            <?php } else if ($or->statusorder == 'Selesai') { ?>
                                                                <td class="text-center"> <span class="badge badge-primary"><?= $or->statusorder ?></span></td>
                                                            <?php } else {
                                                            ?>
                                                                <td class="text-center"> <span class="badge badge-info"><?= $or->statusorder ?></span></td>
                                                            <?php
                                                            } ?>
                                                            <td class="d-flex justify-content-center align-items-center">
                                                                <button type="button" class="btn" data-toggle="modal" data-target="#user<?= $or->idorder ?>">
                                                                    <i class="fa-solid fa-credit-card text-light"></i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    <?php
                                                    } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <!-- Modal -->
    <?php foreach ($order as $ord) {
        $data = $this->Mfrontend->query("SELECT *,tbl_detail_order.harga AS total FROM `tbl_detail_order` JOIN tbl_produk USING(idproduk) WHERE idorder=" . $ord->idorder . "")->result_array();
    ?>
        <div class="modal fade" id="user<?= $ord->idorder ?>" tabindex="-1" aria-labelledby="user<?= $ord->idorder ?>" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="verifikasi" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="idorder" value="<?= $ord->idorder ?>">
                        <div class="modal-header">
                            <h5 class="modal-title pl-2" id="exampleModalLabel">
                                <nav class="navbar navbar-expand-lg navbar-dark dark d-lg-flex align-items-end"> <a class="navbar-brand" href="#">
                                        <p class="text-muted pl-1">INVOICE #<?= $ord->idorder ?>
                                            <?php if ($ord->statusorder == 'Belum Bayar') { ?>
                                                <span class="text-center"> <span class="badge badge-secondary"><?= $ord->statusorder ?></span></span>
                                            <?php
                                            } else if ($ord->statusorder == 'Dibatalkan') { ?>
                                                <span class="text-center"> <span class="badge badge-danger"><?= $ord->statusorder ?></span></span>
                                            <?php } else if ($ord->statusorder == 'Dikirim') { ?>
                                                <span class="text-center"> <span class="badge badge-warning"><?= $ord->statusorder ?></span></span>
                                            <?php } else if ($ord->statusorder == 'Diterima') { ?>
                                                <span class="text-center"> <span class="badge badge-success"><?= $ord->statusorder ?></span></span>
                                            <?php } else if ($ord->statusorder == 'Selesai') { ?>
                                                <span class="text-center"> <span class="badge badge-primary"><?= $or->statusorder ?></span></span>
                                            <?php } else {
                                            ?>
                                                <span class="text-center"> <span class="badge badge-info"><?= $ord->statusorder ?></span></span>
                                            <?php
                                            } ?>

                                        </p>
                                    </a> <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
                                </nav>
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <hr>
                        <div class="modal-body">
                            <?php foreach ($data as $detail) {
                            ?>
                                <div class="d-flex align-items-center justify-content-between text"> <span class=""><?= $detail['namaproduk'] ?></span> <span class="fas fa-dollar-sign"><span class="ps-1"><?= number_format($detail['harga'], '0', '', '.') ?></span></span> </div>
                                <div class="d-flex align-items-center justify-content-between text mb-4 mt-3"> <span>Total</span> <span class="fas fa-dollar-sign"><span class="ps-1"><?= number_format($detail['total'], '0', '', '.') ?></span></span> </div>
                            <?php } ?>
                            <div class="border-bottom mb-4"></div>
                            <div class="d-flex mb-4 justify-content-between">
                                <span> <i class="far fa-file-alt"></i> <span class="ps-2">Invoice ID:</span></span>
                                <span class="ps-3">#<?= $ord->idorder ?></span>
                            </div>
                            <div class="d-flex mb-4 justify-content-between">
                                <span><i class="fa-solid fa-calendar-days"></i> <span class="ps-2">Tanggal Pembayaran:</span></span><span class="ps-3"><?= $ord->tanggal ?></span>
                            </div>
                            <?php if ($ord->statusorder == 'Reviewed') { ?>
                                <div class="modal-footer justify-content-center">
                                    <span class="text-center" style="font-size: 18px;"> <span class="badge badge-info">Telah <?= $ord->statusorder ?></span></span>
                                </div>
                            <?php } else { ?>
                                <div class="model-footer text-center">
                                    <a href="#review<?= $ord->idorder ?>" data-toggle="modal" data-target="#review<?= $or->idorder ?>" class=" btn btn-primary">Review</a>
                                </div>
                            <?php } ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade pt-3" id="review<?= $ord->idorder ?>" tabindex="-1" aria-labelledby="review<?= $ord->idorder ?>" aria-hidden="true" style="background-color:#00000073; z-index:99999;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="<?= site_url('produk/komentar') ?>" method="post">
                        <input type="hidden" value="<?= $ord->idorder ?>" name="idorder">
                        <input type="hidden" value="<?= $ord->idtoko ?>" name="idtoko">
                        <div class="modal-header">
                            <h4 class="modal-title">Review Produk </h4>
                            <button type="button" class="btn" style="z-index: 999;" data-toggle="modal" data-target="#report<?= $or->idorder ?>">
                                <i class="fa-solid fa-xmark" style="font-size: 18px;"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <?php foreach ($data as $detail) {
                            ?>
                                <div class="row">
                                    <input type="hidden" value="<?= $detail['iddetailorder'] ?>" name="iddetailorder<?= $detail['idproduk'] ?>">
                                    <input type="hidden" value="<?= $detail['idproduk'] ?>" name="idproduk<?= $detail['idproduk'] ?>">
                                    <div class="col-3">
                                        <picture>
                                            <img src="<?= site_url('assets/assets/img/products/' . $detail['foto']) ?>" class="img-fluid rounded" alt="products" style="width: 100px; height: 80px;object-fit: cover;object-position: center;">
                                        </picture>
                                    </div>
                                    <div class="col-6">
                                        <div class="d-inline">
                                            <h6 class="mb-0"> <?= $detail['namaproduk']; ?>
                                            </h6>
                                            <p class="text-muted"><?= $detail['deskripsiproduk']; ?></p>
                                        </div>
                                    </div>
                                    <div class="col-3" id="harga">
                                        <h6 class="p-2">Rp<?= number_format($detail['harga'], 0, '', '.'); ?></h6>
                                    </div>
                                </div>
                                <select class="custom-select mb-3" id="nilai" name="nilaiproduk<?= $detail['idproduk'] ?>" required>
                                    <option selected>Nilai Produk</option>
                                    <option value="5">Sangat Baik</option>
                                    <option value="4">Baik</option>
                                    <option value="3">Lumayan</option>
                                    <option value="2">Buruk</option>
                                    <option value="1">Sangat Buruk</option>
                                </select>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Komentar</span>
                                    </div>
                                    <textarea class="form-control" aria-label="With textarea" name="catatanproduk<?= $detail['idproduk'] ?>" required></textarea>
                                </div>
                                <div class="border-bottom mb-4"></div>
                                <hr>
                            <?php } ?>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php } ?>
</div>