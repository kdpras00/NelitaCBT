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

    <div class="callout callout-danger">
        <h4>Selamat Datang, <?php echo $this->session->userdata('nama');?> </h4>
        
    </div>

    <div class="box box-danger box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">Petunjuk Penggunaan</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
            <dl>
                <dt></dt>
                <dd>
                    <ol>
                        <li><b>Data Master:</b> Kelola data mata pelajaran, guru, dan siswa melalui menu Data Master.</li>
                        <li><b>Kelola Soal:</b> Masukkan bank soal untuk setiap mata pelajaran.</li>
                        <li><b>Peserta Ujian:</b> Atur peserta yang berhak mengikuti ujian pada sesi tertentu.</li>
                        <li><b>Laporan Hasil:</b> Pantau dan cetak hasil ujian siswa secara real-time.</li>
                        <li><b>Ganti Password:</b> Disarankan untuk berkala mengganti password akun Anda demi keamanan.</li>
                    </ol>
                </dd>
            </dl>
            
    </div>

</section><!-- /.content -->
  
<?php 
$this->load->view('admin/js');
?>

<!--tambahkan custom js disini-->

<script type="text/javascript">

	$(function(){
		$('#data-tables').dataTable();
	});

	$('.alert-message').alert().delay(3000).slideUp('slow');

</script>


<?php
$this->load->view('admin/foot');
?>

