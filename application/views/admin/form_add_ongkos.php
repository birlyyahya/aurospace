<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Form Detail Pengiriman</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Form Detail Pengiriman</a></div>
                <div class="breadcrumb-item">Form</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Form Detail Pengiriman</h2>
            <p class="section-lead">
                Examples and usage guidelines for form control styles, layout options, and custom components for creating a wide variety of forms.
            </p>

            <div class="row">
                <form class="col-6" method="POST" action="<?= site_url('pengiriman/add_biaya/' . $tabel = 'tbl_biaya_kirim') ?>">
                    <div class="card">
                        <div class="card-header">
                            <h4>Detail Pengiriman</h4>
                        </div>
                        <div class="card-body">
                            <div class="section-title mt-0">Kota Asal</div>
                            <div class="form-group">
                                <label>Kota</label>
                                <select class="custom-select" name="kota-asal">
                                    <option selected>Pilih Kota Asal</option>
                                    <?php foreach ($kota as $item) : ?>
                                        <option value="<?= $item->idkota ?>"><?= $item->namakota ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="section-title mt-0">Kota Tujuan</div>
                            <div class="form-group">
                                <label>Choose One</label>
                                <select class="custom-select" name="kota-tujuan">
                                    <option selected>Pilih Kota Tujuan</option>
                                    <?php foreach ($kota as $item) : ?>
                                        <option value="<?= $item->idkota ?>"><?= $item->namakota ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="section-title mt-0">Kurir</div>
                            <div class="form-group">
                                <label>Choose One</label>
                                <select class="custom-select" name="kurir">
                                    <option selected>Pilih Kurir</option>
                                    <?php foreach ($kurir as $item) : ?>
                                        <option value="<?= $item->idkurir ?>"><?= $item->namakurir ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="section-title">Ongkos Kirim</div>
                            <div class="input-group">
                                <input type="text" class="form-control" name="biaya" id="inlineFormInputGroupUsername2" placeholder="Biaya">
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary" type="submit">Submit</button>
                            <button class="btn btn-warning" type="reset">Reset</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>