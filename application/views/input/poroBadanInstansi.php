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
                        <label for="">Telepon Seluler <small class="text-danger">*Yang terdaftar di DJP Online</small></label>
                        <input type="text" name="telpon" class="font-weight-light form-control form-control-sm" placeholder="Masukkan No Telepon" value="<?= $dataUser['telepon'] ?>" readonly required><br>
                        <label for="">Alamat Email <small class="text-danger">*Yang terdaftar di DJP Online</small></label>
                        <input type="email" name="email" class="font-weight-light form-control form-control-sm" placeholder="Masukkan Alamat Email" value="<?= $dataUser['email'] ?>" readonly required><br>
                        <label for="">EFIN salah satu pengurus yang tercantum dalam SPT tahunan pph badan yang sudah jatuh tempo</label>
                        <input type=" number" name="efin_pengurus" class="font-weight-light form-control form-control-sm" placeholder="Masukkan EFIN Salah Satu Pengurus" required><br>
                        <label for="">No. Telepon Yang Mengajukan</label>
                        <input type="number" name="tlp_pengaju" class="font-weight-light form-control form-control-sm" placeholder="Masukkan No. Telepon Yang Mengajukan" required><br>
                        <hr>
                        <h5 class="font-weight-bolder mb-3 text-primary">SPT Tahunan Terakhir Yang Dilaporkan <small class="text-danger">*Optional Untuk Instansi Pemerintah</small></h5>
                        <hr>
                        <label for="">Tahun Pajak</label>
                        <input type="number" name="tahun" class="font-weight-light form-control form-control-sm" placeholder="Masukkan Tahun Pajak" required><br>
                        <label for="">Status</label>
                        <input type="text" name="status" class="font-weight-light form-control form-control-sm" placeholder="Masukkan Status" required><br>
                        <label for="">Nominal</label>
                        <input type="number" name="nominal" class="font-weight-light form-control form-control-sm" placeholder="Masukkan Nominal" required><br>
                    </div>
                    <button type="submit" class="btn btn-primary px-3">Kirim</button>


            </form>
        </div>
    </div>

</div>