<?php

class UserModel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_all_users() {
        $query = $this->db->get('users');
        return $query->result_array();
    }

    public function get_user($user_id) {
        $query = $this->db->get_where('users', array('id' => $user_id));
        return $query->row_array();
    }

    public function create_user($user_data) {
        $this->db->insert('users', $user_data);
        return $this->db->insert_id();
    }

    public function update_user($user_id, $user_data) {
        $this->db->where('id', $user_id);
        $this->db->update('users', $user_data);
    }

    public function delete_user($user_id) {
        $this->db->where('id', $user_id);
        $this->db->delete('users');
    }

    public function login($user_name, $password) {
        
        $this->db->where('user_name', $user_name);
        $query = $this->db->get('users');

        if ($query->num_rows() == 1) {
            $user = $query->row();
            if (password_verify($password, $user->user_password)) {
                return $user;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}