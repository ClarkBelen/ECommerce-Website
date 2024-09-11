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

        #mainNav li{
            list-style: none;
            margin-right: 25px;
        }

        #mainNav li a{
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
        #mainNav li a:hover{
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
        <nav class="navbar navbar-fixed-top" style="background: #d3d3d3;" id="mainNav">
            <div class="container">
                <div class="navbar-header" style="height:75px;">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="glyphicon glyphicon-menu-hamburger burger"></span>
                    </button>
                    <a class="navbar-brand" href="../index.php">
                        <img src="../img/logo.png" class="logo"
                        alt="Urban Soles logo" style="display: inline-block;">
                    </a>
                </div>
                <div class="pull-right">
                    <a href="index.php" style="text-decoration:none;">
                        <h2 class="yourcart">YOUR CART <i class="bi bi-cart"></i></h2>
                    </a>
                </div>
                <div class="collapse navbar-collapse text-center" id="myNavbar">
                    <ul class="nav navbar-nav" style="margin-left:175px;">
                        <li><a href="../index.php">Home</a></li>
                        <li><a href="../Catalog/catalog.php">Shop</a></li>
                        <li><a href="../About_Contact/about_us.php">About Us</a></li>
                        <li><a href="../About_Contact/contact_us.php">Contact Us</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <br>
    <div class="container">
        <div class="col-md-9" style="padding-top:115px"><!-- Products (Added shoes)  -->
            <div class="container-fluid">
                <div class="page-header">
                    <h2><b>Shipping Method</b></h2>
                </div>
                <div class="row">
                    <ul class="nav nav-pills text-center">
                        <li class="active col-md-6" style="padding-left:12px;margin:0px;"><a href="#s1" data-toggle="pill" style="margin:0px;"><h4><span class="glyphicon glyphicon-inbox"></span>  Delivery</h4></a></li>
                        <li class="col-md-6" style="padding-right:40px;margin:0px;"><a href="#s2" data-toggle="pill"><h4><span class="glyphicon glyphicon-map-marker"></span> Pick Up</h4></a></li>
                    </ul>
                </div>
                <div class="tab-content">
                    
                    <!-- DELIVERY -->
                    <div class="tab-pane fade in active" id="s1">
                        <form class="form-horizontal" id="delForm" action="receipt.php" method="POST" enctype="multipart/form-data">
                            <br>
                            <h3 class="text-center">When would you like to get your order?</h3>
                            <div class="form-group text-center">
                                <div class="radio" style="font-size:18px;">
                                    <input class="form-check-input" type="radio" name="del" id="sd" value="4-7" onclick="standardDel()" checked>
                                    <label class="form-check-label" for="sd">4-7 days from today (Standard Delivery) Free</label>
                                    
                                </div>
                                <div class="radio" style="font-size:18px;">
                                    <input class="form-check-input" type="radio" name="del" id="fd" value="2-3" onclick="fastDel()">
                                    <label class="form-check-label" for="fd">2-3 days from today (Fast Delivery) + ₱350.00</label>
                                </div>
                                <br>
                            </div>

                            <?php
                                viewBilling();
                            ?>
                            <br>
                            <div class="container">
                                <h4 class="col-md-offset-1"><b>How would you like to pay?</b></h4>
                                <div id="deliverPaymentSelection">
                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-1">
                                            <select class="form-control" id="deliverPaymentMethod" name="paymentMethod" required style="height:50px; font-size:15px;">
                                                <option value="" selected disabled hidden>Select payment method</option>
                                                <option value="Cash">Cash on Delivery</option>
                                                <option value="E-wallet">E-Wallet</option>
                                                <option value="Bank">Bank Credit or Debit</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            
                                <?php
                                    $ewalletID="ewalletFormGroup";
                                    $bankID="bankFormGroup";
                                    paymentMethod($ewalletID, $bankID);
                                ?>
                            </div>
                            <hr>
                            <div class="container-fluid">
                                <div class="cancelOrder text-center">
                                    <a href="index.php" class="col-md-5 col-md-offset-1">Cancel</a>
                                </div>
                                <div class="placeOrder text-center">
                                    <button type="submit" class="col-md-5" name="place_orderDel">Place Order</button>
                                </div>
                            </div>                            
                        </form>
                    </div>

                    <!-- PICKUP -->
                    <div class="tab-pane fade" id="s2">
                        <form class="form-horizontal" id="pickupForm" action="receipt.php" method="POST" enctype="multipart/form-data">
                            <br>
                            <h3 class="text-center">Where would you like to get your order?</h3>
                            <div class="form-group text-center">
                                <div class="col-md-6 col-md-offset-3">
                                    <select class="form-control" type="text" name="branch" required style="height:50px; font-size:15px;">
                                        <option value="" selected disabled hidden>Select pickup branch</option>
                                        <?php
                                            branchSelect();
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <?php
                                viewBilling();
                            ?>
                            <div class="container">
                                <h4 class="col-md-offset-1"><b>How would you like to pay?</b></h4>
                                <div id="pickupPaymentSelection">
                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-1">
                                            <select class="form-control" id="pickupPaymentMethod" name="paymentMethod" required style="height:50px; font-size:15px;">
                                                <option value="" selected disabled hidden>Select payment method</option>
                                                <option value="E-wallet">E-Wallet</option>
                                                <option value="Bank">Bank Credit or Debit</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <?php
                                    $ewalletID="ewalletFormGroupP";
                                    $bankID="bankFormGroupP";
                                    paymentMethod($ewalletID, $bankID);
                                ?>
                            </div>
                            
                            <hr>
                            <div class="container-fluid">
                                <div class="cancelOrder text-center">
                                    <a href="index.php" class="col-md-5 col-md-offset-1">Cancel</a>
                                </div>
                                <div class="placeOrder text-center">
                                    <button type="submit"  class="col-md-5"  name="place_orderPick">Place Order</button>
                                </div>
                            </div>                                
                        </form>
                    </div>
                </div>
                <br>
                <br>
            </div>
        </div>
        <div class="col-md-3" style="padding-top:125px"><!-- Summary  -->
            <aside>
                <h3><b>Added Orders</b></h3>
                <?php
                   viewOrderSummary();
                    
                    viewSummary();
                ?>
               
                
            </aside>
        </div>
    </div>
    <script>
        
        document.addEventListener('DOMContentLoaded', function() {
            // Deliver Payment Method Change
            document.getElementById('deliverPaymentMethod').addEventListener('change', function() {
                var selectedOption = this.value;
                var ewalletFormGroup = document.getElementById('ewalletFormGroup');
                var bankFormGroup = document.getElementById('bankFormGroup');
                var ewalletFields = ewalletFormGroup.querySelectorAll('input, select');
                var bankFields = bankFormGroup.querySelectorAll('input, select');

                // Hide all groups
                ewalletFormGroup.style.display = 'none';
                bankFormGroup.style.display = 'none';

                // Remove required attribute from all fields
                ewalletFields.forEach(function(field) { field.required = false; });
                bankFields.forEach(function(field) { field.required = false; });

                // Show the selected group and set required attributes
                if (selectedOption === 'E-wallet') {
                    ewalletFormGroup.style.display = 'block';
                    ewalletFields.forEach(function(field) { field.required = true; });
                } else if (selectedOption === 'Bank') {
                    bankFormGroup.style.display = 'block';
                    bankFields.forEach(function(field) { field.required = true; });
                }
            });

            // Pickup Payment Method Change
            document.getElementById('pickupPaymentMethod').addEventListener('change', function() {
                var selectedOption = this.value;
                var ewalletFormGroupP = document.getElementById('ewalletFormGroupP');
                var bankFormGroupP = document.getElementById('bankFormGroupP');
                var ewalletFieldsP = ewalletFormGroupP.querySelectorAll('input, select');
                var bankFieldsP = bankFormGroupP.querySelectorAll('input, select');

                // Hide all groups
                ewalletFormGroupP.style.display = 'none';
                bankFormGroupP.style.display = 'none';

                // Remove required attribute from all fields
                ewalletFieldsP.forEach(function(field) { field.required = false; });
                bankFieldsP.forEach(function(field) { field.required = false; });

                // Show the selected group and set required attributes
                if (selectedOption === 'E-wallet') {
                    ewalletFormGroupP.style.display = 'block';
                    ewalletFieldsP.forEach(function(field) { field.required = true; });
                } else if (selectedOption === 'Bank') {
                    bankFormGroupP.style.display = 'block';
                    bankFieldsP.forEach(function(field) { field.required = true; });
                }
            });

            // Trigger change event on page load to set initial state
            document.getElementById('deliverPaymentMethod').dispatchEvent(new Event('change'));
            document.getElementById('pickupPaymentMethod').dispatchEvent(new Event('change'));
        });
    </script>
