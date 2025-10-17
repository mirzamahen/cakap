<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Laporan Kinerja.xls");
	
	if($bulan==01){
		$bulannya='Januari';
	}elseif($bulan==02){
		$bulannya='Februari';
	}elseif($bulan==03){
		$bulannya='Maret';
	}elseif($bulan==04){
		$bulannya='April';
	}elseif($bulan==05){
		$bulannya='Mei';
	}elseif($bulan==06){
		$bulannya='Juni';
	}elseif($bulan==07){
		$bulannya='Juli';
	}elseif($bulan==8){
		$bulannya='Agustus';
	}elseif($bulan==9){
		$bulannya='September';
	}elseif($bulan==10){
		$bulannya='Oktober';
	}elseif($bulan==11){
		$bulannya='November';
	}else{
		$bulannya='Desember';
	}

?>
<h2> Catatan Kinerja Pegawai (<?=$bulannya;?> <?=$tahun;?>)</h2>

<table>
<tr>
	<td width="80px">Nama</td>
	<td>:</td>
	<td><?=$pengguna->nama_user;?></td>
</tr>
<tr>
	<td>NIP</td>
	<td>:</td>
	<td><?=$pengguna->username;?></td>
</tr>
<tr>
	<td>Jabatan</td>
	<td>:</td>
	<td><?=$pengguna->jabatan_user;?></td>
</tr>
</table><br>
		<table  cellspacing="0" cellpadding="2" width="100%" border="1">
					<thead style="background-color: grey;">
						<tr >
							<th width="15px"><div class="text-center">No</div></th>
							<th width="28px"><div class="text-center">Tanggal</div></th>
                            <th width="200px"><div class="text-center">Uraian Kegiatan</div></th>
							<th width="15px"><div class="text-center">No SK</div></th>
                            <th width="200px"><div class="text-center">Indikator Kinerja</div></th>
                            <th width="30px"><div class="text-center">Volumne</div></th>
							<th width="50px"><div class="text-center">Satuan</div></th>
						</tr>
					</thead>
					<tbody>
					 <?php
							$no=1;
							foreach($data_laporan as $row){
						?>		
						<tr>
							<td><center><?=$no++;?></center></td>
							<td><center><?=$row['tanggal_kin'];?></center></td>
							<td><?=$row['uraian_kin'];?></td>
							<td><center><?=$row['kode_sknya'];?></center></td>
							<td><?=$row['no_ik'];?> - <?=$row['nama_ik'];?> </td>
							<td><center><?=$row['target_ik'];?></center></td>
							<td><center><?=$row['satuan_ik'];?></center></td>
						</tr>	
						<?php
							}
					?>
					
					</tbody>
				</table>