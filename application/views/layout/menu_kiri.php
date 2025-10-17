<nav id="mainnav-container">
                    <div id="mainnav">
                        <div id="mainnav-menu-wrap">
                            <div class="nano">
                                <div class="nano-content">
                                    <ul id="mainnav-menu" class="list-group">
                                        
                                        <li class="list-header">MENU</li>
										<?php
											if($this->session->userdata('level_user')=='Admin Bagian'){
										?>
										<li>
                                            <a href="<?=base_url();?>bagian">
                                            <i class="fa fa-calendar"></i>
                                            <span class="menu-title">
                                            Profil Unit Kerja
                                            </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?=base_url();?>bagian/kinerja">
                                            <i class="fa fa-calendar"></i>
                                            <span class="menu-title">
                                            Kinerja Harian
                                            </span>
                                            </a>
                                        </li>
										<li>
                                            <a href="<?=base_url();?>bagian/laporan">
                                            <i class="fa fa-calendar"></i>
                                            <span class="menu-title">
                                            Laporan
                                            </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://drive.google.com/file/d/1lnL4C4l6tWfdi5u1FLoQo76RdML-dXMQ/view" target="_blank">
                                            <i class="fa fa-calendar"></i>
                                            <span class="menu-title">
                                            MANUAL BOOK
                                            </span>
                                            </a>
                                        </li>
										<?php
											}else{
										?>
										
										      <a href="<?=base_url();?>adminBagian"><i class="fa fa-caret-right"></i> USER </a>
                                                <a href="<?=base_url();?>adminSk"><i class="fa fa-caret-right"></i>Sasaran Kegiata</a>
                                                <a href="<?=base_url();?>adminIk"><i class="fa fa-caret-right"></i> Indikator Kinerja </a>
												<a href="<?=base_url();?>adminSk/unit_kerja"><i class="fa fa-caret-right"></i> Unit Kerja</a>
												<a href="<?=base_url();?>adminSk/sk_unit"><i class="fa fa-caret-right"></i> Unit Kerja/SK </a>
												<a href="https://drive.google.com/file/d/1UkgtExfgvUqgQBQuriGjJMtJom7jtbAM/view" target="_blank"></i> MANUAL BOOK </a>
									
										    
                                           
										
										<?php
											}
										?>
                                        <li class="list-divider"></li>
                                        </li>
                                    </ul>
                                    </div>
                                </div>
                            </div>
                    </div>  
                </nav>