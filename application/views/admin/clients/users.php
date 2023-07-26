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

                  <div class="row">
                      <div class="col-12 col-md-12 col-lg-12">
                          <div class="card">
                              <div class="card-body">
                                  <div class="table-responsive table-hover">
                                      <table class="table table-bordered table-md">
                                          <tr>
                                              <th>ID</th>
                                              <th>Username</th>
                                              <th>Password</th>
                                              <th>Name</th>
                                              <th>Address</th>
                                              <th>Email</th>
                                              <th>Number</th>
                                              <th class="text-center">Status</th>
                                              <th colspan="2" class="text-center">Action</th>
                                          </tr>
                                          <?php foreach ($member as $item) { ?>
                                              <tr>
                                                  <td class="align-middle"><?= $item->idkonsumen; ?></td>
                                                  <td class="align-middle"><?= $item->username; ?></td>
                                                  <td class="align-middle"><?= $item->password; ?></td>
                                                  <td class="align-middle"><?= $item->namakonsumen; ?></td>
                                                  <td class="align-middle"><?= $item->alamat; ?></td>
                                                  <td class="align-middle"><?= $item->email; ?></td>
                                                  <td class="align-middle"><?= $item->telp; ?></td>
                                                  <?php if ($item->statusaktif == 'Y') { ?>
                                                      <td class="align-middle"> <span class="badge badge-primary" style="width: 88.5px;">Aktif</span>
                                                      </td>
                                                  <?php } else { ?>
                                                      <td class="align-middle"> <span class="badge badge-danger" style="width: 88.5px;">Terminated</span>
                                                      </td>
                                                  <?php } ?>
                                                  <td class="text-center">
                                                      <a class="btn btn-primary" data-bs-toggle="collapse" href="#<?= $item->username; ?>" role="button" aria-expanded="false" aria-controls="<?= $item->username; ?>">
                                                          Detail
                                                      </a>
                                                  </td>
                                              </tr>
                                              <div class="collapse" id="<?= $item->username; ?>">
                                                  <div class="card">
                                                      <div class="card-body">
                                                          <div class="row g-3">
                                                              <div class="col-8">
                                                                  <form action="<?= site_url('members/update') ?>" method="POST">
                                                                      <div class="card-body">
                                                                          <div class="row">
                                                                              <div class="col-2 col-sm-3">
                                                                                  <label for="ID">ID</label>
                                                                                  <input type="text" class="form-control" id="ID" placeholder="ID" aria-label="First " width="10px" value="<?= $item->idkonsumen; ?>" disabled>
                                                                              </div>
                                                                              <div class="col">
                                                                                  <label for="username">Username</label>
                                                                                  <input type="text" class="form-control" id="username" placeholder="First name" aria-label="password" value="<?= $item->username; ?>">
                                                                              </div>
                                                                              <div class="col">
                                                                                  <label for="name">Nama</label>
                                                                                  <input type="text" class="form-control" id="nama" placeholder="Nama" aria-label="nama" value="<?= $item->namakonsumen; ?>">
                                                                              </div>
                                                                          </div>
                                                                          <div class="row g-3 mt-3">
                                                                              <div class="col-7 col-sm-6">
                                                                                  <label for="password">Password</label>
                                                                                  <input type="text" class="form-control" id="password " placeholder="password" aria-label="password" value="<?= $item->password; ?>">
                                                                              </div>
                                                                              <div class="col-5 col-sm-6">
                                                                                  <label for="email">Email</label>
                                                                                  <input type="text" class="form-control" id="email" placeholder="Email" aria-label="email" value="<?= $item->email; ?>">
                                                                              </div>
                                                                          </div>
                                                                          <div class="row g-3 mt-3">
                                                                              <div class="col-lg-4 col-sm-12">
                                                                                  <label for="address">Address</label>
                                                                                  <input type="text" class="form-control" id="address" placeholder="Address" aria-label="address" value="<?= $item->alamat; ?>">
                                                                              </div>
                                                                              <div class="col-lg-4 col-sm-12 mt-2">
                                                                                  <label for="city">City</label>
                                                                                  <select class="custom-select" aria-label="Default select example">
                                                                                      <option value="<?= $item->namakota; ?>" selected><?= $item->namakota; ?></option>
                                                                                      <?php foreach ($kota as $a) {
                                                                                        ?>
                                                                                          <option value="<?= $a->idkota; ?>"><?= $a->namakota; ?></option>
                                                                                      <?php
                                                                                        } ?>
                                                                                  </select>
                                                                              </div>
                                                                              <div class="col-lg-4 col-sm-12 mt-2">
                                                                                  <label for="number">Number</label>
                                                                                  <input type="tel" class="form-control" id="number" placeholder="Number" aria-label="address" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}" value="<?= $item->telp; ?>">
                                                                              </div>
                                                                          </div>
                                                                          <div class="row mt-3">
                                                                              <div class="col">
                                                                                  <label for="city">Status</label>
                                                                                  <select class="custom-select" aria-label="Default select example">
                                                                                      <?php if ($item->statusaktif == 'Y') {
                                                                                        ?>
                                                                                          <option value="Y" selected>Active</option>
                                                                                          <option value="N">Terminated</option>
                                                                                      <?php
                                                                                        } else {
                                                                                        ?>
                                                                                          <option value="Y">Active</option>
                                                                                          <option value="N" selected>Terminated</option>
                                                                                      <?php
                                                                                        } ?>
                                                                                  </select>
                                                                              </div>
                                                                          </div>
                                                                      </div>
                                                                      <div class="card-footer">
                                                                          <button class="btn btn-primary">Update</button>
                                                                      </div>
                                                                  </form>
                                                              </div>
                                                              <div class="col-4" style="padding-top:45px;">
                                                                  <div class="row justify-content-center" style="max-height: 355px; height:100%;">
                                                                      <div class="text-center">
                                                                          <figure class="figure" aria-hidden="true">
                                                                              <a href="#" class="fa-solid fa-store rounded-circle" style="font-size:100px; width:160px; height:160px; background-color:ghostwhite; line-height:160px;"></a>
                                                                              <figcaption class="figure-caption mt-3 text-light">Nama Toko</figcaption>
                                                                              <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nemo aspernatur voluptate ad quod perferendis a, sunt corrupti mollitia suscipit ipsa eligendi officia, inventore magni distinctio dolorum quae repellat magnam temporibus!</p>
                                                                          </figure>
                                                                      </div>
                                                                  </div>
                                                                  <div class="row justify-content-end">
                                                                      <div class="col-10">
                                                                          <div class="d-felx">
                                                                              <label for="inputPassword" class="col-md-12 col-lg-6 col-sm-12  col-form-label">Status Store</label>
                                                                              <?php if ($item->statusaktif == 'Y') { ?>
                                                                                  <span class="badge badge-primary" style="width: 88.5px;">Aktif</span>
                                                                              <?php } else { ?>
                                                                                  <span class="badge badge-danger" style="width: 88.5px;">Terminated</span>
                                                                              <?php } ?>
                                                                          </div>
                                                                      </div>
                                                                  </div>
                                                              </div>
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
                                          <?php }; ?>
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