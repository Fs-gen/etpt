<div class="container">
    <?php
    if ($this->session->flashdata('notif')) {
        echo $this->session->flashdata('notif');
    } ?>

    <?php
    // cek permintaan swafoto
    $cek = $this->db->get_where('poro', ['input_by' => $this->session->userdata('id')])->row_array();
    if ($cek && $cek['swafoto'] == 'diminta') : ?>
        <div class="alert alert-info" role="alert">
            <h4 class="alert-heading font-weight-bolder">Swafoto diperlukan!</h4>
            <p>Data permintaan lupa EFIN anda tidak sesuai dengan data di DJP Online, maka dari itu kami meminta anda untuk melakukan Swafoto.</p>
            <hr>
            <p class="mb-0"><a href="<?= base_url('User/swafoto') ?>" class="btn btn-info">Lakukan Swafoto</a>.</p>
        </div>
    <?php endif; ?>
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