<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="card">
        <div class="card-body">
            <div class="basic-form">
              <form class="form-horizontal form-label-left" novalidate  action="<?= base_url('home/aksi_edit_employee_salary')?>" method="post">
                  <input type="hidden" name="id" value="<?= $duar->id_gaji ?>">

        <div class="row">
          <div class="mb-3 col-md-6">
          <label class="control-label col-12">Employee Name<span style="color: red;">*</span>
          </label>
          <div class="col-12">
            <select  name="id_guru" class="form-control text-capitalize" id="id_guru" required>
              <option class="text-capitalize" value="<?= $duar->id_guru?>"><?= $duar->nama_guru?></option>

              <?php 
              foreach ($ko as $guru) {
              ?>
              <option class="text-capitalize" value="<?php echo $guru->id_guru ?>"><?php echo $guru->nama_guru ?></option>
              <?php } ?>
            </select>
          </div>
        </div>
          <div class="mb-3 col-md-6">
          <label class="control-label col-md-12 col-sm-12 col-xs-12">Amount <span style="color: red;">*</span>
          <div class="col-md-12 col-sm-12 col-xs-12">
          <input type="text" name="jumlah_gaji" id="jumlah_gaji" placeholder="Amount" class="form-control col-md-12 col-xs-12" value="<?= $duar->jumlah_gaji?>" required>  
          </div>
        </div>
          <div class="item form-group">
            <label class="form-label">Employee Payday<span style="color: red;">*</span></label>
            <div class="col-12">
            <input type="date" id="tanggal_gaji" name="tanggal_gaji" 
            class="form-control text-capitalize" placeholder="Employee Payday" value="<?= $duar->tanggal_gaji?>">
          </div>
        </div>
      </div>
          <a href="<?= base_url('/home/employee_salary')?>" type="submit" class="btn btn-primary">Cancel</a></button>
          <button id="send" type="submit" class="btn btn-success">Update</button>
        </form>
    </div>
</div>
</div>
</div>
