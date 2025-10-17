<link href="<?php echo base_url('assets/datatables/css/dataTables.bootstrap.css')?>" rel="stylesheet">

<div id="page-content">
	<div class="panel">
		<div class="panel-heading">
			<h3 class="panel-title"><?=$judul;?></h3>
		</div>
	<div class="panel-body">
	<button class="btn btn-success" onclick="tambah_sk()"><i class="glyphicon glyphicon-plus"></i> Tambah SK</button>
	<button class="btn btn-success" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Refresh</button>
	<br><br>
		<table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th width="20px">No</th>
							<th width="30px">No SK</th>
							<th width>Nama Sasaran Kegiatan</th>
							<th width="50px">Status</th>
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
        "order": [],

        "ajax": {
            "url": "<?php echo site_url('adminSk/ajax_list')?>",
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
        url = "<?php echo site_url('adminSk/ajax_add')?>";
    } else {
        url = "<?php echo site_url('adminSk/ajax_update')?>";
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




function edit_person(kode_sk)
{
    save_method = 'update';
    $('#form')[0].reset();
    $('.form-group').removeClass('has-error');
    $('.help-block').empty();

 
    $.ajax({
        url : "<?php echo site_url('adminSk/ajax_edit/')?>/" + kode_sk,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

            $('[name="kode_sk"]').val(data.kode_sk);
            $('[name="no_sk"]').val(data.no_sk);
            $('[name="nama_sk"]').val(data.nama_sk);
			$('[name="status_sk"]').val(data.status_sk);
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
            url : "<?php echo site_url('adminSK/ajax_delete')?>/" + kode_ik,
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
                    <input type="hidden" value="" name="kode_sk"/> 
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">No SK</label>
                            <div class="col-md-9">
                                <input name="no_sk" placeholder="No Sk" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
						<div class="form-group">
                            <label class="control-label col-md-3">Nama SK</label>
                            <div class="col-md-9">
                                <input name="nama_sk" placeholder="Masukkan Nama" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
						
						<div class="form-group">
                            <label class="control-label col-md-3">Status</label>
                            <div class="col-md-9">
                                <select name="status_sk" class="form-control">
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