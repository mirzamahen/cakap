<link href="<?php echo base_url('assets/datatables/css/dataTables.bootstrap.css')?>" rel="stylesheet">

<div id="page-content">
	<div class="panel">
		<div class="panel-heading">
			<h3 class="panel-title"><?=$judul;?></h3>
		</div>
	<div class="panel-body">
	<form action="#" id="surat_masuk" class="form-horizontal">
								<input type="hidden" value="<?=$surat['id_surat'];?>" name="id_surat"/> 
								<div class="form-body">
								    
								    <div class="form-group">
										<label class="control-label col-md-3">Unggah Kembali Dasar File Pengajuan</label>
										<div class="col-md-8">Surat/Nota Dinas/Undangan <br/><font color="orange"><i>Pastikan berhasil (ada file <b>********.pdf</b> di bawah tombol)</i></font> <br/><br/>
											<input name="userfile" type="file">
											<small> <font color="orange">[File yang dilamprikan hanya dalam bentuk PDF]</font></small><br> 
											<div id="tampil_gambar_update"></div>
										</div>
									</div>
								    <br/>
								    
								    
									<div class="form-group">
										<label class="control-label col-md-3">Nomor Surat/Nota Dinas/Undangan</label>
										<div class="col-md-8">
											<input name="nomor_surat" class="form-control" type="text" value="<?=$surat['nomor_surat'];?>">
											<span class="help-block"></span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-3">Tanggal Surat</label>
										<div class="col-md-8">
											<input name="tgl_surat_udangan" class="form-control" type="date" value="<?=$surat['tgl_surat_udangan'];?>">
											<span class="help-block"></span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-3">Perihal</label>
										<div class="col-md-8">
											<input name="file_surat" type="text" value="<?=$surat['file_surat'];?>" hidden>
											<input name="perihal_surat"  class="form-control" type="text" value="<?=$surat['perihal_surat'];?>">
											<span class="help-block"></span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-3">Instansi/Bidang Penyelenggara</label>
										<div class="col-md-8">
											<input name="penyelenggara" class="form-control" type="text" value="<?=$surat['penyelenggara'];?>">
											<span class="help-block"></span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-3">Nama Kegiatan</label>
										<div class="col-md-8">
											<input name="nama_kegiatan" class="form-control" type="text" value="<?=$surat['nama_kegiatan'];?>">
											<span class="help-block"></span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-3">Tanggal Pelaksanaan</label>
										<div class="col-md-3">
											<input name="mulai_tanggal" class="form-control" type="date" value="<?=$surat['mulai_tanggal'];?>">
											<span class="help-block"></span>
										</div>
										 <div class="col-md-3">
											<input name="akhir_tanggal" class="form-control" type="date" value="<?=$surat['akhir_tanggal'];?>">
											<span class="help-block"></span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-3">Tempat Kegiatan</label>
										<div class="col-md-8">
											<textarea name="tempat_kegiatan" rows="4" class="form-control"><?=$surat['tempat_kegiatan'];?></textarea>
											<span class="help-block"></span>
										</div>
									</div>
									
									
									<div class="form-group">
										<label class="control-label col-md-3">Ketugasan</label>
										<div class="col-md-8">
											<select name="ketugasan" class="form-control">
												<option value="<?=$surat['ketugasan'];?>"><?=$surat['ketugasan'];?></option>
												<option value="Peserta">Peserta</option>
												<option value="Panitia">Panitia</option>
												<option value="Narasumber">Narasumber</option>
												<option value="Moderator">Moderator</option>
												<option value="Pendamping">Pendamping</option>
												<option value="Petugas">Petugas</option>
												<option value="Mentor">Mentor</option>
												<option value="Penguji">Penguji</option>
												<option value="Rohaniwan">Rohaniwan</option>
											</select>
											<span class="help-block"></span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-3">Keterangan Presensi</label>
										<div class="col-md-8">
											<div class="radio col-md-3">
											
											<input type="radio" name="presensi" value="Presensi" <?php
												if($surat['presensi']=='Presensi'){
													echo 'checked';
												}
											?>>
											Presensi
										</div>
										
											<div class="radio col-md-3">
											<input type="radio" name="presensi" value="Tidak Presensi" <?php
												if($surat['presensi']=='Tidak Presensi'){
													echo 'checked';
												}
											?>>
											Tidak Presensi
										</div>
											<span class="help-block"></span>
										</div>
									</div>
									
									
									<div class="form-group">
										<label class="control-label col-md-3"></label>
										<div class="col-md-8"><br>
											<a href="javascript:void(0)" onclick="tambah_anggota()"><font color="green"><i class="glyphicon glyphicon-user"></i> [ + TAMBAH PERSONIL ]</font></a>
											<div id="personel"></div>
										</div>
									</div>
									
									
									
									
									
									<div class="col-md-2"></div>
									<div class="col-md-8"><br><br><center><button type="button" onclick="update_surat_masuk()" class="btn btn-primary btn-lg btn-block">UPDATE SURAT</button></center><br><br>
									</div>
									<div class="col-md-2"></div>

								</div>
							</form>                     
	</div>
	</div>
