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
                                        <h5><i class='bx bxs-down-arrow' style='color:#ff0004'></i> Pengembalian siswa</h5>
                                    </div>

                                    <div class="table-responsive text-nowrap">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Kode Peminjaman</th>
                                                    <th>Jumlah</th>
                                                    <th>Total Denda</th>
                                                    <th>Status</th>
                                                    <th>Admin</th>
                                                    <th>Tanggal & Jam</th>
                                                    <th>Detail</th>
                                                </tr>
                                            </thead>
                                            <tbody class="table-border-bottom-0">
                                                <?php
                                                if (empty($pengembalian)) {
                                                    echo "<tr><td colspan='8' class='text-center mt-3 mb-3'>Tidak ada data yang ditemukan.</td></tr>";
                                                } else {
                                                    foreach ($pengembalian as $val) : ?>
                                                        <tr>

                                                            <td><strong><?= $val->kode_pengembalian; ?></td>
                                                            <td><?= $val->total_pengembalian; ?></td>
                                                            <td><?= rupiah_format($val->total_denda); ?></td>
                                                            <td><?php
                                                                if ($val->status == 1) {
                                                                    echo '<span class="badge rounded-pill bg-success">Selesai</span>';
                                                                } elseif ($val->status == 2) {
                                                                    echo '<span class="badge rounded-pill bg-warning">Belum Bayar</span>';
                                                                } else {
                                                                    echo '<span class="badge rounded-pill bg-warning">Menunggak</span>';
                                                                }
                                                                ?></td>

                                                            <td><?= $val->nama_admin; ?></td>
                                                            <td><?= format_tanggal_indonesia($val->date); ?> | <br> <?= format_jam_indonesia($val->date); ?></td>
                                                            <td> <a href="<?= site_url('pengembalian/detail_pengembalian/' . $val->id_pengembalian) ?>" class="btn btn-sm btn-primary"><i class='bx bx-show-alt'></i></a></td>
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
                                                    <a class="page-link" href="<?= base_url('index.php/pengembalian/index/' . ($current_page - 1)) ?>"><i class="tf-icon bx bx-chevrons-left"></i></a>
                                                </li>
                                                <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                                                    <li class="page-item <?= $i == $current_page ? 'active' : '' ?>">
                                                        <a class="page-link" href="<?= base_url('index.php/pengembalian/index/' . $i) ?>"><?= $i ?></a>
                                                    </li>
                                                <?php endfor; ?>
                                                <li class="page-item next">
                                                    <a class="page-link" href="<?= base_url('index.php/pengembalian/index/' . ($current_page + 1)) ?>"><i class="tf-icon bx bx-chevrons-right"></i></a>
                                                </li>
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>