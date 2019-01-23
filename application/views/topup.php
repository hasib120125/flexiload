<!DOCTYPE html>
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <title><?php echo $title; ?></title>
        <meta name="description" content="Zaman-IT.com">
        <meta name="author" content="Dhaka Pharma">
        <!-- Mobile Meta -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php $this->load->view('reseller/header'); ?> 
    </head>
    <body class="front no-trans">
        <div class="scrollToTop"><i class="icon-up-open-big"></i></div>
        <div class="page-wrapper">
            <?php $this->load->view('reseller/menu'); ?> 


            <section class="main-container">
                <div class="container">
                    <div class="row" >
                        <div class="main col-md-12">

                            <!-- Message -->
                            <?php 
                            $success = $this->session->userdata('success');
                            $error = $this->session->userdata('error');
                            if (isset($success) || !empty($success)): ?>
                                <div class="alert alert-success fade in widget-inner">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <?php echo $success; ?>
                                </div>            
                            <?php 
                            $this->session->unset_userdata('success');                            
                            elseif(isset($error) || !empty($error)): ?>
                                <div class="alert alert-danger fade in widget-inner">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <?php echo $error; ?>
                                </div>                              
                            <?php $this->session->unset_userdata('error');
                            endif; ?>
                            <!-- /Message -->

                            <!-- Response -->
                            <?php 
                            $response = $this->session->userdata('response');
                            if (isset($response) || !empty($response)): ?>
                                <div class="alert alert-info fade in widget-inner">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <?php echo $response; ?>
                                </div> 
                            <?php endif;
                            $this->session->unset_userdata('response'); ?>
                            <!-- /Response -->
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            <?php
                            $query = $this->meclicksasia->last_charge();
                            $query['charge_id'];
                            $query = $this->db->get_where('charge', array('charge_id' => $query['charge_id']));
                            $result = $query->row_array();
                            //dumpVar($result);
                            ?>

                            <?php
                            $query = $this->meclicksasia->last_rates();
                            $query['rates_id'];
                            $query = $this->db->get_where('rates', array('rates_id' => $query['rates_id']));
                            $results = $query->row_array();
                            //dumpVar($results['bangladesh']);
                            ?>


                            <p style="text-align:right; background:#cf2e16; color:white; boarder: 1px solid white; padding:5px">&nbsp;
                                <b>**Your Current Points: <?php 
                                $admin_id = $this->session->userdata('admin_id');
                                $balance = $this->meclicksasia->current_points($admin_id); 
                                echo number_format((float)$balance,2,'.',''); ?>
                                </b>
                                <input type="hidden" name="current_point" id="current_point" value="<?php echo $balance; ?>"/>

                            </p>
                            <ul class="nav nav-tabs" role="tablist">
                                <li <?php if (isset($segment) && $segment == 'BANGLADESH_FLEXILOAD'): ?>class="active"<?php endif; ?>><a href="components-tabs-and-pills.html#htab1" role="tab" data-toggle="tab"><img src="<?php echo base_url() ?>assets/images/bd.svg" width="30px" height="30px" style="float:left;">&nbsp;&nbsp; Bangladesh Top-Up</a></li>
                                <li <?php if (isset($segment) && $segment == 'BANGLADESH_EWALLET'): ?>class="active"<?php endif; ?>><a href="components-tabs-and-pills.html#htab2" role="tab" data-toggle="tab"><img src="<?php echo base_url() ?>assets/images/pww.png" width="30px" height="30px" style="float:left;">&nbsp;&nbsp; e-Wallet</a></li>
                                <li <?php if (isset($segment) && $segment == 'MALAYSIA_TOPUP'): ?>class="active"<?php endif; ?>><a href="components-tabs-and-pills.html#htab3" role="tab" data-toggle="tab"><img src="<?php echo base_url() ?>assets/images/my.svg" width="30px" height="30px" style="float:left;">&nbsp;&nbsp; Malaysia Top-Up</a></li>
                                <li <?php if (isset($segment) && $segment == 'INDONESIA_TOPUP'): ?>class="active"<?php endif; ?>><a href="components-tabs-and-pills.html#htab4" role="tab" data-toggle="tab"><img src="<?php echo base_url() ?>assets/images/id.svg" width="30px" height="30px" style="float:left;">&nbsp;&nbsp; Indonesia Top-Up</a></li>
                                <li <?php if (isset($segment) && $segment == 'NEAPL_TOPUP'): ?>class="active"<?php endif; ?>><a href="components-tabs-and-pills.html#htab5" role="tab" data-toggle="tab"><img src="<?php echo base_url() ?>assets/images/np.svg" width="30px" height="30px" style="float:left;">&nbsp;&nbsp; Nepal Top-Up</a></li>                                
                            </ul>                             
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane <?php if (isset($segment) && $segment == 'BANGLADESH_FLEXILOAD'): ?>fade in active<?php endif; ?>" id="htab1" style="background-color: #eeeeee;">
                                    <div class="row">
                                        <div class="col-md-10 form-horizontal">        
                                            <!--<form action="#" role="form"  method="post" id="adminformbd"  class="form-horizontal">-->			

                                                <div class="form-group">
                                                    <label for="field-3" class="col-sm-3 control-label">Phone No.</label>
                                                    <div class="col-sm-9">
                                                        <input type="number" class="form-control bdf_phone_no" name="phone_no" id="phone_no" placeholder="Ex. 01771000001">
                                                        <span id="phone_no_error" style="color:red;display:none;">Phone NO Can't be empty!!</span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="field-3" class="col-sm-3 control-label">Type</label>
                                                    <div class="col-sm-9">
                                                        <div class="radio"><label><input type="radio" name="type" id="bdf_type" value="Prepaid" checked="checked">Prepaid</label></div>
                                                        <div class="radio"><label><input type="radio" name="type" id="bdf_type" value="Postpaid">Postpaid</label></div>
                                                        <span id="type_error" style="color:red;display:none;">Select a Type!!</span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="field-3" class="col-sm-3 control-label">Amount</label>
                                                    <div class="col-sm-9"> <!---validation code here onblur="check_current_valance(this.value)"-->
                                                        <input type="number"  name="amount" class="form-control bdf_amount" id="amount" placeholder="0.00 BDT">
                                                        <span id="amount_error" style="color:red;display:none;">Amount Can't be empty!!</span>
                                                        <span id="maximum_message" style="color:red;display:none;">Sorry your current balance exceeds. Please Top-Up to continue...</span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-offset-3 col-sm-9">
                                                        <button id="sbt_button" onclick="bangladesh_flexiload()" type="submit" onclick="form_validation()" class="btn btn-default">Submit</button>
                                                    </div>
                                                </div>
                                                <div id="wait" style="display:none;width:50px;height:50px;border:1px solid #ddd;position:absolute;top:30%;left:50%;padding:5px;font-size:11px;"><img src='<?php echo base_url(); ?>assets/images/loader.gif'/><br>Loading..</div>
