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


        <div class="page-intro">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <ol class="breadcrumb">
                                <li><i class="fa fa-home pr-10"></i><a href="<?php echo site_url('reseller/index')?>">Home</a></li>
                                <li class="active">Topup</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

        <?php  
             $lastid = $this->session->userdata('insert_id');

        ?>
        <!-- modified by Jesan -->

        <div class="row" style="background: #cf2e16;">  
            <br>
            <div class="col-md-9">
                <p style="color:white; text-decoration: none;  ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Username: 
                    <a href="<?php echo site_url('reseller/profile') ?>" style="text-decoration: none; color: white;"> <?php
                        $admin_id = $this->session->userdata('admin_id');
                        $reseller = $this->meclicksasia->table_info('admin', 'admin_id', $admin_id);
                        echo $reseller->name;
                        echo "<br>";
                        ?>
                    </a>

                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span> User ID:</span>
                    <a href="<?php echo site_url('reseller/profile') ?>" style="text-decoration: none; color: white;"> <?php
                        $reseller = $this->meclicksasia->table_info('admin', 'admin_id', $admin_id);
                        echo $reseller->phone;
                        ?>

                    </a>
                </p>
            </div>

            <div class="col-md-3">
                <a style=" color:white; text-decoration: none;" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Current Points:                        
                    <?php


                    $admin_id = $this->session->userdata('admin_id');
                    $balance = $this->meclicksasia->current_points($admin_id);
                    echo number_format((float) $balance, 4, '.', '');
                    ?>                       
                </a>
            </div>
        </div>
        <!-- end of modification -->
        <section class="main-container">
            <div class="container">

                <div class="row" >

                    

                    <div class="col-md-12">
                        <?php
                        $query = $this->meclicksasia->last_messages();
                        $query['id'];
                        $query = $this->db->get_where('servermessage', array('id' => $query['id']));
                        $result = $query->row_array();

                        if ($result['type'] == '1') {
                            echo('<marquee direction="left" scrollamount="5" behavior="scroll" style="color:red; font-size:15px;">');
                            echo '** ' . $result['textmessage'];
                            echo'</marquee>';
                        }
                        ?>

                    </div>

                    <div class="main col-md-12">

                        <?php
                        $query = $this->meclicksasia->last_charge();
                        $query['charge_id'];
                        $query = $this->db->get_where('charge', array('charge_id' => $query['charge_id']));
                        $result = $query->row_array();

                        ?>

                        <?php
                        $query = $this->meclicksasia->last_rates();
                        $query['rates_id'];
                        $query = $this->db->get_where('rates', array('rates_id' => $query['rates_id']));
                        $results = $query->row_array();

                        ?>



                        <input type="hidden" name="current_point" id="current_point" value="<?php echo $balance; ?>"/>
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="active"><a href="components-tabs-and-pills.html#htab1" role="tab" data-toggle="tab"><img src="<?php echo base_url() ?>assets/images/bd.svg" width="30px" height="30px" style="float:left;">&nbsp;&nbsp; Bangladesh Top-Up</a></li>
                            <li><a href="components-tabs-and-pills.html#htab3" role="tab" data-toggle="tab"><img src="<?php echo base_url() ?>assets/images/my.svg" width="30px" height="30px" style="float:left;">&nbsp;&nbsp; Malaysia Top-Up</a></li>
                            <li><a href="components-tabs-and-pills.html#htab4" role="tab" data-toggle="tab"><img src="<?php echo base_url() ?>assets/images/id.svg" width="30px" height="30px" style="float:left;">&nbsp;&nbsp; Indonesia Top-Up</a></li>
                            <li><a href="components-tabs-and-pills.html#htab5" role="tab" data-toggle="tab"><img src="<?php echo base_url() ?>assets/images/np.svg" width="30px" height="30px" style="float:left;">&nbsp;&nbsp; Nepal Top-Up</a></li>                                
                            <li><a href="components-tabs-and-pills.html#htab2" role="tab" data-toggle="tab"><img src="<?php echo base_url() ?>assets/images/pww.png" width="30px" height="30px" style="float:left;">&nbsp;&nbsp; e-Wallet</a></li>
                        </ul>                             
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane fade in active" id="htab1" style="background-color: #f4f4f4;">
                                <div class="row">
                                    <div class="col-md-12 form-horizontal">        
                                        <!--<form action="#" role="form"  method="post" id="adminformbd"  class="form-horizontal">-->			
                                        <span id="bdf_result"></span>

                                        <div class="form-group">
                                            <label for="field-3" class="col-sm-3 control-label">Phone No.</label>
                                            <div class="col-sm-7">
                                                <input type="number" class="form-control bdf_phone_no" name="phone_no" id="phone_no" placeholder="Ex. 01771000001">
                                                <span id="phone_no_error" style="color:red;display:none;">Phone NO Can't be empty!!</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="field-3" class="col-sm-3 control-label">Type</label>
                                            <div class="col-sm-7">
                                                <div class="radio"><label><input type="radio" name="type" class="bdf_type" value="Prepaid" checked="checked">Prepaid</label></div>
                                                <div class="radio"><label><input type="radio" name="type" class="bdf_type" value="Postpaid">Postpaid</label></div>
                                                <span id="type_error" style="color:red;display:none;">Select a Type!!</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="field-3" class="col-sm-3 control-label">Amount</label>
                                            <div class="col-sm-7"> <!---validation code here onblur="check_current_valance(this.value)"-->
                                                <input type="number"  name="amount" class="form-control bdf_amount" id="amount" placeholder="0.00 BDT">
                                                <span id="amount_error" style="color:red;display:none;">Amount Can't be empty!!</span>
                                                <span id="maximum_message" style="color:red;display:none;">Sorry your current balance exceeds. Please Top-Up to continue...</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-3 col-sm-7">
                                                <button id="sbt_button" onclick="bangladesh_flexiload_modal()" type="submit" onclick="form_validation()" class="btn btn-default">Submit</button>
                                            </div>
                                        </div>
                                        <div id="bdf_wait" style="display:none;width:50px;height:50px;border:1px solid #ddd;position:absolute;top:30%;left:50%;padding:5px;font-size:11px;"><img src='<?php echo base_url(); ?>assets/images/loader.gif'/><br>Loading..</div>

                                        <div class="modal fade" id="bangladesh_flexiload_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                        <h6 class="modal-title" id="myModalLabel">Bangladesh Top-Up: Confirm Details</h6>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">                                
                                                            <div class="col-md-4">Phone No.</div>
                                                            <div class="col-md-8">: <span id="bdf_phone_no"></span></div>
                                                        </div>
                                                        <div class="row">                                
                                                            <div class="col-md-4">Type</div>
                                                            <div class="col-md-8">: <span id="bdf_type"></span></div>
                                                        </div>
                                                        <div class="row">                                
                                                            <div class="col-md-4">Amount (In BDT.)</div>
                                                            <div class="col-md-8">: <span id="bdf_amount"></span></div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" onclick="bangladesh_flexiload()" class="btn btn-sm btn-success"><i class="fa fa-check"></i> Confirm Submit</button> 
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <script type="text/javascript">
                                            $(document).ready(function () {
                                                $(document).ajaxStart(function () {
                                                    $("#bdf_wait").css("display", "block");
                                                });
                                                $(document).ajaxComplete(function () {
                                                    $("#bdf_wait").css("display", "none");
                                                });
                                            });

                                            function bangladesh_flexiload_modal() {
                                                $('#bdf_phone_no').html($('.bdf_phone_no').val());
                                                $('#bdf_type').html($("input[type='radio'].bdf_type:checked").val());
                                                $('#bdf_amount').html($('.bdf_amount').val());
                                                $('#bangladesh_flexiload_modal').modal('show');
                                            }

                                            function bangladesh_flexiload() {
                                                $('#bangladesh_flexiload_modal').modal('hide');
                                                var phone_no = $('.bdf_phone_no').val();
                                                var type = $("input[type='radio'].bdf_type:checked").val();
                                                var amount = $('.bdf_amount').val();

                                                $.ajax({

                                                    type: 'POST',
                                                    data: {phone_no: phone_no, type: type, amount: amount},
                                                    url: '<?php echo site_url('bangladesh_flexiload'); ?>',
                                                    success: function (result) {
                                                        $('#bdf_result').html(result);
                                                        $('.bdf_phone_no').val();
                                                        $("input[type='radio'].bdf_type:checked").val();
                                                        $('.bdf_amount').val();
                                                    }
                                                });
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

<div class="tab-pane" id="htab2">
    <div class="row">
        <div class="col-md-12 form-horizontal">                                                                                  
            <!--<form action="#" role="form" method="post"   class="form-horizontal">-->			
            <span id="bde_result"></span>

            <input type="hidden" name="reseller_id" value="<?php echo $this->session->userdata('admin_id'); ?>">
            <div class="form-group">
                <label for="field-3" class="col-sm-3 control-label">Phone No.</label>
                <div class="col-sm-7">
                    <input type="number" class="form-control bde_phone_no" name="phone_no" id="phone" placeholder="Ex. 01771000001">
                </div>
            </div>
            <div class="form-group">
                <label for="field-3" class="col-sm-3 control-label">Reference</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control bde_reference" name="reference" placeholder="Reference ID / Name">
                </div>
            </div>
            <div class="form-group">
                <label for="field-3" class="col-sm-3 control-label">Type</label>
                <div class="col-sm-7">
                    <div class="radio"><label><input type="radio" name="type" class="bde_type" value="Personal" checked="checked">Personal</label></div>
                    <div class="radio"><label><input type="radio" name="type" class="bde_type" value="Agent">Agent</label></div>
                </div>
            </div>  
            <div  id="form" class="form-group ">
                <div class="form-group ">
                    <label id="from" for="field-3" class="col-sm-3 control-label">Amount</label>                                              
                    <div class="col-sm-7" id="tofrom1">
                        <input  id="amount" onblur="check_current_valance_ew(this.value)"  name="amount" type="number" class="form-control bde_amount" placeholder="0.00">                                                        
                        <input style="width:40%; color:red" class="form-control" value="Charge <?php echo $result['amount'] ?> RM" disabled>   
                        <span id="maximum_message_ew" style="color:red;display:none;">Sorry your current balance exceeds. Please Top-Up to continue...</span>

                    </div>
                </div>

            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-7">
                    <button id="sbt_button_ew" onclick="bangladesh_ewallet_modal()" type="submit" class="btn btn-default">Submit</button>
                </div>
            </div>
            <div id="bde_wait" style="display:none;width:50px;height:50px;border:1px solid #ddd;position:absolute;top:30%;left:50%;padding:5px;font-size:11px;"><img src='<?php echo base_url(); ?>assets/images/loader.gif'/><br>Loading..</div>

            <div class="modal fade" id="bangladesh_ewallet_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h6 class="modal-title" id="myModalLabel">Bangladesh E-WALLET: Confirm Details</h6>
                        </div>
                        <div class="modal-body">
                            <div class="row">                                
                                <div class="col-md-4">Phone No.</div>
                                <div class="col-md-8">: <span id="bde_phone_no"></span></div>
                            </div>
                            <div class="row">                                
                                <div class="col-md-4">Reference</div>
                                <div class="col-md-8">: <span id="bde_reference"></span></div>
                            </div>
                            <div class="row">                                
                                <div class="col-md-4">Type</div>
                                <div class="col-md-8">: <span id="bde_type"></span></div>
                            </div>
                            <div class="row">                                
                                <div class="col-md-4">Amount (In BDT.)</div>
                                <div class="col-md-8">: <span id="bde_amount"></span></div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" onclick="bangladesh_ewallet()" class="btn btn-sm btn-success"><i class="fa fa-check"></i> Confirm Submit</button>
                        </div>
                    </div>
                </div>
            </div>                                                 
            <script type="text/javascript">
                $(document).ready(function () {
                    $(document).ajaxStart(function () {
                        $("#bde_wait").css("display", "block");
                    });
                    $(document).ajaxComplete(function () {
                        $("#bde_wait").css("display", "none");
                    });
                });

                function bangladesh_ewallet_modal() {
                    $('#bde_phone_no').html($('.bde_phone_no').val());
                    $('#bde_reference').html($('.bde_reference').val());
                    $('#bde_type').html($("input[type='radio'].bde_type:checked").val());
                    $('#bde_amount').html($('.bde_amount').val());
                    $('#bangladesh_ewallet_modal').modal('show');
                }

                function bangladesh_ewallet() {
                    $('#bangladesh_ewallet_modal').modal('hide');
                    var phone_no = $('.bde_phone_no').val();
                    var reference = $('.bde_reference').val();
                    var type = $("input[type='radio'].bde_type:checked").val();
                    var amount = $('.bde_amount').val();

                    $.ajax({
                        type: 'POST',
                        data: {phone_no: phone_no, reference: reference, type: type, amount: amount},
                        url: '<?php echo site_url('bangladesh_ewallet'); ?>',
                        success: function (result) {
                            $('#bde_result').html(result);
                        }
                    });
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

        function calcAnswer() {
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
<div class="tab-pane" id="htab3">
    <div class="row">
        <div class="col-md-12 form-horizontal">
            <!--<form action="#" role="form" method="post" id="malaysia_topup"  class="form-horizontal">-->			

            <!-- <span id="malaysia_result"></span> -->

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
            <!--<span id="account_no"></span>-->                                                
            <div class="form-group">
                <label for="field-3" class="col-sm-3 control-label">Account/Phone No.</label>
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
                    <button id="ssbt_button" onclick="malaysia_topup_modal()" type="submit" class="btn btn-default">Submit</button>
                </div>
            </div> 
            <div id="malaysia_wait" style="display:none;width:50px;height:50px;border:1px solid #ddd;position:absolute;top:30%;left:50%;padding:5px;font-size:11px;"><img src='<?php echo base_url(); ?>assets/images/loader.gif'/><br>Loading..</div>

            <div class="modal fade" id="malaysia_topup_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h6 class="modal-title" id="myModalLabel">Malaysia Top-Up: Confirm Details</h6>
                        </div>
                        <div class="modal-body">
                            <div class="row">                                
                                <div class="col-md-4">Type</div>
                                <div class="col-md-8">: <span id="malaysia_opt_type"></span></div>
                            </div>
                            <div class="row">                                
                                <div class="col-md-4">Operator</div>
                                <div class="col-md-8">: <span id="malaysia_operator"></span></div>
                            </div>
             
                            <div class="row">                                
                                <div class="col-md-4">Account/Phone No.</div>
                                <div class="col-md-8">: <span id="malaysia_phone_no"></span></div>
                            </div>
                            <div class="row">                                
                                <div class="col-md-4">Amount (In RM.)</div>
                                <div class="col-md-8">: <span id="malaysia_amount"></span></div>
                            </div>
                        </div>
                                <div class="modal-footer">
                                    <button type="submit" onclick="malaysia_topup()" class="btn btn-sm btn-success"><i class="fa fa-check"></i> Confirm Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>                                                 
                    <script type="text/javascript">
                        $(document).ready(function () {
                            $(document).ajaxStart(function () {
                                $("#malaysia_wait").css("display", "block");
                            });
                            $(document).ajaxComplete(function () {
                                $("#malaysia_wait").css("display", "none");
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
                //            var option_type = $('#option_type').val();
                //            if(option_type == 'Utilities'){
                //              $('#account_no').html('<div class="form-group"><label class="control-label col-sm-3">Account No. </label><div class="col-sm-7"><input type="text" class="form-control malaysia_account_no" name="account_no" placeholder="Account No." /></div></div>');
                //            }else{
                //                $('#account_no').html('');
                //            }             
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

                        function malaysia_topup_modal() {
                            $('#malaysia_opt_type').html($('.malaysia_opt_type').val());
                            $('#malaysia_operator').html($('.malaysia_operator').find('option:selected').attr('operator_name'));
            //        $('#malaysia_account_no').html($('.malaysia_account_no').val());
            $('#malaysia_phone_no').html($('.malaysia_phone_no').val());
            $('#malaysia_amount').html($('.malaysia_amount').val());
            $('#malaysia_topup_modal').modal('show');
        }

        function malaysia_topup() {
            $('#malaysia_topup_modal').modal('hide');
            var opt_type = $('.malaysia_opt_type').val();
            var operator = $('.malaysia_operator').val();
            //        var account_no = $('.malaysia_account_no').val();
            var phone_no = $('.malaysia_phone_no').val();
            var amount = $('.malaysia_amount').val();
            $.ajax({
                type: 'POST',
                //            data: {opt_type:opt_type, operator:operator, account_no:account_no, phone_no:phone_no, amount:amount},
                data: {opt_type: opt_type, operator: operator, phone_no: phone_no, amount: amount},
                url: '<?php echo site_url('malaysia_topup'); ?>',
                success: function (result) {
                    //$('#malaysia_result').html(result);
                    window.location.replace("<?php echo site_url('topup_success'); ?>");
                }
            });
        }

        //    function check_current_valance_mala(give_value_mala) 
        //    {
        //        var current_point = $("#current_point").val();
        //
        //        if (give_value_mala >= current_point) {
        //            $("#ssbt_button").attr("disabled", true);
        //            $("#maximum_message_mala").show();
        //        } else {
        //            $("#ssbt_button").attr("disabled", false);
        //            $("#maximum_message_mala").hide();
        //        }
        //    }    
    </script>                                                 
    <!--</form>-->
</div>
</div>
</div>
<div class="tab-pane" id="htab4">
    <div class="row">
        <div class="col-md-12 form-horizontal">
            <!--<form action="#" role="form" method="post" id="adminform"  class="form-horizontal">-->			

            <span id="indonesia_result"></span>

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
                    <span style="color:green;">Amount be either Rp.25 or Rp.50 or Rp.100</span>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-7">
                    <button id="sbtss_button" onclick="indonesia_topup_modal()" type="submit" class="btn btn-default">Submit</button>
                </div>
            </div>
            <div id="indonesia_wait" style="display:none;width:50px;height:50px;border:1px solid #ddd;position:absolute;top:30%;left:50%;padding:5px;font-size:11px;"><img src='<?php echo base_url(); ?>assets/images/loader.gif'/><br>Loading..</div>

            <div class="modal fade" id="indonesia_topup_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h6 class="modal-title" id="myModalLabel">Indonesia Top-Up: Confirm Details</h6>
                        </div>
                        <div class="modal-body">
                            <div class="row">                                
                                <div class="col-md-4">Phone No.</div>
                                <div class="col-md-8">: <span id="indonesia_phone_no"></span></div>
                            </div>
                            <div class="row">                                
                                <div class="col-md-4">Amount (In Rp.)</div>
                                <div class="col-md-8">: <span id="indonesia_amount"></span></div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" onclick="indonesia_topup()" class="btn btn-sm btn-success"><i class="fa fa-check"></i> Confirm Submit</button>
                        </div>
                    </div>
                </div>
            </div>                                                 
            <script type="text/javascript">
                $(document).ready(function () {
                    $(document).ajaxStart(function () {
                        $("#indonesia_wait").css("display", "block");
                    });
                    $(document).ajaxComplete(function () {
                        $("#indonesia_wait").css("display", "none");
                    });
                });

                function indonesia_topup_modal() {
                    $('#indonesia_phone_no').html($('.indonesia_phone_no').val());
                    $('#indonesia_amount').html($('.indonesia_amount').val());
                    $('#indonesia_topup_modal').modal('show');
                }
                function indonesia_topup() {
                    $('#indonesia_topup_modal').modal('hide');
                    var phone_no = $('.indonesia_phone_no').val();
                    var amount = $('.indonesia_amount').val();
                    $.ajax({
                        type: 'POST',
                        data: {phone_no: phone_no, amount: amount},
                        url: '<?php echo site_url('indonesia_topup'); ?>',
                        success: function (result) {
                            $('#indonesia_result').html(result);
                        }
                    });
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
<div class="tab-pane" id="htab5">
    <div class="row">
        <div class="col-md-12 form-horizontal">
            <!--<form action="#" role="form" method="post" id="adminform"  class="form-horizontal">-->			
            <span id="nepal_result"></span>

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
                    <span style="color:green;">Amount be either NRP.100 or NRP.200</span>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-7">
                    <button id="sbtsss_button" onclick="nepal_topup_modal()" type="submit" class="btn btn-default">Submit</button>
                </div>
            </div>
            <div id="nepal_wait" style="display:none;width:50px;height:50px;border:1px solid #ddd;position:absolute;top:30%;left:50%;padding:5px;font-size:11px;"><img src='<?php echo base_url(); ?>assets/images/loader.gif'/><br>Loading..</div>

            <div class="modal fade" id="nepal_topup_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h6 class="modal-title" id="myModalLabel">Nepal Top-Up: Confirm Details</h6>
                        </div>
                        <div class="modal-body">
                            <div class="row">                                
                                <div class="col-md-4">Phone No.</div>
                                <div class="col-md-8">: <span id="nepal_phone_no"></span></div>
                            </div>
                            <div class="row">                                
                                <div class="col-md-4">Amount (In NRP.)</div>
                                <div class="col-md-8">: <span id="nepal_amount"></span></div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" onclick="nepal_topup()" class="btn btn-sm btn-success"><i class="fa fa-check"></i> Confirm Submit</button>
                        </div>
                    </div>
                </div>
            </div>                                                   
            <script type="text/javascript">
                $(document).ready(function () {
                    $(document).ajaxStart(function () {
                        $("#nepal_wait").css("display", "block");
                    });
                    $(document).ajaxComplete(function () {
                        $("#nepal_wait").css("display", "none");
                    });
                });

                function nepal_topup_modal() {
                    $('#nepal_phone_no').html($('.nepal_phone_no').val());
                    $('#nepal_amount').html($('.nepal_amount').val());
                    $('#nepal_topup_modal').modal('show');
                }
                function nepal_topup() {
                    $('#nepal_topup_modal').modal('hide');
                    var phone_no = $('.nepal_phone_no').val();
                    var amount = $('.nepal_amount').val();
                    $.ajax({
                        type: 'POST',
                        data: {phone_no: phone_no, amount: amount},
                        url: '<?php echo site_url('nepal_topup'); ?>',
                        success: function (result) {
                            $('#nepal_result').html(result);
                        }
                    });
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


        <!-- modified by Ashiqe -->
            <section class="main-container">
                <div class="main">
                    <div class="container">
                        <div class="panel panel-primary" data-collapsed="0">
                            <div class="panel-heading">
                                <div class="panel-title">
                                    Last Top-Up Information
                                </div>
                            </div>
                            <div class="panel-body"> 
                                <div class="table-responsive">
                                    <table class="table table-bordered datatable table-responsive" id="table-1"  style="font-size: 12px">
                                       
                                        <thead>
                                            <tr>                  
                                                <th>Date</th>                    
                                                <th>Country</th>                    
                                                <th>Type</th>                    
                                                <th>Operator</th>                    
                                                <th>Phone No.</th> 
                                                <th>Deposit Amount</th> 
                                                <th>Top-Up Amount</th> 
                                                <th>Cost Points</th> 
                                                <th>Commission (-)</th> 
                                                <th>Charge (+)</th> 
                                                <th>Actual Cost</th> 
                                                
                                                <th>Status</th> 
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $ttl_deposit = 0;
                                            $ttl_commission = 0;
                                            $ttl_charge = 0;
                                            $ttl_cost_point = 0;
                                            $total_country_out = '';
                                            $ttl_actual_cost = '';
                                            $balance = 0;

                                            $query = $this->meclicksasia->table_data_last_toppup('transaction', 'admin_id', $admin_id, 'created_at');
                                            foreach ($query as $row):
                                                $country_out = 0;
                                                $commission = 0;
                                                $charge = 0;
                                                ?>
                                                <tr class="odd gradeX">
                                                    <td><?php echo $row['created_at']; ?></td>
                                                    <td><?php echo $row['country']; ?></td> 
                                                    <td><?php echo $row['type']; ?></td>
                                                    <td><?php echo $row['operator']; ?></td>
                                                    <td><?php echo $row['phone_no']; ?></td>
                                                    <td>R.&nbsp;<?php
                                                        if ($row['class'] == 'In'):
                                                            echo $row['amount'];

                                                            $ttl_deposit += $row['amount'];
                                                        else:
                                                            echo '0.0000';
                                                        endif;
                                                        ?>
                                                    </td>

                                                    <td>
                                                        <?php
                                                        if ($row['country'] == 'Bangladesh') {
                                                            echo " TK ";
                                                        } elseif ($row['country'] == 'Indonesia') {
                                                            echo " IR ";
                                                        } elseif ($row['country'] == 'Nepal') {
                                                            echo " RU ";
                                                        } elseif ($row['country'] == 'Malaysia') {
                                                            echo " RM ";
                                                        }
                                                        ?>
                                                        <?php
                                                        if ($row['class'] == 'Out'):
                                                            echo $row['amount'];
                                                            $country_out = $row['amount'] / $row['rm_rate'];
                                                            $total_country_out += $row['amount'] / $row['rm_rate'];
                                                        else:
                                                            echo 'R. 0.0000';
                                                        endif;
                                                        ?>
                                                    </td>

                                                    <td>R.&nbsp;<?php
                                                        if ($row['country'] == 'Malaysia') {
                                                            echo $row['amount'];
                                                            $ttl_cost_point +=$row['amount'];
                                                        } elseif ($row['country'] == 'Indonesia') {
                                                            echo number_format((float) $cost_point = $row['amount'] / $row['rm_rate'], 4, '.', '');
                                                            $ttl_cost_point += $row['amount'] / $row['rm_rate'];
                                                        } else if ($row['rm_rate'] != 0) {
                                                            echo number_format((float) $cost_point = $row['amount'] / $row['rm_rate'], 4, '.', '');
                                                            $ttl_cost_point += $row['amount'] / $row['rm_rate'];
                                                        } else {
                                                            echo '0.0000';
                                                        }
                                                        ?>
                                                    </td>

                                                    <td>R.&nbsp;<?php
                                                        if ($row['country'] == 'Malaysia') {
                                                            echo number_format((float) $row['commission'], 4, '.', '');
                                                            $commission = $row['commission'];
                                                            $ttl_commission += $commission;
                                                        } elseif (!empty($row['amount'])) {
                                                            echo '0.0000';
                                                        }
                                                        ?>
                                                    </td>

                                                    <td>R.&nbsp;<?php
                                                        echo number_format((float) $row['charge'], 4, '.', '');
                                                        $charge = $row['charge'];
                                                        $ttl_charge += $row['charge'];
                                                        ?>
                                                    </td>

                                                    <td>Rs.&nbsp;<?php
                                                        if ($row['country'] == 'Malaysia') {
                                                            $test = $row['amount'];
                                                            $actual_cost = $test - $commission;
                                                            echo number_format((float) $actual_cost, 4, '.', '');
                                                            $ttl_actual_cost += $actual_cost;
                                                        } elseif (($row['country'] == 'Indonesia') || ($row['country'] == 'Nepal')) {
                                                            echo number_format((float) $cost_point, 4, '.', '');
                                                            $ttl_actual_cost += $cost_point;
                                                        } elseif (($row['type'] == 'Personal') || ($row['type'] == 'Agent')) {
                                                            $actual_cost = $cost_point + $charge;
                                                            echo number_format((float) $actual_cost, 4, '.', '');
                                                            $ttl_actual_cost += $actual_cost;
                                                        } elseif ($row['country'] == 'Bangladesh') {
                                                            echo number_format((float) $cost_point, 4, '.', '');
                                                            $ttl_actual_cost += $cost_point;
                                                        } else {
                                                            echo '0.0000';
                                                        }
                                                        ?>
                                                    </td>
                                                                                                
                                                    <td>
                                                        <?php
                                                        if ($row['status'] == 'Fail') {
                                                            if ($row['refun_status'] == '1') {
                                                                echo '<b style="color:green">' . 'Refunded' . '</b>';
                                                            } else {
                                                                echo $row['status'];
                                                            }
                                                        } else {
                                                            echo $row['status'];
                                                        }
                                                        ?>
                                                    </td>                                                
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                      
                                    </table>
                                   
                                </div>
                            </div>
                        </div>                        
                    </div>
                </div>
            </section>


        <?php $this->load->view('reseller/footer'); ?> 
    </body>
    </html>