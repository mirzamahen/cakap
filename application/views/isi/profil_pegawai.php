<link href="<?php echo base_url('assets/datatables/css/dataTables.bootstrap.css')?>" rel="stylesheet">

<div id="page-content">
	<div class="panel">
		<div class="panel-heading">
			<h3 class="panel-title"><?=$judul;?></h3>
		</div>
	<div class="panel-body">
		<div class="row">
		  <div class="col-md-2">
		  <img src="<?=base_url();?>assets/img/pegawai.png" alt="..." class="img-thumbnail">
		  <a href="<?=base_url();?>bagian/profil_update" type="button" class="btn btn-info btn-lg btn-block">Update Profil</a>
		  </div>
		  <div class="col-md-10">
		  <table>
			<tr>
				<td width="120px"><strong>NIP Pegawai</strong></td>
				<td width="10px">:</td>
				<td><?=$pegawai->username;?></td>
			</tr>
			<tr>
				<td><strong>Nama Pegawai</strong></td>
				<td>:</td>
				<td><?=$pegawai->nama_user;?></td>
			</tr>
			<tr>
				<td valign="top"><strong>Jabatan</strong></td>
				<td valign="top">:</td>
				<td><?=$pegawai->jabatan_user;?></td>
			</tr>
			<tr>
				<td><strong>Unit Kerja</strong></td>
				<td>:</td>
				<td><?=$pegawai->nama_unit_kerja;?></td>
			</tr>
			<tr>
				<td valign="top"><strong>Profil Unit Kerja</strong></td>
				<td valign="top">:</td>
				<td><?=$pegawai->profil_unit;?></td>
			</tr>
		  </table>
		  </div>
		</div>
		
	
	</div>
</div>
<script src="<?php echo base_url('assets/jquery/jquery-2.1.4.min.js')?>"></script>
<script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js')?>"></script>


