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
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/neon-core.css">
        <!-- header -->
        <?php $this->load->view('reseller/header'); ?> 


        <link href="<?php echo base_url() ?>datepicker/jquery.datepick.css" rel="stylesheet">
        <script src="<?php echo base_url() ?>datepicker/jquery.plugin.js"></script>
        <script src="<?php echo base_url() ?>datepicker/jquery.datepick.js"></script>
        <script>
            $(function () {
                $('#popupDatepicker').datepick({
                    dateFormat: 'yyyy-mm-dd'
                });
                $('#date2').datepick();

            });
            $(function () {
                $('#popupDatepicker2').datepick({
                    dateFormat: 'yyyy-mm-dd'
                });
                $('#date2').datepick();

            })
        </script>
		<style>
			.styleCSSMY{background-color: red}
		</style>
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
                                <li><i class="fa fa-home pr-10"></i><a href="<?php echo site_url('reseller/index') ?>">Home</a></li>
                                <li class="active">Report</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <section class="main-container">
                <div class="main">
                    <div class="container">
                        <div class="panel panel-primary" data-collapsed="0">
                            <div class="panel-heading">
                                <div class="panel-title">
                                    Top-Up Information
                                </div>
                            </div>
                            <div class="panel-body"> 
                                <div class="table-responsive">
                                    <table class="table table-bordered datatable table-responsive" id="table-1"  style="font-size: 12px">
                                        <div class="row">
                                            <form role="form" method="POST" class="form-horizontal" action="<?php echo site_url('reseller/tr_search_list'); ?>">
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label" style="margin-top:8px;">From Date</label>
                                                        <div class="col-md-9">
                                                            <input type="text"  name="first_date" id="popupDatepicker" class="form-control datepicker" placeholder="00-00-0000" >       
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="form-group">  
                                                        <label class="col-md-3 control-label" style="margin-top:8px;">To date</label>
                                                        <div class="col-md-9">
                                                            <input type="text" name="second_date" id="popupDatepicker2" class="form-control datepicker" placeholder="00-00-0000">       
                                                        </div>
                                                    </div>
                                                </div> 

                                                <div class="col-md-2">
                                                    <div class="form-group">  
                                                        <button type="submit" class="btn btn-default" style="margin-top: 0px;">
                                                            <span class="glyphicon glyphicon-search"></span> Search
                                                        </button>
                                                        <div class="col-md-6">

                                                        </div>
                                                    </div>
                                                </div> 
                                            </form>
                                        </div>
                                        <thead>
                                            <tr>                  
                                                <th>Date</th>
<th>Ref No</th>                       
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
                                                <th>Balance Points</th> 
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

                                            $query = $this->meclicksasia->table_data('transaction', 'admin_id', $admin_id, 'created_at');
                                            foreach ($query as $row):
                                                $country_out = 0;
                                                $commission = 0;
                                                $charge = 0;
                                                ?>
                                                <tr class="odd gradeX">
                                                    <td><?php echo $row['created_at']; ?></td>
<td><?php echo $row['reference']; ?></td> 
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
//                                                            echo number_format((float) $cost_point, 4, '.', '');
                                                            // $ttl_actual_cost += $cost_point;
                                                        }
                                                        ?>
                                                    </td>
                                                    <td>R.&nbsp;<?php
                                                        $balance = $ttl_deposit - $ttl_charge - $ttl_actual_cost;
