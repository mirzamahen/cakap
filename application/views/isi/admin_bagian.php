<link href="<?php echo base_url('assets/datatables/css/dataTables.bootstrap.css')?>" rel="stylesheet">

<div id="page-content">
	<div class="panel">
		<div class="panel-heading">
			<h3 class="panel-title"><?=$judul;?></h3>
		</div>
	<div class="panel-body">
	<button class="btn btn-success" onclick="tambah_pegawai()"><i class="glyphicon glyphicon-plus"></i> Tambah Pegawai</button>
	<button class="btn btn-success" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Refresh</button>
	<br><br>
		<table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th width="15">No</th>
							<th width="15">Nama</th>
							<th width="250">Jabatan</th>
							<th width="200">Unit Kerja</th>
							<th width="40px">Level</th>
							<th width="15px">Status</th>
							<th style="width:120px;"><div class="text-center">Tindakan</div></th>
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
            "url": "<?php echo site_url('adminBagian/ajax_list')?>",
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


function tambah_pegawai()
{
    save_method = 'add';
    $('#form')[0].reset();
    $('.form-group').removeClass('has-error');
    $('.help-block').empty();
    $('#modal_form').modal('show');
    $('.modal-title').text('Tambah Pegawai');
}



function save()
{
    $('#btnSave').text('saving...'); 
    $('#btnSave').attr('disabled',true); 
//    var url;

 //  if(save_method == 'add') {
 //       url = "<?php echo site_url('adminBagian/ajax_add')?>";
 //   } else {
 //       url = "<?php echo site_url('adminBagian/ajax_update')?>";
//    }


    $.ajax({
        url : "<?php echo site_url('adminBagian/ajax_add')?>",
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


function gantipassword(kode_user)
{
   
    $('#form3')[0].reset();
    $('.form-group').removeClass('has-error');
    $('.help-block').empty();

 
    $.ajax({
        url : "<?php echo site_url('adminBagian/ajax_edit/')?>/" + kode_user,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

            $('[name="kode_user"]').val(data.kode_user);
			$('#modal_form_password').modal('show'); 
            $('.modal-title').text('Edit Password');
		

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

function edit_person(kode_user)
{
    save_method = 'update';
    $('#form2')[0].reset();
    $('.form-group').removeClass('has-error');
    $('.help-block').empty();

 
    $.ajax({
        url : "<?php echo site_url('adminBagian/ajax_edit/')?>/" + kode_user,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

            $('[name="kode_user"]').val(data.kode_user);
            $('[name="nama_user"]').val(data.nama_user);
            $('[name="username"]').val(data.username);
			$('[name="jabatan_user"]').val(data.jabatan_user);
			$('[name="id_unit_kerjanya"]').val(data.id_unit_kerjanya);
			$('[name="status_user"]').val(data.status_user);
            $('#modal_form_edit').modal('show'); 
            $('.modal-title').text('Edit Pegawai'); 

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
        url : "<?php echo site_url('adminBagian/ajax_update')?>",
        type: "POST",
        data: $('#form2').serialize(),
        dataType: "JSON",
        success: function(data)
        {

            if(data.status) 
            {
                $('#modal_form_edit').modal('hide');
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

function updatepassword()
{
    $('#btnSave').text('saving...'); 
    $('#btnSave').attr('disabled',true); 


    $.ajax({
        url : "<?php echo site_url('adminBagian/update_password')?>",
        type: "POST",
        data: $('#form3').serialize(),
        dataType: "JSON",
        success: function(data)
        {

            if(data.status) 
            {
                $('#modal_form_password').modal('hide');
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


function hapus(kode_user)
{
    if(confirm('Yakin menghapus data?'))
    {

        $.ajax({
            url : "<?php echo site_url('adminBagian/ajax_delete')?>/" + kode_user,
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
                    <input type="hidden" value="" name="kode_user"/> 
                    <div class="form-body">
                    <div class="form-group">
                            <label class="control-label col-md-3">NIP</label>
                            <div class="col-md-9">
                                <input name="username" placeholder="NIP" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">Nama</label>
                            <div class="col-md-9">
                                <input name="nama_user" placeholder="Nama" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>

						<div class="form-group">
                            <label class="control-label col-md-3">Jabatan</label>
                            <div class="col-md-9">
                                <input name="jabatan_user" placeholder="Jabatan" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
						
						<div class="form-group">
                            <label class="control-label col-md-3">Unit Kerja Pengampu</label>
                            <div class="col-md-9">
                               <select name="id_unit_kerjanya" class="form-control">
									<option value="">Pilih Unit Kerja</option>
								<?php
									foreach ($unit as $row){
								?>
										<option value="<?=$row->id_unit;?>"><?=$row->kode_unit;?> - <?=$row->nama_unit_kerja;?></option>
								<?php	
									}
								?>
								</select
                                <span class="help-block"></span>
                            </div>
                        </div>

						<div class="form-group">
                            <label class="control-label col-md-3">Password</label>
                            <div class="col-md-9">
                                <input name="password" placeholder="Password" class="form-control" type="password">
                                <span class="help-block"></span>
                            </div>
                        </div>

						<div class="form-group">
                            <label class="control-label col-md-3">Status</label>
                            <div class="col-md-9">
                                <select name="status_user" class="form-control">
                                    <option value="">--Pilih Status--</option>
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


<div class="modal fade" id="modal_form_edit" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title"><?=$judul;?></h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form2" class="form-horizontal">
                    <input type="hidden" value="" name="kode_user"/> 
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Nama</label>
                            <div class="col-md-9">
                                <input name="nama_user" placeholder="Nama" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">NIP</label>
                            <div class="col-md-9">
                                <input name="username" placeholder="Username" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>

						<div class="form-group">
                            <label class="control-label col-md-3">Jabatan</label>
                            <div class="col-md-9">
                                <input name="jabatan_user" placeholder="Jabatan" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
						
						<div class="form-group">
                            <label class="control-label col-md-3">Unit Kerja Pengampu</label>
                            <div class="col-md-9">
                               <select name="id_unit_kerjanya" class="form-control">
									<option value="">Pilih Unit Kerja</option>
								<?php
									foreach ($unit as $row){
								?>
										<option value="<?=$row->id_unit;?>"><?=$row->kode_unit;?> - <?=$row->nama_unit_kerja;?></option>
								<?php	
									}
								?>
								</select
                                <span class="help-block"></span>
                            </div>
                        </div>

						
						<div class="form-group">
                            <label class="control-label col-md-3">Status status</label>
                            <div class="col-md-9">
                                <select name="status_user" class="form-control">
                                    <option value="">--Pilih Status--</option>
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
                <button type="button" id="btnSave" onclick="update()" class="btn btn-primary">Update</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_form_password" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title"><?=$judul;?></h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form3" class="form-horizontal">
                    <input type="hidden" value="" name="kode_user"/> 
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Password Baru</label>
                            <div class="col-md-9">
                                <input name="password" placeholder="Masukkan Password Baru" class="form-control" type="password">
                                <span class="help-block"></span>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="updatepassword()" class="btn btn-primary">Update Password</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>
