<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="card">
        <div class="card-body">
            <div class="basic-form">
                <form class="form-horizontal form-label-left" novalidate  action="<?= base_url('home/aksi_add_invoice')?>" method="post">


                    <div class="row">
                        <div class="mb-3 col-md-6">
                          <label class="control-label col-12">Students Name<span style="color: red;">*</span>
                          </label>
                          <div class="col-12">
                            <select  name="id_siswa" class="form-control text-capitalize" id="id_siswa" required>
                              <option>Select Students Name</option>
                              <?php 
                              foreach ($p as $siswa) {
                              ?>
                              <option class="text-capitalize" value="<?php echo $siswa->id_siswa ?>"><?php echo $siswa->nama_siswa ?></option>
                              <?php } ?>
                            </select>
                          </div>
                        </div>
                        <div class="mb-3 col-md-6">
                        <label class="control-label col-md-12 col-sm-12 col-xs-12">Due Date<span style="color: red;">*</span></label>
                            <input type="datetime-local" id="tgl_jatuh_tempo" name="tgl_jatuh_tempo" placeholder="Due Date" required="required" class="form-control">
                        </div> 
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Description<span style="color: red;">*</span></label>
                            <select  name="id_paket" class="form-control text-capitalize" id="id_paket" required>
                              <option>Select Description</option>
                              <?php 
                              foreach ($pp as $paket) {
                              ?>
                              <option class="text-capitalize" value="<?php echo $paket->id_paket ?>"><?php echo $paket->nama_paket ?> - Rp. <?php echo $paket->harga_paket ?></option>
                              <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label"></label>
                            <input type="date" id="tgl_spp" name="tgl_spp" 
                            class="form-control text-capitalize" placeholder="SPP Date">
                        </div>
                    </div>
          <a href="<?= base_url('/home/invoice')?>" type="submit" class="btn btn-primary">Cancel</a></button>
          <button type="submit" class="btn btn-success">Submit</button>
        </form>
    </div>
</div>
</div>
</div>