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
      <th class="text-center">Invoice No.</th>
      <th class="text-center">Student Name</th>
      <th class="text-center">Description</th>
      <th class="text-center">Amount</th>
      <th class="text-center">Status</th>
<!--       <th class="text-center">Total SPP Payment</th>
 -->    </tr>
  </thead>

  <tbody>
    <?php
$no = 1;
$data = []; 
$total = 0;

foreach ($duar as $gas) {
    if ($gas->status == "Lunas") {
        if (is_numeric($gas->harga_paket)) {
            $total += $gas->harga_paket; 
        }

        ?>

        <tr>
            <th class="text-center"><?php echo $no++ ?></th>
            <td class="text-capitalize text-center"><?php echo $gas->id_siswa_spp?>/<?php echo $gas->maker_spp?><?php echo $gas->id_spp ?></td>
            <td class="text-capitalize text-center"><?php echo $gas->nama_siswa?></td>
            <td class="text-capitalize text-center"><?php echo $gas->nama_paket?>/<?php echo $gas->tgl_spp?></td>
            <td class="text-capitalize text-center"><?php echo $gas->harga_paket?></td>
            <td class="text-capitalize text-center"><?php echo $gas->status?></td>
        </tr>
    <?php }}?>
</tbody>
<tr style="font-weight: bold">
    <td colspan="3"></td>
    <td>Total:</td>
   <?php echo "<td>" . $total . "</td>"; ?>
   <td></td>
  </tr>
</table>
</div>
<script>
  window.print();
</script>