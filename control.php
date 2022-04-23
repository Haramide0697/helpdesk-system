<?php
require 'core/connection.php';

if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH'])== 'xmlhttprequest'){

if (isset($_POST['fname'])) {
	$name = $_POST['fname'];
	if (empty($name)) {
		echo "<div style='color:#e6102e'><i class='fa fa-warning fa-5x'></i><p><b>Please input a name</b></p></div>";

	}else{

		$fetch = $conn->query("SELECT * FROM faculty WHERE name = '$name'");
		$result = $fetch->fetchAll(PDO::FETCH_OBJ);
		$count = $fetch->rowCount();
		if ($count > 0) {
		echo "<div style='color:#e6102e'><i class='fa fa-ban fa-5x'></i><p><b>You have added this faculty once </b></p></div>";
		}else{
		$in = array('name' => $name, );
		create('faculty',$in);
		echo "<div style='color:#169f85'><i class='fa fa-check-circle-o fa-5x'></i><p><b>You have successfully added $name</b></p></div>";

			
		}
		
	}
}

if (isset($_POST['dname'])) {
	$name = $_POST['dname'];
	$faculty = $_POST['faculty'];
	if (empty($name) || empty($faculty)) {
		echo "<div style='color:#e6102e'><i class='fa fa-warning fa-5x'></i><p><b>Please fill all empty fields</b></p></div>";

	}else{

		$fetch = $conn->query("SELECT * FROM department WHERE name = '$name'");
		$result = $fetch->fetchAll(PDO::FETCH_OBJ);
		$count = $fetch->rowCount();
		if ($count > 0) {
		echo "<div style='color:#e6102e'><i class='fa fa-ban fa-5x'></i><p><b>You have added this dapartment once </b></p></div>";
		}else{
		$in = array('name' => $name,
					'under' => $faculty, 

					);
		create('department',$in);
		echo "<div style='color:#169f85'><i class='fa fa-check-circle-o fa-5x'></i><p><b>You have successfully added $name</b></p></div>";

			
		}
		
	}
}


if (isset($_POST['cname'])) {
	$name = $_POST['cname'];
	$department = $_POST['department'];
	if (empty($name) || empty($department)) {
		echo "<div style='color:#e6102e'><i class='fa fa-warning fa-5x'></i><p><b>Please fill all empty fields</b></p></div>";

	}else{

		$fetch = $conn->query("SELECT * FROM course WHERE name = '$name'");
		$result = $fetch->fetchAll(PDO::FETCH_OBJ);
		$count = $fetch->rowCount();
		if ($count > 0) {
		echo "<div style='color:#e6102e'><i class='fa fa-ban fa-5x'></i><p><b>You have added this dapartment once </b></p></div>";
		}else{
		$in = array('name' => $name,
					'under' => $department, 

					);
		create('course',$in);
		echo "<div style='color:#169f85'><i class='fa fa-check-circle-o fa-5x'></i><p><b>You have successfully added $name</b></p></div>";

			
		}
		
	}
}


if (isset($_POST['lecturer'])) {
	$lecturer = $_POST['lecturer'];
	$olecturer = $_POST['olecturer'];
	$department = $_POST['department'];
	$password = sha1(md5("123456"));
	$cutlen = substr($olecturer, 0,1);
	
	$cutlen = "$olecturer.$cutlen";
	if (empty($lecturer) || empty($olecturer) || empty($department)) {
		echo "<div style='color:#e6102e'><i class='fa fa-warning fa-5x'></i><p><b>Please fill all empty fields</b></p></div>";

	}else{

		$fetch = $conn->query("SELECT * FROM lecturers WHERE sname = '$lecturer' AND oname = '$olecturer'");
		$result = $fetch->fetchAll(PDO::FETCH_OBJ);
		$count = $fetch->rowCount();
		if ($count > 0) {
		echo "<div style='color:#e6102e'><i class='fa fa-ban fa-5x'></i><p><b>You have added this dapartment once </b></p></div>";
		}else{
		$in = array('sname' => $lecturer,
					'oname' => $olecturer, 
					'dept' => $department, 

					);
		$in2 = array('username' => $cutlen,
					'password' => $password, 
					'priviledge' => 'lecturer', 
					);
		create('lecturers',$in);
		create('users',$in2);
		echo "<div style='color:#169f85'><i class='fa fa-check-circle-o fa-5x'></i><p><b>You have successfully added $lecturer $olecturer</b></p></div>";

			
		}
		
	}
}


