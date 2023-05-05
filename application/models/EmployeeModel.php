<?php

class EmployeeModel extends CI_Model {

    public function get_all()
    {
        $this->db->select('employees.*, users.user_name as created_by_name');
        $this->db->join('users', 'employees.created_by = users.id');
        $query = $this->db->get('employees');
        return $query->result();
    }

    public function get_by_id($id)
    {
        $query = $this->db->get_where('employees', array('id' => $id));
        return $query->row();
    }

    public function insert($data)
    {
        $this->db->insert('employees', $data);
        return $this->db->insert_id();
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('employees', $data);
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('employees');
    }

}
