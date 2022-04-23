<!DOCTYPE html>
<html>
<head>
<?php
require('core/connection.php');
session_start();

  if(!logged_in()){
    redirect('index.php');
  }
  $sess_username = $_SESSION['username'];
  $sess_id = $_SESSION['is_admin'];

$datee = date('l M d, Y H:i');
$user = $sess_id;
$user_name = $sess_username;
if (isset($_POST['send'])) {
    $message = trim($_POST['message']);
    $message1 = str_replace(array('what', 'who', 'is', 'the', 'where', 'a ', 'current', 'name', 'of'),'', $message);
    $message2 = str_replace(array('poly', 'polyibadan', 'ibadan', 'poli'),'', $message1);

    $message1 = preg_replace('/ +/', ' ', $message1);
    $message1 = str_replace('/\s/','', $message1);

    $message2 = preg_replace('/ +/', ' ', $message2);
    $message2 = str_replace('/\s/','', $message2);
    
    if ($message2 == "") {
      $realmessage = $message1;
      if ($message1 == "") {
        $realmessage = $message;
      }
    }else{
       $realmessage = $message2;
    }
    $realmessage = trim($realmessage);
    if (empty($message)) {
        $error = "Please type a message";
    }else{
      echo "<script> alert('$realmessage') </script>";
        $select = $conn->query("SELECT * FROM model WHERE question = '$realmessage' LIMIT 1");
        $fetch = $select->fetchALL(PDO::FETCH_OBJ);
        $count = $select->rowCount();
        if ($count > 0) {
            foreach ($fetch as $key) {
                $model_id = $key->id;
                $answer = $key->answer;
                $iden1 = rand(0000,9999);

                $select2 = $conn->query("SELECT * FROM registry WHERE regno = '$answer' LIMIT 1");
                $fetch2 = $select2->fetchALL(PDO::FETCH_OBJ);
                $count2 = $select2->rowCount();
                if ($count2 > 0) {
                    foreach ($fetch2 as $value2) {
                        $answer = mysql_real_escape_string($value2->answer);
                    }
                }

                $in = array('user' => $user,
                            'iden' => $iden1, 
                            'by' => "machine", 
                            'message' => $answer, 
                            'model_id' => $model_id, 
                            'dates' => $datee, 
                 );

               $iden2 = rand(0000,9999);
                $in2 = array('user' => $user,
                            'iden' => $iden2,
                            'by' => "user", 
                            'message' => $message, 
                            'model_id' => $model_id, 
                            'dates' => $datee, 
                 );

                create('conversation',$in2);
                create('conversation',$in);

                redirect("main.php#$iden1");
            }
        }else{
            $index = metaphone($message);
        $select = $conn->query("SELECT * FROM model WHERE indexing LIKE '%$index%'LIMIT 1");
        $fetch = $select->fetchALL(PDO::FETCH_OBJ);
        $count = $select->rowCount();
        if ($count > 0) {
            foreach ($fetch as $key) {
                $model_id = $key->id;
                $answer = $key->answer;
                $questions = $key->question;

                $iden1 = rand(0000,9999);
                $select2 = $conn->query("SELECT * FROM registry WHERE regno = '$answer' LIMIT 1");
                $fetch2 = $select2->fetchALL(PDO::FETCH_OBJ);
                $count2 = $select2->rowCount();
                if ($count2 > 0) {
                    foreach ($fetch2 as $value2) {
                        $answer = mysql_real_escape_string($value2->answer);
                        $answer = "<b>Do you Mean <i>$questions </i></b> <br> $answer";
                    }
                }

                $in = array('user' => $user,
                            'iden' => $iden1, 
                            'by' => "machine", 
                            'message' => $answer, 
                            'model_id' => $model_id, 
                            'dates' => $datee, 
                 );

               $iden2 = rand(0000,9999);

                $in2 = array('user' => $user,
                            'iden' => $iden2,
                            'by' => "user", 
                            'message' => $message, 
                            'model_id' => $model_id, 
                            'dates' => $datee, 
                 );

                create('conversation',$in2);
                create('conversation',$in);
                redirect("main.php#$iden1");
            }
        }else{
            $model_id = "0";
            $answer = "PolyHi cannot provide a reply at the moment... Please try again later";

                $iden1 = rand(0000,9999);

                $in = array('user' => $user,
                            'iden' => $iden1, 
                            'by' => "machine", 
                            'message' => $answer, 
                            'model_id' => $model_id, 
                            'dates' => $datee, 
                 );

               $iden2 = rand(0000,9999);

                $in2 = array('user' => $user,
                            'iden' => $iden2,
                            'by' => "user", 
                            'message' => $message, 
                            'model_id' => $model_id, 
                            'dates' => $datee, 
                 );

                $in3 = array('userid' => $user,
                            'question' => $message,
                            'dates' => $datee, 
                 );

                create('conversation',$in2);
                create('void',$in3);
                create('conversation',$in);
                redirect("main.php#$iden1");
        }
        }
    }
}