if (isset($_POST['student'])) {
	$student = $_POST['student'];
	$ostudent = $_POST['ostudent'];
	$department = $_POST['department'];
	$matric = $_POST['matric'];
	$password = sha1(md5("123456"));
	$cutlen = substr($ostudent, 0,1);
	
	$cutlen = "$ostudent.$cutlen";
	if (empty($student) || empty($ostudent) || empty($department) || empty($matric)) {
		echo "<div style='color:#e6102e'><i class='fa fa-warning fa-5x'></i><p><b>Please fill all empty fields</b></p></div>";

	}else{

		$fetch = $conn->query("SELECT * FROM students WHERE sname = '$student' AND oname = '$ostudent'");
		$result = $fetch->fetchAll(PDO::FETCH_OBJ);
		$count = $fetch->rowCount();
		if ($count > 0) {
		echo "<div style='color:#e6102e'><i class='fa fa-ban fa-5x'></i><p><b>You have added this dapartment once </b></p></div>";
		}else{
		$in = array('sname' => $student,
					'oname' => $ostudent, 
					'matric' => $matric, 
					'dept' => $department, 

					);
		$in2 = array('username' => $matric,
					'password' => $password, 
					'priviledge' => 'student', 
					);
		create('students',$in);
		create('users',$in2);
		echo "<div style='color:#169f85'><i class='fa fa-check-circle-o fa-5x'></i><p><b>You have successfully added $student $ostudent</b></p></div>";

			
		}
		
	}
}

if (isset($_POST['staffname'])) {
	$name = $_POST['staffname'];
	$password = sha1(md5('123456'));
	if (empty($name)) {
		echo "<div style='color:#e6102e'><i class='fa fa-warning fa-5x'></i><p><b>Please enter a name</b></p></div>";

	}else{

		$fetch = $conn->query("SELECT * FROM users WHERE username = '$name'");
		$result = $fetch->fetchAll(PDO::FETCH_OBJ);
		$count = $fetch->rowCount();
		if ($count > 0) {
		echo "<div style='color:#e6102e'><i class='fa fa-ban fa-5x'></i><p><b>Name Already exist, please change</b></p></div>";
		}else{
		$in = array('username' => $name,
					'password' => $password, 
					'priviledge' => 'staff', 
					);
		create('users',$in);
		echo "<div style='color:#169f85'><i class='fa fa-check-circle-o fa-5x'></i><p><b>You have successfully added $name</b></p></div>";

			
		}
		
	}
}

if(isset($_POST['action']) && $_POST['action'] == 'delfaculty'){
		$id = $_POST['id'];
	
		$conn->query("DELETE FROM faculty WHERE id = $id");
		$conn->query("DELETE FROM department WHERE under = $id");
		echo "<div style='color:#169f85'><i class='fa fa-check-circle-o fa-5x'></i><p><b>Deleted</b></p></div>";		
	}

if(isset($_POST['action']) && $_POST['action'] == 'delstaff'){
		$id = $_POST['id'];
	
		$conn->query("DELETE FROM users WHERE id = $id");
		echo "<div style='color:#169f85'><i class='fa fa-check-circle-o fa-5x'></i><p><b>Deleted</b></p></div>";		
	}

if(isset($_POST['action']) && $_POST['action'] == 'geting'){
	$user = $_POST['id'];
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
                        echo $box;
						echo "$message";
						echo "$dates";	
						}
						}	
	}