<script type="text/javascript">
    $(document).ready(function () {
        $(document).ajaxStart(function(){
            $("#wait").css("display", "block");
        });    
        $(document).ajaxComplete(function(){
            $("#wait").css("display", "none");
        });     
    });
    
    function bangladesh_flexiload() { 
        var phone_no = $('.bdf_phone_no').val();
        var type = $('.bdf_type').val();
        var amount = $('.bdf_amount').val();
        if(confirm('Are you sure you want to Top-Up?\n Phone No.: '+phone_no+'\n Type: '+type+'\n Amount: BDT.'+amount)) {
            $.ajax({
                type: 'POST',
                data: {phone_no:phone_no, type:type, amount:amount},
                url: '<?php echo site_url('bangladesh_flexiload'); ?>',
                success: function (result) {
                    $('#topup_result').html(result);
                }
            });
        }
    } 
    
    function check_current_valance(give_value) {
        //alert(give_value);
        var current_point = $("#current_point").val();
        var bd_rate = '<?php echo $results['bangladesh']; ?>';
        var cov_result = give_value / bd_rate;
        //alert(cov_result);
        if (cov_result >= current_point) {
            $("#sbt_button").attr("disabled", true);
            $("#maximum_message").show();
        } else {
            $("#sbt_button").attr("disabled", false);
            $("#maximum_message").hide();
        }
    }    
       
    function form_validation() {

        var operator = $("#operator").val();
        var operator_lent = $("#operator").val().length;
        var phone_no = $("#phone_no").val();

        var amount = $("#amount").val();
        var amount_length = $("#amount").val().length;
        var type_value = $('input[name=type]:checked', '#adminformbd').val();

        var operator_conf = '';
        var phone_no_conf = '';
        var type_conf = '';
        var amountconf = '';


        if (operator_lent == 0) {
            $("#operator_error").show();
            var operator_conf = false;
        } else {
            $("#operator_error").hide();
            var operator_conf = true;
        }
        if (phone_no == '') {
            $("#phone_no_error").show();
            var phone_no_conf = false;
        } else {
            $("#phone_no_error").hide();
            var phone_no_conf = true;
        }
        if (typeof (type_value) == 'undefined') {
            $("#type_error").show();
            var type_conf = false;
        } else {
            $("#type_error").hide();
            var type_conf = true;
        }
        if (amount == '') {
            $("#amount_error").show();
            var amountconf = false;
        } else {
            $("#amount_error").hide();
            var amountconf = true;
        }

        if (operator_conf == true && phone_no_conf == true && type_conf == true && amountconf == true) {
            $("#adminform").submit();
        } else {
            return false;
        }
    }       
