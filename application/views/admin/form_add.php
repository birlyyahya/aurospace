      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Form <?= $info['form']; ?></h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
              <div class="breadcrumb-item"><a href="#"><?= $info['form']; ?></a></div>
              <div class="breadcrumb-item">Form</div>
            </div>
          </div>

          <div class="section-body">
            <h2 class="section-title"><?= $info['form']; ?></h2>
            <p class="section-lead">
              Examples and usage guidelines for form control styles, layout options, and custom components for creating a wide variety of forms.
            </p>
            <div class="row">
              <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                  <div class="card-header">
                    <h4>Input <?= $info['form']; ?></h4>
                  </div>
                  <div class="card-body">
                    <form class="form-inline" method="POST" action="<?= site_url($info['url'] . '/save' . '/' . $tabel =  $info['tabel']) . '/' . $data = $info['nama'] . '/' . $info['form']; ?>">
                      <label class="sr-only" for="inlineFormInputGroupUsername2"><?= $info['form']; ?></label>
                      <div class="input-group col-12 pl-4">
                        <input type="text" class="form-control" name="nama" id="inlineFormInputGroupUsername2" placeholder="<?= $info['form']; ?>">
                      </div>
                      <div class="card-footer">
                        <button class="btn btn-primary" type="submit">Submit</button>
                        <button class="btn btn-warning" type="reset">Reset</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>