if(isset($_POST['action']) && $_POST['action'] == 'deactivate'){
		$id = $_POST['id'];

		$in = array('priviledge' => 'deactivated', );

		update('users',$in,'id',$id);

		echo "<div style='color:#169f85'><i class='fa fa-check-circle-o fa-5x'></i><p><b>Deactivated</b></p></div>";		
	}

if(isset($_POST['action']) && $_POST['action'] == 'activate'){
		$id = $_POST['id'];

		$in = array('priviledge' => 'staff', );

		update('users',$in,'id',$id);

		echo "<div style='color:#169f85'><i class='fa fa-check-circle-o fa-5x'></i><p><b>Activated</b></p></div>";		
	}

if(isset($_POST['action']) && $_POST['action'] == 'deldepartment'){
		$id = $_POST['id'];
	
		$conn->query("DELETE FROM department WHERE id = $id");
		echo "<div style='color:#169f85'><i class='fa fa-check-circle-o fa-5x'></i><p><b>Deleted</b></p></div>";		
	}

if(isset($_POST['action']) && $_POST['action'] == 'refreshlect'){
		$id = $_POST['id'];
		$password = sha1(md5('123456'));
	
		$in = array('password' => $password, );

		update('users',$in,'id',$id);

		echo "<div style='color:#169f85'><i class='fa fa-check-circle-o fa-5x'></i><p><b>Password Reset Done</b></p></div>";			
	}

if(isset($_POST['action']) && $_POST['action'] == 'refreshstaff'){
		$id = $_POST['id'];
		$password = sha1(md5('123456'));
	
		$in = array('password' => $password, );

		update('users',$in,'id',$id);

		echo "<div style='color:#169f85'><i class='fa fa-check-circle-o fa-5x'></i><p><b>Password Reset Done</b></p></div>";			
	}
if(isset($_POST['action']) && $_POST['action'] == 'refreshstu'){
		$id = $_POST['id'];
		$password = sha1(md5('123456'));
	
		$in = array('password' => $password, );

		update('users',$in,'id',$id);

		echo "<div style='color:#169f85'><i class='fa fa-check-circle-o fa-5x'></i><p><b>Password Reset Done</b></p></div>";			
	}

if(isset($_POST['action']) && $_POST['action'] == 'delcourse'){
		$id = $_POST['id'];
	
		$conn->query("DELETE FROM course WHERE id = $id");
		echo "<div style='color:#169f85'><i class='fa fa-check-circle-o fa-5x'></i><p><b>Deleted</b></p></div>";		
	}

if(isset($_POST['action']) && $_POST['action'] == 'delbooks'){
		$id = $_POST['id'];
	
		$fetch = $conn->query("SELECT * FROM books WHERE id = $id");
		$result = $fetch->fetchAll(PDO::FETCH_OBJ);
		$count = $fetch->rowCount();
		if ($count > 0) {
		foreach ($result as $key) {
		$frontpage = $key->frontpage;
		$file = $key->file;
		}
			unlink("../books/image/$frontpage");
			unlink("../books/file/$file");
		 	$conn->query("DELETE FROM books WHERE id = $id");
		 	echo "<div style='color:#169f85'><i class='fa fa-check-circle-o fa-5x'></i><p><b>Deleted</b></p></div>";
		 }		
	}


if(isset($_POST['action']) && $_POST['action'] == 'dellect'){
		$id = $_POST['id'];
	
		$fetch = $conn->query("SELECT * FROM lecturers WHERE id = $id");
		$result = $fetch->fetchAll(PDO::FETCH_OBJ);
		$count = $fetch->rowCount();
		if ($count > 0) {
		foreach ($result as $key) {
		$sname = $key->sname;
		$oname = $key->oname;
		$cutlen = substr($oname, 0,1);
	
		$cutlen = "$oname.$cutlen";
		}
		 	$conn->query("DELETE FROM lecturers WHERE id = $id");
		 	$conn->query("DELETE FROM users WHERE username = '$cutlen'");
		 	echo "<div style='color:#169f85'><i class='fa fa-check-circle-o fa-5x'></i><p><b>Deleted</b></p></div>";
		 }		
	}


