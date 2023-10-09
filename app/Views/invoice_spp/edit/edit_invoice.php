<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="card">
        <div class="card-body">
            <div class="basic-form">
              <form class="form-horizontal form-label-left" novalidate  action="<?= base_url('home/aksi_edit_invoice')?>" method="post">
                  <input type="hidden" name="id" value="<?= $duar->id_spp ?>">

        <div class="row">
          <div class="mb-3 col-md-6">
          <label class="control-label col-12">Students Name<span style="color: red;">*</span>
          </label>
          <div class="col-12">
            <select  name="id_siswa" class="form-control text-capitalize" id="id_siswa" required>
              <option class="text-capitalize" value="<?= $duar->id_siswa?>"><?= $duar->nama_siswa?></option>

              <?php 
              foreach ($ko as $siswa) {
              ?>
              <option class="text-capitalize" value="<?php echo $siswa->id_siswa ?>"><?php echo $siswa->nama_siswa ?></option>
              <?php } ?>
            </select>
          </div>
        </div>
          <div class="mb-3 col-md-6">
          <label class="control-label col-md-12 col-sm-12 col-xs-12">Due Date <span style="color: red;">*</span>
          <div class="col-md-12 col-sm-12 col-xs-12">
          <input type="datetime-local" name="tgl_jatuh_tempo" id="tgl_jatuh_tempo" placeholder="Due Date" class="form-control col-md-12 col-xs-12" value="<?= $duar->tgl_jatuh_tempo?>" required>  
          </div>
        </div>
          <div class="mb-3 col-md-6">
              <label class="form-label">Description<span style="color: red;">*</span></label>
              <select  name="id_paket" class="form-control text-capitalize" id="id_paket" required>
              <option class="text-capitalize" value="<?= $duar->id_paket?>"><?= $duar->nama_paket?></option>
                <?php 
                foreach ($pp as $paket) {
                ?>
                <option class="text-capitalize" value="<?php echo $paket->id_paket ?>"><?php echo $paket->nama_paket ?> - Rp. <?php echo $paket->harga_paket ?></option>
                <?php } ?>
              </select>
          </div>
          <div class="mb-3 col-md-6">
          <div class="col-md-12 col-sm-12 col-xs-12">
          <input type="date" name="tgl_spp" id="tgl_spp" placeholder="SPP Date" class="form-control col-md-12 col-xs-12" value="<?= $duar->tgl_spp?>" required>  
          </div>
        </div>   
      </div>
          <a href="<?= base_url('/home/invoice')?>" type="submit" class="btn btn-primary">Cancel</a></button>
          <button type="submit" class="btn btn-success">Update</button>
        </form>
    </div>
</div>
</div>
</div>
