<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee_m extends CI_Model{

    public function getAllEmployee(){
        $this->db->order_by('created_at','desc');
        $query = $this->db->get('employees');
        if($query->num_rows()>0){
            return $query->result();
        }else{
            return false;
        }
    }

    public function addNewEmployee(){
        $field = array(
            'emp_name'=>$this->input->post('emp_name'),
            'address'=>$this->input->post('emp_address'),
            'created_at'=>date('Y-m-d H:i:s')
        );

        $this->db->insert('employees',$field);

        if($this->db->affected_rows()>0){
            return true;
        }else{
            return false;
        }
    }

    public function editEmployee(){
        $id = $this->input->get('id');
        $this->db->where('id',$id);
        $query = $this->db->get('employees');
        if($query->num_rows()>0){
            return $query->row();
        }else{
            return false;
        }
    }

    public function updateEmp(){
        $id = $this->input->post('emp_id');
        $field = array(
            'emp_name'=>$this->input->post('emp_name'),
            'address'=>$this->input->post('emp_address'),
            'updated_at'=>date('Y-m-d H:i:s')
        );
        $this->db->where('id',$id);
        $this->db->update('employees',$field);
        if($this->db->affected_rows()>0){
            return true;
        }else{
            return false;
        }
    }

    public function deleteEmp(){
        $id = $this->input->get('emp_id');
        $this->db->where('id',$id);
        $this->db->delete('employees');
        if($this->db->affected_rows()>0){
            return true;
        }else{
            return false;
        }
    }
}
?>