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
							<th width="20px">No</th>
							<th width="80px">NIP</th>
							<th width="80px">Nama Pegawai</th>
							<th width="60px">Pangkat/Golongan</th>
							<th >Jabatan</th>
							<th width="50px">Status</th>
							<th style="width:180px;"><div class="text-center">Tindakan</div></th>
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
            "url": "<?php echo site_url('dukKanwil/ajax_list')?>",
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
    var url;

   if(save_method == 'add') {
        url = "<?php echo site_url('dukKanwil/ajax_add')?>";
    } else {
        url = "<?php echo site_url('dukKanwil/ajax_update')?>";
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




function edit_person(kode_pegawai)
{
    save_method = 'update';
    $('#form')[0].reset();
    $('.form-group').removeClass('has-error');
    $('.help-block').empty();

 
    $.ajax({
        url : "<?php echo site_url('dukKanwil/ajax_edit/')?>/" + kode_pegawai,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

            $('[name="kode_pegawai"]').val(data.kode_pegawai);
            $('[name="nip_pegawai"]').val(data.nip_pegawai);
            $('[name="nama_pegawai"]').val(data.nama_pegawai);
			$('[name="gol_pegawai"]').val(data.gol_pegawai);
			$('[name="jabatan"]').val(data.jabatan);
			$('[name="jabatan_pegawai"]').val(data.jabatan_pegawai);
			$('[name="status_pegawai"]').val(data.status_pegawai);
            $('#modal_form').modal('show'); 
            $('.modal-title').text('Edit Pegawai'); 

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}



function hapus(kode_pegawai)
{
    if(confirm('Yakin menghapus data?'))
    {

        $.ajax({
            url : "<?php echo site_url('dukKanwil/ajax_delete')?>/" + kode_pegawai,
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
                    <input type="hidden" value="" name="kode_pegawai"/> 
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">NIP</label>
                            <div class="col-md-9">
                                <input name="nip_pegawai" placeholder="NIP Pegawai" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
						<div class="form-group">
                            <label class="control-label col-md-3">Nama</label>
                            <div class="col-md-9">
                                <input name="nama_pegawai" placeholder="Masukkan Nama" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
						<div class="form-group">
                            <label class="control-label col-md-3">Golongan</label>
                            <div class="col-md-9">
                                
                                <select name="gol_pegawai" placeholder="Golongan Pegawai" class="form-control">
                                    <option value="-">-Pilih Golongan-</option>
                                    <option value="II/a">II/a</option>
									<option value="II/b">II/b</option>
									<option value="II/c">II/c</option>
									<option value="II/d">II/d</option>
									<option value="III/a">III/a</option>
									<option value="III/b">III/b</option>
									<option value="III/c">III/c</option>
									<option value="III/d">III/d</option>
									<option value="IV/a">IV/a</option>
									<option value="IV/b">IV/b</option>
									<option value="IV/c">IV/c</option>
									<option value="IV/d">IV/d</option>
									<option value="IV/e">IV/e</option>
                                </select>
                                
                               <!-- 
                                <input name="gol_pegawai" placeholder="Golongan Pegawai" class="form-control" type="text">
                                <span class="help-block"></span>-->
                            </div>
                        </div>
                        
                        
						<div class="form-group">
                            <label class="control-label col-md-3">Pangkat</label>
							<div class="col-md-9">
							    
							    <select name="jabatan" placeholder="Pangkat Pegawai" class="form-control">
                                    <option value="-">-Pilih Pangkat-</option>
                                    <option value="Pengatur Muda">II/a - Pengatur Muda</option>
									<option value="Pengatur Muda Tingkat I">II/b - Pengatur Muda Tingkat I</option>
									<option value="Pengatur">II/c - Pengatur</option>
									<option value="Pengatur Tingkat I">II/d - Pengatur Tingkat I</option>
									<option value="Penata Muda">III/a - Penata Muda</option>
									<option value="Penata Muda Tingkat I">III/b - Penata Muda Tingkat I</option>
									<option value="Penata">III/c - Penata</option>
									<option value="Penata Tingkat I">III/d - Penata Tingkat I</option>
									<option value="Pembina">IV/a - Pembina</option>
									<option value="Pembina Tingkat I">IV/b - Pembina Tingkat I</option>
									<option value="Pembina Utama Muda">IV/c -c Pembina Utama Muda</option>
									<option value="Pembina Utama Madya">IV/d - Pembina Utama Madya</option>
									<option value="Pembina Utama">IV/e - Pembina Utama</option>
                                </select>
							    
							    <!--<input name="jabatan" placeholder="Pangkat Pegawai" class="form-control" type="text">
                                <span class="help-block"></span>-->
                            </div>
                        </div>
						<div class="form-group">
                            <label class="control-label col-md-3">Jabatan</label>
                            <div class="col-md-9">
                                <input name="jabatan_pegawai" placeholder="Jabatan" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
						<div class="form-group">
                            <label class="control-label col-md-3">Status</label>
                            <div class="col-md-9">
                                <select name="status_pegawai" class="form-control">
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