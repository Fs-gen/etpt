                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <?php
                    if ($this->session->flashdata('notif')) {
                        echo $this->session->flashdata('notif');
                    }
                    ?>
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!--Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah Pengguna</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Permintaan Aktivasi EFIN</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_aktivasi ?></div>

                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-lock-open fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                                <small class="text-right mr-4"><a href="#aktivasi">Lihat Semua</a></small>
                            </div>
                        </div>

                        <!--Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Permintaan Lupa EFIN</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_lupa ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-history fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                                <small class="text-right mr-4"><a href="#lupa_efin">Lihat Semua</a></small>
                            </div>
                        </div>


                    </div>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4" id="aktivasi">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Daftar Permintaan Aktivasi EFIN</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="text-center">
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>NPWP</th>
                                            <th>Email</th>
                                            <th>Identitas Wajib Pajak</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>NPWP</th>
                                            <th>Email</th>
                                            <th>Identitas Wajib Pajak</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php if ($aktivasi) : ?>
                                            <?php
                                            $num = 1;
                                            foreach ($aktivasi as $aktivasi) : ?>
                                                <tr>
                                                    <td><?= $num++; ?></td>
                                                    <td><?= $aktivasi['nama']; ?></td>
                                                    <td><?= $this->npwpformatter->npwp_format($aktivasi['npwp']); ?></td>
                                                    <td><?= $aktivasi['email']; ?></td>
                                                    <td><?= $aktivasi['jenis_wajib_pajak']; ?></td>
                                                    <td class="text-center"><a href="<?= base_url('Home/lihat_formulir/') . $aktivasi['id'] ?>"><i class="fas fa-eye"></i></a></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php endif; ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                    <!-- DataTales Example -->
                    <div class="card shadow mb-4" id="lupa_efin">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Daftar Permintaan lupa EFIN</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable1" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="text-center">
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>NPWP</th>
                                            <th>Email</th>
                                            <th>Identitas Wajib Pajak</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>NPWP</th>
                                            <th>Email</th>
                                            <th>Identitas Wajib Pajak</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </tfoot>

                                    <tbody>
                                        <?php if ($lupa_efin) : ?>
                                            <?php
                                            $n = 1;
                                            foreach ($lupa_efin as $lupa) : ?>
                                                <tr>
                                                    <td><?= $n++; ?></td>
                                                    <td><?= $lupa['nama']; ?></td>
                                                    <td><?= $this->npwpformatter->npwp_format($lupa['npwp']); ?></td>
                                                    <td><?= $lupa['email']; ?></td>
                                                    <td><?= $lupa['jenis_wajib_pajak']; ?></td>
                                                    <td class="text-center"><a href="<?= base_url('Home/lihat_poro/') . $lupa['id'] ?>"><i class="fas fa-eye"></i></a></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php endif; ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- /.container-fluid -->
                </div>