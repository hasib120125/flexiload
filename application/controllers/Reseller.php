<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Reseller extends CI_Controller {
    
    private $admin_id;
    private $admin_type;
    private $timestamp;
    
    public function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Dhaka');
        $this->load->model('meclicksasia');
        $this->admin_id = $this->session->userdata('admin_id');
        $this->admin_type = $this->session->userdata('admin_type');
        $this->timestamp = date("Y-m-d H:i:s");
    }

    public function index() {
        if ($this->admin_type == 'Reseller') {
            $data['admin_id'] = $this->admin_id;
            $data['title'] = "Reseller | Home";
            $this->load->view('reseller/index', $data);
        } elseif($this->admin_type == 'Master') {
            redirect('admin', 'refresh');
        } else {
            redirect('user', 'refresh');
        }
    }

    function tr_search_list() {
        if ($this->admin_type == 'Reseller') {

            $first_date = $_POST['first_date'];
            $second_date = $_POST['second_date'];

            $this->db->where('created_at >=', $first_date);
            $this->db->where('created_at <=', $second_date);
            $data['all_list'] = $this->db->get('transaction')->result_array();
            //dumpVar($data['all_list']);
            $data['title'] = "Reseller | Report";
            $data['admin_id'] = $this->admin_id;
            $this->load->view('reseller/tr_search_list', $data);
        } elseif($this->admin_type == 'Master') {
            redirect('admin', 'refresh');
        } else {
            redirect('user', 'refresh');
        }
    }

    public function topup() {
        if ($this->admin_type == 'Reseller') {
            $data['title'] = "Reseller | Top Up";
            $data['segment'] = "BANGLADESH_FLEXILOAD";
            $this->load->view('reseller/topup', $data);
        } elseif($this->admin_type == 'Master') {
            redirect('admin', 'refresh');
        } else {
            redirect('user', 'refresh');
        }
    }

    public function profile() {
        if ($this->admin_type == 'Reseller') {
            $data['admin_id'] = $this->admin_id;
            $data['title'] = "Reseller | Profile";
            $this->load->view('reseller/profile', $data);
        } elseif($this->admin_type == 'Master') {
            redirect('admin', 'refresh');
        } else {
            redirect('user', 'refresh');
        }
    }

    public function report() {
        if ($this->admin_type == 'Reseller') {
            $data['title'] = "Reseller | Report";
            $data['admin_id'] = $this->admin_id;
            $this->load->view('reseller/report', $data);
        } elseif($this->admin_type == 'Master') {
            redirect('admin', 'refresh');
        } else {
            redirect('user', 'refresh');
        }
    }

    public function rate() {
        if ($this->admin_type == 'Reseller') {
            $data['title'] = "Reseller | Rate";
            $this->load->view('reseller/rate', $data);
        } elseif($this->admin_type == 'Master') {
            redirect('admin', 'refresh');
        } else {
            redirect('user', 'refresh');
        }
    }

    function register($param1 = '') {
        if ($this->admin_type == 'Reseller') {
            if ($param1 == 'add') {
                $data['type'] = 'Reseller';
                $data['date'] = date('Y-m-d');
                $data['name'] = $this->input->post('name');
                $data['phone'] = $this->input->post('phone');
                $data['email'] = $this->input->post('email');
                $data['password'] = md5($this->input->post('password'));
                $data['status'] = 'Inactive';
                $data['updated_by'] = $this->admin_id;
                $data['created_at'] = $this->timestamp;

                $this->meclicksasia->insert_data('admin', $data);
                redirect('reseller/index', 'refresh');
            }

            $data['title'] = "Reseller | Add Register";
            $this->load->view('reseller/register', $data);
        } elseif($this->admin_type == 'Master') {
            redirect('admin', 'refresh');
        } else {
            redirect('user', 'refresh');
        }
    }

    public function malaysia_operator() {
        $option_type = $this->input->post('option_type');

        if ($option_type == 'Promo'):
            $result = '<option value="">Select Operator</option>';
            $result .= '<option value="OXI" operator_name="OneXOX Internet (Per GB)">OneXOX Internet (Per GB)</option>'; 
            echo $result;
        elseif ($option_type == 'Prepaid'):
            $result = '<option value="">Select Operator</option>';
            $result .= '<option value="A" operator_name="Altel">Altel</option>';
            $result .= '<option value="B" operator_name="Buzz Me">Buzz Me</option>';
            $result .= '<option value="BM" operator_name="BestMobile">BestMobile</option>';
            $result .= '<option value="C" operator_name="Celcom">Celcom</option>';
            $result .= '<option value="D" operator_name="Digi">Digi</option>';
            $result .= '<option value="DBB" operator_name="Digi Broadband">Digi Broadband</option>';
            $result .= '<option value="F" operator_name="Friendi">Friendi</option>';
            $result .= '<option value="IP" operator_name="I Talk">I Talk</option>';
            $result .= '<option value="L" operator_name="Lebara">Lebara</option>';            
            $result .= '<option value="M" operator_name="Maxis">Maxis</option>';
            $result .= '<option value="MC" operator_name="Merchant Trade">Merchant Trade</option>';
            $result .= '<option value="MOPL" operator_name="MolPoints">MolPoints</option>';
            $result .= '<option value="OX" operator_name="OneXOX">OneXOX</option>';
            $result .= '<option value="S" operator_name="SpeakOut">SpeakOut</option>';
            $result .= '<option value="R" operator_name="Tron">Tron</option>';
            $result .= '<option value="T" operator_name="Tune Talk">Tune Talk</option>';
            $result .= '<option value="TMG" operator_name="TMGo">TMGo</option>';
            $result .= '<option value="U" operator_name="U Mobile">U Mobile</option>';
            $result .= '<option value="YES" operator_name="YesPrepaid">YesPrepaid</option>';
            echo $result;
        elseif ($option_type == 'Postpaid'):
            $result = '<option value="">Select Operator</option>';
            $result .= '<option value="CB" operator_name="Celcom Bill">Celcom Bill</option>';
            $result .= '<option value="DB" operator_name="Digi Bill">Digi Bill</option>';
            $result .= '<option value="MB" operator_name="Maxis Bill">Maxis Bill</option>';
            $result .= '<option value="RB" operator_name="RedOne Bill">RedOne Bill</option>';
            $result .= '<option value="UB" operator_name="U Mobile Bill">U Mobile Bill</option>';
            $result .= '<option value="XB" operator_name="XOX Bill">XOX Bill</option>';
            echo $result;
        elseif ($option_type == 'Utilities'):
            $result = '<option value="">Select Operator</option>'; 
            $result .= '<option value="ASB" operator_name="Astro Bill">Astro Bill</option>';
            $result .= '<option value="N" operator_name="Njoi Pin/ Njoi Pinless">Njoi Pin/ Njoi Pinless</option>';
            $result .= '<option value="KWB" operator_name="Kuching Water Board">Kuching Water Board</option>';
            $result .= '<option value="SESB" operator_name="Sabah Electricity">Sabah Electricity</option>';
            $result .= '<option value="SYBAS" operator_name="Syarikat Bekalan Air Selangor">Syarikat Bekalan Air Selangor</option>';
            $result .= '<option value="SAMB" operator_name="Syarikat Air Melaka">Syarikat Air Melaka</option>';
            $result .= '<option value="SAINS" operator_name="Syarikat Air Negeri Sembilan">Syarikat Air Negeri Sembilan</option>';
            $result .= '<option value="SATU" operator_name="Syarikat Air Terengganu">Syarikat Air Terengganu</option>';
            $result .= '<option value="TNB" operator_name="Tenaga Nasional Berhad">Tenaga Nasional Berhad</option>';
            $result .= '<option value="TM" operator_name="Telekom Malaysia">Telekom Malaysia</option>';       
            echo $result;
        endif;
    }

    
    public function malaysia_deno() 
    {        
        $code = $this->input->post('operator_code');
        switch ($code) {	
            // Promo
            case 'OXI': // OneXOX Internet (Per GB)
                echo "Amount be either RM.1 or RM.2 or RM.3 or RM.5";
                break;	
            // Prepaid	
            case 'A': // Altel
                echo "Amount be Minimum RM.5 and Maximum RM.100";
                break;	
            case 'B': // Buzz Me
                echo "Amount be Minimum RM.5 and Maximum RM.100";
                break;	
            case 'BM': // BestMobile
                echo "Amount be Minimum RM.5 and Maximum RM.100";
                break;	
            case 'C': // Celcom
                echo "Amount be Minimum RM.5 and Maximum RM.100";
                break;	
            case 'D': // Digi
                echo "Amount be Minimum RM.5 and Maximum RM.100";
                break;	
            case 'DBB': // Digi Broadband
                echo "Amount be either RM.5 or RM.10 or RM.30 or RM.50 or RM.100";
                break;	
            case 'F': // Friendi
                echo "Amount be Minimum RM.5 and Maximum RM.100";
                break;	
            case 'IP': // I Talk*
                echo "Amount be either RM.10 or RM.20 or RM.30 or RM.50";
                break;	
            case 'L': // Lebara
                echo "Amount be either RM.10 or RM.20";
                break;	            
            case 'M': // Maxis
                echo "Amount be either RM.5 or RM.10 or RM.20 or RM.30 or RM.60 or RM.100";
                break;	
            case 'MC': // Merchant Trade
                echo "Amount be Minimum RM.5 and Maximum RM.100";
                break;	
            case 'MOL': // MolPoints*
                echo "Amount be either RM.10 or RM.20 or RM.30 or RM.40 or RM.50 or RM.100";
                break;	            
            case 'OX': // OneXOX
                echo "Amount be Minimum RM.1 and Maximum RM.100";
                break;             
            case 'S': // SpeakOut
                echo "Amount be either RM.10 or RM.20 or RM.30";
                break;            
            case 'R': // Tron
                echo "Amount be either RM.10 or RM.30 or RM.50 or RM.100";
                break;	
            case 'T': // Tune Talk
                echo "Amount be Minimum RM.5 and Maximum RM.100";
                break;	
            case 'TMG': // TMGo*
                echo "Amount be either RM.10 or RM.30 or RM.50";
                break;	
            case 'U': // U Mobile
                echo "Amount be Minimum RM.5 and Maximum RM.100";
                break;	
            case 'YES': // YesPrepaid*
                echo "Amount be either RM.10 or RM.30 or RM.50 or RM.100";
                break; 		
            // Postpaid
            case 'CB': // Celcom Bill
                echo "Amount be Minimum RM.5 and Maximum RM.1000";
                break;	
            case 'DB': // Digi Bill
                echo "Amount be Minimum RM.5 and Maximum RM.1000";
                break;	
            case 'MB': // Maxis Bill
                echo "Amount be Minimum RM.5 and Maximum RM.1000";
                break;	
            case 'RB': // RedOne Bill
                echo "Amount be Minimum RM.5 and Maximum RM.1000";
                break;	
            case 'UB': // U Mobile Bill
                echo "Amount be Minimum RM.5 and Maximum RM.1000";
                break;	
            case 'XB': // XOX Bill
                echo "Amount be Minimum RM.5 and Maximum RM.1000";
                break;
            // Utilities
            case 'ASB': // Astro Bill
                echo "Amount be Minimum RM.5 and Maximum RM.1000";
                break;	
            case 'N': // Njoi Pinless OR Njoi Pin
                echo "Amount be either RM.5 or RM.6 or RM.7 or RM.8 or RM.10 or RM.20 or RM.30 or RM.40 or RM.50";
                break;	
            case 'KWB': // Kuching Water Board
                echo "Amount be Minimum RM.5 and Maximum RM.1000";
                break;	
            case 'SESB': // Sabah Electricity
                echo "Amount be Minimum RM.5 and Maximum RM.1000";
                break;	
            case 'SYABAS': // Syarikat Bekalan Air Selangor
                echo "Amount be Minimum RM.5 and Maximum RM.1000";
                break;	
            case 'SAMB': // Syarikat Air Melaka
                echo "Amount be Minimum RM.5 and Maximum RM.1000";
                break;	
            case 'SAINS': // Syarikat Air Negeri Sembilan
                echo "Amount be Minimum RM.5 and Maximum RM.1000";
                break;	
            case 'SATU': // Syarikat Air Terengganu
                echo "Amount be Minimum RM.5 and Maximum RM.1000";
                break;	
            case 'TNB': // Tenaga Nasional Berhad
                echo "Amount be Minimum RM.5 and Maximum RM.1000";
                break;	
            case 'TM': // Telekom Malaysia
                echo "Amount be Minimum RM.10 and Maximum RM.1000";
                break; 
            // Default	
            default:
                echo "You haven't choose any Operator yet!";
                break;
        }        
    }
    
    function bangladesh_flexiload($param1 = '') {

        if ($this->admin_type == 'Reseller')
        {             
//            $phone_no = $this->input->post('phone_no');
//            $amount = $this->input->post('amount');
//            $commission = $this->meclicksasia->transaction_commission('ID');
//            $commission_amount = ($amount * $commission) / 100;
//            $rm_rate = $this->meclicksasia->last_ratess()->indonesia;
//            $rm_amount = $amount / $rm_rate;            
//            $current_points = $this->meclicksasia->current_points($this->admin_id);            
//
//            $data = array(
//                'class' => 'Out',
//                'country' => 'Bangladesh',
//                'country_type' => 'Flexiload',
//                'operator' => $this->input->post('operator'),
//                'phone_no' => $phone_no,
//                'admin_id' => $this->admin_id,
//                'type' => $this->input->post('type'),
//                'amount' => $amount,
//                'commission' => $commission_amount,
//                'rm_rate' => $rm_rate,
//                'updated_by' => $this->admin_id,
//                'created_at' => $this->timestamp 
//            );
//            
//            $command = $phone_no.'.BD.'.$amount;
//            // Checking Current-Points available to transaction
//            if($rm_amount <= $current_points) {
//                // Amount Limitation in Rp.
//                if($amount==100||$amount==200||$amount==300||$amount==400||$amount==500) {
//                    $this->_smstopups($command, $data);  
//                } else {
//                    $msg['error'] = "Amount be either BDT.100 or BDT.200 or BDT.300 or BDT.400 or BDT.500";
//                    $this->session->set_userdata($msg);
//                    redirect('topup','refresh');
//                }                
//            } else {
//                $msg['error'] = "Your Maximum Currrnt Points ".$current_points;
//                $this->session->set_userdata($msg);
//                redirect('topup','refresh');                
//            }             
            
            $type = '';
            $types = $this->input->post('type');
            if($types=='Prepaid'){
                $type = 0;
            }elseif($types=='Postpaid'){
                $type = 1;                
            }
            $phone_no = $this->input->post('phone_no');
            $amount = $this->input->post('amount');
            $commission = $this->meclicksasia->transaction_commission('BD');
            $commission_amount = ($amount * $commission) / 100;
            $rm_rate = $this->meclicksasia->last_ratess()->bangladesh;
            $rm_amount = $amount / $rm_rate;            
            $current_points = $this->meclicksasia->current_points($this->admin_id);
                    
            $data = array(
                'class' => 'Out',
                'country' => 'Bangladesh',
                'country_type' => 'Flexiload',
                'operator' => $this->input->post('operator'),
                'phone_no' => $phone_no,
                'admin_id' => $this->admin_id,
                'type' => $types,
                'amount' => $amount,
                'commission' => $commission_amount,
                'rm_rate' => $rm_rate,
                'updated_by' => $this->admin_id,
                'created_at' => $this->timestamp 
            );
                      
            // Checking Current-Points available to transaction
            if($rm_amount <= $current_points)
            {                
                $array = array(
                    'user' => 'eclicksasia', 
                    'key' => '3fv0qr7ic4hd0lm38fyuin69wapy83h192rqjpzm',  
                    'phone' => $phone_no, 
                    'type' => $type, 
                    'amount' => $amount
                ); 
                $requests = json_encode($array); 
                $request = base64_encode($requests);                  
                $url = "http://www.easyclicksasia.com/?ng=api/mr/".$request;
                $order_id = file_get_contents($url);
                //if(is_int($order_id) && $order_id != '-1') { 
                if($order_id != '-1') { 
                    $data['order_id'] = $order_id;
                    $this->meclicksasia->insert_data('transaction', $data); 
                    echo '<div class="alert alert-success fade in widget-inner"><button type="button" class="close" data-dismiss="alert">×</button>Send to <strong>'.$phone_no.'</strong> at Tk. <strong>'.$amount.'</strong> Successfully.</div>';                   
                } else {
                    echo '<div class="alert alert-danger fade in widget-inner"><button type="button" class="close" data-dismiss="alert">×</button>Sending Fail to <strong>'.$phone_no.'</strong> at Tk. <strong>'.$amount.'</strong>! Please try again.</div>';
                }
                
            } else {
                echo '<div class="alert alert-danger fade in widget-inner"><button type="button" class="close" data-dismiss="alert">×</button>Your Maximum Currrnt Points '.$current_points.'</div>';                
            }  
            
        } elseif($this->admin_type == 'Master') {
            redirect('admin', 'refresh');
        } else {
            redirect('user', 'refresh');
        }
    }

    function bangladesh_ewallet($param1 = '') {
        if ($this->admin_type == 'Reseller') 
        {
            $type = $this->input->post('type');
            $phone_no = $this->input->post('phone_no');
            $amount = $this->input->post('amount');
            $charge = $this->meclicksasia->last_charge_amount();
            $commission = $this->meclicksasia->transaction_commission('ewallet');
            $commission_amount = ($amount * $commission) / 100;
            $rm_rate = $this->meclicksasia->last_ratess()->bangladesh;
            $rm_amount = $amount / $rm_rate; 
            $current_points = $this->meclicksasia->current_points($this->admin_id);
            
            $data['class'] = 'Out';
            $data['country'] = 'Bangladesh';
            $data['country_type'] = 'Out';
            $data['phone_no'] = $phone_no;
            $data['admin_id'] = $this->admin_id;
            $data['type'] = $type;
            $data['rm_rate'] = $rm_rate;
            $data['amount'] = $amount;
            $data['commission'] = $commission_amount;
            $data['charge'] = $charge;
            $data['updated_by'] = $this->admin_id;
            $data['created_at'] = $this->timestamp;
        
            // Checking Current-Points available to transaction
//            'key' => 'q6iiqb3dyu5avyf32tbkh4gvgf7s55gl1puhrolg', 
            if($rm_amount <= $current_points)
            {                
                $array = array(
                    'user' => 'eclicksasia', 
                    'key' => '3fv0qr7ic4hd0lm38fyuin69wapy83h192rqjpzm', 
                    'phone' => $phone_no, 
                    'type' => $type, 
                    'amount' => $amount
                ); 
                $requests = json_encode($array); 
                $request = base64_encode($requests);                  
//                $url = "http://www.easyclicksasia.com/?ng=api/mm/".$request;
                $url = "http://www.easyclicksasia.com/?ng=api/op/".$request;
                $order_id = file_get_contents($url);
                //if(is_int($order_id) && $order_id != '-1') { 
                if($order_id != '-1') { 
                    $data['order_id'] = $order_id;
                    $this->meclicksasia->insert_data('transaction', $data);     
                    echo '<div class="alert alert-success fade in widget-inner"><button type="button" class="close" data-dismiss="alert">×</button>Send to <strong>'.$phone_no.'</strong> at Tk. <strong>'.$amount.'</strong> Successfully.</div>';                 
                } else {
                    echo '<div class="alert alert-danger fade in widget-inner"><button type="button" class="close" data-dismiss="alert">×</button>'.$order_id.' Sending Fail to <strong>'.$phone_no.'</strong> at Tk. <strong>'.$amount.'</strong>! Please try again.</div>';                
                }             
            } else {
                echo '<div class="alert alert-danger fade in widget-inner"><button type="button" class="close" data-dismiss="alert">×</button>Your Maximum Currrnt Points '.$current_points.'</div>';                              
            }            
        } elseif($this->admin_type == 'Master') {
            redirect('admin', 'refresh');
        } else {
            redirect('user', 'refresh');
        }
    }


    function malaysia_topup($param1 = '') {
$this->session->unset_userdata('insert_id');
        if ($this->admin_type == 'Reseller') 
        {
            $amount = $this->input->post('amount');
            $type = $this->input->post('opt_type');
            $code = $this->input->post('operator');
//            $account_no = $this->input->post('account_no');
            $phone_no = $this->input->post('phone_no');
            
            $commission = $this->meclicksasia->transaction_commission($code);
            $commission_amount = ($amount * $commission) / 100;
            $rm_rate = $this->meclicksasia->last_ratess()->malaysia;
            $rm_amount = $amount / $rm_rate;            
            $current_points = $this->meclicksasia->current_points($this->admin_id);
            
            $data['class'] = 'Out';
            $data['country'] = 'Malaysia';
            $data['country_type'] = $this->input->post('opt_type');
            $data['operator'] = $code;
            $data['phone_no'] = $phone_no;
            $data['admin_id'] = $this->admin_id;
            $data['amount'] = $amount;
            $data['commission'] = $commission_amount;
            $data['rm_rate'] = $rm_rate;
            $data['updated_by'] = $this->admin_id;
            $data['created_at'] = date("Y-m-d H:i:s"); 

            // Checking Current-Points available to transaction
            if($rm_amount <= $current_points){                
                if($type=='Promo') {
                    switch ($code) {
                        // OneXOX Internet (Per GB)
                        case 'OXI':
                            if($amount==1||$amount==2||$amount==3||$amount==5) {
                                $this->_smstopups('OXI',$phone_no,$amount,$data);  
                            } else {
                                echo '<div class="alert alert-danger fade in widget-inner"><button type="button" class="close" data-dismiss="alert">×</button>Amount be either RM.1 or RM.2 or RM.3 or RM.5</div>';
                            }
                            break;
                        default:
                            echo '<div class="alert alert-danger fade in widget-inner"><button type="button" class="close" data-dismiss="alert">×</button>You have not choose any Operator yet!</div>';
                            break;
                    }                     
                } elseif($type=='Prepaid') {
                    switch ($code) {
                        // Altel
                        case 'A':
                            if($amount>=5&&$amount<=100) {
                                $this->_smstopups('A',$phone_no,$amount,$data);  
                            } else {
                                echo '<div class="alert alert-danger fade in widget-inner"><button type="button" class="close" data-dismiss="alert">×</button>Amount be Minimum RM.5 and Maximum RM.100!</div>';
                            }
                            break;
                        // Buzz Me
                        case 'B':
                            if($amount>=5&&$amount<=100) {
                                $this->_smstopups('B',$phone_no,$amount,$data); 
                            } else {
                                echo '<div class="alert alert-danger fade in widget-inner"><button type="button" class="close" data-dismiss="alert">×</button>Amount be Minimum RM.5 and Maximum RM.100!</div>';
                            }
                            break;
                        // BestMobile
                        case 'BM':
                            if($amount>=5&&$amount<=100) {
                                $this->_smstopups('BM',$phone_no,$amount,$data);  
                            } else {
                                echo '<div class="alert alert-danger fade in widget-inner"><button type="button" class="close" data-dismiss="alert">×</button>Amount be Minimum RM.5 and Maximum RM.100!</div>';
                            }
                            break;
                        // Celcom
                        case 'C':
                            if($amount>=5&&$amount<=100) {
                                $this->_smstopups('C',$phone_no,$amount,$data); 
                            } else {
                                echo '<div class="alert alert-danger fade in widget-inner"><button type="button" class="close" data-dismiss="alert">×</button>Amount be Minimum RM.5 and Maximum RM.100!</div>';
                            }
                            break;
                        // Digi
                        case 'D':
                            if($amount>=5&&$amount<=100) {
                                $this->_smstopups('D',$phone_no,$amount,$data); 
                            } else {
                                echo '<div class="alert alert-danger fade in widget-inner"><button type="button" class="close" data-dismiss="alert">×</button>Amount be Minimum RM.5 and Maximum RM.100!</div>';
                            }
                            break;
                        // Digi Broadband
                        case 'DBB':
                            if($amount==5||$amount==10||$amount==30||$amount==50||$amount==100) {
                                $this->_smstopups('DBB',$phone_no,$amount,$data); 
                            } else {
                                echo '<div class="alert alert-danger fade in widget-inner"><button type="button" class="close" data-dismiss="alert">×</button>Amount be either RM.5 or RM.10 or RM.30 or RM.50 or RM.100!</div>';
                            }
                            break;
                        // Friendi
                        case 'F':
                            if($amount>=5&&$amount<=100) {
                                $this->_smstopups('F',$phone_no,$amount,$data); 
                            } else {
                                echo '<div class="alert alert-danger fade in widget-inner"><button type="button" class="close" data-dismiss="alert">×</button>Amount be Minimum RM.5 and Maximum RM.100!</div>';
                            }
                            break;
                        // I Talk*
                        case 'IP':
                            if($amount==10||$amount==20||$amount==30||$amount==50) {
                                $this->_smstopups('IP',$phone_no,$amount,$data); 
                            } else {
                                echo '<div class="alert alert-danger fade in widget-inner"><button type="button" class="close" data-dismiss="alert">×</button>Amount be either RM.10 or RM.20 or RM.30 or RM.50!</div>';
                            }
                            break;
                        // Lebara
                        case 'L':
                            if($amount==10||$amount==20) {
                                $this->_smstopups('L',$phone_no,$amount,$data); 
                            } else {
                                echo '<div class="alert alert-danger fade in widget-inner"><button type="button" class="close" data-dismiss="alert">×</button>Amount be either RM.10 or RM.20!</div>';
                            }
                            break;                            
                        // Maxis
                        case 'M':
                            if($amount==5||$amount==10||$amount==20||$amount==30||$amount==60||$amount==100) {
                                $this->_smstopups('M',$phone_no,$amount,$data); 
                            } else {
                                echo '<div class="alert alert-danger fade in widget-inner"><button type="button" class="close" data-dismiss="alert">×</button>Amount be either RM.5 or RM.10 or RM.20 or RM.30 or RM.60 or RM.100!</div>';
                            }
                            break;
                        // Merchant Trade
                        case 'MC':
                            if($amount>=5&&$amount<=100) {
                                $this->_smstopups('MC',$phone_no,$amount,$data); 
                            } else {
                                echo '<div class="alert alert-danger fade in widget-inner"><button type="button" class="close" data-dismiss="alert">×</button>Amount be Minimum RM.5 and Maximum RM.100!</div>';
                            }
                            break;
                        // MolPoints*
                        case 'MOL':
                            if($amount==10||$amount==20||$amount==30||$amount==40||$amount==50||$amount==100) {
                                $this->_smstopups('MOL',$phone_no,$amount,$data); 
                            } else {
                                echo '<div class="alert alert-danger fade in widget-inner"><button type="button" class="close" data-dismiss="alert">×</button>Amount be either RM.10 or RM.20 or RM.30 or RM.40 or RM.50 or RM.100!</div>';
                            }
                            break;
                        // OneXOX
                        case 'OX':
                            if($amount>=1&&$amount<=100) {
                                $this->_smstopups('OX',$phone_no,$amount,$data); 
                            } else {
                                echo '<div class="alert alert-danger fade in widget-inner"><button type="button" class="close" data-dismiss="alert">×</button>Amount be Minimum RM.1 and Maximum RM.100!</div>';
                            }
                            break;
                        // SpeakOut
                        case 'S':
                            if($amount==10||$amount==20||$amount==30) {
                                $this->_smstopups('S',$phone_no,$amount,$data); 
                            } else {
                                echo '<div class="alert alert-danger fade in widget-inner"><button type="button" class="close" data-dismiss="alert">×</button>Amount be either RM.10 or RM.20 or RM.30!</div>';
                            }
                            break;                            
                        // Tron
                        case 'R':
                            if($amount==10||$amount==30||$amount==50||$amount==100) {
                                $this->_smstopups('R',$phone_no,$amount,$data); 
                            } else {
                                echo '<div class="alert alert-danger fade in widget-inner"><button type="button" class="close" data-dismiss="alert">×</button>Amount be either RM.10 or RM.30 or RM.50 or RM.100!</div>';
                            }
                            break;
                        // Tune Talk
                        case 'T':
                            if($amount>=5&&$amount<=100) {
                                $this->_smstopups('T',$phone_no,$amount,$data); 
                            } else {
                                echo '<div class="alert alert-danger fade in widget-inner"><button type="button" class="close" data-dismiss="alert">×</button>Amount be Minimum RM.5 and Maximum RM.100!</div>';
                            }
                            break;
                        // TMGo*
                        case 'TMG':
                            if($amount==10||$amount==30||$amount==50) {
                                $this->_smstopups('TMG',$phone_no,$amount,$data); 
                            } else {
                                echo '<div class="alert alert-danger fade in widget-inner"><button type="button" class="close" data-dismiss="alert">×</button>Amount be either RM.10 or RM.30 or RM.50!</div>';
                            }
                            break;
                        // U Mobile
                        case 'U':
                            if($amount>=5&&$amount<=100) { 
                                $this->_smstopups('U',$phone_no,$amount,$data); 
                            } else {
                                echo '<div class="alert alert-danger fade in widget-inner"><button type="button" class="close" data-dismiss="alert">×</button>Amount be Minimum RM.5 and Maximum RM.100!</div>';
                            }
                            break;
                        // YesPrepaid*
                        case 'YES':
                            if($amount==10||$amount==30||$amount==50||$amount==100) {
                                $this->_smstopups('YES',$phone_no,$amount,$data);  
                            } else {
                                echo '<div class="alert alert-danger fade in widget-inner"><button type="button" class="close" data-dismiss="alert">×</button>Amount be either RM.10 or RM.30 or RM.50 or RM.100!</div>';
                            }
                            break; 
                        default:
                            echo '<div class="alert alert-danger fade in widget-inner"><button type="button" class="close" data-dismiss="alert">×</button>You have not choose any Operator yet!</div>';
                            break;
                    } 
                } elseif($type=='Postpaid') {
                    switch ($code) {
                        // Celcom Bill
                        case 'CB':
                            if($amount>=5&&$amount<=1000) {
                                $this->_smstopups('CB',$phone_no,$amount,$data);  
                            } else {
                                echo '<div class="alert alert-danger fade in widget-inner"><button type="button" class="close" data-dismiss="alert">×</button>Amount be Minimum RM.5 and Maximum RM.1000!</div>';
                            }
                            break;
                        // Digi Bill
                        case 'DB':
                            if($amount>=5&&$amount<=1000) {
                                $this->_smstopups('DB',$phone_no,$amount,$data);  
                            } else {
                                echo '<div class="alert alert-danger fade in widget-inner"><button type="button" class="close" data-dismiss="alert">×</button>Amount be Minimum RM.5 and Maximum RM.1000!</div>';
                            }
                            break;
                        // Maxis Bill
                        case 'MB':
                            if($amount>=5&&$amount<=1000) {
                                $this->_smstopups('MB',$phone_no,$amount,$data);  
                            } else {
                                echo '<div class="alert alert-danger fade in widget-inner"><button type="button" class="close" data-dismiss="alert">×</button>Amount be Minimum RM.5 and Maximum RM.1000!</div>';
                            }
                            break;
                        // RedOne Bill
                        case 'RB':
                            if($amount>=5&&$amount<=1000) {
                                $this->_smstopups('RB',$phone_no,$amount,$data);  
                            } else {
                                echo '<div class="alert alert-danger fade in widget-inner"><button type="button" class="close" data-dismiss="alert">×</button>Amount be Minimum RM.5 and Maximum RM.1000!</div>';
                            }
                            break;
                        // U Mobile Bill
                        case 'UB':
                            if($amount>=5&&$amount<=1000) {
                                $this->_smstopups('UB',$phone_no,$amount,$data);  
                            } else {
                                echo '<div class="alert alert-danger fade in widget-inner"><button type="button" class="close" data-dismiss="alert">×</button>Amount be Minimum RM.5 and Maximum RM.1000!</div>';
                            }
                            break;
                        // XOX Bill
                        case 'XB':
                            if($amount>=5&&$amount<=1000) {
                                $this->_smstopups('XB',$phone_no,$amount,$data); 
                            } else {
                                echo '<div class="alert alert-danger fade in widget-inner"><button type="button" class="close" data-dismiss="alert">×</button>Amount be Minimum RM.5 and Maximum RM.1000!</div>';
                            }
                            break; 
                        default:
                            echo '<div class="alert alert-danger fade in widget-inner"><button type="button" class="close" data-dismiss="alert">×</button>You have not choose any Operator yet!</div>';
                            break;
                    }                     
                } elseif($type=='Utilities') {
                    switch ($code) { 
                        // Astro Bill
                        case 'ASB':
                            if($amount>=5&&$amount<=1000) {
                                $this->_smstopups('ASB',$phone_no,$amount,$data); 
                            } else {
                                echo '<div class="alert alert-danger fade in widget-inner"><button type="button" class="close" data-dismiss="alert">×</button>Amount be Minimum RM.5 and Maximum RM.1000!</div>';
                            }
                            break;
                        // Njoi Pinless OR Njoi Pin
                        case 'N':
                            if($amount==5||$amount==6||$amount==7||$amount==8||$amount==10||$amount==20||$amount==30||$amount==40||$amount==50) {
                                $this->_smstopups('N',$phone_no,$amount,$data); 
                            } else {
                                echo '<div class="alert alert-danger fade in widget-inner"><button type="button" class="close" data-dismiss="alert">×</button>Amount be either RM.5 or RM.6 or RM.7 or RM.8 or RM.10 or RM.20 or RM.30 or RM.40 or RM.50!</div>';
                            }
                            break;
                        // Kuching Water Board
                        case 'KWB':
                            if($amount>=5&&$amount<=1000) {
                                $this->_smstopups('KWB',$phone_no,$amount,$data);  
                            } else {
                                echo '<div class="alert alert-danger fade in widget-inner"><button type="button" class="close" data-dismiss="alert">×</button>Amount be Minimum RM.5 and Maximum RM.1000!</div>';
                            }
                            break;
                        // Sabah Electricity
                        case 'SESB':
                            if($amount>=5&&$amount<=1000) {
                                $this->_smstopups('SESB',$phone_no,$amount,$data);  
                            } else {
                                echo '<div class="alert alert-danger fade in widget-inner"><button type="button" class="close" data-dismiss="alert">×</button>Amount be Minimum RM.5 and Maximum RM.1000!</div>';
                            }
                            break;
                        // Syarikat Bekalan Air Selangor
                        case 'SYABAS':
                            if($amount>=5&&$amount<=1000) {
                                $this->_smstopups('SYABAS',$phone_no,$amount,$data);  
                            } else {
                                echo '<div class="alert alert-danger fade in widget-inner"><button type="button" class="close" data-dismiss="alert">×</button>Amount be Minimum RM.5 and Maximum RM.1000!</div>';
                            }
                            break;
                        // Syarikat Air Melaka
                        case 'SAMB':
                            if($amount>=5&&$amount<=1000) { 
                                $this->_smstopups('SAMB',$phone_no,$amount,$data); 
                            } else {
                                echo '<div class="alert alert-danger fade in widget-inner"><button type="button" class="close" data-dismiss="alert">×</button>Amount be Minimum RM.5 and Maximum RM.1000!</div>';
                            }
                            break;
                        // Syarikat Air Negeri Sembilan
                        case 'SAINS':
                            if($amount>=5&&$amount<=1000) {
                                $this->_smstopups('SAINS',$phone_no,$amount,$data); 
                            } else {
                                echo '<div class="alert alert-danger fade in widget-inner"><button type="button" class="close" data-dismiss="alert">×</button>Amount be Minimum RM.5 and Maximum RM.1000!</div>';
                            }
                            break;
                        // Syarikat Air Terengganu
                        case 'SATU':
                            if($amount>=5&&$amount<=1000) {
                                $this->_smstopups('SATU',$phone_no,$amount,$data); 
                            } else {
                                echo '<div class="alert alert-danger fade in widget-inner"><button type="button" class="close" data-dismiss="alert">×</button>Amount be Minimum RM.5 and Maximum RM.1000!</div>';
                            }
                            break;
                        // Tenaga Nasional Berhad
                        case 'TNB':
                            if($amount>=5&&$amount<=1000) {
                                $this->_smstopups('TNB',$phone_no,$amount,$data); 
                            } else {
                                echo '<div class="alert alert-danger fade in widget-inner"><button type="button" class="close" data-dismiss="alert">×</button>Amount be Minimum RM.5 and Maximum RM.1000!</div>';
                            }
                            break;
                        // Telekom Malaysia
                        case 'TM':
                            if($amount>=10&&$amount<=1000) {
                                $this->_smstopups('TM',$phone_no,$amount,$data); 
                            } else {
                                echo '<div class="alert alert-danger fade in widget-inner"><button type="button" class="close" data-dismiss="alert">×</button>Amount be Minimum RM.10 and Maximum RM.1000!</div>';
                            }
                            break; 
                        default:
                            echo '<div class="alert alert-danger fade in widget-inner"><button type="button" class="close" data-dismiss="alert">×</button>You have not choose any Operator yet!</div>';
                            break;
                    }                     
                } else {
                    echo '<div class="alert alert-danger fade in widget-inner"><button type="button" class="close" data-dismiss="alert">×</button>You have not choose any Type yet!</div>';                    
                } 
            } else {
                echo '<div class="alert alert-danger fade in widget-inner"><button type="button" class="close" data-dismiss="alert">×</button>Your Maximum Currrnt Points '.$current_points.'!</div>';               
            } 
redirect('topup_success', 'refresh');
        } elseif($this->admin_type == 'Master') {
            redirect('admin', 'refresh');
        } else {
            redirect('user', 'refresh');
        }
    }

    function indonesia_topup($param1 = '') {
        if ($this->admin_type == 'Reseller') 
        { 
            $amount = $this->input->post('amount');
            $phone_no = $this->input->post('phone_no');
            $commission = $this->meclicksasia->transaction_commission('ID');
            $commission_amount = ($amount * $commission) / 100;
            $rm_rate = $this->meclicksasia->last_ratess()->indonesia;
            $rm_amount = $amount / $rm_rate;            
            $current_points = $this->meclicksasia->current_points($this->admin_id);            

            $data['class'] = 'Out';
            $data['country'] = 'Indonesia';
            $data['phone_no'] = $phone_no;
            $data['admin_id'] = $this->admin_id;
            $data['amount'] = $amount;
            $data['commission'] = $commission_amount;
            $data['rm_rate'] = $rm_rate;
            $data['status'] = 'success';
            $data['updated_by'] = $this->admin_id;
            $data['created_at'] = $this->timestamp; 

//            $command = $phone_no.'.IN.'.$amount;
            // Checking Current-Points available to transaction
            if($rm_amount <= $current_points) {
                // Amount Limitation in Rp.
                if($amount==25||$amount==50||$amount==100) { 
                    $this->_smstopups('IN',$phone_no,$amount,$data);  
//                    $this->_smstopups($command, $data);  
                } else {
                    echo '<div class="alert alert-danger fade in widget-inner"><button type="button" class="close" data-dismiss="alert">×</button>Amount be either Rp.25 or Rp.50 or Rp.100!</div>'; 
                }                
            } else {
                echo '<div class="alert alert-danger fade in widget-inner"><button type="button" class="close" data-dismiss="alert">×</button>Your Maximum Currrnt Points '.$current_points.'!</div>';               
            } 
            
        } elseif($this->admin_type == 'Master') {
            redirect('admin', 'refresh');
        } else {
            redirect('user', 'refresh');
        }
    }

    function nepal_topup($param1 = '') {
        if ($this->admin_type == 'Reseller') 
        { 
            $amount = $this->input->post('amount');
            $phone_no = $this->input->post('phone_no');
            $commission = $this->meclicksasia->transaction_commission('NP');
            $commission_amount = ($amount * $commission) / 100;
            $rm_rate = $this->meclicksasia->last_ratess()->nepal;
            $rm_amount = $amount / $rm_rate;            
            $current_points = $this->meclicksasia->current_points($this->admin_id);            

            $data['class'] = 'Out';
            $data['country'] = 'Nepal';
            $data['phone_no'] = $phone_no;
            $data['admin_id'] = $this->admin_id;
            $data['amount'] = $amount;
            $data['commission'] = $commission_amount;
            $data['rm_rate'] = $rm_rate;
            $data['status'] = 'success';
            $data['updated_by'] = $this->admin_id;
            $data['created_at'] = $this->timestamp;
            
//            $command = $phone_no.'.NP.'.$amount;            
            // Checking Current-Points available to transaction
            if($rm_amount <= $current_points){
                // Amount Limitation in NPR.
                if($amount==100||$amount==200) { 
                    $this->_smstopups('NP',$phone_no,$amount,$data);  
//                    $this->_smstopups($command, $data);  
                } else {
                    echo '<div class="alert alert-danger fade in widget-inner"><button type="button" class="close" data-dismiss="alert">×</button>Amount be either NRP.100 or NRP.200!</div>'; 
                }                
            } else {
                echo '<div class="alert alert-danger fade in widget-inner"><button type="button" class="close" data-dismiss="alert">×</button>Your Maximum Currrnt Points '.$current_points.'!</div>';                 
            }
            
        } elseif($this->admin_type == 'Master') {
            redirect('admin', 'refresh');
        } else {
            redirect('user', 'refresh');
        }
    }

    private function _smstopups($product='',$dest='',$amount='', $data='') 
    { 
        if ($this->admin_type == 'Reseller') 
        { 
            $username = "3000798"; 
            $password = "W8Hc<Bvn2@"; 
            $pin = "5238"; 
            
	        $ym = date('ym');
	        $ref_id = $this->db->select_max('refid')->get('transaction')->row('refid');
	        if(substr($ref_id,3,4)==$ym){
	            $ref = substr($ref_id,3,16)+1;
	            $refid = "ECA".$ref;
	        }else{
	            $refid = "ECA".date("y").date("m").str_pad(1,8,"0",STR_PAD_LEFT); 
	        }             
//            $ym = date('y');
//            $ref_id = $this->db->select('refid')->order_by('transaction_id','desc')->limit(1)->get('transaction')->row('refid');
//            if(substr($ref_id,0,2)==$ym){
//                $refid = substr($ref_id,0,6)+1; 
//            }else{
//                $refid = date("y").str_pad(1,4,"0",STR_PAD_LEFT); 
//            } 
            
            $URL = "https://api.iimmpact.com/request-v2.php"; 
            $string = $username . "|" . $password . "|" . $pin . "|" . $refid . "|" .$product . "|" .$dest . "|" . $amount;    
            $sign = base64_encode(sha1($string)); 
            $parameter = "username=" . $username . "&password=" . $password . "&pin=" .$pin . "&refid=" .$refid . "&product=" .$product . "&dest=" .$dest ."&amount=" .$amount . "&sign=" .$sign;    

            $ch = curl_init(); 
            curl_setopt($ch, CURLOPT_URL, $URL); 
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
            curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY); 
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);    
            curl_setopt($ch, CURLOPT_TIMEOUT, 0); 
            curl_setopt($ch, CURLOPT_POSTFIELDS, $parameter);

            //Execute the request and also time the transaction ( optional ) 
            $start = array_sum(explode(' ', microtime())); 
            $result = curl_exec($ch); 
            $stop = array_sum(explode(' ', microtime())); 
            $totalTime = $stop - $start;    

            //Check for errors ( again optional ) 
            if ( curl_errno($ch) ) 
            { 
                $result = 'ERROR -> ' . curl_errno($ch) . ': ' . curl_error($ch); 
            } else { 
                $returnCode = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE); 
                switch($returnCode){ 
                    case 200: break; 
                    default: $result = 'HTTP ERROR -> ' . $returnCode; break; 
                }     
            } 
            
            curl_close($ch);         
            
            $data['refid'] = $refid;  
            $data['message'] = $result;

            // Transaction Status
