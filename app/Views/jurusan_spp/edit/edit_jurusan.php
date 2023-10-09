<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="card">
        <div class="card-body">
            <div class="basic-form">
                <form class="form-horizontal form-label-left" novalidate  action="<?= base_url('home/aksi_edit_major')?>" method="post">
                   <input type="hidden" name="id" value="<?= $duar->id_jurusan ?>">

                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Major Name<span style="color: red;">*</span></label>
                            <input type="text" id="nama_jurusan" name="nama_jurusan" 
                            class="form-control text-uppercase" placeholder="Major Name" value="<?= $duar->nama_jurusan?>">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Full Name<span style="color: red;">*</span></label>
                            <input type="text" id="jurusan_lengkap" name="jurusan_lengkap" 
                            class="form-control text-capitalize" placeholder="Full Name" value="<?= $duar->jurusan_lengkap?>">
                        </div>
                    </div>
          <a href="<?= base_url('/home/major')?>" type="submit" class="btn btn-primary">Cancel</a></button>
          <button type="submit" class="btn btn-success">Update</button>
        </form>
    </div>
</div>
</div>
</div>