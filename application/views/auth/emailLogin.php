<div class="card-body">
    <div class="text-center my-5">
        <div class="judul mb-2">Masuk Dengan Email </div>
        <div class="text-center subjudul">Kami akan mengirimkan link login ke email anda</div>
    </div>

    <?php
    if ($this->session->flashdata('notif')) {
        echo $this->session->flashdata('notif');
    }
    ?>

    <hr>
    <?php echo form_open('login_email'); ?>

    <div class="form-group mb-4">
        <label class="mb-3" for="emailaddress">Email </label>
        <input type="email" name="email" placeholder="Masukkan email yang terdaftar" class="form-control" required>
        <br>
        <div class="g-recaptcha" data-sitekey="6Lfgl3caAAAAADXkDzVs813_hP2xOp5YAaZNopFJ"></div>
    </div>
    <div class="form-group mb-3 text-center">
        <button class="btn btn-primary btn-block py-2 w-100" type="submit" name="submit">
            Kirim
        </button>
        <div class="my-4"></div>
        <a href="<?= base_url('login') ?>" class="text-decoration-none py-2 w-100"><small><i class="fas fa-arrow-circle-left"></i> &nbsp; Kembali</small>
        </a>
    </div>

    </form>
</div>