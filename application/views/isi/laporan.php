<link href="<?php echo base_url('assets/datatables/css/dataTables.bootstrap.css')?>" rel="stylesheet">

<div id="page-content">
	<div class="panel">
		<div class="panel-heading">
			<h3 class="panel-title"><?=$judul;?></h3>
		</div>
	<div class="panel-body">
		<form class="form-inline" action="laporan/bulanan" method="POST" target="_blank">
		  <div class="form-group">
			<label>Bulan</label>
			<select class="form-control" name="bulan" required>
				<option value="">Pilih Bulan</option>
				<?php
					$bulan=array(1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember');
					$no=1;
					for($i=1;$i<=12;$i++)
					{
						echo '<option value="'.$i.'">'.$bulan[$i].'</o tion>';
					}
				?>
			</select>
		  </div>
		  <div class="form-group">
			<label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tahun Pelaporan</label>
			<select class="form-control" name="tahun" required>
				<option value="">Pilih Tahun</option>
				<?php
					date_default_timezone_set('Asia/Jakarta');
					$tahun=date("Y");
					for($i=2017;$i<=$tahun;$i++)
					{
						echo '<option value="'.$i.'">'.$i.'</option>';
					}
				?>
			</select>
		  </div>
		  &nbsp;&nbsp;<button type="submit" class="btn btn-danger"><i class="glyphicon glyphicon-print"></i> Tampilkan</button>
		</form>
	
	</div>
	</div>
</div>
<script src="<?php echo base_url('assets/jquery/jquery-2.1.4.min.js')?>"></script>
<script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js')?>"></script>