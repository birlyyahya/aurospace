<div class="main-content">
    <section class="section" style="position: relative; top:120px;">
        <div class="row bg-white p-4">
            <article class="col-8 px-3 py-5">
                <h1 class="display-6">Shopping Cart</h1>
                <hr>
                <?php if (empty($this->cart->contents())) {
                ?>
                    <div class="container" style="overflow-y: scroll; max-height:380px; height:100%;">
                        <p class="h6 text-center" style="line-height:15;">Keranjang Kosong</p>
                    <?php
                } else { ?>
                        <div class="container" style="overflow-y: scroll; max-height:380px;">
                            <?php $i = 1; ?>
                            <?php foreach ($this->cart->contents() as $items) : ?>
                                <div id="cart">
                                    <div class="row pt-2 align-items-center">
                                        <div class="col-2">
                                            <img src="<?= site_url('assets/assets/img/products/') . $items['foto'];  ?>" class="rounded-circle" alt="..." width="100%" height="90">
                                        </div>
                                        <div class="col-3">
                                            <div class="d-inline">
                                                <h6 class="mb-0"> <?= $items['name']; ?>
                                                </h6>
                                                <p class="text-muted"><?= $items['namatoko']; ?></p>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="input-group">
                                                <span class="input-group-btn">
                                                    <button name="minus_cart" data-productid=<?= $items['rowid'] ?> type="button" class="btn btn-default btn-number minus_cart"> <i class="fa-solid fa-minus"></i></button>
                                                </span>
                                                <input id=<?= $items['rowid'] ?> type=number min=1 class="form-control rounded-pill text-center" value="<?= $items['qty'] ?>">
                                                <span class="input-group-btn">
                                                    <button name="plus_cart" data-productid=<?= $items['rowid'] ?> type="button" class="btn btn-default btn-number plus_cart"> <i class="fa-solid fa-plus"></i></button>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-2" id="harga">
                                            <h6 class="p-2">Rp<?= number_format($items['price'] * $items['qty'], 0, '', '.'); ?></h6>
                                        </div>
                                        <div class="col-2">
                                            <a href="<?= site_url('produk/remove/') . $items['rowid'] ?>" class="btn" type="reset"><i class="fa-solid fa-xmark"></i></a>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                                <?php $i++; ?>
                            <?php endforeach; ?>
                        </div>
                    <?php } ?>
            </article>
            <aside class="col-4 bg-dark rounded pt-5 px-5 shadow" style="max-height:600px ;">
                <h5 class="text-light">Cart Details</h5>
                <span>
                    <?= $this->session->flashdata('message'); ?>
                </span>
                <div id="details">
                    <form action="cart" method="post">
                        <div class="row">
                            <?php if (empty($ongkir)) { ?>
                                <div class="col-12 mt-3">
                                    <label for="kota-asal">Pilih Kota anda</label>
                                    <select class="custom-select" name="kota" id="kurir" required>
                                        <option selected disabled value="">Pilih Kota anda</option>
                                        <?php foreach ($kota as $p) { ?>
                                            <option type="submit" value="<?= $p->idkota ?>"><?= $p->namakota ?></option>
                                        <?php
                                        } ?>
                                    </select>
                                </div>
                                <div class="col-10 mt-3">
                                    <label for="kota-asal">Pilih Pengirim</label>
                                    <select class="custom-select" name="kurir" id="kurir" required>
                                        <option selected disabled value="">Pilih Pengiriman</option>
                                        <?php foreach ($pengirim as $p) { ?>
                                            <option type="submit" value="<?= $p->idkurir ?>"><?= $p->namakurir ?></option>
                                        <?php
                                        } ?>
                                    </select>
                                </div>
                                <?php foreach ($this->cart->contents() as $items) : ?>
                                    <input type="hidden" name="idtoko" value="<?= $items['idtoko'] ?>">
                                <?php endforeach; ?>
                                <div class="col-2 mt-4 p-0">
                                    <button class="btn text-light text-left p-0" type="submit"><i class="fa-solid fa-check" style="font-size: 18px; line-height:4"></i></button>
                                </div>
                                <div class="col-12 mt-3">
                                    <input id="ongkir" type="text" class="form-control" placeholder="" aria-label="First name" value="Cek ongkir terlebih dahulu!">
                                </div>
                            <?php } else {
                            ?>
                        </div>
                        <br>
                        <div class="d-flex mb-4 justify-content-between text-light">
                            <span><i class="fa-solid fa-truck"></i> <span class="ps-2">Kota Tujuan: </span></span>
                            <span class="ps-3"> <i class="fa-solid fa-location-dot"></i> <?= $ongkir['Kota Tujuan'] ?></span>
                        </div>
                        <div class="d-flex mb-4 justify-content-between text-light">
                            <span> <i class="fa-solid fa-truck-ramp-box"></i> <span class="ps-2">Pengiriman Dari: </span></span>
                            <span class="ps-3"> <i class="fa-solid fa-location-dot"></i> <?= $ongkir['namakota'] ?></span>
                        </div>
                        <label for="">Biaya Ongkir</label>
                        <input id="ongkir" type="text" class="form-control" placeholder="" aria-label="First name" value="Rp<?= number_format($ongkir['biaya'], 0, '', '.') ?>" readonly>
                    <?php
                            } ?>
                    </form>
                    <footer class="main-footer mb-3">
                        <div class="footer">
                            <form action="<?= site_url('transaksi/add_order') ?>" method="POST">
                                <?php foreach ($this->cart->contents() as $items) : ?>
                                    <input type="hidden" name="qty" id="qty" value="<?= $items['qty'] ?>">
                                    <input type="hidden" name="price" id="price" value="<?= $items['price'] ?>">
                                    <input type="hidden" name="name" id="name" value="<?= $items['name'] ?>">
                                    <input type="hidden" name="idtoko" id="idtoko" value="<?= $items['idtoko'] ?>">
                                    <input type="hidden" name="konsumen" id="konsumen" value="<?= $this->session->userdata['idkonsumen'] ?>">
                                    <?php if (!empty($ongkir)) { ?>
                                        <input type="hidden" name="ongkir" id="ongkir" value="<?= $ongkir['biaya'] ?>">
                                    <?php } ?>
                                <?php endforeach; ?>
                                <div class="d-flex text-light justify-content-between">
                                    <h6 id="harga">Subtotal</h6>
                                    <h6 id="harga">
                                        <?php if (!empty($ongkir)) {
                                        ?>
                                            <input type="hidden" name="total" id="total" value="<?= $this->cart->total() + $ongkir['biaya'] ?>">
                                            <h6 class="p-2">Rp<?= number_format($this->cart->total() + $ongkir['biaya'], 0, '', '.'); ?></h6>
                                        <?php } else {
                                        ?>
                                            <h6 class="p-2">Rp <?= number_format($this->cart->total(), 0, '', '.'); ?></h6>
                                        <?php
                                        } ?>
                                    </h6>
                                </div>
                                <button type="submit" class="btn btn-primary w-100 mt-3">Checkout</button>
                            </form>
                        </div>
                    </footer>
                </div>
            </aside>
            <a href="<?= site_url('world') ?>"><i class="fa-solid fa-angles-left"></i> Continue Shopping</a>
        </div>
    </section>
</div>