</script> 
                                            <!--</form>--> 
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane <?php if (isset($segment) && $segment == 'BANGLADESH_EWALLET'): ?>fade in active<?php endif; ?>" id="htab2">
                                    <div class="row">
                                        <div class="col-md-10 form-horizontal">                                                                                  
                                            <!--<form action="#" role="form" method="post"   class="form-horizontal">-->			
                                                <input type="hidden" name="reseller_id" value="<?php echo $this->session->userdata('admin_id'); ?>">
                                                <div class="form-group">
                                                    <label for="field-3" class="col-sm-3 control-label">Phone No.</label>
                                                    <div class="col-sm-9">
                                                        <input type="number" class="form-control bde_phone_no" name="phone_no" id="phone" placeholder="Ex. 01771000001">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="field-3" class="col-sm-3 control-label">Reference</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control bde_reference" name="reference" placeholder="Reference ID / Name">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="field-3" class="col-sm-3 control-label">Type</label>
                                                    <div class="col-sm-9">
                                                        <div class="radio"><label><input type="radio" name="type" class="bde_type" value="Personal" checked="checked">Personal</label></div>
                                                        <div class="radio"><label><input type="radio" name="type" class="bde_type" value="Agent">Agent</label></div>
                                                    </div>
                                                </div>  
                                                <div  id="form" class="form-group ">
                                                    <div class="form-group ">
                                                        <label id="from" for="field-3" class="col-sm-3 control-label">Amount</label>                                              
                                                        <div class="col-sm-9" id="tofrom1">
                                                            <input  id="amount" onblur="check_current_valance_ew(this.value)"  name="amount" type="number" class="form-control bde_amount" placeholder="0.00">                                                        
                                                            <input style="width:40%; color:red" class="form-control" value="Charge <?php echo $result['amount'] ?> RM" disabled>   
                                                            <span id="maximum_message_ew" style="color:red;display:none;">Sorry your current balance exceeds. Please Top-Up to continue...</span>

                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-offset-3 col-sm-9">
                                                        <button id="sbt_button_ew" onclick="bangladesh_ewallet()" type="submit" class="btn btn-default">Submit</button>
                                                    </div>
                                                </div>
                                                <div id="wait" style="display:none;width:50px;height:50px;border:1px solid #ddd;position:absolute;top:30%;left:50%;padding:5px;font-size:11px;"><img src='<?php echo base_url(); ?>assets/images/loader.gif'/><br>Loading..</div>
