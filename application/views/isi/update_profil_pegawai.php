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
		  
		  </div>
		  <div class="col-md-10">
		  <form id="form" action="#">
			  <div class="form-group">
				<label for="exampleInputEmail1">NIP</label>
				<input type="text"  value="<?=$pegawai->kode_user;?>" name="kode_user" hidden>
				<input type="text" class="form-control" value="<?=$pegawai->username;?>" name="username" readonly>                  
				<span class="help-block"></span>
			  </div>
			  <div class="form-group">
				<label for="exampleInputEmail1">Nama Pegawai</label>
				<input type="text" class="form-control" value="<?=$pegawai->nama_user;?>" name="nama_user">
				<span class="help-block"></span>
			  </div>
			  <div class="form-group">
				<label for="exampleInputEmail1">Jabatan</label>
				<input type="text" class="form-control" value="<?=$pegawai->jabatan_user;?>" name="jabatan_user">
				<span class="help-block"></span>
			  </div>
			  <div class="form-group">
				<label for="exampleInputEmail1">Unit Kerja</label>
				<select class="form-control" name="id_unit_kerjanya">
					<option value="<?=$pegawai->id_unit_kerjanya;?>"><?=$pegawai->kode_unit;?> - <?=$pegawai->nama_unit_kerja;?></option>
					<?php foreach($unit_kerja as $row){
					?>
					<option value="<?=$row->id_unit;?>"><?=$row->kode_unit;?> - <?=$row->nama_unit_kerja;?></option>
					<?php
					}
					?>
				  
				</select>
				<span class="help-block"></span>
			  </div>
			</form>
			<button type="button" class="btn btn-success" id="btnSave" onclick="save()">UPDATE</button>
			<a href="<?=base_url();?>bagian" type="button" class="btn btn-danger">BATAL</a>
		  </div>
		</div>
		
	
	</div>
</div>
<script src="<?php echo base_url('assets/jquery/jquery-2.1.4.min.js')?>"></script>
<script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js')?>"></script>

<script type="text/javascript">
$(document).ready(function() {

    $("input").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });

    $("select").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });

});

function save()
{
    $('#btnSave').text('saving...'); 
    $('#btnSave').attr('disabled',true); 
 
    $.ajax({
        url : "<?php echo site_url('bagian/update_simpan_profil')?>",
        type: "POST",
        data: $('#form').serialize(),
        dataType: "JSON",
        success: function(data)
        {

            if(data.status) 
            {
                Swal.fire(
				  'Berhasil',
				  'Data terlah berhasil di update!',
				  'success'
				)
			
            }
            else
            {
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); 
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]);
                }
            }
            $('#btnSave').text('UPDATE BERHASIL');
            $('#btnSave').attr('disabled',false);
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('data error, penyimpanan gagal');
            $('#btnSave').text('UPDATE GAGAL');
            $('#btnSave').attr('disabled',false);
        }
    });
}




</script>


