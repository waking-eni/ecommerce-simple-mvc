<?php
session_status() === PHP_SESSION_ACTIVE ? TRUE : session_start();
require_once __DIR__.'/../controller/categoryController.php';
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

            <?php
                try {
                    $category = new CategoryController();
                } catch(Exception $e) {
                    echo 'Caught exception: '.$e->getMessage();
                }
                $categories = $category->fetchCategories();
            ?>

            <!--form for adding products-->
            <h1 class="text-center mt-5">New Product</h1>    
            <form enctype="multipart/form-data" class="center-divv" name="adminaddForm" action="../inc.scripts/adminaddpr.inc.php" method="post" onsubmit="return(validate());">
                <div class="form-group">
                    <label for="name">Name</label>    
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                    <p id="prname"></p>
                </div>
                <div class="form-group">
                    <label for="price">Price</label> 
                    <input type="text" class="form-control" id="price" name="price" placeholder="Price">
                    <p id="prprice"></p>
                </div>
                <div class="form-group">
                    <label for="category">Category</label>
                    <select id="category" name="category">
                        <?php 
                            if($categories && !empty($categories)) {
                                foreach($categories as $key => $category) {
                                    echo '<option>';
                                    echo $category["name"];
                                    echo '</option>';
                                }
                            }
                        ?>
                    </select>
                    <p id="prcategory"></p>
                </div>
                <div class="form-group">
                    <label for="quantity">Quantity</label> 
                    <input type="text" class="form-control" id="quantity" name="quantity" placeholder="Quantity">
                    <p id="prquantity"></p>
                </div>
                <div class="form-group">
                    <label for="chooseimg">Choose a preview picture</label>    
                    <input type="file" name="chooseimg" id="chooseimg" class="form-control">
                </div>
                <div class="form-group">
                    <label for="chooseimgl">Choose a full sized picture</label>    
                    <input type="file" name="chooseimgl" id="chooseimgl" class="form-control">
                </div>
                <div class="form-group">
                    <button class="d-block my-3 btn btn-dark float-right" type="submit" name="add-product">Add</button>
                </div>
            </form>

        </main>
        <!-- MAIN END -->

    </div>
</div>
<!-- WRAPPER END -->

</body>

</html>