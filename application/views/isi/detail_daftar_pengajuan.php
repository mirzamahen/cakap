<link href="<?php echo base_url('assets/datatables/css/dataTables.bootstrap.css')?>" rel="stylesheet">

<div id="page-content">
	<div class="panel">
		<div class="panel-heading">
			<h3 class="panel-title"><?=$judul;?></h3>
		</div>
	<div class="panel-body">
	<table>
		<tr>
			<td>
				<table>
					<tr>
						<td valign="top" width="630px">
							<form action="#" id="surat_masuk" class="form-horizontal">
								<input type="hidden" value="<?=$surat['id_surat'];?>" name="id_surat"/> 
								<div class="form-body">
									<div class="form-group">
										<label class="control-label col-md-4">Nomor Surat/Nota Dinas/Undangan</label>
										<div class="col-md-8">
											<input name="nomor_surat" class="form-control" type="text" value="<?=$surat['nomor_surat'];?>">
											<span class="help-block"></span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-4">Tanggal Surat</label>
										<div class="col-md-8">
											<input name="tgl_surat_udangan" class="form-control" type="date" value="<?=$surat['tgl_surat_udangan'];?>">
											<span class="help-block"></span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-4">Perihal</label>
										<div class="col-md-8">
											<input name="perihal_surat"  class="form-control" type="text" value="<?=$surat['perihal_surat'];?>">
											<span class="help-block"></span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-4">Penyelenggara</label>
										<div class="col-md-8">
											<input name="penyelenggara" class="form-control" type="text" value="<?=$surat['penyelenggara'];?>">
											<span class="help-block"></span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-4">Nama Kegiatan</label>
										<div class="col-md-8">
											<input name="nama_kegiatan" class="form-control" type="text" value="<?=$surat['nama_kegiatan'];?>">
											<span class="help-block"></span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-4">Pelaksanaan</label>
										<div class="col-md-4">
											<input name="mulai_tanggal" class="form-control" type="date" value="<?=$surat['mulai_tanggal'];?>">
											<span class="help-block"></span>
										</div>
										 <div class="col-md-4">
											<input name="akhir_tanggal" class="form-control" type="date" value="<?=$surat['akhir_tanggal'];?>">
											<span class="help-block"></span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-4">Tempat Kegiatan</label>
										<div class="col-md-8">
											<textarea name="tempat_kegiatan" rows="4" class="form-control"><?=$surat['tempat_kegiatan'];?></textarea>
											<span class="help-block"></span>
										</div>
									</div>
									
									
									<div class="form-group">
										<label class="control-label col-md-4">Ketugasan</label>
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
										<label class="control-label col-md-4">Keterangan Presensi</label>
										<div class="col-md-8">
											<div class="radio col-md-3">
											
											<input type="radio" name="presensi" value="Presensi" <?php
												if($surat['presensi']=='Presensi'){
													echo 'checked';
												}
											?>>
											Presensi
										</div>
										
											<div class="radio col-md-4">
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
										<label class="control-label col-md-4"></label>
										<div class="col-md-8"><br>
											<a href="javascript:void(0)" onclick="tambah_anggota()"><font color="green"><i class="glyphicon glyphicon-user"></i> [TAMBAH PERSONIL]</font></a>
											<div id="personel"></div>
										</div>
									</div>
									<!-- <div class="form-group">
										<br>
										<label class="control-label col-md-4"></label><div class="col-md-8">
											<a href="javascript:void(0)" onclick="tambah_tembusan()"><font color="green"><i class="glyphicon glyphicon-th-list"></i> [TAMBAH TEMBUSAN]</font></a>
											 <br>
											<div id="tembusan"></div>
											
										</div>
									</div> -->
									<div class="col-md-12"><br><br><center><button type="button" onclick="update_surat_masuk()" class="btn btn-success btn-lg btn-block">UPDATE SURAT</button></center><br>
									</div>
									<div class="form-group">
										<label class="control-label col-md-4">Tipe Surat</label>
										<div class="col-md-8">
											<select name="tipe_surat" class="form-control">
												<option value="<?=$surat['tipe_surat'];?>"><?php if($surat['tipe_surat']==NULL){echo 'Pilih Tipe Surat';}else{ echo $surat['tipe_surat'];}?></option>
												<option value="Surat">Surat</option>
												<option value="Nota Dinas">Nota Dinas</option>
												<option value="Undangan">Undangan</option>
												<option value="Surat Edaran">Surat Edaran</option>
												<option value="Surat Keputusan">Surat Keputusan</option>
											</select>
											<span class="help-block"></span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-4">Pejabat di Dasar Surat</label>
										<div class="col-md-8">
											<input name="pejabat_disurat"  class="form-control" type="text" value="<?=$surat['pejabat_disurat'];?>">
											<span class="help-block"></span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-4">Nomor Surat</label>
										<div class="col-md-8">
											<input name="nomor_surat_admin" class="form-control" type="text" value="<?=$surat['nomor_surat_admin'];?>">
											<span class="help-block"></span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-4">Tanggal Surat</label>
										<div class="col-md-8">
											<input name="tgl_surat_pengesahan" class="form-control" type="date" value="<?=$surat['tgl_surat_pengesahan'];?>">
											<span class="help-block"></span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-4">Tanda Tangan Pejabat</label>
										<div class="col-md-8">
											<select name="tertanda_pejabat" class="form-control">
												<option value="<?=$surat['tertanda_pejabat'];?>"><?php if($surat['tertanda_pejabat']==NULL){echo 'Tanda Tangan Pejabat';}else{ echo $surat['tertanda_pejabat'];}?></option>
												<option value="Kepala">Kepala</option>
												<option value="Kepala Bagian Tata Usaha">Kepala Bagian Tata Usaha</option>
											</select>
											<span class="help-block"></span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-4">Unggah Dokumen TTE</label>
										<div class="col-md-8">
										<a href="javascript:void(0)" onclick="tampil_form_gambar(<?=$surat['id_surat']?>)">
										<button type="button" class="btn btn-success">Tambah/Update Lampiran TTE</button></a>
										<div id="keterangan_tte"></div>
										</div>
									</div>
								</div>
									
									<div class="col-md-12"><br><br><center><button type="button" onclick="validasi_surat()" class="btn btn-success btn-lg btn-block">VALIDASI SURAT</button></center><br>
									</div>
									
									<div class="col-md-12"><center>
										<div class="col-md-6">
										<div id="cetak"></div>
										</div>
										<div class="col-md-6">
										<div id="cetak2"></div></center>
										</div>
									</div>

								</div>
							</form>
							
							
						</td>
					</tr>
				</table>
			</td>
			<td width="30px"></td>
			<td valign="top" width="370px" align="center">
			<?php
				if($surat['file_surat']==NULL){
			?>
			<img src="<?=base_url();?>assets/img/lampiran/format_uk.jpg" class="img-responsive" alt="Surat" width="360px" height="720px">
			<?php
				}else{
			?>
			<object data="<?=base_url();?>assets/img/lampiran/<?=$surat['file_surat'];?>" width="125%" height="650x" /></object>
			<br><a href="<?=base_url();?>assets/img/lampiran/<?=$surat['file_surat'];?>" target="_blank"><button>Download Berkas</button></a>
			<?php
				}
			?>
			</td>
		</tr>
	
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
            "url": "<?php echo site_url('daftarPengajuan/ajax_list')?>",
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
	
	reload_personel();
	reload_keterangan_tte()
	reload_cetak();
	reload_cetak2();

});

