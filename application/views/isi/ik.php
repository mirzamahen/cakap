<link href="<?php echo base_url('assets/datatables/css/dataTables.bootstrap.css')?>" rel="stylesheet">

<div id="page-content">
	<div class="panel">
		<div class="panel-heading">
			<h3 class="panel-title"><?=$judul;?></h3>
		</div>
	<div class="panel-body">
	<button class="btn btn-success" onclick="tambah_ik()"><i class="glyphicon glyphicon-plus"></i> Tambah Indikator Kinerja</button>
	<button class="btn btn-success" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Refresh</button>
	<br><br>
		<table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th width="15px"><div class="text-center">No</div></th>
							<th width="50px"><div class="text-center">No SK</div></th>
                            <th width="60px"><div class="text-center">No IK-SK</div></th>
							<th width>Nama Indikator Kinerja</th>
                            <th width="30px"><div class="text-center">Target</div></th>
                            <th width="30px"><div class="text-center">Satuan</div></th>
							<th width="50px"><div class="text-center">Status</div></th>
							<th style="width:75px;"><div class="text-center">Tindakan</div></th>
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
		"ordering": false,
        "order": [],

        "ajax": {
            "url": "<?php echo site_url('adminIk/ajax_list')?>",
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


function tambah_ik()
{
    save_method = 'add';
    $('#form')[0].reset();
    $('.form-group').removeClass('has-error');
    $('.help-block').empty();
    $('#modal_form').modal('show');
    $('.modal-title').text('Tambah Indikator Kinerja');
}



function save()
{
    $('#btnSave').text('saving...'); 
    $('#btnSave').attr('disabled',true); 
    var url;

   if(save_method == 'add') {
        url = "<?php echo site_url('adminIk/ajax_add')?>";
    } else {
        url = "<?php echo site_url('adminIk/ajax_update')?>";
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

function edit_person(kode_ik)
{
    save_method = 'update';
    $('#form')[0].reset();
    $('.form-group').removeClass('has-error');
    $('.help-block').empty();

 
    $.ajax({
        url : "<?php echo site_url('adminIk/ajax_edit/')?>/" + kode_ik,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

            $('[name="kode_ik"]').val(data.kode_ik);
            $('[name="no_ik"]').val(data.no_ik);
            $('[name="nama_ik"]').val(data.nama_ik);
            $('[name="target_ik"]').val(data.target_ik);
            $('[name="satuan_ik"]').val(data.satuan_ik);
            $('[name="kode_sknya"]').val(data.kode_sknya);
			$('[name="status_ik"]').val(data.status_ik);
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
            url : "<?php echo site_url('adminiK/ajax_delete')?>/" + kode_ik,
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
                    <input type="hidden" value="" name="kode_ik"/> 
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">No SK</label>
                            <div class="col-md-9">
                                <select name="kode_sknya" class="form-control">
									<option value="">Pilih Sasaran Kegiatan</option>
								<?php
									foreach ($sknya as $row){
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
                            <label class="control-label col-md-3">Nomor IK</label>
                            <div class="col-md-9">
							<input name="no_ik" placeholder="Nomor Sasaran Kegiatan" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>

						<div class="form-group">
                            <label class="control-label col-md-3">Nama IK</label>
                            <div class="col-md-9">
                                <input name="nama_ik" placeholder="Masukkan Nomor IK" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Target IK</label>
                            <div class="col-md-9">
                                <input name="target_ik" placeholder="Target Nama" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Satuan IK</label>
                            <div class="col-md-9">
                                <input name="satuan_ik" placeholder="Masukkan Satuan" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
						
						<div class="form-group">
                            <label class="control-label col-md-3">Status</label>
                            <div class="col-md-9">
                                <select name="status_ik" class="form-control">
                                    <option value="">-Pilih Status-</option>
                                    <option value="Aktif">Aktif</option>
                                    <option value="Tidak Aktif">Tidak Aktif</option>
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