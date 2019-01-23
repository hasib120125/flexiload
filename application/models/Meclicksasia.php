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
function product_price($table,$field,$value) {

        // $query = $this->db->get_where($table, array($field => $value));
        //echo $this->db->last_query();
        $query = $this->db->query("SELECT plan_rate.*, plan_productname.* FROM plan_rate  left join plan_productname on plan_productname.product_code= plan_rate.product where plan_rate.plan_id ='$value' ");
        return $query->result_array();
    }

    function rates() {
        $this->db->where('deleted', '0');
        $query = $this->db->get_where('rates');
        return $query->result_array();
    }
function topupsuccess($id) {
        $this->db->where('transaction_id', $id);
        $query = $this->db->get('transaction');
        return $query->row();
    }

    function comissione_list() {
        $this->db->where('deleted', '0');
        $query = $this->db->get_where('plan');
        return $query->result_array();
    }

    function charge() {
        $this->db->where('deleted', '0');
        $query = $this->db->get_where('charge');
        return $query->result_array();
    }

    function plan_rate_comission($plan_id, $product) {
        $query = $this->db->get_where('plan_rate', array('plan_id' => $plan_id, 'product' => $product));
        return $query->row()->comission;
    }

    function transaction_commission($product) {
        $admin_id = $this->session->userdata('admin_id');
        $plan_id = $this->table_info('admin', 'admin_id', $admin_id)->plan_id;
        $query = $this->db->get_where('plan_rate', array('plan_id' => $plan_id, 'product' => $product));
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
        $this->db->order_by('rates_id', 'desc');
        $this->db->limit(1);
        $query = $this->db->get('rates');
        return $query->row();
    }

    function last_messages() {
        $this->db->order_by('id', 'desc');
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
        $this->db->order_by('charge_id', 'desc');
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
function table_data_last_toppup($table, $column_name, $column_value, $order_by) {
        
        $query = $this->db->query("SELECT * FROM transaction WHERE admin_id = '$column_value' ORDER BY created_at desc limit 10");
        return $query->result_array();
    }

    function table_data2($table, $column_name, $column_value, $order_by) {
        $this->db->order_by($order_by, 'asc');
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

    function generateStrongPassword($length = 9, $add_dashes = false, $available_sets = 'ludx') {
        $sets = array();
        if (strpos($available_sets, 'l') !== false)
            $sets[] = 'abcdefghjkmnpqrstuvwxyz';
        if (strpos($available_sets, 'u') !== false)
            $sets[] = 'ABCDEFGHJKMNPQRSTUVWXYZ';
        if (strpos($available_sets, 'd') !== false)
            $sets[] = '23456789';
        if (strpos($available_sets, 'x') !== false)
            $sets[] = '!@#$%&*?';
        $all = '';
        $password = '';
        foreach ($sets as $set) {
            $password .= $set[array_rand(str_split($set))];
            $all .= $set;
        }
        $all = str_split($all);
        for ($i = 0; $i < $length - count($sets); $i++)
            $password .= $all[array_rand($all)];
        $password = str_shuffle($password);
        if (!$add_dashes)
            return $password;
        $dash_len = floor(sqrt($length));
        $dash_str = '';
        while (strlen($password) > $dash_len) {
            $dash_str .= substr($password, 0, $dash_len) . '-';
            $password = substr($password, $dash_len);
        }
        $dash_str .= $password;
        return $dash_str;
    }

     function current_points($reseller_id) {

        $ttl_deposit = 0;
        $ttl_commission = 0;
        $ttl_charge = 0;
        $ttl_cost_point = 0;
        $total_country_out = '';
        $ttl_actual_cost = '';
        $balance = 0;

        $query = $this->meclicksasia->table_data('transaction', 'admin_id', $reseller_id, 'created_at');

//        dumpVar($query);
        foreach ($query as $row):
            $country_out = 0;
            $commission = 0;
            $charge = 0;

            if ($row['class'] == 'In'):
                $ttl_deposit += $row['amount'];
            else:
            endif;
            if ($row['class'] == 'Out'):
                $country_out = $row['amount'] / $row['rm_rate'];
                $total_country_out += $row['amount'] / $row['rm_rate'];
            else:
            endif;

            if ($row['country'] == 'Malaysia') {
                $ttl_cost_point +=$row['amount'];
            } elseif ($row['country'] == 'Indonesia') {
                $cost_point = $row['amount'] / $row['rm_rate'];
                $ttl_cost_point += $row['amount'] / $row['rm_rate'];
            } else if ($row['rm_rate'] != 0) {
                $cost_point = $row['amount'] / $row['rm_rate'];
                $ttl_cost_point += $row['amount'] / $row['rm_rate'];
            }
            if ($row['country'] == 'Malaysia') {
                $commission = $row['commission'];
                $ttl_commission += $row['commission'];
            }
            $charge = $row['charge'];
            $ttl_charge += $row['charge'];
            $test = $row['amount'];
            if ($row['country'] == 'Malaysia') {
                $actual_cost = $test - $commission;
                $ttl_actual_cost += $actual_cost;
            } elseif (($row['country'] == 'Indonesia') || ($row['country'] == 'Nepal')) {
                $ttl_actual_cost += $cost_point;
            } elseif (($row['type'] == 'Personal') || ($row['type'] == 'Agent')) {
                $actual_cost = $cost_point + $charge;
                $ttl_actual_cost += $actual_cost;
            } elseif ($row['country'] == 'Bangladesh') {
                $ttl_actual_cost += $cost_point;
            }

            $balance = $ttl_deposit - $ttl_charge - $ttl_actual_cost;
        endforeach;
        return $balance;
    }

    function smstopup($product, $dest, $amount) {
        //Your username/agent id 
        $username = "3000798";
        //Hashed password provided by SMSTopUp 
        $password = "W8Hc<Bvn2@";
        //6 digit pin 
        $pin = "5238";
        //Unique merchant reference id 
        $refid = "3000798";

        //Product code. http://smstopup.com.my/pdf/Product.pdf 
        //$product = "C"; 
        //Customer account number/mobile number 
        //$dest = "0123456789";
        //Amount to topup 
        //$amount = "10";
        //API URL 
        $URL = "https://api.iimmpact.com/request-v2.php";

        //Format: Username|Password|Pin|ReferenceID|Product|Destination|Amount 
        //EG: H001234|461OG6324m2ylph0MJC1TG4V4sI80Yc0|123456|1234|C|0123456789|5 
        $string = $username . "|" . $password . "|" . $pin . "|" . $refid . "|" . $product . "|" . $dest . "|" . $amount;

        //Hashed signature 
        $sign = base64_encode(sha1($string));

        //HTTP POST Parameter - username, password, pin, refid, product, dest, amount, sign 
        $parameter = "username=" . $username . "&password=" . $password . "&pin=" . $pin . "&refid=" . $refid . "&product=" . $product . "&dest=" . $dest . "&amount=" . $amount . "&sign=" . $sign;

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
        if (curl_errno($ch)) {
            $result = 'ERROR -> ' . curl_errno($ch) . ': ' . curl_error($ch);
        } else {
            $returnCode = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
            switch ($returnCode) {
                case 200: break;
                default: $result = 'HTTP ERROR -> ' . $returnCode;
                    break;
            }
        }

        //Close the handle 
        curl_close($ch);

        //Output the result 
        return nl2br($result);
    }

    function smstopup_balance() {
        //Your username/agent id 
        $username = "3000798";

        //Hashed signature provided by SMSTopUp 
        $sign = "n4WB9LzliUeOu_bmzPZ0H6zFNLc";

        //API URL 
        $URL = "https://api.iimmpact.com/request-v2.php";

        //HTTP POST Parameter - username, password, pin, refid, product, dest, amount, sign 
        $parameter = "username=" . $username . "&sign=" . $sign;

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
        if (curl_errno($ch)) {
            $result = 'ERROR -> ' . curl_errno($ch) . ': ' . curl_error($ch);
        } else {
            $returnCode = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
            switch ($returnCode) {
                case 200:
                    break;
                default:
                    $result = 'HTTP ERROR -> ' . $returnCode;
                    break;
            }
        }

        //Close the handle 
        curl_close($ch);

        //Output the result 
        return nl2br($result);
    }

}

?>