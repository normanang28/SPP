<?php if(session()->get('level')== 2) { ?>
<div align="center">

<!-- <img align="center" src="data:image/jpg;base64,<?= $foto?>" width="82%" height="18%" > -->
<div>
  <br>
  <br>
</div>

 <table id="datatable-buttons" align="center" border="1" align="center" width="100%" class="table table-bordered table-striped verticle-middle table-responsive-sm">
  <thead>
    <tr>
      <th class="text-center">No.</th>
      <th class="text-center">Employee Name</th>
      <th class="text-center">Description</th>
      <th class="text-center">Amount</th>
      <th class="text-center">Status</th>
      <!-- <th class="text-center">Total Employee Salary</th> -->
    </tr>
  </thead>

  <tbody>
    <?php
    $no=1;
    $data = []; 
    $total = 0;

    foreach ($duar as $gas){
    if ($gas->status_gaji == "Lunas") {
    $total += $gas->jumlah_gaji;
      ?>
      <tr>
          <th class="text-center"><?php echo $no++ ?></th>
          <td class="text-capitalize text-center"><?php echo $gas->nama_guru?></td>
          <td class="text-capitalize text-center"><?php echo $gas->deskripsi_gaji?> <?php echo $gas->tanggal_gaji?></td>
          <td class="text-capitalize text-center"><?php echo $gas->jumlah_gaji?></td>
          <td class="text-capitalize text-center"><?php echo $gas->status_gaji?></td>
          <!-- <?php echo "<td>" . $total . "</td>"; ?> -->
      </tr>
    <?php }}?>
  </tbody>
<tr style="font-weight: bold">
    <td colspan="2"></td>
    <td>Total:</td>
   <?php echo "<td>" . $total . "</td>"; ?>
   <td></td>
  </tr>
</table>
</div>

<script>
  window.print();
</script>
<?php }else{} ?>


<?php if(session()->get('level')== 4) { ?>
  <div align="center">

<!-- <img align="center" src="data:image/jpg;base64,<?= $foto?>" width="82%" height="18%" > -->
<div>
  <br>
  <br>
</div>

 <table id="datatable-buttons" align="center" border="1" align="center" width="100%" class="table table-bordered table-striped verticle-middle table-responsive-sm">
  <thead>
    <tr>
      <th class="text-center">No.</th>
      <th class="text-center">Employee Name</th>
      <th class="text-center">Description</th>
      <th class="text-center">Amount</th>
      <th class="text-center">Status</th>
      <!-- <th class="text-center">Total Employee Salary</th> -->
    </tr>
  </thead>

  <tbody>
    <?php
    $no = 1;
    $data = []; 
    $total = 0;
    $nama_guru = session()->get('nama_guru'); // Nama guru yang sedang login

    foreach ($duar as $gas){
    if ($gas->status_gaji == "Lunas" && $gas->nama_guru == $nama_guru) {
    $total += $gas->jumlah_gaji;
      ?>
      <tr>
          <th class="text-center"><?php echo $no++ ?></th>
          <td class="text-capitalize text-center"><?php echo $gas->nama_guru?></td>
          <td class="text-capitalize text-center"><?php echo $gas->deskripsi_gaji?> <?php echo $gas->tanggal_gaji?></td>
          <td class="text-capitalize text-center"><?php echo $gas->jumlah_gaji?></td>
          <td class="text-capitalize text-center"><?php echo $gas->status_gaji?></td>
          <!-- <?php echo "<td>" . $total . "</td>"; ?> -->
      </tr>
    <?php }}?>
  </tbody>
<tr style="font-weight: bold">
    <td colspan="2"></td>
    <td>Total:</td>
   <?php echo "<td>" . $total . "</td>"; ?>
   <td></td>
  </tr>
</table>
</div>

<script>
  window.print();
</script>
<?php }else{} ?>