</div>
<script src="<?php echo base_url('assets/jquery/jquery-2.1.4.min.js')?>"></script>
<script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js')?>"></script>

<script type="text/javascript">
var save_method; 
var table;
$(document).ready(function() {
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
	
	reload_personel();
	tampil_gambar();

});

function update_surat_masuk()
{
    $('#btnSave').text('saving...'); 
    $('#btnSave').attr('disabled',true); 


    $.ajax({
        url : "<?php echo site_url('bagian/update_surat')?>",
        type: "POST",
        data: $('#surat_masuk').serialize(),
        dataType: "JSON",
        success: function(data)
        {

            if(data.status) 
            {
               alert('Berhasil, Data berhasil diperbarui');
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

function tambah_anggota()
{
    $('#form2')[0].reset();
    $('.form-group').removeClass('has-error');
    $('.help-block').empty();
    $('#modal_form_anggota').modal('show');
    $('.modal-title').text('Tambah Anggota');
}

function simpanAnggota()
{
    $('#btnSave').text('saving...'); 
    $('#btnSave').attr('disabled',true); 


    $.ajax({
        url : "<?php echo site_url('bagian/simpan_anggota_permanen')?>",
        type: "POST",
        data: $('#form2').serialize(),
        dataType: "JSON",
        success: function(data)
        {

            if(data.status) 
            {
                $('#modal_form_anggota').modal('hide');
                reload_personel();
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

function reload_personel()
{
	$.ajax({
		url: '<?=base_url("bagian/tampil_anggota_permanen/$id_suratnya");?>',
		async: false,
		type: 'POST',
		success: function(data) {
		$('#personel').html(data);
		}
	})
}


function hapus_personil(id_anggota_permanen)
{
    if(confirm('Yakin menghapus data?'))
    {

        $.ajax({
            url : "<?php echo site_url('bagian/hapus_personilnya_permanen')?>/" + id_anggota_permanen,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
             
                reload_personel();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Hapus data gagal');
            }
        });

    }
	
}

function tampil_gambar()
{
	 $('#tampil_gambar_update').load('<?php echo base_url("bagian/tampilkan_gambar_update/$id_suratnya")?>');
}

function hapus_gambar(nama_gambar)
{
        $.ajax({
            url :"<?php echo base_url('bagian/hapus_gambar_sementara/')?>/"+nama_gambar,
            type: "POST",
            dataType: "JSON",
            success: function()
            {
               tampil_gambar();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
               tampil_gambar();
            }
        });

}

$(function() {
	$('#surat_masuk').change(function(e) {
		var data = new FormData($('#surat_masuk')[0]);
		$.ajax({
			type	:'POST',
			url 	:'<?php echo site_url('bagian/simpanUpdateLampiran')?>', 
			data	:data,
            mimeType: "multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,
			beforeSend : function()
			   {
				//$('#loader-icon').show();
			   },
               success:function(data)
              {
				
				//  $('#loader-icon').hide();
				// alert('Lampiran Telah berhasil di sisipkan');
				 tampil_gambar();
				  
				},
			 error: function (jqXHR, textStatus, errorThrown)
				{
					alert('Upload gagal, file tidak sesuai/ukuran terlalu besar!');
				}
		});
		return false;
	});
});
</script>

<div class="modal fade" id="modal_form_anggota" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title"><?=$judul;?></h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form2" class="form-horizontal">
                    <input type="hidden" value="<?=$id_suratnya;?>" name="kode_surat_nya"/> 
                    <div class="form-body">
						<div class="form-group">
                            <label class="control-label col-md-3">Personil</label>
                            <div class="col-md-8">
                                <select name="kode_pegawai" class="selectpicker form-control" data-live-search="true">
                                    <option value="">--Pilih Personil--</option>
                                    <?php
										foreach($datapersonil as $rowss){
									?>
									<option value="<?=$rowss['kode_pegawai'];?>"><?=$rowss['nama_pegawai'];?></option>
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
                <button type="button" id="btnSave" onclick="simpanAnggota()" class="btn btn-primary">Tambahkan</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>