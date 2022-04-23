<?php
require '../core/connection.php';

 if(isset($_POST['startapp'])){
    $username = sanitize($_POST['username']);
    $password = $_POST['password'];
    $hash = sha1(md5($password));

    if(empty($username) || empty($password)){
      $error = "All fields must be filled to login";
    }else{
      $verify = get_alias('admin','username',$username,'password',$hash);
      if($verify->rowCount() > 0){
        $fetch = $verify->fetchAll(PDO::FETCH_OBJ);
        foreach($fetch as $log){
          $id = $log->id;
          $user = $log->username;
          $encode_id = md5($id);
          session_start();
          $_SESSION['is_admin'] = $encode_id; 
          $_SESSION['username'] = $username; 
          $_SESSION['admin_id'] = $id; 

          redirect('main.php');
        }
      }else{
        $error = "Invalid login credentials. Try again";
      }
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>POLYHI | Admin Login </title>
    <link rel="icon" href="../img/core-img/vp.ico">
    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form method="post">
              <h1>Login</h1>
                    <?php 
                      if(isset($error)){ ?>
                        <div class="alert alert-danger">
                          <strong>ERROR: </strong> <?php echo $error; ?>
                        </div>
                      <?php
                      }
                    ?>
              <div>
                <input type="text" class="form-control" name="username" autocomplete="off" placeholder="Username" required="" />
              </div>
              <div>
                <input type="password" class="form-control" required name="password" placeholder="********" />
              </div>
              <div>
                <button class="btn btn-default submit" type="submit" name="startapp">Log in</button>
              </div>

              <div class="clearfix"></div>

              <div class="separator">

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-paw"></i> POLYHI</h1>
                  <p>©2019 All Rights Reserved</p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>
