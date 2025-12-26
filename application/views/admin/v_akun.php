<?php
$this->load->view('admin/head');
?>
<!--tambahkan custom css disini-->

<?php
$this->load->view('admin/topbar');
$this->load->view('admin/sidebar');
?>
<!-- Content Header (Page header) -->


<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <?= $this->session->flashdata('message'); ?>
      <!-- Default box -->
      <div class="box box-success" style="overflow-x: scroll;">
        <div class="box-header">
          <center><h4 class="box-title">Data Admin</h4></center><p>
          <h3 class="box-title"></h3>
          <button type="button" class="btn btn-primary btn-flat" data-toggle="modal" data-target="#modal-default"> <span class="fa fa-plus"></span> Tambah</button>
        </div>
        <!-- /.box-header -->

        <div class="box-body">
          <table id="data" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th width="1%">No</th>
                <th>Nama Admin</th>
                <th>Username</th>
                <th width="12%"></th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              foreach ($akun as $m) { ?>
                <tr>
                  <td><?php echo $no++; ?></td>
                  <td><?php echo $m->nama_user; ?></td>
                  <td><?php echo $m->username; ?></td>
                  <td>
                    <div class="btn-group">
                      <button type="button" class="btn btn-warning btn-flat btn-xs">Action</button>
                      <button type="button" class="btn btn-warning btn-xs btn-flat dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                      </button>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="<?= base_url('akun/edit/') . $m->id; ?>">Edit Data</a></li>
                        <li><a href="<?= base_url('akun/hapus/') . $m->id; ?>" onclick="return confirm('Apakah yakin data ini di hapus?')">Hapus Data</a></li>
                      </ul>
                    </div>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section><!-- /.content -->

<!-- /. modal  -->
<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <center><h4 class="modal-title">Tambah Data Admin</h4></center>
      </div>
      <!-- /.form dengan modal -->
      <form method="post" action="<?php echo base_url() . 'akun/akun_aksi'; ?>">
        <div class="modal-body">
          <div class="form-group">
            <label class="font-weight-bold">Nama Admin</label>
            <input type="text" class="form-control" name="nama" placeholder="Masukkan Nama Admin" required="">
          </div>
          <div class="form-group">
            <label class="font-weight-bold">Username</label>
            <input type="text" class="form-control" name="username" placeholder="Masukkan Username" required="">
          </div>
          <div class="form-group">
            <label class="font-weight-bold">Password</label>
            <input type="password" class="form-control" name="password" placeholder="Masukkan Password" required="">
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success btn-flat">Simpan</button>
        </div>
      </form>
      <!-- /.tutup form dengan modal  -->
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<?php
$this->load->view('admin/js');
?>
<!--tambahkan custom js disini-->

<script type="text/javascript">
  $(document).ready(function() {
    $('#data').dataTable();
  });

  $('.alert-message').alert().delay(3000).slideUp('slow');
</script>

<?php
$this->load->view('admin/foot');
?>
