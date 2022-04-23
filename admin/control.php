<?php
require '../core/connection.php';

if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH'])== 'xmlhttprequest'){

if (isset($_POST[ "message" ])){
$file = $_FILES['file']['tmp_name'];
$message = $_POST['message'];

if (empty($message)) {
	echo "Write a text";
}elseif (empty($file)) {
	$random = rand(0000,9999);
	$in = array('regno' => $random,
			'answer' => $message,	
);
	create('registry',$in);
	echo "Registry Created";
}else{
$validextensions = array("jpeg" , "jpg" , "png" );
$temporary = explode("." , $_FILES [ "file" ][ "name" ]);
$file_extension = end ($temporary );
$pic = $_FILES['file']['name'];
$picp = $_FILES['file']['tmp_name'];
$pics = $_FILES['file']['size'];
list($width, $height, $types, $attr) = getimagesize($picp);


$hash = sha1($pic);
$random = rand(0000,9999);
$comb = $hash.$random;

$ext1 = pathinfo($pic, PATHINFO_EXTENSION);
$ext1 = strtolower($ext1);

$upload_folder1 = "../img/".$comb.".".$ext1;
$uploadpic = "img/".$comb.".".$ext1;;
$message = mysql_real_escape_string("<img src='$uploadpic' width='100px' height='110px'><br> $message");
	$random = rand(0000,9999);
	$in = array('regno' => $random,
			'answer' => $message,	
);
	move_uploaded_file($picp, $upload_folder1);
	create('registry',$in);
	echo "Registry Created";
}
}


if (isset($_POST[ "regno" ])){
$message = $_POST['message2'];
$regno = $_POST['regno'];
$words = explode(" ", $message);
$sound = " ";
foreach ($words as $word) {
	$sound.= metaphone($word)." ";
}

if (empty($message) || empty($regno)) {
	echo "Fill all fields";
}else{

	$in = array('question' => $message,
			'indexing' => $sound,	
			'answer' => $regno,	
);
	create('model',$in);
	echo "Registry Created";
}
}


	if(isset($_POST['action']) && $_POST['action'] == 'deletermes'){
		$id = $_POST['id'];

		 	$conn->query("DELETE FROM reply_pmessages WHERE id = $id");
		echo "Message Deleted";		
	}

	if(isset($_POST['action']) && $_POST['action'] == 'deletemes'){
		$id = $_POST['id'];

		 	$conn->query("DELETE FROM reply_messages WHERE id = $id");
		echo "Message Deleted";		
	}


		if(isset($_POST['identity2'])){
		$messageid = $_POST['identity2'];
		$message = $_POST['reply'];
		$date = date('l M d, Y H:i');
		if (empty($message)) {
			echo "Please type a  message";
		}else{

		$fetch = $conn->query("SELECT * FROM message WHERE id = $messageid");
		$result = $fetch->fetchAll(PDO::FETCH_OBJ);
		$count = $fetch->rowCount();
		if ($count > 0) {
		foreach ($result as $key) {
		$email = $key->email;
		}

			$in = array('message_id' => $messageid,
						'email' => $email,
						'message' => $message,
						'dates' => $date

			);

			create('reply_messages',$in);
			echo "Reply sent";
		}
		
		
		
	}
	}



		if(isset($_POST['identity1'])){
		$messageid = $_POST['identity1'];
		$property_id = $_POST['property_id'];
		$userid = $_POST['userid'];
		$file = $_FILES['reply']['tmp_name'];
		$date = date('l M d, Y H:i');
		if (empty($file)) {
			echo "Please input a file";
		}else{

		$temporary = explode("." , $_FILES [ "reply" ][ "name" ]);
		$file_extension = end ($temporary );
		$pic = $_FILES['reply']['name'];
		$picp = $_FILES['reply']['tmp_name'];
		$pics = $_FILES['reply']['size'];


		$hash = sha1($pic);
		$random = rand(000,999);
		$comb = $hash.$random;

		$ext1 = pathinfo($pic, PATHINFO_EXTENSION);
		$ext1 = strtolower($ext1);

		$upload_folder1 = "../user/files/".$comb.".".$ext1;
		$uploadpic = $comb.".".$ext1;

		$fetch = $conn->query("SELECT * FROM property_userdemand WHERE id = $messageid");
		$result = $fetch->fetchAll(PDO::FETCH_OBJ);
		$count = $fetch->rowCount();
		if ($count > 0) {
		foreach ($result as $key) {
		$name = $key->name;
		}

			$in = array('message_id' => $messageid,
						'userid' => $userid,
						'propertyid' => $property_id,
						'email' => $name,
						'message' => $uploadpic,
						'dates' => $date

			);
			$in2 = array('status' => "acquired", );
        	move_uploaded_file($picp, $upload_folder1);
			create('reply_userpmessages',$in);
			update('properties',$in2,'id',$property_id);
			echo "Reply/File sent";
		}
		
		
		
	}
	}

}
?>