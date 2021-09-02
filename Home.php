<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Kolkata");

        $this->config_smtp = array(
            'protocol' => 'smtp',
            'smtp_host' => 'mail.mojsk.in',
            'smtp_port' => 587,
            'smtp_user' => 'support@mojsk.in',
            'smtp_pass' => 'XI&%(cioOVHv',
            'mailtype'  => 'html',
            'charset'   => 'iso-8859-1',
            'newline' => "\r\n",
            'validation' => true,
        );
    }

    function index()
    {
        $this->hindex();
    }

    function send_mail($to = '', $from = '', $replyTo = '', $subject = '', $message = '')
    {
        $headers = 'From: <support@mojsk.in>';
        $sent=mail($to,$subject,$message,$headers);
        
        return true;
        
        // $config = $this->config_smtp;
        // $this->email->initialize($config);
        // $this->email->from($from, 'MOJSK');
        // $this->email->to($to);
        // $this->email->reply_to($replyTo);
        // $this->email->subject($subject);
        // $this->email->message($message);

        // if ($this->email->send()) {
        //     // $result = 1 ;
        //     return true;
        // } else {
        //     show_error($this->email->print_debugger());
        //     return false;
        // }
        // // echo $result;
    }

    public function login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $cond = array(
            'email' => $email,
            'password' => base64_encode($password),
            'status' => 1
        );
        // print_r($cond);
        $lastid = $this->Crud_model->getTableDataWithOrWithoutCondArray('user', $cond);
        $result =  json_encode($lastid);

        if ($result) {
            $isValid = 0;
            $sess_array = array();
            foreach ($lastid as $data) {
                $isValid = $data->is_validated;
                if ($isValid === '1') {
                    $sess_array = array(
                        'id' => $data->user_id,
                        'name'=>$data->f_name.' '.$data->l_name
                    );
                    $this->session->set_userdata('admin_logged_in', $sess_array);
                }
            }
            echo $result;
        } else {
            echo 0;
        }
    }

    function logout()
    {
        $this->session->unset_userdata('admin_logged_in');
        session_destroy();
        redirect('Home', 'refresh');
    }
    // Mojsk starts mod:dt:31/07/2021
    function hindex()
    {
        if ($this->session->userdata('admin_logged_in')) {

            $s_data['session_data'] = $this->session->userdata('admin_logged_in');
            $cond = array(
                'user_id' => $s_data['session_data']['id'],
                'status' => 1
            );
            $lastid = $this->Crud_model->getTableDataWithOrWithoutCondArray('user', $cond);
            $result =  json_encode($lastid);
            $s_data['user_data'] = $result;

            $this->load->view('front/common/header', $s_data);
            $this->load->view('front/common/banner');
             $this->load->view('front/pages/dashboard');
            $this->load->view('front/pages/adds');
            $this->load->view('front/pages/patners');
            $this->load->view('front/common/footer');
        } else {
            $this->load->view('front/common/header');
            $this->load->view('front/common/banner');
            $this->load->view('front/pages/dashboard');
            $this->load->view('front/pages/adds');
            $this->load->view('front/pages/patners');
            $this->load->view('front/common/footer');
        }
    }
    function dashboard()
    {
        if ($this->session->userdata('admin_logged_in')) {

            $s_data['session_data'] = $this->session->userdata('admin_logged_in');
            $cond = array(
                'user_id' => $s_data['session_data']['id'],
                'status' => 1
            );
            $lastid = $this->Crud_model->getTableDataWithOrWithoutCondArray('user', $cond);
            $result =  json_encode($lastid);
            $s_data['user_data'] = $result;

            $data = json_decode($s_data['user_data']);

            $this->load->view('front/common/header', $s_data);
            if ($data[0]->payment_status === '1') {
                $this->load->view('front/pages/dashboard');
            } else {
                $this->load->view('front/pages/paynow');
            }
            // $this->load->view('front/pages/dashboard');         
            $this->load->view('front/common/footer');
        } else {
            $this->load->view('front/common/header');
            $this->load->view('front/pages/dashboard');
            $this->load->view('front/common/footer');
        }
    }

    function uploaddocs(){
        if ($this->session->userdata('admin_logged_in')) {

            $s_data['session_data'] = $this->session->userdata('admin_logged_in');
            $cond = array(
                'user_id' => $s_data['session_data']['id'],
                'status' => 1
            );
            $lastid = $this->Crud_model->getTableDataWithOrWithoutCondArray('user', $cond);
            $result =  json_encode($lastid);
            $s_data['user_data'] = $result;

            $data = json_decode($s_data['user_data']);
            // print_r($s_data);exit;

            $this->load->view('front/common/header', $s_data);
            $this->load->view('front/pages/uploaddocs',$s_data);
            $this->load->view('front/common/footer');
            }
    }
    function aboutUs()
    {
        if ($this->session->userdata('admin_logged_in')) {

            $s_data['session_data'] = $this->session->userdata('admin_logged_in');
            $cond = array(
                'user_id' => $s_data['session_data']['id'],
                'status' => 1
            );
            $lastid = $this->Crud_model->getTableDataWithOrWithoutCondArray('user', $cond);
            $result =  json_encode($lastid);
            $s_data['user_data'] = $result;
            $page['title'] = 'About Us';
            $this->load->view('front/common/header', $s_data);
            $this->load->view('front/pages/page_banner', $page);
            $this->load->view('front/pages/about_us');
            $this->load->view('front/common/footer');
        } else {
            $page['title'] = 'About Us';
            $this->load->view('front/common/header');
            $this->load->view('front/pages/page_banner', $page);
            $this->load->view('front/pages/about_us');
            $this->load->view('front/common/footer');
        }
    }
    function contactUs()
    {
        if ($this->session->userdata('admin_logged_in')) {

            $s_data['session_data'] = $this->session->userdata('admin_logged_in');
            $cond = array(
                'user_id' => $s_data['session_data']['id'],
                'status' => 1
            );
            $lastid = $this->Crud_model->getTableDataWithOrWithoutCondArray('user', $cond);
            $result =  json_encode($lastid);
            $s_data['user_data'] = $result;

            $page['title'] = 'Contact Us';
            $this->load->view('front/common/header', $s_data);
            $this->load->view('front/pages/page_banner', $page);
            $this->load->view('front/pages/contact_us');
            $this->load->view('front/common/footer');
        } else {
            $page['title'] = 'Contact Us';
            $this->load->view('front/common/header');
            $this->load->view('front/pages/page_banner', $page);
            $this->load->view('front/pages/contact_us');
            $this->load->view('front/common/footer');
        }
    }
    function gallery()
    {
        if ($this->session->userdata('admin_logged_in')) {

            $s_data['session_data'] = $this->session->userdata('admin_logged_in');
            $cond = array(
                'user_id' => $s_data['session_data']['id'],
                'status' => 1
            );
            $lastid = $this->Crud_model->getTableDataWithOrWithoutCondArray('user', $cond);
            $result =  json_encode($lastid);
            $s_data['user_data'] = $result;

            $page['title'] = 'Gallery';
            $this->load->view('front/common/header', $s_data);
            $this->load->view('front/pages/page_banner', $page);
            $this->load->view('front/pages/gallery');
            $this->load->view('front/common/footer');
        } else {
            $page['title'] = 'Gallery';
            $this->load->view('front/common/header');
            $this->load->view('front/pages/page_banner', $page);
            $this->load->view('front/pages/gallery');
            $this->load->view('front/common/footer');
        }
    }
    function privacyPolicy()
    {
        if ($this->session->userdata('admin_logged_in')) {

            $s_data['session_data'] = $this->session->userdata('admin_logged_in');
            $cond = array(
                'user_id' => $s_data['session_data']['id'],
                'status' => 1
            );
            $lastid = $this->Crud_model->getTableDataWithOrWithoutCondArray('user', $cond);
            $result =  json_encode($lastid);
            $s_data['user_data'] = $result;

            $page['title'] = 'Privacy Policy';
            $this->load->view('front/common/header', $s_data);
            $this->load->view('front/pages/page_banner', $page);
            $this->load->view('front/pages/privacyPolicy');
            $this->load->view('front/common/footer');
        } else {
            $page['title'] = 'Privacy Policy';
            $this->load->view('front/common/header');
            $this->load->view('front/pages/page_banner', $page);
            $this->load->view('front/pages/gallery');
            $this->load->view('front/common/footer');
        }
    }
    public function registation()
    {
        $f_name = $this->input->post('f_name');
        $l_name = $this->input->post('l_name');
        $email = $this->input->post('email');
        $mobile = $this->input->post('mobile');
        $password = base64_encode($this->input->post('password'));

        $random_number = random_int(100000, 999999);

        $data = array('f_name' => $f_name, 'l_name' => $l_name, 'email' => $email, 'mobile' => $mobile, 'password' => $password, 'otp' => $random_number, 'is_validated' => 0, 'created_dt' => date('Y-m-d H:i:s'), 'payment_status' => 0, 'status' => 1);
        // print_r($data);exit;

        $from = 'info@sobeit.in';
        $subject = "Thanks for registration | MOJSK";
        $message = "Complete your registration by validating your otp :" . $random_number;
        $result = $this->send_mail($email, $from, '', $subject, $message);
        if ($result) {
            $lastid = $this->Crud_model->insert_dataIntoTable('user', $data);
            echo $lastid;
        } else {
            echo 0;
        }
    }
    public function check_user()
    {
        $email = $this->input->post('email');
        $cond = array(
            'email' => $email,
            'status' => 1
        );
        // print_r($cond);
        $lastid = $this->Crud_model->getTableDataWithOrWithoutCondArray('user', $cond);
        echo json_encode($lastid);
    }
    public function check_userOtp()
    {
        $otp = $this->input->post('otp');
        $user_id = $this->input->post('user_id');
        $cond = array(
            'user_id' => $user_id,
            'otp' => $otp,
            'is_validated' => 0,
            'status' => 1
        );
        // print_r($cond);
        $lastid = $this->Crud_model->getTableDataWithOrWithoutCondArray('user', $cond);
        echo json_encode($lastid);
    }
    public function validateOtp()
    {
        $user_id = $this->input->post('user_id');
        $data = array(
            'is_validated' => 1
        );
        // print_r($cond);
        $lastid = $this->Crud_model->updateData('user', $data, array('user_id' => $user_id));
        if ($lastid) {
            $sess_array = array();
            $sess_array = array(
                'id' => $user_id
            );
            $this->session->set_userdata('admin_logged_in', $sess_array);
        }
        echo json_encode($lastid);
    }
    public function profileUpdate()
    {
        $user_id = $this->input->post('user_id');
        $f_name = $this->input->post('f_name');
        $l_name = $this->input->post('l_name');
        $email = $this->input->post('email');
        $mobile = $this->input->post('mobile');
        $password = $this->input->post('password') ? base64_encode($this->input->post('password')) : '';
        $pan = $this->input->post('p_panNo');
        $aadhar = $this->input->post('p_aadharNo');
        $address = $this->input->post('address');
        if ($password) {
            $data = array('f_name' => $f_name, 'l_name' => $l_name, 'email' => $email, 'mobile' => $mobile, 'password' => $password, 'pan_no' => $pan, 'aadhar_no' => $aadhar, 'address' => $address);
        } else {
            $data = array('f_name' => $f_name, 'l_name' => $l_name, 'email' => $email, 'mobile' => $mobile, 'pan_no' => $pan, 'aadhar_no' => $aadhar, 'address' => $address);
        }

        // print_r($user_id);
        $lastid = $this->Crud_model->updateData('user', $data, array('user_id' => $user_id));
        // $lastid = '';
        echo json_encode($lastid);
    }

    public function profileImageUpdate()
    {
        // print_r($_POST);
        $user_id = $this->input->post('user_id');

        if (!empty($_FILES['profile_img']['name'])) {
            $config['upload_path'] = 'assets/profilePic/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['file_name'] = $_FILES['profile_img']['name'];

            //Load upload library and initialize configuration
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            // print_r($config['file_name']);exit;
            if ($this->upload->do_upload('profile_img')) {
                $uploadData1 = $this->upload->data();
                $pictures1 = $uploadData1['file_name'];
                $cover_ext = explode(".", $pictures1);
                $addon_thumb = $uploadData1['raw_name'] . '_thumb';
                $this->load->library('image_lib');
                $config_resize['image_library'] = 'gd2';
                $config_resize['create_thumb'] = TRUE;
                $config_resize['maintain_ratio'] = false;
                $config_resize['master_dim'] = 'height';
                $config_resize['quality'] = "100%";
                $config_resize['source_image'] = './' . $config['upload_path'] . $pictures1;

                $config_resize['height'] = 75;
                $config_resize['width'] = 75;
                $this->image_lib->initialize($config_resize);
                $this->image_lib->resize();
                $picture_1 = $addon_thumb . '.' . end($cover_ext);
            } else {
                $picture_1 = '';
                // print_r('$picture_1');
            }
        } else {
            $picture_1 = '';
            // print_r('$picture_2');
        }

        $data = array('profile_img' => $picture_1);
        // print_r($data);
        $lastid = $this->Crud_model->updateData('user', $data, array('user_id' => $user_id));
        // $lastid = '';
        echo json_encode($lastid);
    }

    public function get_user()
    {
        $user_id = $this->input->post('user_id');
        $cond = array(
            'user_id' => $user_id,
            'status' => 1
        );
        // print_r($cond);
        $lastid = $this->Crud_model->getTableDataWithOrWithoutCondArray('user', $cond);
        echo json_encode($lastid);
    }
    public function updatePaymentAmt()
    {
        $user_id = $this->input->post('user_id');
        $amt = $this->input->post('amt');
        $data = array(
            'payment_amt' => $amt,
            'payment_status' => 0
        );

        // print_r($user_id);
        $lastid = $this->Crud_model->updateData('user', $data, array('user_id' => $user_id));

        echo json_encode($lastid);
    }
    public function updatePaymentSuccess()
    {
        $user_id = $this->input->post('user_id');
        $payment_id = $this->input->post('payment_id');
        $data = array(
            'payment_id' => $payment_id,
            'payment_status' => 1,
            'payment_dt' => date('Y-m-d H:i:s')
        );

        // print_r($user_id);
        $lastid = $this->Crud_model->updateData('user', $data, array('user_id' => $user_id));

        echo json_encode($lastid);
    }
    public function ge_userByMail()
    {
        $email = $this->input->post('email');
        $cond = array(
            'email' => $email,
            'is_validated' => 1,
            'status' => 1
        );
        // print_r($cond);
        $lastid = $this->Crud_model->getTableDataWithOrWithoutCondArray('user', $cond);
        echo json_encode($lastid);
    }
    public function updateForgetPassword()
    {
        $user_id = $this->input->post('user_id');
        $email = $this->input->post('email');
        $random_number = random_int(100000, 999999);
        $data = array(
            'password' => base64_encode($random_number)
        );

        // print_r($user_id);

        // echo json_encode($lastid);
        $from = 'info@sobeit.in';
        $subject = "Forgot password | MOJSK";
        $message = "Your new auto generated password is :" . $random_number;
        $result = $this->send_mail($email, $from, '', $subject, $message);
        if ($result) {
            $lastid = $this->Crud_model->updateData('user', $data, array('user_id' => $user_id, 'email' => $email));

            echo json_encode($lastid);
        } else {
            echo 0;
        }
    }
    public function resend_otp()
    {
        $user_id = $this->input->post('user_id');
        $random_number = random_int(100000, 999999);
        $data = array(
            'otp' => $random_number
        );
        $email = $this->db->where('user_id', $user_id)->get('user')->row()->email;
        $from = 'info@sobeit.in';
        $subject = "Resent otp | MOJSK";
        $message = "Complete your registration by validating your otp :" . $random_number;
        $result = $this->send_mail($email, $from, '', $subject, $message);
        if ($result) {
            $lastid = $this->Crud_model->updateData('user', $data, array('user_id' => $user_id));

            echo $lastid;
        } else {
            echo 0;
        }
    }
    // end of mojsk

    
