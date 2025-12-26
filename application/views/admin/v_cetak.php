<!DOCTYPE html>
<html>
<head>
	<title>Cetak Hasil Ujian</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 11pt;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 5px;
            text-align: center;
            font-size: 9pt;
        }
        th {
            background-color: #D3D3D3;
        }
        .header-table, .header-table td {
            border: none;
            text-align: center; 
            padding: 0;
        }
        .header-image {
            width: 65px;
            height: auto;
        }
        .header-text {
            text-align: center;
            line-height: 1.2;
        }
        .report-title {
            text-align: center;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <table class="header-table">
        <tr>
            <td width="100">
                <img src="image/logosmkn5.png" class="header-image">
            </td>
            <td>
                <div class="header-text">
                    KEMENTRIAN PENDIDIKAN DAN KEBUDAYAAN <br>
                    <b>SMKN 5 KOTA TANGERANG</b> <br>
                    Jl. Tripraja No.1, RT.003/RW.005, Panunggangan Utara, Kec. Pinang, Kota Tangerang, Banten 15143
                </div>
            </td>
            <td width="100">
                <!-- Spacer for centering -->
            </td>
        </tr>
    </table>
    <hr>

    <!-- Content -->
    <h3 class="report-title">Laporan Hasil Ujian</h3>

    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th>Nama Siswa</th>                            
                <th>NIS</th>                            
                <th>Mata Pelajaran</th>                            
                <th width="20%">Waktu Ujian</th>                  
                <th>Jenis Ujian</th>                            
                <th>Benar</th>                            
                <th>Salah</th>                            
                <th>Nilai</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach($cetak as $d){
            ?>
            <tr>
                <td><?php echo $no++; ?></td>                              
                <td><?php echo $d->nama_siswa; ?></td>                                
                <td><?php echo $d->nis; ?></td>                                
                <td><?php echo $d->nama_matapelajaran; ?></td>                                
                <td><?php echo date('d-m-Y',strtotime($d->tanggal_ujian)); ?> | <?php echo date('H:i:s',strtotime($d->jam_ujian)); ?></td>
                <td><?php echo $d->jenis_ujian; ?></td>
                <td>
                    <?php
                    if($d->benar == ''){
                        echo "Belum Ujian";
                    }else {
                        echo $d->benar;
                    }
                    ?>
                </td>                                
                <td>
                    <?php
                    if($d->salah == ''){
                        echo "Belum Ujian";
                    }else {
                        echo $d->salah;
                    }
                    ?>
                </td>
                <td>
                    <?php
                    if($d->nilai == ''){
                        echo "Belum Ujian";
                    }else {
                        echo $d->nilai;
                    }
                    ?>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

    <br><br>

    <!-- Footer -->
    <div style="text-align: center;">
        <?php 
        $date = Date("d/m/Y");
        $jam = Date("H:i:s");
        echo "Laporan dicetak pada tanggal $date Jam $jam"; 
        ?>
    </div>

	<script type="text/javascript">
		window.print();
	</script>
</body>
</html>