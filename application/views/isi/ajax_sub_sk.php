<option value="0">--Pilih Sasaran Kinerja (SK)--</option>
<?php foreach ($sub_kompetensi as $rows){
	?>
	<option value="<?=$rows['kode_sk'];?>"><?=$rows['nama_sk'];?></option>
<?php	
	}
?>