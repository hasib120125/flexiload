
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
                                <li class="active">Profile</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <section class="main-container">
                <div class="main">
                    <div class="container"> 
                        <!-- message -->
                        <?php
                        $message = $this->session->userdata('message');
                        if (isset($message) || !empty($message)):
                            ?>
                            <div class="alert alert-success fade in widget-inner">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <i class="fa fa-check"></i> <?php echo $message; ?>
                            </div>            
                            <?php
                            $this->session->unset_userdata('message');
                        endif;
                        ?>
                        <?php
                        $error = $this->session->userdata('error');
                        if (isset($error) || !empty($error)):
                            ?>
                            <div class="alert alert-danger fade in widget-inner">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <i class="fa fa-check"></i> <?php echo $error; ?>
                            </div>            
                            <?php
                            $this->session->unset_userdata('error');
                        endif;
                        ?>


                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                                <div class="panel panel-primary" data-collapsed="0" style="border: 1px solid #cf2e16">
                                    <div class="panel-heading" style="background: #cf2e16">
                                        <div class="panel-title">
                                            Reseller Details
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <?php
                                        $id = $this->uri->segment(3);
//dumpVar($id);
                                        $admin_details = $this->meclicksasia->table_info('admin', 'admin_id', $id);
                                        //dumpVar($admin_details);
                                        ?>
                                        <table class="table table-bordered datatable" id="table-1">
                                            <tbody>
                                                <tr>
                                                    <td colspan="4">
                                            <center>
                                                <img class="img-responsive" src="<?php
                                                     if (file_exists('assets/reseller/' . $admin_details->photo)):
                                                         echo base_url() . 'assets/reseller/' . $admin_details->photo;
                                                     endif;
                                                     ?>" width="150">
                                            </center>
                                            </td>
                                            </tr>
                                            <tr>
                                                <td>Date</td>
                                                <td><?php echo $admin_details->date; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Name</td>
                                                <td><?php echo $admin_details->name; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Phone</td>
                                                <td><?php echo $admin_details->phone; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Email</td>
                                                <td><?php echo $admin_details->email; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Address</td>
                                                <td><?php echo $admin_details->address; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Current Plan </td>
                                                <td><?php $idV = $admin_details->plan_id; echo $this->meclicksasia->table_info('plan', 'plan_id', $idV)->plan_title; ?></td>
                                                <td><?php // echo $admin_details->plan_id; ?></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>





                    </div>
            </section>  
            <br><br><br>
<?php $this->load->view('admin/footer'); ?> 
            </table>
        </div>
    </div>   




</body>
</html>



