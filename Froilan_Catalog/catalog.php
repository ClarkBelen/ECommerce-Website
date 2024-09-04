<!DOCTYPE html>
<?php 
	session_start();
	include('includes/sqlconnection.php');  

    $itemsPerPage = 9;
    $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($currentPage - 1) * $itemsPerPage;

    $categoryFilter = isset($_GET['category']) ? $_GET['category'] : '';
    $brandFilter = isset($_GET['brand']) ? $_GET['brand'] : '';
    $priceFilter = isset($_GET['price']) ? $_GET['price'] : '';

    // Fetch total count for pagination
    $totalResultsQuery = "SELECT COUNT(*) as total FROM catalog WHERE 1=1";
    if (!empty($categoryFilter)) {
        $totalResultsQuery .= " AND category = '$categoryFilter'";
    }
    if (!empty($brandFilter)) {
        $totalResultsQuery .= " AND brand = '$brandFilter'";
    }
    if (!empty($priceFilter)) {
        $priceParts = explode('-', $priceFilter);
        $minPrice = (int)$priceParts[0];
        $maxPrice = (isset($priceParts[1]) && $priceParts[1] !== '') ? (int)$priceParts[1] : PHP_INT_MAX;
        if ($maxPrice === PHP_INT_MAX) {
            $totalResultsQuery .= " AND price >= $minPrice";
        } else {
            $totalResultsQuery .= " AND price >= $minPrice AND price <= $maxPrice";
        }
    }
    $totalResultsResult = $conn->query($totalResultsQuery);
    if ($totalResultsResult) {
        $totalResultsRow = $totalResultsResult->fetch_assoc();
        $totalResults = $totalResultsRow['total'];
    } else {
        error_log("Error fetching total results: " . $conn->error);
        $totalResults = 0;
    }

    // Fetch items for current page
    $sql = "SELECT id, image, name, star, price, category, brand FROM catalog WHERE 1=1";
    if (!empty($categoryFilter)) {
        $sql .= " AND category = '$categoryFilter'";
    }
    if (!empty($brandFilter)) {
        $sql .= " AND brand = '$brandFilter'";
    }
    if (!empty($priceFilter)) {
        $priceParts = explode('-', $priceFilter);
        $minPrice = (int)$priceParts[0];
        $maxPrice = (isset($priceParts[1]) && $priceParts[1] !== '') ? (int)$priceParts[1] : PHP_INT_MAX;
        if ($maxPrice === PHP_INT_MAX) {
            $sql .= " AND price >= $minPrice";
        } else {
            $sql .= " AND price >= $minPrice AND price <= $maxPrice";
        }
    }
    if (!empty($_GET['search'])) {
        $search = $conn->real_escape_string($_GET['search']);
        $sql .= " AND name LIKE '%$search%'";
    }

    $sql .= " LIMIT $offset, $itemsPerPage";

    $result = $conn->query($sql);

    $totalPages = ceil($totalResults / $itemsPerPage);

    $categoryCounts = array();
    $categoryQuery = "SELECT category, COUNT(*) AS count FROM catalog GROUP BY category";
    $categoryResult = $conn->query($categoryQuery);
    if ($categoryResult->num_rows > 0) {
        while($categoryRow = $categoryResult->fetch_assoc()) {
            $categoryCounts[$categoryRow['category']] = $categoryRow['count'];
        }
    }

    $brandCounts = array();
    $brandQuery = "SELECT brand, COUNT(*) AS count FROM catalog GROUP BY brand";
    $brandResult = $conn->query($brandQuery);
    if ($brandResult->num_rows > 0) {
        while($brandRow = $brandResult->fetch_assoc()) {
            $brandCounts[$brandRow['brand']] = $brandRow['count'];
        }
    }

    $priceRanges = array(
        "0-3000" => "Under ₱3,000",
        "3000-6000" => "₱3,000 - ₱6,000",
        "6001-11999" => "₱6,001 - ₱11,999",
        "12000-" => "Over ₱12,000"
    );
