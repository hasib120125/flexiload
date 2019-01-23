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
                    dateFormat: 'dd-mm-yyyy'
                });
                $('#date2').datepick();
            });
            $(function () {
                $('#popupDatepicker2').datepick({
                    dateFormat: 'dd-mm-yyyy'
                });
                $('#date2').datepick();
            })
        </script>
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
                                   Search Top-Up Information
                                </div>
                            </div>
                            <div class="panel-body"> 
                                <div class="table-responsive">
                                    <table class="table table-bordered datatable" id="table-1">
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
                                                <th>Commission (+)</th> 
                                                <th>Charge (-)</th> 
                                                <th>Actual Cost</th> 
                                              <!----  <th>Points</th> ---->
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
                                            // $query = $this->meclicksasia->table_data('transaction', 'admin_id', $admin_id, 'created_at');
                                            //$all_list = $this->meclicksasia->table_data('transaction', 'admin_id', $admin_id, 'created_at');
                                            //$all_list = $this->Common_model->get_data_list('transaction');
                                            //dumpVar($all_list);
                                            foreach ($all_list as $row):
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
                                                            echo '0.00';
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
                                                            echo '0.00';
                                                        endif;
                                                        ?>
                                                    </td>

                                                    <td>R.&nbsp;<?php
                                                        if ($row['rm_rate'] != 0):
                                                            echo number_format((float) $row['amount'] / $row['rm_rate'], 2, '.', '');
                                                            $ttl_cost_point += $row['amount'] / $row['rm_rate'];
                                                        else:
                                                            echo '0.00';
                                                        endif;
                                                        ?>
                                                    </td>

                                                    <td>R.&nbsp;<?php
                                                        echo number_format((float) $row['commission'], 2, '.', '');
                                                        $commission = $row['commission'];
                                                        $ttl_commission += $row['commission'];
                                                        ?>
                                                    </td>

                                                    <td>R.&nbsp;<?php
                                                        echo number_format((float) $row['charge'], 2, '.', '');
                                                        $charge = $row['charge'];
                                                        $ttl_charge += $row['charge'];
                                                        ?></td>

                                                    <td>R.&nbsp;<?php
                                                        $actual_cost = $country_out + $charge - $commission;
                                                        echo number_format((float) $actual_cost, 2, '.', '');
                                                        $ttl_actual_cost += $actual_cost;
                                                        ?></td>

                                                   <!--- <td>R.&nbsp;<?php
                                                        $balance = $ttl_deposit + $ttl_commission - $total_country_out - $ttl_charge;
                                                        echo number_format((float) $balance, 2, '.', '');
                                                        ?></td>                                                
                                                </tr> --->
                                            <?php endforeach; ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="5">Total Amount</th>
                                                <th style="">R.&nbsp;<?php echo number_format((float) $ttl_deposit, 2, '.', ''); ?></th>
                                                <th style=""></th>
                                                <th style="">R.&nbsp;<?php echo number_format((float) $ttl_cost_point, 2, '.', ''); ?></th>
                                                <th style="">R.&nbsp;<?php echo number_format((float) $ttl_commission, 2, '.', ''); ?></th>
                                                <th style="">R.&nbsp;<?php echo number_format((float) $ttl_charge, 2, '.', ''); ?></th>
                                                <th style="">R.&nbsp;<?php echo number_format((float) $ttl_actual_cost, 2, '.', ''); ?></th>
                                                <!---- <th style="">R.&nbsp;<?php echo number_format((float) $balance, 2, '.', ''); ?></th> ---->
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>                        
                    </div>
                </div>
            </section>           
            <?php $this->load->view('reseller/footer'); ?> 
        </div>
    </body>
</html>

