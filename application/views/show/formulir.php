<div class="container">
    <div class="card container my-3">
        <div class="card-body my-4">
            <h5 class="card-title"><b class="text-dark">Jenis Wajib Pajak</b></h5>
            <p class="card-text text-center font-weight-bold alert-primary col-sm-4 p-3 rounded"><?= $data['jenis_wajib_pajak']; ?></p>
            <hr>
            <strong class="text-primary">Identitas Wajib Pajak Orang Pribadi, Wakil / Direktur Badan</strong>
            <br>
            <br>
            <div class="card-text mb-2"><b class="text-dark">NPWP : </b><?= $this->npwpformatter->npwp_format($data['npwp']); ?></div>
            <div class="card-text mb-2"><b class="text-dark">Nama : </b><?= $data['nama']; ?></div>
            <div class="card-text mb-2"><b class="text-dark">NIK : </b><?= $data['nik']; ?></div>
            <div class="card-text mb-2"><b class="text-dark">Tempat Lahir : </b><?= $data['tempat_lahir']; ?></div>
            <div class="card-text mb-2"><b class="text-dark">Tanggal Lahir : </b><?= $data['tgl_lahir']; ?></div>
            <div class="card-text mb-2"><b class="text-dark">Kewarganegaraan : </b><?= $data['kewarganegaraan']; ?></div>

            <?php if ($data['kewarganegaraan'] == 'Asing') : ?>
                <div class="card-text mb-2"><b class="text-dark">Negara : </b><?= $data['negara']; ?></div>
                <div class="card-text mb-2"><b class="text-dark">Paspor : </b><?= $data['paspor']; ?></div>
                <div class="card-text mb-2"><b class="text-dark">No KITAS / KITAP : </b><?= $data['nokitas_kitap']; ?></div>
            <?php endif; ?>
            <hr>

            <?php if ($data['jenis_wajib_pajak'] != 'Orang Pribadi') : ?>
                <div class="text-dark my-4"><strong class="text-primary"> Wajib Pajak Badan / Instansi Pemerintah</strong></div>
                <div class="card-text mb-2"><b class="text-dark">NPWP Badan / Instansi Pemerintah : </b><?= $this->npwpformatter->npwp_format($data['npwp_badan']); ?></div>
                <div class="card-text mb-2"><b class="text-dark">Nama Badan / Instansi Pemerintah : </b><?= $data['nama_badan']; ?></div>
                <hr>
            <?php endif; ?>

            <div class="text-dark my-4"><strong class="text-primary">Kontak</strong></div>
            <div class="card-text mb-2"><b class="text-dark">Telpon : </b><?= $data['telpon']; ?></div>
            <div class="card-text mb-2"><b class="text-dark">Email : </b><?= $data['email']; ?></div>
            <hr>
            <div class="text-dark my-4"><strong class="text-primary">Lampiran</strong></div>
            <div class="row mb-3">

                <div class="col-sm-3 mt-4">
                    <div class="card alert-info">
                        <div class="card-body text-center">
                            <p>
                                <img src="<?= base_url() ?>assets/img/file.svg" width="150" alt="" srcset="">
                            </p>
                            <p>
                                <b>Scan <br>
                                    KTP / Paspor</b>
                            </p>
                            <a href="<?= base_url() . $data['scan_ktp_paspor'] ?>" target="_blank" class="btn btn-outline-primary"><small>Lihat
                                </small></a>
                            <a href="<?= base_url('Home/download/') . $data['id'] . '/scan_ktp_paspor/formulir' ?>" target="_blank" class="btn btn-primary"><small>Unduh</small></a>
                        </div>
                    </div>
                </div>

                <div class="col-sm-3 mt-4">
                    <div class="card alert-info">
                        <div class="card-body text-center">
                            <p>
                                <img src="<?= base_url() ?>assets/img/file.svg" width="150" alt="" srcset="">
                            </p>
                            <p>
                                <b>Sawafoto KTP NPWP/SKT</b>
                            </p>
                            <a href="<?= base_url() . $data['swafoto_ktp_npwp_skt'] ?>" target="_blank" class="btn btn-outline-primary"><small>Lihat
                                </small></a>
                            <a href="<?= base_url('Home/download/') . $data['id'] . '/swafoto_ktp_npwp_skt/formulir' ?>" target="_blank" class="btn btn-primary"><small>Unduh</small></a>
                        </div>
                    </div>
                </div>

                <!-- badan atau instansi -->
                <?php if ($data['jenis_wajib_pajak'] != 'Orang Pribadi') : ?>
                    <div class="col-sm-3 mt-4">
                        <div class="card alert-info">
                            <div class="card-body text-center">
                                <p>
                                    <img src="<?= base_url() ?>assets/img/file.svg" width="150" alt="" srcset="">
                                </p>
                                <p>
                                    <b>Scan <br> Surat Penunjukan</b>
                                </p>
                                <a href="<?= base_url() . $data['scan_surat_penunjukan'] ?>" target="_blank" class="btn btn-outline-primary"><small>Lihat
                                    </small></a>
                                <a href="<?= base_url('Home/download/') . $data['id'] . '/scan_surat_penunjukan/formulir' ?>" target="_blank" class="btn btn-primary"><small>Unduh</small></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-3 mt-4">
                        <div class="card alert-info">
                            <div class="card-body text-center">
                                <p>
                                    <img src="<?= base_url() ?>assets/img/file.svg" width="150" alt="" srcset="">
                                </p>
                                <p>
                                    <b>Scan <br>NPWP Badan / SKT</b>
                                </p>
                                <a href="<?= base_url() . $data['scan_npwp_badan_skt'] ?>" class="btn btn-outline-primary"><small>Lihat
                                    </small></a>
                                <a href="<?= base_url('Home/download/') . $data['id'] . '/scan_npwp_badan_skt/formulir' ?>" target="_blank" class="btn btn-primary"><small>Unduh</small></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-3 mt-4">
                        <div class="card alert-info">
                            <div class="card-body text-center">
                                <p>
                                    <img src="<?= base_url() ?>assets/img/file.svg" width="150" alt="" srcset="">
                                </p>
                                <p>
                                    <b>Scan NPWP / SKT Wakil Wajib Pajak</b>
                                </p>
                                <a href="<?= base_url() . $data['scan_npwp_skt_wajib_pajak'] ?>" target="_blank" class="btn btn-outline-primary">Lihat</a>
                                <a href="<?= base_url('Home/download/') . $data['id'] . '/scan_npwp_skt_wajib_pajak/formulir' ?>" target="_blank" class="btn btn-primary"><small>Unduh</small></a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if ($data['scan_pengangkatan_kantor_cabang']) : ?>
                    <div class="col-sm-3 mt-4">
                        <div class="card alert-info">
                            <div class="card-body text-center">
                                <p>
                                    <img src="<?= base_url() ?>assets/img/file.svg" width="150" alt="" srcset="">
                                </p>
                                <p>
                                    <b>Scan Surat Pengangkatan Pimpinan Kantor Cabang</b>
                                </p>
                                <a href="<?= base_url() . $data['scan_pengangkatan_kantor_cabang'] ?>" target="_blank" class="btn btn-outline-primary">Lihat</a>
                                <a href="<?= base_url('Home/download/') . $data['id'] . '/scan_pengangkatan_kantor_cabang/formulir' ?>" target="_blank" class="btn btn-primary"><small>Unduh</small></a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

            </div>
            <hr>
            <?php if (!$efin) : ?>
                <div class="text-center mt-5">
                    <a href="#" class="btn btn-primary p-3" data-toggle="modal" data-target="#exampleModal">Pengecekan Selesai Dan Kirim EFIN</a>
                </div>
            <?php endif; ?>
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
                        <input type="text" name="type" value="formulir" class="form-control" required hidden>
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