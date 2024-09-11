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

    <script src="js/lightbox.js"></script>
  
    <link rel ="stylesheet" href="css/style.css">
    <link rel ="stylesheet" href="css/lightbox.css">
    

    <title>Order Receipt</title>
</head>
<body style="background: #f5f5f5">
<script type="text/javascript">
    $(window).on('load', function() {
        $('#receipt').modal('show');
    });
</script>
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            
        </div>
    </nav>
    <br>
    <div class="container">
        <div class="col-md-8"><!-- Products (Added shoes)  -->
            <div class="container-fluid">
                <div class="page-header">
                    <h2><b>Order Summary</b></h2>
                </div>
                <div class="row">
                <?php
                    include("includes/sqlconnection.php");
                    $sql = "SELECT * FROM tbl_order";
                    $result = $conn->query($sql);

                    if($result->num_rows > 0){
                        $orderName;
                        $category;
                        $orderSize;
                        $quantity;
                        $brand;
                        $orderID;
            
                            
                        $folder =  'addedShoes/';		
                        
                            while($row = $result->fetch_assoc()){
                                $orderName = "$row[name]";
                                $category = "$row[category]";
                                $orderSize = "$row[orderSize]";
                                $quantity = "$row[quantity]";
                                $brand = "$row[brand]";

                                $id = "$row[orderID]";

                                echo'
                                <div class="col-md-4">
                                    <a href="'.$folder.''.$row["pic"].'" data-lightbox="gallery" data-title="'.$row["brand"].' - '.$row["category"].'\'s Shoes" class="thumbnail" style="text-decoration:none; color:black; font-size:18px;">
                                        <img src="'.$folder.''.$row["pic"].'" style="height:260px; width:100%;">
                                        <p class="text-center" style="margin-top:15px;">'.$orderName.'</p>
                                        <h5 class="text-center">Size: <b>' . $row["orderSize"] . '</b>&nbsp;&nbsp;&nbsp;&nbsp;Quantity: <b>' . $row["quantity"] . ' pair/s</b></h5>
                                    </a>
                                    
                                    
                                </div>
                                ';
                        }
                        
                    }

                    ?>
                </div>
                
  
                <br>
                <br>
            </div>
        </div>
        <div class="col-md-4">
            <a href="#" data-target="#receipt" data-toggle="modal" style="text-decoration:none; color:black;">
            <div style="border: 1px solid black; padding:25px; padding-top:0px; margin-top:25px;"><!-- Summary  -->
                <aside>
                    <h3 style="border-bottom:3px dotted black; padding-bottom:10px;"><b>Order Receipt</b></h3>
                
                    <?php
                    viewOrderSummary();
                        
        
                    $firstName = $_POST['firstName'];
                    $lastName = $_POST['lastName'];
                    $address = $_POST['address'];
                    $email = $_POST['email'];
                    $phone = $_POST['phone'];
                    
                    $paymentMethod = $_POST['paymentMethod'];
                    $paymentSpecific="";

                    if(isset($_POST['eWallet'])){
                            $paymentSpecific="- ".$_POST['eWallet'];
                    }
                    if(isset($_POST['bank'])){
                            $paymentSpecific="- ".$_POST['bank'];
                    }

            
                    if(isset($_POST['del'])){

                        echo '
                        
                        <div class="row">
                            <h4 class="text-center"><mark><b><i>Deliver after '.$_POST["del"].' days</i></b></mark></h4>
                            <div class="clearfix"></div>
                        </div>
                        ';
                        }
                        if(isset($_POST['branch'])){
                            echo '
                            <div class="row">
                            <h4 class="text-center"><mark><b><i>Pick up from "'.$_POST["branch"].'" branch</i></b></mark></h4>
                            <div class="clearfix"></div>
                        </div>
                            ';
                        }

                        echo '
                        <div class="row text-center">
                            <h4 style="color:#770c21;">'.$firstName.' '.$lastName.'</h4>
                            <h4 style="border-top:1px solid black; padding-top:10px;"><b>Recipient\'s Name</b></h4>
                            <div class="clearfix"></div>
                        </div>
            
                        <div class="row text-center">
                                <h4 style="color:#770c21;">'.$address.'</h4>
                            <h4 style="border-top:1px solid black; padding-top:10px;"><b>Recipient\'s Address</b></h4>
                            <div class="clearfix"></div>
                        </div>

                        <div class="row text-center">
                                <h4 style="color:#770c21;">'.$phone.'</h4>
                            <h4 style="border-top:1px solid black; padding-top:10px;"><b>Recipient\'s Contact No.</b></h4>
                            <div class="clearfix"></div>
                        </div>

                        <div class="row text-center">
                                <h4 style="color:#770c21;">'.$email.'</h4>
                            <h4 style="border-top:1px solid black; padding-top:10px;"><b>Recipient\'s Email Add.</b></h4>
                            <div class="clearfix"></div>
                        </div>
                            <hr>
                        <div class="row text-center">
                                <h4 style="color:#770c21;">'.$paymentMethod.' '.$paymentSpecific.'</h4>
                            <h4 style="border-top:1px solid black; padding-top:10px;"><b>Payment Method</b></h4>
                            <div class="clearfix"></div>
                        </div>
                        ';

                        

                    ?>
                
                </aside>
            </div>
            </a>
            <br>
            <div class="col-md-10 col-md-offset-1">
                <form action="cartController.php" method="POST" enctype="multipart/form-data">
                    
                    <button class="btn checkout-btn" type="submit" name="delete_records">Confirm</button>
                </form>
            </div>
        </div>
       
        
        <div class="modal fade" id="receipt">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <div style="border: 1px solid black; padding:25px;"><!-- Summary  -->
                            <aside>
                                <h3 style="border-bottom:3px dotted black; padding-bottom:10px;"><b>Order Receipt</b></h3>
                            
                                <?php
                                viewOrderSummary();
                                    
                    
                                $firstName = $_POST['firstName'];
                                $lastName = $_POST['lastName'];
                                $address = $_POST['address'];
                                $email = $_POST['email'];
                                $phone = $_POST['phone'];
                                
                                $paymentMethod = $_POST['paymentMethod'];
                                $paymentSpecific="";

                                if(isset($_POST['eWallet'])){
                                        $paymentSpecific="- ".$_POST['eWallet'];
                                }
                                if(isset($_POST['bank'])){
                                        $paymentSpecific="- ".$_POST['bank'];
                                }

                        
                                if(isset($_POST['del'])){

                                    echo '
                                    
                                    <div class="row">
                                        <h4 class="text-center"><mark><b><i>Deliver after '.$_POST["del"].' days</i></b></mark></h4>
                                        <div class="clearfix"></div>
                                    </div>
                                    ';
                                    }
                                    if(isset($_POST['branch'])){
                                        echo '
                                        <div class="row">
                                        <h4 class="text-center"><mark><b><i>Pick up from "'.$_POST["branch"].'" branch</i></b></mark></h4>
                                        <div class="clearfix"></div>
                                    </div>
                                        ';
                                    }

                                    echo '
                                    <div class="row text-center">
                                        <h4 style="color:#770c21;">'.$firstName.' '.$lastName.'</h4>
                                        <h4 style="border-top:1px solid black; padding-top:10px;"><b>Recipient\'s Name</b></h4>
                                        <div class="clearfix"></div>
                                    </div>
                        
                                    <div class="row text-center">
                                            <h4 style="color:#770c21;">'.$address.'</h4>
                                        <h4 style="border-top:1px solid black; padding-top:10px;"><b>Recipient\'s Address</b></h4>
                                        <div class="clearfix"></div>
                                    </div>

                                    <div class="row text-center">
                                            <h4 style="color:#770c21;">'.$phone.'</h4>
                                        <h4 style="border-top:1px solid black; padding-top:10px;"><b>Recipient\'s Contact No.</b></h4>
                                        <div class="clearfix"></div>
                                    </div>

                                    <div class="row text-center">
                                            <h4 style="color:#770c21;">'.$email.'</h4>
                                        <h4 style="border-top:1px solid black; padding-top:10px;"><b>Recipient\'s Email Add.</b></h4>
                                        <div class="clearfix"></div>
                                    </div>
                                        <hr>
                                    <div class="row text-center">
                                            <h4 style="color:#770c21;">'.$paymentMethod.''.$paymentSpecific.'</h4>
                                        <h4 style="border-top:1px solid black; padding-top:10px;"><b>Payment Method</b></h4>
                                        <div class="clearfix"></div>
                                    </div>
                                    ';

                                    

                                ?>
                            
                            </aside>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <br>
