<!DOCTYPE html>
<?php session_start(); ?>
<html lang="en">
<head>
     <!-- Latest compiled and minified CSS -->
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

     <!--bootstrap icon-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">   

    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&family=Righteous&display=swap"
    rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

  
    <link rel ="stylesheet" href="css/style.css">
   
    <style>
        
        .logo{
            margin-left: 50px;
            height: 125px;
            width: 100px;
            padding-bottom: 25px;
        }

        .nav li{
            list-style: none;
            margin-right: 25px;
        }

        .nav li a{
            margin-top:35px;
            color: white;
            text-decoration: none;
            color: white;
            font-size:16px;
            font-weight: 600;
            text-transform: uppercase;
            transition: all 0.5s;
            font-family: "Nunito", sans-serif;
        }
        .nav li a:hover{
            color:#dc143c;
            background:none;
            font-weight: 900;
        }

        
        .yourcart{
            margin-top:40px;
            font-weight:850;
            color:crimson;
            font-family: "Nunito", sans-serif;
        }

        .yourcart:hover{
            color: rgb(119, 12, 33);
        }

        .bi-cart{
            font-size: 30px;
            color: inherit;
            padding-top: 5px;
        }
        .burger{
            display: block;
            font-size: 22px;
            color: #111111;
            height: 35px;
            width: 35px;
            line-height: 35px;
            text-align: center;
            border: 1px solid #111111;
            border-radius: 2px;
            cursor: pointer;
            position: absolute;
            right: 30px;
            top: 25px;
        }
    </style>
    

    <title>Your Cart</title>
</head>
<body style="background: #f5f5f5">
    <div class="navbar navbar-fixed-top" style="background: #d3d3d3;  height: 120px;">
        <nav class="navbar navbar-fixed-top" style="background: #d3d3d3;">
            <div class="container">
                <div class="navbar-header" style="height:75px;">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="glyphicon glyphicon-menu-hamburger burger"></span>
                    </button>
                    <a class="navbar-brand" href="../Aubrey_Home/index.html">
                        <img src="../Aubrey_Home/img/logo.png" class="logo"
                        alt="Urban Soles logo" style="display: inline-block;">
                    </a>
                </div>
                <div class="pull-right">
                    <a href="#" style="text-decoration:none;">
                        <h2 class="yourcart">YOUR CART <i class="bi bi-cart"></i></h2>
                    </a>
                </div>
                <div class="collapse navbar-collapse text-center" id="myNavbar">
                    <ul class="nav navbar-nav" style="margin-left:175px;">
                        <li><a href="../Aubrey_Home/index.php">Home</a></li>
                        <li><a href="../Froilan_Catalog/catalog.php">Shop</a></li>
                        <li><a href="../Francine_About-Contact/about_us.php">About Us</a></li>
                        <li><a href="../Francine_About-Contact/contact_us.php">Contact Us</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    
    <br>
    <br>
    <div class="container" style="padding-top:125px">
        <div class="col-md-9"><!-- Products (Added shoes)  -->
            <div class="container-fluid">
                <h2><b>Your Added Shoes</b></h2>
                <div class="container-fluid">
                    <?php
                        viewAll();
                    ?>
                </div>
                
                <div class="continueShop text-center">
                    <a href="../Froilan_Catalog/catalog.php">Continue Shopping</a>
                </div>
                <br>
            </div> 
        </div>

        <div class="col-md-3"><!-- Summary  -->
            <aside>
                <h2><b>Summary</b></h2>
                <?php
                    viewSummary();
                ?>
            </aside>
        </div>
    </div>
    
    
</body>
</html>

<?php 
    

    function viewSummary(){
        $subtotal=0.00;
        $shipping="Free";
        $total=0.00;
        $isDisabled="";

        include("includes/sqlconnection.php");
        $sql = "SELECT * FROM tbl_order order by orderID desc";
        $result = $conn->query($sql);

        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $price = $row["price"] * $row["quantity"];
                $subtotal+=$price;
                $total=$subtotal;
            }
        }else{
            $subtotal=0;
            $shipping="";
            $total=0;
            $isDisabled="disabled";
        }
        $formattedSubtotal = number_format("$subtotal", 2);
        $formattedTotal = number_format("$total", 2);
        echo '
        <div class="row">
            <h4 class="pull-right">₱ ' . $formattedSubtotal . '</h4>
            <h4 class="col-md-1">Subtotal</h4>
        </div>
        <div class="row">
            <h4 class="pull-right">' . $shipping . '</h4>
            <h4 class="col-md-1">Shipping</h4>
        </div>
        <hr>
        <div class="row">
            <h4 class="pull-right"><b>₱ ' . $formattedTotal . '</b></h4>
            <h4 class="col-md-1"><b>Total</b></h4>
        </div>
        <hr>
        <div class="row">
            <a href="checkout.php" class="btn checkout-btn ' . $isDisabled . '" >Proceed to checkout</a>
        </div>
        ';
    }

    function viewAll(){
        include("includes/sqlconnection.php");
        $sql = "SELECT * FROM tbl_order order by orderID desc";
        $result = $conn->query($sql);

        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $unitPrice = number_format($row["price"],2);
                $price = $row["price"] * $row["quantity"];
                $price =  number_format("$price", 2);
               echo '
               <div class="row">
                <div class="list-group">
                <a href="editCartItem.php?id=' . $row["orderID"] . '">
                    <div class="list-group-item">
                        <a href="editCartItem.php?id=' . $row["orderID"] . '">
                            <div class="col-md-3" style="padding:0; margin:0;">
                                <img src="addedShoes/' . $row["pic"] . '" class="img-thumbnail">
                            </div>
                        </a>
                        <div class="col-md-9">
                            <div class="list-group-item-heading">
                            <div class="pull-right" style="font-size:16px">
                                <a href="editCartItem.php?id=' . $row["orderID"] . '" class="glyphicon glyphicon-edit" data-placement="top" data-toggle="tooltip" title="Edit" style="text-decoration: none; color: black;"></a>
                                <a href="cartController.php?id=' . $row["orderID"] . '&pic=' . $row["pic"] . '" class="glyphicon glyphicon-trash"  data-toggle="tooltip" data-placement="bottom" title="Delete" style="text-decoration: none; color: black; margin: 8px;"></a>
                            </div>
                            
                                <h3><a href="editCartItem.php?id=' . $row["orderID"] . '" style="text-decoration: none; color: black;">' . $row["name"] . '</a></h3>
                                <h4>' . $row["category"] . '\'s Shoes <span class="badge" style="margin-bottom:8px;">' . $row["brand"] . '</span></h4>
                                <h4 class="pull-right"><b>₱ ' . $price . '</b></h4>
                                
                                <h5>Size: <b>' . $row["orderSize"] . '</b>&nbsp;&nbsp;&nbsp;&nbsp;Quantity: <b>' . $row["quantity"] . ' pair/s</b></h5>
                                <br>
                                <h5><b>Unit Price: ₱ ' . $unitPrice . '</b></h5>
                                <br>
                                <div class="clearfix"></div>
                            </div>
                            
                            
                            
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
               ';
            }
        }else{
            echo '
                <div class="row">
                    <h2 class="text-center">You don\'t have any added orders yet.</h2>
                </div>
                <br>
                
            ';
           
        }
    }
?>