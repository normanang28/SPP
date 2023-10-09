<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="card">
        <div class="card-body">
            <div class="basic-form">
              <form class="form-horizontal form-label-left" novalidate  action="<?= base_url('home/aksi_edit_teacher')?>" method="post">
                 <input type="hidden" name="id" value="<?= $duar->id_user ?>">

                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label">NIK<span style="color: red;">*</span></label>
                            <input type="text" id="nik" name="nik" 
                            class="form-control" placeholder="NIK" value="<?= $duar->nik?>">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Teacher Name<span style="color: red;">*</span></label>
                            <input type="text" id="nama_guru" name="nama_guru" 
                            class="form-control text-capitalize" placeholder="Teacher Name" value="<?= $duar->nama_guru?>">
                        </div>
                        <div class="mb-3 col-md-6">
                        <label class="control-label col-md-12 col-sm-12 col-xs-12">E-mail<span style="color: red;">*</span></label>
                          <div class="input-group">
                            <input type="text" id="email_guru" name="email_guru" placeholder="E-mail" required="required" class="form-control" value="<?= $duar->email_guru?>">
                            <span class="input-group-text">@gmail.com</span>
                          </div> 
                        </div> 
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Gender<span style="color: red;">*</span></label>
                            <div class="col-12">
                            <select id="jk_guru" class="form-control col-12" data-validate-length-range="6" data-validate-words="2" name="jk_guru" required="required">
                              <option value="<?= $duar->jk_guru?>"><?= $duar->jk_guru; ?></option>
                              <option value="Male">Male</option>
                              <option value="Female">Female</option>
                            </select>
                          </div>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Place And Date Of Birth<span style="color: red;">*</span></label>
                            <input type="text" id="ttl_guru" name="ttl_guru" 
                            class="form-control text-capitalize" placeholder="Place And Date Of Birth" value="<?= $duar->ttl_guru?>">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Username<span style="color: red;">*</span></label>
                            <input type="text" id="username" name="username" 
                            class="form-control text-capitalize" placeholder="Username" value="<?= $duar->username?>">
                        </div>
                        <div class="item form-group">
                            <label class="form-label">Level<span style="color: red;">*</span></label>
                            <div class="col-12">
                            <select id="level" class="form-control col-12" data-validate-length-range="6" data-validate-words="2" name="level" required="required">
                              <option value="<?= $duar->level?>"><?= $duar->level; ?></option>
                              <option value="1">Super Admin</option>
                              <option value="2">Admin</option>
                              <option value="4">Teacher</option>
                            </select>
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
