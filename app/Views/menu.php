        <div class="deznav">
            <div class="deznav-scroll">
				<ul class="metismenu" id="menu">
<?php  if(session()->get('id')>0) { ?>
                    <li><a href="<?= base_url('/home/dashboard')?>" class="ai-icon" aria-expanded="false">
                            <i class="flaticon-381-home" title="Dashboard"></i>
                            <span  class="nav-text">Dashboard</span>
                        </a>
                    </li>
<?php }else{} ?>
<?php  if(session()->get('level')== 1) { ?>
                    <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                            <i class="flaticon-381-user-9" title="Users"></i>
                            <span class="nav-text">Users</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="<?= base_url('/home/teacher')?>">Teacher</a></li>
                            <li><a href="<?= base_url('/home/students')?>">Students</a></li>
                        </ul>
                    </li>
<?php }else{} ?>
<?php  if(session()->get('level')== 1) { ?>
                    <li><a href="<?= base_url('/home/class')?>" class="ai-icon" aria-expanded="false">
                            <i class="flaticon-381-id-card-1" title="Class"></i>
                            <span class="nav-text">Class</span>
                        </a>
                    </li>
<?php }else{} ?>
<?php  if(session()->get('level')== 1) { ?>
                    <li><a href="<?= base_url('/home/major')?>" class="ai-icon" aria-expanded="false">
                            <i class="flaticon-381-id-card-4" title="Class"></i>
                            <span class="nav-text">Major</span>
                        </a>
                    </li>
<?php }else{} ?>
<?php  if(session()->get('level')== 1) { ?>
                    <li><a href="<?= base_url('/home/rombel')?>" class="ai-icon" aria-expanded="false">
                            <i class="flaticon-381-newspaper" title="Rombel"></i>
                            <span class="nav-text">Rombel</span>
                        </a>
                    </li>
<?php }else{} ?>
<?php  if(session()->get('level')== 1) { ?>
                    <li><a href="<?= base_url('/home/packet')?>" class="ai-icon" aria-expanded="false">
                            <i class="flaticon-381-album-2" title="Packet"></i>
                            <span class="nav-text">Packet</span>
                        </a>
                    </li>
<?php }else{} ?>
<?php  if(session()->get('level')== 1) { ?>
                    <hr class="sidebar-divider">

                    <li><a href="<?= base_url('/home/settings_control')?>" class="ai-icon" aria-expanded="false">
                            <i class="flaticon-381-settings-4" title="Settings Control"></i>
                            <span class="nav-text">Settings Control</span>
                        </a>
                    </li>
<?php }else{} ?>
<?php  if(session()->get('level')== 2 || session()->get('level')== 3) { ?>
                    <li><a href="<?= base_url('/home/invoice')?>" class="ai-icon" aria-expanded="false">
                            <i class="flaticon-381-television" title="Invoice List"></i>
                            <span class="nav-text">Invoice List</span>
                        </a>
                    </li>
<?php }else{} ?>
<?php  if(session()->get('level')== 2) { ?>
                    <li><a href="<?= base_url('/home/employee_salary')?>" class="ai-icon" aria-expanded="false">
                            <i class="flaticon-381-network" title="Employee Salary"></i>
                            <span class="nav-text">Employee Salary</span>
                        </a>
                    </li>
<?php }else{} ?>
<?php  if(session()->get('level')== 2 || session()->get('level')== 4) { ?>
                    <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
							<i class="flaticon-381-notepad" title="Report"></i>
							<span class="nav-text">Report</span>
						</a>
                        <ul aria-expanded="false">
<?php  if(session()->get('level')== 2) { ?>
                            <li><a href="<?= base_url('/home/spp_report')?>">SPP Report</a></li>
<?php }else{} ?>
<?php  if(session()->get('level')== 2 || session()->get('level')== 4) { ?>
                            <li><a href="<?= base_url('/home/employee_salary_report')?>">Employee Salary Report</a></li>
<?php }else{} ?>
                        </ul>
                    </li>
<?php }else{} ?>
                </ul>
			</div>
        </div>
<div class="content-body">
            <!-- row -->
            <div class="container-fluid">
                <div class="form-head d-flex mb-3 align-items-start">
                    <div class="me-auto d-none d-lg-block">
                        <!-- <p class="mb-0 text-capitalize">Welcome <i><b><?= session()->get('nama_guru')?></b></i> to Education Development Contribution System - SPP!</p> -->
                        <p class="mb-0 text-capitalize">Welcome <i><b>
                            <?php
                            if (session()->has('nama_guru')) {
                                echo session()->get('nama_guru');
                            } elseif (session()->has('nama_siswa')) {
                                echo session()->get('nama_siswa');
                            } else {
                                echo "Guest"; 
                            }
                            ?></b></i> to Education Development Contribution System - SPP!
                        </p>
                    </div>
                </div>
        
               