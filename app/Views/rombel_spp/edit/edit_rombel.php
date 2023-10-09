<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="card">
        <div class="card-body">
            <div class="basic-form">
                <form class="form-horizontal form-label-left" novalidate  action="<?= base_url('home/aksi_edit_rombel')?>" method="post">
                  <input type="hidden" name="id" value="<?= $duar->id_rombel ?>">

                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Class Name<span style="color: red;">*</span></label>
                              <div class="col-12">
                              <select  name="id_kelas" class="form-control text-uppercase" id="id_kelas" required>
                                <option class="text-uppercase" value="<?= $duar->id_kelas?>"><?= $duar->nama_kelas?></option>
                                <?php 
                                foreach ($kk as $kelas) {
                                ?>
                                <option class="text-uppercase" value="<?php echo $kelas->id_kelas ?>"><?php echo $kelas->nama_kelas ?></option>
                                <?php } ?>
                              </select>
                            </div>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Major Name<span style="color: red;">*</span></label>
                              <div class="col-12">
                              <select  name="id_jurusan" class="form-control text-uppercase" id="id_jurusan" required>
                              <option class="text-uppercase" value="<?= $duar->id_jurusan?>"><?= $duar->nama_jurusan?></option>
                                <?php 
                                foreach ($jj as $jurusan) {
                                ?>
                                <option class="text-uppercase" value="<?php echo $jurusan->id_jurusan ?>"><?php echo $jurusan->nama_jurusan ?></option>
                                <?php } ?>
                              </select>
                            </div>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Rombel Name<span style="color: red;">*</span></label>
                            <input type="text" id="nama_rombel" name="nama_rombel" 
                            class="form-control text-uppercase" placeholder="Rombel Name" value="<?= $duar->nama_rombel?>">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Teacher Name<span style="color: red;">*</span></label>
                              <div class="col-12">
                              <select  name="id_guru" class="form-control text-capitalize" id="id_guru" required>
                              <option class="text-uppercase" value="<?= $duar->id_guru?>"><?= $duar->nama_guru?></option>
                                <?php 
                                foreach ($gg as $guru) {
                                ?>
                                <option class="text-capitalize" value="<?php echo $guru->id_guru ?>"><?php echo $guru->nama_guru ?></option>
                                <?php } ?>
                              </select>
                            </div>
                        </div>
                    </div>
          <a href="<?= base_url('/home/rombel')?>" type="submit" class="btn btn-primary">Cancel</a></button>
          <button type="submit" class="btn btn-success">Update</button>
        </form>
    </div>
</div>
</div>
</div>
