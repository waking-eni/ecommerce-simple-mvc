<?php

session_status() === PHP_SESSION_ACTIVE ? TRUE : session_start();

if(isset($_POST['signup-submit'])) {
	require_once __DIR__.'/../controller/userController.php';
	require_once __DIR__.'/../model/user.php';

	$userController = new UserController();
	$userTable = new User();
	
	$userTable->username = str_replace(array(':', '-', '/', '*', '<', '>'), '', $_POST['uid']);
	$userTable->email = str_replace(array(':', '-', '/', '*', '<', '>'), '', $_POST['mail']);
    
	$password = str_replace(array(':', '-', '/', '*', '<', '>'), '', $_POST['pwd']);
    $passwordRepeat = str_replace(array(':', '-', '/', '*', '<', '>'), '', $_POST['pwdrepeat']);
	
	/*error handlers */

	if(empty($userTable->username) || empty($userTable->email) || empty($password) || empty($passwordRepeat) ) {
		header("Location: ../view/signUp.php?error=emptyfields&&uid=".$userTable->username."&mail=".$userTable->email);
		exit();
	}
	else if(!filter_var($userTable->email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $userTable->username)) {
		header("Location: ../view/signUp.php?error=invalidmailuid");
		exit();
	}
	//check for invalid email
	else if(!filter_var($userTable->email, FILTER_VALIDATE_EMAIL)) {
		header("Location: ../view/signUp.php?error=invalidmail&uid=".$userTable->username);
		exit();
	}
	//check for invalid username
	else if(!preg_match("/^[a-zA-Z0-9]*$/", $userTable->username)) {
		header("Location: ../view/signUp.php?error=invaliduid&mail=".$userTable->email);
		exit();
	}
	//are the two password fields matching
	else if($password !== $passwordRepeat) {
		header("Location: ../view/signUp.php?error=passwordcheck&uid=".$userTable->username."&mail=".$userTable->email);
		exit();
	}
	else {
		//does the chosen username already exist
		$resultCheck = $userController->checkUsername($userTable->username);
		if(!empty($resultCheck)) {
			header("Location: ../view/signUp.php?error=usertaken&mail=".$userTable->email);
			exit();
		} else {
			//insert
			$userTable->password = password_hash($password, PASSWORD_DEFAULT);
            //send values by reference because call_user_func_array expects it
            //$values = array(&$fullname, &$username, &$hashedPwd, &$email, &$phone, &$registerDate);
            $userController->insertUser($userTable);
            header("Location: ../view/loginUser.php?signup=success");
            exit();
		}
	}
		
} else {
	header("Location: ../view/signUp.php");
	exit();
}