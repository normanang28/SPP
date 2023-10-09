<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="card">
        <div class="card-body">
            <div class="basic-form">
                <form class="form-horizontal form-label-left" novalidate  action="<?= base_url('home/aksi_edit_packet')?>" method="post">
                  <input type="hidden" name="id" value="<?= $duar->id_paket ?>">

                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Packet Name<span style="color: red;">*</span></label>
                            <input type="text" id="nama_paket" name="nama_paket" 
                            class="form-control text-uppercase" placeholder="Packet Name" value="<?= $duar->nama_paket?>">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Price<span style="color: red;">*</span></label>
                            <input type="text" id="harga_paket" name="harga_paket" 
                            class="form-control text-capitalize" placeholder="Price" value="<?= $duar->harga_paket?>">
                        </div>
                    </div>
          <a href="<?= base_url('/home/packet')?>" type="submit" class="btn btn-primary">Cancel</a></button>
          <button type="submit" class="btn btn-success">Update</button>
        </form>
    </div>
</div>
</div>
</div>
