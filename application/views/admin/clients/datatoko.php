      <!-- Main Content -->
      <div class="main-content">
          <section class="section">
              <div class="section-header">
                  <h1>Members</h1>
                  <div class="section-header-breadcrumb">
                      <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                      <div class="breadcrumb-item"><a href="#">Members</a></div>
                  </div>
              </div>

              <div class="section-body">
                  <h2 class="section-title">Store Accounts</h2>
                  <p class="section-lead">Example of some Bootstrap table components.</p>
                  <?= $this->session->flashdata('message'); ?>
                  <div class="row">
                      <div class="card-body p-0">
                          <div class="wrapper rounded">
                              <div class="table-responsive mt-3">
                                  <table class="table table-borderless">
                                      <thead>
                                          <tr>
                                              <th scope="col">ID Toko</th>
                                              <th scope="col">Nama Toko</th>
                                              <th scope="col">Nama Pemilik Toko</th>
                                              <th scope="col" class="text-center">Kesehatan Toko</th>
                                              <th scope="col" class="text-center">Jumlah Report <i class="fa-solid fa-flag"></i></th>
                                              <th scope="col" class="text-center">Action</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          <?php foreach ($toko as $rp) {
                                                $data = $this->Mfrontend->query("SELECT *, COUNT(idreport) AS 'jumlah' FROM tbl_report WHERE idtoko=" . $rp->idtoko . "")->row_array();
                                            ?>
                                              <tr>
                                                  <td><?= $rp->idtoko ?></td>
                                                  <td scope="row"><span class="fa fa-user mr-1"></span><?= $rp->namatoko ?></td>
                                                  <td class="text-muted"><?= $rp->username ?></td>
                                                  <td class="text-center"> <span class="badge badge-primary" style="font-size: 14px ;"><i class=" fa-solid fa-heart-circle-exclamation"></i> <?= intval($rp->nilai) ?>%</span></td>
                                                  <td class="text-center"> <span class="badge badge-info" style="font-size: 14px ;"><?= $data['jumlah'] ?></span> </td>
                                                  <td class="d-flex justify-content-center align-items-center">
                                                      <button type="button" class="btn btn-primary mr-3" data-toggle="collapse" data-target="#user<?= $rp->idtoko ?>" aria-expanded="true" aria-controls="user<?= $rp->idtoko ?>">
                                                          <i class="fa-solid fa-circle-info"></i>
                                                      </button>
                                                      <a href="" class="btn btn-danger"><i class="fa-solid fa-ban"></i>
                                                      </a>
                                                  </td>
                                              </tr>
                                          <?php
                                            }
                                            ?>
                                      </tbody>
                                  </table>
                                  <?php
                                    foreach ($toko as $rp) {
                                        $data['report'] = $this->Mfrontend->query("SELECT * FROM tbl_report tr INNER JOIN tbl_produk USING (idproduk) WHERE tr.idtoko=" . $rp->idtoko . "")->result();
                                    ?>
                                      <div id="user<?= $rp->idtoko ?>" class="collapse" aria-labelledby="headingOne" data-parent="#user<?= $rp->idtoko ?>">
                                          <div class="card-header  bg-secondary">
                                              Laporan Report
                                          </div>
                                          <div class="card-body p-0 bg-light">
                                              <div class="card card-statistic-2 m-0 bg-light">
                                                  <div class="table-responsive  p-4" style="max-height: 500px ; overflow-y:scroll;">
                                                      <table class="table table-striped table-md">
                                                          <thead class="text-dark">
                                                              <tr>
                                                                  <th>ID Report</th>
                                                                  <th>Nama Produk</th>
                                                                  <th>Jenis Report</th>
                                                                  <th>Reputasi Produk</th>
                                                                  <th>Catatan</th>
                                                                  <th>Action</th>
                                                              </tr>
                                                          </thead>
                                                          <tbody class="text-dark">
                                                              <?php foreach ($data['report'] as $d) {
                                                                ?>
                                                                  <tr>
                                                                      <td><?= $d->idreport ?></td>
                                                                      <td><?= $d->namaproduk ?></td>
                                                                      <td><?= $d->jenisreport ?></td>
                                                                      <td>
                                                                          <div class="badge badge-info"><i class="fa-solid fa-heart"></i> <?= intval($rp->nilai) ?></div>
                                                                      </td>
                                                                      <td style=" max-width: 250px; max-height: 20px;">
                                                                          <p style="max-width: 100%;margin: 0px;height: 90px;text-overflow: ellipsis; overflow-y: scroll;"><?= $d->komentar ?></p>
                                                                      </td>
                                                                      <td style="max-width: 100px;">
                                                                          <a href="<?= site_url('members/delete_produk/' . $d->idproduk . '/' . $d->idreport) ?>" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
                                                                          <a href="" class="btn btn-warning"><i class="fa-solid fa-triangle-exclamation"></i></a>
                                                                      </td>
                                                                  </tr>
                                                              <?php } ?>
                                                          </tbody>
                                                      </table>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="card-footer bg-light"></div>
                                      </div>
                                  <?php
                                    }
                                    ?>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </section>
      </div>
      <div class="modal hide fade pt-3" id="user1" tabindex="-1" aria-labelledby="1" aria-hidden="true" style="background-color:#00000073;">
          <div class="modal-dialog">
              <div class="modal-content">
                  <form action="report" method="post">
                      <input type="hidden" value="<?= "1" ?>" name="iddetailorder">
                      <div class="modal-header">
                          <h4 class="modal-title">Report Produk </h4>
                          <button type="button" class="btn" style="z-index: 999;" data-toggle="modal" data-target="#user1">
                              <i class="fa-solid fa-xmark" style="font-size: 18px;"></i>
                          </button>
                      </div>
                      <div class="container"></div>
                      <div class="modal-body">
                          <span for="produk" class="fs-4">Pilih Porduk</span>
                      </div>
                      <div class="modal-footer">
                          <button type="submit" class="btn btn-primary">Save changes</button>
                      </div>
                  </form>
              </div>
          </div>
      </div>