<script type="text/javascript">
    $(document).ready(function () {
        $(document).ajaxStart(function(){
            $("#wait").css("display", "block");
        });    
        $(document).ajaxComplete(function(){
            $("#wait").css("display", "none");
        });     
    });
    
    function bangladesh_ewallet() { 
        var phone_no = $('.bde_phone_no').val();
        var reference = $('.bde_reference').val();
        var type = $('.bde_type').val();
        var amount = $('.bde_amount').val();
        if(confirm('Are you sure you want to Top-Up?\n Phone No.: '+phone_no+'\n Reference: '+reference+'\n Type: '+type+'\n Amount: BDT.'+amount)) {
            $.ajax({
                type: 'POST',
                data: {phone_no:phone_no, reference:reference, type:type, amount:amount},
                url: '<?php echo site_url('bangladesh_ewallet'); ?>',
                success: function (result) {
                    $('#topup_result').html(result);
                }
            });
        }
    }
    
    function check_current_valance_ew(give_value_ew) {
        //alert(give_value);
        var cov = 0;
        var cov_result = 0;
        var charge_add = 0;

        var current_point = $("#current_point").val();
        var bd_rate = '<?php echo $results['bangladesh']; ?>';
        var cov_result = give_value_ew / bd_rate;
        var charge_add = '<?php echo $result['amount']; ?>';
        var cov_add = +cov_result + +charge_add;
        //var cov = parseFloat(cov_result) + parseFloat(charge_add);
        //alert(cov_add);
        if (cov_add >= current_point) {
            $("#sbt_button_ew").attr("disabled", true);
            $("#maximum_message_ew").show();
        } else {
            $("#sbt_button_ew").attr("disabled", false);
            $("#maximum_message_ew").hide();
        }
    } 
    function roundNumber(number, digits) {
        var multiple = Math.pow(10, 2);
        var rndedNum = Math.round(number * multiple) / multiple;
        return rndedNum;
    }

    function calcAnswer(){
        var amount = document.getElementById("amount").value;
        var from = document.getElementById("from").value;
        var to = document.getElementById("to").value;
        var ans;
        ans = roundNumber(amount * (val1 / val2), 1);
        document.getElementById("answer").value = ans;
    } 
    var val1 = '2';
    var val2 = '100';    
</script>                                                
                                            <!--</form>--> 
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane <?php if (isset($segment) && $segment == 'MALAYSIA_TOPUP'): ?>fade in active<?php endif; ?>" id="htab3">
                                    <div class="row">
                                        <div class="col-md-12 form-horizontal">
                                            <!--<form action="#" role="form" method="post" id="malaysia_topup"  class="form-horizontal">-->			
                                                
                                                <span id="topup_result"></span>
                                                
                                                <div class="form-group">
                                                    <label for="field-3" class="col-sm-3 control-label">Type</label>
                                                    <div class="col-sm-7">
                                                        <select class="form-control malaysia_opt_type" id="option_type" name="opt_type">
                                                            <option value="">Select Type</option>
                                                            <option value="Promo">Promo</option>
                                                            <option value="Prepaid">Prepaid</option>
                                                            <option value="Postpaid">Postpaid</option>
                                                            <option value="Utilities">Utilities</option>                            
                                                        </select>                                                        
                                                    </div>
                                                </div>                                                
                                                <div class="form-group">
                                                    <label class="control-label col-sm-3">Operator </label>
                                                    <div class="col-sm-7">
                                                        <select class="form-control malaysia_operator" id="operator_code" name="operator">
                                                            <option value="">Select Operator</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <span id="account_no"></span>                                                
                                                <div class="form-group">
                                                    <label for="field-3" class="col-sm-3 control-label">Phone No.</label>
                                                    <div class="col-sm-7">
                                                        <input type="text" class="form-control malaysia_phone_no" name="phone_no" placeholder="Type Phone No.">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="field-3" class="col-sm-3 control-label">Amount</label>
                                                    <div class="col-sm-7">
                                                        <input type="number" onblur="check_current_valance_mala(this.value)" name="amount" class="form-control malaysia_amount" placeholder="00 RM">
                                                        <span id="deno_result" style="color:green;"></span> 
                                                    </div>
                                                </div>     
                                                <div class="form-group">
                                                    <div class="col-sm-offset-3 col-sm-7">
                                                        <button id="ssbt_button" onclick="malaysia_topup()" type="submit" class="btn btn-default">Submit</button>
                                                    </div>
                                                </div> 
                                                <div id="wait" style="display:none;width:50px;height:50px;border:1px solid #ddd;position:absolute;top:30%;left:50%;padding:5px;font-size:11px;"><img src='<?php echo base_url(); ?>assets/images/loader.gif'/><br>Loading..</div>
