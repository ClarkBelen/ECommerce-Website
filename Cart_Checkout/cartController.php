<?php

    session_start();
    include("includes/sqlconnection.php");

    if(isset($_POST['delete_records'])){
        
        include("includes/sqlconnection.php");
        $sql = "SELECT * FROM tbl_order order by orderID desc";
        $result = $conn->query($sql);

        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $sqlDel = "DELETE FROM tbl_order WHERE orderID = '$row[orderID]'";
                if($conn->query($sqlDel) === TRUE){    
                    unlink("addedShoes/".$row['pic']);    
                    $_SESSION['status'] = "~~~~ Record Deleted Successfully ~~~~";
                    
                }else{
                    $_SESSION['status'] = "Error: Deletion Failed.....";
                }
            }
            header('location:index.php');
        }

        $conn->close();
    }
    
    if(isset($_POST['addToCart'])){
        $id = $_POST['txtid'];
        $quantity = $_POST['quantity'];
        $size = $_POST['size'];
    
        $sqlCat = "SELECT * FROM catalog WHERE id='$id'";
        $result = $conn->query($sqlCat);
    
        if($result->num_rows > 0){
            if($row = $result->fetch_assoc()){
                $pic = $row['image'];
                $name = $row['name'];
                $category = $row['category'];
                $brand = $row['brand'];
                $price = $row['price'];
    
                $sql = "INSERT INTO tbl_order(pic, name, category, orderSize, quantity, brand, price)
                VALUES('$pic', '$name', '$category', '$size', '$quantity', '$brand', '$price')";
    
                if($conn->query($sql) === TRUE){
                $sourcePath = "../Admin Shoes/uploads/" . $pic;
                $destinationPath = "addedShoes/" . $pic;
            
                if (!file_exists('addedShoes')) {
                    mkdir('addedShoes', 0777, true);
                }
                
                if (copy($sourcePath, $destinationPath)) {
                    $_SESSION['status'] = "~~~~ Record Inserted and Image Copied Successfully ~~~~";
                } else {
                    $_SESSION['status'] = "Error: Image Copy Failed.....";
                }

                header('location:index.php');
            } else {
                $_SESSION['status'] = "Error: Insertion Failed.....";
                header('location:../Froilan_Catalog/catalog.php');
            }
        }
    } else {
        $_SESSION['status'] = "Error: Selection Failed.....";
        header('location:../Froilan_Catalog/catalog.php');
    }

    $conn->close();
}
    

    if(isset($_POST['update_record'])){
        $id = $_POST['txtid'];
        $quantity = $_POST['quantity'];
        $size = $_POST['size'];

        $sql = "UPDATE tbl_order
        SET orderSize='$size', quantity='$quantity' WHERE orderID='$id'";

        if($conn->query($sql)===TRUE){
            $_SESSION['status'] = "~~~~ Record Updated Successfully ~~~~";
            header('location:index.php');
        }else{
            $_SESSION['status'] = "Error: Update Failed.....";
            header('location:edit.php');
        }
        $conn->close();
      
    }

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $pic = $_GET['pic'];

        $sql = "DELETE FROM tbl_order WHERE orderID = '$id'";

        if($conn->query($sql) === TRUE){
            unlink("addedShoes/".$pic);
            $_SESSION['status'] = "~~~~ Record Deleted Successfully ~~~~";
            header('location:index.php');
        }else{
            $_SESSION['status'] = "Error: Deletion Failed.....";
            header('location:index.php');
        }
        $conn->close();
    }
?>