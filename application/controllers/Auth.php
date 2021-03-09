<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        if ($this->session->userdata('id')) {
            redirect('beranda');
        }
    }

    public function index()
    {
        $data['title'] = 'Halaman Login';

        $this->form_validation->set_rules('email', 'Email', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');
        $this->form_validation->set_rules('g-recaptcha-response', 'Recaptcha Response', 'required|callback_validate_captcha');
        $this->form_validation->set_message('validate_captcha', 'Please check the captcha');

        if ($this->form_validation->run() == false) {
            $this->load->view('auth/layouts/head', $data);
            $this->load->view('auth/login');
            $this->load->view('auth/layouts/foot');
        } else {

            // set variabel 
            $email = $this->input->post('email');
            $password = $this->input->post('password');

            $user = $this->db->where('email', $email)->get('users')->row_array();
            //ngecek user
            if ($user) {
                if (password_verify($password, $user['password'])) {
                    if ($user['status'] == 'active') {

                        // set sesi
                        $sesi = [
                            'id' => $user['id'],
                            'nama' => $user['name'],
                            'email' => $user['email'],
                            'role' => $user['role']
                        ];
                        $this->session->set_userdata($sesi);

                        //update ip, login_at user by id
                        $this->db->set('ip_address', $this->input->ip_address());
                        $this->db->set('login_at', time());
                        $this->db->where('id', $user['id']);
                        $this->db->update('users');

                        // redirect berdasarkan role
                        if ($user['role'] == 'admin') {
                            redirect('beranda');
                        } else {
                            redirect('user');
                        }
                    } else {
                        $this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Akun belum di aktivasi!<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                        redirect('login');
                    }
                } else {
                    $this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Password anda salah!<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                    redirect('login');
                }
            } else {
                $this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Email tidak ditemukan! <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                redirect('login');
            }
        }
    }

    public function register()
    {
        $data['title'] = 'Halaman Registrasi';

        $this->form_validation->set_rules('name', 'Nama', 'required|trim');
        $this->form_validation->set_rules('npwp', 'NPWP', 'required|trim|numeric|is_unique[users.email]');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('phone', 'Telepon', 'required|trim');
        $this->form_validation->set_rules('identitaswp', 'Identitas Wajib Pajak', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]');
        $this->form_validation->set_rules('repassword', 'Konfirmasi Password', 'required|matches[password]');
        $this->form_validation->set_rules('g-recaptcha-response', 'Recaptcha Response', 'required|callback_validate_captcha');
        $this->form_validation->set_message('validate_captcha', 'Please check the captcha');

        if ($this->form_validation->run() == false) {
            $this->load->view('auth/layouts/head', $data);
            $this->load->view('auth/register');
            $this->load->view('auth/layouts/foot');
        } else {

            $cekrole = $this->db->where('role', 'admin')->get('users')->num_rows();

            $register = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'telepon' => htmlspecialchars($this->input->post('phone', true)),
                'npwp' => htmlspecialchars($this->input->post('npwp', true)),
                'role' => $cekrole < 1 ? 'admin' : 'user',
                'identitas_wajib_pajak' => htmlspecialchars($this->input->post('identitaswp', true)),
                'password' => password_hash($this->input->post('password', true), PASSWORD_DEFAULT),
                'created_at' => time(),
                'ip_address' => $this->input->ip_address()
            ];

            if ($this->db->insert('users', $register)) {

                $token = base64_encode(random_bytes(50));
                $set = [
                    'email' => $register['email'],
                    'type' => 'aktivasi',
                    'token' => $token
                ];

                $this->_sendEmail($set);
                $this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Registrasi Berhasil,</strong> Silahkan cek email anda untuk aktivasi akun!<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                redirect('Auth');
            } else {
                redirect('Auth/register');
                $this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Registrasi Gagal!</strong><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
            }
        }
    }

    public function loginEmail()
    {
        $data['title'] = 'Login Dengan Email';

        //set rules
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('g-recaptcha-response', 'Recaptcha Response', 'required|callback_validate_captcha');
        $this->form_validation->set_message('validate_captcha', 'Please check the captcha');
        if ($this->form_validation->run() == false) {
            //if form not run
            $this->load->view('auth/layouts/head', $data);
            $this->load->view('auth/emailLogin');
            $this->load->view('auth/layouts/foot');
        } else {

            $email = $this->input->post('email');

            //check email
            $check_email = $this->db->get_where('users', ['email' => $email])->row_array();
            if ($check_email) {

                if ($check_email['status'] == 'active') {
                    //cek token dulu apa sudah ada?
                    $check_token = $this->db->get_where('user_token', ['email' => $email])->row_array();
                    if ($check_token) {

                        //apakah token masih aktif?
                        if (time() - $check_token['created_at'] < (60 * 60 * 3)) {
                            $this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible fade show" role="alert">Silahkan Cek Email Anda, Kami sudah mengirimkan link untuk login<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                            redirect('login_email');
                        } else {
                            $this->db->delete('user_token', ['email' => $email]);
                        }
                    }

                    // set variabel value
                    $token = base64_encode(random_bytes(50));
                    $set = [
                        'email' => $email,
                        'type' => 'login',
                        'token' => $token
                    ];

                    if ($this->_sendEmail($set) == 'success') {
                        $this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible fade show" role="alert">Silahkan Cek Email Anda, Kami sudah mengirimkan link untuk login<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                        redirect('login_email');
                    } else {
                        $this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Proses pengiriman link login ke email gagal!</strong><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                        redirect('login_email');
                    }
                } else {
                    $this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Akun belum aktif, tidak dapat login lewat email!</strong><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                    redirect('login_email');
                }
            } else {
                $this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Email belum terdaftar!<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                redirect('login_email');
            }
        }
    }

    function validate_captcha()
    {
        $recaptcha = trim($this->input->post('g-recaptcha-response'));
        $userIp = $this->input->ip_address();
        $secret = '6Lfgl3caAAAAAIbqCreJjv6pt4XXufs6gipQHjjc';
        $data = array(
            'secret' => "$secret",
            'response' => "$recaptcha",
            'remoteip' => "$userIp"
        );

        $verify = curl_init();
        curl_setopt($verify, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
        curl_setopt($verify, CURLOPT_POST, true);
        curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($verify, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($verify);
        $status = json_decode($response, true);
        if (empty($status['success'])) {
            $this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Verifikasi Captcha Gagal!<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    private function _sendEmail($param = '')
    {

        $config = [
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'sistem.etpt@gmail.com',
            'smtp_pass' => '123sistem123',
            'smtp_port' => 587,
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n"

        ];

        $this->load->library('email', $config);

        $this->email->from('pembuattesting@gmail.com', 'Sistem ' . $param['type'] . ' e-tpt');
        $this->email->to($param['email']);
        $this->email->subject('Link ' . $param['type']);
        $this->email->set_mailtype('html');

        if ($param['type'] == 'login') {
            $data['url'] = base_url() . 'auth/verify?email=' . urlencode($param['email']) . '&token=' . urlencode($param['token']) . '&type=login';
            $this->email->message($this->load->view('email/login', $data, true));
        } else {
            $data['url'] = base_url() . 'auth/verify?email=' . urlencode($param['email']) . '&token=' . urlencode($param['token']) . '&type=aktivasi';
            $this->email->message($this->load->view('email/aktivasi', $data, true));
        }



        if ($this->email->send()) {
            $insert_token = [
                'email' => $param['email'],
                'token' => $param['token'],
                'type' => $param['type'],
                'created_at' => time(),
                'ip_address' => $this->input->ip_address()
            ];

            $this->db->insert('user_token', $insert_token);

            return 'success';
        } else {
            return 'gagal';
        }
    }

    public function verify()
    {
        $email = urldecode($this->input->get('email'));
        $type = urldecode($this->input->get('type'));
        $token = str_replace(' ', '+', urldecode($this->input->get('token')));


        if ($type == 'aktivasi') {
            //cek
            $check_email = $this->db->get_where('user_token', ['email' => $email, 'type' => $type])->row_array();
            if ($check_email) {
                if ($check_email['token'] == $token) {
                    if (time() - $check_email['created_at'] < (60 * 60 * 3)) {

                        $this->db->set('status', 'active');
                        $this->db->where('email', $email);
                        $this->db->update('users');
                        $this->db->delete('user_token', ['email' => $email]);
                        $this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible fade show" role="alert"><b>Aktivasi Berhasil</b>, silahkan login!<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                        redirect('login');
                    } else {
                        $this->db->delete('user_token', ['email' => $email]);
                        $this->db->delete('users', ['email' => $email]);
                        $this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Token Expired!, Silahkan registrasi ulang!<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                        redirect('login');
                    }
                } else {
                    $this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Gagal aktivasi akun! <b>Token tidak sesuai</b>' . $token . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                    redirect('login');
                }
            } else {
                $this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Gagal aktivasi akun!</b><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                redirect('login');
            }
        } else {
            //cek
            $check_email = $this->db->get_where('user_token', ['email' => $email, 'type' => $type])->row_array();
            if ($check_email) {
                if ($check_email['token'] == $token) {
                    if (time() - $check_email['created_at'] < (60 * 60 * 3)) {

                        //bikin session
                        $user = $this->db->where('email', $email)->get('users')->row_array();

                        // set sesi
                        $sesi = [
                            'id' => $user['id'],
                            'nama' => $user['name'],
                            'email' => $user['email'],
                            'role' => $user['role']
                        ];
                        $this->session->set_userdata($sesi);

                        //update ip, login_at user by id
                        $this->db->set('ip_address', $this->input->ip_address());
                        $this->db->set('login_at', time());
                        $this->db->where('id', $user['id']);
                        $this->db->update('users');

                        // redirect berdasarkan role
                        if ($user['role'] == 'admin') {
                            $this->db->delete('user_token', ['email' => $email]);
                            redirect('beranda');
                        } else {
                            $this->db->delete('user_token', ['email' => $email]);
                            redirect('user');
                        }
                    } else {
                        $this->db->delete('user_token', ['email' => $email]);
                        $this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Token Expired!<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                        redirect('login_email');
                    }
                } else {
                    $this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Gagal login lewat link! <b>Token tidak sesuai</b><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                    redirect('login');
                }
            } else {
                $this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Gagal login lewat link! <b>Email tidak sesuai</b><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                redirect('login');
            }
        }
    }
}