?>
<html>
	<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Shop</title>

        <!-- Google Font -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&display=swap" rel="stylesheet">
        
        <!-- Css Styles -->
        <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
        <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
        <link rel="stylesheet" href="css/magnific-popup.css" type="text/css">
        <link rel="stylesheet" href="css/nice-select.css" type="text/css">
        <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
        <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
        <link rel="stylesheet" href="css/styles.css" type="text/css">

        <style>
            .product__quantity {
                display: flex;
                align-items: center;
                margin-top: 20px;
            }

            .qtybtn {
                background-color: #f5f5f5;
                border: 1px solid #ddd;
                width: 30px;
                height: 30px;
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
            }

            .quantity-input {
                width: 50px;
                text-align: center;
                border: 1px solid #ddd;
                height: 30px;
                margin: 0 -5px;
                display: inline-block;
                position: relative;
            }

            .quantity-label {
                margin-right: 10px;
                font-size: 14px;
            }

            .product__size {
                display: flex;
                align-items: center;
                margin-top: 15px;
            }

            .sizebtn {
                background-color: #f5f5f5;
                border: 1px solid #ddd;
                width: 30px;
                height: 30px;
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
            }

            .size-input {
                width: 50px;
                text-align: center;
                border: 1px solid #ddd;
                height: 30px;
                margin: 0 -5px;
                display: inline-block;
                position: relative;
            }

            
            .size-label {
                margin-right: 38px;
                font-size: 14px;
            }

            .add_cart {
                height: 30px;
                outline: none;
                border: none;
                background-color: crimson;
                color: white;
                border-radius: 10px;
                transition: all 0.5s;
                font-family: "Nunito", sans-serif;
                margin-top: 20px;
            }

            .add_cart:hover{
                background-color: rgb(119, 12, 33);
            }

        </style>
    </head>
    
    <body>
        <!-- Offcanvas Menu -->
        <div class="offcanvas-menu-overlay"></div>
        <div class="offcanvas-menu-wrapper">
            <div id="mobile-menu-wrap"></div>
        </div>

        <!-- Header -->
        <header class="header">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-3">
                        <div class="header__logo">
                            <a href="../Aubrey_Home/index.php"><img src="img/logo/logo.png" alt=""></a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <nav class="header__menu mobile-menu">
                            <ul>
                                <li><a href="../Aubrey_Home/index.php">Home</a></li>
                                <li class="active"><a href="#">Shop</a></li>
                                <li><a href="../Francine_About-Contact/about_us.php">About Us</a></li>
                                <li><a href="../Francine_About-Contact/contact_us.php">Contact Us</a></li>
                            </ul>
                        </nav>
                    </div>

                    <div class="col-lg-3 col-md-3">
                        <div class="header__nav__option">
                            <form class="d-flex">
                                <input class="px-2 search" type="search" placeholder="Search" aria-label="Search">
                                    <button class="btn1 me-3 px-3" type="submit">Search</button>
                                    <a href="../Clark_Cart-Checkout/index.php" class="cart-icon" data-toggle="tooltip" title="Your Cart">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                                            <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l1.313 7h8.17l1.313-7zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                                        </svg>
                                    </a>
                                    
                            </form>
                        </div>
                    </div>
                </div>
                <div class="canvas__open"><i class="fa fa-bars"></i></div>
            </div>
        </header>

        <!-- Breadcrumb Section Begin -->
        <section class="breadcrumb-option">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcrumb__text">
                            <h4>Shop</h4>
                            <div class="breadcrumb__links">
                                <a href="./index.html">Home</a>
                                <span>Shop</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Shop Section Begin -->
        <section class="shop spad">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="shop__sidebar">
                            <div class="shop__sidebar__search">
                                <form action="#" method="GET">
                                    <input type="text" name="search" placeholder="Search..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                                    <button type="submit"><span class="icon_search"></span></button>
                                </form>
                            </div>

                            <div class="shop__sidebar__accordion">
                                <div class="accordion" id="accordionExample">
                                    <div class="card">
                                        <div class="card-heading">
                                            <a data-toggle="collapse" data-target="#collapseOne">Categories</a>
                                        </div>
                                        <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                                            <div class="card-body">
                                                <div class="shop__sidebar__categories">
                                                    <ul>
                                                    <?php
                                                        foreach($categoryCounts as $category => $count) {
                                                            $activeClass = ($categoryFilter == $category) ? 'active' : '';
                                                            echo '<li><a href="?category=' . urlencode($category) . '" class="' . $activeClass . '">' . $category . ' (' . $count . ')</a></li>';
                                                        }
                                                    ?>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card">
                                        <div class="card-heading">
                                            <a data-toggle="collapse" data-target="#collapseTwo">Brand</a>
                                        </div>
                                        <div id="collapseTwo" class="collapse show" data-parent="#accordionExample">
                                            <div class="card-body">
                                                <div class="shop__sidebar__brand">
                                                    <ul>
                                                    <?php
                                                        foreach($brandCounts as $brand => $count) {
                                                            $activeClass = ($brandFilter == $brand) ? 'active' : '';
                                                                echo '<li><a href="?brand=' . urlencode($brand) . '" class="' . $activeClass . '">' . $brand . ' (' . $count . ')</a></li>';
                                                            }
                                                    ?>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card">
                                        <div class="card-heading">
                                            <a data-toggle="collapse" data-target="#collapseThree">Filter Price</a>
                                        </div>
                                        <div id="collapseThree" class="collapse show" data-parent="#accordionExample">
                                            <div class="card-body">
                                                <div class="shop__sidebar__price">
                                                    <ul>
                                                    <?php
                                                        foreach($priceRanges as $range => $label) {
                                                            $activeClass = ($priceFilter == $range) ? 'active' : '';
                                                            echo '<li><a href="?price=' . urlencode($range) . '" class="' . $activeClass . '">' . $label . '</a></li>';
                                                        }
                                                    ?>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-9">
                    <?php
                        $totalResults = $result->num_rows;

                        $startIndex = 1;
                        $endIndex = min($startIndex + $result->num_rows - 1, $totalResults);

                        echo '
                        <div class="shop__product__option">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="shop__product__option__left">
                                        <p>Showing ' . $startIndex . '-' . $endIndex . ' of ' . $totalResults . ' results</p>
                                    </div>
                                </div>
                            </div>
                        </div>';
                    ?>

                        <div class="row">
                            
                            <?php
                                if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                        echo '
                                        <div class="col-lg-4 col-md-6 col-sm-6">
                                            <div class="product__item">
                                                <div class="product__item__pic set-bg" data-setbg="uploads/' . $row["image"] . '">

                                                </div>
                                                <div class="product__item__text">
                                                    <h6>' . $row["name"] . '</h6>
                                                    <div class="rating">
                                                        ';
                                                        if ($row["star"] == 5) {
                                                            echo '
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>';
                                                        } else if ($row["star"] == 4) {
                                                            echo '
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star-o"></i>';
                                                        }

                                                        else if ($row["star"] == 3) {
                                                            echo '
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star-o"></i>
                                                                <i class="fa fa-star-o"></i>';
                                                        }

                                                        else if ($row["star"] == 2) {
                                                            echo '
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star-o"></i>
                                                                <i class="fa fa-star-o"></i>
                                                                <i class="fa fa-star-o"></i>';
                                                        }

                                                        else if ($row["star"] == 1) {
                                                            echo '
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star-o"></i>
                                                                <i class="fa fa-star-o"></i>
                                                                <i class="fa fa-star-o"></i>
                                                                <i class="fa fa-star-o"></i>';
                                                        }

                                                        else{
                                                            echo '
                                                            <i class="fa fa-star-o"></i>
                                                                <i class="fa fa-star-o"></i>
                                                                <i class="fa fa-star-o"></i>
                                                                <i class="fa fa-star-o"></i>
                                                                <i class="fa fa-star-o"></i>';
                                                        }
                                                    echo '
                                                    </div>
                                                    <h5>₱' . number_format($row["price"]) . '</h5>
                                                    <form action="../Clark_Cart-Checkout/cartController.php" method="POST" enctype="multipart/form-data">
                                                        <input type="hidden" name="txtid" value="' . $row["id"] . '">
                                                        <div class="product__size">
                                                            <label for="size" class="size-label">Size:</label>
                                                            <span class="dec sizebtn">-</span>
                                                                <input id="size" class="size-input" name="size" type="number" value="1" min="1">
                                                            <span class="inc sizebtn">+</span>
                                                        </div>
                                                        <div class="product__quantity">
                                                            <label for="quantity" class="quantity-label">Quantity:</label>
                                                            <span class="dec qtybtn">-</span>
                                                                <input id="quantity" class="quantity-input" name="quantity" type="number" value="1" min="1">
                                                            <span class="inc qtybtn">+</span>
                                                        </div>
                                                            <button class="add_cart pull-right" type="submit" name="addToCart">Add to Cart</button>       
                                                    </form>
                                                </div>
                                            </div>
                                        </div>';
                                    }
                                } else {
                                    echo '<p>No products found.</p>';
                                }
                                $conn->close();
                            ?>
                        </div>
                        
                        <!-- Pagination -->
                    <?php if ($totalPages > 1): ?>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="product__pagination">
                                    <?php
                                        $searchParam = '';
                                        if (!empty($_GET['search'])) {
                                            $searchParam = '&search=' . urlencode($_GET['search']);
                                        }

                                        for ($i = 1; $i <= $totalPages; $i++) {
                                            $activeClass = ($currentPage == $i) ? 'active' : '';
                                            echo '<a class="' . $activeClass . '" href="?page=' . $i . $searchParam . '">' . $i . '</a>';
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <section class="footer py-3">
            <div class="container">
                <div class="row text-center">
                    <div class="col-lg-6 m-auto">
                        <p>
                            <a href="https://github.com/aubs7/AppDevFinalProj.git">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="github-icon" viewBox="0 0 16 16">
                                    <path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27s1.36.09 2 .27c1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.01 8.01 0 0 0 16 8c0-4.42-3.58-8-8-8"/>
                                </svg>
                            </a>
                            Made by NEU 3BSCS-1 students
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <script src="js/jquery-3.3.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.nice-select.min.js"></script>
        <script src="js/jquery.nicescroll.min.js"></script>
        <script src="js/jquery.magnific-popup.min.js"></script>
        <script src="js/jquery.countdown.min.js"></script>
        <script src="js/jquery.slicknav.js"></script>
        <script src="js/mixitup.min.js"></script>
        <script src="js/owl.carousel.min.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>


<script>
    document.querySelectorAll('.set-bg').forEach(function(element) {
        var bg = element.getAttribute('data-setbg');
        element.style.backgroundImage = 'url(' + bg + ')';
    });

    document.querySelectorAll('.shop__sidebar__price a').forEach(function(element) {
        element.addEventListener('click', function(event) {
            event.preventDefault();
            var priceRange = this.getAttribute('href').replace('?price=', '');
            window.location.href = 'catalog.php?price=' + priceRange;
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.qtybtn').forEach(function(button) {
            button.addEventListener('click', function() {
                var input = this.parentElement.querySelector('.quantity-input');
                var currentValue = parseInt(input.value);
                if (this.classList.contains('inc')) {
                    input.value = currentValue + 1;
                } else if (this.classList.contains('dec')) {
                if (currentValue > 1) {
                    input.value = currentValue - 1;
                }
                }
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.sizebtn').forEach(function(button) {
            button.addEventListener('click', function() {
                var input = this.parentElement.querySelector('.size-input');
                var currentValue = parseInt(input.value);
                if (this.classList.contains('inc')) {
                    input.value = currentValue + 1;
                } else if (this.classList.contains('dec')) {
                if (currentValue > 1) {
                    input.value = currentValue - 1;
                }
                }
            });
        });
    });
</script>
