<?php
require 'core/connection.php';

 if(isset($_POST['login'])){
    $username = sanitize($_POST['username']);

    if(empty($username)){
      $error = "Enter a name";
    }else{
    $rand = rand(0000,9999);
      $userid = "$username$rand"; 

     $in = array('userid' => $userid,
     			'name' => $username, 
 		);
     create('users',$in);
          session_start();
          $_SESSION['is_admin'] = $userid; 
          $_SESSION['username'] = $username; 

          redirect('main.php');
        }
      }
    if (isset($error)) {
    	echo "<script> alert('$error') </script>";
    }
?>
<!DOCTYPE html>
<html class="no-js">
    <head>
        <title>Intelligent Help Desk System</title>
		<meta name="description" content="Learning Management System">
		<meta name="keywords" content="CHMSC LMS,CHMSCLMS,CHMSC,LMS,CHMSCLMS.COMXA">
		<meta name="author" content="TOPE">
		<meta charset="UTF-8">
        <!-- Bootstrap -->
				<link href="admins/images/favicon.ico" rel="icon" type="image">
				<link href="admins/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen"/>
				<link href="admins/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen"/>
				<link href="admins/bootstrap/css/font-awesome.css" rel="stylesheet" media="screen"/>
				<link href="admins/bootstrap/css/my_style.css" rel="stylesheet" media="screen"/>
				<link href="admins/vendors/easypiechart/jquery.easy-pie-chart.css" rel="stylesheet" media="screen"/>
				<link href="admins/assets/styles.css" rel="stylesheet" media="screen"/>
				<!-- calendar css -->
				<link href="admins/vendors/fullcalendar/fullcalendar.css" rel="stylesheet" media="screen">
				<!-- index css -->
				<link href="admins/bootstrap/css/index.css" rel="stylesheet" media="screen"/>
				<!-- data table css -->
				<link href="admins/assets/DT_bootstrap.css" rel="stylesheet" media="screen"/>
				<!-- notification  -->
				<link href="admins/vendors/jGrowl/jquery.jgrowl.css" rel="stylesheet" media="screen"/>
				<!-- wysiwug  -->
				<link rel="stylesheet" type="text/css" href="admins/vendors/bootstrap-wysihtml5/src/bootstrap-wysihtml5.css"/>
		<script src="admins/vendors/jquery-1.9.1.min.js"></script>
        <script src="admins/vendors/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    </head>
<body id="login">
    <div class="container">
		<div class="row-fluid">
			<div class="span6"><div class="title_index">
								
								<div class="row-fluid">

						<div class="span12">
						
						</div>	
													
							</div>
				
				<div class="row-fluid">

						<div class="span12">
						<br>
								<div class="motto">
												<p>The Polytechnic Ibadan Intelligent Help Desk System (PolyHi)</p>
												<p>Excellence, Information and Communication</p>
								</div>		
						</div>		
				</div>
			</div>
		</div>
			<div class="span6">
				<div class="pull-right">
							<form id="login_form1" class="form-signin" method="post">
						<h3 class="form-signin-heading"><i class="icon-lock"></i> Start a conversation</h3>
						<input type="text" class="input-block-level" id="username" name="username" placeholder="Username" required>
						<button data-placement="right" title="Click Here to Sign In" id="signin" name="login" class="btn btn-info" type="submit"><i class="icon-signin icon-large"></i> Start</button>		
						</form>	
			</div>
		</div>
		</div>
    </div>
        <script src="admins/bootstrap/js/bootstrap.min.js"></script>
        <script src="admins/vendors/easypiechart/jquery.easy-pie-chart.js"></script>
        <script src="admins/assets/scripts.js"></script>
				<script>
				$(function() {
					// Easy pie charts
					$('.chart').easyPieChart({animate: 1000});
				});
				</script>
			<!-- data table -->
		<script src="admins/vendors/datatables/js/jquery.dataTables.min.js"></script>
        <script src="admins/assets/DT_bootstrap.js"></script>		
			<!-- jgrowl -->
		<script src="admins/vendors/jGrowl/jquery.jgrowl.js"></script>   
			<link href="admins/vendors/datepicker.css" rel="stylesheet" media="screen">
			<link href="admins/vendors/uniform.default.css" rel="stylesheet" media="screen">
			<link href="admins/vendors/chosen.min.css" rel="stylesheet" media="screen">
		<!--  -->
		<script src="admins/vendors/jquery.uniform.min.js"></script>
        <script src="admins/vendors/chosen.jquery.min.js"></script>
        <script src="admins/vendors/bootstrap-datepicker.js"></script>
		<!--  -->
			<script src="admins/vendors/bootstrap-wysihtml5/lib/js/wysihtml5-0.3.0.js"></script>
			<script src="admins/vendors/bootstrap-wysihtml5/src/bootstrap-wysihtml5.js"></script>
			<script src="admins/vendors/ckeditor/ckeditor.js"></script>
			<script src="admins/vendors/ckeditor/adapters/jquery.js"></script>
			<script type="text/javascript" src="admins/vendors/tinymce/js/tinymce/tinymce.min.js"></script>
		<!-- <script type="text/javascript" src="admins/assets/modernizr.custom.86080.js"></script> -->
		<script src="admins/assets/jquery.hoverdir.js"></script>
		<link rel="stylesheet" type="text/css" href="admins/assets//style.css" />
			<script type="text/javascript">
			$(function() {
				$('#da-thumbs > li').hoverdir();
			});
			</script>
			<script src="admins/vendors/fullcalendar/fullcalendar.js"></script>
			<script src="admins/vendors/fullcalendar/gcal.js"></script>
			<link href="admins/vendors/datepicker.css" rel="stylesheet" media="screen">
			<script src="admins/vendors/bootstrap-datepicker.js"></script>
						<script>
						$(function() {
							$(".datepicker").datepicker();
							$(".uniform_on").uniform();
							$(".chzn-select").chosen();
							$('#rootwizard .finish').click(function() {
								alert('Finished!, Starting over!');
								$('#rootwizard').find("a[href*='tab1']").trigger('click');
							});
						});
						</script>
</body>
</html>