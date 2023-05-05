<?php

class Users extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('UserModel');


        if (!$this->session->has_userdata('user'))
            redirect(base_url());

        if ($this->session->userdata('user')->user_type != 1)
            show_404();
    }

    public function index()
    {
        $data['users'] = $this->UserModel->get_all_users();
        $this->page('user_list', $data);
    }

    public function view($user_id)
    {
        $data['user'] = $this->UserModel->get_user($user_id);
        $this->page('user_view', $data);
    }

    public function create()
    {
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $user_data = array(
                'user_name' => $this->input->post('user_name'),
                'user_password' => password_hash($this->input->post('user_password'), PASSWORD_DEFAULT),
                'user_type' => $this->input->post('user_type'),
                'datetime_added' => date('Y-m-d H:i:s')
            );
            $this->UserModel->create_user($user_data);
            redirect('users');
        } else {
            $this->page('user_form');
        }
    }

    public function update($user_id)
    {
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $user_data = array(
                'user_name' => $this->input->post('user_name'),
                'user_type' => $this->input->post('user_type'),
                'datetime_modified' => date('Y-m-d H:i:s')
            );

            if ($this->input->post('user_password') !== null) {
                $user_data['user_password'] = password_hash($this->input->post('user_password'), PASSWORD_DEFAULT);
            }

            $this->UserModel->update_user($user_id, $user_data);
            redirect('users');
        } else {
            $data['user'] = $this->UserModel->get_user($user_id);
            $this->page('user_form', $data);
        }
    }

    public function delete($user_id)
    {
        $this->UserModel->delete_user($user_id);
        redirect('users');
    }

    public function delete_multiple()
    {
        $ids = $this->input->post('ids');

        if (count($ids) > 0) {
            foreach ($ids as $id) {
                $this->UserModel->delete_user($id);
            }
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    "success" => true
                ]));
        } else {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    "success" => false
                ]));
        }
    }
}