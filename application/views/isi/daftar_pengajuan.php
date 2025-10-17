<link href="<?php echo base_url('assets/datatables/css/dataTables.bootstrap.css')?>" rel="stylesheet">

<div id="page-content">
	<div class="panel">
		<div class="panel-heading">
			<h3 class="panel-title"><?=$judul;?></h3>
		</div>
	<div class="panel-body">
		<button class="btn btn-primary" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Refresh</button><br><br>
		<table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th width="20px">No</th>
							<th width="180px">Nomor Surat/Nota Dinas</th>
							<th widht="50px">Diajukan</th>
							<th width="150px">Perihal</th>
							<th width="260px">Tempat</th>
							<th width="40px">Ket. </th>
							<th style="width:200px;"><div class="text-center">Tindakan</div></th>
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
	reload_tembusan();

});

function reload_table()
{
    table.ajax.reload(null,false);
}
</script>
