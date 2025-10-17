<html lang="en">
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> <?=$judul;?></title>
        <link rel="shortcut icon" href="<?=base_url();?>assets/admin/img/favicon.ico">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style type="text/css">
body,td,th {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 10pt;
}
</style>
</head>
    <body>


<?php
$bulan=array(1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember');
?>
<h3><center>Laporan Pelaksanaan Kegiatan Bulan <?=$bulan[$bulannya];?> Tahun <?=$tahunnya;?><br>Kantor Wilayah Kementrian Agama Daerah Istimewa Yogyakarta</center></h3>
<table border="1px" cellspacing="0" cellpadding="3">
	<thead>
		<tr>
			<th width="20px">No</th>
			<th width="150px">Nomor Surat</th>
			<th width="320px">Pelaksana</th>
			<th width="150px">Acara</th>
			<th width="90px">Tanggal Pelaksanaan</th>
			<th>Tempat</th>
			<th width="90px">Ket Presensi</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$no=1;
			$no_pel=1;
			foreach($data_surat as $row)
			{
		?>
			<tr>
				<td valign="top" align="center"><?=$no++;?></td>
				<td valign="top"><?=$row['nomor_surat_admin'];?></td>
				<td valign="top">
					<table>
						<?php
						$id_surat=$row['id_surat'];
						$no_pel=1;
						$pelaksana=$this->ModelLaporan->daftar_anggota($id_surat);
						foreach($pelaksana as $pel)
						{
						?>
							</tr>
							<td valign="top"><?=$no_pel++;?></td>
							<td><?=$pel['nama_pegawai'];?></td>
						</tr>
						<?php
						}
						?>
						
					</table>
					
				</td>
				<td valign="top"><?=$row['nama_kegiatan'];?></td>
				<td valign="top" align="center"><?=date("d-m-Y",strtotime($row['mulai_tanggal'])).'<br>s.d<br>'. date("d-m-Y",strtotime($row['akhir_tanggal']));?></td>
				<td valign="top"><?=$row['tempat_kegiatan'];?></td>
				<td valign="top"><?=$row['presensi'];?></td>
			</tr>
		<?php
		}
		?>
	</tbody>

</table>
<script>print();</script>
</body>