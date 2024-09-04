<!DOCTYPE html>
<?php session_start(); ?>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <title>Urban Soles Admin</title>

    <style>

        .btn{
            background: black;
            color: white;
        }

        .btn:hover{
            background: crimson;
            color: white;
        }

        .nav-item:hover{
            background: black;
            color: white;
        }
    </style>
    </head>
    <body>
        <div class="container">
            <div class="page-header">
                <h1 class="text-center mt-5">Urban Soles Admin Page</h1>
                    <h4 class="text-success text-center">
                        <?php
                        if(isset($_SESSION['status']) && $_SESSION!=''){
                            echo $_SESSION['status'];
                            echo "</br>";
                            echo "</br>";
                            unset ($_SESSION['status']);
                        }
                        ?> 
                    </h4> 
            </div>

            <div class="container">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#update">Update Shoe Items</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#addnewshoe">Add New Shoe Item</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#branches">Branches</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#ewallet">E-Wallet Payment Method</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#bank">Bank Payment Method</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#promo">Promo Codes</a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div id="update" class="container tab-pane active"><br>
                        <h3 class="text-center">Update Shoe</h3><br>
                        <form action="controller.php" method="POST" enctype="multipart/form-data">
                            <div class="table-responsive">
                                <table class="table table-bordered text-center align-middle">
                                    <thead class="thead">
                                        <tr>
                                            <th class="text-center">id</th>
                                            <th class="text-center">Image</th>
                                            <th class="text-center">Name</th>
                                            <th class="text-center">Star</th>
                                            <th class="text-center">Price</th>
                                            <th class="text-center">Category</th>
                                            <th class="text-center">Brand</th>
                                            <th class="text-center">Options</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php viewAll(); ?>
                                    </tbody>
                                </table>
                            </div>
                            <br/>
                        </form>
                    </div>
                    <div id="addnewshoe" class="container tab-pane fade"><br>
                        <h3 class="text-center">Add New Shoe</h3><br>
                        <form action="controller.php" method="POST" enctype="multipart/form-data">
                            <div class="container">
                                <input type="hidden" name="txtid">
                                <div class="row justify-content-center align-items-center">
                                    <div class="col-sm-8">
                                        <div class="mb-3">
                                            <label for="txtimage" class="control-label col-md-2">Image</label>
                                            <input type="file" class="form-control-file col-md-7" id="txtimage" name="txtimage" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="txtname" class="form-label">Name</label>
                                            <input type="text" class="form-control mb-2" id="txtname" name="txtname" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="txtstar" class="form-label">Star</label>
                                            <input type="number" max="5" min="1" class="form-control mb-2" id="txtstar" name="txtstar" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="txtprice" class="form-label">Price</label>
                                            <input type="number" min="1" class="form-control mb-2" id="txtprice" name="txtprice" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="txtcategory" class="form-label">Category</label>
                                            <input type="text" class="form-control mb-2" id="txtcategory" name="txtcategory" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="txtbrand" class="form-label">Brand</label>
                                            <input type="text" class="form-control mb-2" id="txtbrand" name="txtbrand" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br/>
                            <div class="text-center">
                                <button class="btn" type="submit" name="save_shoe">
                                    Add Shoe
                                </button>
                                <a href="admin.php" class="btn" >
                                    Cancel
                                </a>
                            </div>  
                        </form>
                    </div>
                    <div id="branches" class="container tab-pane fade"><br>
                        <h3 class="text-center">Pick Up Branch/es</h3><br>
                        <form action="controller.php" method="POST" enctype="multipart/form-data">
                            <div class="container">
                                <input type="hidden" name="txtid">
                                <div class="row justify-content-center align-items-center">
                                    <div class="col-sm-8">
                                        
                                        <div class="mb-3">
                                            <label for="branch" class="form-label">Branch Name</label>
                                            <input type="text" class="form-control mb-2" id="txtbranch" name="txtbranch" placeholder="Enter Branch Name" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br/>
                            <div class="text-center">
                                <button class="btn" type="submit" name="save_branch">
                                    Add Branch
                                </button>
                                <a href="admin.php" class="btn" >
                                    Cancel
                                </a>
                            </div>  
                        </form>
                        <br>
                        <form action="controller.php" method="POST" enctype="multipart/form-data">
                            <div class="table-responsive">
                                <table class="table table-bordered text-center align-middle">
                                    <thead class="thead">
                                        <tr>
                                            <th class="text-center">id</th>
                                            <th class="text-center">Branch</th>
                                            <th class="text-center">Options</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php viewBranches(); ?>
                                    </tbody>
                                </table>
                            </div>
                            <br/>
                        </form>
                    </div>
                    
                    <div id="ewallet" class="container tab-pane fade"><br>
                        <h3 class="text-center">Supported E-Wallets</h3><br>
                        <form action="controller.php" method="POST" enctype="multipart/form-data">
                            <div class="container">
                                <input type="hidden" name="txtid">
                                <div class="row justify-content-center align-items-center">
                                    <div class="col-sm-8">
                                        
                                        <div class="mb-3">
                                            <label for="ewallet" class="form-label">E-Wallet Name</label>
                                            <input type="text" class="form-control mb-2" id="txtewallet" name="txtewallet" placeholder="Enter E-Wallet" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br/>
                            <div class="text-center">
                                <button class="btn" type="submit" name="save_ewallet">
                                    Add E-Wallet
                                </button>
                                <a href="admin.php" class="btn" >
                                    Cancel
                                </a>
                            </div>  
                        </form>
                        <br>
                        <form action="controller.php" method="POST" enctype="multipart/form-data">
                            <div class="table-responsive">
                                <table class="table table-bordered text-center align-middle">
                                    <thead class="thead">
                                        <tr>
                                            <th class="text-center">id</th>
                                            <th class="text-center">E-Wallet</th>
                                            <th class="text-center">Options</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php viewEWallets(); ?>
                                    </tbody>
                                </table>
                            </div>
                            <br/>
                        </form>
                    </div>
                    
                    <div id="bank" class="container tab-pane fade"><br>
                        <h3 class="text-center">Supported Banks</h3><br>
                        <form action="controller.php" method="POST" enctype="multipart/form-data">
                            <div class="container">
                                <input type="hidden" name="txtid">
                                <div class="row justify-content-center align-items-center">
                                    <div class="col-sm-8">
                                        
                                        <div class="mb-3">
                                            <label for="bank" class="form-label">Bank Name</label>
                                            <input type="text" class="form-control mb-2" id="txtbank" name="txtbank" placeholder="Enter Bank Name" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br/>
                            <div class="text-center">
                                <button class="btn" type="submit" name="save_bank">
                                    Add Bank
                                </button>
                                <a href="admin.php" class="btn" >
                                    Cancel
                                </a>
                            </div>  
                        </form>
                        <br>
                        <form action="controller.php" method="POST" enctype="multipart/form-data">
                            <div class="table-responsive">
                                <table class="table table-bordered text-center align-middle">
                                    <thead class="thead">
                                        <tr>
                                            <th class="text-center">id</th>
                                            <th class="text-center">Bank</th>
                                            <th class="text-center">Options</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php viewBanks(); ?>
                                    </tbody>
                                </table>
                            </div>
                            <br/>
                        </form>
                    </div>

                    <div id="promo" class="container tab-pane fade"><br>
                        <h3 class="text-center">Promo Codes for Discounts</h3><br>
                        <form action="controller.php" method="POST" enctype="multipart/form-data">
                            <div class="container">
                                <input type="hidden" name="txtid">
                                <div class="row justify-content-center align-items-center">
                                    <div class="col-sm-8">
                                        
                                        <div class="mb-3">
                                            <label for="promo" class="form-label">Promo Code</label>
                                            <input type="text" class="form-control mb-2" id="txtpromo" name="txtpromo" placeholder="Enter Promo Code" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br/>
                            <div class="text-center">
                                <button class="btn" type="submit" name="save_promo">
                                    Add Promo Code
                                </button>
                                <a href="admin.php" class="btn" >
                                    Cancel
                                </a>
                            </div>  
                        </form>
                        <br>
                        <form action="controller.php" method="POST" enctype="multipart/form-data">
                            <div class="table-responsive">
                                <table class="table table-bordered text-center align-middle">
                                    <thead class="thead">
                                        <tr>
                                            <th class="text-center">id</th>
                                            <th class="text-center">Promo Code</th>
                                            <th class="text-center">Options</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php viewPromos(); ?>
                                    </tbody>
                                </table>
                            </div>
                            <br/>
                        </form>
                    </div>
            </div>
        </div>
    </div>

    
            


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  </body>
</html>

