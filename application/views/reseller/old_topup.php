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
                            $message = $this->session->userdata('message');
                            if(isset($message)||!empty($message)):
                            ?>
                            <div class="alert alert-success fade in widget-inner">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <?php echo $message; ?>
                            </div>            
                            <?php $this->session->unset_userdata('message'); endif; ?>
                            <!-- /Message -->
            
                            <?php
                            $query = $this->meclicksasia->last_charge();
                            $query['charge_id'];
                            $query = $this->db->get_where('charge', array('charge_id' => $query['charge_id']));
                            $result = $query->row_array();
                            ?>
                            <p style="text-align:right;">&nbsp;
                                <b>**Your Current Points: <?php
                                    $admin_id = $this->session->userdata('admin_id');
                                    $in = $this->meclicksasia->transaction_in($admin_id);
                                    $out = $this->meclicksasia->transaction_out($admin_id);
                                    $commission = $this->meclicksasia->transaction_commissions($admin_id);
                                    $charge = $this->meclicksasia->transaction_charge($admin_id);
                                    $balance = $in + $commission - $out - $charge;
                                    echo number_format((float)$balance,2,'.','');
                                    ?>
                                </b>
                                <input type="hidden" name="current_point" id="current_point" value="<?php echo $balance; ?>"/>

                            </p>
                            <ul class="nav nav-tabs" role="tablist">
                                <li <?php if(isset($segment) && $segment == 'BANGLADESH_FLEXILOAD'): ?>class="active"<?php endif; ?>><a href="components-tabs-and-pills.html#htab1" role="tab" data-toggle="tab"><img src="<?php echo base_url() ?>assets/images/bd.svg" width="30px" height="30px" style="float:left;">&nbsp;&nbsp; Bangladesh Top-Up</a></li>
                                <li <?php if(isset($segment) && $segment == 'BANGLADESH_EWALLET'): ?>class="active"<?php endif; ?>><a href="components-tabs-and-pills.html#htab2" role="tab" data-toggle="tab"><img src="<?php echo base_url() ?>assets/images/pww.png" width="30px" height="30px" style="float:left;">&nbsp;&nbsp; e-Wallet</a></li>
                                <li <?php if(isset($segment) && $segment == 'MALAYSIA_TOPUP'): ?>class="active"<?php endif; ?>><a href="components-tabs-and-pills.html#htab3" role="tab" data-toggle="tab"><img src="<?php echo base_url() ?>assets/images/my.svg" width="30px" height="30px" style="float:left;">&nbsp;&nbsp; Malaysia Top-Up</a></li>
                                <li <?php if(isset($segment) && $segment == 'INDONESIA_TOPUP'): ?>class="active"<?php endif; ?>><a href="components-tabs-and-pills.html#htab4" role="tab" data-toggle="tab"><img src="<?php echo base_url() ?>assets/images/id.svg" width="30px" height="30px" style="float:left;">&nbsp;&nbsp; Indonesia Top-Up</a></li>
                                <li <?php if(isset($segment) && $segment == 'NEAPL_TOPUP'): ?>class="active"<?php endif; ?>><a href="components-tabs-and-pills.html#htab5" role="tab" data-toggle="tab"><img src="<?php echo base_url() ?>assets/images/np.svg" width="30px" height="30px" style="float:left;">&nbsp;&nbsp; Nepal Top-Up</a></li>                                
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane <?php if(isset($segment) && $segment == 'BANGLADESH_FLEXILOAD'): ?>fade in active<?php endif; ?>" id="htab1">
                                    <div class="row">
                                        <div class="col-md-10">        
                                            <form action="<?php echo site_url('reseller/bangladesh_flexiload/add'); ?>" role="form"  method="post" id="adminformbd"  class="form-horizontal">			
                                                <input type="hidden" name="reseller_id" value="<?php echo $this->session->userdata('admin_id'); ?>">
                                                <div class="form-group">
                                                    <label for="field-1" class="col-sm-3 control-label">Operator</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control" id="operator" name="operator">
                                                            <option value="">Select Operator</option>
                                                            <option value="Banglalink">Banglalink</option>
                                                            <option value="CityCell">CityCell</option>
                                                            <option value="GrameenPhone">GrameenPhone</option>
                                                            <option value="Robi">Robi</option>
                                                            <option value="Teletalk">Teletalk</option>
                                                            <option value="Airtel">Airtel</option>                             
                                                        </select> 
                                                        <span id="operator_error" style="color:red;display:none;">Required!</span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="field-3" class="col-sm-3 control-label">Phone No.</label>
                                                    <div class="col-sm-9">
                                                        <input type="number" class="form-control" name="phone_no" id="phone_no" placeholder="Type Phone No">
                                                        <span id="phone_no_error" style="color:red;display:none;">Phone NO Can't be empty!!</span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="field-3" class="col-sm-3 control-label">Type</label>
                                                    <div class="col-sm-9">
                                                        <div class="radio"><label><input type="radio" name="type" id="type" value="Prepaid">Prepaid</label></div>
                                                        <div class="radio"><label><input type="radio" name="type" id="type" value="Postpaid">Postpaid</label></div>
                                                        <span id="type_error" style="color:red;display:none;">Select a Type!!</span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="field-3" class="col-sm-3 control-label">Amount</label>
                                                    <div class="col-sm-9">
                                                        <input type="number" onblur="check_current_valance(this.value)" name="amount" class="form-control" id="amount" placeholder="0.00 BDT">
                                                        <span id="amount_error" style="color:red;display:none;">Amount Can't be empty!!</span>
                                                        <span id="maximum_message" style="color:red;display:none;">Sorry,Your current balance is unable to give topup!</span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-offset-3 col-sm-9">
                                                        <button id="sbt_button" type="submit" onclick="form_validation()" class="btn btn-default">Submit</button>
                                                    </div>
                                                </div>
                                            </form> 

                                            <script>
                                                function check_current_valance(give_value) {
                                                    var current_point = $("#current_point").val();
                                                    if (give_value > current_point) {
                                                        $("#sbt_button").attr("disabled", true);
                                                        $("#maximum_message").show();
                                                    } else {
                                                        $("#sbt_button").attr("disabled", false);
                                                        $("#maximum_message").hide();
                                                    }
                                                }
                                            </script>

                                            <script>
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
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane <?php if (isset($segment) && $segment == 'BANGLADESH_EWALLET'): ?>fade in active<?php endif; ?>" id="htab2">
                                    <div class="row">
                                        <div class="col-md-10">                                                                                  
                                            <form action="<?php echo site_url('reseller/bangladesh_ewallet/add'); ?>" role="form" method="post"   class="form-horizontal">			
                                                <input type="hidden" name="reseller_id" value="<?php echo $this->session->userdata('admin_id'); ?>">
                                                <div class="form-group">
                                                    <label for="field-3" class="col-sm-3 control-label">Phone No.</label>
                                                    <div class="col-sm-9">
                                                        <input type="number" class="form-control" name="phone_no" id="phone" placeholder="Type Phone No">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="field-3" class="col-sm-3 control-label">Reference</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" name="reference" placeholder="Reference ID / Name">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="field-3" class="col-sm-3 control-label">Type</label>
                                                    <div class="col-sm-9">
                                                        <div class="radio"><label><input type="radio" name="type" id="" value="Personal" checked="">Personal</label></div>
                                                        <div class="radio"><label><input type="radio" name="type" id="" value="Agent">Agent</label></div>
                                                    </div>
                                                </div>  
                                                <div  id="form" class="form-group ">
                                                    <div class="form-group ">
                                                        <label id="from" for="field-3" class="col-sm-3 control-label">Amount</label>                                              
                                                        <div class="col-sm-4" id="tofrom1">
                                                            <input onkeyup="calcAnswer();" id="amount" name="amount" type="number" class="form-control" placeholder="0.00 BDT">                                                        
                                                            <input class="form-control" value="Include Charge <?php echo $result['amount'] ?> RM" disabled>                                                        
                                                        </div>
                                                    </div>
                                                    <!--                                                    <div class="form-group">
                                                                                                            <label for="field-3" class="col-sm-3 control-label">Charge</label>                                              
                                                                                                            <div class="col-sm-9" id="tofrom2">
                                                                                                                <input id="to" name="to" value="BDT" type="hidden">                                                    
                                                                                                                <input  id="answer" name="answer" style="margin-top: 5px; color:red" class="form-control"  placeholder="0.00" disabled>
                                                                                                            </div>
                                                                                                        </div> -->
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-offset-3 col-sm-9">
                                                        <button type="submit" class="btn btn-default">Submit</button>
                                                    </div>
                                                </div>
                                            </form> 
                                            <!---convert code-->
                                            <script type="text/javascript">
                                                function roundNumber(number, digits) {
                                                    var multiple = Math.pow(10, 2);
                                                    var rndedNum = Math.round(number * multiple) / multiple;
                                                    return rndedNum;
                                                }

                                                function calcAnswer()
                                                {
                                                    var amount = document.getElementById("amount").value;
                                                    var from = document.getElementById("from").value;
                                                    var to = document.getElementById("to").value;
                                                    var ans;
                                                    ans = roundNumber(amount * (val1 / val2), 1);
                                                    document.getElementById("answer").value = ans;
                                                }
                                            </script>
                                            <script type="text/javascript">var val1 = '2';
                                                var val2 = '100';</script>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane <?php if (isset($segment) && $segment == 'MALAYSIA_TOPUP'): ?>fade in active<?php endif; ?>" id="htab3">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <form action="<?php echo site_url('reseller/malaysia_topup/add'); ?>" role="form" method="post" id="adminform"  class="form-horizontal">			
                                                <input type="hidden" name="reseller_id" value="<?php echo $this->session->userdata('admin_id'); ?>">
                                                <div class="form-group">
                                                    <label for="field-3" class="col-sm-3 control-label">Type</label>
                                                    <div class="col-sm-7">
                                                        <select class="form-control" id="opt_type" name="country_type">
                                                            <option value="">Select Type</option>
                                                            <option value="Promo">Promo</option>
                                                            <option value="Prepaid">Prepaid</option>
                                                            <option value="Postpaid">Postpaid</option>
                                                            <option value="Utilities">Utilities</option>                            
                                                        </select>                                                        
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <span id="result"></span> 
                                                </div>  
                                                <script type="text/javascript">
                                                    $(document).ready(function () {
                                                        $('#opt_type').change(function () {
                                                            var opt_type = $('#opt_type').val();
                                                            $.ajax({
                                                                type: 'POST',
                                                                data: {opt_type: opt_type},
                                                                url: '<?php echo site_url('reseller/malaysia_operator'); ?>',
                                                                success: function (result) {
                                                                    $('#result').html(result);
                                                                }
                                                            });
                                                        });

                                                    });
                                                </script>                                                
                                                <!--                                                <div class="form-group">
                                                                                                    <label for="field-3" class="col-sm-3 control-label">Reference</label>
                                                                                                    <div class="col-sm-7">
                                                                                                        <input type="number" class="form-control" name="reference" placeholder="Reference ID / Name">
                                                                                                    </div>
                                                                                                </div>                                               -->
                                                <div class="form-group">
                                                    <label for="field-3" class="col-sm-3 control-label">Phone No.</label>
                                                    <div class="col-sm-7">
                                                        <input type="text" class="form-control" name="phone_no" placeholder="Type Phone No">
                                                    </div>
                                                </div>                                               
                                                <div class="form-group">
                                                    <label for="field-3" class="col-sm-3 control-label">Amount</label>
                                                    <div class="col-sm-7">
                                                        <input type="number" name="amount" class="form-control" id="password" placeholder="0.00 RM">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-offset-3 col-sm-7">
                                                        <button type="submit" class="btn btn-default">Submit</button>
                                                    </div>
                                                </div>
                                            </form>                                             
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane <?php if (isset($segment) && $segment == 'INDONESIA_TOPUP'): ?>fade in active<?php endif; ?>" id="htab4">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <form action="<?php echo site_url('reseller/indonesia_topup/add'); ?>" role="form" method="post" id="adminform"  class="form-horizontal">			
                                                <input type="hidden" name="reseller_id" value="<?php echo $this->session->userdata('admin_id'); ?>">
                                                <div class="form-group">
                                                    <label for="field-3" class="col-sm-3 control-label">Operator</label>
                                                    <div class="col-sm-7">
                                                        <select class="form-control" id="opt_type" name="operator">
                                                            <option value="">Select Operator</option>                      
                                                            <option value="Axis">Axis</option>                         
                                                            <option value="Indosat">Indosat</option>                        
                                                            <option value="Telkomsel">Telkomsel</option>                         
                                                            <option value="Tri">Tri</option>                         
                                                            <option value="XL">XL</option>                            
                                                        </select>                                                        
                                                    </div>
                                                </div> 
                                                <div class="form-group">
                                                    <label for="field-3" class="col-sm-3 control-label">Phone No.</label>
                                                    <div class="col-sm-7">
                                                        <input type="text" name="phone_no" class="form-control" placeholder="Type Phone No">
                                                    </div>
                                                </div>  
                                                 
                                                <div class="form-group">
                                                    <label for="field-3" class="col-sm-3 control-label">Amount</label>
                                                    <div class="col-sm-7">
                                                        <input type="Number" name="amount" class="form-control" id="password" placeholder="0.00 IR">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-offset-3 col-sm-7">
                                                        <button type="submit" class="btn btn-default">Submit</button>
                                                    </div>
                                                </div>
                                            </form> 
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane <?php if (isset($segment) && $segment == 'NEAPL_TOPUP'): ?>fade in active<?php endif; ?>" id="htab5">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <form action="<?php echo site_url('reseller/nepal_topup/add'); ?>" role="form" method="post" id="adminform"  class="form-horizontal">			
                                                <input type="hidden" name="reseller_id" value="<?php echo $this->session->userdata('admin_id'); ?>">
                                                <div class="form-group">
                                                    <label for="field-3" class="col-sm-3 control-label">Phone No.</label>
                                                    <div class="col-sm-7">
                                                        <input type="text" name="phone_no" class="form-control" placeholder="Type Phone No">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="field-3" class="col-sm-3 control-label">Amount</label>
                                                    <div class="col-sm-7">
                                                        <input type="number" name="amount" class="form-control" id="password" placeholder="0.00 NR">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-offset-3 col-sm-7">
                                                        <button type="submit" class="btn btn-default">Submit</button>
                                                    </div>
                                                </div>
                                            </form>                                            
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