// for file upload(By JR,2-9-21)
    public function documentsUpdate()
    {
        // print_r($_POST);
        $user_id = $this->input->post('userid');
        // $doc_img = $this->input->post('doc_img');
        $field_name = $this->input->post('field_name');

        if (!empty($_FILES['doc_img']['name'])) {
            $config['upload_path'] = 'assets/documents_img/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['file_name'] = $_FILES['doc_img']['name'];

            //Load upload library and initialize configuration
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            // print_r($config['file_name']);exit;
            if ($this->upload->do_upload('doc_img')) {
                $uploadData1 = $this->upload->data();
                $pictures1 = $uploadData1['file_name'];
                $cover_ext = explode(".", $pictures1);
                $addon_thumb = $uploadData1['raw_name'] . '_thumb';
                $this->load->library('image_lib');
                $config_resize['image_library'] = 'gd2';
                $config_resize['create_thumb'] = TRUE;
                $config_resize['maintain_ratio'] = false;
                $config_resize['master_dim'] = 'height';
                $config_resize['quality'] = "100%";
                $config_resize['source_image'] = './' . $config['upload_path'] . $pictures1;

                $config_resize['height'] = 75;
                $config_resize['width'] = 75;
                $this->image_lib->initialize($config_resize);
                $this->image_lib->resize();
               // $picture_1 = $addon_thumb . '.' . end($cover_ext);
               $picture_1 =$pictures1;
            } else {
                $picture_1 = '';
                // print_r('$picture_1');
            }
        } else {
            $picture_1 = '';
            // print_r('$picture_2');
        }

        $data = array($field_name => $picture_1);
        // print_r($data);
        $lastid = $this->Crud_model->updateData('user', $data, array('user_id' => $user_id));
        // $lastid = '';
        echo json_encode($lastid);
    }  

// for delete file (By JR,2-9-21)
    function documentsRemove()
    {
        $user_id = $this->input->post('userid');
        $field_name = $this->input->post('field_name');        
        $data = array($field_name => NULL);
        // print_r($data);exit;
        $lastid = $this->Crud_model->updateData('user', $data, array('user_id' => $user_id));
        echo json_encode($lastid);
        // return $this->uploaddocs();
    }


}
