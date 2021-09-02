<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Kolkata");
    }
    function index()
    {
        if ($this->session->userdata('admin_logged_in')) {
            $this->user();
        } else {
            $this->load->view('back/login');
        }
    }
    public function dashboard()
    {
        if ($this->session->userdata('admin_logged_in')) {
            $this->load->view('back/common/header');
            $this->load->view('back/common/sidebar');
            $this->load->view('back/dashboard/home');
            $this->load->view('back/common/footer');
        } else {
            $this->load->view('back/login');
        }
    }
    function user()
    {
        if ($this->session->userdata('admin_logged_in')) {
            $this->load->view('back/common/header');
            $this->load->view('back/common/sidebar');
            $this->load->view('back/user/userList');
            $this->load->view('back/common/footer');
        } else {
            $this->load->view('back/login');
        }
    }
    function getProperty_ajax()
    {
        $cond = '';
        $data = $this->Crud_model->getTableDataWithOrWithoutCondArray('user', $cond);
        // print_r($data);exit;
        $list = array();
        if ($data) {
            $i = 1;
            foreach ($data as $value) {
                $created_By = ($value->f_name . ' ' . $value->l_name);
                $status = ($value->payment_status === '1' ? '<br><small><strong>Payment Id : </strong>' . $value->payment_id . '<br> <strong>Payment Dt : </strong>' . $value->payment_dt . '</small>' : '');
                // print_r($created_By);exit; 
                $list['data'][] = array(
                    $i++,
                    $created_By,
                    $value->email,
                    $value->mobile,
                    $value->f_name === 'Admin' ? '' : '<span class="badge ' . ($value->is_validated === '1' ? 'badge-success' : 'badge-warning') . '">' . ($value->is_validated === '1' ? 'Validated' : 'Pending') . '</span>',
                    $value->f_name === 'Admin' ? '' : '<span class="badge ' . ($value->payment_status === '1' ? 'badge-success' : 'badge-warning') . '">' . ($value->payment_status === '1' ? 'Success</span>' : 'Pending</span><a href="#/' . $value->user_id . '" onclick="paymentStatus('.$value->user_id.')"><i class="fa fa-edit fa-fw" style="font-size:15px;color:green"></i></a>') . '' . $status . '',
                     $value->f_name === 'Admin' ? '' : '<button onClick="' . ($value->status === '1' ? 'do_deactive(' . $value->user_id . ')' : 'do_active(' . $value->user_id . ')') . '" type="button" class="btn ' . ($value->status === '1' ? 'btn-danger' : 'btn-warning') . ' btn-xs mr-2" title="' . ($value->status === '1' ? 'Deactive' : 'Active') . '">' . ($value->status === '1' ? 'Deactive' : 'Active') . '</button>' . ($value->status === '1' ? '' : '<span onclick="deactiveReason(' . $value->user_id . ')" style="cursor: pointer;"><i class="fa fa-info-circle fa-sm text-info"></i></span>') . '<span onclick="deleteUser(' . $value->user_id . ')" style="cursor: pointer font-size:10px;"><i style="cursor: pointer; font-size:11px;"class="fa fa-trash fa-fw"></i></span>'
                );
            }
        }
        echo json_encode($list);
    }
    public function login()
    {
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|callback_check_database');

        if ($this->form_validation->run() == false) {
            $this->load->view('back/login');
        } else {
            redirect('Admin', 'refresh');
        }
    }
    public function check_database($password)
    {
        $username = $this->input->post('username');
        //query the database     
        $result = $this->Auth_model->login($username, $password, 'user');
        // print_r($result->status);
        // exit;
        if ($result) {

            $sess_array = array();
            foreach ($result as $data) {
                if($data->user_id==1){
                $sess_array = array(
                    'id' => $data->user_id,
                    'username' => $data->f_name,
                    'email' => $data->email
                );
                $this->session->set_userdata('admin_logged_in', $sess_array);
                 return TRUE;
                } else {
                    $this->form_validation->set_message('check_database', 'Invalid username or password');
                       return FALSE;
                }
            }
           
        } else {
            $this->form_validation->set_message('check_database', 'Invalid username or password');
            return FALSE;
        }
    }
    public function check_userStatus()
    {
        $user_id = $this->input->post('user_id');
        $cond = array(
            'user_id' => $user_id
        );
        // print_r($cond);
        $lastid = $this->Crud_model->getTableDataWithOrWithoutCondArray('user', $cond);
        echo json_encode($lastid);
    }
    
      public function delete_user()
    {
        $user_id = $this->input->post('user_id');
        $cond = array(
            'user_id' => $user_id
        );
        $data = $this->Crud_model->delete_dataIntoTable('user', $cond);
        echo json_encode($data);
    }
    
    public function updateStatus()
    {
        $user_id = $this->input->post('user_id');
        $status = $this->input->post('status');
        $reason = $this->input->post('reason');
        $data = array(
            'status' => $status,
            'deactive_reason' => $reason
        );

        // print_r($user_id);
        $lastid = $this->Crud_model->updateData('user', $data, array('user_id' => $user_id));

        echo json_encode($lastid);
    }
    function getUserByOTP_ajax()
    {
        $is_validated = $this->input->post('is_validated');
        //    print_r($is_validated);
        $cond = array(
            'is_validated' => $is_validated
        );
        $data = $this->Crud_model->getTableDataWithOrWithoutCondArray('user', $cond);
        $list = array();
        if (!empty($data)) {
            
            $i = 1;
            foreach ($data as $value) {
                $created_By = ($value->f_name . ' ' . $value->l_name);
                $status = ($value->payment_status === '1' ? '<br><small><strong>Payment Id : </strong>' . $value->payment_id . '<br> <strong>Payment Dt : </strong>' . $value->payment_dt . '</small>' : '');
                // print_r($created_By);exit; 
                $list['data'][] = array(
                    $i++,
                    $created_By,
                    $value->email,
                    $value->mobile,
                    $value->f_name === 'Admin' ? '' : '<span class="badge ' . ($value->is_validated === '1' ? 'badge-success' : 'badge-warning') . '">' . ($value->is_validated === '1' ? 'Validated' : 'Pending') . '</span>',
                    $value->f_name === 'Admin' ? '' : '<span class="badge ' . ($value->payment_status === '1' ? 'badge-success' : 'badge-warning') . '">' . ($value->payment_status === '1' ? 'Success' : 'Pending') . '</span>' . $status . '',
                    $value->f_name === 'Admin' ? '' : '<button onClick="' . ($value->status === '1' ? 'do_deactive(' . $value->user_id . ')' : 'do_active(' . $value->user_id . ')') . '" type="button" class="btn ' . ($value->status === '1' ? 'btn-danger' : 'btn-warning') . ' btn-xs mr-2" title="' . ($value->status === '1' ? 'Deactive' : 'Active') . '">' . ($value->status === '1' ? 'Deactive' : 'Active') . '</button>' . ($value->status === '1' ? '' : '<span onclick="deactiveReason(' . $value->user_id . ')" style="cursor: pointer;"><i class="fa fa-info-circle fa-sm text-info"></i></span>') . ''
                );
            }
           
        }
        echo json_encode($list);
    }
    function getUserByPaymentStatus_ajax()
    {
        $payment_status = $this->input->post('payment_status');
        // print_r($payment_status);
        $cond = array(
            'payment_status' => $payment_status
        );
        $data = $this->Crud_model->getTableDataWithOrWithoutCondArray('user', $cond);
        $list = array();
        if (!empty($data)) {
            
            $i = 1;
            foreach ($data as $value) {
                $created_By = ($value->f_name . ' ' . $value->l_name);
                $status = ($value->payment_status === '1' ? '<br><small><strong>Payment Id : </strong>' . $value->payment_id . '<br> <strong>Payment Dt : </strong>' . $value->payment_dt . '</small>' : '');
                // print_r($created_By);exit; 
                $list['data'][] = array(
                    $i++,
                    $created_By,
                    $value->email,
                    $value->mobile,
                    $value->f_name === 'Admin' ? '' : '<span class="badge ' . ($value->is_validated === '1' ? 'badge-success' : 'badge-warning') . '">' . ($value->is_validated === '1' ? 'Validated' : 'Pending') . '</span>',
                    $value->f_name === 'Admin' ? '' : '<span class="badge ' . ($value->payment_status === '1' ? 'badge-success' : 'badge-warning') . '">' . ($value->payment_status === '1' ? 'Success' : 'Pending') . '</span>' . $status . '',
                    $value->f_name === 'Admin' ? '' : '<button onClick="' . ($value->status === '1' ? 'do_deactive(' . $value->user_id . ')' : 'do_active(' . $value->user_id . ')') . '" type="button" class="btn ' . ($value->status === '1' ? 'btn-danger' : 'btn-warning') . ' btn-xs mr-2" title="' . ($value->status === '1' ? 'Deactive' : 'Active') . '">' . ($value->status === '1' ? 'Deactive' : 'Active') . '</button>' . ($value->status === '1' ? '' : '<span onclick="deactiveReason(' . $value->user_id . ')" style="cursor: pointer;"><i class="fa fa-info-circle fa-sm text-info"></i></span>') . ''
                );
            }
           
        }
        echo json_encode($list);
    }
    function logout()
    {
        $this->session->unset_userdata('admin_logged_in');
        session_destroy();
        redirect('Admin', 'refresh');
    }
    
    // to get payment details by id(By JR,1-9-21)   
    function updatePaymentStatus()
    {
        $user_id = $this->input->post('user_id');
        $payment_amt = $this->input->post('payment_amt');
        $payment_id = $this->input->post('payment_id');
        $payment_status = $this->input->post('payment_status');
        $payment_dt = date("Y-m-d h:i:s");
        // echo $payment_dt;exit;
        $data = array(
            'payment_amt' => $payment_amt,
            'payment_id' => $payment_id,
            'payment_status' => $payment_status,
            'payment_dt' => $payment_dt,
        );
        $data = $this->Crud_model->updateData('user', $data, array('user_id' => $user_id));
        // print_r($data);
        return $this->user();
    }



}
