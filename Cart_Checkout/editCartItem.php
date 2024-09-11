<!DOCTYPE html>
<?php session_start(); ?>
<html lang="en">
<head>
     <!-- Latest compiled and minified CSS -->
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">


    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

  
    <link rel ="stylesheet" href="css/style.css">
   
    

    <title>Edit Cart Item</title>
</head>
<body style="background: #f5f5f5">
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            
        </div>
    </nav>
    <div class="container">
        <div class="col-md-8"><!-- Products (Added shoes)  -->
            <div class="container-fluid">
                <h2 class="text-center"><b>Edit Size and Quantity</h2>
                <div class="container-fluid">
                    <?php
                        viewProduct($_GET['id']);
                    ?>
                </div>
                
                <div class="continueShop text-center">
                    <a href="../Catalog/catalog.php">Continue Shopping</a>
                </div>
                <br>
            </div> 
        </div>
        <div class="col-md-4"><!-- Summary  -->
            <aside>
                <h2><b>Product Description</b></h2>
                <form action="cartController.php" method="POST" enctype="multipart/form-data">
                <?php
                    viewSummary($_GET['id']);
                ?>
                <div class="row">
                        <button class="btn checkout-btn" type="submit" name="update_record">Save</button>
                    </div>
                    <br>
                    <div class="row">
                        <a href="index.php" class="btn checkout-btn">Cancel</a>
                    </div>
                </form>
            </aside>
        </div>
    </div>
    
    
</body>
</html>

<?php 
    
    function viewSummary($recno){

        include("includes/sqlconnection.php");
        $sql = "SELECT * FROM tbl_order WHERE orderID='$recno'";
        $result = $conn->query($sql);

        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $price = $row["price"];
                $price = number_format("$price", 2);
                echo '
                <input type="hidden" name="txtid" value="' . $row["orderID"] . '">
                <div class="row">
                    <h3 class="pull-right">' . $row["brand"] . '</h3>
                    <h4 class="col-md-1">Brand Name</h4>
                </div>
                <div class="row">
                    <h3 class="pull-right">' . $row["name"] . '</h3>
                    <h4 class="col-md-1">Product Name</h4>
                </div>
                <div class="row">
                    <h3 class="pull-right">' . $row["category"] . '\'s Shoes</h3>
                    <h4 class="col-md-1">Product Type</h4>
                </div>
                <div class="row">
                    <h3 class="pull-right">₱ ' . $price . '</h3>
                    <h4 class="col-md-1">Unit Price</h4>
                </div>
                <hr>
                
                    <div class="row">
                        <input class="pull-right col-md-3" type="number" id="size" name="size" min="1" value="' . $row["orderSize"] . '" style="height:30px; font-size:16px">
                        <h4 class="col-md-1"><b>Size</b></h4>
                    </div>
                    <div class="row">
                        <input class="pull-right col-md-3" type="number" id="quantity" name="quantity" min="1" value="' . $row["quantity"] . '" style="height:30px; font-size:16px">
                        <h4 class="col-md-1"><b>Quantity</b></h4>
                    </div>
                    <hr>
        ';
            }
        }
    }

    function viewProduct($recno){
        include("includes/sqlconnection.php");
        $sql = "SELECT * FROM tbl_order WHERE orderID='$recno'";
        $result = $conn->query($sql);

        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
               echo '
               <input type="hidden" name="txtid" value="' . $row["orderID"] . '">

            <div class="row">
                <div class="list-group">
                    <div class="list-group-item text-center">
                        <a href="#">
                            <img src="addedShoes/' . $row["pic"] . '" class="img-thumbnail text" style="height:600px; width:80%" data-target="#view" data-toggle="modal">
                        </a>
                        <div class="modal fade" id="view">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button class="close" data-dismiss="modal">&times;</button>
                                        <h2 class="modal-title">' . $row["name"] . '</h2>
                                    </div>
                                    <div class="modal-body">
                                        <img src="addedShoes/' . $row["pic"] . '" class="img-thumbnail" style="height:600px;">
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
               ';
            }
        }
    }
?>