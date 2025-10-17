<link href="<?php echo base_url('assets/datatables/css/dataTables.bootstrap.css')?>" rel="stylesheet">

<div id="page-content">
	<div class="panel">
		<div class="panel-heading">
			<h3 class="panel-title"><?=$judul;?></h3>
		</div>
	<div class="panel-body">
	<button class="btn btn-success" onclick="tambah_sk()"><i class="glyphicon glyphicon-plus"></i> Tambah SK/Unit</button>
	<button class="btn btn-success" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Refresh</button>
	<br><br>
		<table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th width="20px">No</th>
							<th width ="600px">Nama Sasaran Kegiatan</th>
							<th width>Unit Kerja</th>
							<th style="width:50px;"><div class="text-center">Tindakan</div></th>
						</tr>
					</thead>
					<tbody>
					</tbody>
					<tfoot>
					</tfoot>
				</table>
							
                                
	</div>
	</div>
</div>
<script src="<?php echo base_url('assets/jquery/jquery-2.1.4.min.js')?>"></script>
<script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js')?>"></script>

<script type="text/javascript">
var save_method; 
var table;

$(document).ready(function() {

    table = $('#table').DataTable({ 

        "processing": true, 
        "serverSide": true, 
        "order": [],

        "ajax": {
            "url": "<?php echo site_url('adminSk/ajax_sk_unit')?>",
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


function tambah_sk()
{
    save_method = 'add';
    $('#form')[0].reset();
    $('.form-group').removeClass('has-error');
    $('.help-block').empty();
    $('#modal_form').modal('show');
    $('.modal-title').text('Tambah SK');
}



function save()
{
    $('#btnSave').text('saving...'); 
    $('#btnSave').attr('disabled',true); 
    var url;

   if(save_method == 'add') {
        url = "<?php echo site_url('adminSk/ajax_add_sk_unit')?>";
    } else {
        url = "<?php echo site_url('adminSk/ajax_update_sk_unit')?>";
   }


    $.ajax({
        url : url,
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




function edit_person(id_sk_unit)
{
    save_method = 'update';
    $('#form')[0].reset();
    $('.form-group').removeClass('has-error');
    $('.help-block').empty();

 
    $.ajax({
        url : "<?php echo site_url('adminSk/ajax_edit_sk_unit/')?>/" + id_sk_unit,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

            $('[name="id_sk_unit"]').val(data.id_sk_unit);
            $('[name="id_sknya"]').val(data.id_sknya);
            $('[name="id_unitnya"]').val(data.id_unitnya);
            $('#modal_form').modal('show'); 
            $('.modal-title').text('Edit SK'); 

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}



function hapus(kode_ik)
{
    if(confirm('Yakin menghapus data?'))
    {

        $.ajax({
            url : "<?php echo site_url('adminSK/ajax_delete_sk_unit')?>/" + kode_ik,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                $('#modal_form').modal('hide');
                reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Hapus data gagal');
            }
        });

    }
}

</script>


<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title"><?=$judul;?></h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="id_sk_unit"/> 
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">No SK</label>
                            <div class="col-md-9">
                                <select name="id_sknya" class="form-control">
									<option value="">Pilih Sasaran Kegiatan</option>
								<?php
									foreach ($sk as $row){
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
                            <label class="control-label col-md-3">Unit Kerja Pengampu</label>
                            <div class="col-md-9">
                                <select name="id_unitnya" class="form-control">
									<option value="">Pilih Unit Kerja</option>
								<?php
									foreach ($unit as $row){
								?>
										<option value="<?=$row->id_unit;?>"><?=$row->kode_unit;?> - <?=$row->nama_unit_kerja;?></option>
								<?php	
									}
								?>
								</select>
                                <span class="help-block"></span>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Simpan</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>