</body>
</html>




<?php 
    function viewBilling(){
        echo '
        <div class="page-header">
            <h2><b>Billing</b></h2>
        </div>
        <div class="container">
            <h4 class="col-md-offset-1"><b>Enter your name and address:</b></h4>
            <div class="form-group">
                <div class="col-md-6 col-md-offset-1">
                    <input type="text" class="form-control" placeholder="First Name" id="firstName" name="firstName" required style="height:50px; font-size:15px;">
                </div>            
            </div>
            <div class="form-group">
                <div class="col-md-6 col-md-offset-1">
                    <input type="text" class="form-control" placeholder="Last Name" id="lastName" name="lastName" required style="height:50px; font-size:15px;">
                </div>            
            </div>
            <div class="form-group">
                <div class="col-md-6 col-md-offset-1">
                    <input type="text" class="form-control" placeholder="Address" id="address" name="address" required style="height:50px; font-size:15px;">
                </div>            
            </div>
            <br>
            <h4 class="col-md-offset-1"><b>What\'s your contact information?</b></h4>
            <div class="form-group">
                <div class="col-md-6 col-md-offset-1">
                    <input type="email" class="form-control" placeholder="Email" id="email" name="email" required style="height:50px; font-size:15px;">
                </div>            
            </div>
            <div class="form-group">
                <div class="col-md-6 col-md-offset-1">
                    <input type="tel" class="form-control" placeholder="Phone Number" pattern="[0-9]{11}" id="phone" name="phone" required style="height:50px; font-size:15px;">
                </div>            
            </div>
            <div class="form-group">
                <div class="col-md-6 col-md-offset-1">
                    <div class="checkbox">
                        <label class="checkbox-inline"><input type="checkbox" style="transform: scale(1.3);" required>I have read and consent to Urban Soles processing my information in accordance with the Privacy Statement and Cookie Policy.</label>
                    </div>
                </div>            
            </div>
        </div>
        
        <div class="page-header">
            <h2><b>Payment</b></h2>
        </div>
        <div class="container">
            <h4 class="col-md-offset-1"><b>Do you have a promo code?</b> (optional)</h4>
            <div class="form-group">
                <div class="col-md-6 col-md-offset-1">
                    <input type="text" class="form-control" placeholder="Enter Promo Code" id="promo" name="promo" style="height:50px; font-size:15px;">
                </div>            
            </div>
        </div>
        <br>
        ';
    }

    function branchSelect(){
        include("includes/sqlconnection.php");
        $sql = "SELECT * FROM tbl_branches order by branchID desc";
        $result = $conn->query($sql);

        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                echo '
                        <option>' . $row["branch"] . '</option>
                    ';
            }
            
        }
    }

    function paymentMethod($ewalletID, $bankID){
        

        echo '
        <div id=' . $ewalletID . ' style="display:none;">
            <div class="form-group">
                <div class="col-md-6 col-md-offset-1">
                    <select class="form-control" type="text" name="eWallet" required style="height:50px; font-size:15px;">
                        <option value="" selected disabled hidden>Choose an E-Wallet</option>';

                        include("includes/sqlconnection.php");
                        $sql = "SELECT * FROM tbl_epayment order by eID desc";
                        $result = $conn->query($sql);

                        if($result->num_rows > 0){
                            while($row = $result->fetch_assoc()){
                                echo'
                                    <option>'.$row["ewallet"].'</option>
                                ';

                            }
                        }
                        
                        echo '
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-6 col-md-offset-1">
                    <input type="text" class="form-control" placeholder="Account Name" id="accName" name="accName" required style="height:50px; font-size:15px;">
                </div>            
            </div>
            <div class="form-group">
                <div class="col-md-6 col-md-offset-1">
                    <input type="tel" class="form-control" placeholder="Account ID or Number" pattern="[0-9]{11}" id="accID" name="accID" required style="height:50px; font-size:15px;">
                </div>            
            </div>
        </div>
       
        <div id=' . $bankID . ' style="display:none;">
            <div class="form-group">
                <div class="col-md-6 col-md-offset-1">
                    <select class="form-control" type="text" name="bank" required style="height:50px; font-size:15px;">
                        <option value="" selected disabled hidden>Choose a bank account</option>';
                        
                        include("includes/sqlconnection.php");
                        $sql = "SELECT * FROM tbl_bankpayment order by bankID desc";
                        $result = $conn->query($sql);

                        if($result->num_rows > 0){
                            while($row = $result->fetch_assoc()){
                                echo'
                                    <option>'.$row["bankName"].'</option>
                                ';

                            }
                        }
                    
                        echo '</select>
                </div>
            </div>
            <br>
            <h4 class="col-md-offset-1"><b>Enter your payment details: </b></h4>
            <div class="form-group">
                <div class="col-md-6 col-md-offset-1">
                    <input type="text" class="form-control" placeholder="Card Name" id="cardName" required name="cardName" style="height:50px; font-size:15px;">
                </div>            
            </div>
            <div class="form-group">
                <div class="col-md-6 col-md-offset-1">
                    <input type="number" class="form-control" placeholder="Account Number" required id="accNumber" name="accNumber" style="height:50px; font-size:15px;">
                </div>            
            </div>
            <div class="form-group">
                <div class="col-md-3 col-md-offset-1">
                    <input type="text" class="form-control" placeholder="MM/YY" id="exp" name="exp" required pattern="[0-1]{1}[0-2]{1}/[2-9]{1}[4-9]{1}" style="height:50px; font-size:15px; ">
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" placeholder="CVV" id="cvv" name="cvv" required pattern="[0-9]{4}" style="height:50px; font-size:15px;">
                </div>             
            </div>
        </div>
        
        ';
    }

    function viewSummary(){
        include("includes/sqlconnection.php");
        $sql = "SELECT * FROM tbl_order order by orderID desc";
        $result = $conn->query($sql);

        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                echo '
                    <div class="row" style="border-bottom: 1px solid gray;">
                        <a href="#">
                            <div class="col-md-5" style="padding:0; margin:0;">
                                <img src="addedShoes/' . $row["pic"] . '" style="width:150px; padding-right:10px;">
                            </div>
                        </a>
                        <div class="col-md-offset-6">
                            <br><br>
                            <h4>' . $row["name"] . '</h4>
                            <h5>' . $row["category"] . '\'s Shoes</h5>
                            <h5>Size: <b>' . $row["orderSize"] . '</b>&nbsp;&nbsp;&nbsp;&nbsp;Quantity: <b>' . $row["quantity"] . '</b></h5>
                            
                            <div class="clearfix"></div>                             
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    ';
            }
        }
        
    }
    function viewOrderSummary(){
        $subtotal=0.00;
        $shipping="Free";
        $total=0.00;

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
            $shipping="free";
            $total=0;
        }
        $formattedSubtotal = number_format("$subtotal", 2);
        $formattedTotal = number_format("$total", 2);
        echo '
        <div class="row">
            <h4 class="pull-right">₱ ' . $formattedSubtotal . '</h4>
            <h4 class="col-md-1">Subtotal</h4>
        </div>
        <div class="row">
            <h4 class="pull-right" id="shipping">' . $shipping . '</h4>
            <h4 class="col-md-1">Shipping</h4>
        </div>
        <hr>
        <div class="row">
            <h4 class="pull-right" id="total"><b>₱ ' . $formattedTotal . '</b></h4>
            <h4 class="col-md-1"><b>Total</b></h4>
        </div>
        <hr>
        
        ';
    }

?>