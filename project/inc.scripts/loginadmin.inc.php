<?php

session_status() === PHP_SESSION_ACTIVE ? TRUE : session_start();

//checking SHA-256 password
function checkPassword($password, $db_password) {
    $hashed = hash('sha256',$password);
    return ($hashed == $db_password) ? true : false;
}

if(isset($_POST['login-submit'])) {
    require_once __DIR__.'/../controller/adminController.php';
	
	$mailuid = str_replace(array(':', '-', '/', '*', '<', '>'), '', $_POST['mailuid']);
    $password = str_replace(array(':', '-', '/', '*', '<', '>'), '', $_POST['pwd']);
    
    $adminController = new AdminController();
	
	if(empty($mailuid) || empty($password))  {
		header("Location: ../view/loginAdmin.php?error=emptyfields&mailuid=".$mailuid."&mail=".$mailuid);
		exit();
	}
	else {
		$values = array(&$mailuid, &$mailuid);
		$result = $adminController->checkLogin($values);
        if(!empty($result)) {
            foreach((array)$result as $key => $value) {
                    /*I used SHA-256 for password encryption in MySQL for administrators*/ 
                    $pwdCheck = checkPassword($password, $value['password']);
                    if($pwdCheck == false) {
                        header("Location: ../view/loginAdmin.php?error=wrongpwd");
                        exit();
                    } else if($pwdCheck == true) {
                        $_SESSION['adminId'] = $value['id'];
                        $_SESSION['adminUsername'] = $value['username'];
                        
                        header("Location: ../view/index.php?login=succes");
                        exit();
                    }
            }
        } else {
            header("Location: ../view/loginAdmin.php?error=nouser");
            exit();
        }
	}
	
} else {
	header("Location: ../public/loginAdmin.php");
	exit();
}