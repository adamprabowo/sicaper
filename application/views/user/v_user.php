<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Pengguna</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Pengguna</li>
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
              <div class="card-header">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-lg">Tambah Pengguna 
                    <i class="fa fa-plus"></i>
                </button>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="penggunaTable" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th width="5%">No</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php $no=1; foreach($users as $user){ ?>
                  <tr>
                  <td width="5%"><?=$no; ?></td>
                    <td><?=$user->username; ?></td>
                    <td><?=$user->role_name; ?></td>
                    <td><?=$user->is_active==1? 'Aktif' : 'Non Aktif'; ?></td>
                    <td>
                        <!-- Call to action buttons -->
                        <ul class="list-inline m-0">
                            <li class="list-inline-item">
                                <a href="#" class="edit_user" data-toggle="modal" data-target="#modal_edit_user<?=$no?>" id="edit_user">
                                  <i class="fa fa-edit" style="color:green"></i>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#" class="delete_user" data-toggle="modal" data-target="#modal_delete_user<?=$no?>" id="delete_user">
                                  <i class="fa fa-trash" style="color:red"></i>
                                </a>
                            </li>
                        </ul>
                    </td>
                  </tr>
                  <?php $no++; } ?>
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

      <!-- modal -->
      <!-- CREATE -->
      <div class="modal fade" id="modal-lg">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <form method="POST" enctype="multipart/form-data" action="<?=base_url()?>user/tambahPengguna">
              <div class="modal-header">
                <h4 class="modal-title">Input Data Pengguna</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <!-- jquery validation -->
                  <!-- /.card-header -->
                  <!-- form start -->
                      <div class="card-body">
                        <div class="form-group">
                            <label for="nama">Username</label>
                            <input type="text" name="username" class="form-control" id="username" placeholder="Isikan Username" required>
                        </div>
                        <div class="form-group">
                            <label for="nama">Password</label>
                            <input type="password" name="password" class="form-control" id="password" placeholder="Isikan Password" required>
                        </div>
                        <div class="form-group">
                            <label>Role</label>
                            <select name="role" class="form-control" required>
                              <option>-- Pilih Role --</option>
                              <option value="2">Admin</option>
                              <option value="3">Operator</option>
                              <option value="4">Visitor</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" class="form-control" required>
                              <option>-- Pilih Status --</option>
                              <option value="1">Aktif</option>
                              <option value="0">Non Aktif</option>
                            </select>
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

      
      <?php $no=1; foreach($users as $user){ ?>
        <!-- EDIT -->
        <div class="modal fade" id="modal_edit_user<?=$no?>">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <form method="POST" enctype="multipart/form-data" action="<?=base_url()?>user/editPengguna">
                <div class="modal-header">
                  <h4 class="modal-title">Edit Data Pengguna</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <!-- jquery validation -->
                    <!-- /.card-header -->
                    <!-- form start -->
                        <div class="card-body">
                          <input type="hidden" name="user_id" id="user_id" value="<?=$user->user_id ?>">
                          <div class="form-group">
                              <label for="nama">Username</label>
                              <input type="text" name="username" class="form-control" id="username" value="<?=$user->username ?>">
                          </div>
                          <div class="form-group">
                              <label for="nama">Password</label>
                              <input type="password" name="password" class="form-control" id="password" value="<?=$user->password ?>">
                          </div>
                          <div class="form-group">
                              <label>Role</label>
                              <select name="role_id" class="form-control">
                                <?php
                                  foreach ($roles as $role) {
                                    if ($role->role_id==$user->role_id) {
                                      echo "<option selected value=".$role->role_id.">$role->role_name </option>";
                                    }
                                      echo "<option value=".$role->role_id.">$role->role_name </option>";
                                  }
                                ?>		
                              </select>
                          </div>
                          <div class="form-group">
                              <label>Status</label>
                              <select name="is_active" class="form-control">
                                <?php
                                  $aktif = 1;
                                  $nonaktif = 0;
                                  if ($user->is_active=1) {
                                    echo "<option selected value=".$aktif.">Aktif </option>";
                                  }
                                    echo "<option value=".$nonaktif.">Non Aktif </option>";
                                ?>		
                              </select>
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
        <div class="modal fade" id="modal_delete_user<?=$no?>">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Konfirmasi</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <p id="confirm_str">Yakin Hapus Pengguna <b><?=$user->username?></b> ?</p>
              </div>
              <div class="modal-footer">
                <a class="btn btn-danger" href="<?=base_url().'user/deletePengguna/'.$user->user_id ?>"> Hapus </a>
                <button class="btn btn-default" data-dismiss="modal"> Tidak</button>
              </div>
            </div>
          </div>
        </div>
      <?php $no++; } ?>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->