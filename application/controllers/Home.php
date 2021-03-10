<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->library('form_validation');
		if (empty($this->session->userdata('id'))) {
			redirect('login');
		}

		if ($this->session->userdata('role') != 'admin') {
			redirect('user');
		}
	}
	public function index()
	{
		$data['title'] = 'Beranda';
		$data['total'] = $this->db->get_where('users', ['role' => 'user'])->num_rows();

		// belum menerima efin aktivasi
		$data['aktivasi'] = $this->db->get('formulir')->result_array();
		$data['total_aktivasi'] = $this->db->get('formulir')->num_rows();

		// belum menerima efin lupa
		$data['lupa_efin'] = $this->db->get('poro')->result_array();
		$data['total_lupa'] = $this->db->get('poro')->num_rows();

		$this->load->view('layouts/head', $data);
		$this->load->view('index', $data);
		$this->load->view('layouts/foot');
	}

	public function list_user()
	{
		$data['title'] = 'Daftar Pengguna';
		$data['list_users'] = $this->db->where('role', 'user')->get('users')->result_array();

		$this->load->view('layouts/head', $data);
		$this->load->view('show/list_users', $data);
		$this->load->view('layouts/foot');
	}

	public function detail_user($id = '')
	{

		if ($id == '') {
			show_404();
		}

		$data['title'] = 'Detail Pengguna';

		$this->db->where('id', $id);
		$user = $this->db->get('users')->row_array();

		if (!$user) {
			show_404();
		}

		$form = $this->db->where('input_by', $user['id'])->get('formulir')->row_array();

		if (!$form) {
			$data['efin'] = null;
		} else {

			$efin = $this->db->where('id_formulir', $form['id'])->get('efin')->row_array();
			if (!$efin) {
				$data['efin'] = null;
			} else {
				$data['efin'] = $efin['efin'];
			}
		}
		$data['user'] = $user;

		$this->load->view('layouts/head', $data);
		$this->load->view('show/detail_user', $data);
		$this->load->view('layouts/foot');
	}

	public function lihat_poro($id = '')
	{

		$data['title'] = 'Formulir Pemohon Lupa Efin';

		$data['data'] = $this->db->where('id', $id)->get('poro')->row_array();

		if (!$data['data']) {
			show_404();
		}

		$this->load->view('layouts/head', $data);
		$this->load->view('show/poro', $data);
		$this->load->view('layouts/foot');
	}

	public function lihat_formulir($id = '')
	{

		$data['title'] = 'Formulir Pemohon';

		$data['data'] = $this->db->where('id', $id)->get('formulir')->row_array();

		if (!$data['data']) {
			show_404();
		}

		$data['efin'] = $this->db->where('id_formulir', $data['data']['id'])->get('efin')->row_array();

		$this->load->view('layouts/head', $data);
		$this->load->view('show/formulir', $data);
		$this->load->view('layouts/foot');
	}

	public function insertefin()
	{
		$this->form_validation->set_rules('efin', 'EFIN', 'required|trim');
		$this->form_validation->set_rules('idform', 'IdFormulir', 'required|trim');
		$this->form_validation->set_rules('type', 'Type', 'required|trim');
		$this->form_validation->set_rules('user_id', 'User ID', 'required|trim');
		if ($this->form_validation->run() == false) {
			redirect('home');
		} else {

			$insert = [
				'efin' => 1,
				'id_formulir' => htmlspecialchars($this->input->post('idform', true)),
				'type' => htmlspecialchars($this->input->post('type', true)),
				'user_id' => htmlspecialchars($this->input->post('user_id', true)),
				'input_by' => $this->session->userdata('id'),
				'created_at' => time(),
				'ip_address' => $this->input->ip_address()
			];

			$form = $this->db->where('id', $insert['id_formulir'])->get($insert['type'])->row_array();
			$email = $this->db->where('id', $form['input_by'])->get('users')->row_array();

			$param = [
				'email' => $email['email'],
				'efin' => htmlspecialchars($this->input->post('efin', true)),
				'type' => 'EFIN'
			];

			if ($this->db->insert('efin', $insert)) {

				if ($this->_sendEmail($param)) {
					$this->session->set_flashdata('notif', '<div class="alert alert-success" role="alert">EFIN Berhasil Di Kirim Ke Email Pemohon</div>');
					$this->db->where('id', $insert['id_formulir']);
					$this->db->delete($insert['type']);
					delete_files('./assets/uploads/' . md5($email['email']) . '/' . ($insert['type'] == 'poro' ? 'swafoto' : 'formulir'));
					rmdir('./assets/uploads/' . md5($email['email']) . '/' . ($insert['type'] == 'poro' ? 'swafoto' : 'formulir'));
					redirect('home');
				} else {
					$this->session->set_flashdata('notif', '<div class="alert alert-danger" role="alert">EFIN Tidak Terkirim</div>');
				}
			} else {
				$this->session->set_flashdata('notif', '<div class="alert alert-danger" role="alert">EFIN Tidak Tersimpan</div>');
				redirect('home');
			}
		}
	}

	public function permintaan_swafoto($id)
	{
		$data = $this->db->get_where('poro', ['id' => $id])->row_array();

		$param = [
			'email' => $data['email'],
			'type' => 'Permintaan Swafoto'
		];


		if ($this->_sendEmail($param)) {
			$this->db->set('swafoto', 'diminta')->where('id', $id)->update('poro');
			$this->session->set_flashdata('notif', '<div class="alert alert-success" role="alert">Permintaan Swafoto berhasil dikirim ke Email Pemohon</div>');
			redirect('Home');
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

		$this->email->from('sistem.etpt@gmail.com', 'Sistem e-tpt');
		$this->email->to($param['email']);
		$this->email->subject($param['type']);
		$this->email->set_mailtype('html');

		if ($param['type'] == 'EFIN') {
			$data['efin'] = $param['efin'];
			$this->email->message($this->load->view('email/efin', $data, true));
		} else {
			$data['url'] = base_url('User/swafoto');
			$this->email->message($this->load->view('email/swafoto', $data, true));
		}


		if ($this->email->send()) {
			return 'success';
		} else {
			return 'gagal';
		}
	}

	public function download($id, $file, $type)
	{
		$url = $this->db->get_where($type, ['id' => $id])->row_array();
		$this->load->helper('download');
		force_download($url[$file], NULL);
	}

	function delete_files($target)
	{
		if (is_dir($target)) {
			$files = glob($target . '*', GLOB_MARK); //GLOB_MARK adds a slash to directories returned

			foreach ($files as $file) {
				delete_files($file);
			}

			rmdir($target);
		} elseif (is_file($target)) {
			unlink($target);
		}
	}
}
