<?php
    require_once __DIR__.'/../../controller/categoryController.php';
?>

<nav class="col sidebar bg-light mt-0 py-0">

    <div class="sidebar-header">
        <h3 class="yellow-font">Navigation</h3>
    </div>

    <ul class="list-unstyled components">
        <li class="active">
            <!-- categories submenu -->
            <a href="#categoriesSubmenu" data-toggle="collapse" aria-expanded="false"  class="dropdown-toggle yellow-font">Categories</a>
            <ul class="collapse list-unstyled" id="categoriesSubmenu">

            <?php
                try {
                    $categoryCon = new CategoryController();
                    $categories = $categoryCon->fetchCategories();
                } catch(Exception $e) {
                    echo 'Caught exception: '.$e->getMessage();
                }

                //list all categories
                if($categories && !empty($categories)) {
                    foreach($categories as $key => $category) {
                        echo '<li class="yellow-font">';
                        echo '<a class="nav-link active" href="listByCategory.php?category='
                            .$category["name"].'">'.$category['name'].'</a>';
                        echo '</li>';
                    }
                }
            ?>

            </ul>

        </li>

</nav>