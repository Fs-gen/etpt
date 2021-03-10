<div class="container">
    <div class="card container my-3">
        <div class="card-body my-4">
            <h5 class="card-title"><b class="text-dark">Jenis Wajib Pajak</b></h5>
            <p class="card-text text-center font-weight-bold alert-primary col-sm-4 p-3 rounded"><?= $data['jenis_wajib_pajak']; ?></p>
            <hr>
            <!-- <h4 class="card-title"><b class="text-dark">Identitas Wajib Pajak</b></h4>
            <hr> -->
            <strong class="text-primary">Identitas Wajib Pajak Orang Pribadi, Wakil / Direktur Badan</strong>
            <br>
            <br>
            <div class="card-text mb-2"><b class="text-dark">NPWP : </b><?= $this->npwpformatter->npwp_format($data['npwp']); ?></div>
            <div class="card-text mb-2"><b class="text-dark">Nama : </b><?= $data['nama']; ?></div>
            <?php if ($data['jenis_wajib_pajak'] == 'Orang Pribadi') : ?>
                <div class="card-text mb-2"><b class="text-dark">NIK : </b><?= $data['nik']; ?></div>
                <div class="card-text mb-2"><b class="text-dark">Alamat Tempat Tinggal : </b><?= $data['alamat_tempat_tinggal']; ?></div>
            <?php endif; ?>
            <div class="card-text mb-2"><b class="text-dark">Telpon : </b><?= $data['telepon']; ?></div>
            <div class="card-text mb-2"><b class="text-dark">Email : </b><?= $data['email']; ?></div>

            <?php if ($data['jenis_wajib_pajak'] != 'Orang Pribadi') : ?>
                <div class="card-text mb-2"><b class="text-dark">Efin Salah Satu Pengurus : </b><?= $data['efin_pengurus']; ?></div>
                <div class="card-text mb-2"><b class="text-dark">No. Telepon Yang Mengajukan : </b><?= $data['telepon_pengaju']; ?></div>
                <hr>
                <strong class="text-primary">SPT Tahunan Yang Terakhir Dilaporkan</strong>
                <br>
                <br>
                <div class="card-text mb-2"><b class="text-dark">Tahun : </b><?= $data['spt_tahun']; ?></div>
                <div class="card-text mb-2"><b class="text-dark">Status : </b><?= $data['spt_status']; ?></div>
                <div class="card-text mb-2"><b class="text-dark">Nominal : </b><?= $data['spt_nominal']; ?></div>
            <?php endif; ?>
            <hr>
            <div class="text-dark my-4"><strong class="text-primary">Lampiran</strong></div>
            <div class="row mb-3">

                <?php if ($data['swafoto'] != NULL && $data['swafoto'] != 'diminta') : ?>
                    <div class="col-sm-3 mt-4">
                        <div class="card alert-info">
                            <div class="card-body text-center">
                                <p>
                                    <img src="<?= base_url() ?>assets/img/file.svg" width="150" alt="" srcset="">
                                </p>
                                <p>
                                    <b>Sawafoto KTP NPWP/SKT</b>
                                </p>
                                <a href="<?= base_url() . $data['swafoto'] ?>" target="_blank" class="btn btn-outline-primary"><small>Lihat</small></a>
                                <a href="<?= base_url('Home/download/') . $data['id'] . '/swafoto/poro' ?>" target="_blank" class="btn btn-primary"><small>Unduh</small></a>
                            </div>
                        </div>
                    </div>
                <?php else : ?>
                    <div class="mx-3">
                        <strong class="p-3 alert-warning rounded">Belum ada lampiran</strong>
                    </div>
                <?php endif; ?>

            </div>
            <div class="text-center mt-5">
                <?php if ($data['swafoto'] == 'diminta' || $data['swafoto'] != NULL) : ?>
                    <a href="#" class="btn alert-warning p-3 mr-2">Permintaan Swafoto Terkirim</a>
                <?php else : ?>
                    <a href="<?= base_url('Home/permintaan_swafoto/') . $data['id']; ?>" class="btn alert-danger p-3 mr-2" onclick="return confirm('Kirim permintaan Swafoto Ke <?= $data['nama'] ?>')">Swafoto diperlukan</a>
                <?php endif; ?>

                <a href="#" class="btn btn-primary p-3 ml-2" data-toggle="modal" data-target="#exampleModal">Pengecekan Selesai Dan Kirim EFIN</a>
            </div>
        </div>

    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bolder text-primary" id="exampleModalLabel">Masukkan EFIN</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('home/insertefin') ?>" method="post">
                    <input type="text" name="efin" class="form-control" placeholder="Masukkan Nomer EFIN" required>
                    <input type="text" name="idform" value="<?= $data['id']; ?>" class="form-control" required hidden>
                    <input type="text" name="type" value="poro" class="form-control" required hidden>
                    <input type="text" name="user_id" value="<?= $data['input_by']; ?>" class="form-control" required hidden>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Kirim</button>
            </div>
            </form>
        </div>
    </div>
</div>