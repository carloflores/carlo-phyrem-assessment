<?php

class TimeRecordModel extends CI_Model
{

	public function get_time_records($employee_id)
	{
		$this->db->select('
			DATE(employee_time_records.date_added) as date_added,
			MAX(employee_time_records.time_out) as time_out,
			MIN(employee_time_records.time_in) as time_in,
			employees.id as id,
			employees.first_name,
			employees.last_name,
			users.user_name
		');
		$this->db->from('employee_time_records');
		$this->db->join('employees', 'employees.id = employee_time_records.employee_id', 'left');
		$this->db->join('users', 'users.id = employees.created_by', 'left');
		$this->db->where('employee_time_records.employee_id', $employee_id);
		$this->db->group_by('DATE(employee_time_records.date_added), employees.id, employees.first_name, employees.last_name, users.user_name');
		$this->db->order_by('date_added', 'DESC');
		$query = $this->db->get();
		return $query->result();
	}


	public function get_all_time_records()
	{
		$this->db->select('
			DATE(employee_time_records.date_added) as date_added,
			MAX(employee_time_records.time_out) as time_out,
			MIN(employee_time_records.time_in) as time_in,
			employees.id as id,
			employees.first_name,
			employees.last_name,
			users.user_name
		');
		$this->db->from('employee_time_records');
		$this->db->join('employees', 'employees.id = employee_time_records.employee_id', 'left');
		$this->db->join('users', 'users.id = employees.created_by', 'left');
		$this->db->group_by('DATE(employee_time_records.date_added), employees.id, employees.first_name, employees.last_name, users.user_name');
		$this->db->order_by('date_added', 'DESC');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_current_time_records($employee_id)
	{
		$this->db->select('e.first_name, e.last_name, etr.date_added, MIN(etr.time_in) AS time_in, MAX(etr.time_out) AS time_out');
		$this->db->from('employee_time_records etr');
		$this->db->join('employees e', 'e.id = etr.employee_id', 'inner');
		$this->db->where('etr.employee_id', $employee_id);
		$this->db->order_by('etr.date_added', 'desc');
		$this->db->limit(1);
		$this->db->group_by('etr.date_added');
		$query = $this->db->get();
		return $query->row_array();
	}



	public function record_time_in_out($employee_id)
	{
		// Get the current date
		$date_added = date('Y-m-d');

		// Check if there is an existing time record for the employee on the current date
		$existing_record = $this->db->get_where('employee_time_records', array('employee_id' => $employee_id, 'date_added' => $date_added))->row();

		if ($existing_record) {
			// Update the existing time record with the time out
			$data = array(
				'time_out' => date('Y-m-d H:i:s')
			);
			$this->db->where('id', $existing_record->id);
			$this->db->update('employee_time_records', $data);
		} else {
			// Create a new time record with the time in
			$data = array(
				'employee_id' => $employee_id,
				'date_added' => $date_added,
				'time_in' => date('Y-m-d H:i:s')
			);
			$this->db->insert('employee_time_records', $data);
		}
	}


}