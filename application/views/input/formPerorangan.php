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
            <h3 class="m-0 font-weight-bold text-primary">Formulir Permohonan EFIN</h3>
        </div>

        <div class="card-body">

            <form action="<?= base_url('user/formulir') ?>" method="POST" enctype="multipart/form-data">
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
                        <label for="">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" class="font-weight-light form-control form-control-sm" placeholder="Masukkan Tempat Lahir" required><br>
                        <label for="">Tanggal Lahir</label>
                        <input type="text" name="tgl_lahir" id="date" class="font-weight-light form-control form-control-sm" placeholder="Masukkan Tanggal Lahir" required><br>
                        <label for="">Warga Negara</label>
                        <select onchange="showAsing()" name="kewarganegaraan" class="font-weight-light form-control form-control-sm" id="jwarga" required>
                            <option value="">Pilih salah satu ..</option>
                            <option value="Indonesia">Indonesia</option>
                            <option value="Asing">Asing</option>
                        </select>

                        <!-- jika dari negarra asing tampilkan ini -->
                        <div class="" id="asing" hidden>
                            <br>
                            <label for="">Negara</label>
                            <input type="text" name="negara" id="negara" class="font-weight-light form-control form-control-sm" placeholder="Masukkan Negara"><br>
                            <label for="">No Paspor</label>
                            <input type="text" name="paspor" id="paspor" class="font-weight-light form-control form-control-sm" placeholder="Masukkan No Paspor"><br>
                            <label for="">No KITAS / KITAP </label>
                            <input type="text" name="nokitas_kitap" id="nokitas_kitap" class="font-weight-light form-control form-control-sm" placeholder="Masukkan No KITAS/KITAP">
                        </div>
                    </div>
                    <br>


                    <!-- file perorangan -->
                    <div class="" id="file-perorangan">
                        <label for="">Scan KTP / Paspor <small class="badge badge-danger">pdf</small></label>
                        <input type="file" name="scan_ktp_paspor" id="scan_ktp" class="form-control form-control-sm"><br>
                        <label for="">Swafoto dengan KTP dan NPWP <small class="badge badge-info" data-toggle="modal" data-target="#exampleModal">Lihat contoh</small></label>
                        <input type="file" name="swafoto_ktp_npwp_skt" id="swafoto_ktp" class="form-control form-control-sm"><br>
                    </div>
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

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Contoh Swafoto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img src="<?= base_url('assets/') ?>img/swafoto.jpg" class="img-fluid" alt="" srcset="">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
            </div>
        </div>
    </div>
</div>
<script>
    function showAsing() {
        if ($('#jwarga :selected').val() == 'Asing') {
            $('#asing').removeAttr("hidden");
            $('#negara').attr("required", true);
            $('#paspor').attr("required", true);
            $('#nokitas_kitap').attr("required", true);
        } else {
            $('#asing').attr("hidden", "hidden");
            $('#negara').removeAttr("required");
            $('#paspor').removeAttr("required");
            $('#nokitas_kitap').removeAttr("required");
        }
    }
</script>