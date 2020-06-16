<?php
session_status() === PHP_SESSION_ACTIVE ? TRUE : session_start();
?>

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
    <title>News Portal</title>
</head>

<body>

<!-- HEADER -->
<?php
    include 'includes/header.php';
?>
<!-- HEADER END -->

<!-- WRAPPER -->
<div class="container-fluid wrapper-container">
    <div class="row row-wrapper mt-5">

        <!-- SIDEBAR -->
        <?php
            include 'includes/sidebar.php';
        ?>
        <!-- SIDEBAR END -->


        <!-- MAIN -->
        <main class="col-9 main">
            <div class="main-card row">

                <table class="table" id="productTable">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">NAME</th>
                            <th scope="col">QUANTITY</th>
                            <th scope="col">TOTAL</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php

                        $tot = 0;
                        if(isset($_SESSION['userUsername'])) {
                            if(isset($_SESSION['cart'])) {
                                $max = sizeof($_SESSION['cart']);
                                $array = $_SESSION['cart'];
                                if(array_key_exists(0, $array)) {
                                    for($i=0; $i<$max; $i++) {
                                        echo '<tr>';
                                            echo '<td>';
                                                echo $array[$i][0];
                                            echo '</td>';
                                            echo '<td>';
                                                echo $array[$i][1];
                                            echo '</td>';
                                            echo '<td>';
                                                echo $array[$i][2];
                                            echo '</td>';
                                            echo '<td>';
                                                echo $array[$i][3];
                                            echo '</td>';
                                        echo '</tr>';
                                        $GLOBALS['tot'] += $array[$i][3];
                                    }
                                } else {
                                    echo '<p>Your cart is empty.</p>';
                                }
                            } 
                        } 

                        ?>
                    </tbody>
                </table>

                <!--form with the remove button-->
                <hr>
                <div class="manage-class">
                    <form action="../inc.scripts/removefromcart.inc.php" method="post">
                        <button type="submit" name="prRemove" class="btn btn-danger btn-sm btn-block">
                            Remove</button>
                        <input type="hidden" name="prId" id="prId">
                    </form>
                </div>
                    

            </div>
            <!--end of main card-->

            <div class="align-self-stretch">
                <hr>
                <p class="float-right mr-5">Total: <?php echo $GLOBALS['tot']; ?></p>

                <br>
                <br>
                <a type="button" href="#" name="buy" class="btn btn-dark btn-lg float-right mr-0">
                    Buy</a>
            </div>
        </main>
        <!-- MAIN END -->

    </div>
</div>
<!-- WRAPPER END -->

<script>
    //get cell value when there is an onclick event
    //color effects on the table
    var table = document.getElementById("productTable");
        if (table != null) {
            if (table.rows[0] != null) {
                table.rows[0].style.backgroundColor = "#202020";
                table.rows[0].style.color = "#FFFFFF";
            }
            var flag = true;
            for (var i = 1; i < table.rows.length; i++) {
                table.rows[i].style.cursor = "pointer";
                table.rows[i].onmouseenter = function () { this.style.backgroundColor = "#f47676"; this.style.color = "#FFFFFF"; };
                table.rows[i].onmouseleave = function () { this.style.backgroundColor = ""; this.style.color = ""; };
                table.rows[i].onclick = function () {
                    if(flag == true) {
                        this.style.backgroundColor = "#d02537"; 
                        this.style.color = "#FFFFFF"; 
                        this.onmouseleave = null; 
                        this.onmouseenter = null;
                        var cell = this.cells[0].innerHTML;
                        getVal(cell);
                        flag = !flag; 
                    } else {
                        this.style.backgroundColor = ""; 
                        this.style.color = "";
                        flag = !flag; 
                    }
                };
            }
        }

        function getVal(cell) {
            document.getElementById("prId").value = cell;
        }
</script>

</body>

</html>