<!-- NAVIGATION BAR -->
<nav class="navbar navbar-expand navbar-dark bg-dark">

    <ul class="navbar-nav  pl-0 ml-0 float-left">
        <!-- dropdown Join -->
        <li class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Join
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <?php
                    if(isset($_SESSION['userUsername']) || isset($_SESSION['adminUsername'])) {
                        echo '<a class="dropdown-item" href="../inc.scripts/logout.inc.php">Log Out</a>';
                    } else {
                        echo '<a class="dropdown-item" href="loginUser.php">User Log In</a>';
                        echo '<a class="dropdown-item" href="loginAdmin.php">Admin Log In</a>';
                        echo '<div class="dropdown-divider"></div>';
                        echo '<a class="dropdown-item" href="signUp.php">Sign Up</a>';
                    }
                ?>
            </div>
        </li>
    </ul>

    <!-- show the username of the person who is logged in, and manage button for admins -->
    <ul class="navbar-nav pl-0 ml-0 float-left">
        <?php
            if(isset($_SESSION['userUsername'])) {
                $userUsername = $_SESSION['userUsername'];
                echo '<li class="nav-item active white-font">'.$userUsername.'</li>';
            } else if(isset($_SESSION['adminUsername'])) {
                $adminUsername = $_SESSION['adminUsername'];
                echo '<li class="nav-item active btn"><a href="#" class="white-font">Manage</a></li>';
                echo '<li class="nav-item active white-font my-auto mx-1">'.$adminUsername.'</li>';
            } else {
                '<li class="nav-item active"></li>';
            }
        ?>
    </ul>

</nav>

<!-- JUMBOTRON -->
<div class="jumbotron jumbotron-fluid jumbotron-header mb-0 py-2">
    <div class="container">
        <h2 class="display-4 text-center"><a href="index.php" class="yellow-font">News Portal</a></h2>
    </div>
</div>

<script>
    //navbar brand animation
    document.getElementsByClassName("navbar-brand")[0].addEventListener('mouseover', function(){
        document.getElementsByClassName("navbar-brand")[0].classList.add('flip-brand');
        window.setTimeout(function(){
            document.getElementsByClassName("navbar-brand")[0].classList.remove('flip-brand')
        }, 500);
    });
</script>