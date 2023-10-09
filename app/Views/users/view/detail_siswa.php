<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
        <a onclick="history.back()" type="submit" class="btn btn-primary"><i class="fa fa-undo"></i> Back</a></button>
        <a href="<?= base_url('/home/reset_ps/'.$gas->id_user_siswa)?>"><button class="btn btn-info" title="Reset Password"><i class="fa fa-edit"></i> Reset Password</button></a>
        <h1></h1>
         <div class="table-responsive">
            <table class="table table-bordered table-striped verticle-middle table-responsive-sm">
        <thead>
            <tr>
<?php if(session()->get('level')== 1) { ?>
                      <th class="text-center">NIS</th>
                      <th class="text-center">Full Name</th>
                      <th class="text-center">Class</th>
                      <th class="text-center">E-mail</th>
                      <th class="text-center">Gender</th>
                      <th class="text-center">Place and Date of Birth</th>
                      <th class="text-center">Packet</th>
                      <th class="text-center">Action</th>
<?php }else{} ?>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
<?php if(session()->get('level')== 1) { ?>
                        <td class="text-center"><?php echo $gas->nis?></td>
                        <td class="text-capitalize text-center"><?php echo $gas->nama_siswa?></td>
                        <td class="text-uppercase text-center"><?php echo $gas->nama_kelas?> <?php echo $gas->nama_jurusan?> <?php echo $gas->nama_rombel?></td>
                        <td class="text-center"><?php echo $gas->email_siswa?></td>
                        <td class="text-capitalize text-center"><?php echo $gas->jk_siswa?></td>
                        <td class="text-capitalize text-center"><?php echo $gas->ttl_siswa?></td>
                        <td class="text-capitalize text-center"><?php echo $gas->nama_paket?> - <?php echo $gas->harga_paket?></td>
                        <td>
<div class="button-container">
                          <a href="<?= base_url('/home/edit_students/'.$gas->id_user_siswa)?>"><button class="btn btn-warning"><i class="fa fa-edit"></i> </button></a>
                          <a href="<?= base_url('/home/delete_students/'.$gas->id_user_siswa)?>"><button class="btn btn-danger"><i class="fa fa-trash"></i> </button></a>
</div>
<style>
    .button-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
}
    .btn {
    margin-right: 10px; /* Atur margin kanan antara tombol */
}
</style>
                        </td>
<?php }else{} ?>
                      </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>