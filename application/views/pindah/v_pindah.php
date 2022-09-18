<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Perpindahan Penduduk</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Perpindahan</li>
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
                    <th>Tanggal Pindah</th>
                    <th>Desa Asal</th>
                    <th>Tujuan Pindah</th>
                    <th>Aksi</th> 
                  </tr>
                  </thead>
                  <tbody>
                  <?php if (!empty($pindah)) {
                    $no=1; foreach($pindah as $pd){ ?>
                    <tr>
                    <td width="5%"><?=$no; ?></td>
                    <td><?=$pd->nik; ?></td>
                    <td><?=$pd->nama; ?></td>
                    <td><?=$pd->tgl_pindah; ?></td>
                    <td><?=$pd->nama_desa."<br>\n". "RT : ".$pd->rt."&emsp;RW : ".$pd->rw; ?></td>
                    <td><?=$pd->keterangan?></td>
                    <td>
                        <ul class="list-inline m-0">
                            <li class="list-inline-item">
                                <a href="#" class="edit_pindah" data-toggle="modal" data-target="#modal_edit_pindah<?=$no?>" id="edit_pindah">
                                  <i class="fa fa-edit" style="color:orange"></i>
                                </a>
                            </li>
                            <?php if($session['role_name']=='superadmin' || $session['role_name']=='admin') { ?>
                            <li class="list-inline-item">
                                <a href="#" class="delete_pindah" data-toggle="modal" data-target="#modal_delete_pindah<?=$no?>" id="delete_pindah">
                                  <i class="fa fa-trash" style="color:red"></i>
                                </a>
                            </li>
                            <?php } ?> 
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
            <form method="POST" enctype="multipart/form-data" action="<?=base_url()?>pindah/inputPerpindahan">
              <div class="modal-header">
                <h4 class="modal-title">Input Data Perpindahan</h4>
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
                                <input type="text" name="nama" class="form-control" id="nama" placeholder="Isikan Nama" required>
                            </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                              <label>Tanggal Pindah</label>
                                  <div class="input-group" id="tgl_pindah" >
                                      <input type="date" name="tgl_pindah" class="form-control" required>
                                  </div>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Tujuan Pindah</label>
                                <select name="keterangan" class="form-control" required>
                                  <option>-- Pilih Tujuan Pindah --</option>
                                  <option value="pindah_kab">Pindah Kabupaten</option>
                                  <option value="pindah_prov">Pindah Provinsi</option>
                                </select>
                              </div>
                            </div>
                          </div>  
                          <div class="row">   
                            <div class="col-md-6">                    
                              <div class="form-group">
                                  <label for="desa">Desa Asal</label>
                                  <select type="number" name="id_desa" class="form-control select2" style="width: 100%;" required>
                                  <option>-- Pilih Desa Asal --</option>
                                    <?php
                                      foreach ($desa as $ds) {
                                          echo "<option value=".$ds->id.">$ds->desa - $ds->kecamatan</option>";
                                      }
                                    ?>	
                                  </select>
                              </div>  
                            </div>
                            <div class="col-md-2">
                              <div class="form-group">
                                  <label for="RT">RT</label>
                                  <input type="text" name="rt" class="form-control" id="rt" placeholder="Isikan RT" required>
                              </div>
                            </div>
                            <div class="col-md-2">
                              <div class="form-group">
                                  <label for="RW">RW</label>
                                  <input type="text" name="rw" class="form-control" id="rw" placeholder="Isikan RW" required>
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
      <?php if (!empty($pindah)) {
        $no=1; foreach($pindah as $pd){ ?> 
        <div class="modal fade" id="modal_edit_pindah<?=$no?>">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <form method="POST" enctype="multipart/form-data" action="<?=base_url()?>pindah/editPerpindahan">
                <div class="modal-header">
                  <h4 class="modal-title">Edit Data Perpindahan</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <!-- jquery validation -->
                    <!-- /.card-header -->
                    <!-- form start -->
                        <div class="card-body">
                        <input type="hidden" name="id_pindah" id="id_pindah" value="<?=$pd->id_pindah ?>">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                  <label for="nik">NIK</label>
                                  <input type="number" name="nik" class="form-control" id="nik" value="<?=$pd->nik ?>">
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                  <label for="nama">Nama</label>
                                  <input type="text" name="nama" class="form-control" id="nama" value="<?=$pd->nama ?>">
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                              <label>Tanggal Pindah</label>
                                  <div class="input-group date" id="date">
                                      <input type="date" name="tgl_pindah" class="form-control" value="<?=date('Y-m-d',strtotime($pd->tgl_pindah))  ?>"/>
                                  </div>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Tujuan Pindah</label>
                                <select name="keterangan" class="form-control" required>
                                  <?php
                                      if ($pd->keterangan=='Pindah Kabupaten') {
                                        echo "<option selected value='pindah_kab'>Pindah Kabupaten</option>";
                                      }
                                      else {
                                        echo "<option selected value='pindah_prov'>Pindah Provinsi</option>";
                                      }
                                        echo "<option value='pindah_kab'>Pindah Kabupaten</option>";
                                        echo "<option value='pindah_prov'>Pindah Provinsi</option>";
                                  ?>		
                                </select>
                              </div>
                            </div>
                          </div>  
                          <div class="row">   
                            <div class="col-md-6">                    
                              <div class="form-group">
                                  <label for="desa">Desa Asal</label>
                                  <select type="number" name="id_desa" class="form-control select2" style="width: 100%;">
                                    <?php
                                      foreach ($desa as $ds) {
                                        if ($ds->desa==$pd->nama_desa) {
                                          echo "<option selected value=".$ds->id.">$ds->desa - $ds->kecamatan</option>";
                                        }
                                          echo "<option value=".$ds->id.">$ds->desa - $ds->kecamatan</option>";
                                      }
                                    ?>		
                                  </select>
                              </div>
                            </div>
                            <div class="col-md-2">
                              <div class="form-group">
                                  <label for="RT">RT</label>
                                  <input type="text" name="rt" class="form-control" id="rt" placeholder="Isikan RT" value="<?=$pd->rt ?>">
                              </div>
                            </div>
                            <div class="col-md-2">
                              <div class="form-group">
                                  <label for="RW">RW</label>
                                  <input type="text" name="rw" class="form-control" id="rw" placeholder="Isikan RW" value="<?=$pd->rw ?>">
                              </div>
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
        <div class="modal fade" id="modal_delete_pindah<?=$no?>">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Konfirmasi</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <p id="confirm_str">Yakin Hapus Perpindahan <b><?=$pd->nama?></b> ?</p>
              </div>
              <div class="modal-footer">
                <a class="btn btn-danger" href="<?=base_url().'pindah/deletePerpindahan/'.$pd->id_pindah ?>"> Hapus </a>
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

  