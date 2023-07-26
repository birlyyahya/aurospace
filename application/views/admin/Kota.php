      <!-- Main Content -->
      <div class="main-content">
          <section class="section">
              <div class="section-header">
                  <h1>Kota</h1>
                  <div class="section-header-breadcrumb">
                      <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                      <div class="breadcrumb-item"><a href="#">Kota</a></div>
                  </div>
              </div>

              <div class="section-body">
                  <h2 class="section-title">Kota</h2>
                  <p class="section-lead">Example of some Bootstrap table components.</p>

                  <div class="row">
                      <div class="col-12 col-md-12 col-lg-12">
                          <div class="card">
                              <div class="card-header">
                                  <h4>Data Kota</h4>
                                  <a href="<?= site_url('pengiriman/add') . '/' . $form = 'kota' . '/' . $url = 'pengiriman' . '/' . $tabel = 'tbl_kota' . '/' . $nama = 'namakota' ?>" class="btn btn-primary">Add</a>
                              </div>
                              <?= $this->session->flashdata('huruf'); ?>
                              <div class="card-body">
                                  <div class="table-responsive">
                                      <table class="table table-bordered table-md">
                                          <tr>
                                              <th>ID</th>
                                              <th>Name</th>
                                              <th colspan="2" class="text-center">Action</th>
                                          </tr>
                                          <?php foreach ($kota as $item) : ?>
                                              <tr>
                                                  <td><?= $item->idkota; ?></td>
                                                  <td><?= $item->namakota; ?></td>
                                                  <td class="text-center">
                                                      <a href="<?= site_url('pengiriman/delete/' . $item->idkota . '/' . $tabel = 'tbl_kota' . '/' . $kolom = "idkota") ?>" class="btn btn-danger">Delete</a>
                                                  </td>
                                              </tr>
                                          <?php endforeach; ?>
                                      </table>
                                  </div>
                              </div>
                              <div class="card-footer text-right">
                                  <nav class="d-inline-block">
                                      <ul class="pagination mb-0">
                                          <li class="page-item disabled">
                                              <a class="page-link" href="#" tabindex="-1"><i class="fas fa-chevron-left"></i></a>
                                          </li>
                                          <li class="page-item active"><a class="page-link" href="#">1 <span class="sr-only">(current)</span></a></li>
                                          <li class="page-item">
                                              <a class="page-link" href="#">2</a>
                                          </li>
                                          <li class="page-item"><a class="page-link" href="#">3</a></li>
                                          <li class="page-item">
                                              <a class="page-link" href="#"><i class="fas fa-chevron-right"></i></a>
                                          </li>
                                      </ul>
                                  </nav>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </section>
      </div>