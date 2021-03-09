<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Profile extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->library('form_validation');
    if (empty($this->session->userdata('id'))) {
      redirect('login');
    }
  }

  public function index()
  {
    $data['title'] = 'Profile';

    $data['profile'] = $this->db->get_where('users', ['id' => $this->session->userdata('id')])->row_array();

    $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]');
    $this->form_validation->set_rules('repassword', 'Konfirmasi Password', 'required|matches[password]');

    if ($this->form_validation->run() == false) {
      $this->load->view('layouts/head', $data);
      $this->load->view('show/profile', $data);
      $this->load->view('layouts/foot');
    } else {
      $this->db->set('password', password_hash($this->input->post('password', true), PASSWORD_DEFAULT));
      $this->db->where('id', $this->session->userdata('id'));

      if ($this->db->update('users')) {
        $this->session->set_flashdata('notif', '<div class="alert alert-success" role="alert">Password berhasil diubah!</div>');
        redirect('profile');
      } else {
        $this->session->set_flashdata('notif', '<div class="alert alert-danger" role="alert">Gagal mengubah password!</div>');
        redirect('profile');
      }
    }
  }
}