//            $status = $this->meclicksasia->smstopup_transaction_status($refid,$product,$dest,$amount);             
//            if (strpos($status,'Succesful') !== false) {
//                $data['status'] = "Succesful";
//            } elseif (strpos($status,'Fail!') !== false) {
//                $data['status'] = "Fail!";
//            } elseif (strpos($status,'processing') !== false) {
//                $data['status'] = "processing";
//            } else {
//                $data['status'] = "Not Found!";                                       
//            }    
            
            $status = strpos($result, "processing", 10); 
            if ($status === false) {
                $data['status'] = "Fail";
//                $return = '<div class="alert alert-info fade in widget-inner"><button type="button" class="close" data-dismiss="alert">×</button>TOP-UP Fail to <strong>'.$data['phone_no'].'</strong> at Tk. <strong>'.$data['amount'].'</strong>! Please try again.</div>';
            } else {	
                $data['status'] = "Success";
//                $return = '<div class="alert alert-info fade in widget-inner"><button type="button" class="close" data-dismiss="alert">×</button>TOP-UP to <strong>'.$data['phone_no'].'</strong> at Tk. <strong>'.$data['amount'].'</strong> Successfully.</div>';
            } 
//            
            // Insert to Database
            $this->meclicksasia->insert_data('transaction', $data); 

            $ashiqe['insert_id'] = $this->db->insert_id();
            $this->session->set_userdata($ashiqe);

            $request = array_merge($_GET, $_POST); 
            // check that request is inbound message 
             if (!isset($request['refid']) OR !isset($request['message']) ) { 
                 error_log('Not inbound response'); 
//                 echo '<div class="alert alert-danger fade in widget-inner"><button type="button" class="close" data-dismiss="alert">×</button>'.str_replace("[SMSTopUp]","",$result).' => '.$request['refid'].' / '.$request['message'].'</div>'; 
//                 echo '<div class="alert alert-info fade in widget-inner"><button type="button" class="close" data-dismiss="alert">×</button>TOP-UP Fail to <strong>'.$data['phone_no'].'</strong> at Tk. <strong>'.$data['amount'].'</strong>! Please try again.</div>'; 
                echo '<div class="alert alert-info fade in widget-inner"><button type="button" class="close" data-dismiss="alert">×</button>TOP-UP to <strong>'.$data['phone_no'].'</strong> at RM. <strong>'.$data['amount'].'</strong> is Processing.</div>'; 
             } else { 
//                echo '<div class="alert alert-success fade in widget-inner"><button type="button" class="close" data-dismiss="alert">×</button>'.str_replace("[SMSTopUp]","",$result).' => '.$request['refid'].' / '.$request['message'].'</div>'; 
                echo '<div class="alert alert-info fade in widget-inner"><button type="button" class="close" data-dismiss="alert">×</button>TOP-UP to <strong>'.$data['phone_no'].'</strong> at RM. <strong>'.$data['amount'].'</strong> is Processing.</div>'; 
             } 
        } elseif($this->admin_type == 'Master') {
            redirect('admin', 'refresh');
        } else {
            redirect('user', 'refresh');
        }        
    }
