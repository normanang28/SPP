<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="card">
        <div class="card-body">
            <div class="basic-form">
                <form class="form-horizontal form-label-left" novalidate  action="<?= base_url('home/aksi_change_website_settings')?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?= $use->id_settings ?>">

                    <div class="row">
                        <div class="input-group mb-3">
                            <label class="control-label col-12">Replace New Logo<span style="color: red;">*</span></label> 
                            <div class="col-12 form-file">
                            <input type="file" name="foto" class="form-file-input form-control col-12">
                            </div>
                            <span class="input-group-text">Upload</span>
                        </div>

                           <!--  <?php if (!empty($use->foto)) {?>
                                <br>
            <img  src="<?= base_url('/assets/images/settings_web/'.$use->foto) ?>" alt="">
                            <?php } ?> -->

                           
                        <div class="input-group mb-3">
                            <label class="control-label col-12">Replace New Text<span style="color: red;">*</span></label> 
                            <div class="col-12 form-file">
                            <input type="file" name="text" class="form-file-input form-control col-12">
                            </div>
                            <span class="input-group-text">Upload</span>
                        </div>
                         <!-- <?php if (!empty($use->text)) {?>
                                <br>
            <img src="<?= base_url('/assets/images/settings_web/'.$use->text) ?>" alt="">

                            <?php } ?> -->

                         <div class="input-group mb-3">
                            <label class="control-label col-12">Replace New Image Login<span style="color: red;">*</span></label> 
                            <div class="col-12 form-file">
                            <input type="file" name="login" class="form-file-input form-control col-12">
                            </div>
                            <span class="input-group-text">Upload</span>
                        </div>
                         <!-- <?php if (!empty($use->login)) {?>
                                <br>
            <img src="<?= base_url('/assets/images/settings_web/'.$use->login) ?>" alt="">

                            <?php } ?> -->

                        <div class="item form-group">
                            <label class="form-label">Change Website Name<span style="color: red;">*</span></label>
                            <input type="text" id="nama_website" name="nama_website" 
                            class="form-control" placeholder="Change Website Name" value="<?= $use->nama_website?>">
                        </div>
                    </div>
          <a href="<?= base_url('/home/dashboard')?>" type="submit" class="btn btn-primary">Cancel</a></button>
          <button type="submit" class="btn btn-success">Submit</button>
        </form>
    </div>
</div>
</div>
</div>