<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data PBI Aktif</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">PBI</a></li>
              <li class="breadcrumb-item active">Aktif</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            
            <?php if(!empty($this->session->flashdata('status'))){ ?>
            <div class="alert alert-info" role="alert"><?= $this->session->flashdata('status'); ?></div>
            <?php } ?>
            <div class="card">
              <div class="card-header">
                <!-- Tombol Import Excel-->
              <?php if($session['role_name']=='superadmin' || $session['role_name']=='admin') { ?>
              <form action="<?= base_url('pbi/importExcel'); ?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <label>Pilih File Excel </label>
                  <input type="file" name="fileExcel">
                </div>
                <div>
                  <button class='btn btn-success' type="submit">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                      Import		
                  </button>
                </div>
              </form>
              <?php } ?> 
              </div>
              
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th width="5%">No</th>
                    <th>NIK</th>
                    <!-- <th>Nama</th> -->
                  </tr>
                  </thead>
                  <tbody>
                  <?php foreach($pbi_aktif as $paktif){ ?>
                  <tr>
                    <td width="5%"><?=$paktif->id_pbi; ?></td>
                    <td><?=$paktif->nik; ?></td>
                  </tr>
                  <?php } ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->