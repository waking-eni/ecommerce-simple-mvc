<?php
session_status() === PHP_SESSION_ACTIVE ? TRUE : session_start();
require_once __DIR__.'/../controller/productController.php';
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
            <div class="main-card row">

            <?php
                try {
                    $productController = new ProductController();
                    $categoryController = new CategoryController();
                } catch(Exception $e) {
                    echo 'Caught exception: '.$e->getMessage();
                }

                //pagination
                //get the current page number
                if (isset($_GET['page_no']) && $_GET['page_no']!="") {
                    $page_no = $_GET['page_no'];
                } else {
                    $page_no = 1;
                }

                //set total records per page, offset values etc
                $total_records_per_page = 10;
                $offset = ($page_no-1) * $total_records_per_page;
                $previous_page = $page_no - 1;
                $next_page = $page_no + 1;
                $adjacents = "2";
                $total_records = $categoryController->getNumberOfCategories();
                $total_no_of_pages = ceil($total_records / $total_records_per_page);
                $second_last = $total_no_of_pages - 1; //total pages minus 1

                $category = $_GET['category'];
                //list products by category
                if(!empty($category)) {
                    $productsByCategory = $productController->selectProductByCat($category, $offset, $total_records_per_page);
                    if(sizeof((array)$productsByCategory) > 0) {
                        foreach((array)$productsByCategory as $key => $value) {
                            echo '<div class="col-sm-6">';
                                echo '<div class="card">';
                                    echo '<img class="card-img-top" src="../images/products-small/'.$value['image'].
                                        '" alt="Product image">';
                                    echo '<div class="card-body">';
                                        echo '<h2 class="card-header"><a class="red-font" href="seeProduct.php?id='.$value['id'].'&name='.
                                            stripslashes($value['name']).'">'.stripslashes($value['name']).'</a></h2>';
                                        echo '<p class="card-text mt-1">'.stripslashes($value['price']).'</p>';
                                    echo '</div>';
                                echo '</div>';
                            echo '</div>';
                        }
                    } 
                }

            ?>

            <!--pagination-->
            <div class="navbar navbar-expand navbar-light 
                    d-flex justify-content-center fixed-bottom" style="background-color: #ECE8E9;">

                    <ul class="pagination navbar-nav">
                        <?php if($page_no > 1){
                        echo "<li><a href='?page_no=1'>First Page</a></li>";
                        } ?>
                            
                        <li class="page-item sr-only" <?php if($page_no <= 1){ echo "class='disabled'"; } ?>>
                            <a class="page-link" aria-label="Previous" <?php if($page_no > 1){
                            echo "href='?page_no=$previous_page'";
                            } ?>>Previous</a>
                        </li>

                        <li class="page-item  white-font">
                            Page <?php echo $page_no." of ".$total_no_of_pages; ?>
                        </li>
                            
                        <li class="page-item sr-only" <?php if($page_no >= $total_no_of_pages){
                        echo "class='disabled'";
                        } ?>>
                            <a class="page-link" aria-label="Next" <?php if($page_no < $total_no_of_pages) {
                            echo "href='?page_no=$next_page'";
                            } ?>>Next</a>
                        </li>
                        
                        <?php if($page_no < $total_no_of_pages){
                        echo "<li><a href='?page_no=$total_no_of_pages'>Last &rsaquo;&rsaquo;</a></li>";
                        } ?>
                    </ul>
                </div>
                <!--end of pagination-->

            </div>
        </main>
        <!--end of main-->
        <!-- MAIN END -->

    </div>
</div>
<!-- WRAPPER END -->

</body>

</html>