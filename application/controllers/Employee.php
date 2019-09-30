<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model('Employee_m','m');
    }

	public function index()
	{
        $this->load->view('layout/header');
        $this->load->view('employee/index');
        $this->load->view('layout/footer');
    }
    
    public function showAllEmployee(){
        $result = $this->m->getAllEmployee();
        echo json_encode($result);
    }

    public function addEmployee(){
        $result = $this->m->addNewEmployee();
        $msg['success'] = false;
        if($result){
            $msg['success'] = true;
        }
        echo json_encode($msg);
    }

    public function editEmployee(){
        $result = $this->m->editEmployee();
        echo json_encode($result);
    }

    public function updateEmployee(){
        $result = $this->m->updateEmp();
        $msg['success'] = false;
        if($result){
            $msg['success'] = true;
        }
        echo json_encode($msg);
    }

    public function deleteEmployee(){
        $result = $this->m->deleteEmp();
        $msg['success'] = false;
        if($result){
            $msg['success'] = true;
        }
        echo json_encode($msg);
    }
}
?>