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
                                <li class="nav-item"><a href="<?= site_url('world/dashboard_toko/') . $id['idtoko'] ?>" class="nav-link">Beranda</a></li>
                                <li class="nav-item"><a href="<?= site_url('world/produk/') . $id['idtoko'] ?>" class="nav-link active">Upload Produk</a></li>
                                <li class="nav-item"><a href="<?= site_url('transaksi/konfirmasi/') . $id['idtoko'] ?>" class="nav-link">Riwayat Transaksi</a></li>
                                <li class="nav-item"><a href="<?= site_url('transaksi/laporan_toko/') .  $id['idtoko'] ?>" class="nav-link">Laporan</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <form id="setting-form" method="post" enctype="multipart/form-data" action="<?= site_url('world/aksi_upload_produk/') . $id['idtoko'] ?>">
                        <div class="card" id="settings-card">
                            <div class="card-header">
                                <h4>Form Tambah Produk</h4>
                            </div>
                            <input type="hidden" name="idtoko" value="<?= $id['idtoko'] ?>">
                            <div class="card-body">
                                <p class="text-muted">General settings such as, site title, site description, address and so on.</p>
                                <div class="form-group row align-items-center">
                                    <label for="site-title" class="form-control-label col-sm-3 text-md-right">Name Product</label>
                                    <div class="col-sm-6 col-md-9">
                                        <input type="text" name="nama" class="form-control" id="site-title">
                                    </div>
                                </div>
                                <div class="form-group row align-items-center">
                                    <label for="site-description" class="form-control-label col-sm-3 text-md-right">Deskripsi</label>
                                    <div class="col-sm-6 col-md-9">
                                        <textarea class="form-control" name="deskripsi" id="site-description" placeholder="Tell us about your product"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row align-items-end">
                                    <label for="site-title" class="form-control-label col-sm-3 text-md-right">Stock</label>
                                    <div class="col-sm-6 col-md-2">
                                        <input type="text" name="stok" class="form-control" id="site-title" placeholder="Stock">
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <input type="text" name="berat" class="form-control" id="site-title" placeholder="Weight">
                                    </div>
                                    <div class="col-sm-6 col-md-4">
                                        <input type="text" name="harga" class="form-control" id="site-title" placeholder="Price">
                                    </div>
                                </div>
                                <div class="form-group row align-items-center">
                                    <label class="form-control-label col-sm-3 text-md-right">Category</label>
                                    <div class="col-sm-6 col-md-9">
                                        <select class="custom-select" aria-label="Default select example" name="kategori">
                                            <option selected>Open this select menu</option>
                                            <?php foreach ($kategori as $kat) : ?>
                                                <option value="<?= $kat->idkategori ?>"><?= $kat->namakategori ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row align-items-center">
                                    <label class="form-control-label col-sm-3 text-md-right">Picture</label>
                                    <div class="col-sm-6 col-md-9">
                                        <div class="custom-file">
                                            <input type="file" name="gambar" class="custom-file-input" id="site-logo">
                                            <label class="custom-file-label">Choose File</label>
                                        </div>
                                        <div class="form-text text-muted">The image must have a maximum size of 1MB</div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-md-right">
                                <button class="btn btn-primary" id="save-btn">Save Changes</button>
                                <button class="btn btn-secondary" type="button">Reset</button>
                            </div>
                        </div>
                    </form>
                </div>