//                                                        $balance = $ttl_deposit - $total_country_out - $ttl_charge - $ttl_actual_cost;
                                                        echo number_format((float) $balance, 4, '.', '');
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
                                        <tfoot>
                                            <tr>
                                                <th colspan="5">Total Amount</th>
                                                <th style="">R.&nbsp;<?php echo number_format((float) $ttl_deposit, 4, '.', ''); ?></th>
                                                <th style=""></th>
                                                <th style="">R.&nbsp;<?php echo number_format((float) $ttl_cost_point, 4, '.', ''); ?></th>
                                                <th style="">R.&nbsp;<?php echo number_format((float) $ttl_commission, 4, '.', ''); ?></th>
                                                <th style="">R.&nbsp;<?php echo number_format((float) $ttl_charge, 4, '.', ''); ?></th>
                                                <th style="">R.&nbsp;<?php echo number_format((float) $ttl_actual_cost, 4, '.', ''); ?></th>
                                                <th style="">R.&nbsp;<?php echo number_format((float) $balance, 4, '.', ''); ?></th>
                                                <th style=""></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <!--<h6 class="text-center">* Cost Point = Top-Up Amount / Exchange Rate | * Points = (Deposit Amount - Cost Point) + Commission - Charge </h6>-->
                                </div>
                            </div>
                        </div>                        
                    </div>
                </div>
            </section>


            <section class="main-container">
                <div class="main">
                    <div class="container">
                        <div class="panel panel-primary" data-collapsed="0">
                            <div class="panel-heading">
                                <div style="text-align: center" class="panel-title">
                                    Refunded Balance History 
                                </div>
                            </div>
                            <div class="panel-body">                                
                                <div class="table-responsive">
                                    <table class="table table-bordered datatable " id="table-1"  style="font-size: 12px">
                                        <thead>
                                            <tr>                                                     
                                                <th>Date</th>                                    
                                                <th>Country</th>                    
                                                <th>Type</th>                    
                                                <th>Operator</th>                    
                                                <th>Phone No.</th> 
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
                                            $querys = $this->meclicksasia->table_data('transaction', 'admin_id', $admin_id, 'created_at');

                                            foreach ($querys as $row):
                                                if ($row['refun_status'] == '1') {
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
                                                            ?></td>

                                                        <td>R.&nbsp;<?php
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
//                                                            echo number_format((float) $cost_point, 4, '.', '');
                                                                // $ttl_actual_cost += $cost_point;
                                                            }
                                                            ?>


                                                        <td>
                                                            <?php
                                                            if ($row['status'] == 'Fail') {
                                                                if ($row['refun_status'] == '1') {
                                                                    echo '<b style="color:green">' . 'Refunded' . '</b>';
                                                                } elseif ($row['refun_status'] == '0') {
                                                                    if ($row['country'] == 'Malaysia') {
                                                                        $test = $row['amount'];
                                                                        $actual_cost = $test - $commission;
                                                                        $balAnce = number_format((float) $actual_cost, 4, '.', '');
                                                                        $ttl_actual_cost += $actual_cost;
                                                                    } elseif (($row['country'] == 'Indonesia') || ($row['country'] == 'Nepal')) {
                                                                        $balAnce = number_format((float) $cost_point, 4, '.', '');
                                                                        $ttl_actual_cost += $cost_point;
                                                                    } elseif (($row['type'] == 'Personal') || ($row['type'] == 'Agent')) {
                                                                        $actual_cost = $cost_point + $charge;
                                                                        $balAnce = number_format((float) $actual_cost, 4, '.', '');
                                                                        $ttl_actual_cost += $actual_cost;
                                                                    } elseif ($row['country'] == 'Bangladesh') {
                                                                        $balAnce = number_format((float) $cost_point, 4, '.', '');
                                                                        $ttl_actual_cost += $cost_point;
                                                                    } else {
                                                                        echo '0.0000';
                                                                    }
                                                                    ?>
                                                                    <a href="<?php echo site_url('admin/refun_amount/') . $row['transaction_id'] . '/' . $balAnce ?>" onclick="return confirm('Want to Refund This amount !')" style="margin-top: 0px;margin-bottom: 0px;padding: 1px; font-size: 10px" class="btn btn-default btn-sm">
                                                                        <i class="entypo-up"></i>Refund
                                                                    </a>
                                                                    <?php
                                                                }
                                                            } else {
                                                                echo $row['status'];
                                                            }
                                                            ?>
                                                        <?php } ?>
                                                    </td>  
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                        
                                    </table>
                                    <!--<h6 class="text-center">* Cost Point = Top-Up Amount / Exchange Rate | * Points = (Deposit Amount - Cost Point) + Commission - Charge </h6>-->

                                </div>  
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <script type="text/javascript">
                var responsiveHelper;
                var breakpointDefinition = {
                    tablet: 1024,
                    phone: 480
                };
                var tableContainer;

                jQuery(document).ready(function ($)
                {
                    tableContainer = $("#table-1");

                    tableContainer.dataTable({
                        "sPaginationType": "bootstrap",
                        "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                        "bStateSave": true,
                        // Responsive Settings
                        bAutoWidth: false,
                        fnPreDrawCallback: function () {
                            // Initialize the responsive datatables helper once.
                            if (!responsiveHelper) {
                                responsiveHelper = new ResponsiveDatatablesHelper(tableContainer, breakpointDefinition);
                            }
                        },
                        fnRowCallback: function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                            responsiveHelper.createExpandIcon(nRow);
                        },
                        fnDrawCallback: function (oSettings) {
                            responsiveHelper.respond();
                        }
                    });

                    $(".dataTables_wrapper select").select2({
                        minimumResultsForSearch: -1
                    });
                });
            </script>

            <script type="text/javascript">
                jQuery(window).load(function ()
                {
                    var $ = jQuery;

                    $("#table-2").dataTable({
                        "sPaginationType": "bootstrap",
                        "sDom": "t<'row'<'col-xs-6 col-left'i><'col-xs-6 col-right'p>>",
                        "bStateSave": false,
                        "iDisplayLength": 8,
                        "aoColumns": [
                            {"bSortable": false},
                            null,
                            null,
                            null,
                            null
                        ]
                    });

                    $(".dataTables_wrapper select").select2({
                        minimumResultsForSearch: -1
                    });

                    // Highlighted rows
                    $("#table-2 tbody input[type=checkbox]").each(function (i, el)
                    {
                        var $this = $(el),
                                $p = $this.closest('tr');

                        $(el).on('change', function ()
                        {
                            var is_checked = $this.is(':checked');

                            $p[is_checked ? 'addClass' : 'removeClass']('highlight');
                        });
                    });

                    // Replace Checboxes
                    $(".pagination a").click(function (ev)
                    {
                        replaceCheckboxes();
                    });
                });

                // Sample Function to add new row
                var giCount = 1;

                function fnClickAddRow()
                {
                    $('#table-2').dataTable().fnAddData(['<div class="checkbox checkbox-replace"><input type="checkbox" /></div>', giCount + ".2", giCount + ".3", giCount + ".4", giCount + ".5"]);

                    replaceCheckboxes(); // because there is checkbox, replace it

                    giCount++;
                }
            </script>



            <br />
            <br />



            <br />



            <script type="text/javascript">
                jQuery(document).ready(function ($)
                {
                    var table = $("#table-3").dataTable({
                        "sPaginationType": "bootstrap",
                        "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                        "bStateSave": true
                    });

                    table.columnFilter({
                        "sPlaceHolder": "head:after"
                    });
                });
            </script>
            <?php $this->load->view('reseller/footer'); ?> 

    </body>
</html>

