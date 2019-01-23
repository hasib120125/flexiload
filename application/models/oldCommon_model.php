<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Common_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    function password_recover_email($email) {

        $sql = "SELECT * FROM registration WHERE email = '{$email}'";

        $query = $this->db->query($sql);
        return $query->row_array();
    }

    //conta us email


    function contact_us_mail($data_info) {
        $mailBody = '';
        $headers = '';
        $subject = 'Contact Us Message';
        $mailBody = '<p>Dear Admin,</p>&nbsp;';
        $mailBody.='<p>You have a message from following user</p>';
        $mailBody .= "Name:-" . $data_info['contact_name'];
        $mailBody .="<br>Email:-" . $data_info['contact_email'];
        $mailBody .= "<br>Su:-" . $data_info['subject'];
        $mailBody .= "<br>MESSAGE:-" . $data_info['message'];
        //dumpVar($mailBody);
        $headers = "From: " . strip_tags($data_info['contact_email']) . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        $to = "toalaminbd@gmail.com";
        //dumpVar($headers);
        mail($to, $subject, $mailBody, $headers);
    }

    function reset_password_mail($reset_info) {
        $user_mail = $reset_info['user_info']['email'];
        $link = $reset_info['link'];
        $mailBody = '';
        $headers = '';
        $subject = 'Reset password instructions';
        $mailBody = 'Hello  ' . $reset_info['user_info']['email'];
        $mailBody .= '<p>Someone has requested a link to change your password. You can do this through the link below.</p>';
        $mailBody .= "<a href=" . $link . ">Change my password</a>";
        $mailBody .= "<p>If you didn't request this, please ignore this email.</p>";
        $mailBody .= "<p>Your password won't change until you access the link above and create a new one.</p>";
        dumpVar($mailBody);
        $headers = "From: " . strip_tags(DoctorOnline) . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        $to = $user_mail;
        mail($to, $subject, $mailBody, $headers);
    }

    //reseet passwor mail
