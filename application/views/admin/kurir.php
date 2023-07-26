      <!-- Main Content -->
      <div class="main-content">
          <section class="section">
              <div class="section-header">
                  <h1>Kurir</h1>
                  <div class="section-header-breadcrumb">
                      <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                      <div class="breadcrumb-item"><a href="#">Kurir</a></div>
                  </div>
              </div>

              <div class="section-body">
                  <h2 class="section-title">Kurir</h2>
                  <p class="section-lead">Example of some Bootstrap table components.</p>
                  <div class="row">
                      <div class="col-12">
                          <div class="card">
                              <div class="card-header">
                                  <h4>Data Kurir</h4>
                                  <a href="<?= site_url('pengiriman/add') . '/' . $form = 'kurir' . '/' . $url = 'pengiriman' . '/' . $tabel = 'tbl_kurir' . '/' . $nama = 'namakurir' ?>" class="btn btn-primary">Add</a>
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
                                          <?php foreach ($kurir as $item) : ?>
                                              <tr>
                                                  <td><?= $item->idkurir; ?></td>
                                                  <td><?= $item->namakurir; ?></td>
                                                  <td class="text-center">
                                                      <a href="<?= site_url('pengiriman/delete/' . $item->idkurir . '/' . $tabel = 'tbl_kurir' . '/' . $kolom = "idkurir") ?>" class="btn btn-danger">Delete</a>
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