public function topup_success() {
        if ($this->admin_type == 'Reseller') {
            $data['title'] = "Success | Top Up";
            $data['segment'] = "BANGLADESH_FLEXILOAD";
            $data['lastid'] = $this->session->userdata('insert_id');

            $this->load->view('reseller/topup_success', $data);
        } elseif($this->admin_type == 'Master') {
            redirect('admin', 'refresh');
        } else {
            redirect('user', 'refresh');
        }
    }
            
    function send_money($param1 = '') {
        $ym = date('ym');
        $transaction_id = $this->db->select('transaction_id')->order_by('transaction_id','desc')->limit(1)->get('transaction')->row('transaction_id');

        $bno = $transaction_id+1;
        $booking_no = "T".date("y").date("m").$bno;

        $data['refnumber'] = $booking_no;
        $data['remarks'] = $this->input->post('remarks');
        //$data['rates_id'] = $this->input->post('rates_id');
        $data['admin_id'] = $param1;
        $data['amount'] = $this->input->post('amount');
        $data['created_at'] = $this->timestamp;


        $this->db->where('admin_id', $param1);
        $this->db->insert('transaction', $data);

        redirect('admin/reseller', 'refresh');
    }

    public function change_password() {
        if ($this->admin_type == 'Reseller') {
            
            $admin_id = $this->admin_id;
            $old_password = md5($this->input->post('old_password'));            
            $new_password = md5($this->input->post('new_password'));

            $password = $this->db->get_where('admin',array('admin_id'=>$admin_id,'type'=>'Reseller'))->row('password'); 
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
                $msg .= 'Reseller Name: <strong>'.$admin_info->name.'</strong><br />'; 
                $msg .= 'Reseller Phone: <strong>'.$admin_info->phone.'</strong><br />'; 
                $msg .= 'Reseller Email: <strong>'.$admin_info->email.'</strong><br />'; 
                $msg .= 'Reseller Address: <strong>'.$admin_info->address.'</strong><br />'; 
                $msg .= 'Reseller Password: <strong>'.$this->input->post('new_password').'</strong><br />'; 

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
                $this->email->subject('eClicksAsia.com Reseller Passward Changed');
                $this->email->message($msg);
                $this->email->set_mailtype('html');
                $this->email->send();
                $this->email->clear(TRUE);
            } else {
                $msg['error'] = "Old Password doesn't matched! Please try again.";
                $this->session->set_userdata($msg);                
            }
            redirect('profile', 'refresh'); 
            
        } elseif($this->admin_type == 'Master') {
            redirect('admin', 'refresh');
        } else {
            redirect('user', 'refresh');
        }
    }
   
    
    function logout() {
        $data = array('status' => '', 'admin_id' => '', 'admin_type' => '', 'admin_email' => '');
        $this->session->unset_userdata($data);
        $this->session->sess_destroy();
        $this->session->set_flashdata('logout_notification', 'logged_out');
        $this->load->view('login', $data);
    }

    
}
