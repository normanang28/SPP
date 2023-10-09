<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
         <div class="table-responsive">
            <table class="table table-bordered table-striped verticle-middle table-responsive-sm">
        <thead>
            <tr>
        <th class="text-center">No</th>
        <th class="text-center">Username</th>
        <th class="text-center">Activity</th>
        <th class="text-center">Date</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $no=1;
            foreach ($duar as $gas){
              ?>
            <tr>
                      <th class="text-center"><?php echo $no++ ?></th>
                      <td class="text-capitalize text-center"><?php echo $gas->username?></td>      
                      <td class="text-capitalize text-center"><?php echo $gas->aktifitas?></td>
                      <td class="text-capitalize text-center"><?php echo $gas->waktu?></td>
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
    const itemsPerPage = 30;
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
            <td class="text-capitalize text-center text-dark">${gas.username}</td>
            <td class="text-capitalize text-center text-dark">${gas.aktifitas}</td>
            <td class="text-capitalize text-center text-dark">${gas.waktu}</td>
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