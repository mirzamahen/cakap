<option value="0">--Pilih Indikator--</option>
<?php foreach ($indikator as $rows){
	?>
	<option value="<?=$rows['kode_ik'];?>"><?=$rows['no_ik'];?> - <?=$rows['nama_ik'];?></option>
<?php	
	}
?>