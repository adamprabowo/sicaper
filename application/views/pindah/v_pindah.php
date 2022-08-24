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
            

            <div class="card">
              <div class="card-header">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-lg">Input 
                    <i class="fa fa-plus"></i>
                </button>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="pindahTable" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>NIK</th>
                    <th>No KK</th>
                    <th>No SKPWNI</th>
                    <th>Nama</th>
                    <th>Desa</th>
                    <th>Tanggal Pindah</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr>
                    <td>1</td>
                    <td>3305230101010001</td>
                    <td>3305230101220001</td>
                    <td>SKPWNI/6303/220822/0010</td>
                    <td>Adi Wibowo</td>
                    <td>Karangsari</td>
                    <td>22 Agustus 2022</td>
                  </tr>
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



      <div class="modal fade" id="modal-lg">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
          <form id="quickForm">
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
                        <div class="form-group">
                            <label for="nik">NIK</label>
                            <input type="number" name="nik" class="form-control" id="nik" placeholder="Isikan NIK">
                        </div>
                        <div class="form-group">
                            <label for="no_kk">Nomor KK</label>
                            <input type="number" name="no_kk" class="form-control" id="noKK" placeholder="Isikan Nomor KK">
                        </div>
                        <div class="form-group">
                            <label for="no_skpwni">Nomor SKPWNI</label>
                            <input type="text" name="no_SKPWNI" class="form-control" id="noSKPWNI" placeholder="Isikan Nomor SKPWNI">
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" name="nama" class="form-control" id="nama" placeholder="Isikan Nama">
                        </div>
                        <div class="form-group">
                            <label for="desa">Desa</label>
                            <select class="form-control select2" style="width: 100%;">
                                <option selected="selected">Mrentul</option>
                                <option>Alaska</option>
                                <option>California</option>
                                <option>Delaware</option>
                                <option>Tennessee</option>
                                <option>Texas</option>
                                <option>Washington</option>
                            </select>
                        </div>
                        <div class="form-group">
                        <label>Tanggal Pindah</label>
                            <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate"/>
                                <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Simpan</button>
            </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->