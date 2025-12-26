<?php 
$this->load->view('admin/head');
?>

<!--tambahkan custom css disini-->

<?php
$this->load->view('admin/topbar');
$this->load->view('admin/sidebar');
?>


<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            
            <div class="box box-danger" style="overflow-x: scroll;">
                <div class="box-header">
                    <center><h4 class="box-title">Data Siswa Belum Mengikuti Ujian</h4></center>
                </div>
                <form action="" method="get" class="form-horizontal">
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Mata Pelajaran</label>
                            <div class="col-sm-10">
                                <select class="select2 form-control" name="id" required="">
                                    <option selected="selected" disabled="">- Pilih Mata Pelajaran -</option>
                                    <?php foreach ($kelas as $a) { ?>
                                        <option value="<?= $a->id_matapelajaran ?>" <?= (isset($_GET['id']) && $_GET['id'] == $a->id_matapelajaran) ? 'selected' : '' ?>><?= $a->kode_matapelajaran; ?> | <?= $a->nama_matapelajaran; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"></label>
                            <div class="col-sm-10">
                                <a href="<?= base_url('hasil_ujian'); ?>" class="btn btn-default btn-flat"><span class="fa fa-arrow-left"></span> Kembali</a>
                                <button type="submit" class="btn btn-primary btn-flat" title="Filter Data"><span class="fa fa-filter"></span> Filter</button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>

            <!-- Default box -->
            <div class="box box-danger" style="overflow-x: scroll;">
                <div class="box-header" >
                    <?php if (isset($_GET['id'])) {
                     $mapel_id = $_GET['id'];
                     // Get mapel name for display if needed, but select holds it.
                    } ?>
                    <h3 class="box-title">Daftar Siswa Absen</h3>
                </div>
              <div class="box-body">
                <table id="data" class="table table-bordered table-striped">                    
                    <thead>
                        <tr>
                            <th width="1%">No</th>
                            <th>Nama Siswa</th>                            
                            <th>NIS</th>                            
                            <th>Kelas</th>                            
                            <th>Username</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no=1;
                        if(isset($belum_ujian)) {
                            foreach($belum_ujian as $d) { ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>                              
                                    <td><?php echo $d->nama_siswa; ?></td>                                
                                    <td><?php echo $d->nis; ?></td>                                
                                    <td><?php echo $d->nama_kelas; ?></td>
                                    <td><?php echo $d->username; ?></td>
                                </tr>
                            <?php } 
                        } ?>                  
                    </tbody> 
                </table>
            </div>
        </div>
        <!-- /.col-->
</div>
<!-- ./row -->
</section><!-- /.content -->

<?php 
$this->load->view('admin/js');
?>

<!--tambahkan custom js disini-->

<script type="text/javascript">

	$(function(){
		$('#data').dataTable();
        $('.select2').select2();
	});

	$('.alert-message').alert().delay(3000).slideUp('slow');

</script>

<?php
$this->load->view('admin/foot');
?>
