<div id="page-content">
	<div class="panel">
		<div class="panel-heading">
			<h3 class="panel-title"><?=$judul;?></h3>
		</div>
	<div class="panel-body">
	<p align="right"><button class="btn btn-dark" onclick="ajukan()"><i class="glyphicon glyphicon-plus"></i> &nbsp; Input Pekerjaan  </button>
	<button class="btn btn-light" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i><i>&nbsp;&nbsp;refresh</i></button></p>
		<table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th width="15px">No</th>
							<th width="100px">Tanggal</th>
							<th width="60px">Status</th>
							<th width="40px">SK</th>
							<th>Indikator Kinerja</th>
							<th>Uraian Pekerjaan</th>
							<th style="width:140px;"><div class="text-center">Tindakan</div></th>
						</tr>
					</thead>
					<tbody>
					</tbody>
		</table>
							
                                
	</div>
	</div>
</div>
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title"><?=$judul;?></h3><div>
                </div>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    
                    
                    <div class="form-group">
                            <label class="control-label col-md-4">Tanggal</label>
                            <div class="col-md-4">
                                <input name="tanggal_kin" class="form-control" type="date">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-4">Sasaran Kegiatan (SK)</label>
                            <div class="col-md-8">
								<select class="form-control" name="kode_sk" id="kode_sk">
									<option value="">Pilih Sasaran Kegiatan</option>
								<?php
									foreach($sksya as $row){
									?>
										<option value="<?=$row->kode_sk;?>"><?=$row->no_sk;?> - <?=$row->nama_sk;?></option>
								<?php
								}
								?>
								</select>
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-4">Indikator Kinerja (IK-SK)</label>
                            <div class="col-md-8">
								<select class="form-control" id="kode_ik" name="kode_ik" >
									<option value="">--Pilih Indikator--</option>
								</select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-4">Uraian Pekerjaan</label>
                            <div class="col-md-8">
                                <textarea name="uraian_kin" rows="4" class="form-control"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-4">Status Kehadiran</label>
                            <div class="col-md-8">
                                <select class="form-control" id="hadir_kin" name="hadir_kin" >
									<option value="">--Pilih Status Kehadiran--</option>
									<option value="Di Kantor">Hadir di Kantor</option>
									<option value="Dinas Luar">Dinas Luar</option>
									<option value="Cuti Tahunanr">Cuti Tahunan</option>
									<option value="Cuti Alasan Penting">Cuti Alasan Penting</option>
									<option value="Cuti Sakit">Cuti Sakit</option>
									<option value="Cuti Bersalin">Cuti Bersalin</option>
									<option value="Cuti Besar">Cuti Besar</option>
									<option value="Cuti Alasan Penting">Cuti Alasan Penting</option>
									<option value="Cuti Bersama">Cuti Bersama</option>
									<option value="Tugas Belajar">Tugas Belajar</option>
								</select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="save()" class="btn btn-primary">Kirim</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modal_form_update" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title"><?=$judul;?></h3><div>
                </div>
            </div>
            <div class="modal-body form">
                <form action="#" id="form2" class="form-horizontal">
                    <input type="hidden" value="" name="kode_kin"/>
                    
                    <div class="form-group">
                            <label class="control-label col-md-4">Tanggal</label>
                            <div class="col-md-4">
                                <input name="tanggal_kin" class="form-control" type="date">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-4">Sasaran Kegiatan (SK)</label>
                            <div class="col-md-8">
								<select class="form-control" name="kode_sk2" id="kode_sk2">
									<option value="">Pilih Sasaran Kegiatan</option>
								<?php
									foreach($sksya as $row){
									?>
										<option value="<?=$row->kode_sk;?>"><?=$row->no_sk;?> - <?=$row->nama_sk;?></option>
								<?php
								}
								?>
								</select>
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-4">Indikator Kinerja (IK-SK)</label>
                            <div class="col-md-8">
								<select class="form-control" id="kode_ik2" name="kode_ik2" >
									<option value="">--Pilih Indikator--</option>
								</select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-4">Uraian Pekerjaan</label>
                            <div class="col-md-8">
                                <textarea name="uraian_kin" rows="4" class="form-control"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-4">Status Kehadiran</label>
                            <div class="col-md-8">
                                <select class="form-control" id="hadir_kin" name="hadir_kin" >
									<option value="">--Pilih Status Kehadiran--</option>
									<option value="Di Kantor">Hadir di Kantor</option>
									<option value="Dinas Luar">Dinas Luar</option>
									<option value="Cuti Tahunanr">Cuti Tahunan</option>
									<option value="Cuti Alasan Penting">Cuti Alasan Penting</option>
									<option value="Cuti Sakit">Cuti Sakit</option>
									<option value="Cuti Bersalin">Cuti Bersalin</option>
									<option value="Cuti Besar">Cuti Besar</option>
									<option value="Cuti Alasan Penting">Cuti Alasan Penting</option>
									<option value="Cuti Bersama">Cuti Bersama</option>
									<option value="Tugas Belajar">Tugas Belajar</option>
								</select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="update()" class="btn btn-primary">Kirim</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url('assets/jquery/jquery-2.1.4.min.js')?>"></script>

