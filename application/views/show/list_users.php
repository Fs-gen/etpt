<div class="container">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h3 class="m-0 font-weight-bold text-primary">Daftar Pengguna</h3>
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
                            <th>Jenis Wajib Pajak</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>NPWP</th>
                            <th>Email</th>
                            <th>Jenis Wajib Pajak</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $num = 1;
                        foreach ($list_users as $list) : ?>
                            <tr>
                                <td><?= $num++; ?></td>
                                <td><?= $list['name']; ?></td>
                                <td><?= $list['npwp']; ?></td>
                                <td><?= $list['email']; ?></td>
                                <td><?= $list['jenis_wajib_pajak']; ?></td>
                                <td class="text-center">
                                    <a href="<?= base_url('home/detail_user/') . $list['id']; ?>"><i class="fas fa-eye"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>