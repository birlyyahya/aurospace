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
                                <li class="nav-item"><a href="<?= site_url('world/dashboard_toko/') . $toko->idtoko ?>" class="nav-link">Beranda</a></li>
                                <li class="nav-item"><a href="<?= site_url('world/produk/') . $toko->idtoko ?>" class="nav-link">Upload Produk</a></li>
                                <li class="nav-item"><a href="<?= site_url('transaksi/konfirmasi/') . $toko->idtoko ?>" class="nav-link active">Riwayat Transaksi</a></li>
                                <li class="nav-item"><a href="<?= site_url('transaksi/laporan_toko/') . $toko->idtoko ?>" class="nav-link">Laporan</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="row" style="max-width: 777px ;">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Barang Terjual toko <?= $toko->namatoko ?> </h4>
                                    <div class="card-header-action">
                                        <?= $this->session->flashdata('message'); ?>
                                    </div>
                                </div>

                                <div class="card-body p-0">
                                    <div class="wrapper rounded">
                                        <nav class="navbar navbar-expand-lg navbar-dark dark d-lg-flex align-items-lg-start"> <a class="navbar-brand" href="#">Konfirmation Payment <p class="text-muted pl-1">Welcome to your transactions</p> </a> <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
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
                                                    }
                                                    ?>
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
        </div>
    </section>
</div>

<?php foreach ($order as $ord) {
    $data = $this->Mfrontend->query("SELECT DISTINCT idorder,namaproduk,ongkir,buktitf,idorder,idkonfirmasi,total,td.harga FROM `tbl_detail_order` td JOIN tbl_produk USING(idproduk) JOIN tbl_konfirmasi USING (idorder) JOIN tbl_order USING (idorder) WHERE idorder=" . $ord->idorder . "")->result_array();
?>
    <div class="modal fade" id="user<?= $ord->idorder ?>" tabindex="-1" aria-labelledby="user<?= $ord->idorder ?>" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
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
                                        <span class="text-center"> <span class="badge badge-primary"><?= $ord->statusorder ?></span></span>
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
                    <?php } ?>
                    <div class="d-flex align-items-center justify-content-between text"> <span class="">Ongkir</span> <span class="fas fa-dollar-sign"><span class="ps-1"><?= number_format($detail['ongkir'], '0', '', '.') ?></span></span> </div>
                    <div class="d-flex align-items-center justify-content-between text mb-4 mt-3"> <span>Total</span> <span class="fas fa-dollar-sign"><span class="ps-1"><?= number_format($detail['total'], '0', '', '.') ?></span></span> </div>
                    <div class="border-bottom mb-4"></div>
                    <div class="d-flex mb-4 justify-content-between">
                        <span> <i class="far fa-file-alt"></i> <span class="ps-2">Invoice ID:</span></span>
                        <span class="ps-3">#<?= $ord->idorder ?></span>
                    </div>
                    <div class="d-flex mb-4 justify-content-between">
                        <span><i class="fa-solid fa-calendar-days"></i> <span class="ps-2">Tanggal Konfirmasi:</span></span><span class="ps-3"><?php date_default_timezone_set("Asia/jakarta");
                                                                                                                                                echo date("d M Y h:i"); ?></span>
                    </div>
                    <?php if ($ord->statusorder == "Belum Bayar") { ?>
                        <div class="payment" id="carddata">
                            <ul class="nav nav-tabs mb-3 px-md-4 px-2">
                                <li class="nav-item"> <button class="nav-link px-2 active focus disabled" aria-current="page" href="#" data-toggle="collapse" data-target="#collapseExample1" aria-expanded="true" aria-controls="collapseExample">Transfer Bank </button> </li>
                            </ul>
                            <div class="collapse show" id="collapseExample1" data-parent="#carddata">
                                <div class="card card-body bg-white">
                                    <p class="text-muted">Bukti Transfer</p>
                                    <div class="row">
                                        <div class="col-12">
                                            <?php foreach ($data as $detail) {
                                            ?>
                                            <?php } ?>
                                            <img src="<?= site_url('assets/assets/img/transfer/') . $detail['buktitf'] ?>" alt="" class="rounded" width="100%">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <?php foreach ($data as $detail) {
                            ?>
                            <?php } ?>
                            <a href="<?= site_url('transaksi/batal_pembayaran/') . $ord->idorder . '/' . $detail['idkonfirmasi'] . '/' . $ord->idtoko ?>" class="btn btn-secondary">Close</a>
                            <a href="<?= site_url('transaksi/konfirmasi_pembayaran/') . $ord->idorder . '/' . $detail['idkonfirmasi'] . '/' . $ord->idtoko ?>" class="btn btn-primary">Konfirmasi</a>
                        </div>
                    <?php
                    } else if ($ord->statusorder == "Dikemas") {
                    ?>
                        <form action="<?= site_url('transaksi/kirimnoresi') ?>" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="idorder" value="<?= $ord->idorder ?>">
                            <input type="hidden" name="idtoko" value="<?= $ord->idtoko ?>">
                            <div class="col-12 p-0">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-truck-ramp-box"></i></span>
                                    </div>
                                    <input type="text" name="noresi" id="noresi" class="form-control text-uppercase" aria-label="Username" aria-describedby="basic-addon1" placeholder="No Resi">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Konfirmasi</button>
                            </div>
                        </form>
                    <?php
                    } else { ?>
                        <div class="modal-footer justify-content-center">
                            <span class="text-center"> <span class="badge badge-success">Lunas dan <?= $ord->statusorder ?></span></span>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
<?php } ?>