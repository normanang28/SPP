<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="card">
        <div class="card-body">
            <div class="basic-form">
                <form class="form-horizontal form-label-left" enctype="multipart/form-data" novalidate  action="<?= base_url('home/aksi_change_profile_students')?>" method="post">


                    <div class="row">
                        <div class="input-group">
                            <label class="control-label col-12">Replace New Profile<span style="color: red;">*</span></label>   
                            <div class="col-12 form-file">
                            <input type="file" name="foto" class="form-file-input form-control col-12">
                          </div>
                            <span class="input-group-text">Upload</span>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">NIS<span style="color: red;">*</span></label>
                            <input type="text" id="nis" name="nis" 
                            class="form-control text-capitalize" placeholder="NIS" value="<?= $users->nis?>">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Full Name<span style="color: red;">*</span></label>
                            <input type="text" id="nama_siswa" name="nama_siswa" 
                            class="form-control text-capitalize" placeholder="Full Name" value="<?= $users->nama_siswa?>">
                        </div>
                        <div class="mb-3 col-md-6">
                        <label class="control-label col-md-12 col-sm-12 col-xs-12">E-mail<span style="color: red;">*</span></label>
                          <div class="input-group">
                            <input type="text" id="email_siswa" name="email_siswa" placeholder="E-mail" required="required" class="form-control" value="<?= $users->email_siswa?>">
                            <span class="input-group-text">@gmail.com</span>
                          </div> 
                        </div>  
                        <div class="mb-3 col-md-6">
                          <label class="control-label col-12" >Gender<span style="color: red;">*</span>
                          </label>
                          <div class="col-12">
                            <select id="jk_siswa" class="form-control col-12" data-validate-length-range="6" data-validate-words="2" name="jk_siswa" required="required">
                              <option  value="<?= $users->jk_siswa?>"><?= $users->jk_siswa; ?></option>
                              <!-- <option>Select Gender</option> -->
                              <option value="Male">Male</option>
                              <option value="Female">Female</option>
                            </select>
                          </div>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Place And Date Of Birth<span style="color: red;">*</span></label>
                            <input type="text" id="ttl_siswa" name="ttl_siswa" 
                            class="form-control text-capitalize" placeholder="Place And Date Of Birth" value="<?= $users->ttl_siswa?>">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Username<span style="color: red;">*</span></label>
                            <input type="text" id="username" name="username" 
                            class="form-control text-capitalize" placeholder="Username" value="<?= $use->username?>">
                        </div>
                    </div>
          <a onclick="history.back()" type="submit" class="btn btn-primary">Cancel</a></button>
          <button type="submit" class="btn btn-success">Update</button>
        </form>
    </div>
</div>
</div>
</div>