function update_surat_masuk()
{
    $('#btnSave').text('saving...'); 
    $('#btnSave').attr('disabled',true); 


    $.ajax({
        url : "<?php echo site_url('daftarPengajuan/update_surat')?>",
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

function validasi_surat()
{
    $('#btnSave').text('saving...'); 
    $('#btnSave').attr('disabled',true); 


    $.ajax({
        url : "<?php echo site_url('daftarPengajuan/validasi_surat')?>",
        type: "POST",
        data: $('#surat_masuk').serialize(),
        dataType: "JSON",
        success: function(data)
        {

            if(data.status) 
            {
               alert('Berhasil, Surat telah divalidasi');
			   reload_cetak();
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
        url : "<?php echo site_url('daftarPengajuan/simpan_anggota')?>",
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
		url: '<?=base_url("daftarPengajuan/tampil_anggota/$id_suratnya");?>',
		async: false,
		type: 'POST',
		success: function(data) {
		$('#personel').html(data);
		}
	})
}

function reload_cetak()
{
	$.ajax({
		url: '<?=base_url("daftarPengajuan/tampil_cetak/$id_suratnya");?>',
		async: false,
		type: 'POST',
		success: function(data) {
		$('#cetak').html(data);
		}
	})
}

function reload_cetak2()
{
	$.ajax({
		url: '<?=base_url("daftarPengajuan/tampil_cetak_tte/$id_suratnya");?>',
		async: false,
		type: 'POST',
		success: function(data) {
		$('#cetak2').html(data);
		}
	})
}

function reload_keterangan_tte()
{
	$.ajax({
		url: '<?=base_url("daftarPengajuan/tampil_tte/$id_suratnya");?>',
		async: false,
		type: 'POST',
		success: function(data) {
		$('#keterangan_tte').html(data);
		}
	})
}

function tampil_form_gambar(id_surat)
{
    $('#update_tte')[0].reset();
    $('.form-group').removeClass('has-error');
    $('.help-block').empty();
 
    $.ajax({
        url : "<?php echo site_url('daftarPengajuan/ajax_edit/')?>/" + id_surat,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="id_surat"]').val(data.id_surat);
            $('#modal_form_tte').modal('show'); 
            $('.modal-title').text('Tambah/Edit TTE'); 

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

function update_file_tte()
{
    $('#btnSave').text('saving...'); 
    $('#btnSave').attr('disabled',true); 
	var data = new FormData($('#update_tte')[0]);
    $.ajax({
		url : "<?php echo site_url('daftarPengajuan/update_dokumen_tte')?>",
        type: "POST",
        data: data,
        dataType: "JSON",
		mimeType: "multipart/form-data",
		contentType: false,
		cache: false,
		processData: false,
        success: function(data)
        {
            $('#modal_form_tte').modal('hide');
            reload_keterangan_tte();
			reload_cetak2();
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('data error, penyimpanan gagal');
            $('#btnSave').text('save');
            $('#btnSave').attr('disabled',false);
        }
    });
}

function hapus_personil(id_anggota_permanen)
{
    if(confirm('Yakin menghapus data?'))
    {

        $.ajax({
            url : "<?php echo site_url('daftarPengajuan/hapus_personilnya')?>/" + id_anggota_permanen,
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

function tambah_tembusan()
{
    $('#form3')[0].reset();
    $('.form-group').removeClass('has-error');
    $('.help-block').empty();
    $('#modal_form_tembusan').modal('show');
    $('.modal-title').text('Tambah Tembusan');
}

function simpanTembusan()
{
    $('#btnSave').text('saving...'); 
    $('#btnSave').attr('disabled',true); 


    $.ajax({
        url : "<?php echo site_url('daftarPengajuan/simpan_tembusan')?>",
        type: "POST",
        data: $('#form3').serialize(),
        dataType: "JSON",
        success: function(data)
        {
            if(data.status) 
            {
                $('#modal_form_tembusan').modal('hide');
                reload_tembusan();
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

function reload_tembusan()
{
	$.ajax({
		url: '<?php echo base_url("daftarPengajuan/tampil_tembusan/$id_suratnya");?>',
		async: false,
		type: 'POST',
		success: function(data) {
		$('#tembusan').html(data);
		}
	})
}

function hapus_tembusan(id_tembusan)
{
    if(confirm('Yakin menghapus data?'))
    {

        $.ajax({
            url : "<?php echo site_url('daftarPengajuan/hapus_tembusannya')?>/" + id_tembusan,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
             
               reload_tembusan();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Hapus data gagal');
            }
        });

    }
	
}

function hapus_tte(file_tte)
{
        $.ajax({
            url :"<?php echo base_url('daftarPengajuan/hapus_tte/')?>/"+file_tte,
            type: "POST",
            dataType: "JSON",
            success: function()
            {
               reload_keterangan_tte();
			   reload_cetak2();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
               reload_keterangan_tte();
			   reload_cetak2();
            }
        });
}
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
                            <label class="control-label col-md-4">Personil</label>
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

<div class="modal fade" id="modal_form_tembusan" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title"><?=$judul;?></h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form3" class="form-horizontal">
                    <input type="hidden" value="<?=$id_suratnya;?>" name="kode_suratnya"/> 
                    <div class="form-body">
						<div class="form-group">
                            <label class="control-label col-md-4">Tembusan</label>
                            <div class="col-md-8">
								<input name="nama_tembusan" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="simpanTembusan()" class="btn btn-primary">Tambahkan</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_form_tte" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title"><?=$judul;?></h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="update_tte" class="form-horizontal">
						<div class="form-group">
                            <div class="col-md-12">
								<input name="id_surat" type="text" hidden>
								<input name="userfile" type="file">
									<small> <font color="green">[Support file: pdf]</font></small> 
                            </div>
                        </div>
						</form>
                        </div>
						<div class="modal-footer">
                <button type="button" onclick="update_file_tte()" class="btn btn-primary">Kirim</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
            </div>
		</div>       
	</div>       
    </div>