<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Meclicksasia extends CI_Model {

    function __construct() {
        parent::__construct();
         $this->load->model('common_model', 'Common_model', true);
    }

    function reseller() {
        $query = $this->db->get_where('admin', array('type' => 'Reseller'));
        return $query->result_array();
    }

    function rates() {
        $query = $this->db->get_where('rates');
        return $query->result_array();
    }
     function comissione_list() {
        $query = $this->db->get_where('plan');
        return $query->result_array();
    }
    function charge() {
        $this->db->where('deleted','0');
        $query = $this->db->get_where('charge');
        return $query->result_array();
    }

    function plan_rate_comission($plan_id, $product) {
        $query = $this->db->get_where('plan_rate', array('plan_id'=>$plan_id,'product'=>$product));
        return $query->row()->comission;
    }
    
    function transaction_commission($product){
        $admin_id = $this->session->userdata('admin_id');
        $plan_id = $this->table_info('admin','admin_id',$admin_id)->plan_id;
        $query = $this->db->get_where('plan_rate', array('plan_id'=>$plan_id,'product'=>$product));
        return $query->row()->comission;        
    }

    function last_rates() {
        //$this->db->select_max('rates_id');
        //$query = $this->db->get_where('rates');
        $this->db->select_max('rates_id');
        $rt_query = $this->db->get('rates');
        return $rt_query->row_array();
    }
    
    function last_ratess() {
        $this->db->order_by('rates_id','desc');
        $this->db->limit(1);
        $query = $this->db->get('rates');
        return $query->row();
    }
	
    function last_messages() {
        $this->db->order_by('id','desc');
        $this->db->limit(1);
        $query = $this->db->get('servermessage');
        return $query->row_array();
    }
	
	
	
    function last_charge() {
        $this->db->select_max('charge_id');
        $rt_query = $this->db->get('charge');
        return $rt_query->row_array();
    }
    function last_charge_amount() {
        $this->db->order_by('charge_id','desc');
        $this->db->limit(1);
        $query = $this->db->get('charge')->row();
        return $query->amount;
    }
    function last_trid() {
        //$this->db->select_max('rates_id');
        //$query = $this->db->get_where('rates');
        $this->db->select_max('transaction_id');
        $tr_query = $this->db->get('transaction');
        return $tr_query->row_array();
    }

    function transaction_in($admin_id) {
        $ttl_in = 0;
        $query = $this->db->get_where('transaction', array('class' => 'In', 'admin_id' => $admin_id));
        foreach ($query->result_array() as $row) {
            $ttl_in += $row['amount'];
        }
        return $ttl_in;
    }

    function transaction_in_reseller($admin_id) {
        //$admin_id = $this->session->userdata('admin_id');
        $query = $this->db->get_where('transaction', array('class' => 'In', 'admin_id' => $admin_id));
        foreach ($query->result_array() as $row) {
            $query = $row['amount'];
        }
        return $query;
    }

    function transaction_out($admin_id) {
        $ttl_out = 0;
        $query = $this->db->get_where('transaction', array('class' => 'Out', 'admin_id' => $admin_id));
        foreach ($query->result_array() as $row) {
            $ttl_out += $row['amount'] / $row['rm_rate'];
        }
        return $ttl_out;
    }
    function transaction_commissions($admin_id) {
        $ttl_com = 0;
        $query = $this->db->get_where('transaction', array('class' => 'Out', 'admin_id' => $admin_id));
        foreach ($query->result_array() as $row) {
            $ttl_com += $row['commission'];
        }
        return $ttl_com;
    }
    function transaction_charge($admin_id) {
        $result = 0;
        $query = $this->db->get_where('transaction', array('class' => 'Out', 'admin_id' => $admin_id));
        foreach ($query->result_array() as $row) {
            $result += $row['charge'];
        }
        return $result;
    }

    function table($table) {
        $query = $this->db->get($table);
        return $query->result_array();
    }

    function table_data($table, $column_name, $column_value, $order_by) {
//        $this->db->order_by($order_by,'desc');
        $query = $this->db->get_where($table, array($column_name => $column_value));
        return $query->result_array();
    }

    function table_info($table, $column_name, $column_value) {
        $query = $this->db->get_where($table, array($column_name => $column_value));
        return $query->row();
    }

    function insert_data($table_name, $data) {
        $this->db->insert($table_name, $data);
        return $this->db->insert_id();
    }

    function update_data($table_name, $data, $column_name, $column_value) {
        $this->db->where($column_name, $column_value);
        $this->db->update($table_name, $data);
        return $this->db->affected_rows();
    }

    function get_data_list_by_many_columns($table_name, $column_array, $order_column_name = NULL, $order = NULL, $start_limit = NULL, $per_page = NULL) {
        $this->db->where($column_array);
        if (isset($order_column_name) && isset($order))
            $this->db->order_by($order_column_name, $order);
        if (isset($start_limit))
            $this->db->limit($per_page, $start_limit);
        return $this->db->get($table_name)->result_array();
    }

    // get data list by single column of a database table
    function get_data_list_by_single_column($table_name, $column_name, $column_value, $order_column_name = NULL, $order = NULL, $start_limit = NULL, $per_page = NULL) {
        if (isset($order_column_name) && isset($order))
            $this->db->order_by($order_column_name, $order);
        if (isset($start_limit))
            $this->db->limit($per_page, $start_limit);
        $this->db->where($column_name, $column_value);
        return $this->db->get($table_name)->result_array();
    }

    // get all data list of a database table
    function get_data_list($table_name, $order_column_name = NULL, $order = NULL, $start_limit = NULL, $per_page = NULL) {
        if (isset($order_column_name) && isset($order))
            $this->db->order_by($order_column_name, $order);
        if (isset($start_limit))
            $this->db->limit($per_page, $start_limit);
        return $this->db->get($table_name)->result_array();
    }

    // get single data by single column of a database table
    function get_single_data_by_single_column($table_name, $column_name, $column_value) {
        $this->db->where($column_name, $column_value);
        return $this->db->get($table_name)->row_array();
    }

    function get_reseller_total_amount($reseller_id) {
        $this->db->select_sum('tr_amount');
        $this->db->where('admin_id', $reseller_id);

        return $this->db->get('transaction')->result();
    }

    function get_reseller_recharge_total_amount($reseller_id) {
        $this->db->select_sum('re_amount');
        $this->db->where('recharge_admin_id', $reseller_id);

        return $this->db->get('recharge')->result();
    }

    function get_reseller_balance($reseller_id) {

        $reseller_amount = $this->get_reseller_total_amount($reseller_id);
        //dumpVar($reseller_amount);
        $recharge_amount = $this->get_reseller_recharge_total_amount($reseller_id);
        //dumpVar($recharge_amount);
        return $reseller_amount[0]->tr_amount - $recharge_amount[0]->re_amount;
    }

    function current_points($reseller_id) 
    {
        $in = $this->transaction_in($reseller_id);
        $out = $this->transaction_out($reseller_id);
        $commission = $this->transaction_commissions($reseller_id);
        $charge = $this->transaction_charge($reseller_id);
        $balance = $in + $commission - $out - $charge;                                    
        return $balance;
    }    
    
    
    function smstopup($product,$dest,$amount)
    { 
        //Your username/agent id 
        $username = "H00807";         
        //Hashed password provided by SMSTopUp 
        $password = "W8Hc<Bvn2@"; 
        //6 digit pin 
        $pin = "5238"; 
        //Unique merchant reference id 
        $refid = "H00807"; 

        //Product code. http://smstopup.com.my/pdf/Product.pdf 
        //$product = "C"; 
        //Customer account number/mobile number 
        //$dest = "0123456789";
        //Amount to topup 
        //$amount = "10";

        //API URL 
        $URL = "https://api.smstopup.com.my/request.php";        

        //Format: Username|Password|Pin|ReferenceID|Product|Destination|Amount 
        //EG: H001234|461OG6324m2ylph0MJC1TG4V4sI80Yc0|123456|1234|C|0123456789|5 
        $string = $username . "|" . $password . "|" . $pin . "|" . $refid . "|" .$product . "|" .$dest . "|" . $amount;    

        //Hashed signature 
        $sign = base64_encode(sha1($string));

        //HTTP POST Parameter - username, password, pin, refid, product, dest, amount, sign 
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

        //Close the handle 
        curl_close($ch); 

        //Output the result 
        return nl2br($result);
    
    }

    
    function smstopup_balance()
    {
        //Your username/agent id 
        $username = "H00807"; 

        //Hashed signature provided by SMSTopUp 
        $sign = "n4WB9LzliUeOu_bmzPZ0H6zFNLc"; 

        //API URL 
        $URL = "https://api.smstopup.com.my/balance.php";
        
        //HTTP POST Parameter - username, password, pin, refid, product, dest, amount, sign 
        $parameter = "username=" . $username . "&sign=" . $sign ;        

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
        if ( curl_errno($ch) ) { 
            $result = 'ERROR -> ' . curl_errno($ch) . ': ' . curl_error($ch); 
        } else { 
            $returnCode = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE); 
            switch($returnCode){ 
                case 200: 
                    break; 
                default: 
                    $result = 'HTTP ERROR -> ' . $returnCode; break; 
            }
        }
        
        //Close the handle 
        curl_close($ch); 

        //Output the result 
        return nl2br($result);        
    }    
    
    
}

?>