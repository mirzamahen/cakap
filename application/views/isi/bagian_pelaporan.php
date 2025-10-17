<div id="page-content">
	<div class="panel">
		<div class="panel-heading">
			<h3 class="panel-title"><?=$judul;?></h3>
		</div>
	<div class="panel-body">
	<div class="row">
                       
                        <div class="col-lg-12">
                            <form class="login_form row" action="<?=base_url();?>bagian/exsport_ajax_pencarian_laporan" id="formku" method="post" target="__blank">
                              <div class="col-lg-2 form-group">
                                    <select class="form-control" name="bulan" required>
										<option value="">Pilih Bulan</center></option>
										<option value="01">Januari</center></option>
										<option value="02">Februari</center></option>
										<option value="03">Maret</center></option>
										<option value="04">April</center></option>
										<option value="05">Mei</center></option>
										<option value="06">Juni</center></option>
										<option value="07">Juli</center></option>
										<option value="08">Agustus</center></option>
										<option value="09">September</center></option>
										<option value="10">Oktober</center></option>
										<option value="11">November</center></option>
										<option value="12">Desember</center></option>
										
									</select>
									<font color="red"><span class="help-block"></span></font>
                                </div>
								<div class="col-lg-2 form-group">
                                    <select class="form-control" name="tahun" required>
										<option value="">Pilih Tahun</option>
										<?php
											date_default_timezone_set('Asia/Jakarta');
											$th_skr= date('Y');
											for ($i=2020;$i<=$th_skr;$i++){	
										?>
												<option value="<?=$i;?>"><?=$i;?></option>
										
										<?php
												
											}
										?>
										
									</select>
									<font color="red"><span class="help-block"></span></font>
                                </div>
								
                                <div class="col-lg-1 form-group">
                                    <button type="button" class=" form-control btn btn-dark" onclick="lihat()" id="btnSave"><div class="glyphicon glyphicon-search"></div> lihat  </button>
                                </div>
								<div class="col-lg-1 form-group">
									<button type="submit" class=" form-control btn btn-dark"><div class="glyphicon glyphicon-download"></div> xls </button>
                                </div>
                            </form>
							<hr>
							<div id="lihat_data"></div>
							<!-- Isinya ---->
                        </div>		
                                
	</div>
	</div>
</div>

<script src="<?php echo base_url('assets/jquery/jquery-2.1.4.min.js')?>"></script>

<script type="text/javascript">		
$(document).ready(function() {
	
    $("select").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });
	 $("input").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });
});




function lihat()
{
	$.ajax({
		type: "POST",
		url : "<?php echo base_url('bagian/ajax_pencarian_laporan');?>",
		data: $('#formku').serialize(),
		cache:false,
		success: function(data){
			$('#lihat_data').html(data);
		}
	});
}

function eksport()
{
	$.ajax({
		type: "POST",
		url : "<?php echo base_url('bagian/exsport_ajax_pencarian_laporan');?>",
		data: $('#formku').serialize(),
		cache:false,
		success: function(data){
			$('#lihat_data').html(data);
		}
	});
}

		
		
</script>


