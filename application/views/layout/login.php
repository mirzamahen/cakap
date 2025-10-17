<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> CAKAP | Kanwil Kemenag DIY</title>
        <link rel="shortcut icon" href="img/favicon.ico">
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:300,400,700|Roboto:300,400,700" rel="stylesheet">
        <link href="<?=base_url();?>assets/admin/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?=base_url();?>assets/admin/css/style.css" rel="stylesheet">
        <link href="<?=base_url();?>assets/admin/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <link href="<?=base_url();?>assets/admin/plugins/switchery/switchery.min.css" rel="stylesheet">
        <link href="<?=base_url();?>assets/admin/plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet">
        <link href="<?=base_url();?>assets/admin/css/demo/jasmine.css" rel="stylesheet">
        <link href="<?=base_url();?>assets/admin/plugins/pace/pace.min.css" rel="stylesheet">
        <script src="<?=base_url();?>assets/admin/plugins/pace/pace.min.js"></script>
    </head>




<body>
        <style>
        body{
            /*background-color: coral;*/
            background-image: url("/assets/img/bg-cakap1.jpg");
            background-size:100%;
            position:fixed;
            width:36%;
            height:100%;
            opacity: 0.87;
        }
        .tengah {
            display: flex;
            justify-content: center;
            
        }
    </style>
       
       
       <div id="container" class="cls-container">
            <div class="lock-wrapper">
                <div class="panel lock-box"> 
                <img height="73" alt="" src="<?=base_url();?>assets/img/CAKAP.png"/> <br/><br/>
                    <!--<h4><font size="10"><b>C A K A P</b></font></h4>
                    <h4>Catatan Kinerja Pegawai</h4>-->
                    <!--<h4><font size="2">Human Resources Development (HRD) Center<b>- est. 2022</b></font></h4>-->
                    <div class="row">
                        
                        <form action="#" class="form-inline" id="formku">
                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                <div class="text-left">
                                    <!--<label class="text-muted">NIP</label>-->
                                    <input  type="text" placeholder="Masukkan NIP" class="form-control" name="username">
									<span class="help-block"></span>
                                </div>
                                <div class="text-left">
                                    <!--<label class="text-muted">Password</label>-->
                                    <input type="password" name="password" placeholder="Password" class="form-control">
									<span class="help-block"></span>
                                </div>
								 <input type="button" value="MASUK" id="btnSave" onclick="login()" class="btn btn-info form-control">
								 
                            </div><font color="#034d53"><i>"Manajemen kinerja pegawai bukan hanya alat untuk mengevaluasi kinerja, tetapi juga merupakan strategi untuk menciptakan organisasi yang efektif dan pegawai yang kompeten"</i></font><br/>
                            <font size="2" color="#18a3a3">Human Resources Development (HRD) Center<b>- est. 2022</b></font><br/><br/>
                            <iframe width="360" height="175" src="https://www.youtube.com/embed/9ni-NlLc0jE" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                        </form>
                    </div>
                    
                    
                </div>
                
               </div>
               
        </div> 
        
   </div>
   
</div>

		<script src="<?php echo base_url('assets/jquery/jquery-2.1.4.min.js')?>"></script>
        <script src="<?=base_url();?>assets/admin/js/bootstrap.min.js"></script>
        <script src="<?=base_url();?>assets/admin/plugins/fast-click/fastclick.min.js"></script>
        <script src="<?=base_url();?>assets/admin/js/scripts.js"></script>
        <script src="<?=base_url();?>assets/admin/plugins/switchery/switchery.min.js"></script>
        <script src="<?=base_url();?>assets/admin/plugins/bootstrap-select/bootstrap-select.min.js"></script>
 </body>	
</html>

		
<script type="text/javascript">		
	$(document).ready(function() {
	
	$("input").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });
	 
});

function login()
{
   
    $.ajax({
        url : "<?php echo site_url('login/login_user')?>",
        type: "POST",
        data: $('#formku').serialize(),
        dataType: "JSON",
        success: function(data)
        {

            if(data.status) 
            {
				window.location = "<?=base_url('user');?>";
            }
            else
            {
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); 
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]);
                }
            }
            $('#btnSave').text('Login');
            $('#btnSave').attr('disabled',false);


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('data error, Error Login');
            $('#btnSave').text('Login');
            $('#btnSave').attr('disabled',false);

        }
    });
}

	
		
		
</script>	
		
		
   
