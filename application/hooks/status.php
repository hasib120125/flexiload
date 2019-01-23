<?php 

class Status 
{    
    function login() 
    {
        $CI = & get_instance();
        if($CI->router->class == 'user') 
        {
            return;            
        }
        $CI->load->library('session');
        $loginstatus = $CI->session->userdata('status');
        if(!$loginstatus)
        {
            redirect('user/login', 'refresh');            
        }
    }  
}

?>
