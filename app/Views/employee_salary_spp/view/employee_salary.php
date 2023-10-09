<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <!-- Nav tabs -->
                <div class="default-tab">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#belum"><i class="la la-pied-piper-alt me-2"></i> Gaji Karyawan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#lunas"><i class="la la-cc-visa me-2"></i> Terbayar</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="belum" role="tabpanel">
                            <div class="pt-4">
                                <div class="header-left">
                                    <form action="<?= base_url('home/employee_salary_search') ?>" method="post">
                                        <div class="input-group search-area">
                                            <input type="text" class="form-control text-capitalize" name="search_employee_salary" placeholder="Search here...">
                                            <span class="input-group-text"><a href="javascript:void(0)"><i class="flaticon-381-search-2"></i></a></span>
                                        </div>
                                    </form>         
                                </div>

                                <style>
                                  /* Gaya untuk kontainer form */
                                  .form-container {
                                    width: 300px; /* Lebar form */
                                    margin: 0 auto; /* Pusatkan form horizontal */
                                  }

                                  /* Gaya untuk elemen yang ada di dalam form */
                                  .right-aligned {
                                    text-align: right;
                                  }
                                </style>

                                <form action="<?= base_url('/home/status_employee_salary/')?>" method="post">

                            <div class="right-aligned">
                    <?php if(!empty($search)) {?>
                            <a href="<?= base_url('/home/employee_salary/')?>"><button class="btn btn-info"><i class="fa fa-arrow-left"></i> Back</button></a>
                    <?php }?>
                    <?php  if(session()->get('level')== 2) { ?>
                            <button type="submit" class="btn btn-info"><i class="fas fa-check"></i></button>
                            <a href="<?= base_url('/home/add_employee_salary/')?>"><button type="button" class="btn btn-success"><i class="fa fa-plus"></i> Add</button></a>
                    <?php }else{} ?>
                        </div>
                                <h1></h1>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped verticle-middle table-responsive-sm">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th class="text-center">No.</th>
                                                <th class="text-center">Employee Name</th>
                                                <th class="text-center">Description</th>
                                                <th class="text-center">Amount</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                    <tbody>
                                  <?php
                                  $no=1;
                                  //if ($denda){

                              // }
                                  foreach ($duar as $gas){
                                    if ($gas->status_gaji != "Lunas") {
                                    ?>
                            <tr>
                            <td class="text-center">
                                <input type="checkbox" class="checkbox__input" value="<?= $gas->id_gaji ?>" name="employee_salary[]" id="employee_salary<?= $gas->id_gaji ?>"/>

<!-- <input type="checkbox" class="checkbox__input" value="<?= $gas->id_spp ?>" name="invoice[]" id="disabled_0" onclick="disabledButton(0)"/> -->
                            </td>
                              <th class="text-center"><?php echo $no++ ?></th>
                              <td class="text-capitalize text-center"><?php echo $gas->nama_guru?></td>
                              <td class="text-capitalize text-center"><?php echo $gas->deskripsi_gaji?> <?php echo $gas->tanggal_gaji?></td>
                              <td class="text-capitalize text-center">Rp. <?php echo $gas->jumlah_gaji?></td>
                              <td class="text-capitalize text-center"><?php echo $gas->status_gaji?></td>
                              <td>
<!-- <?php if(session()->get('level')== 2 && $gas->status != "Lunas") { ?>
                                <a href="<?= base_url('/home/status_employee_salary/'.$gas->id_gaji)?>"><button class="btn btn-info"><i class="fa fa-check"></i> </button></a>
<?php }else{} ?> -->
<div class="button-container">
                                <a href="<?= base_url('/home/edit_employee_salary/'.$gas->id_gaji)?>"><button  type="button" class="btn btn-warning"><i class="fa fa-edit"></i> </button></a>
                                <a href="<?= base_url('/home/delete_employee_salary/'.$gas->id_gaji)?>"><button type="button"  class="btn btn-danger"><i class="fa fa-trash"></i> </button></a>
</div>
<style>
    .button-container {
    display: flex;
    justify-content: center; /* Mengatur tombol-tombol di tengah secara horizontal */
    align-items: center;
}
    .button-container a {
    margin: 0 5px; /* Tambahkan ruang di kiri dan kanan tombol */
}
</style>
                              </td>
                                </tr>
                              <?php }
                            }
                              ?>
                                </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </form>
                        <div class="tab-pane fade" id="lunas">
                            <div class="pt-4">
                                <h1></h1>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped verticle-middle table-responsive-sm">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No.</th>
                                                <th class="text-center">Employee Name</th>
                                                <th class="text-center">Description</th>
                                                <th class="text-center">Amount</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                    <tbody>
                                  <?php
                                  $no=1;
                                  foreach ($duar as $gas){
                                    if ($gas->status_gaji == "Lunas") { 
                                    ?>
                            <tr>
                              <th class="text-center"><?php echo $no++ ?></th>
                              <td class="text-capitalize text-center"><?php echo $gas->nama_guru?></td>
                              <td class="text-capitalize text-center"><?php echo $gas->deskripsi_gaji?> <?php echo $gas->tanggal_gaji?></td>
                              <td class="text-capitalize text-center">Rp. <?php echo $gas->jumlah_gaji?></td>
                              <td class="text-capitalize text-center"><?php echo $gas->status_gaji?></td>
                              <td>
<div class="col-12 center-column">
                                <a href="<?= base_url('/home/delete_employee_salary/'.$gas->id_gaji)?>"><button class="btn btn-danger"><i class="fa fa-trash"></i> </button></a>
</div>
<style>
    .center-column {
display: flex;
flex-direction: column;
align-items: center;
}
</style>
                              </td>
                            </tr>
                              <?php }
                          }
                              ?>
                                </tbody>
                                    </table>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
