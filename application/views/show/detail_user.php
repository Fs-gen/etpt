<div class="container-fluid">
    <h2>Detail Pengguna</h2>
    <hr>
    <div class="row">
        <div class="col-md-4 text-center">
            <div class="d-flex flex-column p-5">
                <img class="img-profile rounded-circle" src="https://ui-avatars.com/api/?name=<?= $user['name']; ?>&color=7F9CF5&background=EBF4FF">
            </div>

        </div>
        <div class="col-md-8">
            <div class="card p-4">
                <!-- <h5 class="card-header"><b><?= $user['name']; ?></b></h5> -->
                <div class="card-body">

                    <!-- <h5 class="card-title"><b></b></h5>
                <hr> -->
                    <div class="row">
                        <div class="col-md-3 font-weight-bolder text-primary">Nama</div>
                        <div class="col-9">: <?= $user['name']; ?></div>
                        <div class="w-100 my-2"></div>
                        <div class="col-md-3 font-weight-bolder text-primary">NPWP</div>
                        <div class="col-9">: <?= $this->npwpformatter->npwp_format($user['npwp']); ?></div>
                        <div class="w-100 my-2"></div>
                        <div class="col-md-3 font-weight-bolder text-primary">Email</div>
                        <div class="col-9">: <?= $user['email']; ?></div>
                        <div class="w-100 my-2"></div>
                        <div class="col-md-3 font-weight-bolder text-primary">No. Telepon</div>
                        <div class="col-9">: <?= $user['telepon']; ?></div>
                        <div class="w-100 my-2"></div>
                        <div class="col-md-3 font-weight-bolder text-primary">Jenis Wajib Pajak</div>
                        <div class="col-9">: <?= $user['jenis_wajib_pajak']; ?></div>
                        <div class="w-100 my-2"></div>
                        <div class="col-md-3 font-weight-bolder text-primary">Status Akun</div>
                        <div class="col-9">: <?= $user['status']; ?></div>
                        <div class="w-100 my-2"></div>
                        <div class="col-md-3 font-weight-bolder text-primary">Terdaftar</div>
                        <div class="col-9">: <?= date("l, j F Y H:i:s", $user['created_at']); ?></div>
                        <div class="w-100 my-2"></div>
                        <div class="col-md-3 font-weight-bolder text-primary">Terakhir Login</div>
                        <div class="col-9">: <?= date("l, j F Y H:i:s", $user['login_at']); ?></div>
                        <div class="w-100 my-2"></div>
                        <div class="col-md-3 font-weight-bolder text-primary">Alamat IP</div>
                        <div class="col-9">: <?= $user['ip_address']; ?></div>
                    </div>

                </div>

            </div>
        </div>
    </div>

</div>