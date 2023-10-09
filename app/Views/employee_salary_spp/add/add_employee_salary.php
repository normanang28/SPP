<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="card">
        <div class="card-body">
            <div class="basic-form">
                <form class="form-horizontal form-label-left" novalidate  action="<?= base_url('home/aksi_add_employee_salary')?>" method="post">


                    <div class="row">
                        <div class="mb-3 col-md-6">
                          <label class="control-label col-12">Employee Name<span style="color: red;">*</span>
                          </label>
                          <div class="col-12">
                            <select  name="id_guru" class="form-control text-capitalize" id="id_guru" required>
                              <option>Select Employee Name</option>
                              <?php 
                              foreach ($p as $guru) {
                              ?>
                              <option class="text-capitalize" value="<?php echo $guru->id_guru ?>"><?php echo $guru->nama_guru ?></option>
                              <?php } ?>
                            </select>
                          </div>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Amount<span style="color: red;">*</span></label>
                            <input type="text" id="jumlah_gaji" name="jumlah_gaji" 
                            class="form-control" placeholder="Amount">
                        </div>
                        <div class="item form-group">
                            <label class="form-label">Employee Payday<span style="color: red;">*</span></label>
                            <div class="col-12">
                            <input type="date" id="tanggal_gaji" name="tanggal_gaji" 
                            class="form-control text-capitalize" placeholder="Employee Payday">
                          </div>
                        </div>
                    </div>
          <a href="<?= base_url('/home/employee_salary')?>" type="submit" class="btn btn-primary">Cancel</a></button>
          <button type="submit" class="btn btn-success">Submit</button>
        </form>
    </div>
</div>
</div>
</div>