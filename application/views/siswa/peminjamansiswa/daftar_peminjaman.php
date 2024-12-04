<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">


        <!-- Layout container -->
        <div class="layout-page">
            <!-- Navbar -->

            <?php
            $this->load->view('siswa/layout/navbar');
            ?>

            <!-- / Navbar -->

            <div class="content-wrapper">
                <!-- Content -->
                <div class="container-xxl flex-grow-1 container-p-y">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <div class="card-header fw-bold">
                                        <h5><i class='bx bxs-up-arrow' style='color:#00ff2c'></i> Peminjaman siswa</h5>
                                    </div>

                                    <div class="table-responsive text-nowrap">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Nama</th>
                                                    <th>Kode Peminjaman</th>
                                                    <th>Jumlah</th>
                                                    <th>Petugas</th>
                                                    <th>Tanggal & jam</th>
                                                    <th>Status</th>
                                                    <th>Detail</th>
                                                </tr>
                                            </thead>
                                            <tbody class="table-border-bottom-0">
                                                <?php
                                                if (empty($riwayat)) {
                                                    echo "<tr><td colspan='8' class='text-center mt-3 mb-3'>Tidak ada data yang ditemukan.</td></tr>";
                                                } else {
                                                    foreach ($riwayat as $val) : ?>
                                                        <tr>
                                                            <td><?= $val->nama_siswa; ?></td>
                                                            <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong><?= $val->kode_peminjaman; ?></strong></td>
                                                            <td><?= $val->total_peminjaman; ?></td>
                                                            <td><?= $val->nama_admin; ?></td>
                                                            <td><?= format_tanggal_indonesia($val->datecreated) ?> & <br> <?= format_jam_indonesia($val->datecreated) ?> </td>
                                                            <td>
                                                                <?php
                                                                if ($val->status_pinjam == 'Selesai') {
                                                                    echo '<span class="badge bg-success me-1"><strong>' . $val->status_pinjam . '</strong></span>';
                                                                } else {
                                                                    echo '<span class="badge bg-danger"><strong>' . $val->status_pinjam . '</strong></span>';
                                                                }
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <a href="<?= site_url('peminjaman/peminjamanitem/' . $val->id_peminjaman) ?>" class="btn btn-sm btn-primary"><i class='bx bx-show-alt'></i></a>
                                                            </td>

                                                        </tr>
                                                <?php endforeach;
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="demo-inline-spacing">
                                        <nav aria-label="Page navigation">
                                            <ul class="pagination pagination">
                                                <li class="page-item prev">
                                                    <a class="page-link" href="<?= base_url('index.php/peminjaman/index/' . ($current_page - 1)) ?>"><i class="tf-icon bx bx-chevrons-left"></i></a>
                                                </li>
                                                <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                                                    <li class="page-item <?= $i == $current_page ? 'active' : '' ?>">
                                                        <a class="page-link" href="<?= base_url('index.php/peminjaman/index/' . $i) ?>"><?= $i ?></a>
                                                    </li>
                                                <?php endfor; ?>
                                                <li class="page-item next">
                                                    <a class="page-link" href="<?= base_url('index.php/peminjaman/index/' . ($current_page + 1)) ?>"><i class="tf-icon bx bx-chevrons-right"></i></a>
                                                </li>
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>