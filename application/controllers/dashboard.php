<?php
defined('BASEPATH') or exit('No direct script access allowed');

use BaconQrCode\Encoder\QrCode;

class Dashboard extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		if (!$this->session->has_userdata('user'))
			redirect(base_url());
	}

	public function index()
	{
		$this->page('dashboard');
	}

	public function get_time_records()
	{
		$this->load->model('TimeRecordModel');
		$data = array(
			"data" => $this->TimeRecordModel->get_all_time_records()
		);

		$json_data = json_encode($data);

		$this->output
			->set_content_type('application/json')
			->set_output($json_data);
	}

	public function get_time_record($id)
	{
		$this->load->model('TimeRecordModel');
		$data = array(
			"data" => $this->TimeRecordModel->get_time_records($id)
		);

		$json_data = json_encode($data);

		$this->output
			->set_content_type('application/json')
			->set_output($json_data);
	}

	public function scan()
	{
		$this->page('scan');
	}

	public function scan_qr($id)
	{
		$this->load->model('TimeRecordModel');
		$this->load->model('EmployeeModel');

		$check = $this->EmployeeModel->get_by_id($id);

		if ($check) {
			$this->TimeRecordModel->record_time_in_out($id, $this->session->userdata('user')->id);

			$data = $this->TimeRecordModel->get_current_time_records($id);
			$json_data = json_encode($data);

			$this->output
				->set_content_type('application/json')
				->set_output($json_data);
		} else {
			$this->output
				->set_content_type('application/json')
				->set_output(json_encode([
					'error' => true
				]));
		}
	}
}