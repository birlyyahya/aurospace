<div class="main-content">
    <section class="section" style="position: relative; top:120px;">
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
                                <li class="nav-item"><a href="<?= site_url('transaksi/riwayat_pembelian') ?>" class="nav-link">Riwayat Transaksi</a></li>
                                <li class="nav-item"><a href="<?= site_url('world/toko') ?>" class="nav-link active">Toko</a></li>
                                <li class="nav-item"><a href="" class="nav-link">Ubah Profil</a></li>
                                <li class="nav-item"><a href="<?= site_url('world/logout') ?>" class="nav-link">Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-12">
                            <div class="card mb-0">
                                <div class="card-body">
                                    <ul class="nav nav-pills">
                                        <a class="nav-link bg-light fw-bold" href="<?= site_url('world/upload_toko') ?>">Silakan Membuat Toko</a>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Data Toko</h4>
                                    <div class="card-header-action">
                                    </div>
                                </div>
                                <div class="card-body p-0">
                                    <div class="table-responsive table-invoice">
                                        <table class="table table-striped">
                                            <tr>
                                                <th>Nama Toko</th>
                                                <th>Deskripsi</th>
                                                <th>Logo</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                            <?php foreach ($toko as $tk) : ?>
                                                <tr>
                                                    <td><?= $tk->namatoko ?></td>
                                                    <td class="font-weight-600"><?= $tk->deskripsi ?></td>
                                                    <td><?= $tk->logo ?></td>
                                                    <td>
                                                        <?php if ($tk->statusaktif == 'Y') { ?>
                                                            <span class="badge badge-primary" style="width: 88.5px;">Aktif</span>
                                                        <?php } else { ?>
                                                            <span class="badge badge-danger" style="width: 88.5px;">Terminated</span>
                                                        <?php } ?>
                                                    </td>

                                                    <td>
                                                        <a href="<?= site_url('world/dashboard_toko/') . $tk->idtoko ?>" class="btn btn-primary">Detail</a>
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
    </section>
</div>