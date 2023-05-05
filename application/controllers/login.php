<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('UserModel');
  }

  public function index()
  {
    if ($this->input->post('username') && $this->input->post('password')) {
      $user_name = $this->input->post('username');
      $password = $this->input->post('password');

      $user = $this->UserModel->login($user_name, $password);
      if ($user) {
        $this->session->set_userdata('user', $user);
        return redirect('/dashboard');
      } else {
        $this->session->set_flashdata('error', 'Invalid login credentials');
        redirect('/');
      }
    } else {
      $this->page('login');
    }
  }

  public function logout()
  {
    $this->session->unset_userdata('user');
    redirect('login');
  }

}