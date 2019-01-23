<!DOCTYPE html>
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <title><?php echo $title; ?></title>
        <meta name="description" content="">
        <meta name="author" content="eclicksasia">
        <!-- Mobile Meta -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/neon-core.css">

        <?php $this->load->view('admin/header'); ?> 

    </head>
    <body class="front no-trans">
        <div class="scrollToTop"><i class="icon-up-open-big"></i></div>
       <!--<div class="page-wrapper">-->
            <?php  $this->load->view('admin/menu'); ?> 
            <div class="page-intro">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <ol class="breadcrumb">
                                <li><i class="fa fa-home pr-10"></i><a href="<?php echo site_url('admin/index') ?>">Home</a></li>
                                <li class="active">Inactive Reseller</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <section class="main-container">
                <div class="main">

                    <div class="container">
                        <div class="row">
                            <div class="col-md-2 pull-left">
                                <h2><a href="<?php echo site_url('admin/reseller_create'); ?>" class="btn btn-default pull-left"  data-animate="1" style="margin-left:5px">Add Reseller</a></h2>
                            </div>
                            <!--                            <div class="col-md-8">
                                                            <form role="form" method="POST" class="form-horizontal" action="<?php //echo site_url('reseller_search_data_list');            ?>">
                                                                <div class="form-group">
                                                                    <label class="col-md-4 control-label">Search by date</label>
                                                                    <div class="col-md-4">
                                                                        <input type="text" class="form-control datepicker" name="first_date" id="date1"data-format="yyyy-mm-dd">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <input type="text" class="form-control datepicker" name="second_date" id="date1"data-format="yyyy-mm-dd">
                                                                    </div>
                                                                    <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span> Search</button>
                                                                </div>
                                                            </form>                                
                                                        </div>-->
                            <div class="col-md-2 pull-right">
                                <h2><a href="<?php echo site_url('admin/transaction'); ?>" class="btn btn-default pull-right"  data-animate="1" style="margin-right:5px">Transaction Records</a></h2>
                            </div>
                        </div>

                        <div class="panel panel-primary" data-collapsed="0">
                            <div class="panel-heading">
                                <div class="panel-title">
                                    Resellers Information
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">

                                    <table class="table table-bordered datatable" id="table-1">
                                        <thead>
                                            <tr>                                                     
                                                <th>Date</th>                    
                                                <th>Name</th>                    
                                                <th>Phone</th>                    
                                                <th>Address</th>                    
                                                <th>Email</th>                    
                                                <th>Amount</th>                    
                                                <th>Action</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $query = $this->meclicksasia->reseller();
