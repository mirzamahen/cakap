<header id="navbar">
                <div id="navbar-container" class="boxed">
                    <div class="navbar-header">
                        <!--<a href="#" class="navbar-brand">-->
                           <!-- <i class="fa fa-cube brand-icon"></i>-->
                           <div><font size="5"><b>&nbsp;C&nbsp;&nbsp;A&nbsp;&nbsp;K&nbsp;&nbsp;A&nbsp;&nbsp;P</b></font></div>
                           <div><font size="2">&nbsp;&nbsp;Catatan Kinerja Pegawai</font></div>
                            <!--<div class="brand-title">
                                <span class="brand-text">CAKAP</span>
                            </div>-->
                        </a>
                    </div>
                    <div class="navbar-content clearfix">
                        <ul class="nav navbar-top-links pull-left">
                            <li class="tgl-menu-btn">
                                <a class="mainnav-toggle" href="#"> <i class="fa fa-navicon fa-lg"></i> </a>
                            </li>
                        </ul>
                        <ul class="nav navbar-top-links pull-right">
                            <li id="dropdown-user" class="dropdown">
                                <a href="#" data-toggle="dropdown" class="dropdown-toggle text-right">
                                    <span class="pull-right"> <img class="img-circle img-user media-object" src="<?=base_url();?>assets/admin/img/user.png" alt="Profile Picture"> </span>
                                    <div class="username hidden-xs">
									<?php
										$pengguna=$this->modelPengajuan->data_user();
									?>
									<?=$pengguna->nama_user;?></div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right with-arrow">
                                    <ul class="head-list">
										<?php
											if($this->session->userdata('level_user')=='Admin Utama'){
										?>
                                        <li>
                                            <a href="#"> <i class="fa fa-user fa-fw fa-lg"></i> Profile </a>
                                        </li>
                                        <li>
                                            <a href="#">  <i class="fa fa-gear fa-fw fa-lg"></i> Reset Password </a>
                                        </li>
										 <li>
                                            <a href="<?=base_url();?>login/keluar_admin">  <i class="fa fa-sign-out fa-fw"></i> Logout </a>
                                        </li>
											<?php }else{
										?>
										<li>
                                            <a href="<?=base_url();?>bagian"> <i class="fa fa-user fa-fw fa-lg"></i> Profile </a>
                                        </li>
                                        <li>
                                            <a href="#">  <i class="fa fa-gear fa-fw fa-lg"></i> Reset Password </a>
                                        </li>
										 <li>
                                            <a href="<?=base_url();?>login/keluar_bagian">  <i class="fa fa-sign-out fa-fw"></i> Logout </a>
                                        </li>
										<?php
										
										}
										?>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </header>