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
                                <li class="nav-item"><a href="<?= site_url('transaksi/order') ?>" class="nav-link active">Transaksi</a></li>
                                <li class="nav-item"><a href="<?= site_url('transaksi/riwayat_pembelian') ?>" class="nav-link">Riwayat Transaksi</a></li>
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
                                                            <td> <a href="">#<?= $or->idorder ?></a> </td>
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
</div>
<!-- Modal -->
<?php foreach ($order as $ord) {
    $data = $this->Mfrontend->query("SELECT *,tbl_detail_order.harga AS total FROM `tbl_detail_order` JOIN tbl_produk USING(idproduk) WHERE idorder=" . $ord->idorder . "")->result_array();
?>
    <div class="modal hide fade" id="user<?= $ord->idorder ?>" tabindex="-1" aria-labelledby="user<?= $ord->idorder ?>" aria-hidden="true" data-parent="user<?= $ord->idorder ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="verifikasi" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="idorder" value="<?= $ord->idorder ?>">
                    <div class="modal-header">
                        <h5 class="modal-title pl-2" id="exampleModalLabel">
                            <nav class="navbar navbar-expand-lg navbar-dark dark d-lg-flex align-items-end">
                                <a class="navbar-brand" href="#">
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
                                            <span class="text-center"> <span class="badge badge-info"><?= $or->statusorder ?></span></span>
                                        <?php
                                        } ?>

                                    </p>
                                </a>
                                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
                            </nav>
                        </h5>
                        <button type="button" class="btn" style="z-index: 999;" data-toggle="modal" data-target="#user<?= $or->idorder ?>">
                            <i class="fa-solid fa-xmark" style="font-size: 18px;"></i>
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
                            <span><i class="fa-solid fa-calendar-days"></i> <span class="ps-2">Tanggal Pembayaran:</span></span><span class="ps-3"><?php date_default_timezone_set("Asia/jakarta");
                                                                                                                                                    echo date("d M Y h:i"); ?></span>
                        </div>
                        <?php if ($ord->statusorder == "Dikirim") { ?>
                            <div class="col-12 p-0">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-truck-ramp-box"></i></span>
                                    </div>
                                    <input type="text" name="noresi" id="noresi" class="form-control text-uppercase" aria-label="Username" aria-describedby="basic-addon1" placeholder="No Resi" value="<?= $ord->noresi ?>" disabled>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <span>Barang sudah diterima?</span>
                                <a href="<?= site_url('transaksi/terima_barang/' . $ord->idorder) ?>" class="btn btn-primary">Konfirmasi</a>
                            </div>
                        <?php
                        } else if ($ord->statusorder == "Diterima") { ?>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#report<?= $ord->idorder ?>">
                                    <i class="fa-solid fa-flag"></i> Report
                                </button>
                                <a href="<?= site_url('transaksi/selesai/' . $ord->idorder) ?>" class="btn btn-primary"> <i class="fa-solid fa-check"></i> Selesai</a>
                            </div>
                        <?php } else if ($ord->statusorder == "Dikemas") { ?>
                            <div class="modal-footer">
                                <span>Barang sudah diterima?</span>
                                <a href="<?= site_url('transaksi/terima_barang/' . $ord->idorder) ?>" class="btn btn-primary">Konfirmasi</a>
                            </div>
                        <?php
                        } else { ?>
                            <div class="payment" id="carddata">
                                <ul class="nav nav-tabs mb-3 px-md-4 px-2">
                                    <li class="nav-item"> <button class="nav-link px-2 active focus" aria-current="page" href="#" data-toggle="collapse" data-target="#collapseExample1" aria-expanded="true" aria-controls="collapseExample">Transfer Bank BCA</button> </li>
                                    <li class="nav-item"> <button class="nav-link px-2 active focus" aria-current="page" href="#" data-toggle="collapse" data-target="#collapseExample2" aria-expanded="true" aria-controls="collapseExample">Transfer Bank BNI</button> </li>
                                </ul>
                                <div class="collapse show" id="collapseExample1" data-parent="#carddata">
                                    <div class="card card-body bg-white">
                                        <p class="text-muted">Metode Transfer Bank BCA</p>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-credit-card"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control text-uppercase" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" value="5136 1845 5468 3894" readonly>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control text-uppercase" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" value="VLADIMIR PUTENG" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="collapse" id="collapseExample2" data-parent="#carddata">
                                    <div class="card card-body bg-white">
                                        <p class="text-muted">Metode Transfer Bank BNI</p>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-credit-card"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control text-uppercase" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" value="6743 3456 1232 2883" readonly>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control text-uppercase" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" value="PUTENG VLADIMIR" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="gambar">Bukti Transfer</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" name="gambar" id="gambar" class="custom-file-input" aria-describedby="inputGroupFileAddon01">
                                    <label name="gambar" class="custom-file-label" for="gambar">Choose file</label>
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Kirim Pembayaran</button>
                    </div>
                <?php
                        } ?>
                <?php ?>
                </form>
            </div>
        </div>
    </div>
    <div class="modal hide fade pt-3" id="report<?= $ord->idorder ?>" tabindex="-1" aria-labelledby="report<?= $ord->idorder ?>" aria-hidden="true" style="background-color:#00000073;">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="report" method="post">
                    <input type="hidden" value="<?= $ord->idorder ?>" name="idorder">
                    <input type="hidden" value="<?= $ord->idtoko ?>" name="idtoko">
                    <div class="modal-header">
                        <h4 class="modal-title">Report Produk </h4>
                        <button type="button" class="btn" style="z-index: 999;" data-toggle="modal" data-target="#report<?= $or->idorder ?>">
                            <i class="fa-solid fa-xmark" style="font-size: 18px;"></i>
                        </button>
                    </div>
                    <div class="container"></div>
                    <div class="modal-body">
                        <span for="produk" class="fs-4">Pilih Porduk</span>
                        <select class="custom-select mb-3" id="produk" name="produkreport" required>
                            <option selected>Open this select menu</option>
                            <?php foreach ($data as $detail) {
                            ?>
                                <option value="<?= $detail['idproduk'] ?>"> <?= $detail['namaproduk'] ?></option>
                            <?php } ?>
                        </select>
                        <span for="produk" class="fs-4">Jenis Report</span>
                        <select class="custom-select mb-3" id="produk" name="jenisreport" required>
                            <option selected>Open this select menu</option>
                            <option value="Penipuan">Penipuan</option>
                            <option value="Rusak">Barang Dijual Rusak</option>
                            <option value="Tidak Sesuai">Tidak Sesuai Deskripsi</option>
                            <option value="Other">Other</option>
                        </select>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Catatan</span>
                            </div>
                            <textarea class="form-control" aria-label="With textarea" name="catatan" required></textarea>
                        </div>
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