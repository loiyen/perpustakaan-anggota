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
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="card-header">
                                                <h5><i class='bx bx-wallet-alt' style='color:#514c4c'></i> Daftar denda</h5>
                                            </div>

                                            <div class="table-responsive text-nowrap">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Kode Pengembalian</th>
                                                            <th>Kode Pembayaran</th>
                                                            <th>Jumlah</th>
                                                            <th>Tanggla & Jam</th>
                                                            <th>detail</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="table-border-bottom-0">
                                                        <?php
                                                        if (empty($denda)) {
                                                            echo "<tr><td colspan='8' class='text-center mt-3 mb-3'>Tidak ada data yang ditemukan.</td></tr>";
                                                        } else {
                                                            $no = 1;
                                                            foreach ($denda as $val) : ?>
                                                                <tr>
                                                                    <td><?= $no; ?></td>
                                                                    <td><?= $val->kode_pengembalian ?>
                                                                        <div class="mt-2">
                                                                            <?php
                                                                            if ($val->status == 1) {
                                                                                echo '<span class="badge rounded-pill bg-success">Selesai</span>';
                                                                            } elseif ($val->status == 2) {
                                                                                echo '<span class="badge rounded-pill bg-warning">Belum Bayar</span>';
                                                                            } else {
                                                                                echo '<span class="badge rounded-pill bg-warning">Menunggak</span>';
                                                                            }
                                                                            ?>
                                                                        </div>
                                                                    </td>
                                                                    <td class="fw-bold"><?= $val->kode_pembayaran; ?></td>
                                                                    <td><?= rupiah_format($val->jumlah); ?></td>
                                                                    <td><?= format_tanggal_indonesia($val->date_bayar) ?> |<br> <?= format_jam_indonesia($val->date_bayar) ?> </td>
                                                                    <td> <a href="<?= site_url('pengembalian/detail_pengembalian/' . $val->id_pengembalian) ?>" class="btn btn-sm btn-primary"><i class='bx bx-show-alt'></i></a></td>
                                                                </tr>
                                                                <?php $no++; ?>
                                                        <?php endforeach;
                                                        } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card">
                                        <h6 class="card-header text-white bg-warning fw-bold">
                                            Akumulasi Pembayaran
                                        </h6>
                                        <div class="row">
                                            <div class="col-md-6 mb-1">
                                                <div class="">
                                                    <h6 class="card-header">
                                                        Total Denda
                                                    </h6>
                                                    <div class="card-body">
                                                        <h5 class="fw-bold"><i class='bx bxs-down-arrow' style='color:#04ff42'></i> <?= rupiah_format($total_denda); ?></h5>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-1">
                                                <div class="">
                                                    <h6 class="card-header">
                                                        Total Pembayaran
                                                    </h6>
                                                    <div class="card-body">
                                                        <h5 class="fw-bold"><i class='bx bxs-up-arrow' style='color:#dc0000'></i> <?= rupiah_format($pembayaran); ?></h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <h6 class="card-header text-center">
                                                Sisa Pembayaran
                                            </h6>
                                            <div>
                                                <h3 class="text-center">
                                                    <?php
                                                    $jumlah = $total_denda - $pembayaran;
                                                    echo rupiah_format($jumlah);
                                                    ?>
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>


                        </div>
                    </div>
                </div>
            </div>