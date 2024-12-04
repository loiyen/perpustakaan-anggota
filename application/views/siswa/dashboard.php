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
                        <div class="col-lg-8 mb-4 order-0">
                            <div class="card">
                                <div class="d-flex align-items-end row">
                                    <div class="col-sm-7">
                                        <div class="card-body">
                                            <h5 class="card-title text-primary">Selamat Datang!! <?= $user['nama_siswa']; ?></h5>
                                            <p class="mb-4">
                                                Dashboar siswa Perpustakan SMA NEGERI 1 KRAYAN <span class="fw-bold"> </span>
                                            </p>
                                            <a href="<?= site_url('accountsiswa'); ?>" class="btn btn-sm btn-outline-primary">Lihat Data</a>
                                        </div>
                                    </div>
                                    <div class="col-sm-5 text-center text-sm-left">
                                        <div class="card-body pb-0 px-0 px-md-4">
                                            <img src="<?php echo base_url('asset/assets/img/illustrations/girl-doing-yoga-light.png') ?>" height="140" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 order-1">
                            <div class="row">
                                <div class="col-lg-6 col-md-12 col-6 mb-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="card-title d-flex align-items-start justify-content-between">
                                                <div class="avatar flex-shrink-0">
                                                    <i class='bx bxs-up-arrow-circle' style='color:#00ff2c'></i>
                                                </div>
                                                <div class="dropdown">
                                                    <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                                        <a class="dropdown-item" href="<?= site_url('peminjaman') ?>">Lihat Data</a>

                                                    </div>
                                                </div>
                                            </div>
                                            <span class="d-block mb-1">Peminjaman</span>
                                            <h3 class="card-title text-nowrap mb-2"><?= $peminjamanitem ?></h3>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-12 col-6 mb-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="card-title d-flex align-items-start justify-content-between">
                                                <div class="avatar flex-shrink-0">
                                                    <i class='bx bxs-down-arrow-circle' style='color:#ff0105'></i>
                                                </div>
                                                <div class="dropdown">
                                                    <button class="btn p-0" type="button" id="cardOpt6" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                                                        <a class="dropdown-item" href="<?= site_url('pengembalian') ?>">Lihat Data</a>

                                                    </div>
                                                </div>
                                            </div>
                                            <span>Pengembalian</span>
                                            <h3 class="card-title text-nowrap mb-1"><?= $pengembalian; ?></h3>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>


                        <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
                            <div class="card">
                                <div class="row g-0">
                                    <div class="card-header d-flex align-items-center justify-content-between">
                                        <h5 class="card-header"><i class='bx bxs-up-arrow' style='color:#00ff2c'></i> Data peminjaman</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive text-nowrap">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Kode Peminjaman</th>
                                                        <th>Jumlah</th>
                                                        <th>Petugas</th>
                                                        <th>Tanggal & Jam</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="table-border-bottom-0">
                                                    <?php
                                                    if (empty($riwayat)) {
                                                        echo "<tr><td colspan='8' class='text-center mt-3 mb-3'>Tidak ada data yang ditemukan.</td></tr>";
                                                    } else {
                                                        foreach ($riwayat as $val) : ?>
                                                            <tr>
                                                                <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong><?= $val->kode_peminjaman; ?></strong></td>
                                                                <td><?= $val->total_peminjaman; ?></td>
                                                                <td><?= $val->nama_admin; ?></td>
                                                                <td><?= format_tanggal_indonesia($val->datecreated) ?> &<br> <?= format_jam_indonesia($val->datecreated) ?> </td>
                                                                <td>
                                                                    <?php
                                                                    if ($val->status_pinjam == 'Selesai') {
                                                                        echo '<span class="badge bg-success me-1"><strong>' . $val->status_pinjam . '</strong></span>';
                                                                    } else {
                                                                        echo '<span class="badge bg-danger"><strong>' . $val->status_pinjam . '</strong></span>';
                                                                    }
                                                                    ?>
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
                                                        <a class="page-link" href="<?= base_url('index.php/dashboardsiswa/index/' . ($current_page - 1)) ?>"><i class="tf-icon bx bx-chevrons-left"></i></a>
                                                    </li>
                                                    <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                                                        <li class="page-item <?= $i == $current_page ? 'active' : '' ?>">
                                                            <a class="page-link" href="<?= base_url('index.php/dashboardsiswa/index/' . $i) ?>"><?= $i ?></a>
                                                        </li>
                                                    <?php endfor; ?>
                                                    <li class="page-item next">
                                                        <a class="page-link" href="<?= base_url('index.php/dashboardsiswa/index/' . ($current_page + 1)) ?>"><i class="tf-icon bx bx-chevrons-right"></i></a>
                                                    </li>
                                                </ul>
                                            </nav>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
                            <div class="row">
                                <div class="col-6 mb-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="card-title d-flex align-items-start justify-content-between">
                                                <div class="avatar flex-shrink-0">
                                                    <i class='bx bxs-info-circle' style='color:#fffa00'></i>
                                                </div>
                                                <div class="dropdown">
                                                    <button class="btn p-0" type="button" id="cardOpt1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="cardOpt1">
                                                        <a class="dropdown-item" href="<?= site_url('denda/pembayaran') ?>">Lihat Data</a>

                                                    </div>
                                                </div>
                                            </div>
                                            <span class="fw-semibold d-block mb-1">Total Denda</span>
                                            <h5 class="card-title mb-2"><?= rupiah_format($total_denda) ?></h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 mb-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="card-title d-flex align-items-start justify-content-between">
                                                <div class="avatar flex-shrink-0">
                                                    <i class='bx bxs-wallet' style='color:#0a1cf3'></i>
                                                </div>
                                                <div class="dropdown">
                                                    <button class="btn p-0" type="button" id="cardOpt1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="cardOpt1">
                                                        <a class="dropdown-item" href="<?= site_url('denda') ?>">Lihat Data</a>

                                                    </div>
                                                </div>
                                            </div>
                                            <span class="fw-semibold d-block mb-1">Pembayaran</span>
                                            <h5 class="card-title mb-2"><?= rupiah_format($jumlah) ?></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive text-nowrap">
                                            <table class="table">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Kode</th>
                                                        <th>Kondisi</th>
                                                        <th>Tanggal</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="table-border-bottom-0">
                                                    <?php
                                                    if (empty($cek_buku)) {
                                                        echo "<tr><td colspan='4' class='text-center mt-3 mb-3'>Tidak ada data yang ditemukan.</td></tr>";
                                                    } else {
                                                        foreach ($cek_buku as $val) :
                                                    ?>
                                                            <tr>
                                                                <td><a href="<?= site_url('pengembalian/detail_pengembalian/' . $val->id_pengembalian) ?>" class="btn btn-sm btn-primary"><i class='bx bx-show-alt'></i></a></td>
                                                                <td><strong><?= $val->kode_pengembalian; ?></strong></td>
                                                                <td><?php
                                                                    if ($val->kondisi_buku == 1) {
                                                                        echo '<span class="badge bg-success">Baik</span>';
                                                                    } elseif ($val->kondisi_buku == 2) {
                                                                        echo '<span class="badge bg-warning">Robek / Bercoret</span>';
                                                                    } elseif ($val->kondisi_buku == 3) {
                                                                        echo '<span class="badge bg-danger">Hilang</span>';
                                                                    }
                                                                    ?></td>
                                                                <td><?= format_tanggal_indonesia($val->date); ?></td>
                                                            </tr>
                                                    <?php endforeach;
                                                    } ?>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                    </div>
                </div>