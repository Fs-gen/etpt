<div class="card-body">
    <div class="text-center my-5">
        <div class="judul mb-2">Selamat Datang </div>
        <div class="text-center subjudul">Silahkan masuk ke e-tpt</div>
    </div>

    <?php
    if ($this->session->flashdata('notif')) {
        echo $this->session->flashdata('notif');
    }
    ?>

    <hr>
    <?php echo form_open('login'); ?>

    <div class="form-group mb-4">
        <label class="mb-3" for="emailaddress">Email </label>
        <input type="email" name="email" placeholder="Masukkan email" class="form-control" required>
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
        <div class="g-recaptcha" data-sitekey="6Lfgl3caAAAAADXkDzVs813_hP2xOp5YAaZNopFJ"></div>
    </div>

    <div class="form-group mb-3 text-center">
        <button class="btn btn-primary btn-block py-2 w-100" type="submit" name="submit"> Masuk
        </button>
        <div class="my-3">Atau</div>
        <a href="<?= base_url('login_email') ?>" class="btn btn-info text-white btn-block py-2 w-100"><i class="fas fa-envelope"></i> &nbsp; Masuk Dengan Email
        </a>
        <hr>
        <div class="my-4"></div>
        <a href="<?= base_url('register') ?>" class="text-decoration-none py-2 w-100"></i><small>Belum Punya akun? <b>Registrasi disini!</b></small>
        </a>
    </div>

    </form>
</div>