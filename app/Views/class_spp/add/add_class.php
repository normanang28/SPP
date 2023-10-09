<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="card">
        <div class="card-body">
            <div class="basic-form">
                <form class="form-horizontal form-label-left" novalidate  action="<?= base_url('home/aksi_add_class')?>" method="post">


                        <div class="item form-group">
                            <label class="form-label">Class Name<span style="color: red;">*</span></label>
                            <div class="col-12">
                            <select id="nama_kelas" class="form-control col-12" data-validate-length-range="6" data-validate-words="2" name="nama_kelas" required="required">
                              <option>Select Class</option>
                              <option value="SD I">SD I</option>
                              <option value="SD II">SD II</option>
                              <option value="SD III">SD III</option>
                              <option value="SD IV">SD IV</option>
                              <option value="SD V">SD V</option>
                              <option value="SD VI">SD VI</option>
                              <option value="SMP VII">SMP VII</option>
                              <option value="SMP VIII">SMP VIII</option>
                              <option value="SMP IX">SMP IX</option>
                              <option value="SMK X">SMK X</option>
                              <option value="SMK XI">SMK XI</option>
                              <option value="SMK XII">SMK XII</option>
                            </select>
                          </div>
                        </div>
                    </div>
          <a href="<?= base_url('/home/class')?>" type="submit" class="btn btn-primary">Cancel</a></button>
          <button type="submit" class="btn btn-success">Submit</button>
        </form>
    </div>
</div>
</div>
</div>