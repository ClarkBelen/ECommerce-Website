<!DOCTYPE html>
<html>
    <head>

        <title>Edit Shoe</title>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
        
        <style>
        .page-header{
            font-weight: 700;
        }

        .btn{
            background-color: rgb(179, 60, 202);
            color: white;
        }
        </style>

    </head>

    <body>
        <div class="container">
            <div class="page-header">
                <h1 class="text-center mt-5">Edit Shoes</h1>
            </div>
            <form action="controller.php" method="POST" enctype="multipart/form-data">
                <table>
                    <?php
                        getRecord($_GET['id']);
                    ?>
                </table>
                    <br/>
                <div class="text-center">
                    <button class="btn" type = "submit" name="update_shoe">
                        Update Shoe
                    </button>
                    <a href="admin.php" class="btn">
                        Cancel
                    </a>
                </div>
            </form>

            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        </div>
    </body>

</html>

<?php
    function getRecord($recno){
        include("includes/sqlconnection.php");
        $sql = "SELECT * FROM catalog WHERE ID='$recno'";
        $result = $conn->query($sql);

        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                echo"
                <div class='container'>
                <form>
                    <input type='hidden' name='txtid' value='" . $row['id'] . "'>
                    <div class='row'>
                        <div class='col-sm-8'>
                            <div class='mb-3'>
                                <label for='txtimage' class='control-label col-md-2'>Image</label>
                                <input type='file' class='form-control-file col-md-7' id='txtimage' name='txtimage'>
                                <input type='hidden' name='txtimage_old' value='" . $row['image'] . "'>
                            </div>
                            <div class='mb-3'>
                                <label for='txtname' class='form-label'>Name</label>
                                <input type='text' class='form-control mb-2' id='txtname' name='txtname' value='" . $row['name'] . "'>
                            </div>
                            <div class='mb-3'>
                                <label for='txtstar' class='form-label'>Star</label>
                                <input type='number' min='1' max='5' class='form-control mb-2' id='txtstar' name='txtstar' value='" . $row['star'] . "'>
                            </div>
                            <div class='mb-3'>
                                <label for='txtprice' class='form-label'>Price</label>
                                <input type='text' class='form-control mb-2' id='txtprice' name='txtprice' value='" . $row['price'] . "'>
                            </div>
                            <div class='mb-3'>
                                <label for='txtcategory' class='form-label'>Category</label>
                                <input type='text' class='form-control mb-2' id='txtcategory' name='txtcategory' value='" . $row['category'] . "'>
                            </div>
                            <div class='mb-3'>
                                <label for='txtbrand' class='form-label'>Brand</label>
                                <input type='text' class='form-control mb-2' id='txtbrand' name='txtbrand' value='" . $row['brand'] . "'>
                            </div>
                        </div>
                        <div class='col-sm-4 d-flex align-items-center justify-content-center'>
                            <img src='uploads/" . $row['image'] . "' class='img-thumbnail' width='100' height='135' alt='" . $row['image'] . "'>
                        </div>
                    </div>
                </form>
            </div>
                
                
                ";

                 
            }

        } else {

            echo "no record found";

        }
        $conn->close();
    }


?>