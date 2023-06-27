<?php 
session_start(); 
include "./config/koneksi.php";
//session check 

if (isset($_POST['uname']) && isset($_POST['password'])) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}
//mengembalikan jika inputan user kosong
	$uname = validate($_POST['uname']);
	$pass = validate($_POST['password']);

	if (empty($uname)) {
		header("Location: index.php?error=User Name is required");
	    exit();
	}else if(empty($pass)){
        header("Location: index.php?error=Password is required");
	    exit();
	}else{
		// hashing the password
        $pass = md5($pass);

        //mengambil nilai uname dan pass
		$sql = "SELECT * FROM users WHERE user_name='$uname' AND password='$pass'";

		$result = mysqli_query($koneksi, $sql);

		//cek apakah data ada dan juga validasi
		if (mysqli_num_rows($result) === 1) {
			$row = mysqli_fetch_assoc($result);
            if ($row['user_name'] == 'admin' && $row['id'] == 1) {

				//membuat session
            	$_SESSION['user_name'] = $row['user_name'];
            	$_SESSION['name'] = $row['name'];
            	$_SESSION['id'] = $row['id'];
            	header("Location: home_admin.php");
		        exit();

				// validasi user biasa 
            }else{
				$_SESSION['name'] = $row['name'];
            	$_SESSION['id'] = $row['id'];
				header("Location: home_user.php");
		        exit();
			}
		}else{
			header("Location: index.php?error=Incorect User name or password");
	        exit();
		}
	}
	
}else{
	header("Location: index.php");
	exit();
}