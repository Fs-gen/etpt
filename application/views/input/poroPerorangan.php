<div class="container">

    <?php
    if ($this->session->flashdata('notif')) {
        echo $this->session->flashdata('notif');
    }
    $dataUser = $this->db->where('id', $this->session->userdata('id'))->get('users')->row_array();
    ?>

    <?php echo validation_errors(); ?>
    <!-- Basic Card Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-4 text-center">
            <h3 class="m-0 font-weight-bold text-primary">Formulir Lupa EFIN</h3>
        </div>

        <div class="card-body">

            <form action="<?= base_url('user/poro') ?>" method="POST" enctype="multipart/form-data">
                <label class="" for="">Jenis Wajib Pajak</label>
                <select name="jwp" class="font-weight-light form-control form-control-sm" id="jform" readonly required>
                    <option value="<?= $dataUser['jenis_wajib_pajak'] ?>"><?= $dataUser['jenis_wajib_pajak'] ?></option>
                </select>
                <hr>

                <div class="" id="form">
                    <h5 class="font-weight-bolder mb-3 text-primary">Identitas Wajib Pajak</h5>
                    <hr>
                    <div class="">


                        <!-- //form perorangan (single form) -->
                        <label for="">NPWP</label>
                        <input type="number" name="npwp" class="font-weight-light form-control form-control-sm" placeholder="Masukkan NPWP" value="<?= $dataUser['npwp'] ?>" readonly required><br>
                        <label for="">Nama</label>
                        <input type="text" name="nama" class="font-weight-light form-control form-control-sm" placeholder="Masukkan Nama" value="<?= $dataUser['name'] ?>" readonly required><br>
                        <label for="">NIK</label>
                        <input type=" number" name="nik" class="font-weight-light form-control form-control-sm" placeholder="Masukkan NIK" required><br>
                        <label for="">Alamat Tempat Lahir</label>
                        <input type="text" name="alamat_tempat_tinggal" class="font-weight-light form-control form-control-sm" placeholder="Masukkan Alamat Tempat Tinggal" required><br>
                    </div>
                    <hr>
                    <label for="">Telepon Seluler</label>
                    <input type="text" name="telpon" class="font-weight-light form-control form-control-sm" placeholder="Masukkan No Telepon" value="<?= $dataUser['telepon'] ?>" readonly required><br>
                    <label for="">Alamat Email</label>
                    <input type="email" name="email" class="font-weight-light form-control form-control-sm" placeholder="Masukkan Alamat Email" value="<?= $dataUser['email'] ?>" readonly required><br>

                    <button type="submit" class="btn btn-primary px-3">Kirim</button>


            </form>
        </div>
    </div>

</div>