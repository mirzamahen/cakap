<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> <?=$judul;?></title>
        <link rel="shortcut icon" href="<?=base_url();?>assets/admin/img/favicon.ico">
		
		<link href="<?=base_url();?>assets/css/bootstrap.min.css" rel="stylesheet">
		<link href="<?=base_url();?>assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
		<script type="text/javascript" src="<?=base_url();?>assets/sweetalert/dist/sweetalert2.min.js"></script> 
		<link rel="stylesheet" href="<?=base_url();?>assets/sweetalert/dist/sweetalert2.css" type="text/css">
        <link href="<?=base_url();?>assets/css/style.css" rel="stylesheet">
		<link href="<?=base_url();?>assets/plugins/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet">
		<link href="<?=base_url();?>assets/plugins/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet">
      
    </head>
    <body>
        <div id="container" class="effect mainnav-lg navbar-fixed mainnav-fixed">
            <?php $this->load->view('layout/header_atas');?>
            <div class="boxed">
                <div id="content-container">
                    <?php $this->load->view($isi);?>
                </div>
             <?php $this->load->view('layout/menu_kiri');?>   
            </div>
        </div>
		<script src="<?=base_url();?>assets/js/jquery-2.1.1.min.js"></script>
        <script src="<?=base_url();?>assets/js/bootstrap.min.js"></script>
        <script src="<?=base_url();?>assets/js/scripts.js"></script>
        <script src="<?=base_url();?>assets/plugins/nanoscrollerjs/jquery.nanoscroller.min.js"></script>
        <script src="<?=base_url();?>assets/plugins/metismenu/metismenu.min.js"></script>
		<script src="<?=base_url();?>assets/plugins/datatables/media/js/jquery.dataTables.js"></script>
        <script src="<?=base_url();?>assets/plugins/datatables/media/js/dataTables.bootstrap.js"></script>
        <script src="<?=base_url();?>assets/plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
        <script src="<?=base_url();?>assets/plugins/screenfull/screenfull.js"></script>
        <script src="<?=base_url();?>assets/js/demo/tables-datatables.js"></script>
    </body>
</html>