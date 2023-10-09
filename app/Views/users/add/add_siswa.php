<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="card">
        <div class="card-body">
            <div class="basic-form">
              <form class="form-horizontal form-label-left" novalidate  action="<?= base_url('home/aksi_add_students')?>" method="post">


                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label">NIS<span style="color: red;">*</span></label>
                            <input type="text" id="nis" name="nis" 
                            class="form-control" placeholder="NIS">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Full Name<span style="color: red;">*</span></label>
                            <input type="text" id="nama_siswa" name="nama_siswa" 
                            class="form-control text-capitalize" placeholder="Full Name">
                        </div>
                        <div class="mb-3 col-md-6">
                        <label class="control-label col-md-12 col-sm-12 col-xs-12">E-mail<span style="color: red;">*</span></label>
                          <div class="input-group">
                            <input type="text" id="email_siswa" name="email_siswa" placeholder="E-mail" required="required" class="form-control">
                            <span class="input-group-text">@gmail.com</span>
                          </div> 
                        </div> 
                        <div class="mb-3 col-md-6">
                          <label class="control-label col-12">Class Name <span style="color: red;">*</span>
                          </label>
                          <div class="col-12">
                            <select  name="id_kelas" class="form-control text-capitalize" id="id_kelas" required>
                              <option>Select Class</option>
                              <?php 
                              foreach ($duar as $kelas) {
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
                            <select  name="id_jurusan" class="form-control text-capitalize" id="id_jurusan" required>
                              <option>Select Major</option>
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
                            <select  name="id_rombel" class="form-control text-capitalize" id="id_rombel" required>
                              <option>Select Rombel</option>
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
                              <option>Select Gender</option>
                              <option value="Male">Male</option>
                              <option value="Female">Female</option>
                            </select>
                          </div>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Place And Date Of Birth<span style="color: red;">*</span></label>
                            <input type="text" id="ttl_siswa" name="ttl_siswa" 
                            class="form-control text-capitalize" placeholder="Place And Date Of Birth">
                        </div>
                         <div class="mb-3 col-md-6">
                          <label class="control-label col-12">Packet Name <span style="color: red;">*</span>
                          </label>
                          <div class="col-12">
                            <select  name="id_paket" class="form-control text-capitalize" id="id_paket" required>
                              <option>Select Packet</option>
                              <?php 
                              foreach ($p as $paket) {
                              ?>
                              <option class="text-uppercase" value="<?php echo $paket->id_paket ?>"><?php echo $paket->nama_paket ?> - <?php echo $paket->harga_paket ?></option>
                              <?php } ?>
                            </select>
                          </div>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Username<span style="color: red;">*</span></label>
                            <div class="col-12">
                            <input type="text" id="username" name="username" 
                            class="form-control text-capitalize" placeholder="Username">
                          </div>
                        </div>
                    </div>
          <a href="<?= base_url('/home/students')?>" type="submit" class="btn btn-primary">Cancel</a></button>
          <button type="submit" class="btn btn-success">Submit</button>
        </form>
    </div>
</div>
</div>
</div>