</body>
</html>

<?php

function viewOrderSummary(){
    
    $discount=number_format(250.00, 2);
    $subtotal=0.00;
    $total=0.00;
    $overallQuantity=0;
    $shipping;

    include("includes/sqlconnection.php");
    $sql = "SELECT * FROM tbl_order order by orderID desc";
    $result = $conn->query($sql);

    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $price = $row["price"] * $row["quantity"];
            $overallQuantity += $row["quantity"];
            $subtotal+=$price;
            $total=$subtotal;
        }
    }

    if(isset($_POST['del'])){
        if($_POST['del']=="2-3"){
            $shippingfee = 350.00;
            $shipping = '+ ₱ ' . number_format($shippingfee, 2);
            $total += $shippingfee;
        }else{
            $shipping="free";
        }
    }else{
        $shipping="free";
    }
    
    
    

    $formattedSubtotal = number_format("$subtotal", 2);
    
    echo '
    <div class="row">
        <h4 class="pull-right">₱ ' . $formattedSubtotal . '</h4>
        <h4 class="col-md-1">Subtotal</h4>
    </div>
    <div class="row">
        <h4 class="pull-right" id="shipping" style="color:green;">' . $shipping . '</h4>
        <h4 class="col-md-1">Shipping</h4>
    </div>';

    if(isset($_POST['promo'])){
        $promoCode = trim($_POST['promo']);
        $promosql = "SELECT * FROM tbl_promo order by promoID desc";
        $promoresult = $conn->query($promosql);

        if($promoresult->num_rows > 0){
            while($promorow = $promoresult->fetch_assoc()){
                $promoCodeRow = trim($promorow['promoCode']);
                    
                if($promoCode == $promoCodeRow){
                    echo '
                    <div class="row">
                        <h4 class="pull-right" id="discount" style="color:red;">- ₱ ' . $discount . '</h4>
                        <h4 class="col-md-2">Discount</h4>
                    </div>
                    ';
                    $total-=$discount;
                    break;
                }
            }
        }
    }
    $formattedTotal = number_format("$total", 2);
    echo'
    <hr>
    <div class="row">
        <h4 class="pull-right" id="total"><b>₱ ' . $formattedTotal . '</b></h4>
        <h4 class="col-md-7"><b>Overall Total</b></h4>
    </div>
    <div class="row">
        <h4 class="pull-right" id="total"><b>' . $overallQuantity . ' pair/s</b></h4>
        <h4 class="col-md-7"><b>Overall Quantity</b></h4>
    </div>
    <hr>
    
    ';
}
?>