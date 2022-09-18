<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>File PBI</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">PBI</a></li>
              <li class="breadcrumb-item active">File</li>
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
            

            <div class="card">
              <div class="card-header">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-lg">Import File 
                    <i class="fa fa-plus"></i>
                </button>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                  <th width="5%">No</th>
                    <th>File</th>
                    <th>Tanggal</th>
                    <th>Download</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php 
                    if (!empty($file )) {
                        $no=1; foreach($file as $f){ ?>
                      <tr>
                        <td width="5%"><?=$no; ?></td>
                        <td><?=$f->nama_file; ?></td>
                        <td><?=$f->tanggal_file; ?></td>
                        <td style='text-align:center; vertical-align:middle'>
                            <i class="fa fa-file-excel" style="font-size:30px;color:green"></i>
                            <p><a href="<?=base_url().$f->path_file?>" download="<?=$f->nama_file?>">Download</a></p>
                        </td>
                      </tr>
                  <?php $no++;}} ?> 
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
                <form method="POST" enctype="multipart/form-data" action="<?=base_url()?>pbi/importFile">
                <div class="modal-header">
                    <h4 class="modal-title">Import File Excel</h4>
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
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Pilih File Excel </label>
                                        <input type="file" name="fileExcel">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="nama">Nama File</label>
                                        <input type="text" name="nama_file" class="form-control" id="nama_file" placeholder="contoh : KEBUMEN-REKAP TAGIHAN IURAN-BULAN TAGIH-01450001-2022-09-01" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Tanggal File</label>
                                        <div class="input-group" id="tanggal_file" >
                                            <input type="date" name="tanggal_file" class="form-control" required>
                                        </div>
                                    </div>
                                </div> 
                            </div>                  
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Import</button>
                </div>
                </form>
            </div>
            <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>                     

      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->