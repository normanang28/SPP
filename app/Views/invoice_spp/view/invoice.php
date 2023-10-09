<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <!-- Nav tabs -->
                <div class="default-tab">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#belum"><i class="la la-mortar-board me-2"></i> Belum Bayar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#proses"><i class="la la-hourglass-half me-2"></i> Proses</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#lunas"><i class="la la-book me-2"></i> Lunas</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="belum" role="tabpanel">
                            <div class="pt-4">
                                <?php  if(session()->get('level')== 3) { ?>
                                    <div class="alert alert-info" role="alert">Setiap proses pembayaran di sistem ini Anda wajib memberikan bukti telah membayar di form pembayaran, pada tombol hijau</div>
                                <?php }else{} ?>
                                <?php  if(session()->get('level')== 2) { ?>
                                    <div class="header-left">
                                        <form action="<?= base_url('home/invoice_search') ?>" method="post">
                                            <div class="input-group search-area">
                                                <input type="text" class="form-control text-capitalize" name="search_invoice" placeholder="Search here...">
                                                <span class="input-group-text"><a href="javascript:void(0)"><i class="flaticon-381-search-2"></i></a></span>
                                            </div>
                                        </form>         
                                    </div>
                                <?php }else{} ?>

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
                            <!-- <form action="<?= base_url('/home/status_invoice/')?>" method="post"> -->
                                <div class="right-aligned">
                                    <?php if(!empty($search)) {?>
                                        <a href="<?= base_url('/home/invoice/')?>"><button class="btn btn-info"><i class="fa fa-arrow-left"></i> Back</button></a>
                                    <?php }?>
                                    <?php  if(session()->get('level')== 2) { ?>                             
                                        <!-- <button type="submit" class="btn btn-info"><i class="fas fa-check"></i></button> -->
                                        <a href="<?= base_url('/home/add_invoice/')?>"><button type="button" class="btn btn-success"><i class="fa fa-plus"></i> Add SPP</button></a>
                                        <a href="<?= base_url('/home/add_fine/')?>"><button type="button" class="btn btn-warning"><i class="fa fa-plus"></i> Add Denda</button></a>
                                    <?php }else{} ?>
                                    <?php  if(session()->get('level')== 3) { ?>
                                        <!-- <button type="submit" class="btn btn-success"><i class="fas fa-dollar-sign"></i> Bayar</button> -->

                            <!-- <input type="hidden" name="invoice_id" value="<?= $gas->id_spp ?>">
                            <div class="text-right">
                                <a href="<?= base_url('/home/add_bayar_invoice/'.$gas->id_spp)?>"><button type="button" class="btn btn-success"><i class="fas fa-dollar-sign"></i> Bayar</button></a>
                            </div> -->

                            <!-- <a href="<?= base_url('/home/add_bayar_invoice/')?>"><button type="button" class="btn btn-success"><i class="fas fa-dollar-sign"></i> Bayar</button></a> -->
                        <?php }else{} ?>
                    </div>
                    <h1></h1>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped verticle-middle table-responsive-sm">
                            <thead>
                                <tr>
                                    <?php  if(session()->get('level')== 2) { ?>
                                        <!-- <th class="text-center">#</th> -->
                                    <?php }else{} ?>
                                    <th class="text-center">Invoice No.</th>
                                    <th class="text-center">Student Name</th>
                                    <th class="text-center">Description</th>
                                    <th class="text-center">Due Date</th>
                                    <th class="text-center">Amount</th>
                                    <!-- <th class="text-center">Payment Proof</th> -->
                                    <th class="text-center">Status</th>
                                    <?php  if(session()->get('level')== 2) { ?>
                                        <th class="text-center">Payment Method</th>
                                    <?php }else{} ?>
                                    <?php  if(session()->get('level')== 2 || session()->get('level')== 3) { ?>
                                        <th class="text-center">Action</th>
                                    <?php }else{} ?>
                                </tr>
                            </thead>
                            <tbody>
                              <?php
                              $no=1;
                                  //if ($denda){

                              // }
                              foreach ($duar as $gas){
                                if ($gas->status != "Lunas" && $gas->status != "Proses") {
                                    ?>
                                    <tr>
<!-- <?php  if(session()->get('level')== 2) { ?>
                            <td class="text-center">
                                <input type="checkbox" class="checkbox__input" value="<?= $gas->id_spp ?>" name="invoice[]" id="invoice_<?= $gas->id_spp ?>"/>
                            </td>
                            <?php }else{} ?>    -->           
                            <!-- <td class="text-capitalize text-center"><a href="<?= base_url('/home/download/'.$gas->foto_bukti)?>" style="text-decoration: underline;"><?php echo $gas->id_siswa_spp?>/<?php echo $gas->maker_spp?><?php echo $gas->id_spp ?></a></td> -->
                              <!-- <td class="text-capitalize text-center">
<?php if (session()->get('level') == 2 && !empty($gas->foto_bukti)) { ?>
    <a href="<?= base_url('/home/download/' . $gas->foto_bukti) ?>" style="text-decoration: underline;">
        <?php echo $gas->id_siswa_spp ?>/<?= $gas->maker_spp ?><?= $gas->id_spp ?>
    </a>
<?php } else { ?>
    <?php echo $gas->id_siswa_spp ?>/<?= $gas->maker_spp ?><?= $gas->id_spp ?>
<?php } ?>
</td> -->

<td class="text-capitalize text-center"><?php echo $gas->id_siswa_spp?>/<?php echo $gas->maker_spp?><?php echo $gas->id_spp ?></td>
<td class="text-capitalize text-center"><?php echo $gas->nama_siswa?></td>
<td class="text-uppercase text-center"><?php echo $gas->nama_paket?>/<?php echo $gas->tgl_spp?></td>
<!-- <td class="text-capitalize text-center"><?php echo $gas->tgl_jatuh_tempo?></td> -->
<td class="text-capitalize text-center <?php echo ($gas->status != 'Lunas' && strtotime($gas->tgl_jatuh_tempo) < time()) ? 'text-danger' : ''; ?>"><?php echo $gas->tgl_jatuh_tempo; ?></td>
<td class="text-capitalize text-center">Rp. <?php echo $gas->harga_paket?></td>
<td class="text-capitalize text-center"><?php echo $gas->status?></td>
<?php  if(session()->get('level')== 2) { ?>
  <td class="text-capitalize text-center"><?php echo $gas->metode_pembayaran?></td>
<?php }else{} ?>
<?php  if(session()->get('level')== 2 || session()->get('level')== 3) { ?>
  <td>
<!-- <?php if(session()->get('level')== 2 && $gas->status != "Lunas") { ?>
                                <a href="<?= base_url('/home/status_invoice/'.$gas->id_spp)?>"><button class="btn btn-info"><i class="fa fa-check"></i> </button></a>
                                <?php }else{} ?> -->
                                <?php  if(session()->get('level')== 2) { ?>
                                    <div class="button-container">
                                        <!-- <a href="<?= base_url('/home/download/'.$gas->foto_bukti)?>"><button type="button" class="btn btn-info"><i class="fa fa-download"></i></button></a> -->
                                        <a href="<?= base_url('/home/add_bayar_invoice_a/'.$gas->id_spp)?>"><button type="button" class="btn btn-success"><i class="fa fa-credit-card"></i></button></a>
                                        <!-- <a href="<?= base_url('/home/edit_invoice/'.$gas->id_spp)?>"><button type="button" class="btn btn-warning"><i class="fa fa-edit"></i> </button></a> -->
                                        <!-- <a href="<?= base_url('/home/delete_invoice/'.$gas->id_spp)?>"><button type="button" class="btn btn-danger"><i class="fa fa-trash"></i> </button></a> -->
                                    </div>
                                <?php }else{} ?>
                                <?php  if(session()->get('level')== 3) { ?>
                                    <div class="col-12 center-column">
                                        <!-- <a href="<?= base_url('/home/add_bayar_invoice/'.$gas->id_spp)?>"><button type="button" class="btn btn-success"><i class="fa fa-credit-card"></i> </button></a> -->
                                        <a href="<?= base_url('/home/add_bayar_invoice/'.$gas->id_spp)?>">
                                            <button type="button" class="btn btn-success" <?= ($paymentYear < $currentYear || ($paymentYear == $currentYear && $paymentMonth <= $currentMonth)) ? '' : 'disabled' ?>>
                                                <i class="fa fa-credit-card"></i>
                                            </button>
                                        </a>
                                    </div>
                                <?php }else{} ?>
                            </td>
                        <?php }else{} ?>
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
<div class="tab-pane fade" id="proses" role="tabpanel">
    <div class="pt-4">
        <?php  if(session()->get('level')== 3) { ?>
            <div class="alert alert-info" role="alert">Transaksi pembayaran Anda sedang diproses, harap tunggu beberapa saat.</div>
        <?php }elseif(session()->get('level')== 2){ ?>
            <div class="alert alert-info" role="alert">Jika ada foto bukti pembayaran, akan muncul tulisan underline di bawah table "Invoice No".</div>
        <?php }else{} ?>

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
    <form action="<?= base_url('/home/status_invoice/')?>" method="post">
        <div class="right-aligned">
            <?php if(!empty($search)) {?>
                <a href="<?= base_url('/home/invoice/')?>"><button class="btn btn-info"><i class="fa fa-arrow-left"></i> Back</button></a>
            <?php }?>
            <?php  if(session()->get('level')== 2) { ?>                             
                <button type="submit" class="btn btn-info"><i class="fas fa-check"></i></button>
            <?php }else{} ?>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-striped verticle-middle table-responsive-sm">
                <thead>
                    <tr>
                        <?php  if(session()->get('level')== 2) { ?>
                            <th class="text-center">#</th>
                        <?php }else{} ?>
                        <th class="text-center">Invoice No.</th>
                        <th class="text-center">Student Name</th>
                        <th class="text-center">Description</th>
                        <th class="text-center">Amount</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Payment Method</th>
                    </tr>
                    <tbody>
                      <?php
                      $no=1;
                      foreach ($duar as $gas){
                        if ($gas->status == "Proses") { 
                            ?>
                            <tr>
                                <?php  if(session()->get('level')== 2) { ?>
                                    <td class="text-center">
                                        <input type="checkbox" class="checkbox__input" value="<?= $gas->id_spp ?>" name="invoice[]" id="invoice_<?= $gas->id_spp ?>"/>
                                    </td>
                                <?php }else{} ?> 
                                <!-- <td class="text-capitalize text-center"><?php echo $gas->id_siswa_spp?>/<?php echo $gas->maker_spp?><?php echo $gas->id_spp?></td> -->
                                <td class="text-capitalize text-center">
                                <?php if (session()->get('level') == 2 && !empty($gas->foto_bukti)) { ?>
                                    <a href="<?= base_url('/home/download/' . $gas->foto_bukti) ?>" style="text-decoration: underline;">
                                        <?php echo $gas->id_siswa_spp ?>/<?= $gas->maker_spp ?><?= $gas->id_spp ?>
                                    </a>
                                <?php } else { ?>
                                    <?php echo $gas->id_siswa_spp ?>/<?= $gas->maker_spp ?><?= $gas->id_spp ?>
                                <?php } ?>
                            </td>
                            <td class="text-capitalize text-center"><?php echo $gas->nama_siswa?></td>
                            <td class="text-uppercase text-center"><?php echo $gas->nama_paket?>/<?php echo $gas->tgl_spp?></td>
                            <td class="text-capitalize text-center">Rp. <?php echo $gas->harga_paket?></td>
                            <td class="text-capitalize text-center"><?php echo $gas->status?></td>
                            <td class="text-capitalize text-center"><?php echo $gas->metode_pembayaran?></td>
                        </tr>
                    <?php }
                }
                ?>
            </tbody>
        </thead>
    </table>
</div>
</div>
</div>
<div class="tab-pane fade" id="lunas">
    <div class="pt-4">
        <?php  if(session()->get('level')== 3) { ?>
            <div class="alert alert-warning" role="alert">Jika terjadi error pada sistem, Anda dapat chat admin kami di tombol hijau bertuliskan WhatsApp.</div>
        <?php }else{} ?>
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
    <div class="right-aligned">
        <?php  if(session()->get('level')== 3) { ?>
            <a href="https://api.whatsapp.com/send?phone=62895393080686&text=%20Hallo,%20nama%20saya%20<?= session()->get('nama_siswa')?>" target="_blank"><button class="btn btn-success"><i class="fa fa-users"></i> WhatsApp</button></a>
        <?php }else{} ?>
    </div>
    <h1></h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped verticle-middle table-responsive-sm">
            <thead>
                <tr>
                    <th class="text-center">No.</th>
                    <th class="text-center">Invoice No.</th>
                    <th class="text-center">Student Name</th>
                    <th class="text-center">Description</th>
                    <th class="text-center">Amount</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Payment Method</th>
                    <!-- <?php  if(session()->get('level')== 2) { ?>
                        <th class="text-center">Action</th>
                    <?php }else{} ?> -->
                </tr>
            </thead>
            <tbody>
              <?php
              $no=1;
              foreach ($duar as $gas){
                if ($gas->status == "Lunas") { 
                    ?>
                    <tr>
                      <th class="text-center"><?php echo $no++ ?></th>
                      <td class="text-capitalize text-center"><?php echo $gas->id_siswa_spp?>/<?php echo $gas->maker_spp?><?php echo $gas->id_spp?></td>
                      <td class="text-capitalize text-center"><?php echo $gas->nama_siswa?></td>
                      <td class="text-uppercase text-center"><?php echo $gas->nama_paket?>/<?php echo $gas->tgl_spp?></td>
                      <!-- <td class="text-capitalize text-center"><?php echo $gas->tgl_jatuh_tempo?></td> -->
                      <td class="text-capitalize text-center">Rp. <?php echo $gas->harga_paket?></td>
                      <td class="text-capitalize text-center"><?php echo $gas->status?></td>
                      <td class="text-capitalize text-center"><?php echo $gas->metode_pembayaran?></td>
                      <?php  if(session()->get('level')== 2) { ?>
                          <!-- <td>
                            <div class="col-12 center-column">
                                <a href="<?= base_url('/home/delete_invoice/'.$gas->id_spp)?>"><button class="btn btn-danger"><i class="fa fa-trash"></i> </button></a>
                            </div>
                            <style>
                                .center-column {
                                    display: flex;
                                    flex-direction: column;
                                    align-items: center;
                                }
                            </style>
                        </td> -->
                    </tr>
                <?php }else{} ?>
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