<script type="text/javascript">
var save_method; 
var table;

$(document).ready(function() {

    table = $('#table').DataTable({ 

        "processing": true, 
        "serverSide": true, 
        "order": [],

        "ajax": {
            "url": "<?php echo site_url('bagian/ajax_list')?>",
            "type": "POST"
        },

        "columnDefs": [
        { 
            "targets": [ -1 ],
            "orderable": false, 
        },
        ],

    });
    $("input").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });
    $("textarea").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });
    $("select").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });

});



function reload_table()
{
    table.ajax.reload(null,false);
}


function ajukan()
{
    save_method = 'add';
    $('#form')[0].reset();
    $('.form-group').removeClass('has-error');
    $('.help-block').empty();
    $('#modal_form').modal('show');
    $('.modal-title').text('Input Pekerjaan');
}


$("#kode_sk").change(function(){
	var kode_sk = $("#kode_sk").val();
	$.ajax({
		type: "POST",
		url : "<?php echo base_url('bagian/ajaxindikator');?>",
		data: "kode_sk="+kode_sk,
		cache:false,
		success: function(data){
			$('#kode_ik').html(data);
		}
	});
});

$("#kode_sk2").change(function(){
	var kode_sk2 = $("#kode_sk2").val();
	$.ajax({
		type: "POST",
		url : "<?php echo base_url('bagian/ajaxindikator');?>",
		data: "kode_sk="+kode_sk2,
		cache:false,
		success: function(data){
			$('#kode_ik2').html(data);
		}
	});
});		


function save()
{
    $('#btnSave').text('saving...'); 
    $('#btnSave').attr('disabled',true); 


    $.ajax({
        url : "<?php echo site_url('bagian/ajax_add')?>",
        type: "POST",
        data: $('#form').serialize(),
        dataType: "JSON",
        success: function(data)
        {

            if(data.status) 
            {
                $('#modal_form').modal('hide');
                reload_table();
            }
            else
            {
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); 
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]);
                }
            }
            $('#btnSave').text('save');
            $('#btnSave').attr('disabled',false);


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('data error, penyimpanan gagal');
            $('#btnSave').text('save');
            $('#btnSave').attr('disabled',false);

        }
    });
}



function edit(kode_kin)
{
    $('#form2')[0].reset();
    $('.form-group').removeClass('has-error');
    $('.help-block').empty();

    $.ajax({
        url : "<?php echo site_url('bagian/ajax_edit/')?>/" + kode_kin,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="kode_kin"]').val(data.kode_kin);
            $('[name="tanggal_kin"]').val(data.tanggal_kin);
			$('[name="uraian_kin"]').val(data.uraian_kin);
            $('#modal_form_update').modal('show'); 
            $('.modal-title').text('Edit Kinerja'); 

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

function update()
{
    $('#btnSave').text('saving...'); 
    $('#btnSave').attr('disabled',true); 


    $.ajax({
        url : "<?php echo site_url('bagian/update')?>",
        type: "POST",
        data: $('#form2').serialize(),
        dataType: "JSON",
        success: function(data)
        {

            if(data.status) 
            {
                $('#modal_form_update').modal('hide');
                reload_table();
            }
            else
            {
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); 
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]);
                }
            }
            $('#btnSave').text('save');
            $('#btnSave').attr('disabled',false);


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('data error, penyimpanan gagal');
            $('#btnSave').text('save');
            $('#btnSave').attr('disabled',false);

        }
    });
}


function hapus(kode_kin)
{
        $.ajax({
            url :"<?php echo base_url('bagian/hapus/')?>/"+kode_kin,
            type: "POST",
            dataType: "JSON",
            success: function()
            {
                reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                reload_table();
            }
        });

}

</script>


