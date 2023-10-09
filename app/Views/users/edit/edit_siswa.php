<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="card">
        <div class="card-body">
            <div class="basic-form">
              <form class="form-horizontal form-label-left" novalidate  action="<?= base_url('home/aksi_edit_students')?>" method="post">
                 <input type="hidden" name="id" value="<?= $duar->id_user ?>">

                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label">NIS<span style="color: red;">*</span></label>
                            <input type="text" id="nik" name="nis" 
                            class="form-control" placeholder="NIS" value="<?= $duar->nis?>">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Teacher Name<span style="color: red;">*</span></label>
                            <input type="text" id="nama_siswa" name="nama_siswa" 
                            class="form-control text-capitalize" placeholder="Teacher Name" value="<?= $duar->nama_siswa?>">
                        </div>
                        <div class="mb-3 col-md-6">
                        <label class="control-label col-md-12 col-sm-12 col-xs-12">E-mail<span style="color: red;">*</span></label>
                          <div class="input-group">
                            <input type="text" id="email_siswa" name="email_siswa" placeholder="E-mail" required="required" class="form-control" value="<?= $duar->email_siswa?>">
                            <span class="input-group-text">@gmail.com</span>
                          </div> 
                        </div> 
                        <div class="mb-3 col-md-6">
                          <label class="control-label col-12">Class Name <span style="color: red;">*</span>
                          </label>
                          <div class="col-12">
                            <select  name="id_kelas" class="form-control text-uppercase" id="id_kelas" required>
                              <option class="text-uppercase" value="<?= $duar->id_kelas?>"><?= $duar->nama_kelas?></option>

                              <?php 
                              foreach ($ok as $kelas) {
                              ?>

                              <option class="text-uppercase" value="<?php echo $kelas->id_kelas ?>"><?php echo $kelas->nama_kelas ?></option>
                              <?php } ?>
                            </select>
                          </div>
                        </div>
                        <div class="mb-3 col-md-6">
                          <label class="control-label col-12">Major Name <span style="color: red;">*</span>
                          </label>
                          <div class="col-12">
                            <select  name="id_jurusan" class="form-control text-uppercase" id="id_jurusan" required>
                              <option class="text-uppercase" value="<?= $duar->id_jurusan?>"><?= $duar->nama_jurusan?></option>

                              <?php 
                              foreach ($j as $jurusan) {
                              ?>

                              <option class="text-uppercase" value="<?php echo $jurusan->id_jurusan ?>"><?php echo $jurusan->nama_jurusan ?></option>
                              <?php } ?>
                            </select>
                          </div>
                        </div>
                        <div class="mb-3 col-md-6">
                          <label class="control-label col-12">Rombel Name <span style="color: red;">*</span>
                          </label>
                          <div class="col-12">
                            <select  name="id_rombel" class="form-control text-uppercase" id="id_rombel" required>
                              <option class="text-uppercase" value="<?= $duar->id_rombel?>"><?= $duar->nama_rombel?></option>

                              <?php 
                              foreach ($r as $rombel) {
                              ?>

                              <option class="text-uppercase" value="<?php echo $rombel->id_rombel ?>"><?php echo $rombel->nama_rombel ?></option>
                              <?php } ?>
                            </select>
                          </div>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Gender<span style="color: red;">*</span></label>
                            <div class="col-12">
                            <select id="jk_siswa" class="form-control col-12" data-validate-length-range="6" data-validate-words="2" name="jk_siswa" required="required">
                              <option value="<?= $duar->jk_siswa?>"><?= $duar->jk_siswa; ?></option>
                              <option value="Male">Male</option>
                              <option value="Female">Female</option>
                            </select>
                          </div>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Place And Date Of Birth<span style="color: red;">*</span></label>
                            <input type="text" id="ttl_siswa" name="ttl_siswa" 
                            class="form-control text-capitalize" placeholder="Place And Date Of Birth" value="<?= $duar->ttl_siswa?>">
                        </div>
                        <div class="mb-3 col-md-6">
                          <label class="control-label col-12">Major Name <span style="color: red;">*</span>
                          </label>
                          <div class="col-12">
                            <select  name="id_paket" class="form-control text-uppercase" id="id_paket" required>
                              <option class="text-uppercase" value="<?= $duar->id_paket?>"><?= $duar->nama_paket?> - <?= $duar->harga_paket?></option>

                              <?php 
                              foreach ($p as $jurusan) {
                              ?>

                              <option class="text-uppercase" value="<?php echo $jurusan->id_paket ?>"><?php echo $jurusan->nama_paket ?> - <?= $duar->harga_paket?></option>
                              <?php } ?>
                            </select>
                          </div>
                        </div>
                         <div class="mb-3 col-md-6">
                            <label class="form-label">Username<span style="color: red;">*</span></label>
                            <div class="col-12">
                            <input type="text" id="username" name="username" 
                            class="form-control text-capitalize" placeholder="Username" value="<?= $duar->username?>">
                          </div>
                        </div>
                    </div>
          <a onclick="history.back()" type="submit" class="btn btn-primary">Cancel</a></button>
          <button type="submit" class="btn btn-success">Update</button>
        </form>
    </div>
</div>
</div>
</div>
