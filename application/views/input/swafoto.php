<div class="container">
    <?php if ($this->session->flashdata('notif')) {
        echo $this->session->flashdata('notif');
    };
    echo validation_errors(); ?>

    <div class="card alert-primary">
        <div class="card-body">
            <h5 class="card-title font-weight-bold">Swafoto</h5>
            <p class="card-text"><img src="<?= base_url('assets/') ?>img/swafoto.jpg" class="img-fluid" alt="" srcset=""></p>
            <form action="<?= base_url('User/swafoto'); ?>" method="post" enctype="multipart/form-data">
                <p class="card-text">
                    <label for="">Ambil Gambar</label>
                    <input type="file" class="mb-3" name="swafoto" accept="image/*" capture required />
                </p>
                <button type="submit" class="btn btn-primary px-4">Kirim</button>
            </form>
        </div>
    </div>
</div>