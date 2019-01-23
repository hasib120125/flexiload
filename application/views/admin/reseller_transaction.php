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
        <?php $this->load->view('admin/header'); ?> 

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
                <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
                <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
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
                                <li><i class="fa fa-home pr-10"></i><a href="#">Home</a></li>
                                <li><a href="#">Reseller</a></li>
                                <li class="active">Transaction History</li>
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
                                    <?php
                                    $pro_list = $this->meclicksasia->get_data_list_by_single_column('admin', 'admin_id', $admin_id);



                                    foreach ($pro_list as $each_info):
                                        ?>
                                        <b style="text-decoration: underline;">Reseller Information</b><br>
                                        Name: <?php echo $each_info['name'] ?><br>
                                        phone: <?php echo $each_info['phone'] ?><br>
                                        Email: <i><?php echo $each_info['email'] ?></i>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <div class="panel-body">
                                <table class="table table-bordered datatable" id="table-1">
                                    <thead>
                                        <tr>                                
                                            <th>SL</th>                   
                                            <th>Date</th>                               
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $indi_list = $this->meclicksasia->get_data_list_by_single_column('transaction', 'admin_id', $admin_id);
                                        $total_amount = 0;
                                        foreach ($indi_list as $each_info):
                                            if ($each_info['class'] == 'In'):
                                                ?>
                                                <tr class="odd gradeX">
                                                    <td><?php echo $each_info['admin_id']; ?></td>               
                                                    <td><?php echo $each_info['created_at']; ?></td>                  
                                                    <td><?php
                                                        echo $each_info['amount'];
                                                        ?></td>   
                                                    <?php
                                                    $total_amount+=$each_info['amount'];
                                                    ?>
                                                </tr>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th><b>Total</b></th>                    
                                            <th></th>           
                                            <th><b><?php echo $total_amount . '.00'; ?></b></th>
                                        </tr>
                                    </tfoot>
                                </table>
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
            <?php $this->load->view('admin/footer'); ?> 
    </body>
</html>

