      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Category</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
              <div class="breadcrumb-item"><a href="#">Category</a></div>
            </div>
          </div>

          <div class="section-body">
            <h2 class="section-title">Category</h2>
            <p class="section-lead">Example of some Bootstrap table components.</p>

            <div class="row">
              <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                  <div class="card-header">
                    <h4>Simple Table</h4>
                    <a href="<?= site_url('kategori/add') . '/' . $form = 'kategori' . '/' . $url = 'kategori' . '/' . $tabel = 'tbl_kategori' . '/' . $nama = 'namakategori' ?>" class="btn btn-primary">Add</a>
                  </div>
                  <?= $this->session->flashdata('huruf'); ?>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-bordered table-md">
                        <tr>
                          <th>#</th>
                          <th>Name</th>
                          <th colspan="2" class="text-center">Action</th>
                        </tr>
                        <?php foreach ($kategori as $item) : ?>
                          <tr>
                            <td><?= $item->idkategori; ?></td>
                            <td><?= $item->namakategori; ?></td>
                            <td class="text-center">
                              <a href="<?= site_url('kategori/delete/' . $item->idkategori) ?>" class="btn btn-danger">Delete</a>
                            </td>
                            <td class="text-center">
                              <a href="<?= site_url('kategori/getid/' . $item->idkategori) ?>" class="btn btn-warning">Edit</a>
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