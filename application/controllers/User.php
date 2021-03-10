<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        if (empty($this->session->userdata('id'))) {
            redirect('login');
        }

        if ($this->session->userdata('role') != 'user') {
            show_404();
        }
    }
    public function index()
    {
        $data['title'] = 'Selamat Datang';

        $this->load->view('layouts/head', $data);
        $this->load->view('user');
        $this->load->view('layouts/foot');
    }

    public function formulir()
    {

        if ($this->db->get_where('formulir', ['input_by' => $this->session->userdata('id')])->num_rows() >= 1) {
            $this->session->set_flashdata('notif', '<div class="alert alert-info alert-dismissible fade show" role="alert"><b>Formulir sudah terkirim</b>, Petugas akan mengecek formulir kemudian EFIN akan dikirim ke email anda! <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button></div>');
            redirect('user');
        }

        $data['title'] = 'Formulir Permohonan';

        $this->form_validation->set_rules('jwp', 'Jenis Wajib Pajak', 'required');
        $this->form_validation->set_rules('npwp', 'NPWP', 'required|trim');
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('nik', 'NIK', 'required|trim');
        $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required|trim');
        $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required|trim');
        $this->form_validation->set_rules('kewarganegaraan', 'Kewarganegaraan', 'required|trim');
        $this->form_validation->set_rules('telpon', 'No Telpon', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');

        if ($this->form_validation->run() == false) {
            // cek jenis wajib pajak
            $cek_jwp = $this->db->get_where('users', ['id' => $this->session->userdata('id')])->row_array();

            $this->load->view('layouts/head', $data);

            if ($cek_jwp['jenis_wajib_pajak'] == 'Orang Pribadi') {
                $this->load->view('input/formPerorangan');
            } else {
                $this->load->view('input/formBadanInstansi');
            }

            $this->load->view('layouts/foot');
        } else {

            // jenis wajib pajak
            $jenis_wp = htmlspecialchars($this->input->post('jwp', true));
            $npwp = htmlspecialchars($this->input->post('npwp', true));
            $nama = htmlspecialchars($this->input->post('nama', true));
            $nik = htmlspecialchars($this->input->post('nik', true));
            $tempat_lahir = htmlspecialchars($this->input->post('tempat_lahir', true));
            $tgl_lahir = htmlspecialchars($this->input->post('tgl_lahir', true));
            $kewarganegaraan = htmlspecialchars($this->input->post('kewarganegaraan', true));

            // kewarganegaraan
            if ($kewarganegaraan == 'Asing') {
                $negara = htmlspecialchars($this->input->post('negara', true));
                $paspor = htmlspecialchars($this->input->post('paspor', true));
                $nokitas_kitap = htmlspecialchars($this->input->post('nokitas_kitap', true));
            } else {
                $negara = NULL;
                $paspor = NULL;
                $nokitas_kitap = NULL;
            }

            // badan/instansi
            $npwp_badan = htmlspecialchars($this->input->post('npwp_badan', true));
            $nama_badan = htmlspecialchars($this->input->post('nama_badan', true));

            //kontak
            $telpon = htmlspecialchars($this->input->post('telpon', true));
            $email = htmlspecialchars($this->input->post('email', true));

            //destinasi/direktori
            $destination = md5($this->session->userdata('email')) . '/formulir';

            if ($jenis_wp == 'Orang Pribadi') {

                // INSERT FORMULIR PERORANGAN
                $scan_ktp_paspor = $this->do_upload($destination, 'scan_ktp_paspor', 'formulir');
                $swafoto_ktp_npwp_skt = $this->do_upload($destination, 'swafoto_ktp_npwp_skt', 'formulir');

                //insert db
                $insert = [
                    'jenis_wajib_pajak' => $jenis_wp,
                    'npwp' => $npwp,
                    'nama' => $nama,
                    'nik' => $nik,
                    'tempat_lahir' => $tempat_lahir,
                    'tgl_lahir' => $tgl_lahir,
                    'kewarganegaraan' => $kewarganegaraan,
                    'negara' => $negara,
                    'paspor' => $paspor,
                    'nokitas_kitap' => $nokitas_kitap,
                    'telpon' => $telpon,
                    'email' => $email,
                    'scan_ktp_paspor' => $scan_ktp_paspor,
                    'swafoto_ktp_npwp_skt' => $swafoto_ktp_npwp_skt,
                    'input_by' => $this->session->userdata('id'),
                    'created_at' => time(),
                    'ip_address' => $this->input->ip_address()
                ];

                if ($this->db->insert('formulir', $insert)) {
                    $this->session->set_flashdata('notif', '<div class="alert alert-info alert-dismissible fade show" role="alert"><b>Formulir sudah terkirim</b>, Petugas akan mengecek formulir kemudian EFIN akan dikirim ke email anda! <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button></div>');
                    redirect('User');
                } else {
                    $this->session->set_flashdata('notif', '<div class="alert alert-danger" role="alert">Gagal Kirim Formulir, Silahkan Coba Lagi</div>');
                    redirect('User/formulir');
                }
            } else {

                // INSERT FORMULIR BADAN/INSTANSI
                $scan_ktp_paspor = $this->do_upload($destination, 'scan_ktp_paspor', 'formulir');
                $swafoto_ktp_npwp_skt = $this->do_upload($destination, 'swafoto_ktp_npwp_skt', 'formulir');
                $scan_surat_penunjukan = $this->do_upload($destination, 'scan_surat_penunjukan', 'formulir');
                $scan_npwp_badan_skt = $this->do_upload($destination, 'scan_npwp_badan_skt', 'formulir');
                $scan_npwp_skt_wajib_pajak = $this->do_upload($destination, 'scan_npwp_skt_wajib_pajak', 'formulir');

                if ($jenis_wp == 'Badan Cabang') {
                    $scan_pengangkatan_kantor_cabang = $this->do_upload($destination, 'scan_pengangkatan_kantor_cabang', 'formulir');
                } else {
                    $scan_pengangkatan_kantor_cabang = '';
                }
                //insert db
                $insert = [
                    'jenis_wajib_pajak' => $jenis_wp,
                    'npwp' => $npwp,
                    'nama' => $nama,
                    'nik' => $nik,
                    'tempat_lahir' => $tempat_lahir,
                    'tgl_lahir' => $tgl_lahir,
                    'kewarganegaraan' => $kewarganegaraan,
                    'negara' => $negara,
                    'paspor' => $paspor,
                    'nokitas_kitap' => $nokitas_kitap,
                    'npwp_badan' => $npwp_badan,
                    'nama_badan' => $nama_badan,
                    'telpon' => $telpon,
                    'email' => $email,
                    'scan_ktp_paspor' => $scan_ktp_paspor,
                    'swafoto_ktp_npwp_skt' => $swafoto_ktp_npwp_skt,
                    'scan_surat_penunjukan' => $scan_surat_penunjukan,
                    'scan_npwp_badan_skt' => $scan_npwp_badan_skt,
                    'scan_npwp_skt_wajib_pajak' => $scan_npwp_skt_wajib_pajak,
                    'scan_pengangkatan_kantor_cabang' => $scan_pengangkatan_kantor_cabang,
                    'input_by' => $this->session->userdata('id'),
                    'created_at' => time(),
                    'ip_address' => $this->input->ip_address()
                ];

                if ($this->db->insert('formulir', $insert)) {
                    $this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible fade show" role="alert">Formulir sudah terkirim, EFIN akan dikirim ke email anda!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button></div>');
                    redirect('User');
                } else {
                    $this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Gagal Upload Formulir, Silahkan Coba Lagi!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button></div>');
                    redirect('User/formulir');
                }
            }
        }
    }

    public function poro()
    {
        if ($this->db->get_where('poro', ['input_by' => $this->session->userdata('id')])->num_rows() >= 1) {
            $this->session->set_flashdata('notif', '<div class="alert alert-info alert-dismissible fade show" role="alert"><b>Formulir sudah terkirim</b>, Petugas akan mengecek formulir kemudian EFIN akan dikirim ke email anda! <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button></div>');
            redirect('user');
        }

        $data['title'] = 'Formulir Lupa EFIN';

        $this->form_validation->set_rules('jwp', 'Jenis Wajib Pajak', 'required');
        $this->form_validation->set_rules('npwp', 'NPWP', 'required|trim');
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('telpon', 'No Telpon', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');

        if ($this->form_validation->run() == false) {
            // cek jenis wajib pajak
            $cek_jwp = $this->db->get_where('users', ['id' => $this->session->userdata('id')])->row_array();

            $this->load->view('layouts/head', $data);

            if ($cek_jwp['jenis_wajib_pajak'] == 'Orang Pribadi') {
                $this->load->view('input/poroPerorangan');
            } else {
                $this->load->view('input/poroBadanInstansi');
            }

            $this->load->view('layouts/foot');
        } else {

            // jenis wajib pajak
            $jenis_wp = htmlspecialchars($this->input->post('jwp', true));
            $npwp = htmlspecialchars($this->input->post('npwp', true));
            $nama = htmlspecialchars($this->input->post('nama', true));
            $nik = htmlspecialchars($this->input->post('nik', true));
            $alamat_tempat_tinggal = htmlspecialchars($this->input->post('alamat_tempat_tinggal', true));

            // badan/instansi
            $efin_pengurus = htmlspecialchars($this->input->post('efin_pengurus', true));
            $tlp_pengaju = htmlspecialchars($this->input->post('tlp_pengaju', true));

            // spt tahunan Terakhir
            $tahun = htmlspecialchars($this->input->post('tahun', true));
            $status = htmlspecialchars($this->input->post('status', true));
            $nominal = htmlspecialchars($this->input->post('nominal', true));

            //kontak
            $telpon = htmlspecialchars($this->input->post('telpon', true));
            $email = htmlspecialchars($this->input->post('email', true));

            if ($jenis_wp == 'Orang Pribadi') {

                //insert db
                $insert = [
                    'jenis_wajib_pajak' => $jenis_wp,
                    'npwp' => $npwp,
                    'nama' => $nama,
                    'nik' => $nik,
                    'alamat_tempat_tinggal' => $alamat_tempat_tinggal,
                    'telepon' => $telpon,
                    'email' => $email,
                    'input_by' => $this->session->userdata('id'),
                    'created_at' => time(),
                    'ip_address' => $this->input->ip_address()
                ];

                if ($this->db->insert('poro', $insert)) {
                    $this->session->set_flashdata('notif', '<div class="alert alert-info alert-dismissible fade show" role="alert"><b>Formulir sudah terkirim</b>, Petugas akan mengecek formulir kemudian EFIN akan dikirim ke email anda! <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button></div>');
                    redirect('User');
                } else {
                    $this->session->set_flashdata('notif', '<div class="alert alert-danger" role="alert">Gagal Kirim Formulir, Silahkan Coba Lagi</div>');
                    redirect('User/poro');
                }
            } else {

                //insert db
                $insert = [
                    'jenis_wajib_pajak' => $jenis_wp,
                    'npwp' => $npwp,
                    'nama' => $nama,
                    'efin_pengurus' => $efin_pengurus,
                    'telepon_pengaju' => $tlp_pengaju,
                    'telepon' => $telpon,
                    'email' => $email,
                    'spt_tahun' => $tahun,
                    'spt_nominal' => $nominal,
                    'spt_status' => $status,
                    'input_by' => $this->session->userdata('id'),
                    'created_at' => time(),
                    'ip_address' => $this->input->ip_address()
                ];

                if ($this->db->insert('poro', $insert)) {
                    $this->session->set_flashdata('notif', '<div class="alert alert-info alert-dismissible fade show" role="alert"><b>Formulir sudah terkirim</b>, Petugas akan mengecek formulir kemudian EFIN akan dikirim ke email anda! <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button></div>');
                    redirect('User');
                } else {
                    $this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Gagal Upload Formulir, Silahkan Coba Lagi!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button></div>');
                    redirect('User/poro');
                }
            }
        }
    }

    public function swafoto()
    {
        $data['title'] = 'Swafoto';

        $this->form_validation->set_rules('swafoto', 'Swafoto', 'trim');
        if ($this->form_validation->run() == false) {
            $this->load->view('layouts/head', $data);
            $this->load->view('input/swafoto');
            $this->load->view('layouts/foot');
        } else {
            //destinasi/direktori
            $destination = md5($this->session->userdata('email')) . '/swafoto';
            $swafoto = $this->do_upload($destination, 'swafoto', 'swafoto');
            $this->db->set('swafoto', $swafoto);
            $this->db->where('input_by', $this->session->userdata('id'));
            if ($this->db->update('poro')) {
                $this->session->set_flashdata('notif', '<div class="alert alert-info alert-dismissible fade show" role="alert">Swafoto sudah dikirim, jika data permintaan anda sesuai, maka EFIN akan dikirim ke email anda!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                redirect('user');
            } else {
                $this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Gagal mengirim Swafoto!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                redirect('swafoto');
            }
        }
    }

    //do upload
    private function do_upload($destination, $input_name, $redirect)
    {

        if (!is_dir('./assets/uploads/' . $destination . '/')) {
            mkdir('./assets/uploads/' . $destination . '/', 0777, true);
        }

        $config['upload_path']          = './assets/uploads/' . $destination . '/';
        $config['allowed_types']        = 'pdf|jpg|png|jpeg';
        $config['max_size']             = 5000;
        $config['file_ext_tolower']     = TRUE;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload($input_name)) {
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissible fade show" role="alert">' . $error['error'] . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('User/' . $redirect);
        } else {
            return 'assets/uploads/' . $destination . '/' . $this->upload->data('file_name');
        }
    }
}
