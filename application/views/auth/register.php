<div class="card-body">
    <div class="text-center my-5">
        <div class="judul mb-2">Registrasi Akun</div>
        <div class="text-center subjudul">Silahkan Mengisi Formulir Dibawah</div>
    </div>
    <?php

    if ($this->session->flashdata('notif')) {
        //flashdata

        echo $this->session->flashdata('notif');
    }

    //validation errors
    if (validation_errors()) :
    ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <small><?= validation_errors(); ?></small>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <hr>

    <?php echo form_open('register'); ?>

    <div class="form-group mb-4">
        <label class="mb-3" for="name">Nama </label>
        <input type="text" name="name" placeholder="Masukkan Nama" value="<?= set_value('name'); ?>" class="form-control" required>
    </div>
    <div class="form-group mb-4">
        <label class="mb-3" for="npwp">NPWP </label>
        <input type="number" name="npwp" placeholder="Masukkan NPWP" value="<?= set_value('npwp'); ?>" class="form-control" required>
    </div>
    <div class="form-group mb-4">
        <label class="mb-3" for="emailaddress">Email </label>
        <input type="email" name="email" placeholder="Masukkan email" value="<?= set_value('email'); ?>" class="form-control" required>
    </div>
    <div class="form-group mb-4">
        <label class="mb-3" for="phone">Telepon </label>
        <input type="number" name="phone" placeholder="Masukkan No. Telepon" value="<?= set_value('phone'); ?>" class="form-control" required>
    </div>
    <div class="form-group mb-4">
        <label class="mb-3" for="identitasWajibPajak">Identitas Wajib Pajak </label>
        <select class="form-control" name="identitaswp" required>
            <option value="">Pilih salah satu ...</option>
            <option value="Orang Pribadi">Orang Pribadi</option>
            <option value="Instansi Pemerintah">Instansi Pemerintah</option>
            <option value="Badan Pusat">Badan Pusat</option>
            <option value="Badan Cabang">Badan Cabang</option>
        </select>
    </div>
    <div class="form-group mb-5">
        <label class="mb-3" for="password">Password</label>
        <div class="input-group bg-light" id="show_hide_password">
            <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password" required>
            <div class="input-group-addon">
                <a href=""><i class="fa fa-lg fa-eye" style="padding-top: 10px; padding-left: 10px; padding-right: 10px;" aria-hidden="true"></i></a>
            </div>
        </div>
        <br>
        <div class="">
            <input type="password" name="repassword" class="form-control" placeholder="Ulangi Password" required>
        </div>
        <br>
        <div class="g-recaptcha" data-sitekey="6Lfgl3caAAAAADXkDzVs813_hP2xOp5YAaZNopFJ"></div>
    </div>
    <div class="form-group mb-3 text-center">
        <button class="btn btn-primary btn-block py-2 w-100" type="submit" name="submit"> Log
            In
        </button>
        <div class="my-4"></div>
        <a href="<?= base_url('login') ?>" class="text-decoration-none py-2 w-100"><small><i class="fas fa-arrow-circle-left"></i> &nbsp; Kembali</small>
        </a>
    </div>

    </form>


</div>