?>
	 <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title  -->
   	<title>Polyhi</title>

    <!-- Favicon  -->
    <link rel="icon" href="img/core-img/vp.ico">

    <!-- Style CSS -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/bootstrap/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/body.css">
        <style type="text/css">
        body{
            background-image: url(admins/images/poly.jpg);
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
        }
        #message-body{ 
            border: 1px solid #ddd;
            min-height: 650px;
            max-height: 650px;
            border-radius: 5px;
            box-shadow: 0.2px 0px 7px #59abd4;
            margin-top: 1%;
            background: #fff;
        }
        #mhead{
            background: #234b61;
            min-height: 50px;
            margin-top: 10px;
        }
        #mbody{
            height: 450px;
            overflow: scroll;
            scroll-behavior: initial;
        }

        #mfooter{
            margin-top: 10px;
            border: 1px solid #ddd;
            border-radius: 20px;
            box-shadow: 0.2px 0px 7px #14445d;
            min-height: 100px;
        }
        .mtext{
            margin: 10px;
        }

        .box1{
            background: #d9edf7;
            max-width: 48%;
            min-height: 20%;
            border-radius: 5px;
            box-shadow: 0.2px 0px 5px #d9edf8;
        }
         .box2{
            background: white;
            margin-left: 50%;
            max-width: 48%;
            min-height: 20%;
            border-radius: 5px;
            box-shadow: 0.2px 0px 5px #d9edf8;
        }
        .btext{
            margin: 7px;
            text-align: justify;
            font-size: 18px;
        }
        #sendmessage{
            display: flex;
            margin: 20px;
        }
    </style>

    <script src="assets/js/jquery-2.1.4.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
	
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-2">
            
        </div>
        <div class="col-md-8" id="message-body">
           <div id="mhead">
               <h2 style="color: white;"><a href="logout.php"><i class="fa fa-arrow-left"></i></a> Intelligent System (PolyHi) User:<?php echo "$user_name"; ?></h2>
           </div>
           <div id="mbody">
               <div id="mtext">
                <?php
                $select = $conn->query("SELECT * FROM conversation WHERE user = '$user'");
                $fetch = $select->fetchALL(PDO::FETCH_OBJ);
                $count = $select->rowCount();
                if ($count > 0) {
                    foreach ($fetch as $value) {
                        $by = $value->by;
                        $iden1 = $value->iden;
                        $message = $value->message;
                        $dates = $value->dates;
                        if ($by == "user") {
                           $box = "box2";
                        }elseif ($by = "machine") {
                           $box = "box1";
                        }
                ?>

                    <div class="<?php echo $box; ?>" id="<?php echo $iden1; ?>">
                     <div class="btext">
                         <p><?php echo "$message"; ?></p>
                         <hr>
                         <small><?php echo "$dates"; ?></small>
                     </div> 
                  </div>
                  <br>

                <?php
                    }
                }else{
                ?>
                <div class="box1">
                     <div class="btext">
                         <p>Hello <?php echo "$user_name"; ?>, please write a message</p>
                         <hr>
                         <small><?php echo "$datee"; ?></small>
                     </div> 
                  </div>
                  <br>

                <?php
                }
                ?>
               </div>
           </div>
           <div id="mfooter">
              <form method="post">
                  <div id="sendmessage">
                      <div class="form-group">
                          <textarea class="form-control" name="message" rows="2" cols="100%"></textarea>
                      </div>
                      <div class="form-group">
                          <button class="btn btn-info" name="send">Send</button>
                      </div>
                  </div>
              </form>
           </div>
        </div>
        <div class="col-md-2">
            
        </div>
        
    </div>
</div>
<!-- ##### Footer Area End ##### -->
<div class="modal fade" id="error1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                     <div class="modal-dialog">
                    <div class="modal-content">
                     <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      </div>
                      <div class="modal-body">
                        <div class="alert alert-warning">
                          <?php
                          if (isset($error)) {
                           echo "$error"; 
                          }
                          ?>
                          
                        </div>
                     </div>
                     </div><!-- /.modal-content -->
                    </div><!-- /.modal -->
                </div>
 <div id="showtimer">
          
        </div>
    <!-- jQuery (Necessary for All JavaScript Plugins) -->
    <script src="js/jquery/jquery-2.2.4.min.js"></script>
    <!-- Popper js -->
    <script src="js/popper.min.js"></script>
    <!-- Bootstrap js -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Plugins js -->
    <script src="js/plugins.js"></script>
    <script src="js/classy-nav.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <!-- Active js -->
    <script src="js/active.js"></script>
   <!--  <script>

 window.onload = getTime;



        function getTime()
        {
            var today=new Date();
            var h=today.getHours();
            var m=today.getMinutes();
            var s=today.getSeconds();
            // add a zero in front of numbers<10
            m=checkTime(m);
            s=checkTime(s);
            document.getElementById('showtimer').innerHTML=h+":"+m+":"+s;
            t=setTimeout(function(){getTime()},500);
            var iden = "<?php echo $user ?>";
            var action = "geting";
            var dataString = "id="+iden+"&action="+action;
            var status = $("#status").val();
            var identity = $('#loading')+iden;

            $.ajax({
                type: "POST",
                url: "control.php",
                cache : false,
                data : dataString,
                beforeSend : function(){
                    $('#del'+iden).hide();
                    $('#loading'+iden).show();
                },
                success : function(response){
                    $('#loading'+iden).hide();
                    alert(response);
                }
            });
        }

        function checkTime(i)
        {
            if (i<10)
            {
                i="0" + i;
            }
            return i;
        }



    </script> -->
    </body>
</html>
<?php
if (isset($error)) {
echo "<script> alert('$error') </script>";
}
?>


                