<?php
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

<div id="print-area-3" class="print-area">

<!--<h2> Catatan Kinerja Pegawai</h2>-->
<tr>
        <td width="25%"><img src="<?=base_url();?>assets/img/kemenag_logo.png" width="40" height="35" /></td>
        <td vertical-align="center"><font size="5"> &nbsp;&nbsp;&nbsp;Laporan Kinerja Bulanan (LKB) Pegawai <?=$bulannya;?> <?=$tahun;?></font></td>
      </tr>

<hr/>

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
<tr>
	<td>Unit Kerja</td>
	<td>:</td>
	<td><?=$pengguna->nama_unit_kerja;?></td>
</tr>


<!--<tr>
	<td>Bulan</td>
	<td>:</td>
	<td><?=$bulannya;?> <?=$tahun;?></td>
</tr>-->
</table><br>
		<table  cellspacing="0" cellpadding="2" width="100%" border="1">
					<thead style="background-color: Gainsboro;">
						<tr >
							<th width="15px"><div class="text-center">No</div></th>
							<th width="28px"><div class="text-center">Tanggal</div></th>
							<th width="28px"><div class="text-center">Status</div></th>
							<!--<th width="15px"><div class="text-center">SK</div></th>-->
							<th width="200px"><div class="text-center">Sasaran Kegiatan -<br/></b> Indikator Kinerja</div></th>
							<th width="30px"><div class="text-center">Volume</div></th>
							<th width="50px"><div class="text-center">Satuan</div></th>
                            <th width="200px"><div class="text-center">Uraian Kegiatan</div></th>
                            
						</tr>
					</thead>
					<tbody>
					 <?php
							$no=1;
							foreach($data_laporan as $row){
						?>		
						<tr>
							<td><center><?=$no++;?></center></td>
							<td><center><?=date('d-m-Y',strtotime($row['tanggal_kin']));?></center></td>
							<td><center><?=$row['hadir_kin'];?></center></td>
							<!--<td><center><?=$row['kode_sknya'];?></center></td>-->
							<td><?=$row['no_ik'];?> - <?=$row['nama_ik'];?> </td>
							<td><center><?=$row['target_ik'];?></center></td>
							<td><center><?=$row['satuan_ik'];?></center></td>
							<td><?=$row['uraian_kin'];?></td>
						</tr>	
						<?php
							}
					?>
					
					</tbody>
				<table>
				    <br/>
				    <tr>
				        
				        <td>Atasan Langsung<br/>
				    <br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;^
				    <br/>
				    <br/></td>
				        <td width="30%"></td>
				        <td>Pegawai yang bersangkutan<br/>
				    <br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;#
				    <br/>
				    <br/></td> 
				    </tr>
				    
				    <tr>
				        
				        <td><?=$pengguna->pimp_unit;?></br><?=$pengguna->nip_pimp_unit;?></td> 
				        <td width="30%"></td>
				        <td><?=$pengguna->nama_user;?><br/><?=$pengguna->username;?></td> 
				    </tr>
				</table>
				</table>


</div>
<br><br>
<div style="text-align:right;"><a type="button" class="no-print form-control btn btn-dark" href="javascript:printDiv('print-area-3');"><div class="glyphicon glyphicon-print"></div> Cetak Laporan Kinerja Bulanan (LKB)</a></div>

<textarea id="printing-css" style="display:none;">.no-print{display:none}</textarea>
<iframe id="printing-frame" name="print_frame" src="about:blank" style="display:none;"></iframe>
<script type="text/javascript">
function printDiv(elementId) {
    var a = document.getElementById('printing-css').value;
    var b = document.getElementById(elementId).innerHTML;
    window.frames["print_frame"].document.title = document.title;
    window.frames["print_frame"].document.body.innerHTML = '<style>' + a + '</style>' + b;
    window.frames["print_frame"].window.focus();
    window.frames["print_frame"].window.print();
}
</script>