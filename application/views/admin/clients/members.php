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
                  <h2 class="section-title">Members Account</h2>
                  <p class="section-lead">Example of some Bootstrap table components.</p>
                  <?= $this->session->flashdata('message'); ?>

                  <div class="row">
                      <div class="col-12 col-md-12 col-lg-12">
                          <div class="card">
                              <div class="card-body">
                                  <div class="table-responsive table-hover">
                                      <table class="table table-bordered table-md">
                                          <tr>
                                              <th>ID</th>
                                              <th>Username</th>
                                              <th>Name</th>
                                              <th>Address</th>
                                              <th>City</th>
                                              <th>Email</th>
                                              <th>Number</th>
                                              <th class="text-center">Status</th>
                                              <th class="text-center">Action</th>
                                          </tr>
                                          <?php foreach ($member as $item) : ?>
                                              <tr style="font-size: 13px;">
                                                  <td class="align-middle"><?= $item->idkonsumen; ?></td>
                                                  <td class="align-middle"><?= $item->username; ?></td>
                                                  <td class="align-middle"><?= $item->namakonsumen; ?></td>
                                                  <td class="align-middle"><?= $item->alamat; ?></td>
                                                  <td class="align-middle"><?= $item->namakota; ?></td>
                                                  <td class="align-middle"><?= $item->email; ?></td>
                                                  <td class="align-middle"><?= $item->telp; ?></td>
                                                  <?php if ($item->statusaktif == 'Y') { ?>
                                                      <td class="align-middle text-center"> <span class="badge badge-primary" style="font-size: 11px !important;">Aktif</span>
                                                      </td>
                                                  <?php } else { ?>
                                                      <td class="align-middle text-center"> <span class="badge badge-warning" style="font-size: 10px !important;">Terminated</span>
                                                      </td>
                                                  <?php } ?>
                                                  <td><a href="<?= site_url('members/login_user/') . $password = $item->password . '/' . $username = $item->username ?>" class="btn btn-primary">Login User</a></td>
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