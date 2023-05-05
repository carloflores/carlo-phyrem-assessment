<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Employees extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->has_userdata('user'))
            redirect(base_url());

        $this->load->model('EmployeeModel');
    }

    public function index()
    {
        $employees = $this->EmployeeModel->get_all();
        $data['employees'] = $employees;
        $this->page('employee_list', $data);
    }

    public function create()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('first_name', 'First Name', 'required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'required');

        if ($this->form_validation->run() == false) {

            $this->page('employee_form');
        } else {
            $data = [
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'created_by' => $this->session->userdata('user')->id
            ];

            $this->EmployeeModel->insert($data);
            redirect('employees');
        }
    }

    public function edit($id)
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('first_name', 'First Name', 'required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'required');

        if ($this->form_validation->run() == false) {
            $data['employee'] = $this->EmployeeModel->get_by_id($id);
            $this->page('employee_form', $data);
        } else {
            $data = [
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
            ];

            $this->EmployeeModel->update($id, $data);
            redirect('employees');
        }
    }

    public function delete($id)
    {
        $this->EmployeeModel->delete($id);
        redirect('employees');
    }

    public function delete_multiple()
    {
        $ids = $this->input->post('ids');

        if (count($ids) > 0) {
            foreach ($ids as $id) {
                $this->EmployeeModel->delete($id);
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