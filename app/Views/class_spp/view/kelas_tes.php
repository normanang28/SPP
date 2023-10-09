<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <!-- Nav tabs -->
                <div class="default-tab">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#class"><i class="la la-mortar-board me-2"></i> Class</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#rombel" href="/home/rombel"><i class="la la-book me-2"></i> Rombel</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="class" role="tabpanel">
                            <div class="pt-4">
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
                                <a href="<?= base_url('/home/add_class/')?>"><button class="btn btn-success"><i class="fa fa-plus"></i> Add</button></a>
                            </div>
                                <h1></h1>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped verticle-middle table-responsive-sm">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Class Name</th>
                                                <th>Rombel Name</th>
                                                <th>Major</th>
                                                <th>Total Students</th>
                                                <th>Classroom Teacher</th>
                                                <th>Maker</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                    <tbody>
                                  <?php
                                  $no=1;
                                  foreach ($duar as $gas){
                                    ?>
                            <tr>
                              <th><?php echo $no++ ?></th>
                              <td class="text-uppercase"><?php echo $gas->nama_kelas?></td>
                              <td class="text-uppercase"><?php echo $gas->nama_rombel?></td>
                              <td class="text-capitalize"><?php echo $gas->jurusan?></td>
                              <td class="text-capitalize"><?php echo $gas->total_siswa?></td>
                              <td class="text-capitalize"><?php echo $gas->nama?></td>
                              <td class="text-capitalize"><?php echo $gas->username?></td>      
                              <td>
                                <a href="<?= base_url('/home/edit_class/'.$gas->id_kelas)?>"><button class="btn btn-warning"><i class="fa fa-edit"></i> </button></a>
                                <a href="<?= base_url('/home/delete_class/'.$gas->id_kelas)?>"><button class="btn btn-danger"><i class="fa fa-trash"></i> </button></a>
                              </td>
                                </tr>
                              <?php }?>
                                </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="rombel">
                            <div class="pt-4">
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
                                <a href="<?= base_url('/home/add_rombel/')?>"><button class="btn btn-success"><i class="fa fa-plus"></i> Add</button></a>
                            </div>
                                <h1></h1>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped verticle-middle table-responsive-sm">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Rombel Name</th>
                                                <th>Maker</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                  <?php
                                  $no=1;
                                  foreach ($duar as $gas){
                                    ?>
                            <tr>
                              <th><?php echo $no++ ?></th>
                              <td class="text-uppercase"><?php echo $gas->nama_rombel?></td>
                              <td class="text-capitalize"><?php echo $gas->username?></td>      
                              <td>
                                <a href="<?= base_url('/home/edit_rombel/'.$gas->id_kelas)?>"><button class="btn btn-warning"><i class="fa fa-edit"></i> </button></a>
                                <a href="<?= base_url('/home/delete_rombel/'.$gas->id_kelas)?>"><button class="btn btn-danger"><i class="fa fa-trash"></i> </button></a>
                              </td>
                                </tr>
                              <?php }?>
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