//                                        echo "<pre>";
//                                        print_r($query);
//                                        die;
                                            foreach ($query as $row): 
                                                if($row['status']=='Inactive'):
                                                ?>
                                                <tr class="odd gradeX">
                                                    <td><?php echo $row['date']; ?></td>
                                                    <td><?php echo $row['name']; ?></td> 
                                                    <td><?php echo $row['phone']; ?></td>
                                                    <td><?php echo $row['address']; ?></td>
                                                    <td><?php echo $row['email']; ?></td>

                                                    <td><?php
                                                            $in = $this->meclicksasia->transaction_in($row['admin_id']);
                                                            $out = $this->meclicksasia->transaction_out($row['admin_id']);
                                                            $commission = $this->meclicksasia->transaction_commissions($row['admin_id']);
                                                            $charge = $this->meclicksasia->transaction_charge($row['admin_id']);
                                                            $balance = $in + $commission - $out - $charge;
                                                            echo number_format((float)$balance,2,'.','');
                                                        ?></td>
                                                    <td>
                                                        <?php if ($this->session->userdata('admin_type') == 'Master'): ?>
                                                            <a href="javascript:;" onclick="jQuery('#modal-<?php echo $row['admin_id'] ?>').modal('show');" class="btn btn-default btn-sm">
                                                                <i class="entypo-up"></i>Add Balance
                                                            </a>
                                                            <div class="modal fade" id="modal-<?php echo $row['admin_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                                            <h4 class="modal-title" id="myModalLabel">Add Balance</h4>
                                                                        </div>
                                                                        <form role="form" method="post"  class="form-horizontal" action="<?php echo site_url('reseller/send_money/' . $row['admin_id']) ?>">
                                                                            <div class="modal-body">
                                                                                <div class="form-group" >                                
                                                                                    <label class="col-md-2  control-label">Amount</label>
                                                                                    <input style="padding-right: 200px;" type="text" class="form-control col-md-2" name="amount" id="email" placeholder="0.00">
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
                                                                                <button type="submit" class="btn btn-sm btn-primary">ADD</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div> 
                                                        <?php endif; ?>
                                                        <a href="<?php echo site_url('admin/reseller_transaction/' . $row['admin_id']); ?>" class="btn btn-default btn-sm">
                                                            <i></i>
                                                            In Balance History
                                                        </a>
                                                        <a href="<?php echo site_url('admin/reseller_out_transaction/' . $row['admin_id']); ?>" class="btn btn-default btn-sm">
                                                            <i></i>
                                                            Out Balance History
                                                        </a>
                                                        <a href="<?php echo site_url('admin/reseller_update/' . $row['admin_id']); ?>" class="btn btn-default btn-sm">
                                                            <i></i>
                                                            Edit
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <form action="<?php echo site_url('admin/reseller_update_status/'.$row['admin_id']); ?>" method="POST" role="form">
                                                            <?php if($row['status']=='Active'): ?>
                                                            <input type="hidden" name="status" value="Inactive">
                                                            <button type="submit" value="<?php echo $row['status']; ?>" class="btn btn-success btn-sm"><?php echo $row['status']; ?></button>
                                                            <?php elseif($row['status']=='Inactive'): ?>
                                                            <input type="hidden" name="status" value="Active">
                                                            <button type="submit" value="<?php echo $row['status']; ?>" class="btn btn-warning btn-sm"><?php echo $row['status']; ?></button>
                                                            <?php endif; ?>
                                                        </form>
                                                    </td>
                                                </tr>
                                            <?php endif;
                                            endforeach; ?>
                                        </tbody>
                                    </table>

                                    <!--action here-->
                                    <script type="text/javascript">
                                        var responsiveHelper;
                                        var breakpointDefinition = {
                                            tablet: 1024,
                                            phone: 480
                                        };
                                        var tableContainer;

                                        jQuery(document).ready(function($)
                                        {
                                            tableContainer = $("#table-1");

                                            tableContainer.dataTable({
                                                "sPaginationType": "bootstrap",
                                                "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                                                "bStateSave": true,
                                                // Responsive Settings
                                                bAutoWidth: false,
                                                fnPreDrawCallback: function() {
                                                    // Initialize the responsive datatables helper once.
                                                    if (!responsiveHelper) {
                                                        responsiveHelper = new ResponsiveDatatablesHelper(tableContainer, breakpointDefinition);
                                                    }
                                                },
                                                fnRowCallback: function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                                                    responsiveHelper.createExpandIcon(nRow);
                                                },
                                                fnDrawCallback: function(oSettings) {
                                                    responsiveHelper.respond();
                                                }
                                            });

                                            $(".dataTables_wrapper select").select2({
                                                minimumResultsForSearch: -1
                                            });
                                        });
                                    </script>

                                    <script type="text/javascript">
                                        jQuery(window).load(function()
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
                                            $("#table-2 tbody input[type=checkbox]").each(function(i, el)
                                            {
                                                var $this = $(el),
                                                        $p = $this.closest('tr');

                                                $(el).on('change', function()
                                                {
                                                    var is_checked = $this.is(':checked');

                                                    $p[is_checked ? 'addClass' : 'removeClass']('highlight');
                                                });
                                            });

                                            // Replace Checboxes
                                            $(".pagination a").click(function(ev)
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
                                        jQuery(document).ready(function($)
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

                                    <br />




                                    <script type="text/javascript">
                                        jQuery(document).ready(function($)
                                        {
                                            var table = $("#table-4").dataTable({
                                                "sPaginationType": "bootstrap",
                                                "sDom": "<'row'<'col-xs-6 col-left'l><'col-xs-6 col-right'<'export-data'T>f>r>t<'row'<'col-xs-6 col-left'i><'col-xs-6 col-right'p>>",
                                                "oTableTools": {
                                                },
                                            });
                                        });

                                    </script>
                                    <!-- action end--->

                                </div>
                            </div>
                        </div>   
                        
                        <div class="row">
                            <div class="col-md-2 pull-left">
                                <h2><a href="<?php echo site_url('admin/reseller'); ?>" class="btn btn-default pull-left"  data-animate="1" style="margin-left:5px">Active Reseller List</a></h2>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </section>   

            <script>
                //               $.noConflict();
            </script>
            <!--<link rel="stylesheet" href="<?php // echo base_url();  ?>assets/datatables/responsive/css/datatables.responsive.css">-->
            <!--<script src="<?php // echo base_url();        ?>assets/jquery.dataTables.min.js"></script>-->
            <!--<script src="<?php // echo base_url();        ?>assets/datatables/TableTools.min.js"></script>-->
            <!--<script src="<?php // echo base_url();        ?>assets/dataTables.bootstrap.js"></script>-->
            <!--<script src="<?php // echo base_url();        ?>assets/datatables/jquery.dataTables.columnFilter.js"></script>-->
            <!--<script src="<?php // echo base_url();        ?>assets/datatables/lodash.min.js"></script>-->
            <!--<script src="<?php // echo base_url();        ?>assets/datatables/responsive/js/datatables.responsive.js"></script>-->

            <?php $this->load->view('admin/footer'); ?> 

    </body>
</html>