<script type="text/javascript">
    $(document).ready(function () {
        $(document).ajaxStart(function(){
            $("#wait").css("display", "block");
        });    
        $(document).ajaxComplete(function(){
            $("#wait").css("display", "none");
        });     
        
        $('#option_type').change(function () { 
            var option_type = $('#option_type').val();
            $.ajax({
                type: 'POST',
                data: {option_type: option_type},
                url: '<?php echo site_url('reseller/malaysia_operator'); ?>',
                success: function (result) {
                    $('#operator_code').html(result);
                }
            }); 
        });
        $('#operator_code').change(function () { 
            var operator_code = $('#operator_code').val();            
            var option_type = $('#option_type').val();
            if(option_type == 'Utilities'){
              $('#account_no').html('<div class="form-group"><label class="control-label col-sm-3">Account No. </label><div class="col-sm-7"><input type="text" class="form-control malaysia_account_no" name="account_no" placeholder="Account No." /></div></div>');
            }else{
                $('#account_no').html('');
            }             
            $.ajax({
                type: 'POST',
                data: {operator_code: operator_code},
                url: '<?php echo site_url('reseller/malaysia_deno'); ?>',
                success: function (result) {
                    $('#deno_result').html(result);                     
                }
            });
        });        
    });
    
    function malaysia_topup() {
        var opt_type = $('.malaysia_opt_type').val();
        var operator = $('.malaysia_operator').val();
        var account_no = $('.malaysia_account_no').val();
        var phone_no = $('.malaysia_phone_no').val();
        var amount = $('.malaysia_amount').val();
        if(confirm('Are you sure you want to Top-Up?\n Type: '+opt_type+'\n Operator: '+operator+'\n Phone No.: '+phone_no+'\n Amount: RM.'+amount)) {
            $.ajax({
                type: 'POST',
                data: {opt_type:opt_type, operator:operator, account_no:account_no, phone_no:phone_no, amount:amount},
                url: '<?php echo site_url('malaysia_topup'); ?>',
                success: function (result) {
                    $('#topup_result').html(result);
                }
            });
        }
    }
    
    function check_current_valance_mala(give_value_mala) 
    {
        var current_point = $("#current_point").val();

        if (give_value_mala >= current_point) {
            $("#ssbt_button").attr("disabled", true);
            $("#maximum_message_mala").show();
        } else {
            $("#ssbt_button").attr("disabled", false);
            $("#maximum_message_mala").hide();
        }
    }    
</script>                                                 
                                            <!--</form>-->
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane <?php if (isset($segment) && $segment == 'INDONESIA_TOPUP'): ?>fade in active<?php endif; ?>" id="htab4">
                                    <div class="row">
                                        <div class="col-md-12 form-horizontal">
                                            <!--<form action="#" role="form" method="post" id="adminform"  class="form-horizontal">-->			
                                                
                                                <div class="form-group">
                                                    <label for="field-3" class="col-sm-3 control-label">Phone No.</label>
                                                    <div class="col-sm-7">
                                                        <input type="text" name="phone_no" class="form-control indonesia_phone_no" placeholder="Type Phone No.">
                                                    </div>
                                                </div>  

                                                <div class="form-group">
                                                    <label for="field-3" class="col-sm-3 control-label">Amount</label>
                                                    <div class="col-sm-7">
                                                        <input type="number" onblur="check_current_valance_indo(this.value)" name="amount" class="form-control indonesia_amount" placeholder="00 Rp">
                                                        <span id="maximum_message_indo" style="color:red;display:none;">Sorry your current balance exceeds. Please Top-Up to continue...</span>
                                                        <span style="color:green;">Amount be either NRP.100 or NRP.200</span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-offset-3 col-sm-7">
                                                        <button id="sbtss_button" onclick="indonesia_topup()" type="submit" class="btn btn-default">Submit</button>
                                                    </div>
                                                </div>
                                                <div id="wait" style="display:none;width:50px;height:50px;border:1px solid #ddd;position:absolute;top:30%;left:50%;padding:5px;font-size:11px;"><img src='<?php echo base_url(); ?>assets/images/loader.gif'/><br>Loading..</div>
