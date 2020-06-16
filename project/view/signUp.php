<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" 
    integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" 
    crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" 
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" 
    crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" 
    integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" 
    crossorigin="anonymous"></script>
    <!-- STYLE -->
    <link href="../css/style.css" rel="stylesheet" />
    <title>Online Library</title>
</head>

<body>

<!-- HEADER -->
<?php
    include 'includes/header.php';
?>
<!-- HEADER END -->

<!-- MAIN -->
<div class="wrapper">

<!-- WRAPPER -->
<div class="container-fluid wrapper-container">
    <div class="row row-wrapper mt-5">

        <!-- SIDEBAR -->
        <?php
            include 'includes/sidebar.php';
        ?>
        <!-- SIDEBAR END -->

        <!-- SIGN UP -->
        <main class="mainn col-9">

        <h1 class="text-center">Sign up</h1>

        <form class="center-div" name="signupForm" action="../inc.scripts/signup.inc.php" method="post" onsubmit="return(validate());">
            <div class="form-group">  
                <input class="form-control" type="text" name="uid" placeholder="Username">
                <p id="userName"></p>
                <input class="form-control" type="text" name="mail" placeholder="E-mail">
                <p id="userMail"></p>
                <input class="form-control" type="password" name="pwd" placeholder="Password">
                <small id="passwordHelpInline" class="text-muted">
                    Must be at least 5 characters long.
                </small>
                <p id="userPwdd"></p>
                <input class="form-control" type="password" name="pwdrepeat" placeholder="Repeat password">
                <p id="userPwddRep"></p>
                <button class="d-block my-3 btn btn-dark float-right" type="submit" name="signup-submit">Sign Up</button>
            </div>
        </form>

        </main>
        <!--SIGN UP END END-->

    </div>
</div>
<!-- WRAPPER END -->

</div>
<!-- MAIN END -->

<script>

// client side validation
function validate() {
    if(document.forms["signupForm"]["uid"].value == "") {
        document.getElementById("userName").innerHTML = "Please provide your Username";
        document.forms["signupForm"]["uid"].focus();
        return false;
    }
    if(document.forms["signupForm"]["mail"].value == "") {
        document.getElementById("userMail").innerHTML = "Please provide your E-mail";
        document.forms["loginForm"]["mail"].focus();
        return false;
    }
    if(document.forms["signupForm"]["pwd"].value == "") {
        document.getElementById("userPwdd").innerHTML = "Please provide your Password";
        document.forms["signupForm"]["pwd"].focus();
        return false;
    }
    if(document.forms["signupForm"]["pwd-repeat"].value == "") {
        document.getElementById("userPwddRep").innerHTML = "Please repeat your Password";
        document.forms["signupForm"]["pwd-repeat"].focus();
        return false;
    }
}

</script>
</body>

</html>