<?php

    function viewPromos(){
        include("includes/sqlconnection.php");

        $sql = "SELECT * FROM tbl_promo ORDER BY promoID";
        $result = $conn->query($sql);

        if($result->num_rows > 0){

            while($row = $result->fetch_assoc()){
                echo"
                    <tr>
                        <td>$row[promoID]</td>
                        <td>$row[promoCode]</td>
                        <td>
                            <a href='edit.php?id=$row[promoID]' class='btn col-md-6'>Edit</a> <br><br>
                            <a href='controller.php?eID=$row[promoID]' class='btn col-md-6'>Delete</a>
                        </td>
                    </tr>
                
                ";

            }

        } else {

            echo "
                    <tr>
                        <td>&nbsp</td>
                        <td>&nbsp</td>
                        <td>&nbsp</td>
                    </tr>

            ";

        }

        $conn->close();
    }

    function viewBanks(){
        include("includes/sqlconnection.php");

        $sql = "SELECT * FROM tbl_bankpayment ORDER BY bankID";
        $result = $conn->query($sql);

        if($result->num_rows > 0){

            while($row = $result->fetch_assoc()){
                echo"
                    <tr>
                        <td>$row[bankID]</td>
                        <td>$row[bankName]</td>
                        <td>
                            <a href='edit.php?id=$row[bankID]' class='btn col-md-6'>Edit</a> <br><br>
                            <a href='controller.php?eID=$row[bankID]' class='btn col-md-6'>Delete</a>
                        </td>
                    </tr>
                
                ";

            }

        } else {

            echo "
                    <tr>
                        <td>&nbsp</td>
                        <td>&nbsp</td>
                        <td>&nbsp</td>
                    </tr>

            ";

        }

        $conn->close();
    }
    function viewEWallets(){

        include("includes/sqlconnection.php");

        $sql = "SELECT * FROM tbl_epayment ORDER BY eID";
        $result = $conn->query($sql);

        if($result->num_rows > 0){

            while($row = $result->fetch_assoc()){
                echo"
                    <tr>
                        <td>$row[eID]</td>
                        <td>$row[ewallet]</td>
                        <td>
                            <a href='edit.php?id=$row[eID]' class='btn col-md-4'>Edit</a> <br><br>
                            <a href='controller.php?eID=$row[eID]' class='btn col-md-4'>Delete</a>
                        </td>
                    </tr>
                
                ";

            }

        } else {

            echo "
                    <tr>
                        <td>&nbsp</td>
                        <td>&nbsp</td>
                        <td>&nbsp</td>
                    </tr>

            ";

        }

        $conn->close();

    };

    function viewBranches(){

        include("includes/sqlconnection.php");

        $sql = "SELECT * FROM tbl_branches ORDER BY branchID";
        $result = $conn->query($sql);

        if($result->num_rows > 0){

            while($row = $result->fetch_assoc()){
                echo"
                    <tr>
                        <td>$row[branchID]</td>
                        <td>$row[branch]</td>
                        <td>
                            <a href='edit.php?id=$row[branchID]' class='btn col-md-6'>Edit</a> <br><br>
                            <a href='controller.php?branchID=$row[branchID]' class='btn col-md-6'>Delete</a>
                        </td>
                    </tr>
                
                ";

            }

        } else {

            echo "
                    <tr>
                        <td>&nbsp</td>
                        <td>&nbsp</td>
                        <td>&nbsp</td>
                    </tr>

            ";

        }

        $conn->close();

    };

    function viewAll(){

        include("includes/sqlconnection.php");

        $sql = "SELECT * FROM catalog ORDER BY id";
        $result = $conn->query($sql);

        if($result->num_rows > 0){

            while($row = $result->fetch_assoc()){
                echo"
                    <tr>
                        <td>$row[id]</td>
                        <td>
                            <img src='uploads/$row[image]' width='135' height='170' alt='$row[name]'>
                        </td>
                        <td>$row[name]</td>
                        <td>$row[star]</td>
                        <td>$row[price]</td>
                        <td>$row[category]</td>
                        <td>$row[brand]</td>
                        <td>
                            <a href='edit.php?id=$row[id]' class='btn'>Edit</a> <br><br>
                            <a href='controller.php?id=$row[id]&image=$row[image]' class='btn'>Delete</a>
                        </td>
                    </tr>
                
                ";

            }

        } else {

            echo "
                    <tr>
                        <td>&nbsp</td>
                        <td>&nbsp</td>
                        <td>&nbsp</td>
                        <td>&nbsp</td>
                        <td>&nbsp</td>
                        <td>&nbsp</td>
                    </tr>

            ";

        }

        $conn->close();

    };

?>