<div class="container">
    <?php
    if ($this->session->flashdata('notif')) {
        echo $this->session->flashdata('notif');
    }
    ?>

    <?php if (validation_errors()) : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong><?= validation_errors(); ?></strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <div class="row my-5">
        <div class="col-md-4 text-center my-4">
            <h1 class="text-primary font-weight-bold">Profile</h1>
            <!-- <p>Informasi Akun Anda</p> -->
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Informasi Akun</h5>
                    <hr>
                    <p class="card-text">
                    <div class="d-flex flex-row my-4">
                        <img class="img-profile rounded-circle" src="https://ui-avatars.com/api/?name=<?= $this->session->userdata('nama'); ?>&color=7F9CF5&background=EBF4FF">
                        <div class="d-flex flex-column justify-content-center ml-3">
                            <div class="text-primary"><?= $profile['name']; ?></div>
                            <div class="text-primary font-weight-bold"><?= $profile['email']; ?></div>
                        </div>
                    </div>
                    <form action="<?= base_url('profile') ?>" method="post">
                        <div class="">
                            <label for="">Jenis Wajib Pajak</label>
                            <input type="text" class="form-control" value="<?= $profile['jenis_wajib_pajak']; ?>" readonly> <br>
                            <label for="">NPWP</label>
                            <input type="text" class="form-control" value="<?= $this->npwpformatter->npwp_format($profile['npwp']); ?>" readonly> <br>
                            <label for="">No. Telepon</label>
                            <input type="text" class="form-control" value="<?= $profile['telepon']; ?>" readonly> <br>
                            <label for="">Password <small class="text-danger">*Masukkan password baru jika ingin mengubah</small></label>
                            <input type="password" class="form-control" name="password" required> <br>
                            <label for="">Konfirmasi Password</label>
                            <input type="password" class="form-control" name="repassword" required>
                            <br>
                        </div>
                        </p>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>