<script type="text/javascript">
    $(document).ready(function () {
        $(document).ajaxStart(function(){
            $("#wait").css("display", "block");
        });    
        $(document).ajaxComplete(function(){
            $("#wait").css("display", "none");
        });     
    });
    
    function indonesia_topup() { 
        var phone_no = $('.indonesia_phone_no').val();
        var amount = $('.indonesia_amount').val();
        if(confirm('Are you sure you want to Top-Up?\n Phone No.: '+phone_no+'\n Amount: NRP.'+amount)) {
            $.ajax({
                type: 'POST',
                data: {phone_no:phone_no, amount:amount},
                url: '<?php echo site_url('indonesia_topup'); ?>',
                success: function (result) {
                    $('#topup_result').html(result);
                }
            });
        }
    }
    
    function check_current_valance_indo(give_value_indo) {
        //alert(give_value);
        var current_point = $("#current_point").val();
        var indo_rate = '<?php echo $results['indonesia']; ?>';
        var cov_result_indo = give_value_indo / indo_rate;
        //alert(cov_result);
        if (cov_result_indo >= current_point) {
            $("#sbtss_button").attr("disabled", true);
            $("#maximum_message_indo").show();
        } else {
            $("#sbtss_button").attr("disabled", false);
            $("#maximum_message_indo").hide();
        }
    }   
</script>
                                            <!--</form>--> 
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane <?php if (isset($segment) && $segment == 'NEAPL_TOPUP'): ?>fade in active<?php endif; ?>" id="htab5">
                                    <div class="row">
                                        <div class="col-md-12 form-horizontal">
                                            <!--<form action="#" role="form" method="post" id="adminform"  class="form-horizontal">-->			
                                                <input type="hidden" name="reseller_id" value="<?php echo $this->session->userdata('admin_id'); ?>">
                                                <div class="form-group">
                                                    <label for="field-3" class="col-sm-3 control-label">Phone No.</label>
                                                    <div class="col-sm-7">
                                                        <input type="text" name="phone_no" class="form-control nepal_phone_no" placeholder="Type Phone No.">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="field-3" class="col-sm-3 control-label">Amount</label>
                                                    <div class="col-sm-7">
                                                        <input type="number" onblur="check_current_valance_nep(this.value)" name="amount" class="form-control nepal_amount" id="password" placeholder="00 NPR">
                                                        <span id="maximum_message_nep" style="color:red;display:none;">Sorry your current balance exceeds. Please Top-Up to continue...</span>
                                                        <span style="color:green;">Amount be either Rp.25 or Rp.50 or Rp.100</span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-offset-3 col-sm-7">
                                                        <button id="sbtsss_button" onclick="nepal_topup()" type="submit" class="btn btn-default">Submit</button>
                                                    </div>
                                                </div>
                                                <div id="wait" style="display:none;width:50px;height:50px;border:1px solid #ddd;position:absolute;top:30%;left:50%;padding:5px;font-size:11px;"><img src='<?php echo base_url(); ?>assets/images/loader.gif'/><br>Loading..</div>
<script type="text/javascript">
    $(document).ready(function () {
        $(document).ajaxStart(function(){
            $("#wait").css("display", "block");
        });    
        $(document).ajaxComplete(function(){
            $("#wait").css("display", "none");
        });     
    });
    
    function nepal_topup() { 
        var phone_no = $('.nepal_phone_no').val();
        var amount = $('.nepal_amount').val();
        if(confirm('Are you sure you want to Top-Up?\n Phone No.: '+phone_no+'\n Amount: Rp.'+amount)) {
            $.ajax({
                type: 'POST',
                data: {phone_no:phone_no, amount:amount},
                url: '<?php echo site_url('nepal_topup'); ?>',
                success: function (result) {
                    $('#topup_result').html(result);
                }
            });
        }
    }

    function check_current_valance_nep(give_value_nep) {
        //alert(give_value);
        var current_point = $("#current_point").val();
        var nep_rate = '<?php echo $results['nepal']; ?>';
        var cov_result_nep = give_value_nep / nep_rate;
        //alert(cov_result);
        if (cov_result_nep >= current_point) {
            $("#sbtsss_button").attr("disabled", true);
            $("#maximum_message_nep").show();
        } else {
            $("#sbtsss_button").attr("disabled", false);
            $("#maximum_message_nep").hide();
        }
    }
</script>                                                
                                            <!--</form>-->
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </section>
        </div>
        <?php $this->load->view('reseller/footer'); ?> 
    </body>
</html>