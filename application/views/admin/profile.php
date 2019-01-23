
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
		
		<style type="text/css">
			.mycss{
				margin-top:-12px;
			}
		</style>
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
                                <li><i class="fa fa-home pr-10"></i><a href="<?php echo site_url('admin/index')?>">Home</a></li>
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
                        if(isset($message)||!empty($message)):
                        ?>
                        <div class="alert alert-success fade in widget-inner">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <i class="fa fa-check"></i> <?php echo $message; ?>
                        </div>            
                        <?php $this->session->unset_userdata('message'); endif; ?>
                        <?php 
                        $error = $this->session->userdata('error');
                        if(isset($error)||!empty($error)):
                        ?>
                        <div class="alert alert-danger fade in widget-inner">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <i class="fa fa-check"></i> <?php echo $error; ?>
                        </div>            
                        <?php $this->session->unset_userdata('error'); endif; ?>
                        
						
									<form action="<?php echo site_url('admin/server_message/add'); ?>" role="form" method="post" id="adminform">
										<div class="form-group">
											<div class="col-sm-3">
												<select class="form-control" name="type">
													<option value="1">Show</option>
													<option value="2">Hide</option>
												</select>
											</div>
										</div>
										<div class="form-group">
											<div class="col-sm-6">
												<input class="form-control" type="text" name="textmessage" placeholder="Type Message Here"/>
											</div>
										</div>
										<div class="form-group ">
											<div class="col-sm-3 mycss">
												<button type="submit"  class="btn btn-default">Update</button>
											</div>
										</div>
									</form> 
								<br>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="panel panel-primary" data-collapsed="0" style="border: 1px solid #cf2e16">
                                    <div class="panel-heading" style="background: #cf2e16">
                                        <div class="panel-title">
                                            SMSTopUp Current Balance
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <?php echo $this->meclicksasia->smstopup_balance(); ?>
                                    </div>
                                </div>                                 
                            </div>
                            <div class="col-md-8">
                                <div class="panel panel-primary" data-collapsed="0" style="border: 1px solid #cf2e16">
                                    <div class="panel-heading" style="background: #cf2e16">
                                        <div class="panel-title">
                                            Profile
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <?php $reseller = $this->meclicksasia->table_info('admin', 'admin_id', $admin_id); ?>
                                        <table class="table table-bordered datatable" id="table-1">
                                            <tbody>
                                                <tr>
                                                    <td colspan="4">
                                                <center>
                                                    <img class="img-responsive" src="<?php
                                                        if(file_exists('assets/admin/'.$reseller->photo)): 
                                                            echo base_url().'assets/admin/'.$reseller->photo;
                                                        endif; ?>" width="150">
                                                    </center>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Name</td>
                                                <td><?php echo $reseller->name; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Phone</td>
                                                <td><?php echo $reseller->phone; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Email</td>
                                                <td><?php echo $reseller->email; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Address</td>
                                                <td><?php echo $reseller->address; ?></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                                   
                        <form action="<?php echo site_url('change_passwords'); ?>" role="form" method="post" id="adminform"  class="form-horizontal">
			
                            <div class="form-group">
                                <label for="field-3" class="col-sm-3 control-label">Old Password</label>
                                <div class="col-sm-5">
                                    <input type="password" maxlength="12"  maxlength="6" name="old_password" class="form-control" id="old_password" placeholder="Type Old Password">
                                    <span id="old_password_error" style="color:red;display:none;">Old Password can't be Empty!</span>
                                </div>
                            </div>                            
                            <div class="form-group">
                                <label for="field-3" class="col-sm-3 control-label">New Password</label>
                                <div class="col-sm-5">
                                    <input type="password" maxlength="12"  maxlength="6" name="new_password" class="form-control" id="new_password" placeholder="Type New Password">
                                    <span id="new_password_error" style="color:red;display:none;">New Password can't be Empty!</span>
                                    <span id="password_matched" style="color:red;display:none;">Old Password and New Password can't be Same!</span>
                                </div>
                            </div>
                             
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-5">
                                    <button type="button" onclick="fomvalidation();"  class="btn btn-default">Submit</button>
                                </div>
                            </div>
                        </form>    
                        <script>
                            function fomvalidation() {
                                var patern = new RegExp(/^[-a-z0-9~!$%^&*_=+}{\'?]+(\.[-a-z0-9~!$%^&*_=+}{\'?]+)*@([a-z0-9_][-a-z0-9_]*(\.[-a-z0-9_]+)*\.(aero|arpa|biz|com|coop|edu|gov|info|int|mil|museum|name|net|org|pro|travel|mobi|[a-z][a-z])|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?$/i);

                                var old_password = $("#old_password").val();
                                var new_password = $("#new_password").val();

                                var old_password_conf = '';
                                var new_password_conf = '';

                                if (old_password == '') {
                                    $("#old_password_error").show();
                                    var old_password = false;
                                } else {
                                    $("#old_password_error").hide();
                                    var old_password = true;
                                }
                                
                                if (new_password == '') {
                                    $("#new_password_error").show();
                                    var new_password = false;
                                } else {
                                    $("#new_password_error").hide();
                                    var new_password = true;
                                }

                                if (old_password == true && new_password == true) {
                                    $("#adminform").submit();
                                } else {
                                    return false;
                                }

                            }
                        </script>                        

                    </div>
            </section>  
            <br><br><br>
            <?php $this->load->view('admin/footer'); ?> 
            </table>
        </div>
    </div>   

</body>
</html>


