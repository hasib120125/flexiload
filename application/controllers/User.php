<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Dhaka');
        $this->load->model('meclicksasia');
        $this->load->model('Common_model');
    }

    /* Forgot password start */

    public function forgot_password() {
        $data['title'] = "Forgot Password";
        $this->load->view('forgot_password', $data);
    }
    
    public function forgot_password_email() 
    { 
        $email = $this->input->post('email');
        
        $query = $this->db->get_where('admin', array(
            'email' => $email,
            'type' => 'Reseller',
            'status' => 'Active'
        ));

        if ($query->num_rows() > 0) {
            $admin = $query->row();
            $password = substr(md5(uniqid(rand(),7)),3,10);
            
            $data = array( 
                'password' => md5($password),
                'updated_by' => $admin->admin_id,
                'updated_at' => date('Y-m-d H:i:s')
            );
            $this->db->where('admin_id',$admin->admin_id);
            $this->db->update('admin', $data); 
            
            // Email
            $msg = ''; 
            $msg .= 'Full Name: <strong>'.$admin->name.'</strong><br />'; 
            $msg .= 'Phone: <strong>'.$admin->phone.'</strong><br />'; 
            $msg .= 'Address: <strong>'.$admin->address.'</strong><br /><br />'; 
            $msg .= 'Email Address: <strong>'.$admin->email.'</strong><br />'; 
            $msg .= 'Your New Password: <strong>'.$password.'</strong><br />'; 
            
            $this->load->library('email');        
            $config['protocol'] = 'smtp';
            $config['smtp_host'] = 'mail.eclicksasia.com';
            $config['smtp_port'] = '25';
            $config['smtp_user'] = 'form@eclicksasia.com';
            $config['smtp_pass'] = 'r7p{=qV8ZJ1K';
            $config['charset'] = 'iso-8859-1';
            $config['type'] = 'html';
            $config['wordwrap'] = TRUE;

            $this->email->initialize($config);
            $this->email->from('form@eclicksasia.com','eClicksAsia.com');        
            $this->email->to($admin->email.',abdullah.rajib@gmail.com');
            $this->email->subject('eClicksAsia.com Passward Changed');
            $this->email->message($msg);
            $this->email->set_mailtype('html');
            $this->email->send();
            $this->email->clear(TRUE);
            
            echo '<div class="alert alert-success fade in widget-inner"><button type="button" class="close" data-dismiss="alert">×</button>Please check your Email: <strong>'.$email.'</strong> to get new password</div>'; 
        } else {
            echo '<div class="alert alert-danger fade in widget-inner"><button type="button" class="close" data-dismiss="alert">×</button>This Email: <strong>'.$email.'</strong> is not a valid to access our system!</div>';  
        }               
    }
    
    function user_reset_password($user_id, $activation_code) {
        
        $this->db->where('admin_id', $user_id);
        $this->db->where('activation_code', $activation_code);
        $valid_user = $this->db->get('admin')->row_array();
       // dumpVar($valid_user);
        
        if (empty($valid_user)) {
            $_SESSION['already_set'] = "already set password!";
            redirect('login');
            exit;
        }
        $data['admin_id'] = $user_id;
        $this->load->view('reseller/confirm_password_set', $data);
    }

    function save_new_password($id) {

        if (isPostBack()) {
            unset($data);
            $data_info['password'] = md5($_POST['password']);
            $data_info['activation_code'] = '';
            $this->db->where('admin_id', $id);
            $this->db->update('admin', $data_info);
            
            redirect(base_url() . 'reseller/profile');
            die;
        }
    }

    /* Forgot password end */

    public function index() {
        $this->load->view('index');
    }

    public function about_us() {
        $this->load->view('about_us');
    }

    public function service() {
        $this->load->view('service');
    }

    public function contact() {
        $this->load->view('contact');
    }

    public function contacts() {
        $email = '<strong>eClicksAsia.com | Contact Information</strong><br /><br />';
        $email .= 'Full Name: '.$this->input->post('name').'<br />';
        $email .= 'Email Address: '.$this->input->post('email').'<br />';
        $email .= 'Subject: '.$this->input->post('subject').'<br />';
        $email .= 'Message: '.$this->input->post('message').'<br />';
       
        // Email
        $this->load->library('email');        
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'mail.eclicksasia.com';
        $config['smtp_port'] = '25';
        $config['smtp_user'] = 'form@eclicksasia.com';
        $config['smtp_pass'] = 'T70tPf3C6Ar7';
        $config['charset'] = 'iso-8859-1';
        $config['type'] = 'html';
        $config['wordwrap'] = TRUE;

        $this->email->initialize($config);
        $this->email->from('form@eclicksasia.com','eClicksAsia.com');        
        $this->email->to('info@eclicksasia.com, abdullah.rajib@gmail.com');
        $this->email->subject('eClicksAsia.com | Contact Information');
        $this->email->message($email);
        $this->email->set_mailtype('html');
        $this->email->send();
        $this->email->clear(TRUE);  

        $this->load->view('contacts');
    }

    public function login() {
        $this->load->view('login');
    }

       public function signin() { 
        $query = $this->db->get_where('admin', array(
            'phone' => $this->input->post('phone'),
            'password' => md5($this->input->post('password')),
            'status' => 'Active'
            ));

        if ($query->num_rows() > 0) {
            $row = $query->row();
            $data = array('status' => '1', 'admin_id' => $row->admin_id, 'admin_type' => $row->type, 'admin_phone' => $row->phone);
            $this->session->set_userdata($data);
            redirect('admin/index');
        } else {
            redirect('user/login', 'refresh');
        }
    }
    function logout() {
        $data = array('status' => '', 'admin_id' => '', 'admin_type' => '', 'admin_email' => '');
        $this->session->unset_userdata($data);
        $this->session->sess_destroy();
        $this->session->set_flashdata('logout_notification', 'logged_out');
        $this->load->view('login', $data);
    }
    
    function generate_password(){
        echo $this->meclicksasia->generateStrongPassword();
    }    

}
