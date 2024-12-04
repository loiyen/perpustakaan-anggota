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
                        <div class="col-md-12 mb-2">
                            <div class="card">
                                <div class="card-header">
                                    <a href="<?= site_url('pengembalian') ?>" class="btn btn-outline-warning"><i class='bx bx-left-arrow-alt'></i> Kembali</a>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-8">
                            <div class="card mb-4">
                                <h6 class="card-header fw-bold">Daftar Buku Pengembalian</h6>
                                <div class="card-body">
                                    <div class="table-responsive text-nowrap">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Judul Buku</th>
                                                    <th>Jumlah</th>
                                                    <th>Kondisi</th>
                                                    <th>Denda</th>
                                                </tr>
                                            </thead>
                                            <tbody class="table-border-bottom-0">
                                                <?php
                                                if (empty($detail_pengembalian)) {
                                                    echo "<tr><td colspan='8' class='text-center mt-3 mb-3'>Tidak ada data yang ditemukan.</td></tr>";
                                                } else {
                                                    $no = 1;
                                                    foreach ($detail_pengembalian as $val) : ?>
                                                        <tr>
                                                            <td><?= $no; ?></td>
                                                            <td><?= $val->judul_buku; ?></td>
                                                            <td><?= $val->jumlah_kembali; ?></td>
                                                            <td>
                                                                <?php
                                                                if ($val->kondisi_buku == 1) {
                                                                    echo '<span class="badge bg-success">Baik</span>';
                                                                } elseif ($val->kondisi_buku == 2) {
                                                                    echo '<span class="badge bg-warning">Robek / Bercoret</span>';
                                                                } elseif ($val->kondisi_buku == 3) {
                                                                    echo '<span class="badge bg-danger">Hilang</span>';
                                                                }
                                                                ?>
                                                            <td><?= rupiah_format($val->denda); ?></td>
                                                            </td>
                                                        </tr>
                                                        <?php $no++; ?>
                                                <?php endforeach;
                                                } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <?php
                                foreach ($detail_pengembalian as $val) :
                                ?>
                                    <div class="col-md-6">
                                        <div class="card h-100">
                                            <div class="col-md">
                                                <div class="row g-0">
                                                    <div class="col-md-4">
                                                        <img class="card-img card-img-left" src="<?= base_url('asset/fotobuku/' . $val->foto_buku) ?>" alt="Card image" />
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="card-body">
                                                            <h6 class="card-title"><?= $val->judul_buku; ?></h6>
                                                            <p class="card-text mb-0">
                                                                <small class="text-muted">
                                                                    Kelas : <?= $val->kelas_buku ?>
                                                                </small>
                                                            </p>
                                                            <p class="card-text mb-0">
                                                                <small class="text-muted">
                                                                    Penerbit : <?= $val->penerbit_buku ?>
                                                                </small>
                                                            </p>
                                                            <p class="card-text"> <small class="text-muted"> Stok : <?= $val->stok_buku; ?></small></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <h6 class="card-header fw-bold">Data Pengembalian Siswa</h6>
                                <div class="card-body">
                                    <div class="table-responsive text-nowrap">
                                        <table class="table table-borderless">
                                            <thead>
                                                <tr>
                                                    <td class="fw-bold">Kode Peminjaman</td>
                                                    <td>:</td>
                                                    <td class="fw-bold"><?= $pengembalian['kode_pengembalian'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Total</td>
                                                    <td>:</td>
                                                    <td><?= $pengembalian['total_pengembalian'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Total Denda</td>
                                                    <td>:</td>
                                                    <td><?= rupiah_format($pengembalian['total_denda']) ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Status</td>
                                                    <td>:</td>
                                                    <td><?php
                                                        if ($pengembalian['status'] == 1) {
                                                            echo '<span class="badge rounded-pill bg-success">Selesai</span>';
                                                        } elseif ($pengembalian['status'] == 2) {
                                                            echo '<span class="badge rounded-pill bg-warning">Belum Bayar</span>';
                                                        } else {
                                                            echo '<span class="badge rounded-pill bg-warning">Menunggak</span>';
                                                        }
                                                        ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Tanggal&Jam</td>
                                                    <td>:</td>
                                                    <td><?= format_tanggal_indonesia($pengembalian['date']); ?> | <?= format_jam_indonesia($pengembalian['date']); ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Admin</td>
                                                    <td>:</td>
                                                    <td><?= $pengembalian['nama_admin'] ?></td>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="card mt-2">
                                <h6 class="card-header fw-bold">Riwayat Pembayaran</h6>
                                <div class="card-body">
                                    <?php
                                    if (empty($pembayaran)) {
                                    } else {
                                        foreach ($pembayaran as $val) : ?>
                                            <div class="alert alert-secondary mb-1 " role="alert"><?= format_tanggal_indonesia($val->date_bayar); ?> |
                                                <?= format_jam_indonesia($val->date_bayar); ?> | <?= rupiah_format($val->jumlah) ?></div>
                                    <?php endforeach;
                                    } ?>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>