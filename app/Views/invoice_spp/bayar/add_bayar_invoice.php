<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
                <h4 class="text">Invoice Pembayaran</h4>
            </div>
            <div class="card-body">
                <label class="control-label col-12">Silakan memilih metode pembayaran dibawah ini, Jika anda ingin melakukan pembayaran menggunakan BANK BCA anda dapat memilih metode pembayaran virtual account (VA).<span class="required"></span></label>
                <label class="control-label col-12">Dengan Nomor VA: 1434721161066<span class="required"></span></label>
                <a href="https://www.bca.co.id/id/informasi/Edukatips/2022/07/07/09/19/cara-bayar-menggunakan-bca-virtual-account" target="_blank" class="link-underline">Cara Bayar menggunakan BCA Virtual Account</a>
                <style>
                    .link-underline {
                text-decoration: underline;
                color: blue; /* atau warna yang Anda inginkan */
                }
                    .text {
                color: blue; /* atau warna yang Anda inginkan */
                }
                </style>
            </div>
        <div class="card-body">
            <div class="table-responsive">
                <form id="paymentForm" class="form-horizontal form-label-left" novalidate action="<?= base_url('home/aksi_add_bayar_invoice') ?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $gas->id_spp ?>">

                    <div class="input-group">
                        <label class="control-label col-12">Replace New Profile<span style="color: red;">*</span></label>  
                        <div class="col-12 form-file">
                        <input type="file" name="foto_bukti" class="form-file-input form-control col-12">
                      </div>
                        <span class="input-group-text">Upload</span>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-12">Payment Method <span style="color: red;">*</span></label>
                        <div class="col-12">
                            <select id="metode_pembayaran" class="form-control col-12" data-validate-length-range="6" data-validate-words="2" name="metode_pembayaran" required="required">
                                <option value=""  disabled selected>Select Payment Method</option>
                                <option value="Cash">Cash</option>
                                <option value="Virtual Account (VA)">Virtual Account (VA)</option>
                            </select>
                        </div>
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
        <script>
        document.addEventListener("DOMContentLoaded", function() {
            const form = document.getElementById("paymentForm");
            const sendButton = document.getElementById("send");

            // Fungsi untuk memeriksa apakah semua input telah diisi
            function checkInputs() {
                const inputs = form.querySelectorAll("input, select");
                let allInputsFilled = true;

                inputs.forEach(input => {
                    if (input.required && !input.value.trim()) {
                        allInputsFilled = false;
                    }
                });

                return allInputsFilled;
            }

            // Aktifkan tombol jika semua input telah diisi
            form.addEventListener("input", function() {
                if (checkInputs()) {
                    sendButton.removeAttribute("disabled");
                } else {
                    sendButton.setAttribute("disabled", "true");
                }
            });
        });
        </script>

                    <div class="right-aligned">
                            <a href="<?= base_url('/home/invoice') ?>" class="btn btn-primary">Cancel</a>
                            <button id="send" type="submit" class="btn btn-success" disabled>Bayar</button>
                        </div>
                </form>

                <div></div>
                <table class="table table-bordered table-striped verticle-middle table-responsive-sm">
                    <thead>
                        <tr>
                            <?php if(session()->get('level')== 3) { ?>
                            <th class="text-center">Invoice No.</th>
                            <th class="text-center">Student Name</th>
                            <th class="text-center">Description</th>
                            <th class="text-center">Price SPP</th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php if(session()->get('level')== 3) { ?>
                            <td class="text-capitalize text-center"><?= $gas->id_siswa_spp ?>/<?= $gas->maker_spp ?><?= $gas->id_spp ?></td>
                            <td class="text-capitalize text-center"><?= $gas->nama_siswa ?></td>
                            <td class="text-capitalize text-center"><?= $gas->nama_paket ?>/<?= $gas->tgl_spp ?></td>
                            <td class="text-capitalize text-center"><?= $gas->harga_paket ?></td>
                            <?php } ?>
                        </tr>
                        <tr style="font-weight: bold">
                          <td colspan="2"></td>
                          <td>Total:</td>
                            <td class="text-capitalize text-center">Rp. <?= $gas->harga_paket ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
