<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
<?php if(session()->get('level')== 1) { ?>
            <a href="<?= base_url('/home/add_class/')?>"><button class="btn btn-success"><i class="fa fa-plus"></i> Add</button></a>
<?php }else{} ?>
         <div class="table-responsive">
            <table class="table table-bordered table-striped verticle-middle table-responsive-sm">
        <thead>
            <tr>
<?php if(session()->get('level')== 1) { ?>
        <th class="text-center">No</th>
        <th class="text-center">Class Name</th>
        <th class="text-center">Maker</th>
        <th class="text-center">Action</th>
<?php }else{} ?>
                </tr>
            </thead>
            <tbody>
            <?php
            $no=1;
            foreach ($duar as $gas){
              ?>
            <tr>
<?php if(session()->get('level')== 1) { ?>
                      <th class="text-center"><?php echo $no++ ?></th>
                      <td class="text-uppercase text-center"><?php echo $gas->nama_kelas?></td>
                      <td class="text-capitalize text-center"><?php echo $gas->username?></td>      
                      <td>
<div class="button-container">
                        <a href="<?= base_url('/home/edit_class/'.$gas->id_kelas)?>"><button class="btn btn-warning"><i class="fa fa-edit"></i> </button></a>
                        <a href="<?= base_url('/home/delete_class/'.$gas->id_kelas)?>"><button class="btn btn-danger"><i class="fa fa-trash"></i> </button></a>
</div>
                      </td>
                        <?php }else{} ?>
                        </tr>
                    <?php }?>
                    </tbody>
                </table>
            </div>
            <div class="pagination">
                <div id="pageNumbers" class="page-numbers"></div>
            </div>
<style>
     .pagination {
        display: flex;
        justify-content: flex-end; /* Mengatur angka ke kanan */
        align-items: center; /* Memusatkan elemen vertikal */
    }

    .page-numbers button {
        margin-left: 5px; /* Jarak antara tombol nomor halaman */
        font-size: 14px; /* Ukuran teks tombol nomor halaman */
        padding: 5px 10px; /* Padding tombol nomor halaman */
    }

    .button-container {
    display: flex;
    justify-content: center; /* Mengatur tombol-tombol di tengah secara horizontal */
    align-items: center;
}

    .button-container a {
    margin: 0 5px; /* Tambahkan ruang di kiri dan kanan tombol */
}
</style>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const tableBody = document.querySelector('.table tbody');
    const pageNumbers = document.getElementById('pageNumbers');

    // Data dan variabel kontrol
    const data = <?= json_encode($duar) ?>; // Menggunakan data yang Anda ambil dari controller
    const itemsPerPage = 10;
    let currentPage = 1;

    // Fungsi untuk menampilkan data pada halaman tertentu
    // ...
function displayDataOnPage(page) {
    tableBody.innerHTML = ''; // Kosongkan tabel

    const startIndex = (page - 1) * itemsPerPage;
    const endIndex = startIndex + itemsPerPage;

    for (let i = startIndex; i < endIndex && i < data.length; i++) {
        const gas = data[i];
        // Buat baris tabel sesuai dengan data yang diterima dari controller
        // Anda dapat menyesuaikan ini sesuai dengan tampilan Anda
        const row = `
        <tr>
            <th class="text-center">${i + 1}</th>
            <td class="text-uppercase text-center text-dark">${gas.nama_kelas}</td>
            <td class="text-capitalize text-center text-dark">${gas.username}</td>
            <td>
            <div class="button-container">
                        <a href="<?= base_url('/home/edit_class/')?>/${gas.id_kelas}"><button class="btn btn-warning"><i class="fa fa-edit"></i> </button></a>
                        <a href="<?= base_url('/home/delete_class/')?>/${gas.id_kelas}"><button class="btn btn-danger"><i class="fa fa-trash"></i> </button></a>
            </td>
        </tr>
        `;
        tableBody.innerHTML += row;
    }
}
// ...


    // Fungsi untuk mengatur nomor halaman
    function updatePageNumbers() {
        const totalPages = Math.ceil(data.length / itemsPerPage);
        pageNumbers.innerHTML = '';

        for (let i = 1; i <= totalPages; i++) {
            const pageNumber = document.createElement('button');
            pageNumber.textContent = i;

            pageNumber.addEventListener('click', function () {
                currentPage = i;
                displayDataOnPage(currentPage);
                updatePageNumbers();
            });

            // Tambahkan kelas 'btn-primary' jika tombol aktif
            if (i === currentPage) {
                pageNumber.classList.add('btn', 'btn-primary');
            } else {
                pageNumber.classList.add('btn', 'btn-light'); // Warna putih cream
            }

            pageNumbers.appendChild(pageNumber);
        }
    }

    // Tampilkan data pada halaman pertama
    displayDataOnPage(currentPage);

    // Inisialisasi nomor halaman
    updatePageNumbers();
});
</script>
        </div>
    </div>
</div>