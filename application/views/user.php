<div class="container">
    <?php
    if ($this->session->flashdata('notif')) {
        echo $this->session->flashdata('notif');
    } ?>

    <div class="row my-4">
        <div class="col-md-6 mb-3">
            <div class="card alert-primary">
                <div class="card-body">
                    <h5 class="card-title font-weight-bold">Aktivasi EFIN</h5>
                    <p class="card-text">Klik tombol di bawah untuk mengisi formulir permohonan EFIN</p>
                    <a href="<?= base_url('user/formulir') ?>" class="btn btn-primary">Isi Formulir</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card alert-warning">
                <div class="card-body">
                    <h5 class="card-title font-weight-bold">Lupa EFIN</h5>
                    <p class="card-text">Klik tombol di bawah untuk mengisi formulir permohonan lupa EFIN</p>
                    <a href="<?= base_url('user/poro') ?>" class="btn btn-warning">Isi Formulir</a>
                </div>
            </div>
        </div>
    </div>

    <!-- <div class="row my-4 text-center">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Special title treatment</h5>
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        </div>
    </div> -->

</div>