if(isset($_POST['action']) && $_POST['action'] == 'delstu'){
		$id = $_POST['id'];
	
		$fetch = $conn->query("SELECT * FROM students WHERE id = $id");
		$result = $fetch->fetchAll(PDO::FETCH_OBJ);
		$count = $fetch->rowCount();
		if ($count > 0) {
		foreach ($result as $key) {
		$matric = $key->matric;
			}
		 	$conn->query("DELETE FROM students WHERE id = $id");
		 	$conn->query("DELETE FROM users WHERE username = '$matric'");
		 	echo "<div style='color:#169f85'><i class='fa fa-check-circle-o fa-5x'></i><p><b>Deleted</b></p></div>";
		 }		
	}

if (isset($_POST['pname'])) {
    $pname = sanitize($_POST['pname']);
    $autor = sanitize($_POST['autor']);
    $desc = sanitize($_POST['desc']);
    $book = sanitize($_POST['book']);
    $course = sanitize($_POST['course']);
    $by = sanitize($_POST['by']);
    $pass = $_FILES['pass']['tmp_name'];
    $filess = $_FILES['filess']['tmp_name'];
    $date = date('l M d, Y H:i');

    if (empty($pname) || empty($autor) || empty($desc) || empty($book) || empty($pass) || empty($filess)) {
        echo "<div style='color:#e6102e'><i class='fa fa-warning fa-5x'></i><p><b>Please fill all empty fields</b></p></div>";
    }elseif ($book == "text" && empty($course)) {
    	echo "<div style='color:#e6102e'><i class='fa fa-warning fa-5x'></i><p><b>Please fill all empty fields</b></p></div>";
    }else{
       
        $temporary = explode("." , $_FILES [ "pass" ][ "name" ]);
        $temporary2 = explode("." , $_FILES [ "filess" ][ "name" ]);
        $file_extension = end ($temporary );
        $file_extension2 = end ($temporary2 );
        $pic = $_FILES['pass']['name'];
        $picp = $_FILES['pass']['tmp_name'];
        $pics = $_FILES['pass']['size'];

        $pic2 = $_FILES['filess']['name'];
        $picp2 = $_FILES['filess']['tmp_name'];
        $pics2 = $_FILES['filess']['size'];

        $rando = rand(00001,99999);
        $rando1 = rand(00001,99999);
        $hash = sha1($pic);
        $hash2 = sha1($pic2);
        $hash = $hash.$rando;
        $hash2 = $hash2.$rando1;

        $ext1 = pathinfo($pic, PATHINFO_EXTENSION);
        $ext1 = strtolower($ext1);

        $ext2 = pathinfo($pic2, PATHINFO_EXTENSION);
        $ext2 = strtolower($ext2);

        $upload_folder1 = "../books/image/".$hash.".".$ext1;
        $uploadpic = $hash.".".$ext1;

        $upload_folder2 = "../books/file/".$hash2.".".$ext2;
        $uploadpic2 = $hash2.".".$ext2;

        if ($book == "journal" || $book == "paper") {
        	$course = $book;
        }

        $in = array('name' => $pname,
                    'frontpage' => $uploadpic, 
                    'author' => $autor, 
                    'description' => $desc, 
                    'file' => $uploadpic2, 
                    'course' => $course, 
                    'by' => $by, 
                    'date' => $date, 
                );
        move_uploaded_file($picp, $upload_folder1);
        move_uploaded_file($picp2, $upload_folder2);
        create('books',$in);
        echo "<div style='color:#169f85'><i class='fa fa-check-circle-o fa-5x'></i><p><b>You have successfully added $pname</b></p></div>";

    }
    }

}
?>