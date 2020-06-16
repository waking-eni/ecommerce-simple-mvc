<?php
    session_status() === PHP_SESSION_ACTIVE ? TRUE : session_start();
    require_once __DIR__.'/../controller/productController.php';
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

            <?php

            try {
                $productController = new ProductController();
            } catch(Exception $e) {
                echo 'Caught exception: '.$e->getMessage();
            }

            $idProduct = $_GET['id'];
            $product = $productController->selectProduct($idProduct);

            //show the book
            if(!empty($product)) {

                foreach($product as $key => $value) {

                    echo '<div class="col-sm-6">';
                        echo '<div class="card">';
                            echo '<img class="card-img-top" src="../images/products-small/'.$value['image'].
                                '" alt="Product image">';
                            echo '<div class="card-body">';
                                echo '<h2 class="card-text"><a class="text-muted h6" target="_blank" href="../images/products-original/'.$value['image_large'].
                                    '">Full sized image</a></h2>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';

                    echo '<div class="col-sm-6">';
                        echo '<div class="card">';
                            echo '<div class="card-body">';
                                echo '<h2 class="card-header">'.stripslashes($value['name']).'</h2>';
                                echo '<form id="productform" method="post" action="../includes/addtocart.inc.php" 
                                        oninput="totalview.value=parseInt(quantity.value)*'.stripslashes($value['price']).'" onchange="return(total());">';
                                    echo '<div class="form-row">';
                                        echo '<div class="col">';
                                            //category
                                            echo '<div class="md-form">';
                                                echo '<p>Category: '.stripslashes($value['category']).'</p>';
                                            echo '</div';
                                            //id
                                            echo '<div class="md-form">';
                                                echo '<p>Product code: '.stripslashes($value['id']).'</p>';
                                            echo '</div';
                                            //quantity
                                            echo '<div class="md-form">';
                                                echo '<label for:"quantity">Quantity: </label>';
                                                echo '<select id="quantity" name="quantity" size="1">';
                                                    for($i=1; $i<stripslashes($value['quantity']+1); $i++) {
                                                        echo '<option>'.$i.'</option>';
                                                    }
                                                echo '</select>';
                                            echo '</div';
                                            //price
                                            echo '<div class="md-form">';
                                                echo '<p>Price: '.stripslashes($value['price']).'</p>';
                                            echo '</div';
                                            //total
                                            echo '<div class="md-form">';
                                                echo '<label for:"totalview">Total: </label>';
                                                    echo '<output id="totalview" name="totalview" for="quantity price" form="productform">'.stripslashes($value['price']).'</output>';
                                            echo '</div';
                                            //submit
                                            echo '<div class="md-form">';
                                                echo '<button class="d-block my-3 btn btn-dark float-right" type="submit" name="addtocart">Add to Cart</button>';
                                                echo '<input type="hidden" id="total" name="total">';
                                            echo '</div';
                                            //hidden id input field
                                            echo '<input type="hidden" id="productId" name="productId" value="'.stripslashes($value['id']).'">';
                                        echo '</div>';
                                    echo '</div>';
                                echo '</form>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';

                    $_SESSION['prId'] = stripslashes($value['id']);
                    $_SESSION['prPrice'] = stripslashes($value['price']);
                    $_SESSION['prName'] = stripslashes($value['name']);
                }
            }

            ?>

            </div>

            <!--comments-->
            <?php
                include 'includes/comments.php';
            ?>
            <!--end of comments-->

        </main>
        <!-- MAIN END -->

    </div>
</div>
<!-- WRAPPER END -->

<script>
    //put output value in the hidden input field to send it to the script via post method (on submit)
    function total() {
        document.getElementById('total').value = document.getElementById('totalview').value;
    }

</script>

</body>

</html>