//    function reset_password_mail($reset_info) {
//        $user_mail = $reset_info['user_info']['email_address'];
//        //dumpVar($user_mail);
//        $mailBody = '';
//        $headers = '';
//        $subject = 'Reset Your Password';
//
//        $mailBody .= '<p>Please click on the link below to reset your password.</p>';
//
//        $mailBody .="<br><p> " . $reset_info['link'] . "</p>";
//
//        //dumpVar($mailBody);
//        $headers = "toalaminbd@gmail.com";
//        $headers .= "MIME-Version: 1.0\r\n";
//        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
//        $to = $user_mail;
//        //dumpVar($headers);
//        mail($to, $subject, $mailBody, $headers);
//    }
    // add new data into a database table
    function insert_data($table_name, $data) {
        $this->db->insert($table_name, $data);
        return $this->db->insert_id();
    }

    // update data by id of a database table
    function update_data($table_name, $data, $column_name, $column_value) {
        $this->db->where($column_name, $column_value);
        $this->db->update($table_name, $data);
        return $this->db->affected_rows();
    }

    // delete data by id of a database table
    function delete_data($table_name, $column_name, $column_value) {
        $this->db->where($column_name, $column_value);
        $this->db->delete($table_name);
        return $this->db->affected_rows();
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

    function get_data_list1($table_name, $order_column_name = NULL, $order = NULL, $start_limit = NULL, $per_page = NULL) {
        if (isset($order_column_name) && isset($order))
            $this->db->order_by($order_column_name, $order);
        if (isset($start_limit))
            $this->db->limit($per_page, $start_limit);
        return $this->db->get($table_name)->row_array();
    }

    // get single data by single column of a database table
    function get_single_data_by_single_column($table_name, $column_name, $column_value) {
        $this->db->where($column_name, $column_value);
        return $this->db->get($table_name)->row_array();
    }

    // get single data by many columns of a database table
    function get_data_list_by_many_columns($table_name, $column_array, $order_column_name = NULL, $order = NULL, $start_limit = NULL, $per_page = NULL) {
        $this->db->where($column_array);
        if (isset($order_column_name) && isset($order))
            $this->db->order_by($order_column_name, $order);
        if (isset($start_limit))
            $this->db->limit($per_page, $start_limit);
        return $this->db->get($table_name)->result_array();
    }

    // get single data by many columns of a database table
    function get_single_data_by_many_columns($table_name, $column_array) {
        $this->db->where($column_array);
        $result = $this->db->get($table_name)->row_array();
        return $result;
        //dumpVar($result);
    }

    // get number of rows of a database table
    function count_all_data($table_name) {
        return $this->db->count_all($table_name);
    }

    function get_city_list() {
        //$query = "SELECT * FROM city INNER JOIN state ON city.state_id = state.state_id";
        $this->db->select('*');
        $this->db->from('wzt_city');
        $this->db->join('wzt_state', 'wzt_state.state_id = wzt_city.state_id', 'inner');

        $query = $this->db->get()->result_array();
        ;
        return $query;
    }

    function get_model_list() {
        //$query = "SELECT * FROM city INNER JOIN state ON city.state_id = state.state_id";
        $this->db->select('*');
        $this->db->from('wzt_product_model');
        $this->db->join('wzt_product_brand', 'wzt_product_brand.brand_id = wzt_product_model.brand_id', 'inner');
        $this->db->order_by('brand_name', 'asc');
        $this->db->order_by('product_model_name', 'asc');
        $query = $this->db->get()->result_array();
        return $query;
    }

    function get_area_list() {
        //$query = "SELECT * FROM city INNER JOIN state ON city.state_id = state.state_id";
        $this->db->select('*');
        $this->db->from('wzt_area');
        $this->db->join('wzt_city', 'wzt_city.city_id = wzt_area.city_id', 'inner');
        $this->db->order_by('city_name', 'asc');
        $this->db->order_by('area_name', 'asc');
        $query = $this->db->get()->result_array();
        return $query;
    }

    function get_advertise_list() {
        //$query = "SELECT * FROM city INNER JOIN state ON city.state_id = state.state_id";
        $this->db->select('*');
        $this->db->from('wzt_product_advertise');
        $this->db->join('wzt_product_seller_information', 'wzt_product_seller_information.product_advertise_id = wzt_product_advertise.product_advertise_id', 'inner');
        $this->db->order_by('wzt_product_advertise.product_advertise_id', 'DESC');
        $query = $this->db->get()->result_array();
        ;
        return $query;
    }

    function delete_adds($delete_product_advertise_id) {
        foreach ($delete_product_advertise_id as $key => $value) {
            $images = $this->Common_model->get_data_list_by_single_column('wzt_product_advertise_image', 'product_advertise_id', $value);
            //  dumpVar($images);
            // exit;
            foreach ($images as $key2 => $value2) {
                $this->db->where('product_advertise_image_id', $value2['product_advertise_image_id']);
                $this->db->delete('wzt_product_advertise_image');
                unlink('uploads/' . $value2['image_name']);
                unlink('uploads/thumb/' . $value2['image_name']);
            }
            $this->db->where('product_advertise_id', $value);
            $this->db->delete('wzt_product_advertise');
        }
    }

    function delete_brand_from_model_table($brand_id) {
        //dumpVar($brand_id);
        $product_advertise_id = array();
        $result = $this->Common_model->get_data_list_by_single_column('wzt_product_advertise', 'brand_id', $brand_id);
        foreach ($result as $key => $value) {
            $product_advertise_id[] = $value['product_advertise_id'];
        }
        $this->Common_model->delete_adds($product_advertise_id);
        // dumpVar($product_advertise_id);
        $this->db->where('brand_id', $brand_id);
        $this->db->delete('wzt_product_model');
    }

    public function check_status() {
        $this->db->where('user_id', $_SESSION['session_user_id']);
        $this->db->where('status', 1);
        $result = $this->db->get('wzt_user')->result_array();
        return $result;
    }

    function get_search_advertise($search_data, $startLimit = NULL, $per_page = NULL) {

        $order_by_column = $order_by = NULL;
        $order_by = " approve_disapprove_date DESC ";
        $sql = $limit = "";
        $condition = " WHERE ";

        if (isset($search_data['price_sort']) && $search_data['price_sort'] != "") {
            if ($search_data['price_sort'] == 1) {
                $order_by = " DESC  approve_disapprove_date ";
            } else if ($search_data['price_sort'] == 2) {
                $order_by = "ASC selling_price ";
            } elseif ($search_data['price_sort'] == 3) {
                $order_by = "DESC selling_price";
            }
        }
        //dumpVar($search_data);
        if ($per_page != NULL) {
            $limit = " LIMIT $startLimit, $per_page ";
        }

        if (isset($search_data['city_id']) && $search_data['city_id'] != "") {
            $condition .= "  wpa.city_id = {$search_data['city_id']} ";
        }

        if (isset($search_data['area_id']) && $search_data['area_id'] != "") {
            $area_ids = implode(',', $search_data['area_id']);
            $condition .= " AND  wpa.area_id IN($area_ids) ";
        }

        if (isset($search_data['brand_id']) && $search_data['brand_id'] != "all") {
            $condition .= " AND wpa.brand_id = {$search_data['brand_id']} ";
        }

        if (isset($search_data['product_model_id']) && $search_data['product_model_id'] != "all") {
            $condition .= " AND wpa.product_model_id = {$search_data['product_model_id']} ";
        }

        if (isset($search_data['condition']) && $search_data['condition'] != "all") {
            $condition .= " AND wpa.condition = {$search_data['condition']} ";
        }

        if (isset($search_data['selling_price']) && $search_data['selling_price'] != "all") {
            $sell = split('-', $search_data['selling_price']);
            //print_r($sell); exit;
            if ($sell[1] == 'below')
                $condition .= " AND wpa.selling_price <= {$sell[0]} ";
            elseif ($sell[1] == 'avobe')
                $condition .= " AND wpa.selling_price >= {$sell[0]} ";
            else
                $condition .= " AND (wpa.selling_price >= {$sell[0]} AND  wpa.selling_price <= {$sell[1]})";
        }

        if (isset($search_data['product_colour_id']) && $search_data['product_colour_id'] != "all") {
            $condition .= " AND wpa.product_colour_id = {$search_data['product_colour_id']}";
        }
        $condition .= " AND wpa.is_published = 1";

        if (isset($search_data['no_of_sim']) && $search_data['no_of_sim'] != "all") {
            $condition .= " AND wps.no_of_sim = {$search_data['no_of_sim']}";
        }
        if (isset($search_data['operating_system']) && $search_data['operating_system'] != 'all') {
            $condition .= " AND wps.operating_system = '{$search_data['operating_system']}'";
        }
        if (isset($search_data['phone_type']) && $search_data['phone_type'] != "all") {
            if ($search_data['phone_type'] == 1)
                $condition .= " AND wps.has_gsm = 1";
            if ($search_data['phone_type'] == 2)
                $condition .= " AND wps.has_cdma = 1";
        }
        if (isset($search_data['screen_size_inch']) && $search_data['screen_size_inch'] != "all") {
            $sell = split('-', $search_data['screen_size_inch']);
            if ($sell[1] == 'below')
                $condition .= " AND wps.screen_size_inch < {$sell[0]} ";
            elseif ($sell[1] == 'avobe')
                $condition .= " AND wps.screen_size_inch >= {$sell[0]} ";
            else
                $condition .= " AND (wps.screen_size_inch >= {$sell[0]} AND  wps.screen_size_inch <= {$sell[1]})";
        }
        if (isset($search_data['primary_camera_mp']) && $search_data['primary_camera_mp'] != "all") {
            $sell = split('-', $search_data['primary_camera_mp']);
            if ($sell[1] == 'below')
                $condition .= " AND wps.primary_camera_mp < {$sell[0]} ";
            elseif ($sell[1] == 'avobe')
                $condition .= " AND wps.primary_camera_mp >= {$sell[0]} ";
            else
                $condition .= " AND (wps.primary_camera_mp >= {$sell[0]} AND  wps.primary_camera_mp <= {$sell[1]})";
        }

        if (isset($search_data['no_of_cores']) && $search_data['no_of_cores'] != 'all') {
            $condition .= " AND wps.no_of_cores = '{$search_data['no_of_cores']}'";
        }

        if (isset($search_data['user_type']) && $search_data['user_type'] != 'all') {
            $condition .= " AND wu.user_type = '{$search_data['user_type']}'";
        }

        if (isset($search_data['features']) && $search_data['features'] != 'all') {
            foreach ($search_data['features'] as $key => $value) {
                $condition .= " AND wps.$key = 1";
            }
        }
        $sql = "SELECT wpa.*, wpm.product_id"
                . " FROM wzt_product_advertise wpa "
                . " JOIN wzt_user wu ON wu.user_id = wpa.user_id "
                . "  JOIN wzt_product_model wpm ON wpa.product_model_id = wpm.product_model_id "
                . "  JOIN wzt_product_specs wps ON wpm.product_id = wps.product_id"
                . " $condition ORDER BY $order_by $limit";
        return $this->db->query($sql)->result_array();
    }

    function update_credit($column_name, $user_id) {

        $sql2 = "SELECT * FROM wzt_user WHERE user_id = $user_id";
        $result = row_array($sql2);
        //dumpVar($result);

        if ($result[$column_name] > 0) {
            $sql = "UPDATE wzt_user SET $column_name = $column_name -1 WHERE user_id = $user_id";
            $this->db->query($sql);
        }
    }

    function update_package_credit($column_name, $user_id) {

        $sql = "SELECT * FROM wzt_user_package WHERE user_id = $user_id ORDER BY package_taken_date ASC";
        $result = result_array($sql);
        //dumpVar($result);
        foreach ($result as $each_package) {

            if ($column_name == 'used_outgoing') {
                if (($each_package['used_outgoing'] < get_outgoing_amount($each_package['package_id'])) && $each_package['expired_status'] == 0) {
                    $sql2 = "UPDATE  wzt_user_package SET $column_name = $column_name + 1 WHERE package_id = {$each_package['package_id']} AND user_id = $user_id";
                    $this->db->query($sql2);
                    break;
                }
            }
            if ($column_name == 'used_incoming') {
                if (($each_package['used_incoming'] < get_incoming_amount($each_package['package_id'])) && $each_package['expired_status'] == 0) {
                    $sql2 = "UPDATE  wzt_user_package SET $column_name = $column_name + 1 WHERE package_id = {$each_package['package_id']} AND user_id = $user_id ";
                    $this->db->query($sql2);
                    break;
                }
            }
        }
    }

    function get_message() {
        $sql = "SELECT wzt_user_message.*,wzt_reply_message.reply_sender_id as reply_id,wzt_reply_message.reply_receiver_id as reply_id, wzt_reply_message.reply_sender_id as reply_id  FROM wzt_user_message "
                . "LEFT JOIN wzt_reply_message "
                . "ON wzt_user_message.message_id = wzt_reply_message.message_id "
                . "WHERE wzt_user_message.message_receiver_id = {$_SESSION['session_user_id']}  "
                . "ORDER BY wzt_user_message.sending_date,wzt_reply_message.replying_date DESC";
        $result = $this->db->query($sql)->result_array();
    }

    function set_message_status($message_id) {

        $data['message_status'] = 1;
        $data['message_id'] = $message_id;

        $this->Common_model->update_data('wzt_user_message', $data, 'message_id', $message_id);
    }

    function favorite_user_list() {
        $result2 = "";
        $sql = "SELECT * FROM wzt_user_favorite JOIN wzt_user ON wzt_user_favorite.favorite_user_id = wzt_user.user_id WHERE wzt_user_favorite.user_id = {$_SESSION['session_user_id']} AND wzt_user.profile_status = 0";
        $result = $this->db->query($sql)->result_array();

        foreach ($result as $value) {
            $query = "SELECT * FROM wzt_user_block WHERE user_id = {$value['user_id']} AND blocked_user_id = {$_SESSION['session_user_id']}";
            $result_array = row_array($query);
            //dumpVar($result_array);
            if (!empty($result_array)) {
                continue;
            }
            $result2[] = $value;
        }

        return $result2;
        //dumpVar($result2);
    }

    function user_login_check_status($email, $password) {

        $sql = "SELECT * FROM user WHERE email_address = '$email' AND password ='$password' AND status = 1 LIMIT 1";
        // echo $sql; exit;
        $query = $this->db->query($sql);
        // print_r( $query->row_array());exit;
        return $query->row_array();
    }

    function admin_login_check($email, $password) {

        $sql = "SELECT * FROM admin WHERE email = '{$email}' AND password ='{$password}' LIMIT 1";
        // echo $sql; exit;
        $query = $this->db->query($sql);
        // print_r( $query->row_array());exit;
        return $query->row_array();
    }

    function user_login_check($email, $password) {

        $sql = "SELECT * FROM registration WHERE email = '$email' AND password ='$password' LIMIT 1";
        // echo $sql; exit;
        $query = $this->db->query($sql);
        // print_r( $query->row_array());exit;
        return $query->row_array();
    }

    function user_email_check($email) {
        $sql = "SELECT * FROM registration WHERE email = '$email' LIMIT 1";
        // echo $sql;exit;
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function duplicate_email($email, $id) {
        $sql = "SELECT * FROM demand WHERE contact_email= '$email' AND demand_id != '$id'  LIMIT 1";
        // echo $sql;exit;
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function get_user_info($id) {
        $sql = "SELECT * FROM registration WHERE user_id = '$id' LIMIT 1";
        //echo $sql;exit;
        $query = $this->db->query($sql);
        return $query->row_array();
    }

    function user_email_check2($email, $user_id) {
        $sql = "SELECT * FROM registration WHERE email = '$email' AND user_id !='$user_id' LIMIT 1";
        //echo $sql;exit;
        $query = $this->db->query($sql);
        return $query->result_array();
    }

}

?>