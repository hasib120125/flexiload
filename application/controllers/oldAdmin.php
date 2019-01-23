<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
        
    private $admin_id;
    private $admin_type;
    private $timestamp;
    
    public function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Dhaka');
        $this->load->model('meclicksasia');
        $this->load->model('Common_model');
        $this->admin_id = $this->session->userdata('admin_id');
        $this->admin_type = $this->session->userdata('admin_type');
        $this->timestamp = date("Y-m-d H:i:s");
    }

    public function index() {
        if ($this->admin_type == 'Master') {
            $data['title'] = "Home";
            $this->load->view('admin/index', $data);
        } elseif($this->admin_type == 'Reseller') {
            redirect('reseller', 'refresh');
        } else {
            redirect('user', 'refresh');
        }
    }

    public function reseller() {
        if ($this->admin_type == 'Master') {
            $data['title'] = "Reseller Information";
            $this->load->view('admin/reseller', $data);
        } elseif($this->admin_type == 'Reseller') {
            redirect('reseller', 'refresh');
        } else {
            redirect('user', 'refresh');
        }
    }

    public function reseller_off() {
        if ($this->admin_type == 'Master') {
            $data['title'] = "Reseller Information";
            $this->load->view('admin/reseller_off', $data);
        } elseif($this->admin_type == 'Reseller') {
            redirect('reseller', 'refresh');
        } else {
            redirect('user', 'refresh');
        }
    }
    
    function rates() {
        if ($this->admin_type == 'Master') {
            $data['title'] = "Rate Information";
            $this->load->view('admin/rates', $data);
        } elseif($this->admin_type == 'Reseller') {
            redirect('reseller', 'refresh');
        } else {
            redirect('user', 'refresh');
        }
    }

    function comissione_list() {
        if ($this->admin_type == 'Master') {
            $data['title'] = "Commission Information";
            $this->load->view('admin/comissione_list', $data);
        } elseif($this->admin_type == 'Reseller') {
            redirect('reseller', 'refresh');
        } else {
            redirect('user', 'refresh');
        }
    }

    function charge() {
        if ($this->admin_type == 'Master') {
            $data['title'] = "Charge Information";
            $this->load->view('admin/charge', $data);
        } elseif($this->admin_type == 'Reseller') {
            redirect('reseller', 'refresh');
        } else {
            redirect('user', 'refresh');
        }
    }

    function commission() {
        if ($this->admin_type == 'Master') {
            $data['title'] = "Charge Information";
            $this->load->view('admin/commission', $data);
        } elseif($this->admin_type == 'Reseller') {
            redirect('reseller', 'refresh');
        } else {
            redirect('user', 'refresh');
        }
    }

    function reseller_create($param1 = '') {
        if ($this->admin_type == 'Master') {

            if ($param1 == 'add') {

                $data['type'] = 'Reseller';
                $data['date'] = date('Y-m-d');
                $data['name'] = $this->input->post('name');
                $data['phone'] = $this->input->post('phone');
                $data['plan_id'] = $this->input->post('plan_id');
                $data['email'] = $this->input->post('email');
                $data['address'] = $this->input->post('address');
                $data['password'] = md5($this->input->post('password'));
                $data['status'] = 'Active';
                $data['updated_by'] = $this->admin_id;
                $data['created_at'] = $this->timestamp;

                $this->db->insert('admin', $data);
                $admin_id = $this->db->insert_id();

                // Upload
                $file['photo'] = $admin_id . "_" . $_FILES['photo']['name'];
                if (!empty($_FILES['photo']['name'])) {
                    move_uploaded_file($_FILES['photo']['tmp_name'], 'assets/reseller/' . $file['photo']);
                    $this->db->where('admin_id', $admin_id);
                    $this->db->update('admin', $file);
                }



                redirect('admin/reseller', 'refresh');
            }

            $data['title'] = "Admin | Add Reseller";
            $this->load->view('admin/reseller_add', $data);
        } elseif($this->admin_type == 'Reseller') {
            redirect('reseller', 'refresh');
        } else {
            redirect('user', 'refresh');
        }
    }

    function rates_create($param1 = '') {
        if ($this->admin_type == 'Master') {

            if ($param1 == 'add') {
                //$data['type'] = 'Reseller';
                $data['date'] = $this->input->post('date');
                $data['malaysia'] = $this->input->post('malaysia');
                $data['bangladesh'] = $this->input->post('bangladesh');
                $data['indonesia'] = $this->input->post('indonesia');
                $data['nepal'] = $this->input->post('nepal');

                $data['updated_by'] = $this->admin_id;
                $data['created_at'] = $this->timestamp;

                $this->meclicksasia->insert_data('rates', $data);
                redirect('admin/rates', 'refresh');
            }

            $data['title'] = "Admin | Add Rates";
            $this->load->view('admin/rates_add', $data);
        } elseif($this->admin_type == 'Reseller') {
            redirect('reseller', 'refresh');
        } else {
            redirect('user', 'refresh');
        }
    }

	  function server_message($param1 = '') {
        if ($this->admin_type == 'Master') {

            if ($param1 == 'add') {
                		       
                $data['type'] = $this->input->post('type');
                $data['textmessage'] = $this->input->post('textmessage');

                $this->meclicksasia->insert_data('servermessage', $data);
                redirect('admin/profile', 'refresh');
            }

            $data['title'] = "Admin | Add Rates";
            $this->load->view('admin/profile', $data);
        
    }
	
	  }
	
	
	
    function charge_create($param1 = '') {
        if ($this->admin_type == 'Master') {

            if ($param1 == 'add') {
                //$data['type'] = 'Reseller';
                $data['date'] = date('Y-m-d');
                $data['amount'] = $this->input->post('amount');
                $data['updated_by'] = $this->admin_id;
                $data['created_at'] = $this->timestamp;

                $this->meclicksasia->insert_data('charge', $data);
                redirect('admin/charge', 'refresh');
            }

            $data['title'] = "Admin | Add Rates";
            $this->load->view('admin/charge_add', $data);
        } elseif($this->admin_type == 'Reseller') {
            redirect('reseller', 'refresh');
        } else {
            redirect('user', 'refresh');
        }
    }

    function commission_create($param1 = '') {
        if ($this->admin_type == 'Master') {

            $plan = array(
                'plan_title' => $this->input->post('plan_title'),
                'updated_by' => $this->admin_id,
                'created_at' => $this->timestamp
            );
            $this->db->insert('plan', $plan);
            $plan_id = $this->db->insert_id();

            $product = $this->input->post('product');
            if (!empty($product)) {
                foreach ($product as $a => $b) {
                    $rate = array(
                        'plan_id' => $plan_id,
                        'product' => $this->input->post('product[' . $a . ']'),
                        'comission' => $this->input->post('comission[' . $a . ']'),
                        'updated_by' => $this->admin_id,
                        'created_at' => $this->timestamp
                    );
                    $this->db->insert('plan_rate', $rate);
                }
            }

            $data['title'] = "Admin | Add Comission";
            $this->load->view('admin/comissione_list', $data);
        } elseif($this->admin_type == 'Reseller') {
            redirect('reseller', 'refresh');
        } else {
            redirect('user', 'refresh');
        }
    }

    function comisssion_update($param1 = '', $param2 = '') {
        if ($this->admin_type == 'Master') {

            if ($param1 == 'edit') {

                $plan = array(
                    'plan_title' => $this->input->post('plan_title'),
                    'updated_by' => $this->admin_id,
                    'updated_at' => $this->timestamp
                );
                $this->db->where('plan_id', $param2);
                $this->db->update('plan', $plan);

                $this->db->where('plan_id', $param2);
                $this->db->delete('plan_rate');
                $product = $this->input->post('product');
                if (!empty($product)) {
                    foreach ($product as $a => $b) {
                        $rate = array(
                            'plan_id' => $param2,
                            'product' => $this->input->post('product[' . $a . ']'),
                            'comission' => $this->input->post('comission[' . $a . ']'),
                            'updated_by' => $this->admin_id,
                            'created_at' => $this->timestamp
                        );
                        $this->db->insert('plan_rate', $rate);
                    }
                }
                redirect('admin/comissione_list/' . $param2, 'refresh');
            }

            $data['title'] = "Admin | Edit Commission";
            $data['plan_id'] = $param1;
            $this->load->view('admin/comisssion_update', $data);
        } elseif($this->admin_type == 'Reseller') {
            redirect('reseller', 'refresh');
        } else {
            redirect('user', 'refresh');
        }
    }

    function reseller_update($param1 = '', $param2 = '') {
        if ($this->admin_type == 'Master') {

            if ($param1 == 'edit') {
                $data['name'] = $this->input->post('name');
                $data['phone'] = $this->input->post('phone');
                $data['email'] = $this->input->post('email');
                $data['address'] = $this->input->post('address');
                $data['plan_id'] = $this->input->post('plan_id');
                $data['updated_by'] = $this->admin_id;
                $data['updated_at'] = $this->timestamp;

                $this->meclicksasia->update_data('admin', $data, 'admin_id', $param2);

                // Upload
                $file['photo'] = $param2 . "_" . $_FILES['photo']['name'];
                if (!empty($_FILES['photo']['name'])) {
                    move_uploaded_file($_FILES['photo']['tmp_name'], 'assets/reseller/' . $file['photo']);
                    $this->db->where('admin_id', $param2);
                    $this->db->update('admin', $file);
                }
                redirect('admin/reseller/' . $param2, 'refresh');
            }

            $data['title'] = "Admin | Edit Reseller";
            $data['admin_id'] = $param1;
            $this->load->view('admin/reseller_edit', $data);
        } elseif($this->admin_type == 'Reseller') {
            redirect('reseller', 'refresh');
        } else {
            redirect('user', 'refresh');
        }
    }

    function reseller_update_status($param1 = '') {
        if ($this->admin_type == 'Master') {

            $data['status'] = $this->input->post('status');
            $data['updated_by'] = $this->admin_id;
            $data['updated_at'] = $this->timestamp;

            $this->meclicksasia->update_data('admin', $data, 'admin_id', $param1);

            redirect('admin/reseller', 'refresh');
        } elseif($this->admin_type == 'Reseller') {
            redirect('reseller', 'refresh');
        } else {
            redirect('user', 'refresh');
        }
    }

    function tr_search_list() {
        if ($this->admin_type == 'Master') {

            $first_date = $_POST['first_date'];
            $second_date = $_POST['second_date'];

            $this->db->where('created_at >=', $first_date);
            $this->db->where('created_at <=', $second_date);
            $data['all_list'] = $this->db->get('transaction')->result_array();
            //dumpVar($data['all_list']);
            $data['title'] = "Admin | Report";
            $data['admin_id'] = $this->admin_id;
            $this->load->view('admin/tr_search_list', $data);
        } elseif($this->admin_type == 'Reseller') {
            redirect('reseller', 'refresh');
        } else {
            redirect('user', 'refresh');
        }
    }

    function rates_update($param1 = '', $param2 = '') {
        if ($this->admin_type == 'Master') {

            if ($param1 == 'edit') {
                $data['date'] = $this->input->post('date');
                $data['malaysia'] = $this->input->post('malaysia');
                $data['bangladesh'] = $this->input->post('bangladesh');
                $data['indonesia'] = $this->input->post('indonesia');
                $data['nepal'] = $this->input->post('nepal');
                $data['updated_by'] = $this->admin_id;
                $data['updated_at'] = $this->timestamp;

                $this->meclicksasia->update_data('rates', $data, 'rates_id', $param2);
                redirect('admin/rates/' . $param2, 'refresh');
            }

            $data['title'] = "Admin | Edit Rates";
            $data['admin_id'] = $param1;
            $this->load->view('admin/rates_edit', $data);
        } elseif($this->admin_type == 'Reseller') {
            redirect('reseller', 'refresh');
        } else {
            redirect('user', 'refresh');
        }
    }

    function charge_update($param1 = '', $param2 = '') {
        if ($this->admin_type == 'Master') {

            if ($param1 == 'edit') {
                $data['date'] = $this->input->post('date');
                $data['amount'] = $this->input->post('amount');
                $data['updated_by'] = $this->admin_id;
                $data['updated_at'] = $this->timestamp;

                $this->meclicksasia->update_data('charge', $data, 'charge_id', $param2);
                redirect('admin/charge/' . $param2, 'refresh');
            }

            $data['title'] = "Admin | Edit Charge";
            $data['charge_id'] = $param1;
            $this->load->view('admin/charge_edit', $data);
        } elseif($this->admin_type == 'Reseller') {
            redirect('reseller', 'refresh');
        } else {
            redirect('user', 'refresh');
        }
    }

    function charge_delete($param1 = '') {
        if ($this->admin_type == 'Master') {

            $data['deleted'] = '1';
            $data['updated_by'] = $this->admin_id;
            $data['updated_at'] = $this->timestamp;

            $this->meclicksasia->update_data('charge', $data, 'charge_id', $param1);
            redirect('admin/charge/' . $param1, 'refresh');
        } elseif($this->admin_type == 'Reseller') {
            redirect('reseller', 'refresh');
        } else {
            redirect('user', 'refresh');
        }
    }

    function reseller_transaction($param1 = '') {
        if ($this->admin_type == 'Master') {
            $data['title'] = "Admin | Reseller Transaction History";
            $data['admin_id'] = $param1;
            $this->load->view('admin/reseller_transaction', $data);
        } elseif($this->admin_type == 'Reseller') {
            redirect('reseller', 'refresh');
        } else {
            redirect('user', 'refresh');
        }
    }

    function reseller_out_transaction($param1 = '') {
        if ($this->admin_type == 'Master') {
            $data['title'] = "Admin | | Reseller Transaction History";
            $data['admin_id'] = $param1;
            $this->load->view('admin/reseller_out_transaction', $data);
        } elseif($this->admin_type == 'Reseller') {
            redirect('reseller', 'refresh');
        } else {
            redirect('user', 'refresh');
        }
    }

    function transaction($param1 = '') {
        if ($this->admin_type == 'Master') {
            $data['title'] = "Admin | Reseller Transaction History";
            $this->load->view('admin/transaction', $data);
        } elseif($this->admin_type == 'Reseller') {
            redirect('reseller', 'refresh');
        } else {
            redirect('user', 'refresh');
        }
    }

    function send_money($param1 = '') {
        if ($this->admin_type == 'Master') {
            $data['admin_id'] = $param1;
            $data['amount'] = $this->input->post('amount');
            $data['created_at'] = $this->timestamp;

            $this->db->where('admin_id', $param1);
            $this->db->insert('transaction', $data);

            redirect('admin/reseller', 'refresh');
        } elseif($this->admin_type == 'Reseller') {
            redirect('reseller', 'refresh');
        } else {
            redirect('user', 'refresh');
        }
    }

    function get_reselelr_in_data_list() {

        $admin_id = $this->session->userdata('admin_id');

        // echo "<pre>";
        //print_r($admin_id);
        // die;

        $data = array(
            'admin_id' => $admin_id,
            'class' => "in"
        );
        $result = $this->meclicksasia->get_data_list_by_many_columns("transaction", $data);

        echo "<pre>";
        print_r($result);
        die;
    }

    public function change_password() {
        if ($this->admin_type == 'Master') {
            
            $admin_id = $this->admin_id;
            $old_password = md5($this->input->post('old_password'));
            $new_password = md5($this->input->post('new_password'));

            $password = $this->db->get_where('admin',array('admin_id'=>$admin_id,'type'=>'Master'))->row('password'); 
            if($password == $old_password)
            {
                $data = array( 
                    'password' => $new_password,
                    'updated_by' => $admin_id,
                    'updated_at' => date('Y-m-d H:i:s')
                );
                $this->db->where('admin_id',$admin_id);
                $this->db->update('admin', $data);  

                $msg['message'] = "Admin Password Updated Successfully.";
                $this->session->set_userdata($msg);
                
                // Email
                $admin_info = $this->meclicksasia->table_info('admin','admin_id',$admin_id);
                $msg = ''; 
                $msg .= 'Admin Name: <strong>'.$admin_info->name.'</strong><br />'; 
                $msg .= 'Admin Phone: <strong>'.$admin_info->phone.'</strong><br />'; 
                $msg .= 'Admin Email: <strong>'.$admin_info->email.'</strong><br />'; 
                $msg .= 'Admin Address: <strong>'.$admin_info->address.'</strong><br />'; 
                $msg .= 'Admin Password: <strong>'.$this->input->post('new_password').'</strong><br />'; 

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
                $this->email->to('abdullah.rajib@gmail.com');
                $this->email->subject('eClicksAsia.com Admin Passward Changed');
                $this->email->message($msg);
                $this->email->set_mailtype('html');
                $this->email->send();
                $this->email->clear(TRUE); 
            } else {
                $msg['error'] = "Old Password doesn't matched! Please try again.";
                $this->session->set_userdata($msg);                
            }
            redirect('profiles', 'refresh');           
            
        } elseif($this->admin_type == 'Reseller') {
            redirect('reseller', 'refresh');
        } else {
            redirect('user', 'refresh');
        }
    }     
    
    public function profile() {
        if ($this->admin_type == 'Master') {
            $data['admin_id'] = $this->admin_id;
            $data['title'] = "Reseller Information";
            $this->load->view('admin/profile', $data);
        } elseif($this->admin_type == 'Reseller') {
            redirect('reseller', 'refresh');
        } else {
            redirect('user', 'refresh');
        }
    }
    
    public function reseller_view() {
        if ($this->admin_type == 'Master') {
            $data['admin_id'] = $this->admin_id;
            $data['title'] = "Reseller Information";
            $this->load->view('admin/reseller_view', $data);
        } elseif($this->admin_type == 'Reseller') {
            redirect('reseller', 'refresh');
        } else {
            redirect('user', 'refresh');
        }
    }
    
    
    
    
}
