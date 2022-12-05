<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Kematian Penduduk</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Kematian</li>
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
            <!-- Alert -->
            <?php if(!empty($this->session->flashdata('status'))){ ?>
            <div class="alert alert-info" role="alert"><?= $this->session->flashdata('status'); ?></div>
            <?php } ?>

            <div class="card">
              <?php if($session['role_name']=='operator') { ?>
              <div class="card-header">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-lg">Input 
                    <i class="fa fa-plus"></i>
                </button>
              </div>
              <?php } ?>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="pindahTable" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th width="5%">No</th>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>No Akta Kematian</th>
                    <th>Tanggal Akta Kematian</th>
                    <th>Aksi</th> 
                  </tr>
                  </thead>
                  <tbody>
                  <?php if (!empty($kematian)) {
                    $no=1; foreach($kematian as $dt){ ?>
                    <tr>
                    <td width="5%"><?=$no; ?></td>
                    <td><?=$dt->nik; ?></td>
                    <td><?=$dt->nama; ?></td>
                    <td><?=$dt->no_akta; ?></td>
                    <td><?=date("d-m-Y", strtotime($dt->tgl_aktakematian)); ?></td>
                    <td>
                        <!-- Call to action buttons -->
                        <ul class="list-inline m-0">
                            <?php if($session['role_name']=='operator') { ?>
                            <li class="list-inline-item">
                                <a href="#" class="edit_kematian" data-toggle="modal" data-target="#modal_edit_kematian<?=$no?>" id="edit">
                                  <i class="fa fa-edit" style="color:orange"></i>
                                </a>
                            </li>
                            <?php } ?>
                            <?php if($session['role_name']=='superadmin' || $session['role_name']=='admin') { ?>
                            <li class="list-inline-item">
                                <a href="#" class="delete_kematian" data-toggle="modal" data-target="#modal_delete_kematian<?=$no?>" id="delete">
                                  <i class="fa fa-trash" style="color:red"></i>
                                </a>
                            </li>
                            <?php }?>
                        </ul>
                    </td>
                    </tr>
                  <?php $no++; }} ?>
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


      <!-- modal -->
      <!-- CREATE -->
      <div class="modal fade" id="modal-lg">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <form method="POST" enctype="multipart/form-data" action="<?=base_url()?>kematian/inputData">
              <div class="modal-header">
                <h4 class="modal-title">Input Data Kematian</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <!-- jquery validation -->
                  <!-- /.card-header -->
                  <!-- form start -->
                      <div class="card-body">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                  <label for="nik">NIK</label>
                                  <input type="number" name="nik" class="form-control" id="nik" placeholder="Isikan NIK" required>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                  <label for="nama">Nama</label>
                                  <input type="text" name="nama" class="form-control" id="nama" placeholder="Isikan Nama Lengkap" required>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                  <label for="no_akta">Nomor Akta Kematian</label>
                                  <input type="text" name="no_akta" class="form-control" id="no_akta" placeholder="Isikan Nomor Akta Kematian" required>
                              </div>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
                              <label>Tanggal Akta Kematian</label>
                              <div class="input-group" id="tgl_aktakematian" >
                                  <input type="date" name="tgl_aktakematian" class="form-control" required>
                              </div>
                            </div>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
                              <label>Tanggal Kematian</label>
                              <div class="input-group" id="tgl_kematian" >
                                  <input type="date" name="tgl_kematian" class="form-control" required>
                              </div>
                            </div>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
                              <label for="desa">Desa</label>
                              <select type="number" name="id_desa" class="form-control select2" style="width: 100%;" required>
                                <?php
                                  foreach ($desa as $ds) {
                                      echo "<option value=".$ds->id.">$ds->desa - $ds->kecamatan</option>";
                                  }
                                ?>	
                              </select>
                             </div>
                                </div>
                          </div>
                         
                          
                          
                      </div>
                      <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
              </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

      <!-- EDIT -->
      <?php if (!empty($kematian)) {
        $no=1; foreach($kematian as $dt){ ?> 
        <div class="modal fade" id="modal_edit_kematian<?=$no?>">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <form method="POST" enctype="multipart/form-data" action="<?=base_url()?>kematian/editData">
                <div class="modal-header">
                  <h4 class="modal-title">Edit Data Kematian</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <!-- jquery validation -->
                    <!-- /.card-header -->
                    <!-- form start -->
                        <div class="card-body">
                            <input type="hidden" name="id_kematian" id="id_kematian" value="<?=$dt->id_kematian ?>">
                            <div class="form-group">
                                <label for="nik">NIK</label>
                                <input type="number" name="nik" class="form-control" id="nik" value="<?=$dt->nik ?>">
                            </div>
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" name="nama" class="form-control" id="nama" value="<?=$dt->nama ?>">
                            </div>
                            <div class="form-group">
                                <label for="no_akta">Nomor Akta Kematian</label>
                                <input type="text" name="no_akta" class="form-control" id="no_akta" value="<?=$dt->no_akta ?>">
                            </div>
                           
                            <div class="form-group">
                                <label for="desa">Desa</label>
                                <select type="number" name="id_desa" class="form-control select2" style="width: 100%;">
                                  <?php
                                    foreach ($desa as $ds) {
                                      if ($ds->desa==$dt->nama_desa) {
                                        echo "<option selected value=".$ds->id.">$ds->desa - $ds->kecamatan</option>";
                                      }
                                        echo "<option value=".$ds->id.">$ds->desa - $ds->kecamatan</option>";
                                    }
                                  ?>		
                                </select>
                            </div>
                            <div class="form-group">
                            <label>Tanggal Akta Kematian</label>
                                <div class="input-group date" id="test">
                                    <input type="date" name="tgl_aktakematian" class="form-control" value="<?=$dt->tgl_aktakematian ?>"/>
                                </div>
                            </div>
                            
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
              </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>

        <!-- DELETE -->
        <div class="modal fade" id="modal_delete_kematian<?=$no?>">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Konfirmasi</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <p id="confirm_str">Yakin Hapus Data <b><?=$dt->nama?></b> ?</p>
              </div>
              <div class="modal-footer">
                <a class="btn btn-danger" href="<?=base_url().'kematian/deleteData/'.$dt->id_kematian ?>"> Hapus </a>
                <button class="btn btn-default" data-dismiss="modal"> Tidak</button>
              </div>
            </div>
          </div>
        </div>
      <?php $no++; } } ?>

      <!-- /.modal -->
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  