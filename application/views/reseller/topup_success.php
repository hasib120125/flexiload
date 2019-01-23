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
        <!-- header -->
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
                                <li class="active">Topup Success</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>


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
                 

                 <?php  $Processing =$this->session->userdata('Processing');
                 if($Processing !=null){
                    echo $Processing;
                    } ?>
            <!-- end of modification -->
        <?php 

         if($lastid !=null){
        $topupsuccess = $this->meclicksasia->topupsuccess($lastid); ?> 

            <section class="main-container">
                <div class="main">
                    <div class="container">
                        <div class="col-md-3"></div>
                        <div class="col-md-5">
                            <h3>Acknowledgement  </h3>
                            <table class="table table-bordered datatable table-hover" id="table-1">
                                <thead>
                                        <th  style="text-align: center"; colspan="4">Top-Up</th>
                                    </tr>
                                </thead>
                                <tbody >
                                    <tr>
                                        <td>Ref No</td>                                     
                                        <td><?php echo $topupsuccess->reference ?></td>
                                    </tr>
                                    <tr>
                                        <td>Date</td>                                     
                                        <td><?php echo $topupsuccess->created_at ?></td>
                                    </tr>
                                    <tr>
                                        <td>Reseller</td>                                     
                                        <td><?php $admin_id = $this->session->userdata('admin_id');
                                            $reseller = $this->meclicksasia->table_info('admin', 'admin_id', $admin_id);
                                            echo $reseller->name; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Country</td>                                     
                                        <td><?php echo $topupsuccess->country ?></td>
                                    </tr>
                                    <tr>
                                        <td>Type</td>                                     
                                        <td><?php echo $topupsuccess->country_type ?></td>
                                    </tr>
                                    <tr>
                                        <td>Operator</td>                                     
                                        <td><?php echo $topupsuccess->operator ?></td>
                                    </tr>
                                    <tr>
                                        <td>Phone No</td>                                     
                                        <td><?php echo $topupsuccess->phone_no ?></td>
                                    </tr>
                                    <tr>
                                        <td>Top-Up Amount</td>                                     
                                        <td><?php echo $topupsuccess->amount ?></td>
                                    </tr>
                                    <tr>
                                        <td>Cost Points</td>                                     
                                        <td><?php
                                                if ($topupsuccess->country == 'Malaysia') {
                                                    echo $row['amount'];
                                                   
                                                } elseif ($topupsuccess->country == 'Indonesia') {
                                                    echo number_format((float) $cost_point = $topupsuccess->amount / $topupsuccess->rm_rate, 4, '.', '');
                                                   
                                                } else if ($topupsuccess->rm_rate != 0) {
                                                    echo number_format((float) $cost_point = $topupsuccess->amount / $topupsuccess->rm_rate, 4, '.', '');
                                                    
                                                } else {
                                                    echo '0.0000';
                                                }
                                                ?></td>
                                    </tr>
                                    <tr>
                                        <td>Commission</td>                                     
                                        <td><?php echo $topupsuccess->commission ?></td>
                                    </tr>
                                    <tr>
                                        <td>Charge</td>                                     
                                        <td><?php echo $topupsuccess->charge ?></td>
                                    </tr>
                                    <tr>
                                        <td>Actual Cost</td> 
                                        <td><?php
                                            if ($topupsuccess->country == 'Malaysia') {
                                                $test = $topupsuccess->amount;
                                                $actual_cost = $test - $topupsuccess->commission;
                                                echo number_format((float) $actual_cost, 4, '.', '');
                                            }else{echo "0.0000";}?>
                                    </td> 

                            
                                    </tr>
                                    <tr>
                                        <td>Status</td>                                     
                                        <td><?php echo $topupsuccess->status ?></td>
                                    </tr>          
                                </tbody>                                  
                            </table>  
                            <a  href="<?php echo base_url() ?>topup" class="btn btn-default">Back</a>                        
                        </div>     
                    </div>
                </div>
            </section>
        <?php } ?>
            <br>
       
            <br>
            <br>
            <?php $this->load->view('reseller/footer'); ?> 

            </body>
            </html>

