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
        <?php $this->load->view('admin/header'); ?> 

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
                <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
                <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/neon-core.css">
    </head>


    <body class="front no-trans">

        <div class="scrollToTop"><i class="icon-up-open-big"></i></div>

        <div class="page-wrapper">

            <?php $this->load->view('admin/menu'); ?> 

            <div class="page-intro">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <ol class="breadcrumb">
                                <li><i class="fa fa-home pr-10"></i><a href="<?php echo site_url('admin/index') ?>">Home</a></li>
                                <li class="active">Rates</li>
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
                                <h2><a href="<?php echo site_url('admin/rates_create'); ?>" class="btn btn-default pull-left"  data-animate="1" style="margin-left:5px">Add New Rate</a></h2>
                            </div>
                            <!--                            <div class="col-md-8">
                                                            <form role="form" method="POST" class="form-horizontal" action="<?php //echo site_url('reseller_search_data_list');          ?>">
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

                        </div>

                        <div class="panel panel-primary" data-collapsed="0">
                            <div class="panel-heading">
                                <div class="panel-title">
                                    Rates Information
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered datatable" id="table-1">
                                        <thead>
                                            <tr>                                                     
                                                <th>Date</th>                    
                                                <th>Malaysia</th>                    
                                                <th>Bangladesh</th>                                                                           
                                                <th>Indonesia</th>                                                                           
                                                <th>Nepal</th>                                                                           
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $query = $this->meclicksasia->rates();

//                                        echo  "<pre>";
//                                        print_r($query);
//                                        die;
                                            foreach ($query as $row):
                                                ?>
                                                <tr class="odd gradeX">
                                                    <td><?php echo $row['date']; ?></td>
                                                    <td>RM. 1.00</td> 
                                                    <td>BDT. <?php echo $row['bangladesh']; ?></td>
                                                    <td>IR. <?php echo $row['indonesia']; ?></td>
                                                    <td>NR. <?php echo $row['nepal']; ?></td>
                                                    <td>
                                                        <a href="<?php echo site_url('admin/rates_update/' . $row['rates_id']); ?>" class="btn btn-default btn-sm btn-icon icon-left">
                                                            <i class="entypo-pencil"></i>
                                                            Edit
                                                        </a>
                                                        <a href="<?php echo site_url('admin/rates_delete/' . $row['rates_id']); ?>" onclick="return confirm('Want to delete!')" class="btn btn-default btn-sm btn-icon icon-left">
                                                            <i class="entypo-pencil"></i>
                                                            Delete
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
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

                                    <br />




                                    <script type="text/javascript">
                                        jQuery(document).ready(function ($)
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

                    </div>
                </div>
            </section>   

            <script>
//                $.noConflict();
            </script>
            <!--<link rel="stylesheet" href="<?php // echo base_url();      ?>assets/datatables/responsive/css/datatables.responsive.css">-->
            <!--<script src="<?php // echo base_url();      ?>assets/jquery.dataTables.min.js"></script>-->
            <!--<script src="<?php // echo base_url();      ?>assets/datatables/TableTools.min.js"></script>-->
            <!--<script src="<?php // echo base_url();      ?>assets/dataTables.bootstrap.js"></script>-->
            <!--<script src="<?php // echo base_url();      ?>assets/datatables/jquery.dataTables.columnFilter.js"></script>-->
            <!--<script src="<?php // echo base_url();      ?>assets/datatables/lodash.min.js"></script>-->
            <!--<script src="<?php // echo base_url();      ?>assets/datatables/responsive/js/datatables.responsive.js"></script>-->

            <?php $this->load->view('admin/footer'); ?> 

    </body>
</html>